<?php

namespace App\Http\Controllers;

use App\Permissions\Permission as PermissionName;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Notifications;
class NotificationController extends Controller
{
    private Notifications $notifications;

    public function __construct(Notifications $notifications)
    {
        $this->notifications = $notifications;

        $this->middleware('permission:'.PermissionName::CAN_VIEW_NOTIFICATIONS,['only'=>['index', 'show']]);
        $this->middleware('permission:'.PermissionName::CAN_CREATE_NOTIFICATIONS, ['only' => ['create', 'store']]);
        $this->middleware('permission:'.PermissionName::CAN_UPDATE_NOTIFICATIONS, ['only'=>['edit', 'update']]);
        $this->middleware('permission:'.PermissionName::CAN_DELETE_NOTIFICATIONS, ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $notificationsArray = $user->notifications ? $user->notifications->sortBy('read_at')->sortByDesc('created_at')->toArray() : [];
        $notificationsArray = $this->notifications->getOccurrences($notificationsArray);


        return Inertia::render('Profile/Notifications/Index', [
            'notifications' => $notificationsArray,
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function markAsRead(Request $request, $id)
    {
        $notification = DatabaseNotification::find($id);

        if ($notification) {
            $notification->markAsRead();
        }
    }
}
