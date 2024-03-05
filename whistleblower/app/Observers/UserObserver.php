<?php

namespace App\Observers;

use App\Configs\Setting;
use App\Models\User;
use App\Models\UserSettings;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        /**
         * Create user settings default when register has done.
         */
        $data =[
            [
                'user_id' => $user->id,
                'name' => Setting::SETTING_OCCURRENCE_CREATED,
                'value' => true,
                'active' => true
            ],
            [
                'user_id' => $user->id,
                'name' => Setting::SETTING_OCCURRENCE_UPDATED,
                'value' => true,
                'active' => true
            ],
            [
                'user_id' => $user->id,
                'name' => Setting::SETTING_OCCURRENCE_DELETED,
                'value' => true,
                'active' => true
            ]
        ];

        UserSettings::insert($data);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
