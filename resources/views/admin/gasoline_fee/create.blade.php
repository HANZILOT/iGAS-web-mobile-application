@extends('layouts.admin.app')

@section('title', 'Admin | Create Gasoline Price')

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
                                <form class="row" action="{{ route('admin.gasoline_fees.store') }}" method="post" id="gasoline_fee_form">
                                    @csrf
                                    <div class="col-md-10">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Gasoline Station</label>
                                            <select class="form-control" id="gasolineStationSelect" name="gasoline_station_id" required>
                                                <option value=""></option>
                                                @foreach ($gasoline_stations as $id => $gasoline_station)
                                                    <option value="{{ $id }}">{{ $gasoline_station }}</option>
                                                @endforeach
                                            </select>
                                        </div>

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
