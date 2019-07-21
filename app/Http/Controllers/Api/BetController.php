<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BetRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class BetController
 * @package App\Http\Controllers
 */
class BetController extends Controller
{
    /**
     * @param BetRequest $request
     * @return JsonResponse
     */
    public function __invoke(BetRequest $request): JsonResponse
    {
        return new JsonResponse([], 201);
    }
}
