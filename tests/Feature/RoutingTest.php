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


}
