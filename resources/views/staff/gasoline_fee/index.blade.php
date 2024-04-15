@extends('layouts.staff.app')

@section('title', 'Staff | Manage Gasoline Price')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-primary me-3"
                            href="{{ route('staff.gasoline_fees.create') }}">Create
                            Gasoline Price +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover gasoline_fee_dt">
                                <caption>List of Gasoline Prices <i class="fas fa-clipboard ml-1"></i></caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Gasoline Station</th>
                                        <th>Types</th>
                                        <th>Prices</th>
                                        <th>Created At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Gasoline Fee --}}
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
