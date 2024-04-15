@extends('layouts.admin.app')

@section('title', 'Admin | Edit Gasoline Price')

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
                    <a href="{{ route('admin.gasoline_fees.index') }}">
                        All Gasoline Price
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit Gasoline Price
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
                                <form class="row" action="{{ route('admin.gasoline_fees.update', $gasoline_fee) }}"
                                    method="post" id="gasoline_fee_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Gasoline Station</label>
                                                <select class="form-control" id="gasolineStationSelect" name="gasoline_station_id" required>
                                                    <option value=""></option>
                                                    @foreach ($gasoline_stations as $id => $gasoline_station)
                                                        <option value="{{ $id }}"
                                                            @if ($gasoline_fee->gasoline_station_id == $id) selected @endif>
                                                            {{ $gasoline_station }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="type">Gasoline Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="Unleaded">Unleaded</option>
                                                    <option value="Premium">Premium</option>
                                                    <option value="Diesel">Diesel</option>
                                                    <option value="Kerosene">Kerosene</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        
                                            <div class="form-group mb-2">
                                                <label for="custom_gasoline_type">Custom Gasoline Type</label>
                                                <input type="text" name="custom_gasoline_type" id="custom_gasoline_type" class="form-control" disabled>
                                            </div>
                                        
                                            <div class="form-group mb-2">
                                                <label for="price">Price</label>
                                                <input type="number" name="price" id="price" class="form-control">
                                            </div>
                                        
                                            <button type="button" class="btn btn-primary" onclick="promptUpdate(event, '#gasoline_fee_form')">Save</button>
                                        
                                        <script>
                                            const typeField = document.getElementById('type');
                                            const customGasolineTypeField = document.getElementById('custom_gasoline_type');
                                        
                                            // Add an event listener to the "type" field
                                            typeField.addEventListener('change', function () {
                                                // Check if "other" is selected
                                                if (typeField.value === 'other') {
                                                    customGasolineTypeField.removeAttribute('disabled'); // Enable the field
                                                } else {
                                                    customGasolineTypeField.setAttribute('disabled', 'disabled'); // Disable the field
                                                }
                                            });
                                        </script>
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
