<?php

namespace App\Services\ServicesImpl;

use App\Services\HelloService;

class HelloServiceIndonesia implements HelloService
{
    function hello(string $name): string
    {
        return "Halo $name";
    }

}
