<?php


namespace App\Infrastructure\Controllers;



use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;


class GetUserControllerWithouthID  extends BaseController
{
    public function __invoke(): JsonResponse
    {

        return response()->json([
            'error' => "The user id is required"
        ], Response::HTTP_BAD_REQUEST);

    }
}
