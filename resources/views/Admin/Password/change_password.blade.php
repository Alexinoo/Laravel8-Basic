@extends('layouts.backend.admin_master')

@section('content')    

    <div class="row">
        <div class="col-md-4">
            <div class="">
                <h4>Update Password</h4>
                <br>
                <p>Ensure your account is using a long , random password to stay secure</p>
            </div>
        </div>
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Change Password</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('password.update')}}" method="POST" class="form-pill">
                            @csrf
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password" />
                                @error('current_password')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" name="password" placeholder="New Password" />
                                 @error('password')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
                                  @error('password_confirmation')
                                    <span class="text-danger">{{ $message}}</span>
                                @enderror
                            </div>
                            <div class="form-group text-right">
                             
                                <input type="submit" class="btn btn-primary" value="Save" />
                            </div>
                         
                        </form>
                    </div>
                </div>

            </div>

        </div>

@endsection