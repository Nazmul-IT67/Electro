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
                                <h5 class="card-header">SubCategory Table({{ $sub_count }})</h5>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="col-sm-12">
                                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                                <strong>{{ session('success') }}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-right">
                                        <a href="{{ route('SubCategory') }}"><i class="fas fa-plus">Add</i></a>
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th scope="col">ID</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">SubCategory Name</th>
                                                <th scope="col">Created AT</th>
                                                <th scope="col">Updated AT</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subtrash as $key=> $data)
                                            <tr class="text-center">
                                                <th>{{ $subtrash->firstItem() +$key}}</th>
                                                <td>{{ $data->category->category_name }}</td>
                                                <td>{{ $data->subcategory_name }}</td>
                                                <td>{{ $data->created_at !=null ? $data->created_at->diffForHumans():'N/A' }}</td>
                                                <td>{{ $data->updated_at !=null ? $data->updated_at->diffForHumans():'N/A' }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-info btn-rounded" href="{{ route('UndoData', $data->id)}}"><i class="fas fa-edit">Undo</i></a>
                                                    <a class="btn btn-sm btn-warning btn-rounded" href="{{ route('DeleteData', $data->id) }}"><i class="fas fa-trash">Delete</i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
