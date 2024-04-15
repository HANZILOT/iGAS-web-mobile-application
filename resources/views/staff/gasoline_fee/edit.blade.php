@extends('layouts.staff.app')

@section('title', 'Staff | Edit Gasoline Price')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.gasoline_fees.index') }}">
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
                                <form class="row" action="{{ route('staff.gasoline_fees.update', $gasoline_fee) }}"
                                    method="post" id="gasoline_fee_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">

                                        <input type="hidden" name="gasoline_station_id"
                                            value="{{ auth()->user()->gasoline_station_id }}">

                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="type">Gasoline Type</label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="Unleaded">Unleaded</option>
                                                        <option value="Premium">Premium</option>
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="Kerosene">Kerosene</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="custom_gasoline_type">Custom Gasoline Type</label>
                                                    <input type="text" name="custom_gasoline_type" id="custom_gasoline_type" class="form-control" disabled>
                                                </div>
                                            
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" name="price" id="price" class="form-control">
                                                </div>
                                            
                                                <button type="button" class="btn btn-primary" onclick="promptUpdate(event, '#gasoline_fee_form')">Save</button>
                                            </form>
                                            </div>
                                            
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

@endsection
