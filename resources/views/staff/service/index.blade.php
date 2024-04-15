@extends('layouts.staff.app')

@section('title', 'Staff | Manage Gasoline Service')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3" href="{{ route('staff.services.create') }}">Create
                            Gasoline Service +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover service_dt">
                                <caption>List of Gasoline Service <i class="fas fa-clipboard ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Gasoline Station</th>
                                        <th>Service</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Gasoline Service --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
