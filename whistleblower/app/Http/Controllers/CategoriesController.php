<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\CompanyCategories;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Permissions\Permission as PermissionName;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.PermissionName::CAN_VIEW_CATEGORIES,['only'=>['index', 'show']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_CATEGORIES, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_CATEGORIES, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_CATEGORIES, ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::userCategories();

        return Inertia::render('Company/Categories/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userCompanies = UserCompany::getUserCompanies();
        return Inertia::render('Company/Categories/Create',[
            'user_company' => UserCompany::getSelectedCompany(),
            'user_companies' => $userCompanies,
            'is_admin' => (Auth::user()->hasRole('admin')) ? true : false
        ]);
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
            'default' => ['required'],
            'active' => ['required'],
            'company_id' => ['required'],
        ])->validate();

        $category = Categories::create([
            'name' => $request->name,
            'default' => $request->default
        ]);
        /** add to db relation */
        if($category->id){
            CompanyCategories::create([
                'active' => $request->active,
                'company_id' => $request->company_id,
                'category_id' => $category->id,
            ]);
        }

        return redirect()->route('categories.index')->with('message','Created the item successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $categories = Categories::find($id);
        $categories = Categories::with('companies')->where('id', $id)
            ->whereHas('companies')->first()->toArray();

        return Inertia::render('Company/Categories/Show', ['categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::find($id);
        return Inertia::render('Company/Categories/Edit', [
            'category' => $categories,
            'is_admin' => (Auth::user()->hasRole('admin')) ? true : false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        Validator::make($request->all(),[
            'name' => ['required'],
            'default' => ['required'],
        ])->validate();
        Categories::find($id)->update($request->all());
        return redirect()->route('categories.index')->with('message','Updated the item successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
