<?php

namespace App\Services\Tenant;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class TenancyService implements TenancyServiceInterface {
    public function createDomain($domainName)
    {
        DB::transaction(function () use ($domainName){
            /**
             * Create tenant
             */
            $tenant = Tenant::create([]);

            /**
             * Create domain
             */
            $tenant->domain()->create(['domain' => $domainName]);
        });
    }
}