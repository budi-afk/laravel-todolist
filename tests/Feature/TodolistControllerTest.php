<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testIndex()
    {
        $this->withSession(['user' => 'eka', 'todolist' => [
            ['id' => "1", 'todo' => "Belajar Laravel Dasar"]
        ]])->get('/todolist')->assertSeeText("1")->assertSeeText("Belajar Laravel Dasar");
    }

    public function testStoreEmpty()
    {
        $this->withSession(['user' => 'eka'])->post('/todolist', [])->assertSeeText("Todo is required");
    }

    public function testStore()
    {
        $this->withSession(['user' => 'eka'])->post('/todolist', ['todo' => 'Belajar Laravel Dasar'])->assertRedirect('/todolist');
    }

    public function testRemoveTodo()
    {
        $this->withSession([
            'user' => 'eka',
            'todolist' => [
            ['id' => "1",
            'todo' => "Belajar Laravel Dasar"]
        ]
        ])->delete('/todolist/1/delete')->assertRedirect('/todolist');
    }
}
