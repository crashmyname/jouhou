<?php
namespace App\Services;

use App\Models\User;
use App\Repository\UserRepository;
use Bpjs\Framework\Helpers\Hash;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;

class UserService
{
    public function __construct(protected UserRepository $userRepository){}

    public function getData(array $data)
    {
        return TablePlus::of('users')
                        ->select('username','name','userId')
                        ->searchable(['username','name'])
                        ->filters($data['filters'] ?? [])
                        ->orderBy('userId','ASC')
                        ->paginate($data['per_page'] ?? 10, $data['page'] ?? 1)
                        ->handleDistinct($data['distinct'] ?? null)
                        ->make();
    }

    public function create(array $data)
    {
        $attributes = [
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ];
        $user = $this->userRepository->createUser($attributes);
        if($user){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'User created'
            ];
        } else {
            return [
                'success' => false,
                'status' => 500,
                'message' => 'Failed create user'
            ];
        }
    }

    public function update($id, array $data)
    {
        $attributes = [
            'name' => $data['name'],
        ];
        if(!empty($data['password'])){
            $attributes['password'] = Hash::make($data['password']);
        }
        $user = $this->userRepository->updateUser($id,$attributes);
        return [
            'success' => true,
            'status' => 200,
            'message' => 'Success update user',
            'data' => $user
        ];
    }

    public function destroy($id)
    {
        $this->userRepository->destroyUser($id);
        return [
            'success' => true,
            'status' => 200,
            'message' => 'success Delete user'
        ];
    }
}
