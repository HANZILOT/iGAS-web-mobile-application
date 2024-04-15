@extends('layouts.user.app')

@section('title', 'iGas | About Us')

@section('styles')
    <style>
        body {
            margin-top: 20px;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .pt-5 {
            padding-top: 3rem !important;
        }

        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }

        .border-0 {
            border: 0 !important;
        }

        .position-relative {
            position: relative !important;
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgb(0 0 0 / 18%) !important;
        }

        .card {
            position: relative;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: .25rem;
        }

        .member-profile {
            top: -50px;
            left: 0;
        }

        .text-center {
            text-align: center !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .position-absolute {
            position: absolute !important;
        }

        .member-profile img {
            width: 100px;
            height: 100px;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
        }

        .team-pics {
            border: 2px solid #3490dc !important;
        }

        .gradient-text {
            background-image: linear-gradient(to right, #ff00cc, #3333ff);
            /* Define your gradient colors */
            -webkit-background-clip: text;
            /* For Safari */
            -webkit-text-fill-color: transparent;
            /* For Safari */
            background-clip: text;
            /* Standard syntax */
            color: white;
            /* Fallback color in case gradient is not supported */
        }
    </style>
@endsection

@section('content')
    <!-- Page content -->
    <div class="container-fluid pb-5 mt-3">
        <section class="team-section w-75 w-lg-100 mx-auto mt-5 ">
            <h2 class="text-primary">About Us <i class="fas fa-thumbtack ml-1"></i></h2> <br>
            <p class=""><q>
                    Welcome to iGas, a mobile Android application designed to help you find the nearest gas
                    stations and fuel prices in your area. With iGas, you'll never have to worry about running out
                    of gas or paying exorbitant prices for fuel again!
                </q>
            </p> <br><br><br>

            <h2 class="text-primary">Our Mission <i class="fas fa-thumbtack ml-1"></i></h2> <br>
            <p class="gradient-text">
                At iGas, our mission is to provide a seamless and user-friendly experience for every driver
                searching for the nearest gas station. We understand the frustration of driving around
                aimlessly, desperately looking for a gas station when you're running low on fuel. Our app is
                here to save you time, money, and unnecessary stress by guiding you to the closest and most
                affordable fueling options.
            </p>

            <h2 class="text-primary">Our Story <i class="fas fa-thumbtack ml-1"></i></h2> <br>
            <p class="gradient-text">
                Fuel Finder and Gas Stations was born out of a need for a convenient and reliable application
                that helps drivers locate gas stations effortlessly. We understand the frustration of driving
                around, searching for fuel, and not knowing the best prices. Our team of passionate
                developers and fuel industry experts came together to create a solution that would address
                these challenges.
            </p>

            <h2 class="text-primary">Contact Information <i class="fas fa-info-circle ml-1"></i></h2> <br>
            <p class="gradient-text">
                For any inquiries or support, please
                contact our customer service at 09488787896 or email us at {{ config('mail.from.address') }}. Our team
                is always ready to assist you.
            </p>


            <hr class="w-100">

            <h2 class="text-primary">Why choose iGas? <i class="fas fa-question-circle ml-1"></i></h2> <br>
            <ul class="text-left list-group">
                <li>
                    Convenience: IGAS makes finding nearby gas stations and comparing fuel prices quick and
                    effortless, saving you valuable time and effort.
                </li> <br>
                <li>
                    Real-Time Updates: We understand the importance of accurate information, which is why
                    our application provides real-time fuel prices, helping you make cost-effective choices.
                </li><br>
                <li>
                    User-Focused Approach: Your satisfaction matters to us. We actively seek and value your
                    feedback to continuously improve and enhance our application.
                </li>
            </ul>


            <hr class="w-100">

            <h2 class="text-primary">Our Services <i class="fas fa-thumbtack ml-1"></i></h2> <br>
            <ul class="text-left list-group">
                <li>
                    Locate Nearby Gas Stations: With just a few taps on your smartphone, you can easily find
                    the closest gas stations to your current location.
                </li> <br>
                <li>
                    Real-Time Fuel Prices: Access up-to-date information on fuel prices, ensuring you can
                    choose the most cost-effective options.
                </li><br>
                <li>
                    Get Driving Directions: IGAS provides integrated map services, offering driving directions to
                    your selected gas station with ease.
                </li>
            </ul>
        </section>

        <section class="team-section w-75 w-lg-100 py-5 mx-auto" style="margin-top:100px">

            <h1 class="text-center text-primary">Meet Our Team</h1>
            <p class="text-center  mx-auto">
                Our team is qualified and committed to providing a high-quality
                service to help you navigate your needs.
            </p>
            <br><br>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
                            <div class="card-body p-4">
                                <div class="member-profile position-absolute w-100 text-center">
                                    <img class="rounded-circle mx-auto d-inline-block shadow-sm" class="team-pics"
                                        src="{{ asset('img/members/rofel.jpg') }}" alt="avatar">
                                </div>
                                <div class="card-text pt-1">
                                    <h5 class="member-name mb-0 text-center text-primary font-weight-bold">
                                        Rofel Manchete
                                    </h5>
                                    <div class="mb-3 text-center">- Project Head & Database Designer</div>
                                    <div>
                                        As IGAS Project Head, Rofel leads the team, manages development, and designs the
                                        database for efficient data handling. He's also a Software Engineer actively
                                        contributing to IGAS's development and innovation.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
                            <div class="card-body p-4">
                                <div class="member-profile position-absolute w-100 text-center">
                                    <img class="rounded-circle mx-auto d-inline-block shadow-sm" class="team-pics"
                                        src="{{ asset('img/members/benedict.jpg') }}" alt="avatar">
                                </div>
                                <div class="card-text pt-1">
                                    <h5 class="member-name mb-0 text-center text-primary font-weight-bold">
                                        Benedict Reyes
                                    </h5>
                                    <div class="mb-3 text-center">Network Designer and UI Designer
                                    </div>
                                    <div>
                                        Benedict is a versatile team member at IGAS. He works as a Network Designer,
                                        creating the communication architecture between the application and backend. He's
                                        also the UI Designer, ensuring a user-friendly interface.

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card border-0 shadow-lg pt-5 my-5 position-relative">
                            <div class="card-body p-4">
                                <div class="member-profile position-absolute w-100 text-center">
                                    <img class="rounded-circle mx-auto d-inline-block shadow-sm" class="team-pics"
                                        src="{{ asset('img/members/delerose.jpg') }}" alt="avatar">
                                </div>
                                <div class="card-text pt-1">
                                    <h5 class="member-name mb-0 text-center text-primary font-weight-bold">
                                        Delerose Mortega
                                    </h5>
                                    <div class="mb-3 text-center">QA Tester and Documentation Writer
                                    </div>
                                    <div>
                                        Delerose's expertise lies in technical documentation and programming, which
                                        guarantees that IGAS is well-documented for user clarity. Her meticulousness and
                                        attention to detail enhance the app's smooth operation.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--//row-->

            </div>

        </section>


    </div>
@endsection
