<script src="{{asset('admin/plugins/jquery/jquery/jquery.min.js')}}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}


<script>
$(document).ready(function(){
  $(document).on('click', '.create_category', function(e){
    e.preventDefault();
    let name = $('#name').val();
    // console.log(name);
    $.ajax({
      url: "{{route('category.store')}}",
      method: "post",
      data: {name:name},
      success: function(res){
        if (res.status == 'success') {
          $('#createModal').modal('hide');
          $('#createCategoryForm')[0].reset();

          $('.table').load(location.href+' .table');

          Command: toastr["success"]("Created Done!", "success")
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        }
      },error: function(err){
        $('.errMsgContainer').html('');
        let error = err.responseJSON;
        $.each(error.errors, function(index, value){
          $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>')
        })
      }
    })
  })

  // show value in update form
  $(document).on('click', '.update_category_form', function(){
    let id = $(this).data('id');
    let name = $(this).data('name');

    $('#up_id').val(id);
    $('#up_name').val(name);
  })

  // update value data
  $(document).on('click', '.update_category', function(e){
    e.preventDefault();
    let up_id = $('#up_id').val();
    let up_name = $('#up_name').val();
    $.ajax({
      url: "{{route('category.update',$category->id)}}",
      method: "put",
      data: {up_id:up_id,up_name:up_name},
      success: function(res){
        if (res.status == 'success') {
          $('#updateModal').modal('hide');
          $('#updateCategoryForm')[0].reset();

          $('.table').load(location.href+' .table');

          Command: toastr["success"]("Updated Done!", "success")
          toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
        }
      },error: function(err){
        $('.errMsgContainer').html('');
        let error = err.responseJSON;
        $.each(error.errors, function(index, value){
          $('.errMsgContainer').append('<span class="text-danger">'+value+'</span>'+'<br>')
        })
      }
    })
  })

  // delet value data
  $(document).on('click', '.delete_category', function(e){
    e.preventDefault();
    let category_id = $(this).data('id');
    // console.log(category_id);
    if (confirm('Are you sure to Delete')) {
      $.ajax({
        url: "{{route('category.destroy', $category->id)}}",
        method: "delete",
        data: {category_id:category_id},
        success: function(res){
          if (res.status == 'success') {            
            $('.table').load(location.href+' .table');

            Command: toastr["success"]("Deleted Done!", "success")
            toastr.options = {
              "closeButton": true,
              "debug": false,
              "newestOnTop": false,
              "progressBar": true,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            }
          }
        }
      })
    }    
  })

  // Pagination
  $('.pagination').addClass('justify-content-center')
  $(document).on('click', '.pagination a', function(e){
    e.preventDefault();
    let page = $(this).attr('href').split('page=')[1]

    pagination(page);
  })

  function pagination(page){
    $.ajax({
      // url:"/admin/pagination/category?page="+page,
      url:"{{route('pagination_category')}}?page="+page,      
      success:function(res){
        $('.card-body').html(res);
      }
    })
  }

  // Search

  $(document).on('keyup',function(e){
    e.preventDefault();
    let search_string = $('#search').val();
    // console.log(search_string);
    $.ajax({
      url:"{{route('search_category')}}",
      data: {search_string:search_string},   
      success:function(res){
        $('.card-body').html(res);
        if (res.status=='nothing_found') {
          $('.card-body').html('<h6 class="text-danger text-center">'+'Nothing Found'+'</h6>');
        }
      }
    })
  })
});
</script>