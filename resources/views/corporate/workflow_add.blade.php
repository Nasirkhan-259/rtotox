@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="desig-info">
                    <h3 class="border-bottom pb-10">Workflow Information</h3>
                    <form id="submit_form" action="">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="" style="flex:1;">Workflow Name:</label>
                                <input type="text" value='{{!empty($workflow->workflow_name) ? $workflow->workflow_name : ""}}' name="workflow_name" required class="form-control" style="flex:2; background:rgb(232, 240, 254)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped mt-10 table-responsive-sm">
                                    <thead>
                                    <tr class="bg-blue">
                                        <th scope="col" class="text-white text-center">Sr No</th>
                                        <th scope="col" class="text-white text-center">Group Name</th>
                                        <th scope="col" class="text-white text-center">Sequence No</th>
                                        <th scope="col" class="text-white text-center">Select</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($approvers as $index=>$approver)
                                    <tr>
                                        <td class="text-center">{{$index+1}}</td>
                                        <td class="text-center">{{$approver->approver_name}}</td>
                                        <td class="text-center"><input type="number" min="1" max="5" name="sequence_number{{$approver->id}}" id="sequence_number{{$approver->id}}" value="{{!empty($approvers_ids_sequence[$approver->id])  ?$approvers_ids_sequence[$approver->id]:"" }}" data-index="{{$index}}"   class="form-control w-200 mx-auto sequence_number"></td>
                                        <td class="text-center"><input type="checkbox" {{in_array($approver->id , $approvers_ids) ? "checked" : "" }}  value="{{$approver->id}}" name="select_value[]" id=""></td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h3 class="border-bottom pb-10">Status Information</h3>
                        <input type="hidden" name="id" value="{{!empty($workflow->id) ? $workflow->id : "" }}">

                        <div class="form-group col-md-4 px-0">
                            <div class="d-flex justify-content-between">
                                <strong>Is Active</strong>
                                <label for="">
                                    <input checked id class="" {{!empty($workflow->is_active) ? "checked" : "" }} name="is_active"  value="1" type="radio" id="active_check">
                                    Active
                                </label>
                                <label for="">
                                    <input class="" {{ !empty($workflow) && empty($workflow->is_active) ? "checked" : "" }} name="is_active" value="0" type="radio" id="active_check">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="submit" class="btn btn-primary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
    <script>

        $("input[type=checkbox]" ).on('change', function() {

            if (this.checked) {
                var value = $(this).val();
                $("#sequence_number"+value).prop('required','true');
            }else{
                var value = $(this).val();
                $("#sequence_number"+value).removeAttr('required');
            }
        });

        $('#submit_form').on('submit', function (event) {

                    @if(!empty($workflow->id))
            var url = '{{url('corporate/workflow/update')}}';
                    @else
            var url = '{{url('corporate/workflow/add')}}';
                    @endif


            var data = $("#submit_form").serialize();

            event.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (data) {
                    window.location.href = '{{url('corporate/workflow')}}'
                },
                error: function () {
                }
            });
        });
    </script>

@endpush
