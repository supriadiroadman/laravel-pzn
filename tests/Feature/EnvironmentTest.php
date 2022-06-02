<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;
use function Ramsey\Uuid\v1;

class EnvironmentTest extends TestCase
{
    public function testGetEnv()
    {
        $youtube = env('YOUTUBE');
        self::assertEquals('Supriadi Roadman', $youtube);
    }

    public function testDefaultValue()
    {
        $author = env('AUTHOR', 'adi');
        self::assertEquals('adi', $author);
    }

}
