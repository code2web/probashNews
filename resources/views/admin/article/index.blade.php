{{-- @extends('admin.layout_crud') --}}

@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-capitalize">article Page</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">article Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Article List</h3>
            <!-- Button trigger modal -->
            {{-- <a href="{{route('article.create')}}" id="create_modal" class="btn btn-primary ml-auto" data-bs-toggle="modal" data-bs-target="#createModal"> --}}
            <a formActionUrl="{{ route('article.store') }}" title="Creating" href="{{route('article.create')}}" id="BootModalShow" class="btn btn-primary ml-auto">
              Create Article
            </a>
            {{-- <h3 class="card-title">Create article</h3> --}}
          </div>
          <!-- /.card-header -->
          <input type="text" name="search" id="search" class="mb-1 form-control text-center" placeholder="Search Here...">
          <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Thumbnail</th>
                    <th>Category</th>
                    <th>District</th>
                    <th>Author</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($articles as $key => $article)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$article->title}}</td>
                    <td>{{$article->content}}</td>
                    <td>
                      {{-- <div> --}}
                        <img src="{{asset('storage/article/'.$article->thumbnail)}}" class="thumbnail img-fluid" style="height: 50px; object-fit: contain;">
                      {{-- </div> --}}
                    </td>
                    <td>hello}</td>
                    <td>hello}</td>
                    <td>hello}</td>

                    
                    <td class="d-flex">
                      <a formActionUrl="{{ route('article.update', $article->id) }}" title="Editing" href="{{ route('article.edit', $article->id) }}" id="BootModalShow" class="btn btn-success mr-1 update_article_form"
                        
                        >
                        <i class="fas fa-edit"></i>
                      </a>
                      <a title="Delete" href="" class="btn btn-danger delete_article"
                      >
                        <i class="fas fa-times"></i>
                      </a>
                    </td>
                  </tr>                                   
                  @empty
                  <tr><td colspan="8" class="text-center text-danger"><b>No DATA</b></td></tr>
                  @endforelse                                    
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      </div>      
    </div>    
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

{{-- @include('admin.article.create') --}}
{{-- @include('admin.article.edit') --}}

{{-- @yield('content') --}}

@endsection

@section('scripts')
{{-- <script src="{{asset('admin/plugins/jquery/jquery/jquery.min.js')}}"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}

<script>
$(document).ready(function(){
  let dialog = '';
  let formUrl = '';
  let formId = '';
  let Modaltitle = '';
  let successMsg = '';
  // modal show
  $(document).on('click', '#BootModalShow', function(e) {
    e.preventDefault();
    let ModalUrl = $(this).attr('href');
    // alert(ModalUrl);
    let Modaltitle = $(this).attr('title');
    let formUrl = $(this).attr('formActionUrl');
    
    // ajax
    $.ajax({
      type: "GET",
      url: ModalUrl,
      success: function(res){
          dialog = bootbox.dialog({
          title: 'Article '+Modaltitle+' Form',
          message: "<div class='ModalContent'></div>",
          size: 'large',          
        });
        $('.ModalContent').html(res);
        // formId
        formId = '#'+$('.ModalContent').find('form').attr('id');
      }
    });
  });

  // imgage preview
  $(document).on('change', '#thumbnail', function(e) {
    e.preventDefault();
    const file = this.files[0];
    if (file) {
      let reader = new FileReader();
      reader.onload = function(e) {
        $('.img-preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(file);
    }    
  });
// jQuery.support.cors = true;
  // form submit insert data
  $(document).on('submit', formId, function(e) {
    e.preventDefault();
    let formData = new FormData($(formId)[0]);
    // ajax
    $.ajax({
      type: "POST",
      url: formUrl,
      data: formData,
      processData: false,
      contentType: false,
      success: function(res){
        console.log(res);
        if (res.status == 400) 
        {
          $('.errors').html('');
          $('.errors').removeClass('d-none');
          
          $('.titleError').text(res.errors.title);
          $('.contentError').text(res.errors.content);
          $('.thumbnailError').text(res.errors.thumbnail);

          // $('.category_idError').text('res.errors.category_id');
          // $('.district_idError').text('res.errors.district_id');
        }
        else
        {
          $('.errors').html('');
          $('.errors').addClass('d-none');
          $('.table').load(location.href+' .table');
          dialog.modal('hide');
          // formId == '#create_article_form' ? successMsg = 'Created' : successMsg = 'Updated';
        }
      }
    });
  });

  



});
</script>
@endsection

{{-- @include('admin.article.ajax') --}}