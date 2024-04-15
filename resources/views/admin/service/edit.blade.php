@extends('layouts.admin.app')

@section('title', 'Admin | Edit Service')

@section('content')

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<style>
    .custom-search-dropdown .select2-search__field {
    width: 100% !important; 
    box-sizing: border-box;
}
</style>

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.services.index') }}">
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
                                <form class="row" action="{{ route('admin.services.update', $service->id) }}" method="post"
                                    id="service_form">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-10">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Gasoline Station</label>
                                            <select class="form-control" id="gasolineStationSelect" name="gasoline_station_id" required>
                                                <option value=""></option>
                                                @foreach ($gasoline_stations as $id => $gasoline_station)
                                                    <option value="{{ $id }}"
                                                        @if ($service->gasoline_station_id == $id) selected @endif>
                                                        {{ $gasoline_station }}</option>
                                                @endforeach
                                            </select>
                                        </div>

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
                                                onclick="promptStore(event, '#service_form')">Save</button>
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

    <script>
        $(document).ready(function() {
        $('#gasolineStationSelect').select2({
            placeholder: 'Select for a Gasoline Station ',
            allowClear: true,
            dropdownCssClass: 'custom-search-dropdown' // Adding a custom class for styling
        });
    });
    </script>

@endsection
