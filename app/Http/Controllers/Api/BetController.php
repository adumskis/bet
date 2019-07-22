<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BetRequest;
use App\Services\BetManager;
use Illuminate\Http\JsonResponse;

/**
 * Class BetController
 * @package App\Http\Controllers
 */
class BetController extends Controller
{
    /**
     * @var BetManager
     */
    protected $betManager;

    /**
     * BetController constructor.
     * @param BetManager $betManager
     */
    public function __construct(BetManager $betManager)
    {
        $this->betManager = $betManager;
    }

    /**
     * @param BetRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function __invoke(BetRequest $request): JsonResponse
    {
        sleep(rand(1, 30));
        $this->betManager->create($request->getRequest()->all());

        return new JsonResponse([], 201);
    }
}
