<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoRepository implements TodoRepositoryInterface
{
    public function getAll(array $filters = [])
    {
        return Todo::orderBy('id', 'desc')->get();
    }

    public function findById($id)
    {
        return Todo::find($id);
    }

    public function create(array $data)
    {
        $data['completed'] = $data['completed'] ?? false;
        return Todo::create($data);
    }

    public function update($id, array $data)
    {
        $person = Todo::find($id);

        $data['completed'] = $data['completed'] ?? false;
        $person->update($data);
        return $person;
    }

    public function delete($id)
    {
        $person = Todo::findOrFail($id);
        return $person->delete();
    }
}
