@extends("admin.layouts.application")
@section("title", __("admin.card_title"))
@section("content")
  @include("admin.cards._chart")
  <div class="row">
    @include("admin.cards._new_form")
    @include("admin.cards._list_card")
  </div>
@endsection
@section("javascript")
  <script>
    $(document).ready(function() {
      var c = document.getElementById("bar-chart");
      var label_data = [
        @foreach($chart_data["this_month"] as $k => $v)
          "{{ $k }}",
        @endforeach
      ];

      var data = [
        @foreach($chart_data["this_month"] as $k => $v)
          "{{ $v }}",
        @endforeach
      ];

      var data_last_month = [
        @foreach($chart_data["last_month"] as $k => $v)
          "{{ $v }}",
        @endforeach
      ];
      var d = {
          labels: label_data,
          datasets: [{
              label: "@lang('admin.this_month')",
              borderColor: "#34a853",
              backgroundColor:"#34a853",
              data: data
          }, {
              label: "@lang('admin.last_month')",
              borderColor: "#f0d075",
              backgroundColor: "#f0d075",
              data: data_last_month
          }]
      };
      new Chart(c, {
          type: "bar",
          data: d,
          options: {
              elements: {
                  rectangle: {
                      borderWidth: 2,
                      borderColor: "rgb(0, 255, 0)",
                      borderSkipped: "bottom"
                  }
              }
          }
      });


      $('body').on('submit', '.new-card-form', function(e) {
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
              alert(result.message);
              $thisform.parents('.row').find('.list-card').replaceWith(result.html);
              $('.btn-reset').click();
            } else {
              alert(result.message);
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
                $thisbutton.parents('.list-card').replaceWith(result.html);
                set_editable();
              }
            }
          });
        return false;
      });

      $('body').on('click', '.btn-delete', function() {
        $thisbutton = $(this);
        $thisbutton.parents('.be-loading').addClass('be-loading-active');
        var card_id = $thisbutton.parents('.card-item').attr('card-id');
        var url = $thisbutton.parents('.card-item').attr('card-url');

        $.ajax({
            url: url,
            type: 'DELETE',
            dataType: 'JSON',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (result) {
              if (result.status) {
                $thisbutton.parents('.list-card').replaceWith(result.html);
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
