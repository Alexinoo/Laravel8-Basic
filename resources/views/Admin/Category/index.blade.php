<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              All categories     
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            <div class="card">
                        <div class="card-header">
                               All categories
                                </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category name</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i=1) --}}
                                @foreach($categories as $key => $category)
                                      <tr>
                                         <td>{{ $categories->firstItem() + $loop->index }}</td>
                                         <td>{{ $category->category_name}}</td>
                                         <td>{{ $category->user->name}}</td>
                                         <td>
                                            @if($category->created_at)
                                                {{Carbon\Carbon::parse( $category->created_at)->diffForHumans() }}
                                            @else
                                                <span class="text-danger">No Date Set</span>
                                            @endif                                           
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                    </tbody>
                                </table>
                            {{$categories->links()}}
                       </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category')}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" />
                                    @error('category_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <input type="submit" value="Submit"
                                     class="btn btn-primary w-100 " />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>        
    </div>
</x-app-layout>
