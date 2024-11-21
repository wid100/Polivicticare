@extends('master.master')

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb d-flex align-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Found Category List</li>
            </ol>
            <a href="{{ route('admin.foundcategory.create') }}" class="btn btn-primary">Create
                Found Category </a>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Users Table</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($foundcategories as $foundcategory)
                                        <tr>
                                            <td>{{ $foundcategory->id }}</td>

                                            <td>{{ $foundcategory->name }}</td>

                                            <td>
                                                @if ($foundcategory->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Deactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.foundcategory.edit', $foundcategory->id) }}"
                                                    class="btn btn-primary btn-icon">
                                                    <i data-feather="edit"></i></a>

                                                @if (Auth::user()->role_id == 1)
                                                    <form id="delete_form_{{ $foundcategory->id }}"
                                                        action="{{ route('admin.foundcategory.destroy', $foundcategory->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-icon delete-button"
                                                            onclick="deleteId({{ $foundcategory->id }})">
                                                            <i data-feather="trash"></i>
                                                        </button>
                                                    </form>
                                                @endif

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
