<?php

namespace Controllers;

use Application\Services\Auth\LoginService;
use Infrastructure\Persistence\MySQLUserRepository;
use Domain\Services\Auth\AuthService;

class AuthController
{
    private $loginService;

    public function __construct()
    {
        $userRepository = new MySQLUserRepository();
        $authService = new AuthService($userRepository);
        $this->loginService = new LoginService($authService);
    }

    public function login()
    {

        $postData = file_get_contents('php://input');
        $jsonData = json_decode($postData, true);

        if ($jsonData && isset($jsonData['username']) && isset($jsonData['password'])) {
            $username = $jsonData['username'];
            $password = $jsonData['password'];
    
            $user = $this->loginService->execute($username, $password);
    
            if ($user) {
                return ['message' => 'Login successful! Welcome ', 'data' => $user];
            } else {
                return ['message' => 'Login failed. Invalid username or password.'];
            }
        } else {
            return ['error' => 'Invalid JSON data'];
        }
    }

}
