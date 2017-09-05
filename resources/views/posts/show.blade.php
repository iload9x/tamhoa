@extends("layouts.application")
@section("title", $post->name)
@section("content")
  @include("posts._detail")
@endsection
@section("javascript")
  <script type="text/javascript">
    $(document).ready(function() {
      $('body').on('click', '.post-edit', function() {
        $(this).attr('disabled', 1);
        $thisbutton = $(this).parents('.post-item');
        var content = $thisbutton.find('.post-content');
        var title = $thisbutton.find('.post-name');

        content.replaceWith('<textarea name="" id="post-content">'+ content.html() +'</textarea>');
        title.replaceWith('<input type="text" class="width-100" id="post-name" value="'+ title.html().trim() +'"/>');
        $('#post-content').summernote({height: $('.post-content').height()});
        $('.post-buttons').show();
      });

      $('body').on('click', '.post-cancel', function() {
        $(this).attr('disabled', 1).html($(this).html() + '...');
        $thisbutton = $(this).parents('.post-item');
        var url = window.location.href;

        $.ajax({
          url: url,
          type: 'GET',
          dataType: 'JSON',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function (result) {
            if (result.status) {
              $thisbutton.replaceWith(result.html);
            }
          }
        });
      });

      $('body').on('click', '.post-update', function() {
        $(this).attr('disabled', 1).html($(this).html() + '...');
        $thisbutton = $(this).parents('.post-item');
        var name = $("#post-name").val();
        var content = $("#post-content").val();

        $.ajax({
          url: '{{ route("posts.update", $post) }}',
          type: 'PUT',
          dataType: 'JSON',
          data: {
            name: name,
            content: content
          },
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function (result) {
            if (result.status) {
              $thisbutton.replaceWith(result.html);
            }
          }
        });
      });

      $('body').on('click', '.post-delete', function() {
        var r = confirm("Bạn có chắc chắn muốn xóa!");
        if (r == false) {
            return false;
        }
      });
    });
  </script>
@endsection
