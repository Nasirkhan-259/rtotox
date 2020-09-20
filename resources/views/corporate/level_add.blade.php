@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
    <div class="row">
        <div class="col-md-12">
            <div class="desig-info">
                <h3 class="border-bottom pb-10">Level Master</h3>
                <form id="submit_form"  method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Lavel Name</label>
                            <input value="{{!empty($level->policyname) ? $level->policyname : '' }}" name="policyname" type="text" class="form-control">
                            <input name="id"  required type="hidden" value="{{!empty($level->id) ? $level->id : '' }}" class="form-control">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Description</label>
                            <textarea  name="description" class="form-control" id="" cols="30" rows="5">{{!empty($level->description) ? $level->description : '' }}</textarea>
                        </div>
                    </div>
                    <h3 class="border-bottom pb-10">Status Information</h3>
                    <div class="form-group col-md-4 px-0">
                        <div class="d-flex justify-content-between">
                            <strong>Is Active</strong>
                            <label for="">
                                <input checked  class="" name="is_active" {{!empty($level->is_active) ? 'checked' : '' }}  value="1" checked type="radio" id="gridCheck">
                                Active
                            </label>
                            <label for="">
                                <input class="" name="is_active" value="0" {{!empty($level) && empty($level->is_active) ? 'checked' : '' }} type="radio" id="gridCheck">
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
        $('#submit_form').on('submit',function(event){

                    @if(!empty($level->id))
            var url = '{{url('corporate/policy/update')}}';
                    @else
            var url = '{{url('corporate/policy/add')}}';
                    @endif

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

    </script>

@endpush
