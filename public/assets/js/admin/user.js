$(document).ready(function() {
  $('body').on('click', '.pagination a', function() {

    $this_button = $(this);
    var url_page = $(this).attr('href');

    $.ajax({
      url: url_page,
      type: 'GET',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function (result) {
        if (result.status) {
          $this_button.parents('.container-data')
            .replaceWith(result.html);
        }
      }
    });
    return false;
  });

  //show modal
  $('body').on('click', '.user-post-detail', function() {
    //$('body').find('.show-posts-detail').click();
    var post_id = $(this).parents('tr').attr('post-id');

    $.ajax({
      url: '/admin/posts/' + post_id + '?get=modal',
      type: 'GET',
      dataType: 'JSON',
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function (result) {
        if (result.status) {
          $(".container-modal").html(result.html);
        }
        reload_time_ago();
        $("#show-posts-detail").addClass("modal-show");
      }
    });
    return false;
  });

  //close modal
  $('body').on('click',
    '#show-posts-detail .mdi-close, #show-posts-detail .modal-close',
    function() {
      $("#show-posts-detail").removeClass("modal-show");
  });
});
