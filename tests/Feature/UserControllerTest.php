<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get("/login")->assertSeeText("Login");
    }

    public function testLoginSuccess()
    {
        $this->post("/login", [
            "user" => "eka",
            "password" => "password"
        ])->assertRedirect("/");
    }

    public function testLoginFailed()
    {
        $this->post("/login", [
            "user" => "eka",
            "password" => "wrongpassword"
        ])->assertSeeText("Invalid user or password");
    }

    public function testLoginNull()
    {
        $this->post("/login", [
            "user" => "",
            "password" => ""
        ])->assertSeeText("User or password is required");
    }
}
