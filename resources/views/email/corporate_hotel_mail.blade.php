@component('mail::message')
<div><p style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';">Dear {{$data->name}},<br><br></div>
<div style="width: 800px;">
Red  Travels has sent you Hotel options as below. Please respond with your  preferred option.</p>
<p style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';" align="center">
<strong>Dubai, United Arab Emirates</strong> for {{$data->stay}} Nights |
<strong>CheckInDate</strong> : {{$data->params->checkin}} <strong>CheckOutDate</strong> : {{$data->params->checkout}}</p>
@foreach($data->EmailItnery as $index=>$emailItnery)
<?php $emailItnery = json_decode($emailItnery); ?>
<h3 align="center">Option {{$index+1}}</h3>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';box-sizing:border-box">
<tbody>
<tr style="background:#e7e7e7">
<td><p align="center"><strong>Hotel Image</strong></p></td>
<td><p align="center"><strong>Hotel Name</strong></p></td>
<td><p align="center"><strong>Room Type</strong></p></td>
<td><p align="center"><strong>Meal Plan</strong></p></td>
<td><p align="center"><strong>Total Tour Cost</strong></p></td>
<td><p align="center"><strong>No.of Passengers</strong></p></td>
</tr>
<tr>
<td><p align="center"><strong><img id="" src="{{$emailItnery->image}}"></strong></p>
<p align="center">{{$emailItnery->company_name}}  ({{$emailItnery->rating}} star)</p></td>
<td><p align="center">{{$emailItnery->room_name}}</p></td>
<td><p align="center">{{$emailItnery->Inclusion}}</p></td>
<td><p align="center">{{ $data->currency }} {{$emailItnery->price}}</p></td>
<td><p align="center">( Adult {{$data->params->adults}} / Child :{{$data->params->children}} ) Total : {{$data->params->adults + $data->params->children}}</p></td>
</tr>
</tbody>
</table>
<h3 align="center"></h3>
<p align="center"></p>
<p align="center"></p>
<p align="center">&nbsp;</p>
@endforeach

</div>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
