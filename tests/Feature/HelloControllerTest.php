<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHello()
    {
        $this->get('/controller/hello')
            ->assertSeeText("Hello World");
    }

    public function testHalo()
    {
        $this->get('/controller/halo/adi')
            ->assertSeeText("Halo adi");
    }

    public function testRequest()
    {
        $this->get('/controller/hello/request', [
            'Accept' => 'plain/text'
        ])->assertSeeText('controller/hello/request')
            ->assertSeeText('http://lara-9.test/controller/hello/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }


}
