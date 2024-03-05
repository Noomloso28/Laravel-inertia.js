<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\User;
use App\Models\UserCompany;
use App\Models\Users;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use App\Models\Roles;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.PermissionName::CAN_VIEW_USERS,['only'=>['index', 'show']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_USERS, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_USERS, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_USERS, ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->getUsersByRole();
//        dd($users);
        return Inertia::render('Company/Users/Index', [
            'users' => $users,
        ]);
    }
    private function getUsersByRole()
    {

        $userId = (int) Roles::where('name', 'user')->value('id');
        $managerId = (int) Roles::where('name', 'manager')->value('id');

        if(Auth::user()->hasRole('admin')){
            return Users::with('roles')->where('role_id', '>', 0)->get();
        }

        /** get companies in current user. */
        $userCompanies = $this->getCompanies();
        $companyIds = array_map(function ($userCompanies) {
            return $userCompanies['company_id'];
        }, $userCompanies) ?? [];

        /** get all users under userCompanies */
        $users = $this->getUserInCompanies($companyIds);
        $userIds = array_unique(
            array_map(function ($users) {
                return $users['user_id'];
            }, $users) ?? []
        );


        /** Manager get user in company */
        if(Auth::user()->hasRole('manager')){
            /**get users same roles(manager, user) by userId */
            return Users::with('roles')->whereIn('role_id', [$userId, $managerId])
                ->whereIn('id' , $userIds )->get()->toArray();
        }

        /** User role get user in company */
        if(Auth::user()->hasRole('user')){
            return Users::with('roles')->where('role_id', '=', $userId)
                ->whereIn('id' , $userIds )->get();
        }

        return [];
    }
    private function getUserInCompanies(array $where): array
    {
        return UserCompany::with('companies', 'users')->whereIn('company_id', $where)
            ->whereHas('companies')->get()->toArray() ?? [];
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
        $userCompanies = $this->getCompanies();
        $companyIds = array_map(function ($userCompanies) {
            return $userCompanies['company_id'];
        }, $userCompanies) ?? [];

        $companies = Companies::whereIn('id', $companyIds)->get()->toArray();

        $roles = Roles::all();
        return Inertia::render('Company/Users/Create',[
            'roles' => $roles,
            'companies' => $companies
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
        Validator::make($request->all(),[
            'name' => ['required'],
            'active' => ['required'],
            'role_id' => ['required'],
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'company_id' => ['required'],
        ])->validate();

        /*** ex. admin, manager, user */
        $roleName = $this->getUserRole($request->role_id);

        $user = User::create([
            'name' => $request->name,
            'active' => $request->active,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        User::find($user->id)->syncRoles($roleName);

        /** Add user to company */
        UserCompany::create([
            'user_id' => $user->id,
            'company_id' => $request->company_id
        ]);

        return redirect()->route('users.index')->with('message','Created the item successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Int $id)
    {
//        $user = Users::find($id);
        $user = Users::with('roles')->where('id', '=', $id)->firstOrFail();
        return Inertia::render('Company/Users/Show', ['account' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Int $id)
    {
        $user = Users::find($id);
        $roles = Role::all();
        return Inertia::render('Company/Users/Edit', [
            'account' => $user,
            'roles' => $roles,
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
            'active' => ['required'],
            'role_id' => ['required'],
        ])->validate();

        /*** ex. admin, manager, user */
        $roleName = $this->getUserRole($request->role_id);

        User::find($id)->update([
            'name' => $request->name,
            'active' => $request->active,
            'role_id' => $request->role_id
        ]);
        User::find($id)->syncRoles($roleName);

        return redirect()->route('users.index')->with('message','Updated the item successfully');
    }

    /**
     * @param int $id
     * @return string
     */
    private function getUserRole(int $id): string
    {
        $role = Role::find($id)->toArray();
        return $role['name'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('message','Deleted the item successfully');
    }
}
