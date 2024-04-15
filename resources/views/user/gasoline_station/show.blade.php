@extends('layouts.user.app')

@section('title', "$app_name | $gasoline_station->name")

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/utils/star-rating.css') }}">
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid mt-3">
        <nav class="py-0" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('user.gasoline_stations.index') }}">
                        All Gasoline Stations
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $gasoline_station->name }}
                </li>
            </ol>
        </nav>

        @include('layouts.includes.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="nav-wrapper pt-0">
                    <ul class="nav nav-pills nav-fill flex-row flex-md-column" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                aria-selected="true"><i class="fas fa-info-circle mr-2"></i>Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                aria-selected="false"><i class="fas fa-map-marker-alt mr-2"></i>Map</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab"
                                href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3"
                                aria-selected="true">
                                <i class="fas fa-gas-pump mr-2"></i>Prices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab"
                                href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4"
                                aria-selected="true">
                                <i class="fas fa-clipboard-check mr-2"></i>Services
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                        aria-labelledby="tabs-icons-text-1-tab">
                        <div class="row">
                            <div class="col-md-12">
                                <img class="img-fluid d-block mx-auto"
                                    src="{{ handleNullImage($gasoline_station->featured_photo) }}" alt="featured photo">
                            </div>

                            <div class="col-md-12 py-3">
                                <div class="card card-body">
                                    <h3 class="font-weight-normal text-primary">{{ $gasoline_station->name }} <i
                                            class="fas fa-gas-pump ml-1"></i></h3>
                                    <h4 class="font-weight-normal">Direction: {{ $gasoline_station->address }}</h4>
                                    <h4 class="font-weight-normal">Municipality: {{ $gasoline_station->municipality->name }}
                                    </h4>

                                    <h4 class="font-weight-normal">Contact: <a
                                            href="tel:{{ $gasoline_station->contact }}">{{ $gasoline_station->contact }}</a>
                                    </h4>
                                    <h4 class="font-weight-normal">Email: <a
                                            href="mailto:{{ $gasoline_station->email }}">{{ $gasoline_station->email }}</a>
                                    </h4>

                                    @if ($gasoline_station->is_always_open)
                                        <h4 class="font-weight-normal">Open 24 hours <i
                                                class="fas fa-check-circle text-success ml-1"></i></h4>
                                    @else
                                        <h4 class="font-weight-normal">Open:
                                            {{ formatDate($gasoline_station->time_started_at, 'time') }} • Closes
                                            {{ formatDate($gasoline_station->time_ended_at, 'time') }}
                                        </h4>
                                    @endif

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
                                    
                                    <br>
                                    <div class="text-center text-md-right">
                                        <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#show_reviews">
                                            View Reviews <i class="fas fa-comment ml-1"></i>
                                        </a>

                                        @if (isRatedByAuthUser($gasoline_station->id))
                                            <a class="btn btn-sm btn-success" href="tel:{{ $gasoline_station->contact }}">
                                                Message <i class="fas fa-phone ml-1"></i>
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-warning" data-toggle="collapse" href="#create_rating">
                                                Submit a Rating <i class="fas fa-star ml-1"></i>
                                            </a>
                                        @endif

                                    </div>
                                    {{-- @if (isSavedPlace(auth()->id(), $gasoline_station->saved_places))
                                        <form action="{{ route('saved_places.destroy', $gasoline_station->id) }}"
                                            method="post" id="place_form">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="place_id" value="{{ $gasoline_station->id }}">
                                            <button type="button" class="btn btn-danger form-control"
                                                onclick="promptRemoveToSavedPlaces(event, '#place_form', 'Do you want to Remove Place?')">Remove
                                                to Saved Places <i class="fas fa-trash ml-1"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('saved_places.store') }}" method="post" id="place_form">
                                            @csrf
                                            <input type="hidden" name="place_id" value="{{ $gasoline_station->id }}">
                                            <button type="button" class="btn btn-primary form-control"
                                                onclick="promptAddToSavedPlaces(event, '#place_form')">Add To Saved Places
                                                <i class="fas fa-bookmark ml-1"></i>
                                            </button>
                                        </form>
                                    @endif --}}
                                </div>

                                <div class="collapse mt-3" id="create_rating">
                                    <div class="card">
                                        <div class="card-header">
                                            Submit a rating
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('user.ratings.store', $gasoline_station) }}"
                                                method="POST" id="rate_form">
                                                @csrf

                                                @include('layouts.includes.alert')
                                                <div class="form-group mb-3">
                                                    <select class="star-rating" name="rating" style="display:none">
                                                        <option value="">Select a rating</option>
                                                        <option value="5">Excellent</option>
                                                        <option value="4">Very Good</option>
                                                        <option value="3">Average</option>
                                                        <option value="2">Poor</option>
                                                        <option value="1">Terrible</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <textarea class="form-control" name="comment" rows="5"
                                                        placeholder="We encourage you to provide feedback for the gasoline station to share insights from their services"></textarea>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-sm btn-primary"
                                                        onclick="promptStore(event,'#rate_form')">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>


                                <div class="collapse mt-3" id="show_reviews">
                                    <div class="card card-body">
                                        @forelse ($gasoline_station->ratings as $rating)
                                            <div class="d-flex justify-content-start align-items-center p-2 mt-2">
                                                <img class="rounded-circle"
                                                    src="{{ handleNullAvatar($rating->user->avatar_profile) }}"
                                                    width="40">
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

                        </div>
                    </div>

                    {{-- Start Map --}}
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                        aria-labelledby="tabs-icons-text-2-tab">
                        <div id="map"></div>
                    </div>
                    {{-- End Map --}}

                    {{-- Start Gasoline Fees --}}
                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel"
                        aria-labelledby="tabs-icons-text-3-tab">
                        <div class="card">
                            <div class="card-body">

                                <ul class="list-group">
                                    @forelse ($gasoline_station->gasoline_fees as $gasoline_fee)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $gasoline_fee->type }}
                                            <span class="badge badge-primary badge-pill">₱
                                                {{ number_format($gasoline_fee->price, 2) }}</span>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            Records Not Found
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- End Gasoline Fees --}}


                    {{-- Start Gasoline Services --}}
                    <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel"
                        aria-labelledby="tabs-icons-text-4-tab">
                        <div class="card">
                            <div class="card-body">
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
                                <br>
                                <ul class="list-group">
                                    @forelse ($gasoline_station->services as $service)
                                        <li class="list-group-item">
                                            <span class="badge badge-primary badge-pill">
                                                {{ $service->service }}
                                            </span>
                                        </li>
                                    @empty
                                        <li class="list-group-item">
                                            No Services Available
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- End Gasoline Services --}}
                </div>


            </div>

        </div>
    </div>
    {{-- End CONTAINER --}}
@endsection

@section('script')
    <script src="{{ asset('assets/js/utils/star-rating.js') }}"></script>
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

            if (config.gasoline_station !== undefined) {
                const infoWindow = new google.maps.InfoWindow({
                    content: `${config.gasoline_station.name}`,
                });

                marker.addListener("click", () => {
                    infoWindow.open(marker.getMap(), marker);
                });
            }
        }

        window.initMap = initMap;

        var stars = new StarRating('.star-rating');
    </script>
    <script defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_map_api_key') }}&libraries=places&callback=initMap">
    </script>
@endsection
