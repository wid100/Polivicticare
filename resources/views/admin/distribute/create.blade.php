@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Distribution</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Distribution</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card ">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Create Distribution</h6>
                        <form action="{{ route('admin.distribute.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex gap-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">User ID<span
                                                class="text-danger">*</span></label>
                                        <input value="{{ old('user_id') }}" type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id"
                                            autocomplete="off" placeholder="User ID">
                                    </div>
                                        @error('user_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name<span
                                                class="text-danger">*</span></label>
                                        <input  type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Name" value="{{ old('name') }}">
                                    </div>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nid" class="form-label">Nid Number<span
                                                class="text-info"> (Optional)</span></label>
                                        <input type="text" class="form-control @error('nid') is-invalid @enderror" id="nid" name="nid"
                                            autocomplete="off" placeholder="Nid Number" value="{{ old('nid') }}">
                                    </div>
                                        @error('nid')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nid Photos<span
                                                class="text-danger">*</span></label>
                                        <input required type="file" class="form-control @error('nid_img') is-invalid @enderror" id="name" name="nid_img[]"
                                            autocomplete="off" placeholder="Nid Photos" multiple>
                                    </div>
                                        @error('nid_img')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="payment_type" class="form-label">Payment type<span
                                                class="text-danger">*</span></label>
                                    <select name="payment_type" class="form-select @error('payment_type') is-invalid @enderror" aria-label="Default select example">
                                        <option value="" selected>Select method</option>
                                        <option value="Bank" {{ old('payment_type') == 'Bank' ? 'selected' : '' }}>Bank</option>
                                        <option value="bKash" {{ old('payment_type') == 'bKash' ? 'selected' : '' }}>bKash</option>
                                        <option value="Nagad" {{ old('payment_type') == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                                        <option value="Rocket" {{ old('payment_type') == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                                    </select>
                                    </div>
                                    @error('payment_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Recept Photos<span
                                                class="text-info"> (Optional)</span></label>
                                        <input type="file" class="form-control @error('recept_img') is-invalid @enderror" id="name" name="recept_img[]"
                                            autocomplete="off" placeholder="Recept Photos" multiple>
                                    </div>
                                    @error('recept_img')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Amount<span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="name" name="amount"
                                            autocomplete="off" placeholder="Amount" required value="{{ old('amount') }}">
                                    </div>
                                    @error('amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
