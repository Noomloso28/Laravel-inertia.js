<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\CompanyUsers;
use App\Models\UserCompany;
use App\Models\Users;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\User;

class CompanyUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.PermissionName::CAN_VIEW_USERS_IN_COMPANY,['only'=>['list']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCompanies = UserCompany::with('companies', 'users')
            ->where('user_id', Auth::user()->id)
            ->whereHas('companies')
            ->get()->toArray();

        return Inertia::render('Company/CompanyUser/Index', ['userCompanies' => $userCompanies]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $userCompanies = UserCompany::with('companies', 'users')->whereHas('companies')->get()->toArray() ?? [];
        $userCompanies = $this->disableAdmin($userCompanies); // remove admin

        $companies = UserCompany::getUserCompanies();

        return Inertia::render('Company/CompanyUser/Lists', [
            'userCompanies' => $userCompanies,
            'companies' => $companies
        ]);
    }
    private function getCompanies(): array
    {
        return UserCompany::with('companies', 'users')->where('user_id', Auth::user()->id)
            ->whereHas('companies')->get()->toArray() ?? [];
    }
    private function disableAdmin(array $userCompanies): array
    {
        $result = [];
        foreach ($userCompanies as $key => $values){
            // Get the user by ID
            $user = User::find($values['user_id']);
            // Check if the user has the role
            if ($user->hasRole('admin')) {
                continue;
            }
            $result[] = $values;
        }
        return $result;
    }

    /**
     * Add User with Company.
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Add()
    {
        $companies = UserCompany::getUserCompanies();
        $users = Users::all();
        $userCompanies = UserCompany::all();
        return Inertia::render('Company/CompanyUser/Add', [
            'companies' => $companies,
            'users' => $users,
            'userCompanies' => $userCompanies,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        Validator::make($request->all(), [
            'company_id' => ['required'],
            'user_id' => ['required'],
        ])->validate();
        UserCompany::create([
            'user_id' => $request->user_id,
            'company_id' => $request->company_id
        ]);
        return redirect()->route('companies-user.lists')->with('message','Created the item successfully');
    }

    public function remove($id)
    {
        UserCompany::find($id)->delete();
        return redirect()->route('companies-user.lists')->with('message','Deleted the item successfully');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userCompanyId = UserCompany::where('user_id', Auth::user()->id)->get()->pluck('company_id')->toArray() ?? [];
        $companies = Companies::whereNotIn('id', $userCompanyId)->get()->toArray();
//        $companies = Companies::all();
        return Inertia::render('Company/CompanyUser/Create', ['companies' => $companies]);
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
            'company_id' => ['required'],
        ])->validate();
        UserCompany::create([
            'user_id' => Auth::user()->id,
            'company_id' => $request->company_id
        ]);

        return redirect()->route('companies-user.index')->with('message','Created the item successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyUsers  $companyUsers
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyUsers $companyUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyUsers  $companyUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyUsers $companyUsers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyUsers  $companyUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyUsers $companyUsers)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserCompany::find($id)->delete();
        return back()->with('message','Deleted the item successfully');

//        return redirect()->route('companies-user.index')->with('message','Deleted the item successfully');
    }
}
