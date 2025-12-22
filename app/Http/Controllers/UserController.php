<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:get_all_users',only: ['index']),
            new Middleware('permission:get_user_by_id',only: ['show']),
            new Middleware('permission:create_user',only: ['store']),
            new Middleware('permission:edit_user',only: ['update']),
            new Middleware('permission:delete_user',only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->input('name') . '%')->get();
        return response()->json([
            'users' => UserResource::collection($users),
        ], Response::HTTP_OK);
    }

    public function show(User $user)
    {
        return response()->json([
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    public function store(UserRequest $request)
    {
        $newUser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ];

        $user = User::create($newUser);
        $user->assignRole($request->input('role_id'));
        return response()->json([
            'user' => new UserResource($user),
        ], Response::HTTP_CREATED);
    }

    public function update(UserRequest $request, User $user)
    {
      
        $newUser = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        $user->update($newUser);
        $user->syncRoles($request->input('role_id'));
        return response()->json([
            'user' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => __('default.user.deleted'),
        ], Response::HTTP_OK);
    }

    public function authUser(Request $request)
    {
        return response()->json([
            'user' => new UserResource(auth('sanctum')->user()),
        ], Response::HTTP_OK);
    }
}
