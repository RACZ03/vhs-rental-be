<?php

namespace Controllers;


use Infrastructure\Persistence\MySQLClientRepository;
use Domain\Entity\Client;
use Application\Services\Client\AppClientService;
use Domain\Services\Client\ClientService;

class ClientController
{

    private $appClientService;

    public function __construct()
    {
        $clientRepository = new MySQLClientRepository();
        $clientService = new ClientService($clientRepository);
        $this->appClientService = new AppClientService($clientService);
    }

    public function index()
    {
        try {
            return $this->appClientService->getAllClient();
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function findById($id)
    {
        try {
            return $this->appClientService->findByIdClient($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function store()
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $name = $requestData['name'] ?? null;
            $email = $requestData['email'] ?? null;
            $phone = $requestData['phone'] ?? null;
            $lastname = $requestData['lastname'] ?? null;
            if ($name === null || $email === null || $phone === null || $lastname === null) {
                throw new \Exception("All fields are required.");
            }
            return $this->appClientService->createClient($name, $lastname, $phone, $email);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function update($id)
    {
        try {
            $requestData = json_decode(file_get_contents('php://input'), true);
            $name = $requestData['name'] ?? null;
            $email = $requestData['email'] ?? null;
            $phone = $requestData['phone'] ?? null;
            $lastname = $requestData['lastname'] ?? null;
            if ($name === null || $email === null || $phone === null || $lastname === null) {
                throw new \Exception("All fields are required.");
            }
            return $this->appClientService->updateClient($id, $name, $lastname, $phone, $email);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try {
            return $this->appClientService->deleteClient($id);
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
