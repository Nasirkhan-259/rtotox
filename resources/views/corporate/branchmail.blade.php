@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="credit-info mb-20">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select name="" id="" class="form-control">
                                    <option value="">--Select Branch--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="" id="" class="form-control">
                                    <option value="">Select Status</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">&nbsp</label>
                            <button class="btn btn-danger">Search</button>
                            <a href="{{url(('corporate/branchemail/add'))}}"class="btn btn-danger">Add Branch</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered mt-10 bg-light table-responsive-sm table-responsive">
                                <thead>
                                <tr class="bg-dark">
                                    <th scope="col" class="text-white">Sr No</th>
                                    <th scope="col" class="text-white">Branch Name</th>
                                    <th scope="col" class="text-white">Emailld</th>
                                    <th scope="col" class="text-white">Status</th>
                                    <th scope="col" class="text-white">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($branch as $brh)
                                <tr>
                                    <td>{{$brh->id}}</td>
                                    <td>{{$brh->branch_name}}</td>
                                    <td>{{$brh->email_id}}</td>
                                    <td>{{$brh->is_active ? "Yes" : "NO" }}</td>
                                    <td class="text-center"><a href="{{url('corporate/branchemail/edit/'.$brh->id)}}">Edit</a></td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
@endpush
