<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{

    public function testCreateSession()
    {

        $this->get("/session/create")
            ->assertSeeText("OK")
            ->assertSessionHas("userId", "budhioct")
            ->assertSessionHas("isMember", "true");

        /**
         * result:
         * jadi session yang telah di buat akan di simpan di file (default laravel), lokasi file ../framework/session/file_session
         * name file: dhsz957TV1cHguSHgq9LdA52ler4rDuOnk1sgb6i (hanya key session)
         * isi  file: a:5:{s:6:"_token";s:40:"DXX2yceSkCk9wNZnPfTvl2EQi8wzwqjBFJ7JkKz3";s:6:"userId";s:8:"budhioct";s:8:"isMember";s:4:"true";s:9:"_previous";a:1:{s:3:"url";s:36:"http://127.0.0.1:8000/session/create";}s:6:"_flash";a:2:{s:3:"old";a:0:{}s:3:"new";a:0:{}}}
         */
    }

    public function testGetSession(){

        $this->withSession([
            "userId" => "budhioct",
            "isMember" => "true",
        ])->get("/session/get")
            ->assertSeeText("User Id: budhioct, Is Member: true");

        /**
         * result:
         * jadi session yang telah di buat akan di simpan di file (default laravel), lokasi file ../framework/session/file_session
         * name file: aL6t2F5ZryB1DkXbuYUOEUUhgejihFyCAkLx7ry3 (hanya key session)
         * isi  file: a:5:{s:6:"_token";s:40:"waHAbTYNiHqyv4ixiflawwGn2tEpOTQErgjx9uBU";s:6:"userId";s:8:"budhioct";s:8:"isMember";s:4:"true";s:9:"_previous";a:1:{s:3:"url";s:28:"http://localhost/session/get";}s:6:"_flash";a:2:{s:3:"old";a:0:{}s:3:"new";a:0:{}}}
         */
    }

}
