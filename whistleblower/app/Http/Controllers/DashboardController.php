<?php

namespace App\Http\Controllers;

use App\Models\CompanySettings;
use App\Models\Notifications;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;


use App\Models\Dashboard;

class DashboardController extends Controller
{
    private Notifications $notifications;

    public function __construct(Notifications $notifications)
    {
        $this->notifications = $notifications;
    }

    public function index()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications->take(10);
        $notificationsArray = $notifications? $notifications->toArray() : [];
        $notificationsArray = $this->notifications->getOccurrences($notificationsArray);

//        dd(Dashboard::getMonthReport());

        return Inertia::render('Dashboard/Index', [
            'notifications' => $notificationsArray,
            'occurrences_months' => Dashboard::getOccurrencesOfMonths(),
            'month_reports' => Dashboard::getMonthReport()
        ]);
    }

    public function companies()
    {
        $userCompanies = UserCompany::selectCompanies();
        $companies = Dashboard::companyDetails($userCompanies);

        $companyLogos = CompanySettings::where('attribute_name', 'logo')->get()->toArray();

        return Inertia::render('Dashboard/Companies', [
            'companies' => $companies,
            'logos' => $companyLogos,
            'is_admin' => (Auth::user()->hasRole('admin')) ? true : false
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setCompany(Request $request)
    {
        if(is_numeric($request->id)){
            $request->session()->put('company.id', $request->id);
        }

        return redirect()->intended();
    }

}
