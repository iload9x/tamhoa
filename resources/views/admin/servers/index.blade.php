@extends("admin.layouts.application")
@section("title", __("admin.server_title"))
@section("content")
<div class="row">
  @include("admin.servers._new_form")
  @include("admin.servers._list_server")
</div>
@endsection
@section("javascript")
  <script>
    $(document).ready(function() {
      $("[data-mask='datetime']").mask("99/99/9999 99:99:99");
      set_editable();

      $('body').on('submit', '.new-server-form', function(e) {
        $thisform = $(this);
        $thisform.parents('.be-loading').addClass("be-loading-active");

        var url = $thisform.attr('action');

        $.ajax({
          url: url,
          type: 'POST',
          data: $thisform.serialize(),
          dataType: 'JSON',
          success: function (result) {
            $thisform.parents('.be-loading').removeClass("be-loading-active");

            if (result.status) {
              $thisform.parents('.row').find('.list-server').replaceWith(result.html);
              $('.btn-reset').click();
            }
          }
        });
        return false;
      });

      $('body').on('click', '.pagination a', function() {
        $thisbutton = $(this);
        $(this).parents('.be-loading').addClass('be-loading-active');
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'JSON',
            success: function (result) {
              if (result.status) {
                $thisbutton.parents('.list-server').replaceWith(result.html);
                set_editable();
              }
            }
          });
        return false;
      });

      $('body').on('click', '.btn-delete', function() {
        $thisbutton = $(this);
        $thisbutton.parents('.be-loading').addClass('be-loading-active');
        var server_id = $thisbutton.parents('.server-item').attr('server-id');
        var url = $thisbutton.parents('.server-item').attr('server-url');

        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
              if (result.status) {
                $thisbutton.parents('.list-server').replaceWith(result.html);
                set_editable();
              }
            }
          });
        return false;
      });
      
    });
    function set_editable() {
      $('.my-editable').editable();
    }
  </script>
@endsection
