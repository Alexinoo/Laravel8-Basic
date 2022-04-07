<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              All categories     
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                          <h5>Edit Category
                              <a href="{{ route('all.category')}}" class="btn btn-info btn-sm float-end">Back</a></h5>  
                        </div>
                        <div class="card-body">
                            <form action="{{ url('category/update/'.$category->id)}}" method="POST">                                
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" value="{{$category->category_name}}"/>
                                    @error('category_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <input type="submit" value="Update"
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
