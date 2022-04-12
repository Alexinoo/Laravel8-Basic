@extends('layouts.backend.admin_master')

@section('content')    

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h5 class="m-3">
                <a href="{{url('about/add')}}"class ="btn btn-info float-right ">Add more content</a></h5>
                <div class="col-md-12">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                            <div class="card">
                        <div class="card-header">
                              About Section
                                </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"  width="10%">Title</th>
                                        <th scope="col" width="25%">Short Desc</th>
                                        <th scope="col"  width="45%">Long Desc</th>
                                        <th scope="col"  width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                {{-- @php($i=1) --}}
                                @foreach($abouts as $key => $about)
                                      <tr>
                                         <td>{{ $abouts->firstItem() + $loop->index }}</td>
                                         <td>{{ $about->title}}</td>
                                         <td>{{ $about->short_desc}}</td>
                                         <td>{{ $about->long_desc}}</td>
                                      
                                            <td>
                                                <a href="{{url('about/edit/'.$about->id)}}" class="btn btn-info btn-sm">Edit</a>

                                                <a href="{{url('about/delete/'.$about->id)}}" class="btn btn-danger btn-sm" onclick=" return confirm('Are you sure you want to delete this content..?')">Delete</a>
                                            </td>
                                    </tr>
                                @endforeach
                                  
                                    </tbody>
                                </table>
                            {{$abouts->links()}}
                       </div>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    @endsection