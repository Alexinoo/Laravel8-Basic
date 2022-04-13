@extends('layouts.backend.admin_master')

@section('content')    

    <div class="py-12">
        <div class="container">
            <div class="row">              
                <div class="col-md-12">
                  <div class="card">
                        <div class="card-header">
                               Admin Message
                                </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i=1) --}}
                                @foreach($messages as $key => $message)
                                      <tr>
                                         <td>{{ $messages->firstItem() + $loop->index }}</td>
                                         <td>{{ $message->name}}</td>
                                         <td>{{ $message->email}}</td>
                                         <td>{{ $message->subject}}</td>
                                         <td>{{ $message->message}}</td>
                                        
                                            <td>
                                                <a href="{{url('message/delete/'.$message->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure you want to delete this message..?')">Delete</a>
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                    </tbody>
                                </table>
                            {{$messages->links()}}
                       </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    @endsection