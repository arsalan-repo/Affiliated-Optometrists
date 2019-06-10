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
                            <h2 class="pageheader-title">All Doctors</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Doctors</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">All Doctors</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table id="doctors" class="display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>S#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Zip Code</th>
                                        <th>Profile Picture</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($doctors as $doctor)
                                        <?php
                                        $i++;
                                        $profile = asset('storage/'.$doctor->display_picture);
                                        ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->address }}</td>
                                            <td>{{ $doctor->city }}</td>
                                            <td>{{ $doctor->zip_code }}</td>
                                            <td>
                                                <img src="<?= (!empty($profile) ? $profile : 'https://www.fakenamegenerator.com/images/sil-male.png') ?>" style="width: 50px; height: 50px"/>
                                            </td>
                                            <td>
                                                <ul class="actions">
                                                    <li><a href="{{ route('doctor.edit', ['id' => $doctor->id]) }}"><span><i class="fa fa-edit"></i></span></a></li>
                                                    <li>
                                                        <form id="delete-category" method="post" action="{{ route('doctor.delete', ['id' => $doctor->id]) }}">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit"><span><i class="fa fa-trash"></i></span></button>
                                                        </form>
                                                    </li>
                                                </ul>
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
    </div>
@endsection