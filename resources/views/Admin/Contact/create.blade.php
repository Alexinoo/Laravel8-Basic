@extends('layouts.backend.admin_master')

@section('content')    
<div class="col-md-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>Create Contact</h2>
				</div>
		<div class="card-body">
		<form action="{{ route('store.contact')}}" method="POST" >
             @csrf
           <div class="form-group">
                <label for="address">Contact address</label>
               <textarea name="address" id="address"  rows="3" class="form-control"></textarea>
                @error('address')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
            <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" />
            @error('email')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" />
            @error('phone')
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