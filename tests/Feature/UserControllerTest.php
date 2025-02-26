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

    public function testLogout()
    {
        $this->withSession([
            "user" => "eka"
        ])->post("/logout")->assertRedirect("/login")->assertSessionMissing("user");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "eka"
        ])->get("/login")->assertRedirect("/");
    }

    public function testLoginForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "eka"
        ])->post("/login", [
            "user" => "eka",
            "password" => "password"
        ])->assertRedirect("/");
    }

    public function testLogoutForGuest()
    {
        $this->post("/logout")->assertRedirect("/login");
    }
}
