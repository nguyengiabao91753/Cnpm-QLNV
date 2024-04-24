@extends('admin.master')

@section('module', 'Attendance')
@section('action', 'Leave Request')
@section('att', 'menu-open')
@section('att-request', 'active')
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
                    <th>Date</th>
                    <th>View</th>
                    <th>Allow</th>
                    <th>Deny</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atts as $att )
                <tr>
                    <td>{{$loop -> iteration}}</td>
                    <td>{{$att->work->emp_id}}</td>
                    <td>{{$att->work->employee->name}}</td>
                    <td>{{$att ->work->date}}</td>
                    <td>
                    <a href="{{route('admin.attendance.show',['id'=>$att->id])}}" class="btn btn-primary"> <i class="far fa-edit"></i> View</a>
                    </td>
                    <td>
                        <a href="{{route('admin.attendance.allow',['id'=>$att->id])}}" class="btn btn-success"> <i class="far fa-edit"></i> Allow</a>
                    </td>
                    <td>
                        <a onclick="return confirmDelete()" href="{{route('admin.attendance.destroy',['id'=> $att->id])}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Deny</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <th>ID</th>
                <th>Employee Id</th>
                <th>Employee Name</th>

                <th>Date</th>

                <th>View</th>
                <th>Allow</th>
                <th>Deny</th>
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