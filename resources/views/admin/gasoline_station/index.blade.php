@extends('layouts.admin.app')

@section('title', 'Admin | Manage Gasoline Station')

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
                        <select class="form-control form-control-sm" onchange="filterGasolineStationByMunicipality(this)">
                            <option value="">--- All Municipality --- </option>
                            @foreach ($municipalities as $id => $municipality)
                                <option value="{{ $id }}">{{ $municipality }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('admin.gasoline_stations.create') }}">Create
                            Gasoline Station +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover gasoline_station_dt">
                                <caption>List of Gasoline Station <i class="fas fa-clipboard ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th># &nbsp</th>
                                        <th>Featured Photo</th>
                                        <th>Gasoline Stations</th>
                                        <th>Address&nbsp;</th>
                                        <th>Municipality</th>
                                        <th>Latitude &nbsp&nbsp</th>
                                        <th>Longitude</th>
                                        <th>Always Open</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Gasoline Stations --}}
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
