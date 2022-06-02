<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Supriadi');

        $this->get('/hello-again')
            ->assertSeeText('Hello Supriadi');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Supriadi');
    }

    public function testTemplate()
    {
        $this->view('hello', ['name' => 'Supriadi'])
            ->assertSeeText("Hello Supriadi");

        $this->view('hello.world', ['name' => 'Supriadi'])
            ->assertSeeText("World Supriadi");
    }


}
