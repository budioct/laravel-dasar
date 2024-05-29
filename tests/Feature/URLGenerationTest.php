<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLGenerationTest extends TestCase
{

    /**
     * URL Generation
     * ● Laravel menyediakan beberapa cara untuk membuat URL di aplikasi kita
     * ● Ini sangat berguna ketika kita butuh membuat link di View atau Response
     *
     * Current URL
     * ● Kadang kita ingin mengakses URL Saat ini, sebenarnya kita bisa menggunakan object Request
     * ● Namun jika dalam keadaan tidak ada object Request, kita bisa menggunakan class Illuminate\Routing\UrlGenerator
     * ● Untuk membuat class UrlGenerator, kita bisa menggunakan helper function url() atau facade URL
     * ● url()->current() untuk mendapatkan url saat ini tanpa query param
     * ● url()->full() untuk mendapatkan url saat ini dengan query param
     *
     * URL untuk Named Routes
     * ● URLGenerator juga bisa digunakan untuk membuat link menuju named routes
     * ● Kita bisa menggunakan method route(name, parameters) atau URL::route(name, parameters) atau
     *   url()->route(name, parameters)
     *
     * URL untuk Controller Action
     * ● URLGenerator juga bisa digunakan untuk membuat link menuju controller action
     * ● Laravel secara otomatis akan mencarikan path yang sesuai di route dengan controller action tersebut
     * ● Kita bisa menggunakan method action(controllerAction, parameters), atau
     *   URL::action(controllerAction, parameters), atau url()->action(controllerAction, parameters)
     */

    public function testCurrent(){

        $this->get("/url/current?name=budhi")
            ->assertSeeText("/url/current?name=budhi");
        /**
         * result:
         * // url() static method
         *
         * return url()->current(); // current() // untuk mendapatkan url saat ini tanpa query param
         * http://127.0.0.1:8000/url/current
         *
         * return url()->full(); // full() untuk mendapatkan url saat ini dengan query param
         * http://127.0.0.1:8000/url/current?name=budhi
         */
    }

    public function testNamed(){

        $this->get("/redirect/named")
            ->assertSeeText("/redirect/name/budhi");

        /**
         * result:
         * dari : http://127.0.0.1:8000/redirect/namedd
         *
         * redirect : http://127.0.0.1:8000/redirect/name/budhi
         */
    }

    public function testAction(){

        $this->get("/url/action")
            ->assertSeeText("/form");

        /**
         * result:
         * http://127.0.0.1:8000/form
         */

    }



}
