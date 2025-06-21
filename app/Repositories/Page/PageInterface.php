<?php

namespace App\Repositories\Page;

interface PageInterface
{

    public function getAll();

    public function getById($criteria);

    public function insert(array $data);

    public function update(array $data, $id);

    public function delete($id);


}
