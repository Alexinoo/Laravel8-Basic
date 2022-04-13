@extends('layouts.backend.admin_master')

@section('content')    

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h5 class="m-3">
                <a href="{{url('contact-add')}}"class ="btn btn-outline-info">Add Contact</a></h5>
                <div class="col-md-12">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            <div class="card">
                        <div class="card-header">
                               All Contacts
                                </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i=1) --}}
                                @foreach($contacts as $key => $contact)
                                      <tr>
                                         <td>{{ $contacts->firstItem() + $loop->index }}</td>
                                         <td>{{ $contact->address}}</td>
                                         <td>{{ $contact->email}}</td>
                                         <td>{{ $contact->phone}}</td>
                                       
                                        
                                            <td>
                                                <a href="{{url('contact/edit/'.$contact->id)}}" class="btn btn-info btn-sm">Edit</a>

                                                <a href="{{url('contact/delete/'.$contact->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure you want to delete this contact..?')">Delete</a>
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                    </tbody>
                                </table>
                            {{$contacts->links()}}
                       </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    @endsection