<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Multi Pictures 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row ">
                <div class="col-md-8">                
                     <div class="card-group">
                        @foreach($images as $key => $image)
                           <div class="col-md-4 mt-5">
                               <div class="card">
                                   <img src="{{asset('/image/multi/'.$image->image)}}" alt="img">
                               </div>
                            </div> 
                        @endforeach
                       </div>
                    </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Multi Image</div>
                        <div class="card-body">
                            <form action="{{route('store.multi-image')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                <div class="form-group mb-3">
                                    <label for="images">Choose images</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple="" />
                                    @error('images')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                 <div class="form-group">
                                    <input type="submit" value="Add Image"
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
