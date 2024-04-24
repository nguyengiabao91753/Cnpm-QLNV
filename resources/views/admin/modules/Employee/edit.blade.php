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
<form method="post" action="{{ route('admin.employee.update',['id'=>$emp->id]) }}" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employee update</h3>

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
                <input type="text" class="form-control" placeholder="Enter your fullname" name="name" value="{{old('name',$emp->name)}}" required>
            </div>

            <div class="form-group">
                <label>Indentity Number</label>
                <input type="number" class="form-control" placeholder="Enter your identity number" name="identity_number" value="{{old('identity_number', $emp->identity_number)}}" required>
            </div>

            <div class="row form">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="" class="form-control" required>
                            <option value="Female" {{old('gender', $emp->gender ) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Male" {{old('gender', $emp->gender ) == 'Male' ? 'selected' : '' }}>Male</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Birhtday</label>
                        <input type="date" class="form-control" placeholder="" name="birthday" value="{{old('birthday',$emp->birthday)}}" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Enter your email" name="email" value="{{old('email',$emp->email)}}" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" class="form-control" placeholder="Enter your phone number" name="phone" value="{{old('phone',$emp->phone)}}" required>
                    </div>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" id="inputImage" class="form-control" placeholder="Choose image file" name="image" value="{{old('image')}}">
                    </div>


                    <div id="imagePreview" class="form-group">
                        <img src="{{asset('uploads/'.$emp->image)}}" class="img-fluid" style="width: 300px;height: 250px;" alt="">
                    </div>


                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Supervisor</label>
                        <select name="supervisor" id="" class="form-control" required>
                            @foreach ($accs as $acc )
                            @if ($emp->supervisor_id != null)
                                
                            @php
                                $empf = DB::table('employees')->find($acc->id);
                            @endphp
                            <option value="{{$empf->id}}" {{old('supervisor', $empf->id ) == $emp->supervisor_id ? 'selected':''}}>{{$empf->name}}</option>
                            
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select name="depart" id="depart_id" class="form-control" required>
                            @foreach ($deps as $dep )

                            @php
                            $depemp = DB::table('departments')->where('id', $emp->position->department_id)->first();
                            @endphp
                            <option value="{{$dep->id}}" {{old('depart', $depemp->id ) == $dep->id ? 'selected':'' }}>{{$dep->name}}</option>


                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <select name="position_id" id="pos" class="form-control" required>
                            @php
                            $pos = DB::table('positions')->where('department_id', $emp->position->department_id)->get();
                            @endphp
                            @foreach ($pos as $po )
                            <option value="{{$po->id}}" {{old('position_id', $po->id) == $emp->position_id ? 'selected' :'' }}>{{$po->name}}</option>
                            @endforeach
                            <!-- <option value="{{$emp->position_id}}">{{$emp->position->name}}</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Salary Level</label>
                        <select name="salary_level" id="" class="form-control" required>
                            @foreach ($sals as $sal )
                            <option value="{{$sal->id}}" {{old('salary_level', $sal->id ) == $emp->salary_level? 'selected' : '' }}>{{$sal->base}}</option>
                            @endforeach
                        </select>
                    </div>

                    

                </div>
            </div>

        </div>


        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>

    <!-- /.card -->
</form>
@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        $('#depart_id').change(function() {
            $('#pos').empty();
            var depart_id = $(this).val();

            $.ajax({
                url: '/getpos/' + depart_id,
                type: 'get',
                success: function(response) {
                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;

                    }

                    if (len > 0) {
                        $('#pos').empty();
                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].id;
                            var name = response['data'][i].name;

                            var option = "<option value='" + id + "' {{old('position_id', $emp->position_id )== '" + id + "' ? 'selected' : ''}}>" + name + "</option>";

                            $('#pos').append(option);
                        }
                    }
                }
            })
        });
    });
</script>
@endpush
@endsection