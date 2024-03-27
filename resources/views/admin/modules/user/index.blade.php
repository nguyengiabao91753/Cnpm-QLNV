@extends('admin.master')

@section('module', 'User')
@section('action', 'List')
@section('user', 'menu-open')
@section('user-list', 'active')

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

    function confirmBlock() {
        return confirm('Are you sure you want to block this account?');
    }

    function confirmRestore() {
        return confirm('Are you sure you want to restore?');
    }
    function confirmDelete() {
        return confirm('Are you sure you want to Delete?');
    }
</script>
@endpush
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">User list</h3>

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
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th>Update</th>
                    <th>Block</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                @if ($user->status ==1)
                <tr>
                    <td>
                        {{$loop -> iteration}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        @if($user->level ==1 && $user->id ==1)
                        <span class="right badge badge-primary">SuperAdmin</span>
                        @elseif($user->level ==1)
                        <span class="right badge badge-info">Admin</span>
                        @else
                        <span class="right badge badge-dark">Member</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-success">Active</span>
                    </td>
                    <td>
                        {{date('d/m/Y - H:m:i',strtotime($user->created_at))}}
                    </td>
                    <td>
                        <a href="{{route('admin.user.edit',['id'=>$user->id])}}">Update</a>
                    </td>
                    <td>
                        <a onclick="return confirmBlock()" href="{{route('admin.user.block',['id'=> $user->id])}}">Block</a>
                    </td>
                </tr>
                @endif

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th>Update</th>
                    <th>Block</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- /////////////////////////////////////////////////////////// -->
@if (count($user_block) != 0)
   

<div class="card">
    <div class="card-header">
        <h3 class="card-title">User Block-list</h3>

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
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th>Restore</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user )
                @if ($user->status ==2)
                <tr>
                    <td>
                        {{$loop -> iteration}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        @if($user->level ==1 && $user->id ==1)
                        <span class="right badge badge-primary">SuperAdmin</span>
                        @elseif($user->level ==1)
                        <span class="right badge badge-info">Admin</span>
                        @else
                        <span class="right badge badge-dark">Member</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-danger">Block</span>
                    </td>
                    <td>
                        {{date('d/m/Y - H:m:i',strtotime($user->created_at))}}
                    </td>
                    <td>
                        <a href="{{route('admin.user.restore',['id'=>$user->id])}}">Restore</a>
                    </td>
                    <td>
                        <a onclick="return confirmDelete()" href="{{route('admin.user.destroy',['id'=> $user->id])}}">Delete</a>
                    </td>
                </tr>
                @endif

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th>Restore</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->

@endif
@endsection