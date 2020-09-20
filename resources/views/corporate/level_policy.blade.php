@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="desig-info">
                    <h3 class="border-bottom d-flex justify-content-between mb-30">
                        <div>Policy Level: <strong>{{$rules[0]->name}}</strong></div>
                        <div>Currency:<strong>USD</strong></div>
                    </h3>
                    <form method="post" id="submit_form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Per Day Allowance</label>
                                <input required type="text" name="per_day_allowance" value="{{!empty($policy->per_day_allowance) ? $policy->per_day_allowance : ''  }}" class="form-control" placeholder="5000.00">
                            </div>
                            <div class="col-md-4">
                                <label for="">Insurance</label>
                                <input required name="Insurance" value="{{!empty($policy->Insurance) ? $policy->Insurance : ''  }}" type="text" class="form-control" placeholder="5000.00">
                            </div>
                            <div class="col-md-4">
                                <label for="">Allow Self Book</label>
                                <div class="d-flex justify-content-between w-120">
                                    <label for=""><input {{!empty($policy->allow_self_booking) ? 'checked' : '' }} name="allow_self_booking" value="1"  type="radio"class="mr-10">Yes</label>
                                    <label for=""><input {{empty($policy->allow_self_booking) ? 'checked' : '' }} name="allow_self_booking" value="0" type="radio" class="mr-10">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Min. No. of Days before Departure</label>
                                <select name="" id="" class="w-100 form-control">
                                    @for($i=0 ; $i<15;$i++)
                                    <option {{!empty($policy->number_ofday) && $i==$policy->number_ofday ?"selected":"" }} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Allow Travel For:</label>
                                <div class="d-flex justify-content-between flex-wrap">
                                    <label for=""> <input hidden name="allow_bussiness" value="0">  <input name="allow_bussiness" value="1"  {{!empty($policy->allow_bussiness) ? 'checked' : '' }}  type="checkbox"class="mr-5">Business</label>
                                    <label for=""><input hidden name="allow_bussiness_family" value="0"> <input type="checkbox" value="1" name="allow_bussiness_family" {{!empty($policy->allow_bussiness_family) ? 'checked' : '' }} class="mr-5">Business + Family</label>
                                    <label for=""><input hidden name="allow_rotational" value="0"> <input type="checkbox" value="1" name="allow_rotational" {{!empty($policy->allow_rotational) ? 'checked' : '' }} class="mr-5">Rotational</label>
                                    <label for=""><input hidden name="allow_medical" value="0"> <input type="checkbox" value="1" name="allow_medical" {{!empty($policy->allow_medical) ? 'checked' : '' }} class="mr-5">Medical</label>
                                    <label for=""><input hidden name="allow_personal" value="0"><input type="checkbox" value="1" name="allow_personal" {{!empty($policy->allow_personal) ? 'checked' : '' }} class="mr-5">Presonal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <select id="select" name="select_values[]" class="form-control" multiple="multiple">
                                    <option {{ !empty($policy->rotational_values) && in_array("Economy",$policy->rotational_values) ? "selected" : "" }} value="Economy">Economy</option>
                                    <option {{ !empty($policy->rotational_values) && in_array("Business",$policy->rotational_values) ? "selected" : "" }} value="Business">Business</option>
                                    <option {{ !empty($policy->rotational_values) && in_array("First",$policy->rotational_values) ? "selected" : "" }} value="First">First</option>
                                    <option {{ !empty($policy->rotational_values) && in_array("Premium Economy",$policy->rotational_values) ? "selected" : "" }} value="Premium Economy">Premium Economy</option>
                                </select>

                            </div>
                        </div>
                        <div class="add-pol-flight">
                            <h3 class="border-bottom pb-10">Flight</h3>
                            <div class="row border-bottom">
                                <div class="col-md-6 border-right-md">
                                    <div class="d-flex align-items-center flex-wrap flex-lg-nowrap">
                                        <label for="" style="flex:1 1 100%">Domestic Max Budget:</label>
                                        <input  required name="flight_domestic_totalbudget" value="{{!empty($policy->flight_domestic_totalbudget) ? $policy->flight_domestic_totalbudget : "" }}" type="text" class="form-control" placeholder ="50000.00" style="flex:1 1 100%">
                                        <input hidden name="policy_id" value="{{$id}}">
                                    </div>
                                    <h4 class="my-3"> Class of Service:</h4>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="domestic_econonomy_allowed" value="0">
                                            <input value="1" name="domestic_econonomy_allowed" {{!empty($policy->domestic_econonomy_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">Economy</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input type="text" name="domestic_econonomy_hours" value="{{!empty($policy->domestic_econonomy_hours) ?$policy->domestic_econonomy_hour : "" }}" class="form-control mr-30" placeholder="00:00" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap ">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="domestic_businessclass_allowed" value="0">
                                            <input name="domestic_businessclass_allowed" value="1" {{!empty($policy->domestic_businessclass_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">Business</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input name="domestic_businessclass_hours" value="{{!empty($policy->domestic_businessclass_hours) ?$policy->domestic_businessclass_hours : "" }}" type="text" class="form-control mr-30" placeholder="00:00" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="domestic_first_allowed" value="0">
                                            <input name="domestic_first_allowed" value="1" {{!empty($policy->domestic_first_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">First</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input hidden name="domestic_firstclass_hours" value="0">
                                            <input name="domestic_firstclass_hours" value="{{!empty($policy->domestic_firstclass_hours) ?$policy->domestic_firstclass_hours : "" }}"  type="text" class="form-control mr-30" placeholder="hh:mm" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="domestic_premiumcalss_allowed" value="0">
                                            <input name="domestic_premiumcalss_allowed" value="1" {{!empty($policy->domestic_premiumcalss_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">Premium Economy</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input name="domestic_premiumcalss_hours" value="{{!empty($policy->domestic_premiumcalss_hours) ?$policy->domestic_premiumcalss_hours : "" }}" type="text" class="form-control mr-30" placeholder="hh:mm" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center flex-wrap flex-lg-nowrap">
                                        <label for="" style="flex:1 1 100%">International Max Budget:</label>
                                        <input name="international_flight_budget" value="{{!empty($policy->international_flight_budget) ?$policy->international_flight_budget : "" }}" type="text" class="form-control" placeholder ="50000.00" style="flex:1 1 100%">
                                    </div>
                                    <h4 class="my-3"> Class of Service:</h4>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="international_econonomy_allowed" value="0">

                                            <input name="international_econonomy_allowed" value="1" {{!empty($policy->international_econonomy_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">Economy</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input type="text" name="international_econonomy_hours" value="{{!empty($policy->international_econonomy_hours) ?$policy->international_econonomy_hours : "" }}" class="form-control mr-30" placeholder="00:00" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="international_businessclass_allowed" value="0">
                                            <input name="international_businessclass_allowed" value="1" {{!empty($policy->international_businessclass_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">Business</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input name="international_businessclass_hours"  value="{{!empty($policy->international_businessclass_hours) ? $policy->international_businessclass_hours  : "" }}"  type="text" class="form-control mr-30" placeholder="00:00" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="international_firstclass_allowed" value="0">
                                            <input name="international_firstclass_allowed" value="1" {{!empty($policy->international_firstclass_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">First</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input name="international_firstclass_hours"  value="{{!empty($policy->international_firstclass_hours) ? $policy->international_firstclass_hours : "" }}" type="text" class="form-control mr-30" placeholder="hh:mm" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-30 flex-wrap flex-lg-nowrap">
                                        <div style="flex:1 1 100%">
                                            <input hidden name="international_premiumeconomy_allowed" value="0">
                                            <input name="international_premiumeconomy_allowed" value="1" {{!empty($policy->international_premiumeconomy_allowed) ? "checked" : "" }} type="checkbox">
                                            <label for="" class="d-inline-block pl-5">Premium Economy</label>
                                        </div>
                                        <div class="d-flex align-items-center" style="flex:1 1 100%">
                                            <input name="international_premiumeconomy_hours"  value="{{!empty($policy->international_premiumeconomy_hours) ? $policy->international_premiumeconomy_hours : "" }}" type="text" class="form-control mr-30" placeholder="hh:mm" style="width:50%">
                                            Greater Then
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between">
                                        <label for="">Preferred Flight:</label>
                                        <div>
                                            <label for="" class="mb-0">Yes</label>
                                            <input checked {{!empty($policy->preffer_flight) ? 'checked' : '' }} value="1" onclick="enable_rules(this);" name="preffer_flight" type="radio">
                                        </div>
                                        <div>
                                            <label for="" class="mb-0">No</label>
                                            <input {{empty($policy->preffer_flight) ? 'checked' : '' }} value="0" onclick="disable_rules(this)" name="preffer_flight" type="radio">
                                        </div>
                                    </div>
                                    <label for="">Add Rule</label>
                                    <select name="rule_id" id="rules" class="form-control">
                                        <option value="">Choose a Rule..</option>
                                        @foreach($rules as $ru)
                                        <option {{(!empty($policy->rule_id) && $policy->rule_id == $ru->id) ? "selected":"" }} value="{{$ru->id}}">{{$ru->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h3 class="border-bottom pb-10">
                            Hotels
                        </h3>
                        <div class="row">
                            <div class="col-md-6 border-right-md">
                                <div class="d-flex align-items-center flex-wrap flex-lg-nowrap">
                                    <label for="" style="flex:1 1 100%">Domestic Max Budget(Per Night):</label>
                                    <input required name="hotel_domestic_totalbudget"  value=" {{!empty($policy->hotel_domestic_totalbudget) ? $policy->hotel_domestic_totalbudget : "" }}"  type="text" class="form-control" placeholder="50000.00" style="flex:1 1 50%">
                                </div>
                                <div class="d-flex justify-content-between my-3">
                                    <label for="">Local Hotel Prefer:</label>
                                    <div class="d-flex" style ="width:220px">
                                        <div class="mr-20"
                                        >
                                            <label for="" class="mb-0">Yes</label>
                                            <input {{empty($policy->preffer_flight) ? 'checked' : '' }} name="preffer_flight"  type="radio">
                                        </div>
                                        <div>
                                            <label for="" class="mb-0">No</label>
                                            <input {{empty($policy->preffer_flight) ? 'checked' : '' }}  name="preffer_flight" type="radio">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="credit-info mb-20" style="box-shadow: inset 0 7px 9px -7px rgba(0,0,0,0.7);">
                                            <div class="alert alert-secondary alert-dismissible fade show  float-left mr-5" role="alert">
                                                BEST WESTERN CBD HOTEL-CORPORATE
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-secondary alert-dismissible fade show  float-left mr-5" role="alert">
                                                Closseum Masaki-Corporate
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="alert alert-secondary alert-dismissible fade show  float-left mr-5" role="alert">
                                                Gumtree Lodge
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-20">
                                    <button class="btn btn-danger">Update</button>
                                    <button onclick="Back()" class="btn btn-danger">Cancel</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center flex-wrap flex-lg-nowrap">
                                    <label for="" style="flex:1 1 100%">International Max Budget(Per Night):</label>
                                    <input name="international_hotel_budget"  value=" {{!empty($policy->international_hotel_budget) ? $policy->international_hotel_budget : "" }} "  type="text" class="form-control" placeholder="50000.00" style="flex:1 1 50%">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $("#select").select2();

        $('#submit_form').on('submit',function(event){

            var url = '{{url('corporate/policy/setup')}}';

            var data = $("#submit_form").serialize();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function(data) {
                    window.location.href = '{{url('corporate/policy')}}'
                },
                error: function(){
                }
            });
        });

        function enable_rules() {
            $("#rules").prop('disabled', false);

        }
        function disable_rules() {
            $("#rules").prop('disabled', true);

        }

    </script>

@endpush
