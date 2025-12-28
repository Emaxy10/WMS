<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;


class UserController extends Controller
{
    //
    public function store(CreateUserRequest $request){
       
        $user = User::create($request->validated());
        return response()->json($user, 201);
    }
}
