<?php

namespace Domain\Services\Client;

use Domain\Entity\Client;
use Domain\Repositories\ClientRepositoryInterface;


class ClientService
{
    private $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function getAllClient()
    {
        return $this->clientRepository->getAllClient();
    }

    public function findByIdClient($id)
    {
        return $this->clientRepository->findByIdClient($id);
    }

    public function findByEmail($email)
    {
        return $this->clientRepository->findByEmail($email);
    }

    public function createClient($name, $lastname, $phone, $email)
    {
        return $this->clientRepository->createClient($name, $lastname, $phone, $email);
    }

    public function updateClient($id, $name, $lastname, $phone, $email)
    {
        return $this->clientRepository->updateClient($id, $name, $lastname, $phone, $email);
    }

    public function deleteClient($id)
    {
        return $this->clientRepository->deleteClient($id);
    }
}
