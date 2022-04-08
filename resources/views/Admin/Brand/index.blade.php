<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              All brands     
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
                               All brands
                                </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Brand  name</th>
                                        <th scope="col">Brand  image</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i=1) --}}
                                @foreach($brands as $key => $brand)
                                      <tr>
                                         <td>{{ $brands->firstItem() + $loop->index }}</td>
                                         <td>{{ $brand->brand_name}}</td>
                                         <td><img src="{{ asset('image/brand/'.$brand->brand_image)}}" alt="logo"  style="max-width:60px;height:50px"/>
                                        </td>
                                         <td>
                                            @if($brand->created_at)
                                                {{Carbon\Carbon::parse( $brand->created_at)->diffForHumans() }}
                                            @else
                                                <span class="text-danger">No Date Set</span>
                                            @endif                                           
                                            </td>
                                            <td>
                                                <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-info btn-sm">Edit</a>

                                                <a href="{{url('brand/delete/'.$brand->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure you want to delete this brand..?')">Delete</a>
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                    </tbody>
                                </table>
                            {{$brands->links()}}
                       </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('store.brand')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" name="brand_name" id="brand_name" class="form-control" />
                                    @error('brand_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand_image">Brand Name</label>
                                    <input type="file" name="brand_image" id="brand_image" class="form-control" />
                                    @error('brand_image')
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
