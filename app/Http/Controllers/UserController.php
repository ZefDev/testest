<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * Create a new UserController instance.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Store a newly created user.
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $this->userService->createUser($request->validated());

        return response()->json(['success' => 'User created successfully'], 201);
    }

    /**
     * Update the specified user.
     */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), $request->rules());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        
        $this->userService->updateUser($id, $request->validated(), $request->user());

        return response()->json(['success' => 'User updated successfully']);
    }

    /**
     * Remove the specified user.
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $this->userService->deleteUser($id, $request->user());

        return response()->json(['success' => 'User deleted successfully']);
    }

    /**
     * Get the authenticated user.
     */
    public function getAuthenticatedUser(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }
}
