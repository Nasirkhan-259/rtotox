@extends('layouts.app')
@section('breadcrumb')
    <section class="page-header page-header-xs">
        <div class="container">
            <h1>AGENT LOGIN</h1>
            <!-- breadcrumbs -->
            {{ Breadcrumbs::render('agent') }}
        </div>
    </section>
@endsection
@section('content')
    <div class="container container-box">

    <div class="row">
        <!-- LOGIN -->
        <div class="col-md-4 col-sm-5">
            @if (!empty($login_erros))
                @component('components.alert')
                    <strong>Oh snap!</strong>
                    {{$login_erros}}
                @endcomponent
            @endif
            <div class="box-static box-border-top p-30">

                <form class="sky-form" method="post" action="{{url('agent/login')}}" autocomplete="off">
                    {{csrf_field()}}
                    <div class="clearfix">
                        <!-- Email -->
                        <label>Email</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-envelope"></i>
                            <input required="" name="email" value="root@gmail.com" type="email">
                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                        </label>

                        <!-- Password -->
                        <label>Password</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-lock"></i>
                            <input required="" value="11111111" name="password" type="password">
                            <b class="tooltip tooltip-bottom-right">Type your account password</b>
                        </label>

                    </div>

                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-6">

                            <!-- Inform Tip -->
                            <div class="form-tip pt-20">
                                <a class="no-text-decoration fs-13 mt-10 block" href="#">Forgot
                                    Password?</a>
                            </div>

                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">

                            <button class="btn btn-primary"><i class="fa fa-check"></i> LOGIN</button>

                        </div>

                    </div>

                </form>



            </div>
        </div>
        <!-- /LOGIN -->
        @include('agents.agent_register');
    </div>
    </div>
@endsection

