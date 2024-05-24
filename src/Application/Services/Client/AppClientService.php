<?php

namespace Application\Services\Client;

use Domain\Entity\Client;
use Domain\Services\Client\ClientService;

class AppClientService
{
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function getAllClient()
    {
        return $this->clientService->getAllClient();
    }

    public function findByIdClient($id)
    {
        return $this->clientService->findByIdClient($id);
    }

    public function createClient($name, $lastname, $phone, $email)
    {
        $client = $this->clientService->findByEmail($email);

        if ($client) {
            return ['message' => 'Email already exists.'];
        }

        return $this->clientService->createClient($name, $lastname, $phone, $email);
    }

    public function updateClient($id, $name, $lastname, $phone, $email)
    {

        return $this->clientService->updateClient($id, $name, $lastname, $phone, $email);
    }


    public function deleteClient($id)
    {
        return $this->clientService->deleteClient($id);
    }
}
