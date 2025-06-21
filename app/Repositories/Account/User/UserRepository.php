<?php

namespace App\Repositories\Account\User;

use App\Models\User\User;

class UserRepository implements UserInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;

    }

    public function get()
    {
        try {
            $authId = auth()->user()->id;
            return $this->model->where('id', '!=', $authId)
                ->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getById($id)
    {
        try {
            return $this->model->findOrfail($id);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function store($data)
    {
        try {
            $data['password'] = bcrypt($data['password']);
            return $this->model->create($data);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function update($data, $id)
    {
        try {
            $user = $this->model->findOrfail($id);
            $user->update($data);
            $roleId = (int)$data['role'] ?? null;
            $user->syncRoles([$roleId]);
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->model->findOrfail($id);
            $user->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}