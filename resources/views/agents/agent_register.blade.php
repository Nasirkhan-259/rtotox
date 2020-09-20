<div class="col-md-8 col-sm-7">
    @if (!empty($signup_erros))
        @component('components.alert')
            <strong>Oh snap!</strong>
            @foreach($signup_erros as $error)
                {{$error}}<br>
            @endforeach
        @endcomponent
    @endif
    @if (!empty($success_signup))
        @component('components.alert_success')
            <strong>Your account has been register kindly check your email</strong>
        @endcomponent
    @endif
    <div class="box-static box-transparent box-bordered p-30">
        <div class="box-title mb-30">
            <h2 class="fs-20">Don't have an account yet? Register as agent</h2>
        </div>
        <form class="m-0 sky-form" id="register_form" action="{{url('agent/login')}}" method="post"
              enctype="multipart/form-data">
            {{csrf_field()}}
            <fieldset>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label>First Name *</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-user"></i>
                            <input required="" name="first_name" value="{{old('first_name')}}" type="text">
                            <b class="tooltip tooltip-bottom-right">Your First Name</b>
                        </label>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label for="register:last_name">Last Name *</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-user"></i>
                            <input required="" name="last_name" value="{{old("last_name")}}" type="text">
                            <b class="tooltip tooltip-bottom-right">Your Last Name</b>
                        </label>
                    </div>
                </div>
                <input value="1" type="hidden" name="post_signup">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label for="register:email">Email *</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-envelope"></i>
                            <input name="email" value="{{old("email")}}" required="" type="text">
                            <b class="tooltip tooltip-bottom-right">Your Email</b>
                        </label>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label for="register:phone">Phone</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-phone"></i>
                            <input name="contact_number" type="text">
                            <b class="tooltip tooltip-bottom-right">Your Phone (optional)</b>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <label for="register:pass1">Password *</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-lock"></i>
                            <input name="password" required="" type="password" class="err">
                            <b class="tooltip tooltip-bottom-right">Min. 6 characters</b>
                        </label>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <label for="register:pass2">Password Again *</label>
                        <label class="input mb-10">
                            <i class="ico-append fa fa-lock"></i>
                            <input required="" name="password_confirmation" type="password" class="err">
                            <b class="tooltip tooltip-bottom-right">Type the password again</b>
                        </label>
                    </div>
                </div>

                <hr/>

                <label class="checkbox m-0">
                    <input class="checked-agree" id="agree_check_box" checked type="checkbox"><i></i>I agree to the <a
                        href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a></label>
                <label class="checkbox m-0"><input type="checkbox" name="subscribe_check"><i></i>I want to
                    receive news and special offers</label>
            </fieldset>

            <div class="row">
                <div class="col-md-12">
                    <button type="" onclick="validate()" class="btn btn-primary"><i class="fa fa-check"></i>
                        REGISTER
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        $("#register_form").submit(function (e) {
            if (!$("#agree_check_box").is(":checked")) {
                e.preventDefault();
                alert("You must agree with term and condition.")
            }
        });
    </script>
@endpush
