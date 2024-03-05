<?php

namespace App\Http\Controllers;

use App\Models\CompanyDepartments;
use App\Models\Departments;
use App\Models\UserCompany;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Companies;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.PermissionName::CAN_VIEW_DEPARTMENTS,['only'=>['index', 'show']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_DEPARTMENTS, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_DEPARTMENTS, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_DEPARTMENTS, ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Company/Departments/Index', ['departments' => Departments::userDepartments()]);
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
        $userCompanies = UserCompany::getUserCompanies();

        return Inertia::render('Company/Departments/Create',[
            'user_company' => UserCompany::getSelectedCompany(),
            'companies' => $userCompanies,
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
            'company_id' => ['required'],
            'default' => ['required'],
            'active' => ['required'],
        ])->validate();

        $department = Departments::create([
            'name' => $request->name,
            'default' => $request->default
        ]);
        if($department->id){
            CompanyDepartments::create([
                'active' => $request->active,
                'company_id' => $request->company_id,
                'department_id' => $department->id,
            ]);
        }

        return redirect()->route('departments.index')->with('message','Created the item successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $departments = Departments::find($id);
        return Inertia::render('Company/Departments/Show', ['departments' => $departments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $department = Departments::find($id);
        return Inertia::render('Company/Departments/Edit', [
            'department' => $department,
            'is_admin' => (Auth::user()->hasRole('admin')) ? true : false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        Validator::make($request->all(),[
            'name' => ['required'],
            'default' => ['required'],
        ])->validate();
        Departments::find($id)->update($request->all());
        return redirect()->route('departments.index')->with('message','Updated the item successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        Departments::find($id)->delete();
        return redirect()->route('departments.index');
    }
}
