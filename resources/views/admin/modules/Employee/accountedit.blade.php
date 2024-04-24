@extends('admin.master')

@section('module', 'Employee')
@section('action', 'Create')
@section('emp', 'menu-open')


@section('content')
<form method="post" action="{{ route('admin.employee.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Account edit</h3>

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
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" value="{{old('email')}}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" name="password" value="{{old('password')}}" required>
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="1">Actice</option>
                <option value="0">Lock</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="1" {{old('status', $acc->status) == 1 ? 'selected' : ''}} >Actice</option>
                <option value="0" {{old('status', $acc->status) == 0 ? 'selected' : ''}}>Lock</option>
            </select>
        </div>
        <div class="form-group">
            <label>Level</label>
            <select name="level" id="" class="form-control" required>
                @foreach ($levels as $level )
                <option value="{{$level->id}}" {{old('level', $acc->level_id) == $acc->level_id ? 'selected': ''}}>{{$level->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Create</button>
    </div>
    </div>

    <!-- /.card -->
</form>
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script ype='text/javascript'>
    $(document).ready(function() {
        $('#depart_id').change(function() {
            $('#position').empty();
            var depart_id = $('#depart_id').val();

            $.ajax({
                url: '/getpos/' + depart_id,
                type: 'get',
                dataType: 'json',
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;

                    }

                    if (len > 0) {
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                            var option = "<option value='" + id + "' {{old('position_id')== '" + id + "' ? 'selected' : '' }}>" + name + "</option>";

                            $('#position').append(option);
                        }
                    }
                }
            })
        });
    });
</script>
@endpush
@endsection