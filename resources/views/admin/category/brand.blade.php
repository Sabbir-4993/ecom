@extends('admin.admin_layouts')

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brand Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Brand List</li>
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

                        <div class="card">
                            <div class="card-header">
                                <a href="#" class="btn btn-sm btn-warning" style="float: right" data-toggle="modal" data-target="#modal-default">Add New</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    @foreach($brand as $key=>$row)
                                        <tr>
                                            <td>{{ $key +1 }}</td>
                                            <td>{{ $row->brand_name }}</td>
                                            <td><img src="{{ URL::to($row->brand_logo) }}" height="80px;" width="80px;" alt=""></td>
                                            <td>
                                                <a href="{{ URL::to('edit/brand/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                <a href="{{ URL::to('delete/brand/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
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



    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Brand Add</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputCategory">Add New</label>
                            <input type="text" class="form-control" id="exampleInputCategory" placeholder="Enter Brand" name="brand_name">
                        </div>
                        <div class="form-group">
                            <label for="">Brand Logo</label>
                            <input type="file" class="form-control"  name="brand_logo" id="customFile">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
