<?php
namespace App\Interfaces\Task;

interface TaskInterface
{
    public function index();
    public function store($taskTDO);
    public function edit($id);

    public function update($taskTDO,$id);
}
