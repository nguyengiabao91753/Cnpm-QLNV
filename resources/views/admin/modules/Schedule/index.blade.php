@extends('admin.master')

@section('module', 'Work schdule')
@section('action', 'List')
@section('sch', 'menu-open')
@section('sch-list', 'active')
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
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
        <h3 class="card-title">Employee list</h3>

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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Id</th>
                    <th>Employee Name</th>
                    <th>Room</th>
                    <th>Shift</th>
                    <th>Date</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule )
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$schedule->employee->id}}
                    </td>
                    <td>
                        {{$schedule->employee->name}}
                    </td>
                    <td>
                        {{$schedule->room->name}}
                    </td>
                    <td>
                        {{$schedule->shift->start}} - {{$schedule->shift->end}}
                    </td>
                    <td>
                        {{$schedule->date}}
                    </td>

                    <td>
                        <a href="{{route('admin.schedule.edit',['id'=>$schedule->id])}}" class="btn btn-success"> <i class="far fa-edit"></i> Update</a>
                    </td>
                    <td>
                        <a onclick="return confirmDelete()" href="{{route('admin.schedule.destroy',['id'=> $schedule->id])}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
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
                <th>Update</th>
                <th>Delete</th>
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->


@endsection