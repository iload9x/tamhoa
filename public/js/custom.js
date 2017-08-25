$(document).ready(function() {
    $('.post-new-form, .create-card-form, .create-coin-form').parsley();
    $('body').on('change', '.select_server', function() {
      $thisbutton = $(this).parents('.doi-xu');
      var username = $thisbutton.attr('username');
      var database = $thisbutton.find('.select_server').val();

      $.ajax({
        url: '/game/players/' + username + '?database=' + database,
        type: 'GET',
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (result) {
          if (result.status) {
            $thisbutton.find('.player-name').val(result.player.name);
            $thisbutton.find('.btn-ok').removeAttr('disabled');
          } else {
            $thisbutton.find('.player-name').val('Chưa tạo nhân vật');
            $thisbutton.find('.btn-ok').attr('disabled', 'disabled');
          }
        }
      });
    });
});