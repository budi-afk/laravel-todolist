<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
    }

    function testLoginSuccess() {

        self::assertTrue($this->userService->login("eka", "password"));
    }

    function testLoginNotFound() {
        self::assertFalse($this->userService->login("tri", "salah"));
    }

    function testLoginWrongPassword() {
        self::assertFalse($this->userService->login("eka", "salah"));
    }
}
