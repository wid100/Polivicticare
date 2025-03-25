@extends('master.master')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Distribution</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show Distribution</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card ">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Show Distribution</h6>
                        <form>
                            @csrf
                            <div class="d-flex gap-2">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">User ID</label>
                                        <input value="{{ old('user_id', $data->user_id) }}" type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id"
                                            autocomplete="off" placeholder="User ID" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input disabled type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Name" value="{{ old('name', $data->name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">Nid Number</label>
                                            <input disabled type="text" class="form-control @error('nid') is-invalid @enderror" id="nid" name="nid"
                                                autocomplete="off" placeholder="Nid Number" value="{{ old('nid', $data->nid) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h5 for="payment_type" class="form-label">Payment type</h5>
                                            <select disabled name="payment_type" class="form-select @error('payment_type') is-invalid @enderror" aria-label="Default select example" style="background-color:#121e3b">
                                                <option value="" {{ old('payment_type', isset($data->payment_type) ? $data->payment_type : '') == '' ? 'selected' : '' }}>Select method</option>
                                                <option value="Bank" {{ old('payment_type', isset($data->payment_type) ? $data->payment_type : '') == 'Bank' ? 'selected' : '' }}>Bank</option>
                                                <option value="bKash" {{ old('payment_type', isset($data->payment_type) ? $data->payment_type : '') == 'bKash' ? 'selected' : '' }}>bKash</option>
                                                <option value="Nagad" {{ old('payment_type', isset($data->payment_type) ? $data->payment_type : '') == 'Nagad' ? 'selected' : '' }}>Nagad</option>
                                                <option value="Rocket" {{ old('payment_type', isset($data->payment_type) ? $data->payment_type : '') == 'Rocket' ? 'selected' : '' }}>Rocket</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Amount</label>
                                            <input disabled type="number" class="form-control @error('amount') is-invalid @enderror" id="name" name="amount"
                                                autocomplete="off" placeholder="Amount" required value="{{ old('amount', $data->amount) }}">
                                        </div>
                                        @error('amount')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h5 for="name" class="form-label">Nid Photos</h5>
                                            @php
                                                $nidImg = json_decode($data->nid_img);
                                            @endphp
                                            <div>
                                            @if ($nidImg && count($nidImg) > 0)
                                                @foreach ($nidImg as $image)
                                                   <a href="{{ asset('storage/' . $image) }}"  target="_blank" >
                                                        <img class="img-fluid me-2 img-zoom" src="{{ asset('storage/' . $image) }}" alt="NID Image" style="width: 100px; height: 100px;">
                                                   </a>
                                                @endforeach
                                            @else
                                                <p>No image available</p>
                                            @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h5 for="name" class="form-label">Recept Photos</h5>
                                            @php
                                                $receptImg = json_decode($data->recept_img);
                                            @endphp

                                            @if ($receptImg && count($receptImg) > 0)
                                                @foreach ($receptImg as $image)
                                                    <a href="{{ asset('storage/' . $image) }}" target="_blank" >
                                                        <img class="img-fluid me-2" src="{{ asset('storage/' . $image) }}" alt="Recept Image" style="width: 100px; height: 100px;">
                                                    </a>
                                                @endforeach
                                            @else
                                                <p>No image available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <a type="button" class="btn btn-primary me-2" href="{{ route('admin.distribute.index') }}">Back</a>
                            <a href="{{ route('admin.distribute.edit', $data->id) }}"
                                        class="btn btn-primary btn-icon">
                                        <i data-feather="edit"></i></a>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
