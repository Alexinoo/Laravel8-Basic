@extends('layouts.backend.admin_master')

@section('content')    

    <div class="py-12">
        <div class="container">
            <div class="row">         
                <div class="col-md-12">
                     @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ url('slider/update/'.$slider->id )}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title">UpdateTitle</label>
                                    <input type="text" name="title" id="title" class="form-control"  value="{{$slider->title}}"/>
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="description">Update Description</label>
                                    <input type="text" name="description" id="description" class="form-control"  value="{{$slider->description}}"/>
                                    @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="image">Update Slider Image</label>
                                    <input type="file" name="image" id="image" class="form-control" value="{{ $slider->image}}"/>
                                    @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                  <img src="{{ asset('image/slider/'.$slider->image)}}" alt="logo"  style="max-width:150px;height:120px"/>
                                </div>
                                 <div class="form-group">
                                    <input type="submit" value="Update Slider"
                                     class="btn btn-primary w-100 " />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    @endsection
