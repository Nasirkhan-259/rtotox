@extends('layouts.corporate_admin')

@section('content')

    <div class="container my-4">

        <div class="row">
            <div class="col-md-12">
                <div class="desig-info">
                    <form method="post" id="submit_form">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="border-bottom pb-10">Corporate Email Information</h3>
                                <div class="form-group">
                                    <label for="">Branch</label>
                                    <select name="branch_id" id="" class="form-control">
                                        @foreach($branchname as $br)
                                            <option value="{{$br->id}}" {{!empty($branchmail->branch_id) && $branchmail->branch_id == $br->id ?'selected':''}}>{{$br->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="">Corporate Email</label>
                                <input type="text" required name="email_id" id=""
                                       value="{{!empty($branchmail->email_id) ? $branchmail->email_id :''}}"
                                       class="form-control">
                                <input type="hidden" name="id" id=""
                                       value="{{!empty($branchmail->id) ? $branchmail->id :''}}" class="form-control">

                                <div class="form-group col-md-5 col-6 px-0 mt-10 mb-30">
                                    <strong>Status</strong>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <label for="">
                                            <input checked class=""
                                                   {{!empty($branchmail->is_active) ? 'checked' : '' }}  name="is_active"
                                                   value="1" type="radio" id="gridCheck">
                                            Active
                                        </label>
                                        <label for="">
                                            <input class="" name="is_active"
                                                   {{ !empty($branchmail) && empty($branchmail->is_active) ? 'checked' : '' }} value="0"
                                                   type="radio" id="gridCheck">
                                            Inactive
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button onclick="Back()" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </form>


@endsection
@push('scripts')

    <script>
        $('#submit_form').on('submit', function (event) {
            event.preventDefault();

                    @if(!empty($branchmail->id))
            var url = '{{url('corporate/branchemail/update')}}';
                    @else
            var url = '{{url('corporate/branchemail/add')}}';
                    @endif

            var data = $("#submit_form").serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (data) {
                    window.location.href = '{{url('corporate/branchemail')}}'
                },
                error: function () {
                }
            });
        });

        function Back() {
            window.history.back();
        }

    </script>
@endpush

