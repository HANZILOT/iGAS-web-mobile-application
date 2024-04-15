@extends('layouts.user.app')

@section('title', "$app_name | Gasoline Stations")

@section('content')


    <!-- Modal -->
    <div class="modal fade show" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="nearest_gasoline_station" aria-hidden="true" id="modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Gasoline Stations <i class="fas fa-gas-pump ml-1 text-primary"></i></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/gasoline_station/gasoline_station.svg') }}"
                        alt="">
                    Below are the top three nearest gasoline stations based
                    on your current location.<br><br>

                    <ul class="list-group" id="display_nearest_gasoline_stations">

                        {{-- Display Nearest Gasoline Station --}}
                        {{-- @foreach ($nearest_gasoline_stations as $nearest_gasoline_station)
                            <a href="{{ route('user.gasoline_stations.show', $nearest_gasoline_station) }}"
                                class="list-group-item list-group-item-action h5 text-primary">
                                {{ $nearest_gasoline_station->name }} |
                                {{ number_format($nearest_gasoline_station->distance, 2) }} km away
                            </a>
                        @endforeach --}}
                    </ul>
                    <br>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTAINER --}}
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" id="map-wrapper">

            <div id="map">
                {{-- Map --}}
            </div>

            <div class="btn-group mt-auto">
                <a href="javascript:void(0)" class="btn-dark text-center p-2" id="distance-info">Distance: N/A |
                    Duration:
                    N/A</a>
                <a class="btn btn-primary p-2" href="javascript:void(0)" onclick="getNearestGasolineStation()">Toggle
                    Nearest Gasoline Station <i class="fas fa-map-marker-alt ml-1 text-danger"></i></a>
            </div>

            <form action="{{ route('user.gasoline_stations.index') }}" method="GET" id="gasoline_station">
                <div class="input-group">
                    <select class="selectpicker show-tick" data-style='btn-white text-primary' data-live-search="true"
                        data-width='300px' name="gasoline_station_id" onchange="$('#gasoline_station').submit()">

                        @if ($searches->isNotEmpty())
                            <optgroup label="Search History">
                                @foreach ($searches as $search)
                                    <option data-icon='fas fa-map-marker-alt'
                                        data-tokens="{{ $search->gasoline_station->name }}"
                                        value="{{ $search->gasoline_station_id }}">
                                        {{ $search->gasoline_station->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif

                        <optgroup label="gasoline_stations">
                            @if ($searches->isEmpty())
                                <option value="">Search Gasoline Station....</option>
                            @endif
                            @foreach ($gasoline_stations as $gasoline_station)
                                <option data-icon='fas fa-map-marker-alt' data-tokens="{{ $gasoline_station->name }}"
                                    value="{{ $gasoline_station->id }}">
                                    {{ $gasoline_station->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    <div class="input-group-append">
                        <a class="btn btn-primary text-white" href=""><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
            </form>
            <div id="directionsPanel" style="width:100%;height:100%"></div>

        </div>
    </div>
    {{-- End CONTAINER --}}
@endsection
@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap"
        defer></script>
    <script>
        $(() => {
            $('#gasoline_station').selectpicker()
        })
    </script>

    @if ($selected_gasoline_station)
        <script>
            let markers = []
            let map,
                infoWindow,
                directionsService,
                directionsRenderer;

            let lat = 13.399041;
            let lng = 123.308694;

            let gasoline_station = {!! $selected_gasoline_station !!}
            let gasoline_fees = gasoline_station.gasoline_fees;


            function initMap() {

                let route_index = route('user.gasoline_stations.index');

                infoWindow = new google.maps.InfoWindow();
                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer({
                    copyrights: "ACLC School Mapping System",
                    panel: document.getElementById('directionsPanel'),
                    suppressMarkers: true
                });
                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat,
                        lng
                    },
                    zoom: 19, // street view
                    gestureHandling: 'greedy',
                });

                directionsRenderer.setMap(map);

                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {

                            // live location
                            const current_location = {
                                lat: parseFloat(position.coords.latitude),
                                lng: parseFloat(position.coords.longitude),
                            };


                            // temporary location
                            // const current_location = {
                            //     lat: 13.399041,
                            //     lng: 123.308694,
                            // };


                            const payload = {
                                origin: {
                                    lat: current_location.lat,
                                    lng: current_location.lng,
                                },
                                destination: {
                                    lat: parseFloat(gasoline_station.latitude),
                                    lng: parseFloat(gasoline_station.longitude),
                                },
                                provideRouteAlternatives: false,
                                travelMode: 'WALKING',
                                unitSystem: google.maps.UnitSystem.METRIC
                            }

                            directionsService.route(payload, function(result, status) {
                                if (status == 'OK') {

                                    directionsRenderer.setDirections(result);

                                    const distance = result.routes[0].legs[0].distance.text;
                                    const duration = result.routes[0].legs[0].duration.text;
                                    document.getElementById('distance-info').innerHTML =
                                        `Distance: ${distance}, Duration: ${duration}`;

                                    const route_show = route('user.gasoline_stations.show', gasoline_station.id)
                                    let name;


                                    name =
                                        `<h3 class='font-weight-normal'>${gasoline_station.name} <i class='fas fa-gas-pump text-primary ml-1'></i></h3>`;

                                    name += `<h4> Gasoline Prices</h4>
                                        <ul class='list-group'>`;

                                    gasoline_fees.forEach(gasoline_fee => {
                                        name +=
                                            `<li class='list-group-item d-flex justify-content-between align-items-center'>${gasoline_fee.type} 
                                            <span class="badge badge-primary badge-pill">₱
                                                            ${gasoline_fee.price}
                                            </span>
                                        </li>`
                                    })

                                    name += `</ul> <br>`

                                    if (gasoline_station.is_always_open) {
                                        name += `
                                                <h4 class='font-weight-normal'>Direction: ${gasoline_station.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                                                <h4 class='font-weight-normal'>Phone: 
                                                    <a href='tel:${gasoline_station.contact}'>${gasoline_station.contact ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Email: 
                                                    <a href='mailto:${gasoline_station.email}'>${gasoline_station.email ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Open 24 hours  <i class='fas fa-check-circle text-success ml-1'></i></h4>
                                                <br>
                                                `;
                                    } else {
                                        name += `
                                                <h4 class='font-weight-normal'>Direction: ${gasoline_station.address}</h4>
                                                <h4 class='font-weight-normal'>Phone: 
                                                    <a href='tel:${gasoline_station.contact}'>${gasoline_station.contact ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Email: 
                                                    <a href='mailto:${gasoline_station.email}'>${gasoline_station.email ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Open: ${formatTime(gasoline_station.time_started_at)} •  Closes: ${formatTime(gasoline_station.time_ended_at)}</h4>
                                                <br>
                                                `;
                                    }


                                    name += `<br>
                    
                                        <div class='d-flex'>
                                        <a class='btn btn-sm btn-outline-primary' href='${route_show}'> <i class='fas fa-chevron-right mr-1'></i>Explore</a> 
                                        
                                            <a class='btn btn-sm btn-outline-primary' href="https://www.google.com/maps?q=${gasoline_station.latitude},${gasoline_station.longitude}" target="_blank">Open in Google Maps
                                            </a>    
                                        </div>
                                        <br>
                                    `;

                                    const gasoline_stations = [
                                        // origin    
                                        {
                                            position: {
                                                lat: payload.origin.lat,
                                                lng: payload.origin.lng,
                                            },
                                            icon: '/img/marker/my-marker.png',
                                            name: "I'm here!"
                                        },
                                        // destination
                                        {
                                            position: {
                                                lat: payload.destination.lat,
                                                lng: payload.destination.lng,
                                            },
                                            icon: '/img/marker/gasoline_station.png',
                                            name: name
                                        }
                                    ]

                                    markers.forEach(marker => marker.setMap(null))
                                    addMarkers(gasoline_stations, map)
                                }
                            });
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            window.initMap = initMap;
        </script>
    @else
        <script>
            let lat = 13.399041;
            let lng = 123.308694;
            let markers = []; //  Array to store the markers of nearby gas stations
            let map,
                infoWindow,
                directionsService,
                directionsRenderer;

            let gasoline_stations = @json($gasoline_stations);

            function initMap() {

                let route_index = route('user.gasoline_stations.index')

                infoWindow = new google.maps.InfoWindow();
                directionsService = new google.maps.DirectionsService();
                directionsRenderer = new google.maps.DirectionsRenderer({
                    copyrights: "iGas",
                    panel: document.getElementById('directionsPanel'),
                    suppressMarkers: true
                });

                map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat,
                        lng
                    },
                    zoom: 15, // street view
                    gestureHandling: 'greedy',
                });

                directionsRenderer.setMap(map);

                let refactored_gasoline_stations = [];


                gasoline_stations.forEach((gasoline_station) => {

                    let route_show = route('user.gasoline_stations.show', gasoline_station.id)
                    let name;

                    let gasoline_fees = gasoline_station.gasoline_fees;


                    name =
                        `<h3 class='font-weight-normal'>${gasoline_station.name} <i class='fas fa-gas-pump text-primary ml-1'></i></h3>`;

                    name += `<h4> Gasoline Prices</h4>
                                        <ul class='list-group'>`;

                    gasoline_fees.forEach(gasoline_fee => {
                        name +=
                            `<li class='list-group-item d-flex justify-content-between align-items-center'>${gasoline_fee.type} 
                                            <span class="badge badge-primary badge-pill">₱
                                                            ${gasoline_fee.price}
                                            </span>
                                        </li>`
                    })

                    name += `</ul> <br>`

                    if (gasoline_station.is_always_open) {
                        name += `
                                                <h4 class='font-weight-normal'>Direction: ${gasoline_station.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                                                <h4 class='font-weight-normal'>Phone: 
                                                    <a href='tel:${gasoline_station.contact}'>${gasoline_station.contact ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Email: 
                                                    <a href='mailto:${gasoline_station.email}'>${gasoline_station.email ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Open 24 hours  <i class='fas fa-check-circle text-success ml-1'></i></h4>
                                                <br>
                                                `;
                    } else {
                        name += `
                                                <h4 class='font-weight-normal'>Direction: ${gasoline_station.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                                                <h4 class='font-weight-normal'>Phone: 
                                                    <a href='tel:${gasoline_station.contact}'>${gasoline_station.contact ?? "N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Email: 
                                                    <a href='mailto:${gasoline_station.email}'>${gasoline_station.email ??"N/A"}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Open: ${formatTime(gasoline_station.time_started_at)} •  Closes: ${formatTime(gasoline_station.time_ended_at)}</h4>
                                                <br>
                                               
                                                `;
                    }

                    name += `<br>
                    
                        <div class='d-flex'>
                            <a class='btn btn-sm btn-outline-primary' href='${route_show}'> <i class='fas fa-chevron-right mr-1'></i>Explore</a> <br>
                            <a class='btn btn-sm btn-outline-primary' href='${route_index}?gasoline_station_id=${gasoline_station.id}'> 
                                <i class='fas fa-directions mr-1'></i>
                                    Direction
                            </a>

                            <a class='btn btn-sm btn-outline-primary' href="https://www.google.com/maps?q=${gasoline_station.latitude},${gasoline_station.longitude}" target="_blank">Open in Google Maps
                            </a>   
                            </div>
                    `;


                    refactored_gasoline_stations.push({
                        position: {
                            lat: parseFloat(gasoline_station.latitude),
                            lng: parseFloat(gasoline_station.longitude),
                        },
                        icon: '/img/marker/gasoline_station.png',
                        name: name
                    });

                });

                addMarkers(refactored_gasoline_stations, map);


                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {

                            // live location
                            const current_location = {
                                lat: parseFloat(position.coords.latitude),
                                lng: parseFloat(position.coords.longitude),
                            };


                            // temporary location
                            // const current_location = {
                            //     lat: 13.399041,
                            //     lng: 123.308694,
                            // };

                            map.setCenter(current_location); // Center the map on the user's current location.

                            const myLocation = new google.maps.Marker({
                                position: current_location, // temp location
                                animation: google.maps.Animation.DROP,
                                map, // display market to this map,
                                icon: '/img/marker/my-marker.png',
                            }); // display my location

                            myLocation.addListener('click', () => {
                                infoWindow.setContent('You are here')
                                infoWindow.open(map, myLocation)
                            })

                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

            }
        </script>
    @endif

    <script>
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }

        function addMarkers(gasoline_stations, map) {
            gasoline_stations.forEach(gasoline_station => {

                // initialize marker
                let marker = new google.maps.Marker({
                    position: gasoline_station.position,
                    animation: google.maps.Animation.BOUNCE,
                    map: map, // display market to this map,
                    icon: gasoline_station.icon ?? '/img/marker/gasoline_station.png',
                });

                google.maps.event.addListener(marker, "click", function(e) {
                    infoWindow.setContent(`${gasoline_station.name}`);
                    infoWindow.open(map, marker);
                });

                markers.push(marker);
            });
        }

        function getNearestGasolineStation() {
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {


                        axios.post(route('user.nearest_gasoline_stations.get'), {
                                latitude: parseFloat(position.coords.latitude),
                                longitude: parseFloat(position.coords.longitude),
                            })
                            .then(res => {
                                let output = ``;

                                let nearest_gasoline_stations = Object.values(res.data);


                                // Sort the nearest_gasoline_stations array by distance
                                nearest_gasoline_stations.sort((a, b) => a.distance - b.distance);

                                nearest_gasoline_stations.forEach((nearest_gasoline_station) => {

                                    const {
                                        id,
                                        name,
                                        distance
                                    } = nearest_gasoline_station; // Destructure the object properties

                                    let route_show = route('user.gasoline_stations.show',
                                        id)
                                    output += `<a href="${route_show}" class="list-group-item list-group-item-action h5 text-primary">
                                                    ${name} |
                                                    ${number_format(distance)} km away
                                                </a>`;
                                });

                                $('#display_nearest_gasoline_stations').html(output);
                                $('#modal').modal('show');

                            })
                            .catch(e => log(e))


                    },
                    () => {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }
    </script>


@endsection
