<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{

    public function testGetCookie(){

        $this->withCookie("User-Id", "budhi")
            ->withCookie("Is-Member", "true")
            ->get("/cookie/get")
            ->assertJson([
                "userId" => "budhi",
                "isMember" => "true"
            ]);

        /**
         * result:
         * [{
         * "userId": "budhi",
         * "isMember": "true"
         * }].
         */

    }

}
