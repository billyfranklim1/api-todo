<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Services\TodoService;
use App\Models\Todo;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = $this->todoService->getAllTodos();
        return TodoResource::collection($todos);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $todo = $this->todoService->getTodoById($id);
        return new TodoResource($todo);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = $this->todoService->createTodo(
            $request->validated()
        );
        return new TodoResource($todo, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        $updatedTodo = $this->todoService->updateTodo(
            $id,
            $request->validated()
        );
        return new TodoResource($updatedTodo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->todoService->deleteTodo($id);
        return response()->json(null, 204);
    }

    /**
     * Mark the specified resource as completed.
     */
    public function complete($id)
    {
        $todo = $this->todoService->complete($id);
        return new TodoResource($todo);

    }

    /**
     * Mark the specified resource as incomplete.
     */
    public function incomplete($id)
    {
        $todo = $this->todoService->incomplete($id);
        return new TodoResource($todo);
    }
}
