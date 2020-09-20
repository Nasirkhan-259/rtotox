@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div class="department-box ">
                    <a href="{{url('corporate/workflow/add')}}" class ="btn btn-primary">Add Workflow</a>
                    <table class="table table-bordered table-striped mt-10 table-responsive">
                        <thead>
                        <tr class="bg-dark">
                            <th scope="col" class="text-white">Sr No</th>
                            <th scope="col" class="text-white">Workflow Name</th>
                            <th scope="col" class="text-white">Status</th>
                            <th scope="col" class="text-white">Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workflow as $index=>$work)
                            <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$work->workflow_name}}</td>
                            <td>{{!empty($work->is_active ) ? "Yes": "NO"}}</td>
                            <td class="text-center"><a href="{{url('corporate/workflow/edit/'.$work->id)}}" ><img src="{{asset('images/edit.svg')}}" alt="" width="24"></a></td>
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
