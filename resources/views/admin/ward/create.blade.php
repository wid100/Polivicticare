@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Ward</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Ward</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card ">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Create ward</h6>
                        <form action="{{ route('admin.ward.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Ward Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" placeholder="Enter ward Name">
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
