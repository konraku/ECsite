<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestComponent extends Controller
{
    //テスト
    public function showComponent1(){
        return view('tests.testcomponent1');
    }
    public function showComponent2(){
        return view('tests.testcomponent2');
    }
}
