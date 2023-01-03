<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LifeCycleTestController extends Controller
{
    //
    public function showSeviceContainerTest(){
        app()->bind('lifeCycleTest', function()
        {
            return 'hello';
        });

        $test = app()->make('lifeCycleTest');
        $test2 = app('Illuminate\Cache\RateLimiter');

        /*サービスコンテナなしのパターン*/
        /*
        $message = new Message();
        $sample = new Sample($message);
        $sample->run();
        */

        /*サービスコンテナありのパターン (依存関係を解決)*/
        app()->bind('sample', Sample::class);
        $sample = app()->make('sample');
        $sample->run();

        
        dd($test, $test2, app());
    }
}

//依存性注入【DI】Dependency Injection。引数にクラスを入れると自動でインスタンス化する
class Sample{
    public $message;
    public function __construct(Message $message){
        $this->message = $message;

    }
    public function run(){
        $this->message->send();
    }
}

class Message{
    public function send(){
        echo('メッセージ表示');
    }
}