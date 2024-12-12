@extends('master.master')

@section('content')
<div class="page-content">

    <nav class="page-breadcrumb d-flex align-center justify-content-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Distribute List Table</li>
        </ol>
        <a href="{{ route('admin.distribute.create') }}" class="btn btn-primary">Create
            Distribute </a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Distribute Table</h6>

                     <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>NID</th>
                                    <th>Payment Type</th>
                                    <th>Amount</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distributeFands as $item)
                                <tr>
                                    <td>{{ $item->user_id }}</td>

                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->nid ?? '' }}</td>
                                    <td>{{ $item->payment_type ?? '' }}</td>
                                    <td>{{ $item->amount ?? '' }}</td>

                                    <td>

                                        <a href="{{ route('admin.distribute.edit', $item->id) }}"
                                        class="btn btn-primary btn-icon">
                                        <i data-feather="edit"></i></a>
                                        <a href="{{ route('admin.distribute.show', $item->id) }}"
                                        class="btn btn-primary btn-icon">
                                        <i data-feather="eye"></i></a>

                                        @if (Auth::user()->role_id == 1)
                                        <form id="delete_form_{{ $item->id }}"
                                            action="{{ route('admin.distribute.destroy', $item->id) }}"
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
