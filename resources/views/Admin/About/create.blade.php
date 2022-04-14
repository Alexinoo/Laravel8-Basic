@extends('layouts.backend.admin_master')

@section('content')    
<div class="col-md-12">
	<div class="card card-default">
		<div class="card-header card-header-border-bottom">
			<h2>About Content</h2>
				</div>
		<div class="card-body">
		<form action="" method="POST" id="about-form">
             @csrf
           <div class="form-group">
                <label for="title">About Title</label>
                <input type="text" name="title" id="title" class="form-control" />     
                <div id="dialog"></div>        
            </div>
            <div class="form-group">
            <label for="short_desc">Short Description</label>
                <textarea name="short_desc"  id="short_desc" rows="3" class="form-control"></textarea>
       <div id="dialog"></div>  
        </div>
        <div class="form-group">
            <label for="long_desc">Long Description</label>
          <textarea name="long_desc" id="long_desc"  rows="5" class="form-control"></textarea>
           
        </div>
            <div class="form-footer pt-4 pt-5 mt-4 border-top ">

                <button type="button" class="btn btn-info btn-default back-index" >Manage</button>

                <button type="submit" class="btn btn-primary btn-default ml-3" >Submit</button>

            </div>
          </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
        $(document).ready(function() {  

                 $("#about-form").on('submit',function(e){     
                     
                e.preventDefault()
             
                var vTitle     =   $('#title').val();
                var vShortdesc     =   $('#short_desc').val();
                var vLongdesc     =   $('#long_desc').val();
                                
                if ( vTitle === '')
                {
                    $('#title').focus();
                    openalert("Title cannot be blank.");
                    return false;
                } 

                if ( vShortdesc === '')
                {
                    $('#short_desc').focus();
                    openalert("Short Desc cannot be blank.");
                    return false;
                }   
                                
                if ( vLongdesc === '')
                {
                    $('#long_desc').focus();
                    openalert("Long desc cannot be blank.");
                    return false;
                }    

                let formdata = $('#about-form').serialize()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                        type: 'POST',
                        url: "{{ route('store.about') }}",
                        data: formdata, // here $(this) refers to the ajax object not form
                        success: function (response) {

                           if(response.status === 200 ){

                                 toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true,
                                "positionClass" : 'toast-top-right'
                            }
                          toastr.success(response.message);

                           $('#about-form')[0].reset()

                           }else{

                               toastr.options = {
                                "closeButton" : true,
                                "progressBar" : true,
                                "positionClass" : 'toast-top-right'
                            }
                          toastr.error(response.message);
                           }
                        },
                    });
                    
             });

                 $(".back-index").on('click',function(){  

                       window.location.href = "{{ route('home.about') }}" ;

                 });

    })
</script>
    
@endsection