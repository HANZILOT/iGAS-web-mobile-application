@extends('layouts.admin.app')

@section('title', 'Admin | Gasoline Station Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.gasoline_stations.index') }}">
                        All Gasoline Stations
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $gasoline_station->name }}
                </li>
            </ol>
        </nav>

        <div class="nav-wrapper">
            <ul class="nav nav-pills nav-fill flex-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                        <i class="fas fa-info-circle mr-2"></i>
                        Basic Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                        href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="true">
                        <i class="fas fa-gas-pump mr-2"></i>Gasoline Prices
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                        href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="true">
                        <i class="fas fa-clipboard-check mr-2"></i>Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab"
                        href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="true">
                        <i class="fas fa-users mr-2"></i>Staffs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab"
                        href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="true">
                        <i class="fas fa-comments mr-2"></i>Reviews
                    </a>
                </li>
            </ul>
        </div>

        @include('layouts.includes.alert')


        <div class="tab-content" id="myTabContent">

            {{-- Tab 1 --}}
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                aria-labelledby="tabs-icons-text-1-tab">
                <div class="row">
                    <div class="col-md-4 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                <img class="img-fluid rounded"
                                    src="{{ handleNullImage($gasoline_station->featured_photo) }}" width="150"
                                    alt="featured_photo">
                                <br>
                                <h3 class="font-weight-normal">Name: {{ $gasoline_station->name }}</h3>
                                <h3 class="font-weight-normal">Contact: {{ $gasoline_station->contact ?? 'N/A' }}</h3>
                                <h3 class="font-weight-normal">Email: {{ $gasoline_station->email ?? 'N/A' }}</h3>
                                <h3 class="font-weight-normal">Address: {{ $gasoline_station->address }}</h3>
                                <h3 class="font-weight-normal">Municipality: {{ $gasoline_station->municipality->name }}
                                </h3>
                                @if ($gasoline_station->is_always_open)
                                    <h3 class="font-weight-normal">Open 24 hours <i
                                            class="fas fa-check-circle text-success ml-1"></i></h3>
                                @else
                                    <h3 class="font-weight-normal">Open:
                                        {{ formatDate($gasoline_station->time_started_at, 'time') }} • Closes
                                        {{ formatDate($gasoline_station->time_ended_at, 'time') }}
                                    </h3>
                                @endif
                                <h3 class="font-weight-normal">Registered At:
                                    {{ formatDate($gasoline_station->created_at) }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex and flex-column">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Tab 2 --}}
            <div class="tab-pane fade show" id="tabs-icons-text-2" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        Gasoline Prices
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Types</th>
                                        <th>Prices</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($gasoline_station->gasoline_fees as $gasoline_fee)
                                        <tr>
                                            <td>{{ $gasoline_fee->type }}</td>
                                            <td>₱{{ $gasoline_fee->price }}</td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td>Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab 3 --}}
            <div class="tab-pane fade show" id="tabs-icons-text-3" role="tabpanel">
                <div class="card">
                    <div class="card-header bg-gradient-primary">
                        <div class="row text-center">
                            <div class="col-md-2 p-2">
                                <span class="text-white">Air for Tires <i class="fas fa-wind ml-1"> </i></span>
                            </div>
                            <div class="col-md-2 p-2">
                                <span class="text-white">Water <i class="fas fa-tint ml-1"> </i></span>
                            </div>
                            <div class="col-md-2 p-2">
                                <span class="text-white">Convenience Store <i class="fas fa-store ml-1">
                                    </i></span>
                            </div>
                            <div class="col-md-2 p-2">
                                <span class="text-white">Comfort Room <i class="fas fa-toilet ml-1">
                                    </i></span>
                            </div>
                            <div class="col-md-2 p-2">
                                <span class="text-white">Oil Shop <i class="fas fa-oil-can ml-1"> </i></span>
                            </div>
                            <div class="col-md-2 p-2">
                                <span class="text-white">Hardware <i class="fas fa-hammer ml-1"> </i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($gasoline_station->services as $service)
                                        <tr>
                                            <td>{{ $service->service }}</td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td>Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {{-- Start Staff --}}
            <div class="tab-pane fade show" id="tabs-icons-text-4" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        Staffs
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Avatar</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Sex</th>
                                        <th>Address</th>
                                        <th>Municipality</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($gasoline_station->users as $user)
                                        <tr>
                                            <td>
                                                <img class="avatar" src="{{ handleNullAvatar($user->avatar_profile) }}"
                                                    alt="avatar">
                                            </td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->middle_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->sex }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->municipality->name }}</td>
                                            <td>{{ $user->contact }}</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                    @empty

                                        <tr>
                                            <td>Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Staff --}}

            {{-- Start Reviews --}}
            <div class="tab-pane fade show" id="tabs-icons-text-5" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div>
                            Ratings:
                            @if ($gasoline_station->avg_ratings)
                                @php
                                    $averageRating = $gasoline_station->averageRating();
                                    $integerPart = floor($averageRating);
                                    $fractionPart = $averageRating - $integerPart;
                                @endphp
                        
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $integerPart)
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif ($fractionPart >= 0.5)
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                        @php $fractionPart = 0; @endphp
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            @else
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="far fa-star text-warning"></i>
                                @endfor
                            @endif
                            <span style="color: red;">&nbsp;&nbsp;{{ number_format($gasoline_station->averageRating(), 1) }}/5</span>
                            ({{ $gasoline_station->numberOfReviews() }} reviews)
                        </div>
                        
                    </div>
                    <div class="card-body">
                        {{-- Display all Reviews --}}
                        @forelse ($gasoline_station->ratings as $rating)
                            <div class="d-flex justify-content-start align-items-center p-2 mt-2">
                                <img class="rounded-circle" src="{{ handleNullAvatar($rating->user->avatar_profile) }}"
                                    title="{{ $rating->user->full_name }}" width="40">
                                <div class="mx-3 w-100">
                                    <div>
                                        <h5 class="font-weight-normal mb-0">
                                            {{ $rating->user->full_name }} <span class="text-muted ml-1">
                                                -
                                                {{ formatDate($rating->created_at) }}</span>

                                        </h5>
                                        <h4 class="font-weight-normal">
                                            {{ $rating->comment }}
                                        </h4>
                                        <h5>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i > $rating->rating)
                                                    <i class="far fa-star text-warning"></i>
                                                @else
                                                    <i class="fas fa-star text-warning"></i>
                                                @endif
                                            @endfor
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @empty
                            No Reviews Found!
                        @endforelse
                    </div>
                </div>
            </div>
            {{-- End Reviews --}}


        </div>

        {{-- End CONTAINER --}}

    @endsection

    @section('script')

        <script defer
            src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap">
        </script>
        <script>
            let gasoline_station = {!! $gasoline_station !!};
            let lat = parseFloat(gasoline_station.latitude);
            let lng = parseFloat(gasoline_station.longitude);

            function initMap() {
                let map = new google.maps.Map(document.getElementById("map"), {
                    center: {
                        lat,
                        lng
                    },
                    zoom: 17, // street view
                });

                addMarker({
                    gasoline_station,
                    position: {
                        lat,
                        lng
                    },
                    icon: '/img/marker/gasoline_station.png'
                }, map)

            }


            function addMarker(config, map) {
                // initialize marker
                const marker = new google.maps.Marker({
                    position: config.position,
                    animation: google.maps.Animation.BOUNCE,
                    map,
                    icon: config.icon ?? null,
                });

                let content;

                if (config.gasoline_station.is_always_open) {
                    content = `<h3 class='font-weight-normal'>${config.gasoline_station.name} <i class='fas fa-gas-pump text-primary ml-1'></i></h3>
                <h4 class='font-weight-normal'>Direction: ${config.gasoline_station.address} <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                <h4 class='font-weight-normal'>Phone: 
                    <a href='tel:${config.gasoline_station.contact}'>${config.gasoline_station.contact}</a>    
                </h4>
                <h4 class='font-weight-normal'>Email: 
                    <a href='mailto:${config.gasoline_station.email}'>${config.gasoline_station.email}</a>    
                </h4>
                <h4 class='font-weight-normal'>Open 24 hours  <i class='fas fa-check-circle text-success ml-1'></i></h4>
                `;
                } else {
                    content = `<h3 class='font-weight-normal'>${config.gasoline_station.name} <i class='fas fa-gas-pump text-primary ml-1'></i></h3>
                <h4 class='font-weight-normal'>Direction: ${config.gasoline_station.address}  <i class='fas fa-map-marker-alt text-danger ml-1'></i></h4>
                <h4 class='font-weight-normal'>Phone: 
                    <a href='tel:${config.gasoline_station.contact}'>${config.gasoline_station.contact}</a>    
                </h4>
                <h4 class='font-weight-normal'>Email: 
                    <a href='mailto:${config.gasoline_station.email}'>${config.gasoline_station.email}</a>    
                </h4>
                <h4 class='font-weight-normal'>Open: ${formatTime(config.gasoline_station.time_started_at)} •  Closes: ${formatTime(config.gasoline_station.time_ended_at)}</h4>
                `;
                }



                if (config.gasoline_station !== undefined) {
                    const infoWindow = new google.maps.InfoWindow({
                        content: content,
                    });

                    marker.addListener("click", () => {
                        infoWindow.open(marker.getMap(), marker);
                    });
                }
            }

            window.initMap = initMap;
        </script>

    @endsection
