@extends('layouts.corporate_admin')

@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="desig-info">
                    <h3 class="border-bottom pb-10">Costcenter Information</h3>
                    <form method="post" id="submit_form" >
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Costcenter Name</label>
                                <input name="name" required type="text" value="{{!empty($costcenter->name) ? $costcenter->name : '' }}" class="form-control">
                                <input name="id"  required type="hidden" value="{{!empty($costcenter->id) ? $costcenter->id : '' }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Description</label>
                                <textarea name="desciption"   class="form-control" id="" cols="30" rows="5"> {{!empty($costcenter->desciption) ? $costcenter->desciption : '' }} </textarea>
                            </div>
                        </div>
                        <h3 class="border-bottom pb-10">Status Information</h3>
                        <div class="form-group col-md-4 px-0">
                            <div class="d-flex justify-content-between">
                                <strong>Is Active</strong>
                                <label for="">
                                    <input  checked class="" name="is_active" {{!empty($costcenter->is_active) ? 'checked' : '' }}  value="1" checked type="radio" id="gridCheck">
                                    Active
                                </label>
                                <label for="">
                                    <input class="" name="is_active" value="0" {{ !empty($employee) && empty($costcenter->is_active) ? 'checked' : '' }} type="radio" id="gridCheck">
                                    Inactive
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" onclick="Back()" class="btn btn-primary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')

    <script>
 $('#submit_form').on('submit',function(event){

            @if(!empty($costcenter->id))
            var url = '{{url('corporate/costcenter/update')}}';
            @else
            var url = '{{url('corporate/costcenter/add')}}';
            @endif

            var data = $("#submit_form").serialize();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function(data) {
                    window.location.href = '{{url('corporate/costcenter')}}'
                    },
                error: function(){
                }
            });
        });
 function Back() {
            window.history.back();
        }

    </script>
@endpush

