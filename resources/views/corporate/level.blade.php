@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="department-box ">
                    <a href="{{url('corporate/policy/add')}}" class ="btn btn-primary">Add Level</a>
                    <table class="table table-bordered table-striped mt-10 table-responsive">
                        <thead>
                        <tr class="bg-dark">
                            <th scope="col">
                                <input value="Level Name" name="" class="select-table" id=""/>
                            </th>
                            <th scope="col" class="text-white">Status</th>
                            <th scope="col" class="text-white">Policy Setup</th>
                            <th scope="col" class="text-white">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($levels as $level)
                        <tr>
                            <td>{{$level->policyname}}</td>
                            <td>{{$level->is_active ? "Yes" : "NO" }}</td>
                            <td><a href="{{url('corporate/policy/setup/'.$level->id)}}" >Setup</a></td>
                            <td class="text-center"><a href="{{url('corporate/policy/edit/'.$level->id)}}" ><img src="{{asset('images/edit.svg')}}" alt="" width="24"></a></td>
                        </tr>
                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
