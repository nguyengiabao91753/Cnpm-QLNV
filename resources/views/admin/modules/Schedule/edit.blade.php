@extends('admin.master')

@section('module', 'Work schedule')
@section('action', 'Create')
@section('sch', 'menu-open')

@section('content')
<form method="post" action="{{ route('admin.schedule.update',['id'=> $schedule->id]) }}" enctype="multipart/form-data">
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

            
            <div class="form-group">
                <label>Employee</label>
                <input type="text" class="form-control" style="width: 20%;" value="{{$schedule->employee->id}}: {{$schedule->employee->name}}" disabled>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Room</label>

                        <select name="room_id" id="room" class="form-control" required>
                            <option value="">Select Department first</option>
                            @foreach ($rooms as $room )
                                <option value="{{$room->id}}" {{old('room_id', $room->id )== $schedule->room_id ? 'selected' : ''}}>{{$room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Shift</label>
                        <select name="shift_id" id="shift" class="form-control" required>
                            <option value="">Select Shift</option>
                            @foreach ($shifts as $shift )
                                <option value="{{$shift->id}}" {{ old('shift_id', $shift->id) == $schedule->shift_id ? 'selected' : ''}} >{{$shift->start}} - {{$shift->end}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="">Date</label>
                    <input type="date" name="date" id="" class="form-control" value="{{old('date', $schedule->date)}}">
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>

    <!-- /.card -->
</form>

@endsection