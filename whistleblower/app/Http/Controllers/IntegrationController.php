<?php

namespace App\Http\Controllers;

use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Companies;
use Illuminate\Routing\UrlGenerator;

class IntegrationController extends Controller
{
    private UrlGenerator $url;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->url = $urlGenerator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCompanies = $this->getCompanies();
        return Inertia::render('Company/Integration/Index', [
            'userCompanies' => $userCompanies,
            'siteUrl' => $this->url->to('/')
        ]);
    }

    private function getCompanies(): array
    {
        return UserCompany::with('companies', 'users')->where('user_id', Auth::user()->id)
            ->whereHas('companies')->get()->toArray() ?? [];
    }
}
