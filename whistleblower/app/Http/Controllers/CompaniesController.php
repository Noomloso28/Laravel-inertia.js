<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Companies;
use App\Models\CompanyCategories;
use App\Models\CompanyDepartments;
use App\Models\Departments;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\UserCompany;
use App\Models\CompanySettings;
use phpseclib3\Crypt\RSA;

class CompaniesController extends Controller
{

    public function __construct()
    {
//        $this->middleware('permission:'.PermissionName::CAN_VIEW_COMPANIES,['only'=>['index', 'show', 'userCompanies']]);
        $this->middleware('permission:view-companies',['only'=>['index', 'show', 'userCompanies']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_COMPANIES, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_COMPANIES, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_COMPANIES, ['only' => ['destroy']]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = UserCompany::getUserCompanies();
        $companyLogos = CompanySettings::where('attribute_name', 'logo')->get()->toArray();

        return Inertia::render('Platform/Companies/Index', [
            'companies' => $companies,
            'logos' => $companyLogos
        ]);
    }

    private function getCompanies(): array
    {
        return UserCompany::with('companies', 'users')->where('user_id', Auth::user()->id)
            ->whereHas('companies')->get()->toArray() ?? [];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Platform/Companies/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required'],
            'photo' => 'nullable|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ])->validate();
        $request->request->add(['slug' => Str::slug($request->name, '-')]);
        $request->request->add(['rsa_key' => RSA::createKey(2048)->withHash('sha256')->getPublicKey()->toString('PKCS8')]);

        $company = Companies::create($request->all());

        /** add user to a company */
        if(is_numeric($company->id)){
            UserCompany::create([
                'user_id' => Auth::user()->id,
                'company_id' => $company->id
            ]);
        }

        /** create logo */
        if(is_numeric($company->id) && ($request->hasFile('photo'))){
            $company->addMediaFromRequest('photo')->toMediaCollection('media');
            /**save media uuid to companies setting table */
            $getMedia = $company->getMedia('media');
            if($getMedia[0]->uuid){
                CompanySettings::create([
                    'company_id' => $company->id,
                    'attribute_name' => 'logo',
                    'attribute_value' => $getMedia[0]->uuid
                ]);
            }
        }
        /** add default categories */
//        if(is_numeric($company->id)){
//             Companies::setDefaultCategories($company->id);
//        }

        return redirect()->route('companies.edit', ['company' => $company->id])->with('message','Please update categories and the departments');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $companies = Companies::find($id);
        return Inertia::render('Platform/Companies/Show', ['companies' => $companies]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userCompanies()
    {
        $companies = UserCompany::with('companies', 'users')->where('user_id', Auth::user()->id)
            ->whereHas('companies')->get()->toArray();
        return Inertia::render('Platform/Companies/userCompanies', ['companies' => $companies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Companies::find($id);
        $settings = CompanySettings::where('company_id', $id)->get()->toArray();
        $catagories = Categories::getCategoryById($id);
        $departments = Departments::getDepartmentById($id);
        $companyCategories = CompanyCategories::where('company_id', $id)
                            ->where('active', true)
                            ->pluck('category_id');
        $companyDepartments = CompanyDepartments::where('company_id', $id)
            ->where('active', true)
            ->pluck('department_id');

        return Inertia::render('Platform/Companies/Edit', [
            'company' => $companies,
            'settings' => $settings,
            'catagories' => $catagories,
            'departments' => $departments,
            'companyCategories' => $companyCategories->toArray() ?? [],
            'companyDepartments' => $companyDepartments->toArray() ?? []
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(),[
            'name' => ['required'],
            'photo' => 'nullable|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'companyCategories' => 'nullable'
        ])->validate();
        $company = Companies::find($id);
        /** update data change */
        $company->update($request->all());

        /** update categories */
        Companies::updateCategories($id, $request->companyCategories);

        /** update departments */
        Companies::updateDepartments($id, $request->companyDepartments);

        /** create logo */
        if($request->hasFile('photo')){

            /** upload new logo */
            $company->addMediaFromRequest('photo')->toMediaCollection('media');
            /**save media uuid to companies setting table */
            $getMedia = $company->getMedia('media')->sortByDesc('created_at')->first();
            if($getMedia->uuid){
                CompanySettings::updateOrCreate([
                    'company_id' => $company->id,
                    'attribute_name' => 'logo',
                ],
                [
                    'attribute_value' => $getMedia->uuid
                ]
                );
            }
        }

        return redirect()->route('companies.index')->with('message','Updated the item successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Companies::find($id)->delete();

        return redirect()->route('companies.index')->with('message','Deleted the item successfully');
    }

    /**
     * Delete the company logo with uuid.
     */
    public function destroyCompanyLogo($uuid)
    {
        if($uuid){
            CompanySettings::where('attribute_value', $uuid)
                ->where('attribute_name', 'logo')
                ->delete();
        }

        return back(303)->with('message', 'Deleted the item successfully');
    }

    public function showBySlug(string $companySlug)
    {
        if(!$company = Companies::whereSlug($companySlug)->first()){
            return '';
        }
        if(is_numeric($company['id'])){
            $logo = CompanySettings::where([
                'company_id' => $company['id'],
                'attribute_name' => 'logo'
            ])->first();
        }


        return Inertia::render('Platform/Companies/ShowBySlug',
            [
                'company' => $company,
                'logo' => $logo ?? '',
                'submit_url' => ''
            ]
        );
    }
}
