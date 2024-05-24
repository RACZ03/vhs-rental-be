<?php

namespace Domain\Repositories;

interface UserRepositoryInterface
{
    public function findByUsername($username);
}
