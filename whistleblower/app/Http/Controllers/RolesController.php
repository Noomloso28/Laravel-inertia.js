<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.PermissionName::CAN_VIEW_ROLES,['only'=>['index', 'show']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_ROLES, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_ROLES, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_ROLES, ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();
        return Inertia::render('Roles/Index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => array_values($rolePermissions),
            'disabled' => Roles::disablePermissions()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        Validator::make($request->all(),[
            'name' => ['required'],
            'permission' => ['required'],
        ])->validate();
        $role = Role::find($id);
        $role->update([
            'name' => $request->name,
        ]);
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')->with('message','Updated the item successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();
        return back()->with('message','Deleted the item successfully');
    }
}
