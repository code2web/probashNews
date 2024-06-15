<script src="{{asset('admin/plugins/jquery/jquery/jquery.min.js')}}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}

<script>
$(document).ready(function(){
  $(document).on('click', '#create_article_modal', function(e) {
    e.preventDefault();
    let modal_url = $(this).attr('href');
    // alert(modal_url);
    
    $.ajax({
      type: "GET",
      url: modal_url,
      success: function(res){
        let dialog = bootbox.dialog({
          title: 'Creating Forms',
          message: "<div class='modalContent'></div>",
          size: 'large',
          // buttons: {
          // cancel: {
          // label: "I'm a cancel button!",
          // className: 'btn-danger',
          // callback: function(){
          // console.log('Custom cancel clicked');
          // }
          // },      
          // ok: {
          // label: "I'm an OK button!",
          // className: 'btn-info',
          // callback: function() {
          // console.log('Custom OK clicked');
          // }
          // }
          // }
        });
        $('.modalContent').html(res);
      }
    })
  });
});
</script>