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
        return $this->respondOk($user);
    }
//    public function store(StoreUserRequest $request, CreateUserAction $action)
//    {
//        $user = $action->execute($request->validated());
//
//        // ...
//    }
// JOP class
//    public function store(StoreUserRequest $request)
//    {
//        $user = (new CreateUserAction())->execute($request->validated());
//        NewUserDataJob::dispatch($user);
//
//        // ...
//    }
//event & job
//    public function store(StoreUserRequest $request)
//    {
//        $user = (new CreateUserAction())->execute($request->validated());
//        NewUserDataJob::dispatch($user);
//
//        NewUserRegistered::dispatch($user);
//        //
//    }
}
