@extends('layouts.backend.admin_master')

@section('content')    
<div class="col-md-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Create Slider</h2>
				</div>
		<div class="card-body">
		<form action="{{ route('store.slider')}}" method="POST" enctype="multipart/form-data">
             @csrf
           <div class="form-group">
                <label for="title">Slider Title</label>
                <input type="text" name="title" id="title" class="form-control" />
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="description">Slider Description</label>
                <textarea name="description" id="description"  rows="3" class="form-control"></textarea>
            @error('description')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">Slider Image</label>
            <input type="file" name="image" id="image" class="form-control" />
            @error('image')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection