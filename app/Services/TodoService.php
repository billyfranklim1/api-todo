<?php

namespace App\Services;

use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoService
{
    protected $todoRepository;

    public function __construct(TodoRepositoryInterface $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAllTodos()
    {
        return $this->todoRepository->getAll();
    }

    public function createTodo(array $data)
    {
        return $this->todoRepository->create($data);
    }

    public function getTodoById($id)
    {
        return $this->todoRepository->findById($id);
    }

    public function updateTodo($id, array $data)
    {

        if ($this->todoRepository->findById($id) === null) {
            throw new \Exception('Todo not found');
        }

        return $this->todoRepository->update($id, $data);
    }

    public function deleteTodo($id)
    {
        if ($this->todoRepository->findById($id) === null) {
            throw new \Exception('Todo not found');
        }
        return $this->todoRepository->delete($id);
    }

    public function complete($id)
    {
        $todo = $this->todoRepository->findById($id);
        if ($todo === null) {
            throw new \Exception('Todo not found');
        }
        $todo->completed = true;
        $todo->save();
        return $todo;
    }

    public function incomplete($id)
    {
        $todo = $this->todoRepository->findById($id);
        if ($todo === null) {
            throw new \Exception('Todo not found');
        }
        $todo->completed = false;
        $todo->save();
        return $todo;
    }
}
