@extends('layouts.backend.admin_master')

@section('content')    

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h5 class="m-3">
                <a href="{{url('slider-add')}}"class ="btn btn-info float-right ">Add slider</a></h5>
                <div class="col-md-12">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            <div class="card">
                        <div class="card-header">
                               All slider
                                </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i=1) --}}
                                @foreach($sliders as $key => $slider)
                                      <tr>
                                         <td>{{ $sliders->firstItem() + $loop->index }}</td>
                                         <td>{{ $slider->title}}</td>
                                         <td>{{ $slider->description}}</td>
                                         <td><img src="{{ asset('image/slider/'.$slider->image)}}" alt="logo"  style="max-width:60px;height:50px"/>
                                        </td>
                                        
                                            <td>
                                                <a href="{{url('slider/edit/'.$slider->id)}}" class="btn btn-info btn-sm">Edit</a>

                                                <a href="{{url('slider/delete/'.$slider->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure you want to delete this brand..?')">Delete</a>
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                    </tbody>
                                </table>
                            {{$sliders->links()}}
                       </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    @endsection