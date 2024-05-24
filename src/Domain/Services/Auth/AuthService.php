<?php

namespace Domain\Services\Auth;

use Domain\Repositories\UserRepositoryInterface;
class AuthService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login($username, $password)
    {
        $user = $this->userRepository->findByUsername($username);
        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }
}
