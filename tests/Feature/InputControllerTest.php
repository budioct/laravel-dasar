<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{

    public function testInput()
    {
        $this->get("/input/hello?name=budhi")
            ->assertSeeText("Hello budhi");

        // jika inging melakukan http post di laravel selalu sertakan token: csrf_token().. jika tidak session expire status_code 419
        $this->post("/input/hello", [
            "name" => "budhi",
            "_token" => csrf_token() // suapaya input masuk di kenali oleh laravel, supaya tidak terkena csrf_token
        ])->assertSeeText("Hello budhi");
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "_token" => csrf_token(),
            "name" => [
                "first" => "budhi",
            ]
        ])->assertSeeText("Hello budhi");

    }

    public function testCollectInputAll()
    {

        $this->post("/input/hello/input", [
            "_token" => csrf_token(),
            "name" => [
                "first" => "budhi",
                "second" => "octaviansyah"
            ]
        ])
            ->assertSeeText("name")
            ->assertSeeText("first")
            ->assertSeeText("budhi")
            ->assertSeeText("second")
            ->assertSeeText("octaviansyah");

    }

    public function testArrayInput(){

        $this->post("/input/hello/array", [
            "_token" => csrf_token(),
            "products" => [
                ["name" => "Apple Mac Book Pro"],
                ["name" => "Samsung Galaxy S"],
            ]
        ])
            ->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Galaxy S");
    }

}
