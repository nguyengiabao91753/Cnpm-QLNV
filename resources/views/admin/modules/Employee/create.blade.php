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
<form method="post" action="{{ route('admin.employee.store') }}">
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
                                <option value="">Female</option>
                                <option value="">Male</option>
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
                            <select name="supervisor" id="" class="form-control" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Department</label>
                            <select name="depart" id="" class="form-control" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <select name="department" id="" class="form-control" required>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Salary Level</label>
                            <select name="salary_level" id="" class="form-control" required>

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" id="" class="form-control" required>

                            </select>
                        </div>

                    </div>
                </div>



        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>

    <!-- /.card -->
</form>
@endsection