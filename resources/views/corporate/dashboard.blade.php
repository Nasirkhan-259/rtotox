@extends('layouts.corporate_admin')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/jquery-ui-datepiker.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
    <style type="text/css">
        .select2-dd-template {
            background: #f2f2f2;
        }
        .select2-container {
            width: 100% !important;
        }
    </style>
@endpush
@section('content')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-3 ">
                    @if(auth()->user()->is_approver)
                    <ul class="list-group list-group-bordered list-group-noicon uppercase">
                    <li class=" list-group-item fs-12">
                        <span class="fs-11 text-muted float-right">(0)</span>
                        PENDING TO APPROVE
                    </li>
                    <li class="list-group-item fs-12">
                        <span class="fs-11 text-muted float-right">(0)</span>
                        PENDING FOR APPROVAL
                    </li>
                    </ul>
                    @endif
                </div>

                <!-- hotel details  -->
                <div class="col-md-8 card pt-10 ">
                    <ul class="nav nav-tabs nav-button-tabs">
                        <li class="nav-item"><a class="nav-link btn-danger fs-14 active" href="#flights" data-toggle="tab">FLIGHTS</a></li>
                        <li class="nav-item"><a class="nav-link btn-danger fs-14" href="#hotels" data-toggle="tab">HOTELS</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show fade" id="flights">
                            <!-- flight booking form corporate -->
                            <fieldset class="margin-top-60">
                                <div class="row mb-30">
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input v-model="searchForm.tripType" type="radio" v-on:change="SetTripType('oneway')" value="oneway" >
                                            <i></i> <span class="fw-300">One Way</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input v-model="searchForm.tripType" type="radio" v-on:change="SetTripType('round')" value="round">
                                            <i></i> <span class="fw-300">Return Trip</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input v-model="searchForm.tripType" type="radio" v-on:change="SetTripType('multicity')"  value="multicity">
                                            <i></i> <span class="fw-300">Multi City</span>
                                        </label> </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Origin</label>
                                        <select v-model="searchForm.origin" class="form-control" data-property-name="origin" id="FlightLocationSelect2"></select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Destination</label>
                                        <select v-model="searchForm.destination" class="form-control" data-property-name="destination" id="FlightLocationSelect2"></select>
                                    </div>
                                </div>
                                <div class="row mb-20">
                                    <div class="col-md-6 col-sm-6">
                                        <label for="departureDate">Depature Date</label>
                                        <!-- departureDate as id  for vue ChangeDate -->
                                        <input type="text" id="departureDate"  readonly="readonly" class="form-control">
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div v-show="TripType == 'round'">
                                            <label for="returnDate">Return Date</label>
                                            <!-- returnDate as id  for vue ChangeDate -->
                                            <input type="text" id="returnDate"  readonly="readonly" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="heading-title mb-5">
                                    <h4 class="fs-14">Trip Type</h4>
                                </div>
                                <div class="row mb-20">
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_business"  v-model="searchForm.flightType" type="radio" checked v-on:change="FlightType = 'business'" value="business">
                                            <i></i> <span class="fw-300">Business</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_business-family" v-model="searchForm.flightType" type="radio" v-on:change="FlightType = 'business-fmaily'" value="business-fmaily">
                                            <i></i> <span class="fw-300">Business + Family</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_rotation" v-model="searchForm.flightType" type="radio" v-on:change="FlightType = 'rotation'" value="rotation">
                                            <i></i> <span class="fw-300">Rotation</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_personal" v-model="searchForm.flightType" type="radio" v-on:change="FlightType = 'personal'" value="personal">
                                            <i></i> <span class="fw-300">Personal</span>
                                        </label></div>
                                </div>
                                <div class="row mb-30">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Preferred Airline</label>
                                        <select v-model="searchForm.preferredAirline" data-property-name="preferredAirline" class="form-control" id="AirlineSelect2"></select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 mt-40">
                                        <label class="checkbox float-left">
                                            <input id="shipswitch" v-model="searchForm.requestedFlightType" type="checkbox" v-on:change="searchForm.requestedFlightType = 'Direct'" value="Direct">
                                            <i></i> <span class="fw-300">Show me Direct Flights Only</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-30">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="col-md-3 float-left">
                                            <label>Adult</label>
                                            <select class="pointer" v-model="searchForm.adults" id="adult">
                                                <option value="1" selected="">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 float-left" id="child">
                                            <label>Child</label>
                                            <select class="pointer" v-model="searchForm.children" id="child" v-show="FlightType == 'business-fmaily' || FlightType == 'personal'">
                                                <option value="0" selected="">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 float-left" id="infant">
                                            <label>Infant</label>
                                            <select class="pointer" v-model="searchForm.infants" id="infant" v-show="FlightType == 'business-fmaily' || FlightType == 'personal'">
                                                <option value="0" selected="">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="col-md-6 col-sm-6">
                                            <label>Cabin Class *</label>
                                            <select v-model="searchForm.cabinClass" class="form-control pointer ">
                                                <option value="Economy">Economy</option>
                                                <option value="Premium Economy">Premium Economy</option>
                                                <option value="Business Class">Business Class</option>
                                                <option value="First Class">First Class</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="alert alert-danger" v-show="ValidationError" v-text="ValidationError"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-right">
                                        <button type="button" class="btn btn-primary" v-on:click="OpenFlightModelBox()">SEARCH FLGHTS</button>
                                    </div>
                                </div>
                            </fieldset>
                            <!--/flight booking form corporate-->

                            <!-- model dialog box-->
                            <div class="modal fade bs-flight-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <!-- header modal -->
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <ul class="nav nav-tabs nav-button-tabs">
                                            <li class="nav-item"><a class="nav-link btn-default active" href="#home" data-toggle="tab">NEW TRIP</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#profile" data-toggle="tab">EXISTING TRIP</a></li>
                                        </ul>
                                    </div>
                                    <!-- body modal -->
                                    <div class="modal-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="home">
                                                <fieldset class="margin-top-60">
                                                    <div class="row mb-10">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label>Trip ID</label>
                                                            <input v-model="searchForm.tripId" type="text" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="">Trip Name</label>
                                                            <input id="" v-model="searchForm.tripName" type="text" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="row mb-10">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="tripStartDate">Trip Start Date</label>
                                                            <input id="tripStartDate" v-model="searchForm.departureDate" type="text" class="form-control" disabled>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label for="tripReturnDate">Trip End Date</label>
                                                            <input id="tripReturnDate" v-model="searchForm.returnDate" type="text" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-10">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label>Select Employee</label>
                                                            <select v-model="searchForm.employeeId" class="form-control" id="EmployeeSelect2">
                                                                @foreach($employees as $employee)
                                                                    <option value="{{json_encode($employee)}}">
                                                                        {{$employee->firstname.' '.$employee->lastname}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <label>Cost Centre</label>
                                                            <select v-model="searchForm.costCenter" v-if="!CostCenterInput" class="form-control" id="CostCenterSelect2">
                                                                @foreach($costCenters as $costCenter)
                                                                    <option value="{{json_encode($costCenter)}}">
                                                                        {{$costCenter->name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input v-model="searchFormCostCenterLable" type="text" class="form-control" v-else readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-10">
                                                        <div class="col-md-12 col-sm-12">
                                                            <button type="button" class="btn btn-primary mt-50 float-right" v-on:click="SaveAndSearchTrip()">Save Trip & Search</button>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="alert alert-danger" v-show="ValidationError" v-text="ValidationError"></div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="tab-pane fade" id="profile">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>Trip ID</th>
                                                            <th>Trip Name</th>
                                                            <th>Trip Type</th>
                                                            <th>Policy</th>
                                                            <th>Select</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($trips as $trip)
                                                            <tr>
                                                                <td>{{$trip->id}}</td>
                                                                <td>{{$trip->tripname}}</td>
                                                                <td>{{$trip->triptype}}</td>
                                                                <td>{{$trip->corporatePolicy->policyname}}</td>
                                                                <td><input id="shipswitch" v-model="searchForm.existingTripId" type="radio" value='{{$trip->id}}'></td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <fieldset>
                                                        <div class="row mb-10">
                                                            <div class="col-md-6 col-sm-6"></div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <button type="button" class="btn btn-primary mt-50 float-right" v-on:click="SearchTrip()" v-bind:disabled="!searchForm.existingTripId">Search with Existing Trip</button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="hotels">
                            <!--hotel booking form -->
                            <fieldset class="margin-top-60">
                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <label for="">Destination</label>
                                        <select v-model="HotelSearchForm.Destination" class="form-control" data-property-name="destination" id="HotelDestination"></select>
                                    </div>
                                </div>
                                <div class="row mb-30">
                                    <div class="col-md-6 ">
                                        <label>Check In</label>
                                        <input type="text" id="hotel_checkin" readonly="readonly"  class="form-control" data-property-name="Checkin">

                                    </div>
                                    <div class="col-md-6 ">

                                        <label>Check Out</label>
                                        <input type="text" id="hotel_checkin_return" readonly="readonly"  class="datepicker form-control" data-property-name="Checkout">
                                    </div>
                                </div>
                                <div class="heading-title mb-5">
                                    <h4 class="fs-14">Trip Type</h4>
                                </div>
                                <div class="row mb-20">
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_business1" name="hotel_bussiness"  v-model="HotelSearchForm.hotelType" type="radio" checked v-on:change="ChangeHotelType('business')" value="business">
                                            <i></i> <span class="fw-300">Business</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_business-family2" name="hotel_bussiness" v-model="HotelSearchForm.hotelType" type="radio" v-on:change="ChangeHotelType('business-fmaily')" value="business-fmaily">
                                            <i></i> <span class="fw-300">Business + Family</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_rotation3" name="hotel_bussiness" v-model="HotelSearchForm.hotelType" type="radio" v-on:change="ChangeHotelType('rotation')" value="rotation">
                                            <i></i> <span class="fw-300">Rotation</span>
                                        </label></div>
                                    <div class="col-md-3 ">
                                        <label class="radio float-left mt-0">
                                            <input id="flighttype_personal4" name="hotel_bussiness" v-model="HotelSearchForm.hotelType" type="radio" v-on:change="ChangeHotelType('personal')" value="personal">
                                            <i></i> <span class="fw-300">Personal</span>
                                        </label></div>
                                </div>
                                <div class="row mb-30">
                                    <div class="col-md-3">
                                        <label>No. Of Rooms</label>
                                        <select v-model="HotelSearchForm.NumberRooms" id="traveltype"   type="text" class="form-control" required>
                                            <option v-for="item in TotalNumberOfRooms"  v-bind:value="item"  v-bind:selected="item === 1 ? 'selected' : false" v-text="item"></option>
                                        </select>
                                    </div>
                                </div>
                                <div v-for="(item,index) in ConvertNumber(HotelSearchForm.NumberRooms)" class="row mb-30">
                                    <div class="col-md-3">
                                        <label>Adult</label>
                                        <select id="traveltype" name="traveltype" v-model="HotelSearchForm.Adults_count[index]" type="text" class="form-control" required>
                                            <option v-for="item in TotalNumberOfRooms"  v-bind:value="item"  v-bind:selected="item === 1 ? 'selected' : false" v-text="item"></option>
                                        </select>
                                    </div>
                                    <div v-if="TotalNumberOfRooms > 1" class="col-md-2">
                                        <label>Child</label>
                                        <select id="traveltype"  v-on:change="ChangeText(item)" v-model="HotelSearchForm.Children_count[index]" type="text" class="form-control required">
                                            <option value="0" >0</option>
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="alert alert-danger" v-show="ValidationHotelError" v-text="ValidationHotelError"></div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-right">
                                        <button class="btn btn-primary" v-on:click="OpenHotelModelBox()" >SEARCH HOTEL</button>
                                    </div>
                                </div>
                            </fieldset>
                            <!--/hotel booking form corporate -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- model dialog box-->
    <div class="modal fade bs-hotel-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- header modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul class="nav nav-tabs nav-button-tabs">
                        <li class="nav-item"><a class="nav-link btn-default active" href="#AddNew" data-toggle="tab">NEW TRIP</a></li>
                        <li class="nav-item"><a class="nav-link" href="#NewTrip" data-toggle="tab">EXISTING TRIP</a></li>
                    </ul>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="AddNew">
                            <fieldset class="margin-top-60">
                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Trip ID</label>
                                        <input v-model="HotelSearchForm.tripId" type="text" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="">Trip Name</label>
                                        <input id="" v-model="HotelSearchForm.tripName" type="text" class="form-control" >
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <label for="tripStartDate">Trip Start Date</label>
                                        <input id="tripStartDate" v-model="HotelSearchForm.Checkin" type="text" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="tripReturnDate">Trip End Date</label>
                                        <input id="tripReturnDate" v-model="HotelSearchForm.Checkout" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-6 col-sm-6">
                                        <label>Select Employee</label>
                                        <select v-model="HotelSearchForm.employeeId" class="form-control" id="EmployeeSelect2">
                                            @foreach($employees as $employee)
                                                <option value="{{json_encode($employee)}}">
                                                    {{$employee->firstname.' '.$employee->lastname}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>Cost Centre</label>
                                        <select v-model="HotelSearchForm.costCenter"  v-if="!CostCenterInput" class="form-control" id="CostCenterSelect2">
                                            @foreach($costCenters as $costCenter)
                                                <option value="{{json_encode($costCenter)}}">
                                                    {{$costCenter->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input v-model="searchFormCostCenterLable" type="text" class="form-control" v-else readonly>
                                    </div>
                                </div>
                                <div class="row mb-10">
                                    <div class="col-md-12 col-sm-12">
                                        <button type="button" class="btn btn-primary mt-50 float-right" v-on:click="SaveAndSearchTripHotel()">Save Trip & Search</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="alert alert-danger" v-show="ValidationError" v-text="ValidationError"></div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="tab-pane fade" id="NewTrip">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Trip ID</th>
                                        <th>Trip Name</th>
                                        <th>Trip Type</th>
                                        <th>Policy</th>
                                        <th>Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($trips as $trip)
                                        <tr>
                                            <td>{{$trip->id}}</td>
                                            <td>{{$trip->tripname}}</td>
                                            <td>{{$trip->triptype}}</td>
                                            <td>{{$trip->corporatePolicy->policyname}}</td>
                                            <td><input id="shipswitch" v-model="HotelSearchForm.existingTripId" type="radio" value='{{$trip->id}}'></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <fieldset>
                                    <div class="row mb-10">
                                        <div class="col-md-6 col-sm-6"></div>
                                        <div class="col-md-6 col-sm-6">
                                            <button type="button" class="btn btn-primary mt-50 float-right" v-on:click="HotelSearchTrip()" v-bind:disabled="!HotelSearchForm.existingTripId">Search with Existing Trip</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('plugins/jquery/jquery-ui-datepiker.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        app.searchForm.tripId = "{{$tripId}}";
        app.HotelSearchForm.tripId = "{{$tripId}}";

        $('[id=HotelDestination]').select2({
            placeholder: "Choose tags...",
            minimumInputLength: 3,
            ajax: {
                url: '{{url("hotels/locations")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    var result = [];
                    data.forEach(function (dataObj) {
                        result.push({
                            id: dataObj.id,
                            airportObj: dataObj,
                            text: dataObj.name +", "+ dataObj.COUNTRY
                    })
                    });
                    return {
                        results: result
                    };
                },
                cache: true
            },
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }

                let airport = $("<div><div class='slect2-dd-heading'></div><div class='select2-dd-description'></div></div>");

                airport.find("div.slect2-dd-heading").text(data.airportObj.name +", "+data.airportObj.COUNTRY );

                return airport;
            }
        }).on("select2:select", function(e) {
            const propertyName = $(e.target).data("property-name");
            const propertyValue = e.params.data.id;
            app.HotelChangeSelect2(propertyName, propertyValue); // Vue app method
        });

        $('[id=FlightLocationSelect2]').select2({
            placeholder: "Choose tags...",
            minimumInputLength: 3,
            ajax: {
                url: '{{url("flights/airports")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    var result = [];
                    data.forEach(function (dataObj) {
                        result.push({
                            id: dataObj.code,
                            airportObj: dataObj,
                            text: dataObj.cityName +", "+ dataObj.countryName +" - "+ dataObj.name
                        })
                    });
                    return {
                        results: result
                    };
                },
                cache: true
            },
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }

                let airport = $("<div><div class='slect2-dd-heading'></div><div class='select2-dd-description'></div></div>");

                airport.find("div.slect2-dd-heading").text(data.airportObj.cityName +" ( "+ data.airportObj.code +" ), "+ data.airportObj.countryName);
                airport.find("div.select2-dd-description").text(data.airportObj.name);

                return airport;
            }
        }).on("select2:select", function(e) {
            const propertyName = $(e.target).data("property-name");
            const propertyValue = e.params.data.id;
            app.ChangeSelect2(propertyName, propertyValue); // Vue app method
        });

        $('[id=AirlineSelect2]').select2({
            placeholder: "Choose tags...",
            minimumInputLength: 3,
            ajax: {
                url: '{{url("flights/airlines")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    var result = [];
                    data.forEach(function (dataObj) {
                        let thumbnail = dataObj.thumbnail.split('.');
                        let carrierCode = thumbnail[0];
                        result.push({
                            id: carrierCode,
                            airportObj: dataObj,
                            text: dataObj.name +", "+ dataObj.country
                        })
                    });
                    return {
                        results: result
                    };
                },
                cache: true
            },
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }

                let airport = $("<div class='select2-dd-template'><div class='slect2-dd-heading'></div></div>");

                airport.find("div.slect2-dd-heading").text(data.airportObj.name +", "+ data.airportObj.country);

                return airport;
            }
        }).on("select2:select", function(e) {
            const propertyName = $(e.target).data("property-name");
            const propertyValue = e.params.data.id;
            app.ChangeSelect2(propertyName, propertyValue); // Vue app method
        });

        let current_date = moment().add(1, 'days').format('Y-MM-DD');
        current_date = current_date.split("-");
        $("#hotel_checkin").val( moment().format('Y-MM-DD'));
        $("#hotel_checkin_return").val( moment().add(1, 'days').format('Y-MM-DD'));

        $("#departureDate").val( moment().format('Y-MM-DD'));
        $("#returnDate").val( moment().add(1, 'days').format('Y-MM-DD'));



        app.HotelSearchForm.Checkout = moment().format('Y-MM-DD');
        app.HotelSearchForm.Checkin = moment().add(1, 'days').format('Y-MM-DD');

        app.searchForm.departureDate = moment().format('Y-MM-DD');
        app.searchForm.returnDate = moment().add(1, 'days').format('Y-MM-DD');


        $("#hotel_checkin").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            afterShow: function () {
                $(".ui-datepicker-prev").empty().append('<i class="fa fa-angle-left"></i>');
                $(".ui-datepicker-next").empty().append('<i class="fa fa-angle-right"></i>')
            },
            onSelect:function (date)
            {
                var newDate = new Date('Y-m-d');
                newDate.setFullYear(date.split('-')[0],date.split('-')[1]-1,date.split('-')[2]);
                newDate.setDate(newDate.getDate() + 1);
                app.HotelSearchForm.Checkin = date;
                app.HotelSearchForm.Checkout = newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate();
                $("#hotel_checkin_return").data('datepicker').settings.minDate  = newDate;
                $("#hotel_checkin_return").val( newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate()) ;

            }
        });
        $("#hotel_checkin_return").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: new Date(current_date[0],current_date[1],current_date[2]),
            afterShow: function () {
                $(".ui-datepicker-prev").empty().append('<i class="fa fa-angle-left"></i>')
                $(".ui-datepicker-next").empty().append('<i class="fa fa-angle-right"></i>')
            },
            onSelect(date)
            {
                app.HotelSearchForm.Checkout = date;

            }
        });

        $("#departureDate").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            afterShow: function () {
                $(".ui-datepicker-prev").empty().append('<i class="fa fa-angle-left"></i>');
                $(".ui-datepicker-next").empty().append('<i class="fa fa-angle-right"></i>')
            },
            onSelect:function (date)
            {
                var newDate = new Date('Y-m-d');
                newDate.setFullYear(date.split('-')[0],date.split('-')[1]-1,date.split('-')[2]);
                newDate.setDate(newDate.getDate() + 1);
                app.searchForm.departureDate = date;
                app.searchForm.returnDate = newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate();
                $("#returnDate").data('datepicker').settings.minDate  = newDate;
                $("#returnDate").val( newDate.getFullYear()+"-"+(newDate.getMonth()+1)+"-"+newDate.getDate()) ;

            }
        });
        $("#returnDate").datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: new Date(current_date[0],current_date[1],current_date[2]),
            afterShow: function () {
                $(".ui-datepicker-prev").empty().append('<i class="fa fa-angle-left"></i>')
                $(".ui-datepicker-next").empty().append('<i class="fa fa-angle-right"></i>')
            },
            onSelect(date)
            {
                app.searchForm.returnDate = date;

            }
        });

        // datepiker ui js end
        $(".star-list li a").click(function(){
            var parentLi = $(this).closest("li");
            if( parentLi.hasClass("active") ){

                parentLi.removeClass("active");
                $(".star-pop-active").addClass("star-pop-hide");
                $(".star-pop-active").removeClass("star-pop-active");
            }else{

                parentLi.addClass("active");
                $(".star-pop-hide").addClass("star-pop-active");
                $(".star-pop-hide").removeClass("star-pop-hide");
            }
        })


        $('[id=EmployeeSelect2]').select2({
            placeholder: "Choose employee..."
        }).on("select2:select", function(e) {
            let employee = JSON.parse(e.params.data.id);
            app.searchForm.employeeId = employee.id;
            app.HotelSearchForm.employeeId = employee.id;
            app.HotelSearchForm.policyLevel = employee.id;
            app.searchForm.policyLevel = employee.travelpolicy;
            let flexCostCentre = employee.flexcostcentre;

            if (flexCostCentre == 0) {
                if (!app.CostCenterInput) {
                    alert("Destroy costcenter");
                    $("#CostCenterSelect2").select2("destroy");
                }

                app.searchForm.costCenter = employee.costcentreid;
                app.HotelSearchForm.costCenter = employee.costcentreid;
                app.searchFormCostCenterLable = employee.cost_center_name;
                app.CostCenterInput = true;

            } else {

                app.searchForm.costCenter = "";
                app.HotelSearchForm.costCenter = "";
                app.searchFormCostCenterLable = "";
                app.CostCenterInput = false;

                $("#CostCenterSelect2").select2({
                    placeholder: "Choose cost center..."
                }).on("select2:select", function(e) {
                    let costCenter = JSON.parse(e.params.data.id);
                    app.searchForm.costCenter = costCenter.id;
                    app.HotelSearchForm.costCenter = costCenter.id;
                    console.log( app.HotelSearchForm)
                });
            }
        });
    </script>
@endpush
