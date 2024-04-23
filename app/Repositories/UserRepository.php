<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 *
 */
class UserRepository
{
    /**
     * Create new user.
     *
     * @param array $data data user
     * @return User Created user
     */
    public function createUser(array $data): User
    {
        $user = new User([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $user->save();

        return $user;
    }

    /**
     * Update data about user.
     *
     * @param User $user User
     * @param array $data New data of user
     * @return void
     */
    public function updateUser(User $user, array $data): void
    {
        $user->update($data);

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
            $user->save();
        }
    }

    /**
     * Remove data user.
     *
     * @param User $user User for delete
     * @return void
     */
    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    /**
     * Get user
     *
     * @param int $id Get user
     * @return User
     */
    public function getUserById(int $id): User
    {
        return User::findOrFail($id);
    }
}
