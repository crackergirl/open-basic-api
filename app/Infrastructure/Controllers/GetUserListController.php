<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserAdopter\IsUserListAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserListController extends BaseController
{
    private $isUserListAdopterService;

    /**
     * GetUserListController constructor.
     */
    public function __construct(IsUserListAdopterService $isUserListAdopterService)
    {
        $this->isUserListAdopterService = $isUserListAdopterService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $isUserListAdopter = $this->isUserListAdopterService->execute();

        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        if (empty($isUserListAdopter)) {
            return response()->json([
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'error' => "User not found"
            ], Response::HTTP_OK);
        }
    }
}
