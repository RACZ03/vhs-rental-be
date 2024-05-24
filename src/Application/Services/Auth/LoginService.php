<?php

namespace Application\Services\Auth;

use Domain\Services\Auth\AuthService;
use Domain\Entities\User;
use Firebase\JWT\JWT;

class LoginService
{
    private $authService;
    private $secretKey;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->secretKey = getenv('SECRET_KEY');
    }

    public function execute($username, $password)
    {
        $user = $this->authService->login($username, $password);

        if ($user) {
            $token = $this->generateToken($user);
            return ['user' => $user->getUserName(), 'token' => $token];
        }

        return null;
    }

    private function generateToken(User $user)
    {
        $payload = [
            'user_id' => $user->getId(),
            'username' => $user->getUsername(),
            'exp' => time() + (7 * 24 * 60 * 60)
        ];
        $algorithm = 'HS256';

        $token = JWT::encode($payload, $this->secretKey, $algorithm);

        return $token;
    }
}
