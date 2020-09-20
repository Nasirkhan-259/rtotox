@extends('layouts.corporate_admin')
@section('content')

<div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="department-box ">
                    <a href="{{url('corporate/costcenter/add')}}" class ="btn btn-primary">Add Cost Centre</a>
                    <table class="table table-bordered table-striped mt-10 table-responsive">
                        <thead>
                        <tr class="bg-dark">
                            <th scope="col">
                                <input name="" class="select-table" value="Cost Centre" id=""/>
                            </th>
                            <th scope="col" class="text-white">Active</th>
                            <th scope="col" class="text-white">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($costcenter as $cost)
                            <tr>
                            <td>{{$cost->name}}</td>
                            <td>{{$cost->is_active ? "Yes" : "NO" }}</td>
                            <td class="text-center"><a href="{{url('corporate/costcenter/edit/'.$cost->id)}}"><img  src="{{asset('images/edit.svg')}}" alt="" width="24"></a></td>
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
