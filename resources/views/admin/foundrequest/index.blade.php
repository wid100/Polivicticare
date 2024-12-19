@extends('master.master')

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb d-flex align-items-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Fund Request</li>
            </ol>
            <a href="{{ route('admin.foundrequest.create') }}" class="btn btn-primary">Create Fund Request</a>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Fund Requests Table</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Project Name</th>
                                        <th>Category</th>
                                        <th>NID</th>
                                        <th>Location</th>
                                        <th>Request Amount</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foundrequests as $foundrequest)
                                        <tr>
                                            <td>{{ $foundrequest->id }}</td>

                                            <!-- Display user image if available -->
                                            <td>
                                                @if ($foundrequest->image)
                                                    @php
                                                        $images = json_decode($foundrequest->image, true); // Decode the JSON
                                                    @endphp

                                                    @if (!empty($images) && isset($images[0]))
                                                        <img src="{{ asset('storage/' . $images[0]) }}"
                                                            alt="Found Request Image" class="img-fluid rounded"
                                                            style="width: 50px; height: 50px;">
                                                    @else
                                                        <span class="badge bg-secondary">No Image</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-secondary">No Image</span>
                                                @endif
                                            </td>

                                            <!-- User name -->
                                            <td>{{ $foundrequest->user->name }}</td>

                                            <!-- Project details -->
                                            <td>{{ $foundrequest->project_name }}</td>
                                            <td>{{ $foundrequest->foundCategory->name ?? 'No Category' }}</td>

                                            <td>{{ $foundrequest->nid }}</td>
                                            <td>{{ $foundrequest->location }}</td>
                                            <td>TK - {{ number_format($foundrequest->request_amount, 2) }}</td>

                                            <!-- Created at -->
                                            <td>{{ $foundrequest->created_at->format('Y-m-d H:i') }}</td>

                                            <!-- Status -->
                                            <td>
                                                @if ($foundrequest->status == 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @elseif ($foundrequest->status == 2)
                                                    <span class="badge bg-danger">Declined</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                <a href="{{ route('admin.foundrequest.edit', $foundrequest->id) }}"
                                                    class="btn btn-primary btn-icon">
                                                    <i data-feather="eye"></i>
                                                </a>

                                                @if (Auth::user()->role_id == 1)
                                                    <form id="delete_form_{{ $foundrequest->id }}"
                                                        action="{{ route('admin.foundrequest.destroy', $foundrequest->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-icon delete-button"
                                                            onclick="deleteId({{ $foundrequest->id }})">
                                                            <i data-feather="trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
@endsection
