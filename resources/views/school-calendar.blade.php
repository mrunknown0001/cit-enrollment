<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel='stylesheet' href="{{ asset('/packages/core/main.css') }}"  />
<link rel='stylesheet' href="{{ asset('/packages/daygrid/main.css') }}"  />
<script src="{{ asset('/packages/core/main.js') }} "></script>
<script src="{{ asset('/packages/interaction/main.js') }}"></script>
<script src="{{ asset('/packages/daygrid/main.js') }}"></script>
<script src="{{ asset('/js/jquery.js') }}"></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    // alert(today);
    var data = '';

     $.ajax({
      url:"{{ route('all.school.calendar') }}",
      success: function(json) {
          // console.log(json);
          data = json;

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'interaction', 'dayGrid' ],
          defaultDate: today,
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: data,
        });

        calendar.render();

      },
      error: function(e) {
         console.log(e);
      }
    });



  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 900px;
    margin: 0 auto;
  }

  .content {
    max-width: 900px;
    margin: 0 auto;
  }

</style>
</head>
<body>

  <div class="content">
    <h2 style="text-align: center;">Mayantoc High School School Calendar</h2>

    <a href="{{ route('landing.page') }}">back to Landing Page</a>
    <p></p>
  </div>

  <div id='calendar'></div>

  <div class="content">
    <p></p>
    <p><strong>Copyright &copy; 2019 </strong></p>
  </div>

</body>
</html>
