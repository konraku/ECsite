<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestComponent extends Controller
{
    //テスト
    public function showComponent1(){
        $message = '123';
        $data = 'hello';
        return view('tests.testcomponent1',compact('message', 'data'));
    }
    public function showComponent2(){
        return view('tests.testcomponent2');
    }
}
