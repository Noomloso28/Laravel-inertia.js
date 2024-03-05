<?php

namespace App\Http\Controllers;

use App\Models\AdminCompanies;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;

class AdminCompaniesController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:'.PermissionName::CAN_VIEW_CATEGORIES,['only'=>['index', 'show']]);
//        $this->middleware('permission:'.PermissionName::CAN_CREATE_CATEGORIES, ['only' => ['create', 'store']]);
//        $this->middleware('permission:'.PermissionName::CAN_UPDATE_CATEGORIES, ['only'=>['edit', 'update']]);
//        $this->middleware('permission:'.PermissionName::CAN_DELETE_CATEGORIES, ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\AdminCompanies  $adminCompanies
     * @return \Illuminate\Http\Response
     */
    public function show(AdminCompanies $adminCompanies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminCompanies  $adminCompanies
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminCompanies $adminCompanies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminCompanies  $adminCompanies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminCompanies $adminCompanies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminCompanies  $adminCompanies
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminCompanies $adminCompanies)
    {
        //
    }
}
