<?php

namespace Domain\Repositories;

use Domain\Entity\Client;

interface ClientRepositoryInterface
{
    public function getAllClient();
    public function findByIdClient($id);
    public function findByEmail($email);
    public function createClient($name, $lastname, $phone, $email);
    public function updateClient($id, $name, $lastname, $phone, $email);
    public function deleteClient($id);
}
