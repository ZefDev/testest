<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    protected UserRepository $userRepository;

    /**
     * Create a new instance of UserService.
     *
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return void
     */
    public function createUser(array $data): void
    {
        // Delegate creation logic to UserRepository
        $this->userRepository->createUser($data);
    }

    /**
     * Update an existing user.
     *
     * @param int $id
     * @param array $data
     * @param User $currentUser
     * @return void
     */
    public function updateUser(int $id, array $data, User $currentUser): void
    {

        // Find user by id
        $user = $this->userRepository->getUserById($id);

        // Check if the current user has admin role or owns the user being updated
        if (!$currentUser->hasRole('admin') && $currentUser->id !== $user->id) {
            abort(403, 'Unauthorized');
        }
        
        // Delegate update logic to UserRepository
        $this->userRepository->updateUser($user, $data);
    }

    /**
     * Delete a user.
     *
     * @param int $id
     * @param User $currentUser
     * @return void
     */
    public function deleteUser(int $id, User $currentUser): void
    {
        // Find user by id
        $user = $this->userRepository->getUserById($id);

        // Check if the current user has admin role or owns the user being deleted
        if (!$currentUser->hasRole('admin') && $currentUser->id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Delegate deletion logic to UserRepository
        $this->userRepository->deleteUser($user);
    }
}
