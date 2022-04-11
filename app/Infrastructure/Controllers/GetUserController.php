<?php

namespace App\Infrastructure\Controllers;

use App\Application\UserAdopter\IsUserAdopterService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUserController extends BaseController
{
    private $isUserAdopterService;

    /**
     * GetUserController constructor.
     */
    public function __construct(IsUserAdopterService $isUserAdopterService)
    {
        $this->isUserAdopterService = $isUserAdopterService;
    }

    public function __invoke(string $userId): JsonResponse
    {
        try {
            $isUserAdopter = $this->isUserAdopterService->execute($userId);

        }catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($isUserAdopter){
            return response()->json([
                "{id:".$userId.", email:'user@user.com'}"
            ], Response::HTTP_OK);
        }else{

            return response()->json([
                'error' => "User not found"
            ], Response::HTTP_OK);
        }
    }


}
