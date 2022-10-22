@extends('Dashboard.master')
@section('SubCategory')
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
                                <h5 class="card-header">SubCategory</h5>
                                <div class="card-body">
                                    <form action="{{ route('SubCategoryPost') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="category_id">Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror form-selec" aria-label=".form-select-lg example">
                                                <option value="">---Select Category---</option>
                                                @foreach ($category as $data)
                                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="subcategory_name">Category Name</label>
                                            <input id="subcategory_name" type="text" name="subcategory_name" placeholder="Enter category name" class="form-control @error('subcategory_name') is-invalid @enderror" value="{{ old('subcategory_name') }}">
                                            @error('subcategory_name')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                                <label class="be-checkbox custom-control custom-checkbox">
                                                    <input type="checkbox" name="checkbox" class="custom-control-input @error('checkbox') is-invalid @enderror"><span class="custom-control-label">Remember me</span>
                                                    @error('checkbox')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </label>
                                            </div>
                                            <div class="col-sm-6 pl-0">
                                                <p class="text-right">
                                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
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
