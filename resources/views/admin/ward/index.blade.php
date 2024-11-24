@extends('master.master')

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb d-flex align-center justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ward List Table</li>
            </ol>
            <a href="{{ route('admin.ward.create') }}" class="btn btn-primary">Create
                Ward </a>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Ward Table</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ward Name</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wards as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>

                                            <td>{{ $item->name }}</td>


                                            <td>
                                                {{-- <a href="{{ route('admin.categorys.edit', $item->id) }}"
                                                    class="btn btn-primary btn-icon">
                                                    <i data-feather="edit"></i></a> --}}

                                                @if (Auth::user()->role_id == 1)
                                                    <form id="delete_form_{{ $item->id }}"
                                                        action="{{ route('admin.ward.destroy', $item->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-icon delete-button"
                                                            onclick="deleteId({{ $item->id }})">
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
