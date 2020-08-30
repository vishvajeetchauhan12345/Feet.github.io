@extends('layouts.app')
@section("extra_css")
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.0/fullcalendar.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('menu.calendar')

                </div>

                <div class="panel-body">
                <div id='calendar'></div>

                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="booking_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Booking Details</h4>
      </div>

      <div class="modal-body">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>

  </div>
</div>
@endsection

@section("script")
<script src="{{ asset('js/moment.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.0/fullcalendar.min.js"></script>
@if(Hyvikk::get('language')!="en")
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.1/locale/{{Hyvikk::get('language')}}.js"></script>
@endif
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '{{date("Y-m-d")}}',
      navLinks: true, // can click day/week names to navigate views
      editable: false,
      events: "{{ url('/calendar')}}",
      eventLimit: true,
      eventClick: function(calEvent, jsEvent, view) {

         $.ajax({
            url: '{{url("/calendar/event/")}}/'+calEvent.id,
          })
          .then(function(content){
            $("#booking_detail .modal-body").empty();
            $("#booking_detail .modal-body").html(content);
            $("#booking_detail").modal("show");

          },
          function(xhr, status, error) {

            api.set('content.text', status + ': ' + error);
          });

        }



    });

  });

</script>
@endsection
