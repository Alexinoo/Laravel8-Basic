<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              All categories     
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
                            <th scope="col">User ID</th>
                            <th scope="col">Category name</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                         <td>1</td>
                         <td>User ID</td>
                         <td>Category name</td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        </div>

        
    </div>
</x-app-layout>
