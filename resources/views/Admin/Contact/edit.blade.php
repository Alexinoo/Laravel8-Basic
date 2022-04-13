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
                        <div class="card-header">Edit Contact</div>
                        <div class="card-body">
                            <form action="{{ url('contact/update/'.$contact->id )}}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="address">Update Address</label>
                                    <input type="text" name="address" id="address" class="form-control"  value="{{$contact->address}}"/>
                                    @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Update email</label>
                                    <input type="text" name="email" id="email" class="form-control"  value="{{$contact->email}}"/>
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone">Update phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone}}"/>
                                    @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                              
                                 <div class="form-group">
                                    <input type="submit" value="Update contact"
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
