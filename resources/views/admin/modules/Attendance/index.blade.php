@extends('admin.master')

@section('module', 'Attendance')
@section('action', 'List')
@section('att', 'menu-open')
@section('att-list', 'active')
@push('css')
<link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-responsive/css/responsive.bootstrap4.min.css ') }}">
<link rel="stylesheet" href="{{ asset('administrator/plugins/datatables-buttons/css/buttons.bootstrap4.min.css ') }}">
@endpush

@push('js')
<script src="{{ asset('administrator/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('administrator/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush

@push('hanldejs')
<script>
    $(function() {
        $("#example1, #example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function confirmDelete() {
        return confirm('Are you sure you want to delete this?');
    }

    function confirmRestore() {
        return confirm('Are you sure you want to restore?');
    }
</script>
@endpush
@section('content')
<!-- Default box -->
<div class="card">

    <div class="card-header">
        <h2 class="card-title badge badge-primary">Present list</h2>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- <div class="row"> -->
    <!-- <div class="col-sm-12 col-md-6">
        <div class="dataTables_length" id="example2_length" style="float: left; margin-left: 4%;">
            <label>Show</label>
            <input type="date" class="form-control" id="showdate" value="<?php echo date("Y-m-d"); ?>">
        </div>
    </div> -->
    <!-- </div> -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Id</th>
                    <th>Employee Name</th>
                    <th>Room</th>
                    <th>Shift</th>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atts as $att )
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td>{{$att->work->emp_id}}</td>
                    <td>{{$att->work->employee->name}}</td>
                    <td>{{$att ->work->room->name}}</td>
                    <td>{{$att ->work->shift->start}} - {{$att ->work->shift->end}}</td>
                    <td>{{$att ->work->date}}</td>
                    <td>{{$att ->description}}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <th>ID</th>
                <th>Employee Id</th>
                <th>Employee Name</th>
                <th>Room</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Description</th>
            </tfoot>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h2 class="card-title badge badge-danger">Absent list</h2>

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
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Id</th>
                    <th>Employee Name</th>
                    <th>Room</th>
                    <th>Shift</th>
                    <th>Date</th>
                    <th>Approve</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($absatts as $absatt )
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td>{{$absatt->work->emp_id}}</td>
                    <td>{{$absatt->work->employee->name}}</td>
                    <td>{{$absatt ->work->room->name}}</td>
                    <td>{{$absatt ->work->shift->start}} - {{$absatt ->work->shift->end}}</td>
                    <td>{{$absatt ->work->date}}</td>
                    <td>@if($absatt->leave_approved == 1)
                        <p class="badge badge-success">Allow</p>
                        @elseif ($absatt->leave_approved == 0)
                        <p class="badge badge-danger">Deny</p>
                        @else
                        <p class="badge badge-info">Waiting for response</p>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <th>ID</th>
                <th>Employee Id</th>
                <th>Employee Name</th>
                <th>Room</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Approve</th>
                
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->
@push('js')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<!-- <script type='text/javascript'>
    $(document).ready(function() {


        $("#showdate").change(function() {
            var date = $("#showdate").val();
            $.ajax({
                url: '/getatt/' + date,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    alert(date);
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        for (var i = o; i < len; i++) {
                            tableContent += '<tr>';
                            tableContent += '<td>' + response['data'] + '</td>';
                            tableContent += '<td>' + response['data'] + '</td>';
                            tableContent += '<td>' + response['data'] + '</td>';
                            tableContent += '<td>' + response['data'] + '</td>';
                            tableContent += '<td>' + item.shift_start + ' - ' + item.shift_end + '</td>';
                            tableContent += '<td>' + item.date + '</td>';
                            tableContent += '</tr>';
                        }
                    }
                },
                error: function(error) {
                    alert("nodate");
                }
            })
        });
    })
</script> -->
@endpush

@endsection