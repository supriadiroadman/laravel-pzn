<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config("contoh.author.first_name");
        $lastName = config("contoh.author.last_name");
        $email = config("contoh.email");
        $web = config("contoh.web");

        self::assertEquals('Supriadi', $firstName);
        self::assertEquals('Roadman', $lastName);
        self::assertEquals('supriadiroadman@gmail.com', $email);
        self::assertEquals('https://www.supriadi.com', $web);
    }

}
