<?php

namespace App\Http\Middleware;

use App\Models\Companies;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'user.roles' => $request->user() ? $request->user()->roles->pluck('name') : [],
            'user.permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'csrf_token' => csrf_token(),
            'current_locale' => fn () => $request->session()->get('locale') ?? app()->getLocale(),
            'available_locales' => config('app.available_locales'),
            'user.company' => $this->getCompany($request)
        ]);
    }

    /**
     * Retrive Company Data by CompanyId.
     *
     * @param Request $request
     * @return array
     */
    public function getCompany(Request $request): array
    {
        $companyId = $request->session()->get('company.id');
        if(is_numeric($companyId)){
            return Companies::find($companyId)->toArray();
        }
        return [];
    }
}
