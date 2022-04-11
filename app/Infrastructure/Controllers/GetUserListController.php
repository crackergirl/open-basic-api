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
            $body = "";
            foreach ($isUserListAdopter as $userId){
                $body .= "{id:'".$userId."'},";
            }
            $body = substr($body, 0, -1);

            return response()->json([
                $body
            ], Response::HTTP_OK);
        }
    }
}
