<?php

namespace App\Repositories\Project;

interface ProjectInterface
{
    public function getAll();
    public function getPaginated($perPage = 10);
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function updateFile($id, $data);

}