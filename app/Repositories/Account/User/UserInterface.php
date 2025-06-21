<?php

namespace App\Repositories\Account\User;

interface UserInterface
{


    public function get();

    public function getById($id);

    public function store($data);

    public function update($data, $id);

    public function delete($id);


}