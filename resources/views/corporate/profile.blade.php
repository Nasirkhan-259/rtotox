@extends('layouts.corporate_admin')

@push("styles")

    <style>

        .title_sub{
            position: relative;
        }
        .title_sub .gen-det {
            position: absolute;
            background-color: #fff;
            padding: 0 5px;
            top: -10px;
            left: 10px;
        }
    </style>

@endpush

@section('content')

    <form method="post" id="submit_form">
        {{csrf_field()}}
        <div class="container my-4">

            <div class="credit-info mt-20">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="border-bottom">Employee Master</h3>
                        <div class="border title_sub" style="border-radius:3px; padding:10px;">
                            <div class="gen-det">
                                <h6 class="mb-0">General Details</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Employee Code <span class="text-danger">*</span></label>
                                    <input
                                           value="{{!empty($employee->employeecode) ? $employee->employeecode : '' }}"
                                           type="text" class="form-control" disabled>
                                    <input name="employee[id]" type="hidden"
                                           value="{{!empty($employee->id) ? $employee->id : '' }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Employee Type <span class="text-danger">*</span></label>
                                    <select disabled  id="" class="form-control">
                                        <option {{(!empty($employee->employee_type) && $employee->employee_type  == "Company Employee")?'selected':''}} value="Company Employee">Company Employee</option>
                                        <option {{(!empty($employee->employee_type) && $employee->employee_type  == "COntractor")?'selected':''}} value="COntractor">COntractor</option>
                                        <option {{(!empty($employee->employee_type) && $employee->employee_type  == "COnsultant")?'selected':''}} value="COnsultant">COnsultant</option>
                                        <option {{(!empty($employee->employee_type) && $employee->employee_type  == "Doctor")?'selected':''}} value="Doctor">Doctor</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Point of Hire <span class="text-danger">*</span></label>
                                    <input disabled  type="text"
                                            value="{{!empty($employee->point_of_hire) ? $employee->point_of_hire : '' }}"
                                            class="form-control" placeholder="Type Departure City"/>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Create Own Trip <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <input type="radio" disabled checked  {{!empty($employee->create_own_trip) ? "checked" : "" }} value="1" id="" class="mr-20">
                                        <label for="">Yes</label>
                                        <input type="radio" disabled  {{!empty($employee->create_own_trip) ? "" : "checked" }} id="" value="0" class="mx-3">
                                        <label for="">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Salutation <span class="text-danger">*</span></label>
                                    <select disabled  id="" class="form-control">
                                        <option value="mr" {{(!empty($fm->salutation) && $fm->salutation  == 'mr')?'selected':'' }}>
                                            MR
                                        </option>
                                        <option value="miss" {{(!empty($fm->salutation) && $fm->salutation  == 'miss')?'selected':'' }}>
                                            MISS
                                        </option>
                                        <option value="ms" {{(!empty($fm->salutation) && $fm->salutation  == 'ms')?'selected':'' }}>
                                            MS
                                        </option>
                                        <option value="mrs" {{(!empty($fm->salutation) && $fm->salutation  == 'mrs')?'selected':'' }}>
                                            MRS
                                        </option>
                                        <option value="dr" {{(!empty($fm->salutation) && $fm->salutation  == 'dr')?'selected':'' }}>
                                            DR
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">First Name <span class="text-danger">*</span></label>
                                    <input disabled type="text" disabled
                                           value="{{!empty($employee->firstname) ? $employee->firstname : '' }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Middle Name <span class="text-danger"></span></label>
                                    <input disabled  type="text"
                                            value="{{!empty($employee->middlename) ? $employee->middlename : '' }}"
                                            class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Last Name <span class="text-danger">*</span></label>
                                    <input disabled type="text"
                                           value="{{!empty($employee->lastname) ? $employee->lastname : '' }}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Branch/Location <span class="text-danger">*</span></label>
                                    <select disabled  id="" class="form-control">
                                        @foreach($branch as $b)
                                            <option value="{{$b->id}}" {{(!empty($employee->corporate_branchid) && $employee->corporate_branchid  == $b->id)?:""}}>{{$b->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Department<span class="text-danger">*</span></label>
                                    <select disabled  id="" class="form-control">
                                        @foreach($departements as $dep)
                                            <option value="{{$dep->id}}" {{(!empty($employee->department) && $employee->department  == $dep->id)?'selected':''}}>{{$dep->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Designation <span class="text-danger">*</span></label>
                                    <select disabled id="" class="form-control">
                                        @foreach($destination as $dest)
                                            <option value="{{$dest->id}}" {{(!empty($employee->designation) && $employee->designation  == $dest->id)?'selected':''}}>{{$dest->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Date of Birth <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <select disabled  id="empbirthdate" class="form-control mr-10">
                                            @for($x =1; $x <=31; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                        <select disabled  id="" class="form-control empbirthdate">
                                            @for($x =1; $x <=12; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                        <select disabled  id="empbirthmonth" class="form-control ml-10">
                                            @for($i =$now; $i > 1920; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Country of Residence <span class="text-danger">*</span></label>
                                    <select disabled  class="form-control">
                                        @foreach($country as $count)
                                            <option value="{{$count->id}}">{{$count->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Nationional Id <span class="text-danger">*</span></label>
                                    <input required type="text" name="employee[national_idno]"
                                           value="{{!empty($employee->national_idno) ? $employee->national_idno : '' }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Cost Center <span class="text-danger">*</span></label>
                                    <select disabled  id="" class="form-control">
                                        @foreach($costcenter as $cost)
                                            <option value="{{$cost->id}}" {{(!empty($employee->costcentreid) && $employee->costcentreid  == $cost->id)?'selected':''}} >{{$cost->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="mt-10">Cost Center(Trip Active/InActive) <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <label for="">
                                            <input type="radio"
                                                   {{!empty($employee->costenable)?'checked':''}} disabled
                                                   value="1" class="mr-20"> Enable</label>
                                        <label for="">
                                            <input type="radio" disabled
                                                   {{!empty($employee->costenable)?'':'checked'}} value="0" class="mx-4">
                                            Disable</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="credit-info mt-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="border title_sub" style="border-radius:3px; padding:10px;">
                            <div class="gen-det">
                                <h6 class="mb-0">Contact Details</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Company Email Id <span class="text-danger">*</span></label>
                                    <input type="text" disabled
                                           value="{{!empty($employee->email) ? $employee->email : '' }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Personal Email Id <span class="text-danger">*</span></label>
                                    <input type="text" disabled
                                           value="{{!empty($employee->personalemailid) ? $employee->personalemailid : '' }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Phone No <span class="text-danger">*</span></label>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 col-4 pr-10">
                                            <input type="text"  name="employee[phonecode]" value="{{!empty($employee->phonenumber) ? substr($employee->phonenumber,0,2) : '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <input type="text" name="employee[phonenumber]"
                                                   value="{{!empty($employee->phonenumber) ? substr($employee->phonenumber,2) : '' }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Mobile No Corporate <span class="text-danger">*</span></label>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 col-4 pr-10">
                                            <input type="text" name="employee[mobilecode]" value="{{!empty($employee->mobile_corporate) ? substr($employee->mobile_corporate,0,2) : '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <input type="text" name="employee[mobilenumber]"
                                                   value="{{!empty($employee->mobile_corporate) ? substr($employee->mobile_corporate,2) : '' }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Phone No Personal<span class="text-danger">*</span></label>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 col-4 pr-10">
                                            <input type="text" name="employee[personalphonecode]" value="{{!empty($employee->mobile_personal) ? substr($employee->mobile_personal,0,2) : '' }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <input type="text" name="employee[personalphonenumber]"
                                                   value="{{!empty($employee->mobile_personal) ? substr($employee->mobile_personal,2) : '' }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Emergency Contact Person</label>
                                    <input type="text" name="employee[emergency_contact]"
                                           value="{{!empty($employee->emergency_contact) ? $employee->emergency_contact : '' }}"
                                           class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Emergency Contact No <span class="text-danger">*</span></label>
                                    <div class="row no-gutters">
                                        <div class="col-md-4 col-4 pr-10">
                                            <input type="text" name="employee[emergency_contact_code]" value="{{!empty($employee->emergencycontactno) ? substr($employee->emergencycontactno,0,2) : '' }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-8 col-8">
                                            <input type="text" name="employee[emergency_contact_number]"
                                                   value="{{!empty($employee->emergencycontactno) ? substr($employee->emergencycontactno,2) : '' }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Personal Address</label>
                                    <textarea name="employee[personaladdress]" id="" cols="30" rows="2"
                                              class="form-control">{{!empty($employee->personaladdress) ? $employee->personaladdress : '' }} </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="credit-info mt-20">
                <div class="border title_sub" style="border-radius:3px; padding:10px;">

                    <div class="gen-det">
                        <h6 class="mb-0">Role & Level Details</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Travel Policy Level <span class="text-danger">*</span></label>
                            <select disabled id="" class="form-control">
                                @foreach($levels as $level)
                                    <option value="{{$level->id}}" {{(!empty($employee->policy_id) && $employee->policy_id  == $level->id)?'selected':''}}>{{$level->policyname}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Allow Personal Travel<span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <input type="radio" {{!empty($employee->allow_personal_travel) ? "checked" : "" }} disabled id="" class="mr-20">
                                <label for="">Yes</label>
                                <input type="radio" {{!empty($employee->allow_personal_travel) ? "" : "checked" }}  disabled id="" class="mx-3">
                                <label for="">No</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Employee Role<span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <input type="radio" checked  disabled {{!empty($employee->is_approver) ? "checked" : "" }} value="Approver" id="" class="mr-20">
                                <label for="">Approver</label>
                                <input type="radio" disabled{{!empty($employee->is_traveler) ? "checked" : "" }} id="" value="Traveller" class="mx-3">
                                <label for="">Traveller</label>
                                <input type="radio" disabled {{!empty($employee->is_booker) ? "checked" : "" }} value="Booker" id="" class="mx-3">
                                <label for="">Booker</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Workflow <span class="text-danger">*</span></label>
                            <select disabled  id="" class="form-control">
                                @foreach($workflows as $wf)
                                    <option value="{{$wf->id}}" {{(!empty($employee->workflow_id) && $employee->workflow_id  == $wf->id)?'selected':''}}>{{$wf->workflow_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Doctor Approver<span class="text-danger">*</span></label>
                            <select disabled  id="" class="form-control">
                                @foreach($employees_doctor as $emd)
                                    <option {{(!empty($employee->doctor_approver) && $employee->doctor_approver  == $emd->id)?'selected':''}} value="{{$emd->id}}">{{$emd->firstname.' '.$emd->lastname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            @if(!empty($employee))
                <div class="credit-info mt-20">
                    <div class="border title_sub" style="border-radius:3px; padding:10px;">
                        <div class="gen-det">
                            <h6 class="mb-0">Login Credetial</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Login Id <span class="text-danger">*</span></label>
                                <input type="text"  disabled value="{{!empty($employee->email) ? $employee->email : '' }}"
                                       class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">Password <span class="text-danger">*</span></label>
                                <input name="employee[password]" id="password" value="{{!empty($employee->password_hash)?$employee->password_hash:""}}" type="text" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">Confirm Password<span class="text-danger">*</span></label>
                                <input type="text" id="confirm_password" value="{{!empty($employee->password_hash)?$employee->password_hash:""}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="credit-info mt-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="border title_sub" style="border-radius:3px; padding:10px;">
                            <div class="gen-det">
                                <h6 class="mb-0">Status Information</h6>
                            </div>
                            <div class="w-200">
                                <div class="d-flex justify-content-between">
                                    <input checked disabled type="radio"
                                           {{!empty($employee->isActive)?'checked':''}}  value="1"
                                           name="employee[isActive]" id="">
                                    <label for="">Active</label>
                                    <input disabled type="radio"
                                           {{!empty($employee->isActive)?'':'checked'}} value="0"
                                           name="employee[isActive]" id="">
                                    <label for="">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="credit-info mt-20">
                <div class="row">
                    <div class="col-md-12">
                        <div class="border title_sub" style="border-radius:3px; padding:10px;">

                            <div class="gen-det">
                                <h6 class="mb-0">Passport Details of Traveller</h6>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="w-200">
                                        <div class="d-flex justify-content-between">
                                            <input type="radio" value="1"
                                                   {{(!empty($employee->passport_status) && $employee->passport_status == 1)?'checked':''}} name="employee[passport_status]"
                                                   id="">
                                            <label for="">Available</label>
                                            <input type="radio" value="0"
                                                   {{(!empty($employee->passport_status) && $employee->passport_status == 0)?'':'checked'}} name="employee[passport_status]"
                                                   id="">
                                            <label for="">Not Available</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Passport No</label>
                                    <input type="text" name="employee[passportno]"
                                           value="{{!empty($employee->passportno) ? $employee->passportno : '' }}"
                                           id="" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label for="">Issue Date <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <select name="employee[issueday]" id="issuebirthdate" class="form-control mr-10">
                                            @for($x =1; $x <=31; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                        <select name="employee[issuemonth]" id="issuebirthmonth"
                                                class="form-control issuebirthdate">
                                            @for($x =1; $x <=12; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                        <select name="employee[issueyear]" id="" class="form-control ml-10">
                                            @for($i =$now; $i > 1990; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Expire Date <span class="text-danger">*</span></label>
                                    <div class="d-flex">
                                        <select name="employee[expday]" id="expbirthdate" class="form-control mr-10">
                                            @for($x =1; $x <=31; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                        <select name="employee[expmonth]" id="" class="form-control expbirthdate">
                                            @for($x =1; $x <=12; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                        <select name="employee[expyears]" id="expbirthmonth" class="form-control ml-10">
                                            @for($i =$now; $i > 1990; $i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Country of Issue </label>
                                    <select name="employee[countryissue]" id="" class="form-control">
                                        @foreach($country as $count)
                                            <option value="{{$count->id}}" {{(!empty($employee->countryissue) && $employee->countryissue  == $count->id)?'selected':''}} >{{$count->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Nationality </label>
                                    <select name="employee[nationality]" id="" class="form-control">
                                        @foreach($country as $count)
                                            <option value="{{$count->id}}" {{(!empty($employee->nationality) && $employee->nationality == $count->id)?'selected':''}}>{{$count->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Preferred Meal Plan</label>
                                    <textarea name="employee[prefferred_mealplan]" id="" cols="30" rows="2"
                                              class="form-control">{{!empty($employee->prefferred_mealplan) ? $employee->prefferred_mealplan : '' }}</textarea>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Frequent Flyer No</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="parent_family">
                @foreach($family as $fm)
                    <div class="credit-info mt-20" >
                        <div class="row">
                            <button type="button" onclick="remove_div(this)" class="remove"> Remove</button>
                            <div class="col-md-12">
                                <div class="border title_sub" style="border-radius:3px; padding:10px;">

                                    <div class="gen-det">
                                        <h6 class="mb-0">Family Details</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Type <span class="text-danger">*</span></label>
                                            <select name="family[type][]" id="" class="form-control"  onchange="change_family_type(this)">
                                                <option value="adult" {{(!empty($fm->type) && $fm->type  == 'adult')?'selected':''}}>
                                                    Adult
                                                </option>
                                                <option value="child" {{(!empty($fm->type) && $fm->type  == 'child')?'selected':''}}>
                                                    Child
                                                </option>
                                                <option value="infant" {{(!empty($fm->type) && $fm->type  == 'infant')?'selected':''}}>
                                                    Infant
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Salutation <span class="text-danger">*</span></label>
                                            <select name="family[solution][]" id="" class="form-control family_types">
                                                @if(!empty($fm->type) && $fm->type  == 'adult')
                                                    <option value="mr" {{(!empty($fm->salutation) && $fm->salutation  == 'mr')?'selected':'' }}>
                                                        MR
                                                    </option>
                                                    <option value="miss" {{(!empty($fm->salutation) && $fm->salutation  == 'miss')?'selected':'' }}>
                                                        MISS
                                                    </option>
                                                    <option value="ms" {{(!empty($fm->salutation) && $fm->salutation  == 'ms')?'selected':'' }}>
                                                        MS
                                                    </option>
                                                    <option value="mrs" {{(!empty($fm->salutation) && $fm->salutation  == 'mrs')?'selected':'' }}>
                                                        MRS
                                                    </option>
                                                @else
                                                    <option value="master" {{(!empty($fm->salutation) && $fm->salutation  == 'master')?'selected':'' }}>
                                                        Master
                                                    </option>
                                                    <option value="miss" {{(!empty($fm->salutation) && $fm->salutation  == 'miss')?'selected':'' }}>
                                                        Miss
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="family[name][]"
                                                   value="{{!empty($fm->first_name) ? $fm->first_name : '' }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Middle Name</label>
                                            <input type="text" name="family[middlename][]"
                                                   value="{{!empty($fm->middle_name) ? $fm->middle_name : '' }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="family[lastname][]"
                                                   value="{{!empty($fm->last_name) ? $fm->last_name : '' }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Date of Birth <span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                                <select name="family[date][]" id="days" class="form-control mr-10">
                                                    @for($x =1; $x <=31; $x++)
                                                        <option value="{{ $x }}">{{ $x }}</option>
                                                    @endfor
                                                </select>
                                                <select name="family[month][]" id="" class="form-control days">
                                                    @for($x =1; $x <=12; $x++)
                                                        <option value="{{ $x }}">{{ $x }}</option>
                                                    @endfor
                                                </select>
                                                <select name="family[year][]" id="mymonth" class="form-control ml-10">
                                                    @for($i =$now; $i > 1990; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Relationship with Traveller <span class="text-danger">*</span></label>
                                            <select name="family[real][]" id="" class="form-control">
                                                <option value="spouse">Spouse</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Passport No </label>
                                            <input type="text" name="family[passpoet][]"
                                                   value="{{!empty($fm->passport) ? $fm->passport : '' }}"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Date of Birth <span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                                <select name="family[2day][]" id="birthdate" class="form-control mr-10">
                                                    @for($x =1; $x <=31; $x++)
                                                        <option value="{{ $x }}">{{ $x }}</option>
                                                    @endfor
                                                </select>
                                                <select name="family[2month][]" id="" class="form-control birthdate">
                                                    @for($x =1; $x <=12; $x++)
                                                        <option value="{{ $x }}">{{ $x }}</option>
                                                    @endfor
                                                </select>
                                                <select name="family[2year][]" id="birthmonth" class="form-control ml-10">
                                                    @for($i =$now; $i > 1920; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Nationality </label>
                                            <select name="family[nationality][]" id="" class="form-control">
                                                @foreach($country as $count)
                                                    <option value="{{$count->id}}" {{(!empty($fm->nationality) && $fm->nationality == $count->id)?'selected':''}}>{{$count->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Country of Issue </label>
                                            <select name="family[country][]" id="" class="form-control">
                                                @foreach($country as $count)
                                                    <option value="{{$count->id}}" {{(!empty($fm->country_id) && $fm->country_id  == $count->id)?'selected':''}}>{{$count->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Preferred Meal Plan</label>
                                            <textarea name="family[plan][]" id="" cols="30" rows="2"
                                                      class="form-control">{{!empty($fm->plan) ? $fm->plan : '' }}</textarea>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Frequent Flyer No</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Nationality Id</label>
                                            <input type="text" name="family[nationalityid][]"
                                                   value="{{!empty($fm->national_idno) ? $fm->national_idno : '' }}"
                                                   id="" class='form-control'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="append"></div>
            <div class="row justify-content-between">
                <div class="col-md-3 col-6">
                    <div class="mt-30">
                        <button type="submit" class="btn btn-danger">Save</button>
                        <button type="button" onclick="Back()" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
                <div class="col-md-3 col-6 mt-30">
                    <button type="button" class="btn btn-light btn-block" onclick="funct()"><i
                                class="fas fa-plus-circle text-danger"></i>Add More Family Details
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')

    <script>
        $('#submit_form').on('submit', function (event) {

                    @if(!empty($employee->id))
            var url = '{{url('corporate/profile/update')}}';
                    @else
            var url = '{{url('corporate/profile')}}';
                    @endif
            var data = $("#submit_form").serialize();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (data) {
                    if(data.status)
                    {
                        window.location.href = '{{url('corporate/profile')}}'
                    }else {
                        alert(data.message)
                    }
                },
                error: function () {
                }
            });
        });

        function Back() {
            window.history.back();
        }

        var getDaysInMonth = function (month, year) {
            return new Date(year, month, 0).getDate();
        };

        $("select.days").change(function () {
            var selecteddays = $(this).children("option:selected").val();
            var selectedmonth = $("#mymonth option:selected").val();
            $("#days").empty();
            for (var i = 1; i <= getDaysInMonth(selecteddays, selectedmonth); i++) {
                $("#days").append('<option value="' + i + '" >' + i + '</option>');
            }
        });
        $("select.birthdate").change(function () {
            var selecteddays = $(this).children("option:selected").val();
            var selectedmonth = $("#birthmonth option:selected").val();
            $("#birthdate").empty();
            for (var i = 1; i <= getDaysInMonth(selecteddays, selectedmonth); i++) {
                $("#birthdate").append('<option value="' + i + '" >' + i + '</option>');
            }
        });
        $("select.empbirthdate").change(function () {
            var selecteddays = $(this).children("option:selected").val();
            var selectedmonth = $("#empbirthmonth option:selected").val();
            $("#empbirthdate").empty();
            for (var i = 1; i <= getDaysInMonth(selecteddays, selectedmonth); i++) {
                $("#empbirthdate").append('<option value="' + i + '" >' + i + '</option>');
            }
        });
        $("select.expbirthdate").change(function () {
            var selecteddays = $(this).children("option:selected").val();
            var selectedmonth = $("#expbirthmonth option:selected").val();
            $("#expbirthdate").empty();
            for (var i = 1; i <= getDaysInMonth(selecteddays, selectedmonth); i++) {
                $("#expbirthdate").append('<option value="' + i + '" >' + i + '</option>');
            }
        });
        $("select.issuebirthdate").change(function () {
            var selecteddays = $(this).children("option:selected").val();
            var selectedmonth = $("#issuebirthmonth option:selected").val();
            $("#issuebirthdate").empty();
            for (var i = 1; i <= getDaysInMonth(selecteddays, selectedmonth); i++) {
                $("#issuebirthdate").append('<option value="' + i + '" >' + i + '</option>');
            }
        });

        function funct() {
            $("#parent_family").append('  <div class="credit-info mt-20"  >\n' +
                '                    <div class="row">\n' +
                '                            <button type="button" onclick="remove_div(this)" class="remove"> Remove</button>\n' +
                '                        <div class="col-md-12">\n' +
                '                            <div class="gen-det">\n' +
                '                                <h6 class="mb-0">Family Details</h6>\n' +
                '                            </div>\n' +
                '                            <div class="row">\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Type <span class="text-danger">*</span></label>\n' +
                '                                    <select name="family[type][]" id="" onchange="change_family_type(this)" class="form-control">\n' +
                '                                        <option value="adult"> Adult </option>\n' +
                '                                        <option value="child"> Child </option>\n' +
                '                                        <option value="infant"> Infant </option>\n' +
                '                                    </select>\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Salutation <span class="text-danger">*</span></label>\n' +
                '                                    <select name="family[solution][]" id="" class="form-control">\n' +
                '<option value="mr" > MR </option>\n' +
                '                <option value="miss" >  MISS </option>\n' +
                '                <option value="ms"> MS </option>\n' +
                '                <option value="mrs" > MRS </option>\n' +

                '                                    </select>\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <div class="w-200">\n' +
                '                                        <label for="">Is Active</label>\n' +
                '                                        <div class="d-flex justify-content-between">\n' +
                '                                            <input checked type="radio" name="family[available][]"\n' +
                '                                                   value=\'1\' id="">\n' +
                '                                            <label for="">Available</label>\n' +
                '                                            <input type="radio" name="family[available][]"\n' +
                '                                                   value="0" id="">\n' +
                '                                            <label for="">Not Available</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="row">\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">First Name <span class="text-danger">*</span></label>\n' +
                '                                    <input type="text" name="family[name][]"\n' +
                '                                           value=""\n' +
                '                                           class="form-control">\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Middle Name</label>\n' +
                '                                    <input type="text" name="family[middlename][]"\n' +
                '                                           value=""\n' +
                '                                           class="form-control">\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Last Name <span class="text-danger">*</span></label>\n' +
                '                                    <input type="text" name="family[lastname][]"\n' +
                '                                           value=""\n' +
                '                                           class="form-control">\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Date of Birth <span class="text-danger">*</span></label>\n' +
                '                                    <div class="d-flex">\n' +
                '                                        <select name="family[date][]" id="days" class="form-control mr-10">\n' +
                '                                            @for($x =1; $x <=31; $x++)\n' +
                '                                                <option value="{{ $x }}">{{ $x }}</option>\n' +
                '                                            @endfor\n' +
                '                                        </select>\n' +
                '                                        <select name="family[month][]" id="" class="form-control days">\n' +
                '                                            @for($x =1; $x <=12; $x++)\n' +
                '                                                <option value="{{ $x }}">{{ $x }}</option>\n' +
                '                                            @endfor\n' +
                '                                        </select>\n' +
                '                                        <select name="family[year][]" id="mymonth" class="form-control ml-10">\n' +
                '                                            @for($i =$now; $i > 1990; $i--)\n' +
                '                                                <option value="{{ $i }}">{{ $i }}</option>\n' +
                '                                            @endfor\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="row">\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Relationship with Traveller <span class="text-danger">*</span></label>\n' +
                '                                    <select name="family[real][]" id="" class="form-control">\n' +
                '                                        <option value="spouse">Spouse</option>\n' +
                '                                    </select>\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Passport No </label>\n' +
                '                                    <input type="text" name="family[passpoet][]"\n' +
                '                                           value=""\n' +
                '                                           class="form-control">\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Date of Birth <span class="text-danger">*</span></label>\n' +
                '                                    <div class="d-flex">\n' +
                '                                        <select name="family[2day][]" id="birthdate" class="form-control mr-10">\n' +
                '                                            @for($x =1; $x <=31; $x++)\n' +
                '                                                <option value="{{ $x }}">{{ $x }}</option>\n' +
                '                                            @endfor\n' +
                '                                        </select>\n' +
                '                                        <select name="family[2month][]" id="" class="form-control birthdate">\n' +
                '                                            @for($x =1; $x <=12; $x++)\n' +
                '                                                <option value="{{ $x }}">{{ $x }}</option>\n' +
                '                                            @endfor\n' +
                '                                        </select>\n' +
                '                                        <select name="family[2year][]" id="birthmonth" class="form-control ml-10">\n' +
                '                                            @for($i =$now; $i > 1920; $i--)\n' +
                '                                                <option value="{{ $i }}">{{ $i }}</option>\n' +
                '                                            @endfor\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Nationality </label>\n' +
                '                                    <select name="family[nationality][]" id="" class="form-control">\n' +
                '                                        @foreach($country as $count)\n' +
                '                                            <option value="{{ $count->id}}">{{$count->name}}</option>\n' +
                '                                        @endforeach\n' +
                '                                    </select>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div class="row">\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Country of Issue </label>\n' +
                '                                    <select name="family[country][]" id="" class="form-control">\n' +
                '                                        @foreach($country as $count)\n' +
                '                                            <option value="{{$count->id}}">{{$count->name}}</option>\n' +
                '                                        @endforeach\n' +
                '                                    </select>\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Preferred Meal Plan</label>\n' +
                '                                    <textarea name="family[plan][]" id="" cols="30" rows="2"\n' +
                '                                              class="form-control"></textarea>\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Frequent Flyer No</label>\n' +
                '                                    <input type="text" class="form-control">\n' +
                '                                </div>\n' +
                '                                <div class="col-md-3">\n' +
                '                                    <label for="">Nationality Id</label>\n' +
                '                                    <input type="text" name="family[nationalityid][]"\n' +
                '                                           value=""\n' +
                '                                           id="" class=\'form-control\'>\n' +
                '                                </div>\n' +
                '\n' +
                '                            </div>\n' +
                '                        </div>\n' +
                '                    </div>\n' +
                '                </div> ');

        }

        function remove_div(e) {
            $(e).remove()
        }

        function change_family_type(type) {
            var select = $(type).closest("div").next().find("select");
            var selected_value = $(type).children("option:selected").val();
            if(selected_value == "adult")
            {
                select.find('option').remove().end()
                    .append('<option value="mr">Mr</option>')
                    .append('<option value="mrs">Mr</option>')
                    .append('<option value="mrs">Mrs</option>')
                    .append('<option value="ms">Ms</option>')
            }else{
                select.find('option').remove().end()
                    .append('<option value="master">Master</option>')
                    .append('<option value="miss">Miss</option>')
            }

        }

    </script>
@endpush

