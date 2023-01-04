<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestComponent extends Controller
{
    //テスト
    public function showComponent1(){
        $message = '123';
        $data = 'hello';
        //compact() 渡された複数の変数名をキーとする連想配列を返す
        return view('tests.testcomponent1',compact('message', 'data'));
    }
    public function showComponent2(){
        return view('tests.testcomponent2');
    }
}
