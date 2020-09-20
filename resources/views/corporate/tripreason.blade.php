@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="credit-info mb-20">
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('corporate/tripreason/add')}}" class="btn btn-danger">Add Reason</a>
                                <table class="table table-bordered mt-10 bg-light table-responsive-sm ">
                                    <thead>
                                    <tr class="bg-dark">
                                        <th scope="col" class="text-white"><input name="" value="Reason Name" class="select-table"/></th>

                                        <th scope="col" class="text-white">Status</th>
                                        <th scope="col" class="text-white">Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($triprea as $trip)
                                    <tr>
                                        <td>{{$trip->tripreason}}</td>
                                        <td>{{$trip->is_active ? "Yes" : "NO" }}</td>
                                        <td class="text-center"><a href="{{url('corporate/tripreason/edit/'.$trip->id)}}">Edit</a> </td>
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

@endsection
@push('scripts')
@endpush
