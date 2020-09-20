@extends('layouts.emailtemp')
@section('content')

    <tr>
        <td>
            <table style="padding:10px;margin:0 auto;width:550px">

                <tbody>
                <tr>
                    <td align="center"
                        style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px;"><img
                            src="{{asset('images/common/rtoto-image-confirm.png')}}" width="125" height="120" style="display: block; border: 0px;" /><br>
                        <h2 style="font-size: 25px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank
                            You For Joining Us!</h2>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p
                            style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px; line-height: 24PX;">
                            {{$data->name}},<br>
                            <br>
                            Kindly click the link below to verifiy your email.</p>
                        <div align="center" style="padding-top:10px"><strong><a
                                    href="{{$data->link}}"
                                    style="font-family: sans-serif; font-size: 14px; background-color:#d32f2f;color:#ffffff;border-radius:5px;border:1px solid #d32f2f;font-size:1.062em;display:inline-block;padding:8px 25px;text-decoration:none"
                                    target="_blank"> Very Email</a></strong></div>
                        <BR>

                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px;">
                            Copy and paste this link to the browser if the button is not working <br>
                            <a href="{{$data->link}}" style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px;">
                                {{$data->link}}</a> </p>

                    </td>
                </tr>
                <tr>
                    <td style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding:10px;">
                        Cheers, <br> <strong><span style="color:#d32f2f;">Red</span>.Travel Group</span></strong> Online Team

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>

@stop
