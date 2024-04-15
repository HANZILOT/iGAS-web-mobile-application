@extends('layouts.admin.app')

@section('title', 'Admin | Edit Staff')

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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="font-weight-normal text-primary">
                            <a class="text-primary float-left" href="{{ route('admin.staffs.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            <span class="ml-3"> Edit Staff <i class="fas fa-user ml-1"></i></span>
                        </h2>

                        <br>
                        @include('layouts.includes.alert')
                        <form class="row" action="{{ route('admin.staffs.update', $staff) }}" method="post"
                            id="staff_form">
                            @csrf @method('PUT')

                            <div class="col-md-6">

                                <div class="form-group mb-2">
                                    <label class="form-label">Gasoline Station</label>
                                    <select class="form-control" id="gasolineStationSelect" name="gasoline_station_id" required>
                                        <option value=""></option>
                                        @foreach ($gasoline_stations as $id => $gasoline_station)
                                            <option value="{{ $id }}"
                                                @if ($staff->gasoline_station_id == $id) selected @endif>
                                                {{ $gasoline_station }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name"
                                        value="{{ $staff->first_name }}" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="middle_name"
                                        value="{{ $staff->middle_name }}" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name"
                                        value="{{ $staff->last_name }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Sex</label>
                                    <select class="form-control" name="sex">
                                        <option value=""></option>
                                        <option value="male" @if ($staff->sex === 'male') selected @endif>
                                            Male</option>
                                        <option value="female" @if ($staff->sex === 'female') selected @endif>
                                            Female</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-outline mb-2">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text"name="address" placeholder="Complete Address"
                                        value="{{ $staff->address }}">
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Municipality</label>
                                    <select class="form-control" name="municipality_id" required>
                                        <option value=""></option>
                                        @foreach ($municipalities as $id => $municipality)
                                            <option value="{{ $id }}"
                                                @if ($staff->municipality_id == $id) selected @endif>{{ $municipality }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-outline mb-2">
                                    <label class="form-label">Contact</label>
                                    <input class="form-control" type="number" min="0" name="contact"
                                        placeholder="Ex. 09659312005" value="{{ $staff->contact }}">
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ $staff->email }}" id="email" required>
                                    <span id="emailValidationMessage" style="color: red;"></span>
                                </div>
                       
                            </div>

                            <div class="col-md-12"> <!-- This column spans the full width -->
                                <div class="form-group mt-3">
                                    <button type="button" class="btn btn-primary" onclick="promptStore(event, '#staff_form')">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const emailInput = document.getElementById("email");
            const emailValidationMessage = document.getElementById("emailValidationMessage");
    
            emailInput.addEventListener("input", function () {
                const emailValue = emailInput.value;
                if (emailValue.includes("@")) {
                    emailValidationMessage.textContent = ""; // Clear the validation message
                } else {
                    emailValidationMessage.textContent = "Please include an '@' in the email address.";
                    emailValidationMessage.style.opacity = 1; // Reset the opacity
    
                    // After 2 seconds, fade out the message
                    setTimeout(function () {
                        emailValidationMessage.style.transition = "opacity 1s";
                        emailValidationMessage.style.opacity = 0;
                    }, 3000); // 4000 milliseconds (3 seconds)
                }
            });
        });

        $(document).ready(function() {
        $('#gasolineStationSelect').select2({
            placeholder: 'Select for a Gasoline Station ',
            allowClear: true,
            dropdownCssClass: 'custom-search-dropdown' 
        });
    });
    </script>


@endsection
