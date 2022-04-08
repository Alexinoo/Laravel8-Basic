<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              All brands     
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">         
                <div class="col-md-6 offset-md-3">
                     @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brand->id )}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="brand_name">Update Brand Name</label>
                                    <input type="text" name="brand_name" id="brand_name" class="form-control"  value="{{$brand->brand_name}}"/>
                                    @error('brand_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="brand_image">Update Brand Name</label>
                                    <input type="file" name="brand_image" id="brand_image" class="form-control" value="{{ $brand->brand_image}}"/>
                                    @error('brand_image')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                  <img src="{{ asset('image/brand/'.$brand->brand_image)}}" alt="logo"  style="max-width:150px;height:120px"/>
                                </div>
                                 <div class="form-group">
                                    <input type="submit" value="Update Brand"
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
