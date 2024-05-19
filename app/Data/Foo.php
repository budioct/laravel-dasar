<?php

namespace App\Data;

class Foo
{

    /**
     * Dependency Injection
     * ● Di dalam pengembangan perangkat lunak, ada konsep yang namanya Dependency Injection
     * ● Dependency Injection adalah teknik dimana sebuah object menerima object lain yang dibutuhka
     *   atau istilahnya dependencies
     * ● Saat kita membuat object, sering sekali kita membuat object yang butuh object lain
     * ● https://en.wikipedia.org/wiki/Dependency_injection
     */

    function foo(): string
    {
        return "Foo";
    }

}
