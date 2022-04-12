@extends('layouts.backend.admin_master')

@section('content')    
<div class="col-md-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Edit About Content</h2>
				</div>
		<div class="card-body">
		<form action="{{ url('about/update/'.$about->id)}}" method="POST">
             @csrf
           <div class="form-group">
                <label for="title">Update About Title</label>
                <input type="text" name="title" id="title" class="form-control"  value="{{ $about->title}}"/>
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="short_desc">Update Short Description</label>
                <textarea name="short_desc"  id="short_desc" rows="3" class="form-control"> {{ $about->short_desc }}</textarea>
            @error('short_desc')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="long_desc">Update Long Description</label>
          <textarea name="long_desc" id="long_desc"  rows="5" class="form-control">{{ $about->long_desc }} </textarea>
            @error('long_desc')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                <button type="submit" class="btn btn-primary btn-default">Update content</button>
            </div>
          </form>
        </div>
    </div>
</div>
@endsection