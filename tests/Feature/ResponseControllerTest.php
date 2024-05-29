<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{

    public function testResponse(){

        $this->get("/response/hello")
            ->assertStatus(200)
            ->assertSeeText("hello response");

    }

    public function testHeaderResponse(){

        $this->get("/response/header")
            ->assertStatus(200)
            ->assertSeeText("budhi")
            ->assertSeeText("octaviansyah")
            ->assertHeader("Content-Type", "application/json")
            ->assertHeader("Author", "budioct")
            ->assertHeader("App", "Belajar Laravel");

    }

    public function testViewResponse(){

        $this->get("/response/type/view")
            ->assertSeeText("Hello budhi");

    }

    public function testJsonResponse(){

        $this->get("/response/type/json")
            ->assertJson([
                "firstName" => "budhi",
                "lastName" => "oct"
            ]);

    }

    public function testFileResponse(){

        $this->get("/response/type/file")
            ->assertHeader("Content-type", "image/png");

    }

    public function testDwonload(){

        $this->get("/response/type/dwonload")
            ->assertDownload("lfc.png");

    }

}
