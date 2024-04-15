@extends('layouts.admin.app')

@section('title', 'Admin | Manage Gasoline Staff')

@section('styles')
    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <select class="form-control form-control-sm" onchange="filterGasolineFeeByGasolineStation(this)">
                            <option value="">--- All Gasoline Stations --- </option>
                            @foreach ($gasoline_stations as $id => $gasoline_station)
                                <option value="{{ $id }}">{{ $gasoline_station }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="{{ route('admin.staffs.create') }}">Create
                            Staff +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover staff_dt">
                                <caption>List of Staff <i class="fas fa-clipboard ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th># &nbsp</th>
                                        <th>Gasoline Station</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Sex &nbsp</th>
                                        <th>Address &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
                                        <th>Municipality</th>
                                        <th>Contact &nbsp&nbsp&nbsp&nbsp&nbsp</th>
                                        <th>Email &nbsp&nbsp&nbsp&nbsp&nbsp</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Gasoline Staffs --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
