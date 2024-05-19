<?php

namespace Tests\Feature;

use App\Data\Foo;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{

    /**
     * Service Container
     * ● Sebelumnya kita sudah mencoba melakukan Dependency Injection secara manual
     * ● Laravel memiliki fitur Dependency Injection secara otomatis, dan ini wajib dikuasai agar lebih
     *   mudah membuat aplikasi menggunakan Laravel
     * ● Di Laravel fitur ini bernama Service Container, dimana Service Container ini merupakan fitur yang
     *   digunakan untuk manajemen dependencies dan juga dependency injection
     *
     * Application Class
     * ● Service Container di Laravel direpresentasikan dalam class bernama Application
     * ● Kita tidak perlu membuat class Application secara manual, karena semua sudah dilakukan secara
     *   otomatis oleh framework Laravel
     * ● Di semua project Laravel, hampir disemua bagian terdapat field $app yang merupakan instance
     *   dari Application
     * ● https://laravel.com/api/9.x/Illuminate/Foundation/Application.html
     *
     * Membuat Dependency
     * ● Dengan menggunakan Service Container, kita tidak perlu membuat object secara manual lagi
     *   menggunakan kata kunci new
     * ● Kita bisa menggunakan function make(key) yang terdapat di class Application untuk membuat
     *   dependency secara otomatis
     * ● Saat kita menggunakan make(key), object akan selalu dibuat baru, jadi harap hati-hati ketika
     *   menggunakannya, karena dia bukan menggunakan object yang sama
     */

    public function testDependecyWithServiceContainer()
    {

        $foo1 = $this->app->make(Foo::class); // app->make(class) // initialize new class // akan selalu membuat object baru
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo1->foo());
        self::assertEquals("Foo", $foo2->foo());

        self::assertNotSame($foo1, $foo2); // foo1 dan foo2 bukanlah objek yang sama secara identik

    }

}
