<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUserRequest $request, UserService $userService)
    {
        $user = $userService->create($request->validated());
    }
//    public function store(StoreUserRequest $request, CreateUserAction $action)
//    {
//        $user = $action->execute($request->validated());
//
//        // ...
//    }
}
