<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{

    public function testHelloController()
    {
        $this->get("/controller/hello")
            ->assertStatus(200)
            ->assertSeeText('Hello World!');

    }

    public function testHelloControllerWithDependencies()
    {
        $this->get("/controller/hello/budhi")
            ->assertStatus(200)
            ->assertSeeText('Halo budhi');

    }

}
