<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Owners') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font mb-14">
                        <div class="container px-5 mx-auto">
                          <!--フラッシュメッセージ-->
                          <x-flash-message status="info"/>
                          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <div class="flex justify-end mb-4 ">
                              <button onclick="location.href='{{ route('admin.owners.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">create</button>
                            </div>
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                <tr>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">name</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">email</th>
                                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">create_at</th>
                                  <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                  <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($owners as $owner)
                                <tr>
                                  <td class="px-4 py-3">{{ $owner->id }}</td>
                                  <td class="px-4 py-3">{{ $owner->name }}</td>
                                  <td class="px-4 py-3">{{ $owner->email }}</td>
                                  <td class="px-4 py-3">{{ $owner->created_at }}</td>
                                  
                                  <!--edit-->
                                  <td class="w-10 text-center">
                                  <button onclick="location.href='{{ route('admin.owners.edit', ['owner' => $owner->id]) }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded ">edit</button>
                                  </td>
                                  
                                  <!--delete-->
                                  <form id="delete_{{ $owner->id }}" method="post" action="{{ route('admin.owners.destroy', ['owner' => $owner->id] )}}">
                                    @csrf
                                    @method('delete')
                                    <td class="w-10 text-center">
                                      <a hreh="#" data-id="{{ $owner->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded ">delete</a>
                                    </td>
                                  </form>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </section>
                    {{--
                    エロクアント
                    @foreach ($e_all as $e_owner)
                        {{ $e_owner->name }}
                        {{ $e_owner->created_at->diffForHumans() }}
                    @endforeach
                    <br>
                    クエリビルダ
                    @foreach ($q_get as $q_owner)
                        {{ $q_owner->name }}
                        {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}                
                    @endforeach
                    --}}
                </div>
            </div>
        </div>
    </div>
    <script>
      function deletePost(e) {
        'use strict';
        if(confirm('削除してもよろしいですか')){
          document.getElementById('delete_' + e.dataset.id).submit();
        }
      }
    </script>
</x-app-layout>
