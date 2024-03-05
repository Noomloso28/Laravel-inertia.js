<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:'.PermissionName::CAN_VIEW_NOTES,['only'=>['index', 'show']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_NOTES, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_NOTES, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_NOTES, ['only' => ['destroy']]);
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
	    Validator::make($request->all(), [
		    'occurrence_id' => ['required'],
		    'text' => ['required']
	    ])->validate();

	    try {
			Notes::updateOrCreate(
				[
					'id' => $request->id ?? 0
				],
				[
					'text' => $request->text,
					'user_id' => Auth::id(),
					'occurrence_id' => $request->occurrence_id,
					'type' => 'note'
				]
			)->toArray();

	    }catch (\Exception $exception){

	    }

	    return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $record = Notes::findOrFail($id)->delete();
        }catch (\Exception $exception){

        }

        return back();
    }
}
