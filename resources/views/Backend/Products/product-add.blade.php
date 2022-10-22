@extends('Dashboard.master')
@section('Products')
    active
@endsection
@section('content')
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
                                    <form action="{{ route('SubCategoryPost') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
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
                                            </div>
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
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="category_id">Category Name</label>
                                                    <select name="category_id" id="category_id"
                                                        class="form-control @error('category_id') is-invalid @enderror form-selec"
                                                        aria-label=".form-select-lg example">
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
                                                    <label for="category_id">SubCategory Name</label>
                                                    <select name="category_id" id="category_id"
                                                        class="form-control @error('category_id') is-invalid @enderror form-selec"
                                                        aria-label=".form-select-lg example">

                                                    </select>
                                                    @error('category_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
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
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="product_thumbnail">Product Thumbnail</label>
                                                    <input id="product_thumbnail" type="text" name="product_thumbnail"
                                                        placeholder="Enter category name"
                                                        class="form-control @error('product_thumbnail') is-invalid @enderror"
                                                        value="{{ old('product_thumbnail') }}">
                                                    @error('product_thumbnail')
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

                                                    </select>
                                                </td>
                                                <td class="col-3">
                                                    <label for="size_id">Product Size</label>
                                                    <select class="form-control" name="size_id[]" id="size_id">
                                                        <option value="">--- Select Product Size---</option>

                                                    </select>
                                                </td>
                                                <td class="col-3">
                                                    <label for="price">Product Price</label>
                                                    <input type="text" name="price[]" placeholder="Product Price" class="form-control"/>
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

    <script>
        $(document).ready(function(){
            var i=1;
            $('#add').click(function(){
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'"><td class="col-3"><select class="form-control" name="color_id[]" id="color_id"><option value="">--- Select Product Color---</option></select></td> <td class="col-3"><select class="form-control" name="size_id[]" id="size_id"><option value="">--- Select Product Size---</option></select></td> <td class="col-3"><input type="text" name="price[]" placeholder="Product Price" class="form-control"/></td> <td class="col-3"><input type="text" name="quantity[]" placeholder="Product Quantity" class="form-control"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger ml-3 btn_remove btn-sm">Remove</button></td></tr>');
            });

            $(document).on('click', '.btn_remove', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
            });
        });
    </script>
@endsection
