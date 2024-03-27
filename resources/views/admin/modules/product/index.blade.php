@extends('admin.master')

@section('module', 'Category')
@section('action', 'List')

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
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush
@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Product list</h3>

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
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>Create At</th>
                    <th>More</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product )
                @if ($product->status=1)


                @php
                $image= asset('uploads/'.$product->image)
                @endphp
                <tr>
                    <td>
                        {{$loop->iteration}}
                    </td>
                    <td>
                        {{$product->category->name}}
                    </td>
                    <td>
                        {{$product->name}}
                    </td>
                    <td>
                        <img src="{{$image}}" alt="" width="100px">
                    </td>
                    <td>
                        {{$product->price}}
                    </td>
                    <td>
                        @php
                        $color=DB::table('product_detail')->where('product_id',$product->id)->get();
                        foreach($color as $color){
                        echo "<span><i class='fa fa-circle' style='color:" . $color->color . ";'></i></span>";
                        }
                        @endphp
                    </td>
                    <td>
                        @if ($product -> featured ==1)
                        <span class="badge rounded-pill bg-info text-dark">Unfeature</span>
                        @else
                        <span class="badge rounded-pill bg-warning text-dark">Featured</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-success">Show</span>
                    </td>
                    <td>
                        {{Str::limit($product->description,10)}}
                    </td>
                    <td>
                        {{Str::limit($product->content,10)}}
                    </td>
                    <td>
                        {{date('d/m/Y - H:m:i',strtotime($product->created_at))}}
                    </td>
                    <td>
                        <a href="{{route('admin.product.show',['id' =>$product->id])}}">More</a>
                    </td>
                    <td>
                        <a onclick="return confirmRestore()" href="{{route('admin.product.edit',['id'=>$product->id])}}">Update</a>
                    </td>
                    <td>
                        <a onclick="return confirmDelete()" href="{{route('admin.product.destroy',['id'=> $product->id])}}">Delete</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Content</th>
                    <th>Create At</th>
                    <th>More</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- /.card -->


@endsection