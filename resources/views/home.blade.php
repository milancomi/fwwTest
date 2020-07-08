{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div id="reactApp">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='assets/fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='assets/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='assets/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='assets/fullcalendar/packages/list/main.css' rel='stylesheet' />
<script src='assets/fullcalendar/packages/core/main.js'></script>
<script src='assets/fullcalendar/packages/interaction/main.js'></script>
<script src='assets/fullcalendar/packages/daygrid/main.js'></script>
<script src='assets/fullcalendar/packages/timegrid/main.js'></script>
<script src='assets/fullcalendar/packages/list/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'timeGridDay,timeGridWeek,listWeek'
      },
      defaultDate: '2020-05-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      locale:"sr",
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: 'fetch_data',
        failure: function() {
          document.getElementById('script-warning').style.display = 'block'
        }
      },
      loading: function(bool) {
        document.getElementById('loading').style.display =
          bool ? 'block' : 'none';
      }
    //   events: [
    //     {
    //       title: 'All Day Event',
    //       start: '2020-05-01',
    //     },
    //     {
    //       title: 'Long Event',
    //       start: '2020-05-07',
    //       end: '2020-05-10'
    //     },
    //     {
    //       groupId: 999,
    //       title: 'Repeating Event',
    //       start: '2020-05-09T16:00:00'
    //     },
    //     {
    //       groupId: 999,
    //       title: 'Repeating Event',
    //       start: '2020-05-16T16:00:00'
    //     },
    //     {
    //       title: 'Conference',
    //       start: '2020-05-11',
    //       end: '2020-05-13'
    //     },
    //     {
    //       title: 'Meeting',
    //       start: '2020-05-12T10:30:00',
    //       end: '2020-05-12T12:30:00'
    //     },
    //     {
    //       title: 'Lunch',
    //       start: '2020-05-12T12:00:00'
    //     },
    //     {
    //       title: 'Meeting',
    //       start: '2020-05-12T14:30:00'
    //     },
    //     {
    //       title: 'Happy Hour',
    //       start: '2020-05-12T17:30:00'
    //     },
    //     {
    //       title: 'Dinner',
    //       start: '2020-05-12T20:00:00'
    //     },
    //     {
    //       title: 'Birthday Party',
    //       start: '2020-05-13T07:00:00'
    //     },
    //     {
    //       title: 'Click for Google',
    //       url: 'http://google.com/',
    //       start: '2020-05-28'
    //     }
    //   ]
    });

    calendar.render();
  });

</script><style>

    html, body {
      overflow: hidden; /* don't do scrollbars */
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }

    #calendar-container {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }

    .fc-header-toolbar {
      /*
      the calendar will be butting up against the edges,
      but let's scoot in the header's buttons
      */
      padding-top: 1em;
      padding-left: 1em;
      padding-right: 1em;
    }

  </style>
</head>
<body>

  <div id='calendar'></div>

  <div id='script-warning'>
    <code>php/get-events.php</code> must be running.
  </div>

  <div id='loading'>loading...</div>
</body>
</html>
