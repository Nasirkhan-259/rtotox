@extends('layouts.corporate_admin')
@section('content')

    <div class="container my-4">
        <form id="submit_form" action="">
            {{csrf_field()}}
        <div class="row">
            <div class="col-md-12">
                <div  class="desig-info mb-30">
                        <div id="parent_div">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Rule Name</label>
                                    <input value="{{!empty($flight_rule->name) ?$flight_rule->name:""  }}" required type="text" name="rule_name" id="" class="form-control">
                                    <input value="{{!empty($flight_rule->id) ?$flight_rule->id:""  }}" hidden type="text" name="id" id="" class="form-control">
                                </div>
                                <div class="form-group col-md-5 col-6 px-0 mt-10 mb-30">
                                    <strong>Status</strong>
                                    <br>
                                    <div class="d-flex justify-content-between">
                                        <label for="">
                                            <input checked  class="" {{!empty($flight_rule->is_active) ? 'checked' : '' }}  name="is_active"  value="0" type="radio" id="gridCheck"> Active
                                        </label>
                                        <label for="">
                                            <input  class="" name="is_active" {{ !empty($flight_rule)  && empty($flight_rule->is_active) ? 'checked' : '' }} value="1" type="radio" id="gridCheck"> Inactive
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                         @foreach($flight_rule_details as $index=>$detail)
                        <div class="desig-info">
                            <div class="alert alert-secondary alert-dismissible fade show " role="alert">
                                {{$index+1}}
                                <button onclick="remove_parent(this)" type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Origin</label>
                                            <select  name="segment_{{$index}}_[origin]"  id="origin_{{$index}}" class="form-control"></select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Destination</label>
                                            <select  name="segment_{{$index}}_[destination]"  id="destination_{{$index}}" class="form-control"></select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @foreach($detail->flightrules as $index_flight=>$flight_rule)
                            <div id="main_airline_div_{{$index}}"  class="row">
                                <div id="airline_div_0_0" class="col-md-10 airline_div">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="">Airlines</label>
                                            <select type="text" id="airlines_{{$index_flight}}_{{$index}}" name="segment_{{$index}}_[airlines][]" class="form-control"  ></select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="">Class Of Serivce</label>
                                            <select   name="segment_{{$index}}_[class_of_services_{{$index_flight}}][]" class="form-control " id="select_multi_{{$index}}_{{$index_flight}}" multiple="multiple">
                                                <option value="all">All</option>
                                                @foreach(range('A', 'Z') as $item)
                                                <option {{(in_array($item,json_decode(!empty($flight_rule->class_of_service) ? $flight_rule->class_of_service : "[]" ))?"selected":"")}} value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button {{($index_flight > 0) ? "" : "hidden" }}   onclick="remove_airline(this)" type="button" class="">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <button onclick="CloneAirlineDiv({{$index}})" type="button" class="">+</button>
                        </div>
                        @endforeach

                        </div>
                        <button type="button" onclick="ParenClickClone()" class="btn btn-danger mt-20">Add Mores</button>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" onclick="Back()" class="btn btn-primary">Cancel</button>

            </div>
        </div>
        </form>

    </div>
        <!-- SCROLL TO TOP -->
@endsection
@push('scripts')


    <script>
        var main_index = 0;
        var clone_index = 0;
        @foreach($flight_rule_details as $index=>$detail)
            main_index = {{$index}};
            select_from(main_index,'{{!empty($detail->origin) ? $detail->origin : "" }}');
            select_to(main_index,'{{!empty($detail->destination) ? $detail->destination : ""}}');
            @foreach($detail->flightrules as $index_flight=>$flight_rule)
                clone_index = {{$index_flight}};
                 select2_airlines(clone_index,main_index,'{{!empty($flight_rule->airline_id) ? $flight_rule->airline_id : "" }}','{{!empty($flight_rule->name) ? $flight_rule->name : "" }}');
                select2_class(main_index,clone_index);
            @endforeach

        @endforeach

        // function CloneAirlineDiv(mI){
        //     clone_index = clone_index +1;
        //
        //     //AirLinde Div Code
        //     $('#airlines_0_0').select2("destroy");
        //     $('#select_multi_0_0').select2("destroy");
        //
        //     var cloneDiv = $("#airline_div_0_0").clone(true);
        //     select2_airlines(0,0);
        //     select2_class(0,0);
        //
        //     cloneDiv.attr("id","airline_div_"+clone_index+"_"+mI);
        //     cloneDiv.children().find("select")[0].id = "airlines_"+clone_index+"_"+mI;
        //     cloneDiv.children().find("button")[0].hidden = false;
        //
        //
        //     //AirLinde Div Code
        //     cloneDiv.children().find("select")[1].id = "select_multi_"+clone_index+"_"+mI;
        //     cloneDiv.children().find("select")[0].options.remove(0);
        //
        //
        //     $("#main_airline_div_"+mI).append(cloneDiv);
        //
        //     $("#select_multi_"+clone_index+"_"+mI).prop('selectedIndex', -1);
        //     $("#select_multi_"+clone_index+"_"+mI).attr('name', "segment_"+mI+"_[class_of_services_"+clone_index+"][]");
        //
        //     select2_airlines(clone_index,mI);
        //     select2_class(clone_index,mI)
        // }
        function CloneAirlineDiv(mI){
            clone_index = clone_index +1;


            $("#main_airline_div_"+mI).append(
                '   <div id="airline_div_0_0" class="col-md-10 airline_div">\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-md-5">\n' +
                '                                            <label for="">Airlines</label>\n' +
                '                                            <select type="text" id="airlines_'+clone_index+'_'+mI+'" name="segment_'+mI+'_[airlines][]" class="form-control"  ></select>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-md-5">\n' +
                '                                            <label for="">Class Of Serivce</label>\n' +
                '                                            <select   name="segment_'+mI+'_[class_of_services_'+clone_index+'][]" class="form-control " id="select_multi_'+mI+'_'+clone_index+'" multiple="multiple">\n' +
                '                                                <option value="all">All</option>\n' +
                '                                                @foreach(range("A", "Z") as $item)\n' +
                '                                                <option value="{{$item}}">{{$item}}</option>\n' +
                '                                                @endforeach\n' +
                '                                            </select>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-md-2">\n' +
                '                                            <button    onclick="remove_airline(this)" type="button" class="">X</button>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>'
            );

            select2_airlines(clone_index,mI);
            select2_class(mI,clone_index)
        }

        function ParenClickClone(){

             main_index = main_index + 2;

            var data = '<div class="desig-info">\n' +
                '                            <div class="alert alert-secondary alert-dismissible fade show " role="alert">\n' +
                '                                '+main_index+'\n' +
                '                                <button type="button" onclick="remove_parent(this)" class="close" data-dismiss="alert" aria-label="Close">\n' +
                '                                    <span aria-hidden="true">&times;</span>\n' +
                '                                </button>\n' +
                '                            </div>\n' +
                '                            <div class="row">\n' +
                '                                <div class="col-md-8">\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-md-6">\n' +
                '                                            <label for="">Origin</label>\n' +
                '                                            <select   name="segment_'+main_index+'_[origin]" id="origin_' +main_index  +'" class="form-control"></select>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-md-6">\n' +
                '                                            <label for="">Destination</label>\n' +
                '                                            <select  name="segment_'+main_index+'_[destination]" id="destination_'+main_index+ '" class="form-control"></select>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <div id="main_airline_div_'+main_index+'"  class="row">\n' +
                '                                <div id="airline_div_'+clone_index+'_'+main_index+'" class="col-md-10 airline_div">\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-md-5">\n' +
                '                                            <label for="">Airlines</label>\n' +
                '                                            <select type="text" id="airlines_'+clone_index+'_'+main_index+'" name="segment_'+main_index+'_[airlines][]" class="form-control "  ></select>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-md-5">\n' +
                '                                            <label for="">Class Of Serivce</label>\n' +
                '                                            <select  name="segment_'+main_index+'_[class_of_services_'+clone_index+'][]" class="form-control " id="select_multi_'+clone_index+'_'+main_index+'" multiple="multiple">\n' +
                '                                                <option value="all">All</option>\n' +
                '                                                <option value="A">A</option>\n' +
                '                                                <option value="B">B</option>\n' +
                '                                                <option value="C">C</option>\n' +
                '                                                <option value="D">D</option>\n' +
                '                                                <option value="E">E</option>\n' +
                '                                                <option value="F">F</option>\n' +
                '                                                <option value="G">G</option>\n' +
                '                                                <option value="H">H</option>\n' +
                '                                                <option value="I">I</option>\n' +
                '                                                <option value="J">J</option>\n' +
                '                                                <option value="K">K</option>\n' +
                '                                                <option value="L">L</option>\n' +
                '                                                <option value="M">M</option>\n' +
                '                                                <option value="N">N</option>\n' +
                '                                                <option value="O">O</option>\n' +
                '                                                <option value="P">P</option>\n' +
                '                                                <option value="Q">Q</option>\n' +
                '                                                <option value="R">R</option>\n' +
                '                                                <option value="S">S</option>\n' +
                '                                                <option value="T">T</option>\n' +
                '                                                <option value="U">U</option>\n' +
                '                                                <option value="V">V</option>\n' +
                '                                                <option value="W">W</option>\n' +
                '                                                <option value="X">X</option>\n' +
                '                                                <option value="Y">Z</option>\n' +
                '                                            </select>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-md-2">\n' +
                '                                            <button hidden  onclick="remove_airline(this)" type="button" class="">X</button>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                '                            <button onclick="CloneAirlineDiv('+main_index+')" type="button" class="">+</button>\n' +
                '                        </div>\n '

            $("#parent_div").append(data);
            select_from(main_index,"");
            select_to(main_index,"");
            select2_airlines(clone_index,main_index);
            select2_class(clone_index,main_index)

        }


        function select2_airlines(index,main_index,id="",value="")
        {
            $('#airlines_'+index+"_"+main_index).select2({
                placeholder: "Choose Airlines",
                minimumInputLength: 3,
                ajax: {
                    url: '{{url('flights/airlines')}}',
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
                                text: dataObj.name
                            })
                        });
                        return {
                            results: result
                        };
                    },
                    cache: true
                }
            });
            if(value != "")
            {
                $('#airlines_'+index+"_"+main_index).append('<option value="'+id+'" selected="selected">'+value+'</option>');
                $('#airlines_'+index+"_"+main_index).trigger('change');
            }

        }

        function select_from(index,value="") {


            $('#origin_'+index).select2({
                placeholder: "Select Origin...",
                minimumInputLength: 3,
                ajax: {
                    url: '{{url("flights/airports")}}',
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
                                id: dataObj.code,
                                text: dataObj.name
                            })
                        });
                        return {
                            results: result
                        };
                    },
                    cache: true
                }
            });

            if(value != "")
            {
                $('#origin_'+index).append('<option value="'+value+'" selected="selected">'+value+'</option>');
                $('#origin_'+index).trigger('change');
            }
        }
        function select_to(index,value="") {

            $('#destination_'+index).select2({
                placeholder: "Select Destination...",
                minimumInputLength: 3,
                ajax: {
                    url: '{{url("flights/airports")}}',
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
                                id: dataObj.code,
                                text: dataObj.name
                            })
                        });
                        return {
                            results: result
                        };
                    },
                    cache: true
                }
            });

            if(value != "")
            {
                $('#destination_'+index).append('<option value="'+value+'" selected="selected">'+value+'</option>');
                $('#destination_'+index).trigger('change');
            }
        }

        function remove_airline(e) {
            $(e).parent().parent().parent().remove()
        }
        function remove_parent(e) {
            $(e).parent().parent().remove()
        }

        function select2_class(index,main_index)
        {
            $("#select_multi_"+index+"_"+main_index).select2().on("select2:select", function(e) {

                if(e.params.data.id == 'all'){
                    $("#select_multi_"+index +"_"+main_index +" > option" ).prop("selected","selected");
                    $("#select_multi_"+index +"_"+ main_index+" > option" ).first().prop("selected",false);
                    $("#select_multi_"+index+"_"+main_index).trigger("change");
                }
            });

        }

        $('#submit_form').on('submit',function(event){

            @if(!empty($level->id))
            var url = '{{url('')}}';
                    @else
            var url = '{{url('corporate/flightrules/add')}}';
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
