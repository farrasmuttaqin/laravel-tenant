<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTenantRequest;
use App\Services\Tenant\TenancyServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RegisteredTenantController extends Controller
{
    /**
     * @var TenancyServiceInterface
     */
    private $tenantServiceInterface;

    /**
     * @param TenancyServiceInterface $tenant
     */
    public function __construct(TenancyServiceInterface $tenant)
    {
        $this->tenantServiceInterface = $tenant;
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('auth.register_new_tenant');
    }

    /**
     * @param RegisterTenantRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterTenantRequest $request): RedirectResponse
    {
        try {
            /**
             * Create tenant with domain
             */
            $request->validated();

            $this->tenantServiceInterface->createDomainWithTenantData($request->validated());

            return Redirect::back()->with('register-tenant', 'register new tenant success');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
