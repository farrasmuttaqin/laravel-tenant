<?php

namespace App\Services\Tenant;

interface TenancyServiceInterface
{
    public function createDomain($domainName);

    public function createDomainWithTenantData($data);
}
