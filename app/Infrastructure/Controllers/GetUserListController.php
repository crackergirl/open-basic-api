<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserBasicAPI\UserListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserListController extends BaseController
{
    private UserListService $userListService;

    public function __construct(UserListService $userListService)
    {
        $this->userListService = $userListService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $userList = $this->userListService->execute();

        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        if (empty($userList)) {
            return response()->json([], Response::HTTP_OK);
        } else {
            $body = "";

            foreach ($userList as $userId){
                $body .= "{id:'".$userId."'},";
            }

            $body = substr($body, 0, -1);

            return response()->json([
                $body
            ], Response::HTTP_OK);
        }
    }
}
