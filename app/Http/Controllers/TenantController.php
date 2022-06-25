<?php

namespace App\Http\Controllers;

use App\Services\Tenant\TenancyServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TenantController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function createDomain(Request $request): JsonResponse
    {
        /**
         * Validate create request tenant
         */
        $this->validate($request, [
            'name' => 'exists:'.env('DB_CONNECTION').'.domains|required',
        ]);


        try {
            /**
             * Create domain
             */
            $tenant = $this->tenantServiceInterface->createDomain($request->name);

            return $this->successResponse($tenant, 'Success Create Tenant');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
