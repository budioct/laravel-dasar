<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
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

    /**
     * Mengubah Cara Membuat Dependency
     * ● Saat kita menggunakan function make(key), secara otomatis Laravel akan membuat object, namun
     *   kadang kita ingin menentukan cara pembuatan objectnya
     * ● Pada kasus seperti ini, kita bisa menggunakan method bind(key, closure)
     * ● Kita cukup return kan data yang kita inginkan pada function closure nya
     * ● Saat kita menggunakan make(key) untuk mengambil dependencynya, secara otomatis function
     *   closure akan dipanggil
     * ● Perlu diingat juga, setiap kita memanggil make(key), maka function closure akan selalu dipanggil,
     *   jadi bukan menggunakan object yang sama
     */

    public function testBinding()
    {

        // $this->app->bind(class, {method_closure}); // cukup return method_closure nanti akan di panggil ketika proses initialize
        $this->app->bind(Person::class, function ($app) {
            return new Person("budhi", "octaviansyah");
        }); // app->bind(class) //

        $person1 = $this->app->make(Person::class); // app->make(class) // initialize new class // akan selalu membuat object baru
        $person2 = $this->app->make(Person::class);

        self::assertEquals("budhi", $person1->firstName); // $person1
        self::assertEquals("octaviansyah", $person1->lastName);
        self::assertEquals("budhi", $person2->firstName); // $person2
        self::assertEquals("octaviansyah", $person1->lastName);

        self::assertNotSame($person1, $person2); // $person1 dan $person2 bukanlah objek yang sama secara identik

    }

    /**
     * Singleton
     * ● Sebelumnya ketika menggunakan make(key), maka secara default Laravel akan membuat object
     *   baru, atau jika menggunakan bind(key, closure), function closure akan selalu dipanggil
     * ● Kadang ada kebutuhan kita membuat object singleton, yaitu satu object saja, dan ketika butuh, kita
     *   cukup menggunakan object yang sama
     * ● Pada kasus ini, kita bisa menggunakan function singleton(key, closure), maka secara otomatis
     *   ketika kita menggunakan make(key), maka object hanya dibuat di awal, selanjutnya object yang
     *   sama akan digunakan terus menerus ketika kita memanggil make(key)
     */

    public function testSingleton(){

        // $this->app->singleton(class, {method_closure}); // cukup return method_closure nanti akan di panggil ketika proses initialize
        $this->app->singleton(Person::class, function ($app) {
            return new Person("budhi", "octaviansyah");
        }); // app->bind(class) //

        $person1 = $this->app->make(Person::class); // $person // app->make(class) // initialize object akan selalu sama secara identik
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertEquals("budhi", $person1->firstName); // $person1
        self::assertEquals("octaviansyah", $person1->lastName);
        self::assertEquals("budhi", $person2->firstName); // $person2
        self::assertEquals("octaviansyah", $person1->lastName);

        self::assertSame($person1, $person2); // $person1 dan $person2 objek yang sama secara identik

    }

    /**
     * Instance
     * ● Selain menggunakan function singleton(key, closure), untuk membuat singleton object, kita juga
     *   bisa menggunakan object yang sudah ada, dengan cara menggunakan function instance(key, object)
     * ● Ketika menggunakan make(key), maka instance object tersebut akan dikembalikan
     */

    public function testInstance()
    {
        $person = new Person("budhi", "octaviansyah");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person // initialize object akan selalu sama secara identik
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertEquals("budhi", $person1->firstName); // $person1
        self::assertEquals("octaviansyah", $person1->lastName);
        self::assertEquals("budhi", $person2->firstName); // $person2
        self::assertEquals("octaviansyah", $person1->lastName);

        self::assertSame($person1, $person2);
    }

}
