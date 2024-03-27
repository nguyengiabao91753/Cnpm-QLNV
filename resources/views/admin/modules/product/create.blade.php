@extends('admin.master')

@section('module', 'Product')
@section('action', 'Create')

@push('hanldejs')
<script type="text/javascript">
    var colorCount = 0;
    $(document).ready(function() {
        $("#add-color").click(function() {
            colorCount++;
            var newrow = `
            <div class="row align-items-center">
                        <div class=" col-sm-10">
                            <div class="form-group col-md-2" style="text-align: center;float:right;">
                                <button type="button" id="delete-${colorCount}"  data-color="${colorCount}" class="form-control btn btn-danger delete-color"><i class="fa fa-minus-square"></i></button>
                            </div>
                            <div class="form-group">
                                <select name="color[]" class="form-control" id="color-${colorCount}">
                                    <option value="">Select Color</option>
                                    <option value="red">Red</option>
                                    <option value="green">Green</option>
                                    <option value="yellow">Yellow</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="file" name="imgUpload[]" id="imgUpload-${colorCount}" class="form-control" data-image="${colorCount}" placeholder="Choose Image" multiple accept="image/*">
                            </div>
                            <div class="form-group">
                                <div class="form-control" id="preview-${colorCount}" style="height: 100px;"></div>
                            </div>

                            <div class="form-group">
                                <input type="number" name="quantity[]" class="form-control" id="quantity-${colorCount}" placeholder="Enter Quantity" required>
                            </div>
                        </div>
                        <hr>
                    <hr>
                    
            </div>`;

            $(".group-color").append(newrow);

        })

        $(".group-color").on('click', '.delete-color', function() {

            var Num = $(this).data("color");

            $("#delete-" + Num).closest(".row").remove();

        });
        $(".group-color").on('change', 'input[name="imgUpload[]"]', function() {
            // var previewContainer = document.getElementById('preview');
            //     previewContainer.innerHTML = '';
            var Num = $(this).data("image");
            var files = this.files;

            var previewId = "#preview-" + Num;
            var previewDiv = $(previewId);

           
            previewDiv.html("");
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();


                    
                    reader.onload = function(e) {
                     
                        var imgElement = $('<img>').attr({
                            src: '',
                            alt: 'Preview',
                            style: 'max-width:100%; max-height:100%;'
                        });          

                        imgElement.attr('src', e.target.result);
                        previewDiv.append(imgElement);
                    }
 
                    reader.readAsDataURL(file);
                }
            }

        });


    })
</script>

@endpush
@section('content')

<form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header" >
            <h3 class="card-title">Product create</h3>

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
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Product name</label>
                        <input type="text" class="form-control" placeholder="Enter product name" name="name">
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" placeholder="Enter product price" name="price">
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content"></textarea>
                    </div>


                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            <option value="" {{ old('category_id')== 0 ? 'selected' : '' }}>----- Root -----</option>

                            @php
                            recursiveCategory($categories,old('category_id',0))
                            @endphp
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Featured</label>
                        <select class="form-control" name="featured">
                            <option value="1" {{old('featured')==1 ? 'selected' : '' }}>UnFeatured</option>
                            <option value="2" {{old('featured')==2 ? 'selected' : '' }}>Featured</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8 group-color">


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="button" class="form-control btn btn-info" name="" id="add-color" value="Add Color">
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