@extends('layouts.corporate_admin')
@section('content')

<div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="department-box ">
                    <a href="{{url('corporate/destination/add')}}" class ="btn btn-primary">Add Designation</a>
                    <table class="table table-bordered table-striped mt-10 table-responsive">
                        <thead>
                        <tr class="bg-dark">
                            <th scope="col">
                                <input name="" class="select-table" value="Department Name" id=""/>
                            </th>
                            <th scope="col" class="text-white">Active</th>
                            <th scope="col" class="text-white">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($destination as $des)
                            <tr>
                            <td>{{$des->name}}</td>
                            <td>{{$des->is_active ? "Yes" : "NO" }}</td>
                            <td class="text-center"><a href="{{url('corporate/destination/edit/'.$des->id)}}"><img  src="{{asset('images/edit.svg')}}" alt="" width="24"></a></td>
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
