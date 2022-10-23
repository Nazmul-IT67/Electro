@extends('Dashboard.master')
@section('Products')
    active
@endsection
@section('content')
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <h5 class="breadcrumb-item"><a href="{{ route('Dashboard') }}"
                                                class="breadcrumb-link"><i class="fas fa-home"></i> Dashboard/</a>
                                            <span class="text-capitalize">{{ $last }}</span>
                                        </h5>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end pageheader  -->
                <div class="ecommerce-widget">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <h5 class="card-header">Product</h5>
                                <div class="card-body">
                                    <form action="{{ route('InsertProduct') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input id="product_name" type="text" name="product_name"
                                                placeholder="Enter Product Name"
                                                class="form-control @error('product_name') is-invalid @enderror"
                                                value="{{ old('product_name') }}">
                                            @error('product_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="category_id">Category Name</label>
                                                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                                        <option value="">---Select Category---</option>
                                                        @foreach ($category as $data)
                                                            <option value="{{ $data->id }}">{{ $data->category_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="subcategory_id">SubCategory Name</label>
                                                    <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">

                                                    </select>
                                                    @error('subcategory_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="slug">Product Slug</label>
                                                    <input id="slug" type="text" name="slug"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        value="{{ old('slug') }}">
                                                    @error('slug')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="price">Product Price</label>
                                                    <input id="price" type="text" name="price"
                                                        placeholder="Enter Product Price"
                                                        class="form-control @error('price') is-invalid @enderror"
                                                        value="{{ old('price') }}">
                                                    @error('price')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="product_thumbnail">Product Thumbnail</label>
                                                    <input id="thumbnail" type="file" name="product_thumbnail" placeholder="Product Thumbnail" class="form-control @error('product_thumbnail') is-invalid @enderror"  value="{{ old('product_thumbnail') }}">
                                                    <div class="col-md-12 mb-2">
                                                        <img id="preview-image-before-upload" style="max-height: 250px;">
                                                    </div>
                                                    @error('product_thumbnail')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="product_thumbnail">Product Image</label>
                                                    <input multiple id="product_image" type="file" name="image[]"
                                                        placeholder="Enter category name"
                                                        class="form-control @error('product_image') is-invalid @enderror"
                                                        value="{{ old('product_image') }}">
                                                    @error('product_image')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h5 class="text-center">Product Attribute</h5>
                                        <table id="dynamic_field">
                                            <tr>
                                                <td class="col-3">
                                                    <label for="color_id">Product Color</label>
                                                    <select class="form-control" name="color_id[]" id="color_id">
                                                        <option value="">--- Select Product Color---</option>
                                                        @foreach ($color as $data)
                                                        <option value="{{ $data->id }}">{{ $data->color_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="col-3">
                                                    <label for="size_id">Product Size</label>
                                                    <select class="form-control" name="size_id[]" id="size_id">
                                                        <option value="">--- Select Product Size---</option>
                                                        @foreach ($size as $data)
                                                        <option value="{{ $data->id }}">{{ $data->size_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="col-3">
                                                    <label for="price">Product Price</label>
                                                    <input type="number" name="price[]" placeholder="Product Price" class="form-control"/>
                                                </td>
                                                <td class="col-3">
                                                    <label for="quantity">Product Quantity</label>
                                                    <input type="number" name="quantity[]" placeholder="Product Quantity" class="form-control"/>
                                                </td>
                                                <td class="col-2">
                                                    <label for="quantity">Add Input</label>
                                                    <button type="button" name="add" id="add" class="btn btn-success btn-sm">Add More</button>
                                                </td>
                                            </tr>
                                        </table>
                                        <hr>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="description">Product Description</label>
                                                    <textarea name="description" id="description" cols="5" rows="2"
                                                        class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}"
                                                        placeholder="Enter Product Description"></textarea>
                                                    @error('description')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="summery">Product Summery</label>
                                                    <textarea name="summery" id="summery" cols="5" rows="2"
                                                        class="form-control @error('summery') is-invalid @enderror" value="{{ old('summery') }}"
                                                        placeholder="Product Summery Hare"></textarea>
                                                    @error('summery')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                    <input type="checkbox" name="checkbox"
                                                        class="custom-control-input @error('checkbox') is-invalid @enderror"><span
                                                        class="custom-control-label">Remember me</span>
                                                    @error('checkbox')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </label>
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit"
                                                        class="btn btn-space btn-primary">Submit</button>
                                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
<script>
    //Product Slug//
    $('#product_name').keyup(function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
    });
    //Add More Input//
    $(document).ready(function(){
        var i=1;
        $('#add').click(function(){
        i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td class="col-3"><select class="form-control" name="color_id[]"  id="color_id"><option value="">--- Select Product Color---</option>@foreach ($color as $data)<option value="{{ $data->id }}">{{ $data->color_name }}</option>@endforeach</select></td> <td class="col-3"><select class="form-control" name="size_id[]" id="size_id"><option value="">--- Select Product Size---</option>@foreach ($size as $data)<option value="{{ $data->id }}">{{ $data->size_name }}</option>@endforeach</select></td> <td class="col-3"><input type="text" name="price[]" placeholder="Product Price" class="form-control"/></td> <td class="col-3"><input type="text" name="quantity[]" placeholder="Product Quantity"  class="form-control"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger ml-3 btn_remove  btn-sm">Remove</button></td></tr>');
            });

        $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        });
    });
    </script>
    {{-- Image Preview --}}
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#thumbnail').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
    {{-- Select Category --}}
    <script>
        $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        $('#category_id').change(function(){
            let category_id=$(this).val();
            if(category_id){
                $.ajax({
                    type: 'GET',
                    url: "{{ url('sub-cat') }}/"+category_id,
                    success: function(e){
                        if(e){
                            $('#subcategory_id').empty();
                            $('#subcategory_id').append('<option value>Select Once</option>');
                            $.each(e, function(key, value){
                                $('#subcategory_id').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            })
                        }else{
                            $('#subcategory_id').empty();
                        }
                    }
                })
            }else{
                $('#subcategory_id').empty();
            }
        });
    </script>
@endsection
