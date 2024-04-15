@extends('layouts.admin.app')

@section('title', 'Admin | Manage Gasoline Service')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <select class="form-control form-control-sm" onchange="filterServiceByGasolineStation(this)">
                            <option value="">--- All Gasoline Stations --- </option>
                            @foreach ($gasoline_stations as $id => $gasoline_station)
                                <option value="{{ $id }}">{{ $gasoline_station }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('admin.services.create') }}">Create
                            Gasoline Service +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover service_dt">
                                <caption>List of Gasoline Service <i class="fas fa-clipboard ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th># &nbsp</th>
                                        <th>Gasoline Stations</th>
                                        <th>Services</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Gasoline Service --}}
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
