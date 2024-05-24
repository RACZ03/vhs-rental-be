<?php

namespace Domain\Services\Seeder;

use Domain\Repositories\SeederRepositoryInterface;

class SeederService
{
    private $seederRepository;

    public function __construct(SeederRepositoryInterface $seederRepository)
    {
        $this->seederRepository = $seederRepository;
    }

    public function seed()
    {
        try {
            $initialData = [
                'users' => [
                    'admin' => password_hash('admin123', PASSWORD_DEFAULT)
                ]
            ];

            foreach ($initialData as $table => $data) {
                foreach ($data as $username => $password) {
                    $this->seederRepository->seedTable($table, $username, $password);
                }
            }

            return ['status' => 'success', 'message' => 'Seeding successful'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
