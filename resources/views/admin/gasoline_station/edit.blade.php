@extends('layouts.admin.app')

@section('title', 'Admin | Edit Gasoline Station')

@section('content')

<style>
    #map {
        height: 300px; /* Customize the height */
        width: 100%; /* Customize the width */
    }

        /* Base styles */
.coordinates-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px; /* Add space between the map and the container */
}

.input-field-wrapper {
    flex: 1; /* Distribute available space equally between the two input fields */
    display: flex;
    flex-direction: column;
}

.input-label {
    margin-bottom: 5px;
}

.input-field {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px; /* Add space between input fields */
}

/* Responsive styles for mobile */
@media (max-width: 768px) {
    .coordinates-container {
        flex-direction: column; /* Stack items vertically on smaller screens */
    }

    .input-field-wrapper {
        margin-bottom: 10px; /* Add space between latitude and longitude on mobile */
    }
}
</style>

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.gasoline_stations.index') }}">
                        All Gasoline Station
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Edit {{ $gasoline_station->name }}
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
                                <form class="row"
                                    action="{{ route('admin.gasoline_stations.update', $gasoline_station) }}" method="post"
                                    enctype="multipart/form-data" id="gasoline_station_form">
                                    @csrf @method('PUT')
                                    <div class="col-md-10">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Gasoline Station</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ex. Shell" value="{{ $gasoline_station->name }}" required>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Complete Address" value="{{ $gasoline_station->address }}"
                                                required>
                                        </div>


                                        <div class="form-group mb-2">
                                            <label class="form-label">Email </label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $gasoline_station->email }}" required>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label class="form-label">Contact</label>
                                            <input type="number" min="0" class="form-control" name="contact"
                                                value="{{ $gasoline_station->contact }}" required>
                                        </div>


                                        <div class="form-group mb-2">
                                            <label class="form-label">Municipality</label>
                                            <select class="form-control" name="municipality_id" required>
                                                <option value=""></option>
                                                @foreach ($municipalities as $id => $municipality)
                                                    <option value="{{ $id }}"
                                                        @if ($gasoline_station->municipality_id == $id) selected @endif>
                                                        {{ $municipality }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <br>
                                        <div id="map" style="margin-bottom: 20px;"></div>
                                         <div class="coordinates-container">
                                            <div class="input-field-wrapper">
                                                <label for="latitude" class="input-label">Latitude</label>
                                                <input type="text" id="latitude" name="latitude" value="{{ $gasoline_station->latitude }}" class="input-field">
                                            </div>
                                            <div class="input-field-wrapper">
                                                <label for="longitude" class="input-label">Longitude</label>
                                                <input type="text" id="longitude" name="longitude"  value="{{ $gasoline_station->longitude }}" class="input-field">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-2">
                                            <label class="form-label">Is always Open?</label>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="yes" name="is_always_open"
                                                    class="custom-control-input" value="1"
                                                    @if ($gasoline_station->is_always_open == '1') checked @endif>
                                                <label class="custom-control-label" for="yes">Yes</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="no" name="is_always_open"
                                                    class="custom-control-input" value="0"
                                                    @if ($gasoline_station->is_always_open == '0') checked @endif>
                                                <label class="custom-control-label" for="no">No</label>
                                            </div>
                                        </div>

                                        <div class="{{ $gasoline_station->is_always_open ? 'd-none' : '' }}"
                                            id="timeInputs">
                                            <div class="form-group mb-2">
                                                <label class="form-label">Opening Time</label>
                                                <input type="time" class="form-control" name="time_started_at"
                                                    value="{{ $gasoline_station->time_started_at }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Closing Time </label>
                                                <input type="time" class="form-control" name="time_ended_at"
                                                    value="{{ $gasoline_station->time_ended_at }}">
                                            </div>
                                        </div>

                                        <div>
                                            <input type="file" class="featured_photo" name="image">
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary"
                                                onclick="promptUpdate(event,'#gasoline_station_form', 'Do you want to Update?', 'Note: Uploading new featured photo will overwrite the existing one', 'Yes')">
                                                Save
                                            </button>
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

@section('script')
<script defer
src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap">
</script>
    <script>
        // Function to show or hide the time inputs based on the radio button selection
        function toggleTimeInputs() {
            if ($('#yes').prop('checked')) {
                $('#timeInputs').addClass('d-none'); // Hide time inputs
            } else {
                $('#timeInputs').removeClass('d-none'); // Show time inputs
            }
        }

        // Call the function on page load
        $(document).ready(function() {
            toggleTimeInputs();

            // Add event listener to the radio buttons
            $('input[name="is_always_open"]').change(function() {
                toggleTimeInputs();
            });
        });

        initiateFilePond('.featured_photo', ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Select or <span class="filepond--label-action"> Browse Photo</span>')
         
        let map;

        let latitudeInput = document.getElementById('latitude');
        let longitudeInput = document.getElementById('longitude');

        function initMap() {
            // Initialize the map
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 13.399041, lng:  123.308694 }, // Set your initial map center
                zoom: 10 // Set your initial zoom level
            });

            // Add a marker with draggable property
            const marker = new google.maps.Marker({
                map: map,
                position: { lat: 13.399041, lng:  123.308694 }, // Set your initial marker position
                draggable: true // Allow marker to be dragged
            });

            // Add a listener for marker dragend event
            google.maps.event.addListener(marker, 'dragend', function(event) {
                const latLng = marker.getPosition();
                latitudeInput.value = latLng.lat();
                longitudeInput.value = latLng.lng();
            });
         }
    </script>
@endsection
