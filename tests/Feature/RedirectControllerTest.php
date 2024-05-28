<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
{

    public function testRedirect(){

        $this->get("/redirect/from")
            ->assertRedirect("/redirect/to");

    }

    public function testRedirectName(){

        $this->get("/redirect/name")
            ->assertRedirect("/redirect/name/budhi")
            ->assertSeeText("budhi");

    }

    public function testRedirectActionController(){

        self::get("/redirect/action")
            ->assertRedirect("/redirect/name/budhi")
            ->assertSeeText("budhi");

    }

    public function testRedirectAway(){

        self::get("/redirect/away")
            ->assertRedirect("https://www.goal.com/id");

    }

}
