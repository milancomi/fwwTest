
<html>
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



<script>

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'interaction' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: '',
      },
      dayMaxEvents: 1,
      events: {
        url: 'fetch_data',
      },

      
      dateClick:function(start,end,allDay)
      {
          console.log(start);

        var date = start.dateStr;

        var title = prompt("Enter Event Title");
        if(title)
        {

            $.ajax({
               type:'POST',
                url:"{{route('addEvent')}}",
               data:{
                   _token:"{{ csrf_token() }}",
                   title:title,
                   date:date
               },
               success:function(data) {
                   calendar.refetchEvents();
               }
            });
        }

         },

      defaultDate: new Date(),
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      displayEventTime: false,
      locale:"sr",
      eventLimit: true, // allow "more" link when too many events
      views: { month: { eventLimit: 1 ,selectOverlap:false} },
      contentHeight: 500,

  eventClick: function(info) {
      console.log(info.event.id);
    alert('Event: ' + info.event.title);

  },
    });

    calendar.render();
  });

</script><style>

    html, body {
      overflow: hidden; /* don't do scrollbars */
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 15px;
    }
.fc-content{
  font-weight: 700;
  width: 80%;
    text-overflow: ellipsis;
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
.myClass{
    margin-top: -1.33rem !important;
    min-height: 3.9rem !important;
    height: 5.4rem  !important;

}

.fc-day-number{
  position: relative !important;
    z-index: 300;
    padding-right: 0.7rem !important;

}
  </style>
</head>
<body>

  <div id='calendar'></div>
</body>
</html>
