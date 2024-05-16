@extends('admin.master')

@section('module', 'Employee')
@section('action', 'List')
@section('emp', 'menu-open')
@section('emp-acc', 'active')
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
            "autoWidth": true,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function confirmDelete() {
        return confirm('Are you sure you want to lock this account?');
    }

    function confirmRestore() {
        return confirm('Are you sure you want to unlock this account?');
    }
</script>
@endpush
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Account list</h3>

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
                    <th>Password</th>
                    <th>Level</th>
                    <th>Status</th>
                    
                    <th>Block</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accs as $acc )
                <tr>
                    <td> {{$loop->iteration}} </td>
                    <td> {{$acc->email}} </td>
                    <td>{{ $acc->password }}</td>
                    <td>{{$acc->level->name}}</td>
                    <td>
                        <p  class="badge badge-info">Active</p>
                    </td>
                    <td>
                        @if (Auth::guard('admin')->id() != $acc->id)
                            
                        <a onclick="return confirmDelete()" href="{{route('admin.account.destroy',['id'=> $acc->id])}}" class="btn btn-danger"> <i class="fas fa-lock"></i> Lock</a>
                        @endif

                    </td>
                </tr>

                @endforeach
            </tbody>

            <tfoot>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Level</th>
                <th>Status</th>
               
                <th>Blovk</th>
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Locked list</h3>

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
                    <th>Password</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Unlock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accdeletes as $acc )
                <tr>
                    <td> {{$loop->iteration}} </td>
                    @php
                    $emp = DB::table('employees')->find($acc->id);
                   
                    @endphp
                    <td> {{$emp->email}} </td>
                    <td>{{ bcrypt($acc->password) }}</td>
                    <td>{{$acc->level->name}}</td>
                    <td>
                        <p class="badge badge-secondary">Locked</p>
                    </td>
                    <!-- <td>
                        <a href="{{route('admin.account.edit',['id'=>$acc->id])}}" class="btn btn-success"> <i class="far fa-edit"></i> Update</a>
                    </td> -->
                    <td>
                    <a onclick="return confirmRestore()" href="{{route('admin.account.restore',['id'=> $acc->id])}}" class="btn btn-success"> <i class="fas fa-unlock"></i> Unlock</a>
                    </td>
                </tr>

                @endforeach
            </tbody>

            <tfoot>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Level</th>
                <th>Status</th>
                
                <th>Unlock</th>
            </tfoot>
        </table>
    </div>
</div>

@endsection