@extends('admin.master')

@section('module', 'Employee')
@section('action', 'List')
@section('emp', 'menu-open')
@section('emp-info', 'active')
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
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                   
                    <th>Position</th>
                    <th>Department</th>
                    <th>Show More</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emps as $emp )
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            {{$emp->name}}
                        </td>
                        <td>
                            {{$emp->email}}
                        </td>
                        <td>
                            {{$emp->phone}}
                        </td>
                        <td>
                            {{$emp->gender}}
                        </td>
                       
                        <td>
                            {{$emp->position->name}}
                        </td>
                        <td>
                            @php
                                $dep = DB::table('departments')->find($emp->position->department_id);
                            @endphp
                            {{$dep -> name}}
                        </td>
                        <td>
                        <a href="{{route('admin.employee.show',['id'=>$emp->id])}}">Show</a>
                        </td>
                        <td>
                            <a href="{{route('admin.employee.edit',['id'=>$emp->id])}}" class="btn btn-success"> <i class="far fa-edit"></i> Update</a>
                        </td>
                        <td>
                            @if (Auth::guard('admin')->id() != $emp->id)
                                
                            <a onclick="return confirmDelete()" href="{{route('admin.employee.destroy',['id'=> $emp->id])}}" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</a>
                            @endif
                        </td>
                        </tr>
                @endforeach
            </tbody>
                
            <tfoot>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                   
                    <th>Position</th>
                    <th>Department</th>
                    <th>Show More</th>
                    <th>Update</th>
                    <th>Delete</th>
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->


@endsection