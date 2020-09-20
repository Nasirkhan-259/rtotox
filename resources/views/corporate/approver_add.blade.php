@extends('layouts.corporate_admin')
@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="desig-info">
                    <h3 class="border-bottom pb-10">Group Information</h3>
                    <form method="post" id="submit_form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Group Name</label>
                                <input required name="approver_name" value="{{!empty($approver_group->approver_name) ? $approver_group->approver_name : "" }}" type="text" class="form-control" placeholder="Second-Approver">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Select Approver Name</label>
                                <div class="credit-info mb-20 p-5 services">
                                    <select id="select" name="select_value[]" class="form-control" multiple="multiple">
                                        @foreach($approvers as $approver)
                                        <option  {{ !empty($employee_ids) && in_array($approver->id,$employee_ids) ? "selected" : "" }} value="{{$approver->id}}">{{$approver->firstname . " ".$approver->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                OR
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{!empty($approver_group->id) ? $approver_group->id : "" }}">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="d-inline-block">
                                    <input  {{!empty($approver_group->all_approved) ? "checked" : "" }} type="checkbox" name="all_approved" id="all_approved" class="mr-10">
                                    All Approval
                                </label>
                                <span>(This Will be all all users From Employee Master where you select as Approvel)</span>
                            </div>
                        </div>
                        <h3 class="border-bottom pb-10">Status Information</h3>
                        <div class="form-group col-md-4 px-0">
                            <div class="d-flex justify-content-between">
                                <strong>Is Active:</strong>
                                <label for="">
                                    <input checked id class="" {{!empty($approver_group->is_active) ? "checked" : "" }} name="is_active"  value="1" type="radio" id="active_check">
                                    Active
                                </label>
                                <label for="">
                                    <input class="" {{!empty($approver_group) && empty($approver_group->is_active) ? "checked" : "" }} name="is_active" value="0" type="radio" id="active_check">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button onclick="Back()" class="btn btn-primary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        if($("#all_approved").is(":checked")) {
            $("#select").prop('disabled', true);
        }else{
            $("#select").prop('disabled', false);
        }
        $("#all_approved").change(function() {
            if(this.checked) {
                $("#select").prop('disabled', true);
            }else{
                $("#select").prop('disabled', false);
            }
        });
        $("#select").select2();
        $('#submit_form').on('submit', function (event) {
            event.preventDefault();
            if(($("#select").val().length == 0) && !$("#all_approved").is(":checked") ) {
                alert('Please select approver names');
            }else{

                @if(!empty($approver_group->id))
                var url = '{{url('corporate/approver/update')}}';
                        @else
                var url = '{{url('corporate/approver/add')}}';
                        @endif
                var data = $("#submit_form").serialize();
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        window.location.href = '{{url('corporate/approver')}}'
                    },
                    error: function () {
                    }
                });
            }

        });
    </script>
@endpush
