@extends('admin.master')

@section('module', 'Product')
@section('action', 'View')


@section('content')

<form method="post" action="" enctype="multipart/form-data">
    @csrf
    <!-- Default box -->
    <div class="card">
        <div class="card-header" >
            <h3 class="card-title">Product information</h3>

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
                        <input type="text" class="form-control" name="name" value="{{$product->name}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control"  name="price" value="{{$product->price}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" disabled>{{$product->description}}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" name="content" disabled>{{$product->content}}</textarea>
                    </div>


                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" name="" value="{{$product->category->name}}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Featured</label>
                        <select class="form-control" name="featured" disabled>
                            <option value="1" {{old('$product->featured')==1 ? 'selected' : '' }}>UnFeatured</option>
                            <option value="2" {{old('$product->featured')==2 ? 'selected' : '' }}>Featured</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <img src="{{asset('uploads/'.$product->image)}}" class="form-control" style="width: 500px;height:350px" alt="">
                    </div>
                </div>

            </div>
            @foreach ($product_detail as $detail )
                   
                    
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="form-control">Color: <span><i class="fa fa-circle" style="color:  {{$detail -> color}} ;" ></i></span></label>
                        <label for="" class="form-control">Quantity: <span>{{$detail->quantity}}</span></label>
                        @php
                            $multi_img = DB::table('product_images')->where('product_detail_id',$detail->id)->get();
                        @endphp
                        @foreach ( $multi_img as $img_detail )
                            <div class="form-control" style="margin-right: 5px;height: 150px;">
                                <img src="{{asset('uploads/'.$img_detail->image_url)}}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card-footer">
       <a href="{{route('admin.product.index')}}">Back</a>
    </div>
    </div>
    <!-- /.card -->
</form>
@endsection