<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{
    public function saveTodo($id, $todo)
    {
        if (!Session::exists('todolist')) {
            Session::put('todolist', []);
        }

        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodo()
    {
        return Session::get('todolist', []);
    }

    public function removeTodo(string $id)
    {
        $todolist = Session::get('todolist');
        foreach ($todolist as $key => $value) {
            if ($value['id'] === $id) {
                unset($todolist[$key]);
                break;
            }
        }

        Session::put('todolist', $todolist);
    }
}
