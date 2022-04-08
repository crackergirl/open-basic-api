<?php


namespace App\Infrastructure\Controllers;


use App\Application\UserDataSource\UserDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use function PHPUnit\Framework\isEmpty;

class GetUserControllerWithouthID  extends BaseController
{
    public function __invoke(): JsonResponse
    {

        return response()->json([
            'error' => "The user id is required"
        ], Response::HTTP_BAD_REQUEST);

    }
}
