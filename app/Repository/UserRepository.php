<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    // Repository here
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = User::query()->where('userId','=',$id)->first();
        $user->update($data);
        return $user;
    }

    public function destroyUser($id)
    {
        $user = User::deleteWhere(['userId'=>$id]);
        return $user;
    }
}
