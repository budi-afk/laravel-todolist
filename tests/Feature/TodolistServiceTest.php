<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        $this->assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "test");

        $todolist = Session::get('todolist');
        self::assertEquals("1", $todolist[0]['id']);
        self::assertEquals("test", $todolist[0]['todo']);

        // foreach($todolist as $value) {
        //     self::assertEquals("1", $value['id']);
        //     self::assertEquals("test", $value['todo']);
        // }
    }

    public function testGetTodoEmpty()
    {
        self::assertEmpty($this->todolistService->getTodo());
    }

    public function testGetTodoNotEmpty()
    {
        $this->todolistService->saveTodo("1", "test");
        $this->todolistService->saveTodo("2", "test2");

        $expected = [
            [
                "id" => "1",
                "todo" => "test"
            ],
            [
                "id" => "2",
                "todo" => "test2"
            ]
        ];

        self::assertEquals($expected, $this->todolistService->getTodo());
    }
}
