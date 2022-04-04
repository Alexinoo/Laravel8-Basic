<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Hi.. <b>{{Auth::user()->name }}</b>
        <b style="float: right;">Total Users
        <span class="badge rounded-pill bg-primary">{{ count($users)}}</span>
        </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
               <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($i = 1)
                        @foreach($users as $key => $value)
                        <tr>
                          <td>{{ $i++}}</td>
                          <td>{{$value->name}}</td>
                          <td>{{$value->email}}</td>
                          {{-- <td>{{$value->created_at->diffForHumans()}}</td> --}}
                          <td>{{ Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>

        
    </div>
</x-app-layout>
