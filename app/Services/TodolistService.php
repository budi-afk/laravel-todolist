<?php

namespace App\Services;

interface TodolistService
{
    public function saveTodo(string $id, string $todo);

    public function getTodo();

    public function removeTodo(string $id);
}
