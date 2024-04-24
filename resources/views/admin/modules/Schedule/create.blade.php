@extends('admin.master')

@section('module', 'Works chedule')
@section('action', 'Create')
@section('sch', 'menu-open')
@section('sch-create', 'active')

@section('content')
<form method="post" action="{{ route('admin.schedule.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee's schedule create</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">

            <div class="row form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Department</label>
                        <select name="depart" id="depart_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach ($deps as $dep )
                            <option value="{{$dep->id}}" {{old('depart' ) == $dep->id ? 'selected':'' }}>{{$dep->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Position</label>
                        <select name="position_id" id="position" class="form-control" required>
                            <option value="">Select Department first</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Employee</label>
                <select name="emp_id" id="emp" class="form-control" required>

                </select>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Room</label>
                        <select name="room_id" id="room" class="form-control" required>
                            <option value="">Select Department first</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Shift</label>
                        <select name="shift_id" id="shift" class="form-control" required>
                            <option value="">Select Shift</option>
                            @foreach ($shifts as $shift )
                                <option value="{{$shift->id}}">{{$shift->start}} - {{$shift->end}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="">Date</label>
                    <input type="date" name="date" id="" class="form-control">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>

    <!-- /.card -->
</form>
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script ype='text/javascript'>
    $(document).ready(function() {
        $('#depart_id').change(function() {
            $('#position').empty();
            $('#room').empty();
            var depart_id = $('#depart_id').val();
            //Position
            $.ajax({
                url: '/getpos/' + depart_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;

                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;
                            var option = "<option value='" + id + "' {{old('position_id')== '" + id + "' ? 'selected' : '' }}>" + name + "</option>";

                            $('#position').append(option);
                            
                        }
                    }
                }
            })
            //Room
            $.ajax({
                url: '/getroom/' + depart_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;

                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;
                            var option = "<option value='" + id + "' {{old('room_id')== '" + id + "' ? 'selected' : '' }}>" + name + "</option>";

                            $('#room').append(option);
                            
                        }
                    }
                }
            })

        });
        //Emp
        $('#position').change(function () {
            var pos_id =  $('#position').val();
           
            $.ajax({
                url: '/getempbypos/' + pos_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;

                    }
                    

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                            var option = "<option value='" + id + "' {{old('emp_id')== '" + id + "' ? 'selected' : '' }}>" +id+": "+ name + "</option>";

                            $('#emp').append(option);
                        }
                    }else{
                        alert('This position has no employee');
                    }
                }
            });
        })
    });
</script>
@endpush
@endsection