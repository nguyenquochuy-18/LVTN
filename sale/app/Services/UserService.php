<?php
namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService {

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($request)
    {
        $userInfo = $request->all();
        $userInfo['password'] = Hash::make($request->password);

        return $this->userRepository->create($userInfo);
    }
}