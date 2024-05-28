<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{

    public function testInvalidMiddleware(){

        $this->get("/middleware/api")
            ->assertStatus(401)
            ->assertSeeText("Access Denied");

    }

    public function testValidMiddleware(){

        $this->withHeader("X-API-KEY", "SB")
            ->get("/middleware/api")
            ->assertStatus(200)
            ->assertSeeText("OK");

    }

    public function testInvalidMiddlewareGroup(){

        $this->get("/middleware/group")
            ->assertStatus(401)
            ->assertSeeText("Access Denied");

    }

    public function testValidMiddlewareGroup(){

        $this->withHeader("X-API-KEY", "SB")
            ->get("/middleware/group")
            ->assertStatus(200)
            ->assertSeeText("GROUP");

    }

}
