<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContohMiddlewareParameterTest extends TestCase
{
    public function testInvalid()
    {
        $this->get('/middleware/parameter')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValid()
    {
        $this->withHeader('X-API-KEY', 'SUPRIADI')
            ->get('/middleware/parameter')
            ->assertStatus(200)
            ->assertSeeText('Middleware Parameter');
    }

    public function testInvalidGroup()
    {
        $this->get('/middleware/parameter')
            ->assertStatus(401)
            ->assertSeeText('Access denied');
    }

    public function testValidGroup()
    {
        $this->withHeader('X-API-KEY', 'SUPRIADI')
            ->get('/middleware/parameter')
            ->assertStatus(200)
            ->assertSeeText('Middleware Parameter');
    }
}
