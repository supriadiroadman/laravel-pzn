<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request)
    {
        $name = $request->input('name');
        return "Hello $name";
    }

    public function helloFirstName(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    public function helloInput(Request $request): string
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function helloArray(Request $request)
    {
        $products = $request->input('products.*.name');
        return json_encode($products);
    }

    public function inputType(Request $request)
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birthDate = $request->date('birth_data', 'Y-m-d');

        return json_encode([
            "name" => $name,
            "married" => $married,
            "birth_date" => $birthDate->format('Y-m-d')
        ]);
    }
}