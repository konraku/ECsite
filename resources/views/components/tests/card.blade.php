<!--propsを定義する時は存在する変数を全て指定.-->
@props([
    'title',
    'message' => '初期値',
    'content' => '初期値'
]);
<div class="border-2 shadow-md w-1/4 p-2">
    <div>{{ $title }}</div>
    <div>画像</div>
    <div>{{ $content }}</div>
    <div>{{ $message }}</div>
</div>