@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Fund Request</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Fund Request</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Fund Request</h6>
                        <form action="{{ route('admin.foundrequest.update', $fundrequest->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">User Name </label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $fundrequest->user->name }}"">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Project Name </label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $fundrequest->project_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Project Name </label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $fundrequest->foundCategory->name ?? 'No Category' }}"">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">NID</label>
                                        <input type="text" class="form-control" disabled value="{{ $fundrequest->nid }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Location </label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $fundrequest->location }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Request Amount </label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $fundrequest->request_amount }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Description</label>
                                        <textarea class="form-control" id="description">{{ $fundrequest->description }}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Images</label>

                                        <div>
                                            @if ($fundrequest->image)
                                                @php
                                                    $images = json_decode($fundrequest->image, true); // Decode the JSON to get the array
                                                @endphp

                                                @if (!empty($images))
                                                    @foreach ($images as $image)
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            alt="Found Request Image" class="img-fluid rounded"
                                                            style="width: 33%">
                                                    @endforeach
                                                @else
                                                    <span class="badge bg-secondary">No Images</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">No Images</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <!-- Radio button for Pending -->
                                        <input type="radio" class="form-check-input" name="status" value="0"
                                            id="status_pending" @if ($fundrequest->status == 0) checked @endif>
                                        <label class="form-check-label" for="status_pending">Pending</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <!-- Radio button for Approved -->
                                        <input type="radio" class="form-check-input" name="status" value="1"
                                            id="status_approved" @if ($fundrequest->status == 1) checked @endif>
                                        <label class="form-check-label" for="status_approved">Approved</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <!-- Radio button for Declined -->
                                        <input type="radio" class="form-check-input" name="status" value="2"
                                            id="status_declined" @if ($fundrequest->status == 2) checked @endif>
                                        <label class="form-check-label" for="status_declined">Declined</label>
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
