<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserBasicAPI\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(string $userId): JsonResponse
    {
        try {
            $user = $this->userService->execute($userId);

        }catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            "{id:".$user->getId().", email:'".$user->getEmail()."'}"
        ], Response::HTTP_OK);

    }


}
