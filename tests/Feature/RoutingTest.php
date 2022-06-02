<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/srs')
            ->assertStatus(200)
            ->assertSeeText("Hello Supriadi Roadman");
    }

    public function testRedirect()
    {
        $this->get('/youtube')
            ->assertRedirect('/srs');
    }

    public function testFallback()
    {
        $this->get('/tidakada')
            ->assertSeeText('404 By Supriadi');

        $this->get('/tidakadalagi')
            ->assertSeeText('404 By Supriadi');

        $this->get('/ups')
            ->assertSeeText('404 By Supriadi');
    }

    public function testRouteParameter()
    {
        $this->get('products/1')
            ->assertSeeText('Product 1');

        $this->get('products/2')
            ->assertSeeText('Product 2');

        $this->get('products/1/items/XXX')
            ->assertSeeText('Product 1, Item XXX');

        $this->get('products/2/items/YYY')
            ->assertSeeText('Product 2, Item YYY');
    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/1')
            ->assertSeeText("Category 1");

        $this->get('/categories/bukan-angka')
            ->assertSeeText("404 By Supriadi");
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/12345')
            ->assertSeeText("User 12345");

        $this->get('/users')
            ->assertSeeText("User 404");
    }

    public function testRouteConflict()
    {
        $this->get('/conflict/adi')
            ->assertSeeText("Conflict Supriadi Roadman Siagian");

        $this->get('/conflict/budi')
            ->assertSeeText("Conflict budi");
    }

}
