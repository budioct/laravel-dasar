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

    public function testInputType(){

        $this->post("/inpute/type", [
            "name" => "budhi",
            "married" => "false",
            "birth_data" => "1996-10-22"
        ])
            ->assertSeeText("budhi")
            ->assertSeeText("false")
            ->assertSeeText("1996-10-22");

    }

    public function testFilterOnly(){

        $this->post("/input/filter/only", [
            "name" => [
                "first" =>"budhi",
                "middle" =>"22",
                "last" =>"octaviansyah",
            ]
        ])
            ->assertSeeText("budhi")
            ->assertSeeText("octaviansyah")
            ->assertDontSeeText("22");

        // "middle" =>"22" // akan di abaikan karena tidak di sebut dalam parameter only([name.first, name.last])

    }

    public function testFilterExcept(){

        $this->post("/input/filter/except", [
            "username" => "budioct",
            "password" => "rahasia",
            "admin" => "true",
        ])
            ->assertSeeText("budioct")
            ->assertSeeText("rahasia")
            ->assertDontSeeText("true");

        // "admin" => "true" // akan di abaikan karena di sebut dalam parameter except([admin])

    }

    public function testFilterMerge(){

        $this->post("/input/filter/merge", [
            "username" => "budioct",
            "password" => "rahasia",
            "admin" => "true",
        ])
            ->assertSeeText("budioct")
            ->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false")
            ->assertDontSeeText("true");

        // "admin" => "true" // akan di set default value karena di sebut dalam parameter merge(["admin" => false])

    }


}
