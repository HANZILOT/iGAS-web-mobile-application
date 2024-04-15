@extends('layouts.admin.app')

@section('content')
    <!-- Header -->
    <div class="header pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row mt-3">
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Active User</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_active_user }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Inactive User</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_inactive_user }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Gasoline Station</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_gasoline_station }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-map"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Staff</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_staff }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid mt--6">
        {{-- Row 0 --}}
        <div class="row justify-content-center align-items-center" id="map-wrapper">
            <div class="col-md-12">
                <div id="map" style="height:600px;width:100%">
                    {{-- Map --}}
                </div>
            </div>
        </div>
        <br>
        {{-- Row 1 --}}
        <div class="row">
            <div class="col-12 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Total Services by Gasoline Station</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart -->
                        <div>
                            <canvas id="chart_total_services_by_gasoline_station"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Total Gasoline Type by Gasoline Station</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart -->
                        <div>
                            <canvas id="chart_total_gasoline_type_by_gasoline_station"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="row">
            <div class="col-12 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Monthly User</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <!-- Chart -->
                        <div>
                            <canvas id="chart_monthly_user"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Recent User</h6>
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-sm btn-dark" href="{{ route('admin.users.index') }}">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Registered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>
                                                <img class="avatar avatar-sm rounded-circle"
                                                    src="{{ handleNullAvatar($user->avatar_profile) }}" alt="avatar">
                                            </td>
                                            <td>{{ $user->full_name }}</td>
                                            <td>{{ $user->role->name }}</td>
                                            <td>{{ formatDate($user->created_at) }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->links() }}
                            <br>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        {{-- Row 3 --}}
        <div class="row">
            <div class="col-12 col-md-9 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-light text-uppercase ls-1 mb-1">Recent Gasoline Station</h6>
                            </div>
                            <div class="col text-right">
                                <a class="btn btn-sm btn-dark" href="{{ route('admin.gasoline_stations.index') }}">View
                                    all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <table class="table align-items-center table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Featured Photo</th>
                                        <th>Gasoline Stations</th>
                                        <th>Address</th>
                                        <th>Municipality</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recent_gasoline_stations as  $gasoline_station)
                                        <tr>
                                            <td> {{ $loop->index + 1 }} </td>
                                            <td><img class="img-fluid" src="{{ $gasoline_station->featured_photo }}"
                                                    alt="featured photo"></td>
                                            <td>{{ $gasoline_station->name }}</td>
                                            <td>{{ $gasoline_station->address }}</td>
                                            <td>{{ $gasoline_station->municipality->name }}</td>
                                            <td>{{ $gasoline_station->latitude }}</td>
                                            <td>{{ $gasoline_station->longitude }}</td>
                                            <td>{{ formatDate($gasoline_station->created_at) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $recent_gasoline_stations->links() }}
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header border-0 bg-primary">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-white text-uppercase ls-1 mb-1">Activity Logs</h6>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.activity_logs.index') }}" class="btn btn-sm btn-dark">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        @forelse ($activities as $al)
                            @php
                                $exploaded = explode('-', $al->description);
                            @endphp
                            <div class='border-left border-primary'>
                                <p class="m-0 pl-2 text-small">{{ $exploaded[0] }} - <span class='txt-lightblue'>
                                        {{ $exploaded[1] }} </span> </p>
                                <p class='pl-2 text-small'> {{ $al->created_at->diffForHumans() }} </p>
                            </div>
                            <br>
                        @empty
                            <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" alt="nodata">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
@endsection

@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap"
        defer></script>
    <script>
        let lat = 13.399041;
        let lng = 123.308694;
        let markers = []; //  Array to store the markers of nearby gas stations
        let map,
            infoWindow,
            directionsService,
            directionsRenderer;

        let gasoline_stations = @json($map_gasoline_stations);


        function initMap() {

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
                zoom: 12, // street view
                gestureHandling: 'greedy',
            });

            directionsRenderer.setMap(map);

            let refactored_gasoline_stations = [];


            gasoline_stations.forEach((gasoline_station) => {

                let route_show = route('admin.gasoline_stations.show', gasoline_station.id)
                let name;


                if (gasoline_station.is_always_open) {
                    name = `<h3 class='font-weight-normal'>${gasoline_station.name} <i class='fas fa-gas-pump text-primary ml-1'></i></h3>
                                                <h4 class='font-weight-normal'>Direction: ${gasoline_station.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                                                <h4 class='font-weight-normal'>Phone: 
                                                    <a href='tel:${gasoline_station.contact}'>${gasoline_station.contact ?? 'N/A'}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Email: 
                                                    <a href='mailto:${gasoline_station.email}'>${gasoline_station.email ?? 'N/A'}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Open 24 hours  <i class='fas fa-check-circle text-success ml-1'></i></h4>
                                                <br>
                                                <a class='btn btn-sm btn-outline-primary' href='${route_show}'> <i class='fas fa-chevron-right mr-1'></i>Explore</a>
                                                `;
                } else {
                    name = `<h3 class='font-weight-normal'>${gasoline_station.name} <i class='fas fa-gas-pump text-primary ml-1'></i></h3>
                                                <h4 class='font-weight-normal'>Direction: ${gasoline_station.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                                                <h4 class='font-weight-normal'>Phone: 
                                                    <a href='tel:${gasoline_station.contact}'>${gasoline_station.contact}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Email: 
                                                    <a href='mailto:${gasoline_station.email}'>${gasoline_station.email}</a>    
                                                </h4>
                                                <h4 class='font-weight-normal'>Open: ${formatTime(gasoline_station.time_started_at)} •  Closes: ${formatTime(gasoline_station.time_ended_at)}</h4>
                                                <br>
                                                <a class='btn btn-sm btn-outline-primary' href='${route_show}'> <i class='fas fa-chevron-right mr-1'></i>Explore</a>
                                                `;
                }


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
                        // const pos = {
                        //     lat: parseFloat(position.coords.latitude),
                        //     lng: parseFloat(position.coords.longitude),
                        // };


                        // temporary location
                        const current_location = {
                            lat: 13.399041,
                            lng: 123.308694,
                        };

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
    </script>
    <script>
        const bgc = [
            '#1273EB',
            '#5603ad',
            '#8965e0',
            '#eeb72d',
            '#2dce89',
            '#32325d',
            '#f5365c',
            '#8898aa',
            '#212539',
            '#8b2518',
            '#212529',
            '#95a5a6',
            '#2c3e50',
            '#ecf0f1',
        ];


        const CHART_A_gasoline_stations = @json($chart_total_services_by_gasoline_station[0]);
        const CHART_A_total_services = @json($chart_total_services_by_gasoline_station[1]);

        const chart_total_services_by_gasoline_station = document.getElementById(
            'chart_total_services_by_gasoline_station');
        const CHART_A = new Chart(chart_total_services_by_gasoline_station, {
            type: 'doughnut', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: CHART_A_gasoline_stations,
                datasets: [{
                    label: 'Total Services By Gasoline Station',
                    data: CHART_A_total_services,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Services By Gasoline Station'
                }
            }
        });


        const CHART_B_gasoline_stations = @json($chart_total_gasoline_type_by_gasoline_station[0]);
        const CHART_B_total_gasoline_type = @json($chart_total_gasoline_type_by_gasoline_station[1]);

        const chart_total_gasoline_type_by_gasoline_station = document.getElementById(
            'chart_total_gasoline_type_by_gasoline_station');
        const CHART_B = new Chart(chart_total_gasoline_type_by_gasoline_station, {
            type: 'doughnut', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: CHART_B_gasoline_stations,
                datasets: [{
                    label: 'Total Gasoline Type By Gasoline Station',
                    data: CHART_B_total_gasoline_type,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Gasoline Type By Gasoline Station'
                }
            }
        });


        const CHART_C_months = @json($chart_monthly_user[0]);
        const CHART_C_total_user = @json($chart_monthly_user[1]);

        const chart_monthly_user = document.getElementById('chart_monthly_user');
        const CHART_C = new Chart(chart_monthly_user, {
            type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: CHART_C_months,
                datasets: [{
                    label: 'Total User',
                    data: CHART_C_total_user,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Monthly User'
                }
            }
        });
    </script>
@endsection
