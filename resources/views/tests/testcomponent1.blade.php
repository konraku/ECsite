<x-tests.app>
    <x-slot name="unko">
        header1
    </x-slot>
    うんち

    <x-tests.card title="タイトル" content="本文" :message='$message'/>
    <div>{{ $data }}</div>
</x-tests.app>