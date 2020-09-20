@extends('layouts.app')
@section('slider')
    <!-- NOTE: you can add multiple images separated by comma -->
@endsection
@section('content')
    <section id="slider"
             class="fullheight m-0"
             data-background-delay="3500"
             data-background-fade="1000"
             data-background="{{asset('images/slider/airport.jpg')}}
                 ,{{asset('images/slider/beach.jpg')}}
                 ,{{asset('images/slider/mountain.jpg')}}">
        <!-- Backstretch Navigation -->
        <a class="bs-next" href="#"></a>
        <a class="bs-prev" href="#"></a>
        <div class="container">
            <div class="main-header">
                <div class=" container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav flex-nowrap mt-5">
                                <li class="flight-tab main-search-tab active">Flights</li>
                                <li class="hotel-tab main-search-tab">Hotels</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('components.search-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
    <div class="col-md-6 offset-md-3">
        <br>
        <!-- ALERT -->
        <div class="alert alert-mini alert-danger mb-30" v-show="alertBox">
            <strong>Oh snap!</strong> Login Incorrect!
        </div><!-- /ALERT -->

        <div class="box-static box-border-top p-30">
            <div class="box-title mb-30">
                <h2 class="fs-20">I'm a returning customer</h2>
            </div>

            <form class="m-0" method="post" action="#" autocomplete="off">
                <div class="clearfix">

                    <!-- Email -->
                    <div class="form-group">
                        <input type="text" name="email" v-model="user.email" class="form-control" placeholder="Email" required="">
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" name="password" v-model="user.password" class="form-control" placeholder="Password" required="">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 col-sm-6 col-xs-6">

                        <!-- Inform Tip -->
                        <div class="form-tip pt-20">
                            <a class="no-text-decoration fs-13 mt-10 block" href="#">Forgot Password?</a>
                        </div>

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">

                        <button class="btn btn-primary" type="button" v-on:click="userLogin">OK, LOG IN</button>

                    </div>

                </div>

            </form>

        </div>

        <div class="mt-30 text-center">
            <a href="userregister.php"><strong>Create Account</strong></a>

        </div>

    </div>
    </div>
@endsection
