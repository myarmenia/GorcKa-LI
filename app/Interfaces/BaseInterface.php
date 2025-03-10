<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function getAll();
    public function getById(int $id);
    // public function create();
    public function store(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);

    public function getActiveRows();
}
