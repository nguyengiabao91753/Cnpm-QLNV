@extends('client.client')

@section('module', 'Employee')
@section('action', 'Information')
@section('profile', 'menu-open')
@push('css')
<link rel="stylesheet" href="{{ asset('administrator/plugins/fullcalendar/main.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<style type="text/css">
  /* #cameraOutput video {
            width: 100%;
            height: 100%;
        }
        #cameraOutput .capture-button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        } */
        #cameraOutput canvas {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 80%;
        }

        #cameraOutput {
          display: none;
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          z-index: 9999;
          /* Đảm bảo lớp này ở trên cùng */
          pointer-events: none;
          /* Để cho phép sự kiện click xuyên qua */
        }

        #cameraOutput video {
          display: block;
          width: auto;
          max-width: 100%;
          height: auto;
          max-height: 100%;
        }

        #cameraOutput .capture-button {
          position: absolute;
          top: 10px;
          left: 50%;
          transform: translateX(-50%);
          z-index: 3;
          /* Đảm bảo nút xác thực ở trên cùng */
          pointer-events: auto;
          /* Cho phép sự kiện click */
        }

        .rounded-video {
          width: 500px;
          /* Định dạng kích thước của video */
          height: 500px;
          overflow: hidden;
          /* Ẩn bất kỳ nội dung nào vượt quá phạm vi của phần tử */
          border-radius: 50%;
          /* Tạo ra một khung tròn */
        }
</style>
@endpush


@push('hanldejs')
<script src="{{ asset('administrator/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('administrator/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('administrator/plugins/fullcalendar/main.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js" integrity="sha256-XWbslTONf8w2XOFUgbhZm69LbiLJpiS3bUyoIaZpplk=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{ asset('faceapi/face_check.js')}}"></script>
<script>
  var emp = @json($emp -> ToArray());
  
  //startCamera('hello');
  function checkface() {
   



  }
  $(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function() {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0 //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()

    var schedules = @json($schedules -> ToArray());
    var atts = @json($atts -> ToArray());
    

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events

      events: processSchedules(schedules),

      editable: false,
      droppable: false, // this allows things to be dropped onto the calendar !!!
      drop: function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      },
      eventClick: function(info) { // New eventClick handler
        var scheduleId = info.event.id;
        for (var i = 0; i < schedules.length; i++) {
          if (scheduleId == schedules[i].id) {
            var schedule = schedules[i];
            break;
          }
        }
        var eventDate = new Date(schedule.date);
        //alert(schedule.date);

        var today = new Date();
        // alert("Clicked schedule ID: " + scheduleId);
        var eventId = scheduleId;

        // Create a new event element with buttons
        //var eventEl = $('<div id="external-events">'); // Adjust background color as needed
        var eventEl = $('#external-events');
        eventEl.empty();
        // Generate dynamic buttons with route links
        for (var i = 0; i < atts.length; i++) {
          if (atts[i].work_id == scheduleId) {
            var att = atts[i];
            break;
          }

        }

        if (att != null) {
          if (att.clock_out === null && att.present == 1) {
            //alert(1);
            var clockOutButton = generateButtonHtml('clock_out', eventId, 'btn-danger', 'Clock-out');
            eventEl.append(clockOutButton);

          } else if (att.leave_request == 1) {

            eventEl.append('<div class="bg-success">Requested for day-off</div>');
          } else {
            eventEl.append('<div class="bg-info">Clocked</div>');
          }
        } else if (eventDate.getFullYear() === today.getFullYear() &&
          eventDate.getMonth() === today.getMonth() &&
          eventDate.getDate() === today.getDate()) {

          var clockInButton = generateButtonHtml('clock_in', eventId, 'btn-success', 'Clock-in');

          var requestDayOffButton = generateButtonHtml('dayoff', eventId, 'btn-warning day-off', 'Request Day Off');
          eventEl.append(clockInButton, requestDayOffButton);
        } else {
          eventEl.append('<div class=" bg-danger">The Working date is not come!</div>');
        }



        // Append buttons to event element


      }

    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function(e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color': currColor
      })
    })
    $('#add-new-event').click(function(e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color': currColor,
        'color': '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })

  function processSchedules(schedules) {
    return schedules.map(function(schedule) {

      return {
        id: schedule.id,
        title: 'Room: ' + schedule.room.name,
        start: new Date(schedule.date + ' ' + schedule.shift.start),
        end: new Date(schedule.date + ' ' + schedule.shift.end),
        //allDay: true
      };
    });
  }


  function generateButtonHtml(method, eventId, buttonClass, buttonText) {

    var editScheduleRoute = "{{ route('admin.attendance.show', ['id' => '?' ]) }}";
    var url = editScheduleRoute.replace('show', method);
    var url1 = url.replace('?', eventId);
    if (method == 'dayoff') {


      var button = $('<button style="width: 100%;" class="btn ' + buttonClass + '">' + buttonText + '</button><br>');
      // Khai báo sự kiện onclick tại nút button
      button.click(function() {
        // Thực hiện các hành động khi click vào nút button ở đây
        $('.card.day-off').removeAttr('hidden');
        $('form.description-form').attr('action', url1);
        //alert("Bạn đã click vào nút button");
        $('.btn.day-off').prop('disabled', true);

      });

      return button;
    }
    return $('<a onclick="startCamera(\'' + url1 + '\', \'' + emp.image + '\')" style="width: 100%;" class="btn ' + buttonClass + '"href="#">' + buttonText + '</a><br>');
  }
</script>
@endpush
@section('content')
<div id="cameraOutput" class="rounded-video">
  <video id="videoElement" autoplay></video>
  <button class="capture-button btn btn-info" onclick="capturePhotoForRecognition()">Xác thực</button>
</div>
<div class="container-fluid">


  <div class="row">
    <div class="col-md-3">
      <div class="sticky-top mb-3">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Draggable Events</h4>
          </div>
          <div class="card-body">

            <div id="external-events">
              <!-- <div class="external-event bg-success">Lunch</div>
                    <div class="external-event bg-warning">Go home</div>
                    <div class="external-event bg-info">Do homework</div>
                    <div class="external-event bg-primary">Work on UI design</div>
                    <div class="external-event bg-danger">Sleep tight</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                        <input type="checkbox" id="drop-remove">
                        remove after drop
                      </label>
                    </div> -->
            </div>
          </div>

        </div>

        <div class="card day-off" hidden>
          <div class="card-header">
            <h3 class="card-title">Description</h3>
          </div>
          <div class="card-body">
            <!-- <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                      <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                    </ul>
                  </div>
                 
                  <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                    <div class="input-group-append">
                      <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                    </div>
                    
                  </div> -->
            <form method="post" class="description-form" action="">
              @csrf
              <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
              <br>
              <button class="btn btn-info">Submit</button>
            </form>


          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card card-primary">
        <div class="card-body p-0">
          <!-- THE CALENDAR -->
          <div id="calendar"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div><!-- /.container-fluid -->

@endsection