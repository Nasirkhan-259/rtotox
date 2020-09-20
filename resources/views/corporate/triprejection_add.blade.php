@extends('layouts.corporate_admin')

@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="desig-info">
                    <form method="post" id="submit_form" >
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="border-bottom pb-10">Rejection Master</h3>
                                <div class="form-group">
                                    <label for="">Rejection Name</label>
                                    <input type="text" value="{{!empty($triprejection->tripreject) ? $triprejection->tripreject :'' }}"name="tripreject" id="" class="form-control">
                                    <input name="id"  required type="hidden" value="{{!empty($triprejection->id) ? $triprejection->id : '' }}" class="form-control">
                                </div>
                                <label for="">Description</label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{!empty($triprejection->description) ? $triprejection->description :'' }}</textarea>

                                <div class="form-group col-md-5 col-6 px-0 mt-10 mb-30">
                                    <strong>Status</strong>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <label for="">
                                            <input checked name="is_active" {{!empty($triprejection->is_active) ? 'checked' : '' }}  value="1" type="radio" id="gridCheck">
                                            Active
                                        </label>
                                        <label for="">
                                            <input class="" {{ !empty($triprejection) && empty($triprejection->is_active) ? 'checked' : '' }} name="is_active" value="0" type="radio" id="gridCheck">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="submit" onclick="Back()" class="btn btn-primary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


@endsection
@push('scripts')

    <script>
 $('#submit_form').on('submit',function(event){

            @if(!empty($triprejection->id))
            var url = '{{url('corporate/triprejection/update')}}';
            @else
            var url = '{{url('corporate/triprejection/add')}}';
            @endif

            var data = $("#submit_form").serialize();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function(data) {
                    window.location.href = '{{url('corporate/triprejection')}}'
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

