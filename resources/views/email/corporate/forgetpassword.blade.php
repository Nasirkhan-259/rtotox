@extends('layouts.emailtemp')
@section('content')

<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px; line-height: 18px;">
    Hello {{$data->Corporate->firstname}}  {{$data->Corporate->lastname}},
<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px; line-height: 18px;">
    Your have requested for your password<br>
     <br>
     <strong>Username</strong>: {{$data->Corporate->email}}<br>
     <strong>Password</strong>: {{$data->Corporate->password_hash}}<br>
     <br>
     <br>
     Warm Regards, <br>
     <br>
     Red Travel Team<br>
     <a href="{{url("corporate/".$data->Corporate->alais)}}" target="_blank">{{url("corporate/$data->Corporate->alais")}}</a>
     <br>
    </p>

@stop
