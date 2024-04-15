@extends('layouts.staff.app')

@section('title', 'Staff | Create Gasoline Price')

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
                    Create Gasoline Price
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
                                <form class="row" action="{{ route('staff.gasoline_fees.store') }}" method="post" id="gasoline_fee_form">
                                    @csrf
                                    <div class="col-md-10">
                                        <input type="hidden" name="gasoline_station_id" value="{{ auth()->user()->gasoline_station_id }}">
                                        
                                        <div class="form-group mb-2">
                                            <label class="form-label">Gasoline Type</label>
                                            <select class="form-control" name="type" id="gasoline_type">
                                                <option value="Unleaded">Unleaded</option>
                                                <option value="Premium">Premium</option>
                                                <option value="Diesel">Diesel</option>
                                                <option value="Kerosene">Kerosene</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2" id="custom_gasoline_type_container" style="display: none;">
                                            <label class="form-label">Custom Gasoline Type</label>
                                            <input class="form-control" type="text" name="custom_gasoline_type" id="custom_gasoline_type" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Price</label>
                                            <input class="form-control" type="number" min="0" name="price" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" onclick="promptStore(event, '#gasoline_fee_form')">Submit</button>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        document.getElementById('gasoline_type').addEventListener('change', function() {
                                            var customTypeContainer = document.getElementById('custom_gasoline_type_container');
                                            if (this.value === 'other') {
                                                customTypeContainer.style.display = 'block';
                                            } else {
                                                customTypeContainer.style.display = 'none';
                                            }
                                        });
                                    </script>
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

@endsection