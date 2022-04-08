<?php

namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    private $isEarlyAdopterService;

    /**
     * IsEarlyAdopterUserController constructor.
     */
    public function __construct(IsEarlyAdopterService $isEarlyAdopterService)
    {
        $this->isEarlyAdopterService = $isEarlyAdopterService;
    }

    public function __invoke(string $userId): JsonResponse
    {
        try {
            if ($this->isEarlyAdopterService->login($userId)) {
                return response()->json([
                    'error' => "user exist"
                ], Response::HTTP_BAD_REQUEST);
            }
        }catch (Exception $exception) {
            return response()->json([
                'error' => "user does not exist"
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'error' => "user not found"
        ], Response::HTTP_BAD_REQUEST);

    }
}
