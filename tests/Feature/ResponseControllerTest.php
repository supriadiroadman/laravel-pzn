<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testResponse()
    {
        $this->get("/response/hello")
            ->assertStatus(200)
            ->assertSeeText("Hello Response");
    }

    public function testHeader()
    {
        $this->get('response/header')
            ->assertStatus(200)
            ->assertSeeText('Supriadi')->assertSeeText('Roadman')
            ->AssertHeader('Content-Type', 'aplication/json')
            ->AssertHeader('Author', 'Supriadi Roadman')
            ->AssertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Supriadi dari ResponseController');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                'first_name' => 'Supriadi',
                'last_name' => 'Roadman'
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/png');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('C++.png');
    }


}
