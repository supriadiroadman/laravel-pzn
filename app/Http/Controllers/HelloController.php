<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }

    public function hello(): string
    {
        return "Hello World";
    }

    public function Halo(string $name): string
    {
        return $this->helloService->hello($name);
    }
}
