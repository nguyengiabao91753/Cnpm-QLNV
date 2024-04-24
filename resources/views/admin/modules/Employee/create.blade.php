@extends('admin.master')

@section('module', 'Employee')
@section('action', 'Create')
@section('emp', 'menu-open')
@section('emp-create', 'active')
@push('js')

<script>
    document.getElementById('inputImage').addEventListener('change', function(event) {

        if (event.target.files && event.target.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Tạo một thẻ img
                var imgElement = document.createElement('img');
                // Gán dữ liệu hình ảnh đã đọc vào thuộc tính src của thẻ img
                imgElement.src = e.target.result;
                imgElement.style.width = '300px';
                imgElement.style.height = '250px';
                imgElement.classList.add('img-fluid');
                // Xóa hết nội dung của div
                document.getElementById('imagePreview').innerHTML = '';
                // Thêm thẻ img chứa hình ảnh vào trong div
                document.getElementById('imagePreview').appendChild(imgElement);
            }


            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endpush
@section('content')
<form method="post" action="{{ route('admin.employee.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee create</h3>

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
                <label>Full Name</label>
                <input type="text" class="form-control" placeholder="Enter your fullname" name="name" value="{{old('name')}}" required>
            </div>

            <div class="form-group">
                <label>Indentity Number</label>
                <input type="number" class="form-control" placeholder="Enter your identity number" name="identity_number" value="{{old('identity_number')}}" required>
            </div>

            <div class="row form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="" class="form-control" required>
                            <option value="Female" {{old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Male" {{old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Birhtday</label>
                        <input type="date" class="form-control" placeholder="" name="birthday" value="{{old('birthday')}}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter your email" name="email" value="{{old('email')}}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter your phone number" name="phone" value="{{old('phone')}}" required>
                    </div>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" id="inputImage" class="form-control" placeholder="Choose image file" name="image" value="{{old('image')}}" required>
                    </div>


                    <div id="imagePreview" class="form-group">

                    </div>


                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Supervisor</label>
                        <select name="supervisor" id="" class="form-control">
                            @foreach ($accs as $acc )
                            @php
                                $emp = DB::table('employees')->find($acc->id);
                            @endphp
                            <option value="{{$emp->id}}" {{old('supervisor' ) == $emp->id ? 'selected':''}}>{{$emp->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select name="depart" id="depart_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach ($deps as $dep )
                            <option value="{{$dep->id}}" {{old('depart' ) == $dep->id ? 'selected':'' }}>{{$dep->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <select name="position_id" id="position" class="form-control" required>

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Salary Level</label>
                        <select name="salary_level" id="" class="form-control" required>
                            @foreach ($sals as $sal )
                            <option value="{{$sal->id}}" {{old('salary_level' ) == $sal->id ? 'selected' : '' }}>{{$sal->base}}</option>
                            @endforeach
                        </select>
                    </div>



                </div>
            </div>
            <br>
            <hr>
        </div>
        <div class="card-body" style="padding-top: 0px;">
            <h3>Account</h3>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" value="{{old('password')}}" required>
            </div>
            <div class="form-group">
                <label>Level</label>
                <select name="level" id="" class="form-control" required>
                    @foreach ($levels as $level )
                    <option value="{{$level->id}}" {{old('level') == $level->id ? 'selected': ''}}>{{$level->name}}</option>
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
<script type='text/javascript'>
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