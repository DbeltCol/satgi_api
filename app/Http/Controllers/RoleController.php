<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
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
        $roles = Role::where('name', 'like', '%' . $request->search . '%')->orderBy('id', 'asc')->paginate(10);
        return response()->json([
            'roles' => RoleResource::collection($roles),
        ], Response::HTTP_OK);
    }

    public function store(RoleRequest $request)
    {
        $exists = Role::where('name', $request->name)->first();
        if($exists){
            return response()->json(['error' => 'Role already exists'], Response::HTTP_BAD_REQUEST);
        }

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'api',
            'description' => $request->description,
        ]);

        $permissions = $request->permissions;
        foreach($permissions as $permission){
            $role->givePermissionTo($permission);
        }
        
        return response()->json([
            'role' => new RoleResource($role),
        ], Response::HTTP_CREATED);
    }

    public function show(Role $role)
    {
        return response()->json([
            'role' => new RoleResource($role),
        ], Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        if(!$role){
            return response()->json(['error' => 'Role not found'], Response::HTTP_NOT_FOUND);
        }
        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);
        return response()->json(['message' => 'Role updated successfully', 'role' => $role], Response::HTTP_OK);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully',
        ], Response::HTTP_OK);
    }


}
