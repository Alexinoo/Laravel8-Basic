@extends('layouts.backend.admin_master')

@section('content')    

    <div class="row">       
        <div class="col-md-4">
            <div class="">
                <h4>Update Profile</h4>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis quaerat quas temporibus quae facilis recusandae ratione quisquam ex. Deleniti, similique?</p>
            </div>
        </div>
            <div class="col-md-8">
                  @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                 {{ session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
             @endif
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>User Profile</h2>
                    </div>
                      
                    <div class="card-body">
                        <form action="{{ url('update-profile')}}" method="POST" class="form-pill">
                            @csrf
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" class="form-control" name="name"  value="{{ $user->name}}"/>                              
                            </div>

                            <div class="form-group">
                                <label for="email">User Email</label>
                                <input type="text" class="form-control" name="email"  value="{{ $user->email}}"/>                              
                            </div>
                        
                            <div class="form-group text-right">
                             
                                <input type="submit" class="btn btn-primary" value="Update" />
                            </div>
                         
                        </form>
                    </div>
                </div>

            </div>

        </div>

@endsection