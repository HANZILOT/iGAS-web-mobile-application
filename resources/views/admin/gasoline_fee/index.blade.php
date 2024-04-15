@extends('layouts.admin.app')

@section('title', 'Admin | Manage Gasoline Price')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <select class="form-control form-control-sm" onchange="filterGasolineFeeByGasolineStation(this)">
                            <option value="">--- All Gasoline Station --- </option>
                            @foreach ($gasoline_stations as $id => $gasoline_station)
                                <option value="{{ $id }}">{{ $gasoline_station }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('admin.gasoline_fees.create') }}">Create
                            Gasoline Price +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover gasoline_fee_dt">
                                <caption>List of Gasoline Prices <i class="fas fa-clipboard ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th># &nbsp</th>
                                        <th>Gasoline Stations</th>
                                        <th>Types</th>
                                        <th>Prices</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Gasoline Fee --}}
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
