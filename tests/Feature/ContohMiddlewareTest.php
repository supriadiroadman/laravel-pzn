<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    public function testInvalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValid()
    {
        $this->withHeader('X-API-KEY', 'SUPRIADI')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText('Middleware Ok');
    }

    public function testInvalidGroup()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValidGroup()
    {
        $this->withHeader('X-API-KEY', 'SUPRIADI')
            ->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText('Middleware Group');
    }

}
