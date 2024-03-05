<?php

namespace App\Http\Controllers;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = UserSettings::all();
        $email = UserSettings::emailNotifications();

        return Inertia::render('Profile/Settings/Index', [
            'settings' => $settings,
            'email' => $email,
            'email_template' => UserSettings::getEmailTemplate()
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
        Validator::make($request->all(),[
            'occurrences' => ['required'],
        ])->validate();

        $emailLists = UserSettings::emailNotifications();

        /** occurrences array */
        $occurrencesModified = UserSettings::arrayDifference($emailLists['occurrences'], $request->occurrences);
        if(count($occurrencesModified) > 0){
            foreach ($occurrencesModified as $name => $value){

                $setting = UserSettings::where([
                    'name' => $value['name'],
                    'user_id' => Auth::id()
                ])->first();

                if (is_null($setting)){
                    $data = [
                        'user_id' => Auth::id(),
                        'name' => $value['name'],
                        'value' => $value['value'],
                        'active' => true
                    ];
                    UserSettings::create($data);
                }else{

                    UserSettings::where([
                        'name' => $value['name'],
                        'user_id' => Auth::id()
                    ])->update(
                        ['value' => $value['value']]
                    );
                }
            }
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTemplate(Request $request)
    {
        Validator::make($request->all(),[
            'email_template' => ['required'],
        ])->validate();

        $where = [
            'user_id' => Auth::id(),
            'name' => 'email.template'
        ];
        $data = [
            'user_id' => Auth::id(),
            'name' => 'email.template',
            'value' => $request->email_template,
            'active' => true
        ];

        UserSettings::updateOrInsert($where, $data);

        return redirect()->route('user.settings.index')->with('message','Created the item successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function show(UserSettings $userSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSettings $userSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSettings $userSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSettings $userSettings)
    {
        //
    }
}
