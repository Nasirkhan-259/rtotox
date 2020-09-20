@extends('layouts.app')
@section('breadcrumb')
    <section class="page-header page-header-xs">
        <div class="container">

            <h1>AGENT SETTINGS</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active">Agent Settings</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
@endsection
@section('content')
<div class="container">
<div class="row">
        @include('agents.sidebar')


    <div class="col-lg-9 col-md-9 col-sm-8 order-md-2 order-sm-2 mb-80">

        <ul class="nav nav-tabs nav-top-border">
            <li class="active"><a href="#info" data-toggle="tab" class="active show">Personal Info</a></li>
            <li><a href="#logo" data-toggle="tab" class="">Logo</a></li>
            <li><a href="#password" data-toggle="tab" class="">Password</a></li>
            <li><a href="#payments" data-toggle="tab" class="">Payments</a></li>
        </ul>


        <div class="tab-content mt-20">
            @if (!empty($errors))
                @component('components.alert')
                    @foreach($errors as $error)
                        {{$error}}<br>
                    @endforeach
                @endcomponent
            @endif
            <!-- PERSONAL INFO TAB -->
            @if (!empty($success))
                @component('components.alert_success')
                    <strong>Settings Save Successfully</strong>
                @endcomponent
            @endif
            <div class="tab-pane active show" id="info">
                <form action="{{url('agent/settings')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="form-control-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" value="{{$agent->company_name}}"  placeholder="ABC Travel Ltd">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{$agent->first_name}}" placeholder="John">
                        <input type="hidden" name="check_settings" value="settings" class="form-control" placeholder="John">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Last Name</label>
                        <input type="text" name="last_name" placeholder="Doe" value="{{$agent->last_name}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Mobile Number</label>
                        <input type="text" name="contact_number" placeholder="+1800-1234-657" value="{{$agent->contact_number}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">About</label>
                        <textarea class="form-control" rows="3" name="about_me"  placeholder="About Me...">{{$agent->about_me}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Website Url</label>
                        <input type="text" placeholder="http://www.yourwebsite.com" name="web_url" value="{{$agent->web_url}}"  class="form-control">
                    </div>
                    <div class="margiv-top10">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes </button>
                        <a href="#" class="btn btn-default">Cancel </a>
                    </div>
                </form>
            </div>
            <!-- /PERSONAL INFO TAB -->

            <!-- LOGO  TAB -->
            <div class="tab-pane fade" id="logo">

                <form class="clearfix" action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">

                        <div class="row">

                            <div class="col-md-3 col-sm-4">

                                <div class="thumbnail">
                                    <img class="img-fluid logo" src="{{ empty($agent->logo) ? asset('images/agent/agent.jpg'): asset('images/agent/'.$agent->logo) }}" alt="">
                                </div>

                            </div>

                            <div class="col-md-9 col-sm-8">

                                <form action="{{url('agent/settings')}}"  method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="sky-form m-0">
                                    <label class="label">Select File</label>
                                    <label for="file" class="input input-file">
                                        <input name="check_settings" required value="save_logo" type="hidden">
                                        <div class="button">
                                            <input type="file" name="agent_logo" id="hlogo" >Browse </div><input type="text" readonly="">
                                    </label>
                                </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save Changes </button>
                                </form>
                                <div class="clearfix mt-20">
                                    <span class="badge badge-warning">NOTE! </span>
                                    <p>
                                        Max. file size: 1MB, allowed type files: JPG, GIF, PNG
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
            <!-- /AVATAR TAB -->

            <!-- PASSWORD TAB -->
            <div class="tab-pane fade" id="password">

                <form action="{{url('agent/settings')}}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="form-control-label">Current Password</label>
                        <input type="password" required name="current_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" value="change_password" name="check_settings">
                        <label class="form-control-label">New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Re-type New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="margiv-top10">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Change Password</button>
                        <a href="#" class="btn btn-default">Cancel </a>
                    </div>

                </form>

            </div>
            <!-- /PASSWORD TAB -->

            <!-- PAYMENTS TAB -->
            <div class="tab-pane fade" id="payments">



                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td>Receipt Number</td>
                        <td>Date</td>
                        <td>Amount</td>
                        <td>
                            Options
                        </td>
                    </tr>
                    <tr>
                        <td>AGT/1256/01</td>
                        <td>12/02/2018</td>
                        <td>USD 2,525</td>
                        <td>
                            <span class="badge badge-warning"><a href="#">Generate Receipt</a></span>
                        </td>
                    </tr>

                    </tbody>
                </table>

            </div>



            <!-- /PAYMENTS TAB -->

        </div>

    </div>

        </div>
    </div>
@endsection
@push('scripts')

    <script>
        function readLogo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.logo').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);


            }
        }

        $("#hlogo").change(function () {
            readLogo(this);
        });

    </script>

@endpush
