
<html>
<meta charset='utf-8' />
<link href='assets/fullcalendar/packages/core/main.css' rel='stylesheet' />
<link href='assets/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='assets/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='assets/fullcalendar/packages/list/main.css' rel='stylesheet' />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src='assets/fullcalendar/packages/core/main.js'></script>
<script src='assets/fullcalendar/packages/interaction/main.js'></script>
<script src='assets/fullcalendar/packages/daygrid/main.js'></script>
<script src='assets/fullcalendar/packages/timegrid/main.js'></script>
<script src='assets/fullcalendar/packages/list/main.js'></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




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
    $('#event_id').val(info.event.id);
    $('#event_title').val(info.event.title)
    $('#myModal').modal('toggle');

  },
    });

    calendar.render();
    document.globalCalendar  = calendar;
    // global variable solution, treba mi refetch funkcija
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
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Event</h4>
        </div>
        <div class="modal-body">
            <form id="productForm" name="productForm" class="form-horizontal">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Event description</label>
                <textarea class="form-control" id="event_title" rows="3"></textarea>
              </div>

              <input type="hidden" id="event_id" name="custId" >
            </form>
            </div>

        <div class="modal-footer">
            <button type="submit" id="deleteEvent" class="btn btn-danger">Delete Event &nbsp; <i class="fa fa-trash" aria-hidden="true"></i></button>

            <button type="submit" id="updateEvent" class="btn btn-primary">Update &nbsp; <i class="fa fa-refresh" aria-hidden="true"></i>
            </button>

          <button type="button" class="btn btn-default" data-dismiss="modal">Close &nbsp; <i class="fa fa-times"></i></button>
        </div>
      </div>

    </div>
  </div>

  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <script>
$(document).ready(function() {
    $('#deleteEvent').click(function (e) {

e.preventDefault();
var event_id = $('#event_id').val();
        $.ajax({
               type:'POST',
                url:"{{route('deleteEvent')}}",
               data:{
                   _token:"{{ csrf_token() }}",
                   event_id: event_id,
               },
               success:function() {
                $('#myModal').modal('toggle');
                document.globalCalendar.refetchEvents();
               }
            });



    });

    $(document).ready(function() {

    $('#updateEvent').click(function (e) {

e.preventDefault();
var event_id = $('#event_id').val();
var event_title = $('#event_title').val();

console.log(event_title);
        $.ajax({
               type:'POST',
                url:"{{route('updateEvent')}}",
               data:{
                   _token:"{{ csrf_token() }}",
                   event_id: event_id,
                   event_title:event_title
               },
               success:function() {
                $('#myModal').modal('toggle');
                document.globalCalendar.refetchEvents();
               }
            });



    });



    });


    $('#deleteEvent').click(function (e) {

e.preventDefault();
var event_id = $('#event_id').val();
        $.ajax({
               type:'POST',
                url:"{{route('updateEvent')}}",
               data:{
                   _token:"{{ csrf_token() }}",
                   event_id: event_id,
               },
               success:function() {
                $('#myModal').modal('toggle');
                document.globalCalendar.refetchEvents();
               }
            });



    });
});






  </script>

</body>
</html>
