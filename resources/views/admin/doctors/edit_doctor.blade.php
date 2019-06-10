@extends('admin.admin')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" id="top">
                            <h2 class="pageheader-title">Edit Doctor</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('doctors.list') }}" class="breadcrumb-link">All Doctors</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Doctor</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">Edit Doctor</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul style="margin: 0">
                                            @foreach($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('doctor.update', ['id' => $doctor->id]) }}" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $doctor->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Address</label>
                                                <input type="text" class="form-control" id="us2-address" name="address" value="{{ $doctor->address }}">
                                                <input type="hidden" id="lat" name="latitude" value="{{ $doctor->latitude }}">
                                                <input type="hidden" id="long" name="longitude" value="{{ $doctor->longitude }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="location-picker"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">City</label>
                                                <input type="text" class="form-control" name="city" value="{{ $doctor->city }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Zip Code</label>
                                                <input type="number" class="form-control" name="zip_code" value="{{ $doctor->zip_code }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Profile Picture</label>
                                                <input type="file" class="form-control" name="display_picture">
                                                <p style="margin: 10px 0 0 0">{{ $doctor->display_picture }}</p>
                                                <input type="hidden" name="display_picture_path" value="{{ $doctor->display_picture }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Cover Picture</label>
                                                <input type="file" class="form-control" name="cover">
                                                <p style="margin: 10px 0 0 0">{{ $doctor->cover }}</p>
                                                <input type="hidden" name="cover_path" value="{{ $doctor->cover }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                            <input type = "hidden" name = "_method" value = "PUT">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary" value="Update Doctor">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#location-picker').locationpicker({
            location: {
                latitude: parseFloat('{{ $doctor->latitude }}'),
                longitude: parseFloat('{{ $doctor->longitude }}')
            },
            radius: 300,
            inputBinding: {
                locationNameInput: $('#us2-address'),
                latitudeInput: $('#lat'),
                longitudeInput: $('#long')
            },
            enableAutocomplete: true
        });
    </script>
@endsection