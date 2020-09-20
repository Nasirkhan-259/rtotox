@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/search-form.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .select2-container--default .select2-selection--single {
            border: 1px solid #aaa0;
        }
    </style>
@endpush

<div class="tab-content">
    <div class="container">
        <flight-search-form-component ref="searchFormComponent"></flight-search-form-component>
        <div id="hotel-data">
            <hotel-search-form-component ref="HotelsearchFormComponent"></hotel-search-form-component>
        </div>
    </div>
</div>

@push("scripts")
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{ asset('js/search-form.js') }}"></script>
    <script type="text/javascript">
        $('[id^=FlightLocationSelect2]').select2({
            placeholder: "Search Location...",
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
                            airportObj: dataObj,
                            text: dataObj.cityName +", "+ dataObj.countryName +" - "+ dataObj.name
                        })
                    });
                    return {
                        results: result
                    };
                },
                cache: true
            },
            templateResult: function (data) {
                if (!data.id) {
                    return data.text;
                }

                let airport = $("<div class='row'><div class='fa fa-plane col-md-2 w-10'></div><div class='col-md-10'>" +
                    "<div class='slect2-dd-heading'></div><div class='label-dark pull-right'></div>" +
                    "<div class='select2-dd-description fs-12'></div> <hr></div></div>");

                airport.find("div.slect2-dd-heading").text(data.airportObj.cityName +","+ data.airportObj.countryName);
                airport.find("div.slect2-dd-heading").text(data.airportObj.cityName +" ( "+ data.airportObj.code +" ), "+ data.airportObj.countryName);
                airport.find("div.select2-dd-description").text(data.airportObj.name);
                airport.find("div.label-dark").text(data.airportObj.code);

                return airport;
            }
        }).on("select2:selecting", function(e) {
            // what you would like to happen
            let fieldName = $(e.target).attr("id").split("-")[1];
            app.$refs.searchFormComponent.SearchQuery[fieldName] = e.params.args.data.id;
        });

        $('#HotelCities').select2({
            placeholder: "Choose Locations",
            minimumInputLength: 3,
            ajax: {
                url: 'hotels/locations',
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
                            text: dataObj.name +" - "+ dataObj.COUNTRY
                        })
                    });
                    return {
                        results: result
                    };
                },
                cache: true
            }
        }).on("select2:selecting", function(e) {
            // what you would like to happen
            let fieldName = $(e.target).attr("id").split("-")[1];
            app.$refs.HotelsearchFormComponent.HotelSearchQuery['Destination'] = e.params.args.data.id;
        });
    </script>
@endpush