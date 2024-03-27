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
                    <th>Birthday</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Create At</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>1990-05-15</td>
                    <td>john.doe@example.com</td>
                    <td>1234567890</td>
                    <td>123 Main St</td>
                    <td>0987654321</td>
                    <td>456 Oak Ave</td>
                    <td>2024-03-15 08:00:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>1985-10-20</td>
                    <td>jane.smith@example.com</td>
                    <td>0987654321</td>
                    <td>456 Oak Ave</td>
                    <td>1234567890</td>
                    <td>123 Main St</td>
                    <td>2024-03-14 09:30:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Michael Johnson</td>
                    <td>1982-08-10</td>
                    <td>michael.johnson@example.com</td>
                    <td>9876543210</td>
                    <td>789 Maple Rd</td>
                    <td>1234567890</td>
                    <td>123 Main St</td>
                    <td>2024-03-13 11:45:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Emily Brown</td>
                    <td>1995-04-25</td>
                    <td>emily.brown@example.com</td>
                    <td>0123456789</td>
                    <td>789 Maple Rd</td>
                    <td>0987654321</td>
                    <td>456 Oak Ave</td>
                    <td>2024-03-12 14:20:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>William Davis</td>
                    <td>1988-12-30</td>
                    <td>william.davis@example.com</td>
                    <td>0123456789</td>
                    <td>456 Oak Ave</td>
                    <td>1234567890</td>
                    <td>123 Main St</td>
                    <td>2024-03-11 16:50:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Olivia Wilson</td>
                    <td>1993-07-05</td>
                    <td>olivia.wilson@example.com</td>
                    <td>9876543210</td>
                    <td>123 Main St</td>
                    <td>0987654321</td>
                    <td>456 Oak Ave</td>
                    <td>2024-03-10 18:15:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Ethan Martinez</td>
                    <td>1986-09-18</td>
                    <td>ethan.martinez@example.com</td>
                    <td>1234567890</td>
                    <td>789 Maple Rd</td>
                    <td>9876543210</td>
                    <td>123 Main St</td>
                    <td>2024-03-09 20:40:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Ava Garcia</td>
                    <td>1991-02-14</td>
                    <td>ava.garcia@example.com</td>
                    <td>0123456789</td>
                    <td>789 Maple Rd</td>
                    <td>1234567890</td>
                    <td>123 Main St</td>
                    <td>2024-03-08 22:05:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>James Rodriguez</td>
                    <td>1987-06-23</td>
                    <td>james.rodriguez@example.com</td>
                    <td>9876543210</td>
                    <td>456 Oak Ave</td>
                    <td>0987654321</td>
                    <td>456 Oak Ave</td>
                    <td>2024-03-07 00:30:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Sophia Hernandez</td>
                    <td>1994-11-28</td>
                    <td>sophia.hernandez@example.com</td>
                    <td>1234567890</td>
                    <td>789 Maple Rd</td>
                    <td>9876543210</td>
                    <td>123 Main St</td>
                    <td>2024-03-06 02:55:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Logan Adams</td>
                    <td>1999-08-08</td>
                    <td>logan.adams@example.com</td>
                    <td>0123456789</td>
                    <td>123 Main St</td>
                    <td>1234567890</td>
                    <td>123 Main St</td>
                    <td>2024-03-05 05:20:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Chloe Lee</td>
                    <td>1996-12-12</td>
                    <td>chloe.lee@example.com</td>
                    <td>9876543210</td>
                    <td>456 Oak Ave</td>
                    <td>0987654321</td>
                    <td>456 Oak Ave</td>
                    <td>2024-03-04 06:45:00</td>
                    <td><a href="#"><span class="badge badge-success">Update</span></a></td>
                    <td><a href="#"><span class="badge badge-danger">Delete</span></a></td>
                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Birthday</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Create At</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->


@endsection