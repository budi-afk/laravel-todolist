<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function index()
    {
        $todolist = $this->todolistService->getTodo();

        return response()->view('todolist.index', [
            'title' => "Todolist",
            'todolist' => $todolist
        ]);
    }

    public function store(Request $request)
    {
        $todo = $request->input('todo');

        if (empty($todo)) {
            $todolist = $this->todolistService->getTodo();
            return response()->view('todolist.index', [
                'title' => "Todolist",
                'todolist' => $todolist,
                'error' => "Todo is required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'index']);
    }

    public function remove(Request $request, string $id)
    {
        $this->todolistService->removeTodo($id);

        return redirect()->action([TodolistController::class, 'index']);
    }
}
