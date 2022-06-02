<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependecy()
    {
        $foo1 = $this->app->make(Foo::class); // new foo()
        $foo2 = $this->app->make(Foo::class); // new foo()

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('Supriadi', 'Roadman');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Supriadi', $person1->firstName);
        self::assertEquals('Supriadi', $person2->firstName);

        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Supriadi', 'Roadman');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Supriadi', $person1->firstName);
        self::assertEquals('Supriadi', $person2->firstName);

        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        $person = new Person("Supriadi", "Roadman");

        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);
        $person3 = $this->app->make(Person::class);
        $person4 = $this->app->make(Person::class);

        self::assertEquals('Supriadi', $person1->firstName);
        self::assertEquals('Supriadi', $person2->firstName);

        self::assertSame($person, $person1);
        self::assertSame($person1, $person2);
        self::assertSame($person2, $person3);
        self::assertSame($person3, $person4);
    }

    public function testDependecyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
    }

    public function testDependecyInjectionClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);
    }

    public function testInterfaceToClass()
    {
       // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class); //cara 1

        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloServiceIndonesia::class);

        self::assertEquals("Halo Adi", $helloService->hello('Adi'));
    }

}
