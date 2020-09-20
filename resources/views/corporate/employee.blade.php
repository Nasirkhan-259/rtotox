@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="credit-info">
                        <form action="{{url('corporate/employee/filter')}}" method="GET" >
                            <a href="{{url('corporate/employee/add')}}" class="btn btn-danger">Add Employee</a>
                            <div class="row mt-10">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Employee Name</label>
                                        <select id="EmployeeSelect2" name="EmployeeName" type="text" class="form-control" placeholder="Please enter Employee Name.."></select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Branch</label>
                                        <select  name="Branch" id="" class="form-control">
                                            @foreach($branches as $b)
                                                <option value="">--Select Branch--</option>
                                                <option {{(!empty($Branch) && $b->id == $Branch ? "selected" : "" )}}  value="{{$b->id}}" >{{$b->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select name="Department" id="" class="form-control">
                                            <option value="">--Select Department--</option>
                                            @foreach($departements as $b)
                                                <option {{(!empty($Department) && $b->id == $Department ? "selected" : "" )}} value="{{$b->id}}" >{{$b->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-10">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Level</label>
                                        <select name="Level" id="" class="form-control">
                                            <option value="">--Select Level--</option>
                                            @foreach($levels as $b)
                                                <option {{(!empty($Level) && $b->id == $Level ? "selected" : "" )}} value="{{$b->id}}" >{{$b->policyname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Employee Type</label>
                                        <select name="EmployeeType" id="" class="form-control">
                                            <option value="">--Select Type--</option>
                                            <option {{(!empty($EmployeeType) && $EmployeeType == "is_apporver" ? "selected" : "" )}} value="is_apporver">Approver</option>
                                            <option {{(!empty($EmployeeType) && $EmployeeType == "is_booker" ? "selected" : "" )}}  value="is_booker">Booker</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" style="padding-bottom:25px"></label>
                                        <button type="submit" class="btn btn-danger">Search</button>
                                        <a href="{{url('corporate/employee')}}"  class="btn btn-danger">Reset</a>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                                <div class="col-md-12">
                                    <div class="employee-box">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item"><a class="page-link" href="#">First</a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">Last</a></li>
                                            </ul>
                                        </nav>
                                        <table class="table table-bordered mt-10  font-size-6 table-responsive">
                                            <thead>
                                            <tr class="bg-dark">
                                                <th scope="col" class="text-white">No
                                                </th>
                                                <th scope="col" class="text-white">Employee Name

                                                </th>
                                                <th scope="col" class="text-white">Branch
                                                </th>
                                                <th scope="col" class="text-white">Department
                                                </th>
                                                <th scope="col" class="text-white">Designation
                                                </th>
                                                <th scope="col" class="text-white">Approver</th>
                                                <th scope="col" class="text-white">Traveller</th>
                                                <th scope="col" class="text-white">Booker</th>
                                                <th scope="col" class="text-white">Status</th>
                                                <th scope="col" class="text-white">Edit</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($employee as $index=>$emp)
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td>{{$emp->firstname}}</td>
                                                <td>{{$emp->branch_name}}</td>
                                                <td>{{$emp->dept_name}}</td>
                                                <td>{{$emp->designation_name}}</td>
                                                <td>{{!empty($emp->is_approver) ? "Yes" : "No" }}</td>
                                                <td>{{!empty($emp->is_traveler) ? "Yes" : "No" }}</td>
                                                <td>{{!empty($emp->is_booker) ? "Yes" : "No" }}</td>
                                                <td>{{!empty($emp->isActive) ? "Yes" : "No" }}</td>
                                                <td class="text-center"><a href="{{url('corporate/employee/edit/'.$emp->id)}}">Edit</a></td>
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
    </div>

@endsection
@push('scripts')

    <script>

        $('[id=EmployeeSelect2]').select2(
            {
                placeholder: "Choose tags...",
                minimumInputLength: 3,
                ajax: {
                    url: '{{url("corporate/employee/search_name")}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        var result = [];
                        data.forEach(function (dataObj) {
                            result.push({
                                id: dataObj.id,
                                text: dataObj.firstname +", "+ dataObj.lastname
                            })
                        });
                        return {
                            results: result
                        };
                    },
                    cache: true
                }
            }
        );
    </script>
@endpush
