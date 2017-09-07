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
      show_chart(label_data, data, data_last_month);

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
                $thisbutton.parents('.be-loading').replaceWith(result.html);
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

    function show_chart(label_data, data, data_last_month) {
      var c = $("#bar-chart");

      var d = {
        labels: label_data,
        datasets: [{
          label: "@lang('admin.this_month')",
          borderColor: "#34a853",
          backgroundColor:"#34a853",
          data: data
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
    }

  </script>

  <script type="text/javascript">
    $(function() {
      var reportrange = $('.reportrange');
      $('body').on('click', '.ranges li, .applyBtn', function() {
        $('.card-chart').find('.be-loading').addClass("be-loading-active");

        var startDate = reportrange.data('daterangepicker').startDate;
        var endDate = reportrange.data('daterangepicker').endDate;

        $.ajax({
            type: 'GET',
            dataType: 'JSON',
            data: {
              type: "chart",
              start_date: startDate._d,
              end_date: endDate._d,
            },
            success: function (result) {
              if (result.status) {
                $('.card-chart').find('.be-loading').removeClass("be-loading-active");
                $("#bar-chart").replaceWith(result.html);
                show_chart(result.label, result.data, []);
              }
            }
          });
      });

      var start = moment().subtract(15, 'days');
      var end = moment();

      function cb(start, end) {
        $('.reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
      }

      reportrange.daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
          '@lang("admin.today")': [moment(), moment()],
          '@lang("admin.yesterday")': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '@lang("admin.last_day", ["day" => 7])': [moment().subtract(6, 'days'), moment()],
          '@lang("admin.last_day", ["day" => 30])': [moment().subtract(29, 'days'), moment()],
          '@lang("admin.this_month")': [moment().startOf('month'), moment().endOf('month')],
          '@lang("admin.last_month")': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, cb);

      cb(start, end);
      
    });
  </script>
@endsection
