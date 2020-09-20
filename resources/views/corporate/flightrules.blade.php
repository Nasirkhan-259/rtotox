@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="credit-info mb-20">
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('corporate/flightrules/add')}}" class="btn btn-danger">Add Rule</a>
                                <table class="table table-bordered mt-10 bg-light table-responsive-sm ">
                                    <thead>
                                    <tr class="bg-dark">
                                        <th scope="col" class="text-white">Rule Name</th>
                                        <th scope="col" class="text-white">Status</th>
                                        <th scope="col" class="text-white">Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{!empty($item->is_active) ? "No" : "Yes" }}</td>
                                        <td class="text-center"><a href="{{url('corporate/flightrules/edit/'.$item->id)}}" ><img src="{{asset('images/edit.svg')}}" alt="" width="24"></a></td>
                                    </tr>
                                     @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
        <!-- SCROLL TO TOP -->
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
                    window.location.href = '{{url('corporate/flightrules')}}'
                },
                error: function(){
                }
            });
        });

    </script>

@endpush
