@extends('admin.admin_layouts')

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('/admin/brands') }}">Brand</a></li>
                            <li class="breadcrumb-item active">Brand Update</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card container">
                            <!-- /.card-header -->
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ url('update/brand/'.$brand->id) }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Brand Name</label>
                                            <input type="text" class="form-control" value="{{ $brand->brand_name }}" id="exampleInputBrand" placeholder="Enter Brand Name" name="brand_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Brand Logo</label>
                                            <input type="file" class="form-control" value="{{ $brand->brand_name }}" id="exampleInputBrand" name="brand_logo">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Old Brand Logo</label>
                                            <img src="{{ URL::to($brand->brand_logo) }}" height="70px;" width="90px;" alt="">
                                            <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><a
                                                href="{{ url()->previous() }}">Back</a></button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>




@endsection
