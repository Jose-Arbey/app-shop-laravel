<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class TestController extends Controller
{

    public function welcome(){
        $products = Product::paginate(9);
        return view('welcome')->with(compact('products'));
    }

    // public function verSuma(){
    //   $a = 10;
    //   $b = $a + $a;
    //   return '<h1>La suma de '.$a.' + '.$a.' es: '.$b.'</h1>';
    // }
}
