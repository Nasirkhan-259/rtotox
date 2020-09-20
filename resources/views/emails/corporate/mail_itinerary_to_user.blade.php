@component('mail::message')
<div class="itinerary">
<div class="aHl">&nbsp;</div>
<div id=":1h0" tabindex="-1">&nbsp;Dear {{ $user->name }},</div>
<div id=":1gp" class="ii gt" style="width: 800px;">
    <div id=":1go" class="a3s aXjCH ">
        <div style="clear: both; height: 10px;">&nbsp;</div>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin-bottom: 10px; margin-top: 10px; padding: 10px; line-height: 18px;">
            {{ config('app.name') }} has sent you Flight options as below. Please respond with your preferred option.</p>
        <div style="clear: both; height: 10px;">&nbsp;</div>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px; text-align: center" align="center">
            <strong>{{$flightSearchRequest->Origin->Code}}&nbsp;&nbsp;<span style="font-size: 22px;">⇆</span>&nbsp;&nbsp;{{$flightSearchRequest->Destination->Code}}</strong><br/>
            {{$flightSearchRequest->Departure->dateString}} @if ($flightSearchRequest->TripType == "round") - {{$flightSearchRequest->Arrival->dateString}} @endif |
            {{$flightSearchRequest->Travler->Adults}} Adult
            @if ($flightSearchRequest->Travler->Children) {{$flightSearchRequest->Travler->Adults}} Children @endif
            @if ($flightSearchRequest->Travler->Infants) {{$flightSearchRequest->Travler->Infants}} Infants @endif
        </p>

        @foreach ($itineraries as $index => $itinerary)
        <h3 style="font-family: sans-serif; font-weight: normal; margin: 0; padding: 10px;" align="center">Option {{ ($index+1) }}</h3>
        <table style="padding: 10px 0 10px 0; margin: 0 auto;" border="0" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
            <tr style="background: #e7e7e7;">
                <td style="padding: 10px; border: 1px solid #9e9e9b;" width="20%">
                    <div style="font-family: sans-serif; font-size: 11px; font-weight: normal; margin: 0; padding: 0px; line-height: 18px;">
                        <strong>Airline</strong>
                    </div>
                </td>
                <td style="padding: 10px; border: 1px solid #9e9e9b;" width="30%">
                    <div style="font-family: sans-serif; font-size: 11px; font-weight: normal; margin: 0; padding: 0px; line-height: 18px;">
                        <strong>Depart</strong>
                    </div>
                </td>
                <td style="padding: 10px; border: 1px solid #9e9e9b;" width="22%">
                    <div style="font-family: sans-serif; font-size: 11px; font-weight: normal; margin: 0; padding: 0px; line-height: 18px;">
                        <strong>Arrive</strong>
                    </div>
                </td>
                <td style="padding: 10px; border: 1px solid #9e9e9b;" width="14%">
                    <div style="font-family: sans-serif; font-size: 11px; font-weight: normal; margin: 0; padding: 0px; line-height: 18px;">
                        <strong>Duration</strong>
                    </div>
                </td>
                <td style="padding: 10px; border: 1px solid #9e9e9b;" width="14%">
                    <div style="font-family: sans-serif; font-size: 11px; font-weight: normal; margin: 0; padding: 0px; line-height: 18px;">
                        <strong>Price</strong>
                    </div>
                </td>
            </tr>
            @foreach ($itinerary->FlightOptionsList->FlightOption as $FlightOption)
            <tr>
                @if ($loop->first)
                <td style="font-family: sans-serif; font-size: 11px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px; border: 1px solid #9e9e9b; text-align: center;" rowspan="2">
                    <strong><img src="{{ asset('images/airlines/'.$FlightOption->Option[0]->Carrier->Code.'.png') }}" alt="{{$FlightOption->Option[0]->Carrier->Code}}" title="{{$FlightOption->Option[0]->Carrier->Name}}"><br/></strong>
                    <strong>{{$FlightOption->Option[0]->Carrier->Name}}</strong>
                </td>
                @endif
                <td style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px; border: 1px solid #9e9e9b;">
                    <strong>{{ $FlightOption->Option[0]->FlightLabelInfo->DepartureTime }}</strong> {{ $FlightOption->Option[0]->FlightLabelInfo->DepartureDate }}<br/>{{ $FlightOption->Option[0]->FlightLabelInfo->Route }}
                </td>
                <td style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px; border: 1px solid #9e9e9b;">
                    {{ $FlightOption->Option[0]->FlightLabelInfo->ArrivalTime }}<br/>{{ $FlightOption->Option[0]->FlightLabelInfo->ArrivalDate }}
                </td>
                <td style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px; border: 1px solid #9e9e9b;">
                    {{ $FlightOption->Option[0]->FlightLabelInfo->Duration }}<br/>{{ $FlightOption->Option[0]->FlightLabelInfo->TotalStop }} Stops
                </td>
                @if ($loop->first)
                <td style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px; border: 1px solid #9e9e9b;" rowspan="2">
                    {{ $itinerary->Currency }} <span id="m_-3678053465623265368spnprice">{{ $itinerary->TotalPrice }}</span>*
                </td>
                @endif
            </tr>
            @endforeach
            </tbody>
        </table>
        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; padding: 10px; line-height: 18px;">&nbsp;</p>
        @endforeach

    </div>
    <div class="yj6qo">&nbsp;</div>
</div>
<div id=":1h5" class="ii gt" style="display: none;">&nbsp;</div>
<div class="hi">&nbsp;</div>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent