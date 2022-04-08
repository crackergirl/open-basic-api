<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use function PHPUnit\Framework\isEmpty;

class GetUserController extends BaseController
{

    public function __invoke(string $userId): JsonResponse
    {
        if(strlen($userId)<1){
            return response()->json([
            'error' => "The user id is required"
        ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'error' => "user does not exist"
        ], Response::HTTP_BAD_REQUEST);

    }
}
