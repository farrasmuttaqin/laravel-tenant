<?php

namespace App\Services\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class TenancyService implements TenancyServiceInterface {
    /**
     * @param $domainName
     * @return void
     */
    public function createDomain($domainName)
    {
        DB::transaction(function () use ($domainName){
            /**
             * Create tenant
             */
            $tenant = Tenant::create();

            /**
             * Create domain
             */
            $tenant->domains()->create(['domain' => $domainName.'.'.env('TENANCY_CENTRAL_DOMAIN')]);
        });
    }

    /**
     * @param $data
     * @return void
     */
    public function createDomainWithTenantData($data)
    {
        $tenant = false;

        DB::transaction(function () use (&$tenant, $data){
            /**
             * Create tenant
             */
            $tenant = Tenant::create($data);

            /**
             * Create domain
             */
            $tenant->domains()->create(['domain' => $data['domain']]);
        });

        return $tenant;
    }
}
