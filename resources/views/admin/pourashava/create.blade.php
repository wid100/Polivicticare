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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Division<span
                                                class="text-danger">*</span></label>
                                        {{-- select  --}}
                                        <select id="division" name="division" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            @isset($division)
                                                @foreach ($division as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Districts<span
                                                class="text-danger">*</span></label>
                                        {{-- select  --}}
                                        <select name="district" id="district" class="form-select">
                                            <option selected disabled>Select a district</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Pourashava Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            autocomplete="off" placeholder="Enter Pourashava Name">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // get district
        $(document).ready(function() {
            $('#division').on('change', function() {
                let divisionId = $(this).val();
                const host = window.location.origin;
                console.log(divisionId);

                // Clear and reset district dropdown
                $('#district').html('<option selected disabled>Loading...</option>');

                // Make API call to fetch districts
                $.ajax({
                    url: `${host}/api/district/${divisionId}`,
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer YOUR_API_TOKEN',
                    },
                    success: function(response) {
                        let districtOptions =
                            '<option selected disabled>Select a district</option>';
                        response.data.forEach(function(district) {
                            districtOptions +=
                                `<option value="${district.id}">${district.name}</option>`;
                        });

                        // Populate district dropdown
                        $('#district').html(districtOptions);
                        console.log('district data: ', response.data);
                    },
                    error: function(xhr) {
                        alert('Failed to fetch districts. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        // get thana
        $(document).ready(function() {
            $('#district').on('change', function() {
                let districtId = $(this).val();
                const host = window.location.origin;
                console.log(districtId);

                // Clear and reset district dropdown
                $('#thanas').html('<option selected disabled>Loading...</option>');

                // Make API call to fetch districts
                $.ajax({
                    url: `${host}/api/thanas/${districtId}`,
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer YOUR_API_TOKEN',
                    },
                    success: function(response) {
                        let thanaOptions = '<option selected disabled>Select a thana</option>';
                        response.data.forEach(function(thana) {
                            thanaOptions +=
                                `<option value="${thana.id}">${thana.name}</option>`;
                        });

                        // Populate district dropdown
                        $('#thanas').html(thanaOptions);
                        console.log('thanas data: ', response.data);
                    },
                    error: function(xhr) {
                        alert('Failed to fetch districts. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
