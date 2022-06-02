<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FacedeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = config("contoh.author.first_name");
        $firstName2 = Config::get("contoh.author.first_name");

        self::assertEquals($firstName1, $firstName2);

        var_dump(Config::all());
    }

    public function testConfigDependency()
    {
        $config = $this->app->make("config");
        $firstName3 = $config->get("contoh.author.first_name");

        $firstName1 = config("contoh.author.first_name");
        $firstName2 = Config::get("contoh.author.first_name");

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);

        var_dump($config->all());
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with("contoh.author.first_name")
            ->addReturn("Adi Hebat");

        $firstName = Config::get("contoh.author.first_name");

        self::assertEquals("Adi Hebat", $firstName);
    }

}
