{{-- @extends('admin.article.index')
@section('content') --}}
<!-- Modal -->
<form action="{{ route('article.store') }}" method="post" id="create_article_form" enctype="multipart/form-data">
  @csrf  
  <div class="form-group">
    <label for="title" class="text-capitalize">article title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="write title here">
    <div class="titleError errors text-danger d-none"></div>            
  </div>
  <div class="form-group">
    <label for="content" class="text-capitalize">article content</label>
    <input type="text" class="form-control" id="content" name="content" placeholder="write content here">
    <div class="contentError errors text-danger d-none"></div>            
  </div>        
  <div class="form-group">
    <label for="thumbnail">Thumbnail</label>            
    <div class="custom-file">
      <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
      <label class="custom-file-label" for="thumbnail">Choose file</label>
      <div class="thumbnailError errors text-danger d-none"></div>              
    </div>
  </div>
  {{-- alt="img-preview" --}}
  <img src="" class="img-preview" style="height: 100px; object-fit: contain;">
  {{-- <div class="form-group">
    <label for="category_id">Article Category</label>
    <select id="category_id" name="category_id" class="form-control">
    <option value="" selected style="display: none;">Select Category</option>
      @foreach($categories as $c)
      <option value="{{$c->id}}">{{$c->name}}</option>
      @endforeach
    </select>
    <div class="category_idError errors text-danger d-none"></div>                 
  </div>
  <div class="form-group">
    <label for="district_id">Article District</label>
    <select id="district_id" name="district_id" class="form-control">
      <option value="" selected style="display: none;">Select District</option>            
      @foreach($districts as $d)
      <option value="{{$d->id}}">{{$d->name}}</option>
      @endforeach
    </select>
    <div class="district_idError errors text-danger d-none"></div>
  </div> --}} 
  <div class="form-group">
    <label for="tag_id">Select Tag (OPTIONAL)</label>
    <select id="tag_id" name="tag_id" class="form-control">
      <option value="" selected style="display: none;">Select Tag</option>
      {{-- @foreach($tags as $t)
      <option value="{{$t->id}}">{{$t->name}}</option>
      @endforeach --}}
    </select>
  </div>
  <div class="buttons text-end">
    {{-- type="button" na dile submit hisebe kaj kore --}}
    <button type="button" class="btn btn-danger bootbox-close-button">Cancel</button>
    <button type="submit" class="btn btn-info">Save</button>
  </div>             
      
</form>
{{-- @endsection --}}