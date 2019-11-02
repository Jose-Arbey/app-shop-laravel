<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{

    public function home(){
        return view('welcome');
    }

    public function verSuma(){
      $a = 10;
      $b = $a + $a;
      return '<h1>La suma de '.$a.' + '.$a.' es: '.$b.'</h1>';
    }
}
