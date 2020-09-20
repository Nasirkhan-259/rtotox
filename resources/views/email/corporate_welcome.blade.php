@extends('layouts.emailtemp')
@section('content')

    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px; line-height: 18px;">Hello {{$data->name}},
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px; line-height: 18px;">

        Thank you for your registration on Travel Desk.
        Your account detail is given below.<br>
        <br>
        <strong>Username</strong>: {{$data->username}}<br>
        <strong>Password</strong>: {{$data->password}}<br>
        <br>
        <br>
        Warm Regards, <br>
        <br>
        Red Travel Team<br>
        <a href="{{$data->link}}" target="_blank">{{$data->link}}l</a> <br>
    </p>

@stop
