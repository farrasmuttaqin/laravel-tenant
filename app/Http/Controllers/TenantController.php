<?php

namespace App\Http\Controllers;

use App\Services\Tenant\TenancyServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     */
    public function createDomain(Request $request): JsonResponse
    {
        /**
         * Validate create request tenant
         */

        $validator = Validator::make($request->all(), [
            'domain' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->formatValidationErrors($validator);
        }

        try {

            /**
             * Create domain
             */
            $tenant = $this->tenantServiceInterface->createDomain($request->domain);

            return $this->successResponse($tenant, 'Success Create Tenant');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
