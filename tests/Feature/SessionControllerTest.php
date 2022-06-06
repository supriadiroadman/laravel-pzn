<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas('userId', 'Supriadi')
            ->assertSessionHas('isMember', true);
    }

    public function testTestGetSession()
    {
        $this->withSession([
            'userId' => 'Supriadi',
            'isMember' => 'true'
        ])->get('/session/get')
            ->assertSeeText('Supriadi')->assertSeeText('true');
    }

    public function testTestGetSessionFalse()
    {
        $this->withSession([])->get('/session/get')
            ->assertSeeText('guest')->assertSeeText('false');
    }


}
