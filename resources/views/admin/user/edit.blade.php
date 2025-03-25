@extends('master.master')

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Basic Elements</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Basic Form</h6>

                        <form class="forms-sample" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user->name }}" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Division<span
                                                class="text-danger">*</span></label>
                                        {{-- select  --}}
                                        <select id="division" name="division" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            @isset($division)
                                                @foreach ($division as $item)
                                                    <option value="{{ $item->id }}" {{ $user->division_id == $item->id ? 'selected' : '' }}>{{ $item->name ?? '' }}</option>
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

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Thana Name <span
                                                class="text-danger">*</span></label>
                                        {{-- select  --}}
                                        <select id="thanas" name="thana" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            {{-- @isset($thanas)
                                                @foreach ($thanas as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                            @endisset --}}
                                        </select>
                                    </div>
                                </div>






                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $user->phone }}" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input"
                                            {{ $user->email_verified_at ? 'checked' : '' }} id="email_verified_at"
                                            name="email_verified_at">
                                        <label class="form-check-label" for="email_verified_at">
                                            Account Verify
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input"
                                            {{ $user->role_id == 4 ? 'checked' : '' }} id="role_id" name="role_id">
                                        <label class="form-check-label" for="role_id">
                                            Block Account
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function () {
        const host = window.location.origin;
        let divisionId = $('#division').val();
        let districtId = "{{ $user->district_id ?? '' }}"; // Set from backend
        let thanaId = "{{ $user->thana_id ?? '' }}"; // Set from backend

        if (divisionId) {
            fetchDistricts(divisionId, districtId);
        }

        $('#division').on('change', function () {
            let divisionId = $(this).val();
            fetchDistricts(divisionId);
        });

        $('#district').on('change', function () {
            let districtId = $(this).val();
            fetchThanas(districtId);
        });

        function fetchDistricts(divisionId, preselectedDistrict = null) {
            $('#district').html('<option selected disabled>Loading...</option>');

            $.ajax({
                url: `${host}/api/district/${divisionId}`,
                type: 'GET',
                headers: { 'Authorization': 'Bearer YOUR_API_TOKEN' },
                success: function (response) {
                    let districtOptions = '<option selected disabled>Select a district</option>';
                    response.data.forEach(function (district) {
                        let selected = (district.id == preselectedDistrict) ? 'selected' : '';
                        districtOptions += `<option value="${district.id}" ${selected}>${district.name}</option>`;
                    });

                    $('#district').html(districtOptions);

                    if (preselectedDistrict) {
                        $('#district').val(preselectedDistrict).trigger('change');
                    }
                },
                error: function (xhr) {
                    alert('Failed to fetch districts.');
                    console.error(xhr.responseText);
                }
            });
        }

        function fetchThanas(districtId) {
            $('#thanas').html('<option selected disabled>Loading...</option>');

            $.ajax({
                url: `${host}/api/thanas/${districtId}`,
                type: 'GET',
                headers: { 'Authorization': 'Bearer YOUR_API_TOKEN' },
                success: function (response) {
                    let thanaOptions = '<option selected disabled>Select a thana</option>';
                    response.data.forEach(function (thana) {
                        let selected = (thana.id == thanaId) ? 'selected' : '';
                        thanaOptions += `<option value="${thana.id}" ${selected}>${thana.name}</option>`;
                    });

                    $('#thanas').html(thanaOptions);
                    $('#thanas').val(thanaId); // Set thana if preselected
                },
                error: function (xhr) {
                    alert('Failed to fetch thanas.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>



@endsection
