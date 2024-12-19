@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Fund Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Fund Category</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Fund Category</h6>
                        <form action="{{ route('admin.foundcategory.update', $foundcategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Category Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Category Name"
                                            value="{{ old('name', $foundcategory->name) }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <!-- Hidden input to handle unchecked state -->
                                        <input type="hidden" name="status">
                                        <input type="checkbox" class="form-check-input" name="status" id="status"
                                            {{ old('status', $foundcategory->status) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
