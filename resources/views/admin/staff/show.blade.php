@extends('layouts.admin.app')

@section('title', 'Admin | Pet Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.staffs.index') }}">
                        All Staffs
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $staff->full_name }}
                </li>
            </ol>
        </nav>

        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-body d-flex and flex-column">
                        <img class="img-fluid rounded-circle" src="{{ handleNullAvatar($staff->avatar_profile) }}"
                            width="150" alt="avatar">
                        <br>
                        <h3 class="font-weight-normal">Name: {{ $staff->full_name }}</h3>
                        <h3 class="font-weight-normal">Sex: {{ $staff->sex }}</h3>
                        <h3 class="font-weight-normal">Address: {{ $staff->address }}</h3>
                        <h3 class="font-weight-normal">Contact:
                            <a href="tel:{{ $staff->contact }}">{{ $staff->contact }}</a>
                        </h3>
                        <h3 class="font-weight-normal">Email:
                            <a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a>
                        </h3>
                        <h3 class="font-weight-normal">Gasoline Station:
                            <a
                                href="{{ route('admin.gasoline_fees.show', $staff->gasoline_station) }}">{{ $staff->gasoline_station->name }}</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
