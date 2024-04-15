@extends('layouts.staff.app')

@section('title', 'Staff | Edit Service')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.services.index') }}">
                        All Services
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Service
                </li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                @include('layouts.includes.alert')
                                <form class="row" action="{{ route('staff.services.update', $service) }}" method="post"
                                    id="service_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">

                                        <input type="hidden" name="gasoline_station_id"
                                            value="{{ auth()->user()->gasoline_station_id }}">

                                       <!-- Dropdown for selecting a service -->
                                        <div class="form-group">
                                            <label for="serviceDropdown">Select a Service:</label>
                                            <select class="form-control" id="serviceDropdown" name="service" required>
                                                <option value="Air for Tires" {{ $service->name == 'Air for Tires' ? 'selected' : '' }}>
                                                    Air for Tires
                                                </option>
                                                <option value="Water" {{ $service->name == 'Water' ? 'selected' : '' }}>
                                                    Water
                                                </option>
                                                <option value="Convenience Store" {{ $service->name == 'Convenience Store' ? 'selected' : '' }}>
                                                    Convenience Store
                                                </option>
                                                <option value="Comfort Room" {{ $service->name == 'Comfort Room' ? 'selected' : '' }}>
                                                    Comfort Room
                                                </option>
                                                <option value="Oil Shop" {{ $service->name == 'Oil Shop' ? 'selected' : '' }}>
                                                    Oil Shop
                                                </option>
                                                <option value="Hardware" {{ $service->name == 'Hardware' ? 'selected' : '' }}>
                                                    Hardware
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event, '#service_form')">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('img/auth/gas_station.svg') }}" alt="manage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
