<?php

namespace App\Repositories;

interface ReservationRepositoryInterface
{
    public function getAll();

    public function find(string $id);

    public function save(array $data);
}
