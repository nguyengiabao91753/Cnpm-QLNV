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
        return confirm('Are you sure you want to deny?');
    }

    function confirmRestore() {
        return confirm('Are you sure you want to restore?');
    }
</script>
@endpush
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="{{route('admin.attendance.request')}}" class="btn btn-primary btn-block mb-3">Back</a>

            <div class="card">
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Absent Request</h3>


                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Information</h2>
                                <h5>{{$att->work->employee->name}}</h5>
                                <h6>From: {{$att->work->employee->position->department->name}} </h6>
                                <h6>
                                    {{$att->work->employee->position->name}}
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <h2>Schedule</h2>
                                <h6>
                                    Room: {{$att->work->room->name}}
                                </h6>
                                <h6>
                                    Shift: {{$att->work->shift->start}} - {{$att->work->shift->end}}
                                </h6>
                                <h6>
                                    Date: {{$att->work->date}}
                                </h6>
                            </div>
                        </div>


                    </div>


                    <!-- /.btn-group -->

                </div>
                <!-- /.mailbox-controls -->
                <div class="mailbox-read-message">
                    <p>{{$att->description}}</p>
                </div>
                <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer -->
            <div class="card-footer">
                <a href="{{route('admin.attendance.allow',['id'=>$att->id])}}" class="btn btn-success"> <i class="far fa-edit"></i> Allow</a>
                <a onclick="return confirmDelete()" href="{{route('admin.attendance.destroy',['id'=> $att->id])}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Deny</a>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
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