<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=adi')
            ->assertSeeText("Hello adi");

        $this->post('/input/hello', ['name' => 'adi'])
            ->assertSeeText("Hello adi");
    }

    public function testNestedInput()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'adi'
            ]
        ])
            ->assertSeeText('Hello adi');
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Supriadi',
                'last' => 'Roadman'
            ]
        ])->assertSeeText('name')
            ->assertSeeText('first')->assertSeeText('last')
            ->assertSeeText('Supriadi')->assertSeeText('Roadman');
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    'name' => 'Macbook',
                    'price' => 10000000
                ],
                [
                    'name' => 'Samsung',
                    'price' => 15000000
                ]
            ]
        ])->assertSeeText('Macbook')
            ->assertSeeText('Samsung');
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Supriadi',
            'married' => 'true',
            'birth_date' => '1988-06-20'
        ])->assertSeeText('Supriadi')->assertSeeText('true')->assertSeeText('1988-06-20');
    }

    public function testfilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Supriadi",
                "middle" => "Roadman",
                "last" => "Siagian"
            ]
        ])->assertSeeText("Supriadi")->assertSeeText("Siagian")
            ->assertDontSeeText("Roadman");
    }

    public function testfilterExcept()
    {
        $this->post('/input/filter/except', [
            "username" => "Supriadi",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Supriadi")->assertSeeText("rahasia")
            ->assertDontSeeText("admin");
    }

    public function testfilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "Supriadi",
            "admin" => "true",
            "password" => "rahasia"
        ])->assertSeeText("Supriadi")->assertSeeText("rahasia")
            ->assertSeeText("admin")->assertSeeText("false");
    }


}
