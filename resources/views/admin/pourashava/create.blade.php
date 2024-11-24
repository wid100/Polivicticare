@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pourashava</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Pourashava</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card ">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Create pourashavas</h6>
                        <form action="{{ route('admin.pourashava.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Thana Name <span
                                                class="text-danger">*</span></label>
                                        {{-- select  --}}
                                        <select name="thana" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            @isset($thanas)
                                                @foreach ($thanas as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Pourashava Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Category Name">
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
