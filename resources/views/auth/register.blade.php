@extends('layouts.main.app')

@section('title', "$app_name | Create an Account")

@section('content')
    <!-- Page content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 px-3 mb-5"><br>

                {{-- User Form --}}
                <fieldset>
                    <legend>
                        <h4 class="text-white"> <a class="text-white font-weight-bold" href="{{ route('auth.login') }}"><i
                                    class="fas fa-arrow-left"></i></a> <span class="ml-2">Register</span></h4>
                    </legend>

                    <div class="alert alert-primary  alert-dismissible fade show p-3 text-white" role="alert">
                        Welcome to {{ config('app.name') }} To get started, simply fill out the registration form and create
                        your account. With iGas, you can easily locate the closest gas stations around you, view real-time
                        fuel prices, and even plan your route to the most cost-effective option. Say goodbye to unnecessary
                        detours and expensive refueling!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @include('layouts.includes.alert')

                    <form action="{{ route('auth.attemptRegister') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input class="form-control" type="text" name="first_name" placeholder="First Name"
                                    autocomplete="name" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input class="form-control" type="text" name="middle_name" placeholder="Middle Name"
                                    autocomplete="name" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input class="form-control" type="text" name="last_name" placeholder="Last Name"
                                    autocomplete="name" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                </div>
                                <select class="form-control" name="sex">
                                    <option value="">Sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                </div>
                                <input class="form-control" type="date" name="birth_date" max="2004-01-01" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                                </div>
                                <input class="form-control" type="text" name="address" placeholder="Complete Address *"
                                    autocomplete="address-level1" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-pin-3"></i></span>
                                </div>
                                <select class="form-control" name="municipality_id">
                                    <option value="">Select Municipality</option>
                                    <option value=""></option>
                                    @foreach ($municipalities as $id => $municipality)
                                        <option value="{{ $id }}">{{ $municipality }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input class="form-control" type="number" min="0" name="contact"
                                    placeholder="Contact Ex. 09659312001 *" autocomplete="tel-local" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" type="email" name="email" placeholder="Email"
                                    autocomplete="email" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    autocomplete="new-password" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="Re-type Password" autocomplete="new-password" required>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="role_id" value="3">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-warning form-control">Register</button>
                        </div>
                        <br>
                        <div class="text-sm text-white text-center">
                            Already have an account?
                            <a href="{{ route('auth.login') }}" style="text-decoration: underline; color: #fff">Login</a>
                        </div>
                    </form>
                </fieldset>
                {{-- End User Form --}}


            </div>
        </div>
    </div>
@endsection
