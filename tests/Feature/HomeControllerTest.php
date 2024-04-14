<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    public function testHomeForGuest()
    {
        $this->get("/")->assertRedirect("/login");
    }

    public function testHomeForMember()
    {
        $this->withSession([
            "user" => "eka"
        ])->get("/")->assertRedirect("/todolist");
    }
}
