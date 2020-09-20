<template>
    <div id="flight-data" class="active">
        <div class="row">
            <div class="col-12">
                <div class="d-flex">
                    <div class="flight-tour" v-bind:class="{ show: GetActiveTab(FlightTypes.Oneway) }" v-on:click="SetFlightType(FlightTypes.Oneway)">One-way</div>
                    <div class="flight-tour" v-bind:class="{ show: GetActiveTab(FlightTypes.Round) }" v-on:click="SetFlightType(FlightTypes.Round)">Round-trip</div>
                    <div class="flight-tour" v-bind:class="{ show: GetActiveTab(FlightTypes.MultiCity) }" v-on:click="SetFlightType(FlightTypes.MultiCity)">Multi-city</div>
                </div>
            </div>
        </div>
        <div v-bind:class="{ 'fade-in': GetActiveTab(FlightTypes.Oneway) || GetActiveTab(FlightTypes.Round) }" class="one-way-tour">
            <div class="row no-gutters" >
                <div class="col-md-7">
                    <div class="row no-gutters">
                        <div class="col-md-7 px-1 mt-3">
                            <div class="exchange-result" v-show="SearchQuery.Origin">
                                <i class="fas fa-exchange-alt exchange-icon"></i>
                            </div>
                            <div class="flight-orign typeahead">
                                <svg focusable="false"
                                     color="inherit"
                                     fill="currentcolor"
                                     aria-hidden="true"
                                     role="presentation"
                                     viewBox="0 0 100 100"
                                     preserveAspectRatio="xMidYMid meet"
                                     width="24px"
                                     height="24px"
                                     class="wt4csw-7 ePXLMS sc-kgoBCf kPCxEb">
                                    <path d="M50 1C22.9 1 1 22.9 1 50s21.9 49 49 49 49-21.9 49-49C99 23 77 1 50 1zm43.4 53.2C91.4 75 75 91.4 54.2 93.4l-1.5.2V73.3c0-1.5-1.2-2.7-2.7-2.7s-2.7 1.2-2.7 2.7v20.2l-1.5-.2C25 91.4 8.6 75 6.6 54.2l-.2-1.5h20.2c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H6.4l.2-1.5C8.6 25 25 8.6 45.8 6.6l1.5-.2v18.1c0 1.5 1.2 2.7 2.7 2.7s2.7-1.2 2.7-2.7V6.4l1.5.2C75 8.6 91.4 25 93.4 45.8l.2 1.5H75.5c-1.5 0-2.7 1.2-2.7 2.7s1.2 2.7 2.7 2.7h18.1l-.2 1.5z"></path>
                                </svg>
                                <typeahead :SearchQuery="SearchQuery" PropertyName="Origin"></typeahead>
                            </div>
                            <div class="flight-destination typeahead">
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="wt4csw-9 hixXyt sc-kGXeez kujTFb"><path d="M68.8 5.5c-5-2.6-10.4-4.2-16-4.5H50C27.7 1 9.7 19.1 9.7 41.4c0 10.7 4.3 20.9 11.8 28.4l23.7 27c2.4 2.6 6.4 2.9 9.1.5l.5-.5 23.7-27c1.1-1.1 6.9-9.3 7.2-9.8 10.4-19.6 2.8-44.1-16.9-54.5zm15.1 38.1c-.5 6.6-2.9 13-6.9 18.2l-.1.2c-.9 1.2-1.9 2.3-2.9 3.3L50 92.6 26.1 65.4c-1-1-2-2.2-3-3.4-4.6-5.9-7-13.2-7-20.7 0-18.8 15.2-34 34-34 .8 0 1.6 0 2.4.1 18.7 1.3 32.7 17.5 31.4 36.2z"></path><path d="M50 22.9c-10.2 0-18.5 8.3-18.5 18.5S39.8 59.9 50 59.9s18.5-8.3 18.5-18.5c-.1-10.2-8.3-18.5-18.5-18.5zm0 30.5c-6.7 0-12.1-5.4-12.1-12.1S43.3 29.2 50 29.2s12.1 5.4 12.1 12.1c0 6.7-5.4 12.1-12.1 12.1z"></path></svg>
                                <typeahead :SearchQuery="SearchQuery" PropertyName="Destination"></typeahead>
                            </div>
                        </div>

                        <div class="col-md-5 px-1 mt-3">
                            <div class="flight-date-picker">

                                <div class="date-from">
                                    <input type="text" class="w-100 h-100 daterange">
                                    <svg focusable="false" color="gray850" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="">
                                        <path d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"></path>
                                    </svg>
                                    <span class="font-size-12">{{ Helper.GetMonthName(SearchQuery.DepartureTime) }}</span>
                                    <h1 class=" mb-0">{{ Helper.GetDay(SearchQuery.DepartureTime) }}</h1>
                                    <span class="font-size-12">{{ Helper.GetDayName(SearchQuery.DepartureTime) }}</span>
                                </div>
                                <span class="spacer"></span>
                                <div class="date-picker-to" v-show="GetActiveTab(FlightTypes.Round)">
                                    <div class="">
                                        <input type="text" class="w-100 h-100 daterange">
                                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="hide-return">
                                            <path d="M17 13H7v-2h10m2-8H5c-1.11 0-2 .89-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5a2 2 0 0 0-2-2z"></path>
                                        </svg>
                                    </div>
                                    <svg focusable="false" color="gray850" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="date-second">
                                        <path d="M40.6 73.9c1.2 1 2.8.8 3.8-.3 1-1.2.8-2.8-.3-3.8l-.1-.1-7.7-6.1h35.6c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H36.1l7.8-6.3c1.2-1 1.4-2.6.4-3.8s-2.6-1.4-3.8-.4L26.8 58.8c-.6.5-1 1.3-1 2.2 0 .8.4 1.6 1 2.1l13.8 10.8z"></path>
                                        <path d="M90.4 10.6H75V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H28.8V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H9.6C5.4 10.6 2 14 2 18.3v69.2c0 4.2 3.4 7.6 7.6 7.6h80.7c4.2 0 7.6-3.4 7.6-7.6V18.3c.1-4.3-3.3-7.7-7.5-7.7zm3.8 76.9c0 2.2-1.8 3.8-3.8 3.8H9.6c-2.2 0-3.8-1.8-3.8-3.8V33.6h88.4v53.9zm.1-57.7H5.8V18.3c0-2.2 1.8-3.8 3.8-3.8H25v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h42.3v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h15.4c2.2 0 3.8 1.8 3.8 3.8v11.5z"></path>
                                    </svg>
                                    <span class="font-size-12">{{ Helper.GetMonthName(SearchQuery.ArrivalTime) }}</span>
                                    <h1 class=" mb-0">{{ Helper.GetDay(SearchQuery.ArrivalTime) }}</h1>
                                    <span class="font-size-12">{{ Helper.GetDayName(SearchQuery.ArrivalTime) }}</span>
                                </div>
                                <div class="add-return" v-show="!GetActiveTab(FlightTypes.Round)" v-on:click="SetFlightType(FlightTypes.Round)">
                                    <svg focusable="false" color="gray850" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="38px" height="38px" class="date-second mb-3">
                                        <path d="M40.6 73.9c1.2 1 2.8.8 3.8-.3 1-1.2.8-2.8-.3-3.8l-.1-.1-7.7-6.1h35.6c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H36.1l7.8-6.3c1.2-1 1.4-2.6.4-3.8s-2.6-1.4-3.8-.4L26.8 58.8c-.6.5-1 1.3-1 2.2 0 .8.4 1.6 1 2.1l13.8 10.8z"></path>
                                        <path d="M90.4 10.6H75V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H28.8V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H9.6C5.4 10.6 2 14 2 18.3v69.2c0 4.2 3.4 7.6 7.6 7.6h80.7c4.2 0 7.6-3.4 7.6-7.6V18.3c.1-4.3-3.3-7.7-7.5-7.7zm3.8 76.9c0 2.2-1.8 3.8-3.8 3.8H9.6c-2.2 0-3.8-1.8-3.8-3.8V33.6h88.4v53.9zm.1-57.7H5.8V18.3c0-2.2 1.8-3.8 3.8-3.8H25v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h42.3v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h15.4c2.2 0 3.8 1.8 3.8 3.8v11.5z"></path>
                                    </svg>
                                    <span class="font-size-12">ADD RETURN</span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-5 px-1">
                    <div class="row no-gutters">
                        <div class=" col-lg-8 col-md-9 mt-3">
                            <div class="select-class dd-cabin-class">
                                <multiselect v-model="SearchQuery.CabinClass" track-by="id" label="id" placeholder="Select Cabin Class"
                                             open-direction="bottom" :options="CabinClasses" :searchable="false" :allow-empty="false">
                                    <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.label }}</strong></template>
                                </multiselect>
                            </div>

                            <div class="select-pessanger" v-on:click="TogglePassengerDropDown()">
                                <span>{{ TotalPassengers() }} Passenger</span>
                                <svg
                                        focusable="false"
                                        color="inherit"
                                        fill="currentcolor"
                                        aria-hidden="true"
                                        role="presentation"
                                        viewBox="0 0 150 150"
                                        preserveAspectRatio="xMidYMid meet"
                                        width="24px"
                                        height="24px"
                                        class="sc-1o8lb20-9 cqyXKJ sc-kgoBCf kPCxEb">
                                    <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                </svg>
                            </div>

                            <div class="select-passnger-drop" v-bind:class="{ active: PassengerDropDownFlag }">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Adults (12+ years)
                                        <div class="d-flex align-items-center">
                                            <div v-on:click="DecrementPassenger(PassengerTypes.Adults)"><i class="fas fa-minus-circle fa-lg"></i></div>
                                            <span class="px-2">{{ SearchQuery.Passenger.Adults }}</span>
                                            <div v-on:click="IncrementPassenger(PassengerTypes.Adults)"><i class="fas fa-plus-circle fa-lg"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Children (2 -11 years)
                                        <div class="d-flex align-items-center">
                                            <div v-on:click="DecrementPassenger(PassengerTypes.Children)"><i class="fas fa-minus-circle fa-lg"></i></div>
                                            <span class="px-2">{{ SearchQuery.Passenger.Children }}</span>
                                            <div v-on:click="IncrementPassenger(PassengerTypes.Children)"><i class="fas fa-plus-circle fa-lg"></i></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Infants (Under 2 years)
                                        <div class="d-flex align-items-center">
                                            <div v-on:click="DecrementPassenger(PassengerTypes.Infants)"><i class="fas fa-minus-circle fa-lg"></i></div>
                                            <span class="px-2">{{ SearchQuery.Passenger.Infants }}</span>
                                            <div v-on:click="IncrementPassenger(PassengerTypes.Infants)"><i class="fas fa-plus-circle fa-lg"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="col-lg-4 col-md-3 pl-1 mt-3" v-on:click="SearchFlight()">
                            <div class="d-none d-md-block">
                                <button type="button" class="btn btn-search-md ml-2">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="me7zgm-11 dSvlKs sc-kgoBCf kPCxEb">
                                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                    </svg>
                                    <span class="me7zgm-12 jaOoBn">Search flights</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-bind:class="{ 'fade-in': GetActiveTab(FlightTypes.MultiCity) }" class="multi-city-tour">
            <div class="row no-gutters">
                <div class="col-md-7">
                    <div class="row no-gutters">
                        <div class="col-md-9 px-1 mt-3">
                            <div class="exchange-result">
                                <i class="fas fa-exchange-alt exchange-icon"></i>
                            </div>
                            <div class="flight-orign">
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="wt4csw-7 ePXLMS sc-kgoBCf kPCxEb">
                                    <path d="M50 1C22.9 1 1 22.9 1 50s21.9 49 49 49 49-21.9 49-49C99 23 77 1 50 1zm43.4 53.2C91.4 75 75 91.4 54.2 93.4l-1.5.2V73.3c0-1.5-1.2-2.7-2.7-2.7s-2.7 1.2-2.7 2.7v20.2l-1.5-.2C25 91.4 8.6 75 6.6 54.2l-.2-1.5h20.2c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H6.4l.2-1.5C8.6 25 25 8.6 45.8 6.6l1.5-.2v18.1c0 1.5 1.2 2.7 2.7 2.7s2.7-1.2 2.7-2.7V6.4l1.5.2C75 8.6 91.4 25 93.4 45.8l.2 1.5H75.5c-1.5 0-2.7 1.2-2.7 2.7s1.2 2.7 2.7 2.7h18.1l-.2 1.5z"></path>
                                </svg>
                                <input class="AutoComplete__Input  phbroq-2 cerrLM" data-testid="FlightSearchBox__FromAirportInput" placeholder="Origin" value="">
                            </div>
                            <div class="flight-destination">
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="wt4csw-9 hixXyt sc-kgoBCf kPCxEb">
                                    <path d="M68.8 5.5c-5-2.6-10.4-4.2-16-4.5H50C27.7 1 9.7 19.1 9.7 41.4c0 10.7 4.3 20.9 11.8 28.4l23.7 27c2.4 2.6 6.4 2.9 9.1.5l.5-.5 23.7-27c1.1-1.1 6.9-9.3 7.2-9.8 10.4-19.6 2.8-44.1-16.9-54.5zm15.1 38.1c-.5 6.6-2.9 13-6.9 18.2l-.1.2c-.9 1.2-1.9 2.3-2.9 3.3L50 92.6 26.1 65.4c-1-1-2-2.2-3-3.4-4.6-5.9-7-13.2-7-20.7 0-18.8 15.2-34 34-34 .8 0 1.6 0 2.4.1 18.7 1.3 32.7 17.5 31.4 36.2z"></path>
                                    <path d="M50 22.9c-10.2 0-18.5 8.3-18.5 18.5S39.8 59.9 50 59.9s18.5-8.3 18.5-18.5c-.1-10.2-8.3-18.5-18.5-18.5zm0 30.5c-6.7 0-12.1-5.4-12.1-12.1S43.3 29.2 50 29.2s12.1 5.4 12.1 12.1c0 6.7-5.4 12.1-12.1 12.1z"></path>
                                </svg>
                                <input placeholder="Destination" value="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1 mt-3">
                            <div class="flight-date-picker">
                                <div class="">
                                    <input type="text" class="w-100 h-100 daterange">
                                    <svg focusable="false" color="gray850" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="">
                                        <path d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"></path>
                                    </svg>
                                    <span class="font-size-12">October</span>
                                    <h1 class=" mb-0 ">31</h1>
                                    <span class="font-size-12">Thursday</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 px-1">
                    <div class="row no-gutters">
                        <div class=" col-lg-8 col-md-9 mt-3">
                            <div class="select-class">
                                <span class="">Economy</span>
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="sc-1sn5k4t-5 ixpgfr sc-kgoBCf kPCxEb">
                                    <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                </svg>
                                <div class="select-class-drop">
                                    <ul class="nav flex-column">
                                        <li class="px-3 py-2 font-size-14">Economy</li>
                                        <li class="px-3 py-2 font-size-14">Premium Economy</li>
                                        <li class="px-3 py-2 font-size-14">Business</li>
                                        <li class="px-3 py-2 font-size-14">First</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="select-pessanger">
                                <span class="">1 Passenger</span>
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="sc-1o8lb20-9 cqyXKJ sc-kgoBCf kPCxEb">
                                    <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                </svg>
                                <div class="select-passnger-drop">
                                    <ul class="nav flex-column">
                                        <li class="px-3 py-2 font-size-14 d-flex justify-content-between align-items-center">
                                            Adults (12+ years)
                                            <div class="d-flex align-items-center">
                                                <div><i class="fas fa-minus-circle fa-lg"></i></div>
                                                <span class="px-2">1</span>
                                                <div><i class="fas fa-plus-circle fa-lg"></i></div>
                                            </div>
                                        </li>
                                        <li class="px-3 py-2 font-size-14 d-flex justify-content-between align-items-center">
                                            Children (2 -11 years)
                                            <div class="d-flex align-items-center">
                                                <div><i class="fas fa-minus-circle fa-lg"></i></div>
                                                <span class="px-2">1</span>
                                                <div><i class="fas fa-plus-circle fa-lg"></i></div>
                                            </div>
                                        </li>
                                        <li class="px-3 py-2 font-size-14 d-flex justify-content-between align-items-center">
                                            Infants (Under 2 years)
                                            <div class="d-flex align-items-center">
                                                <div><i class="fas fa-minus-circle fa-lg"></i></div>
                                                <span class="px-2">1</span>
                                                <div><i class="fas fa-plus-circle fa-lg"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3 pl-1 mt-3">
                            <div class="d-none d-md-block">
                                <button type="button" class="btn btn-search-md ml-2">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="me7zgm-11 dSvlKs sc-kgoBCf kPCxEb">
                                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                    </svg>
                                    <span class="me7zgm-12 jaOoBn">Search flights</span>
                                </button>
                            </div>
                            <div class="d-block d-md-none">
                                <button type="button" class="btn btn-search-sm ml-2">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="">
                                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                    </svg>
                                    <span class="font-weight-bold">Search flights</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters align-items-center">
                <div class="col-md-8">
                    <div class="multi-flights">
                        <div class="d-flex align-items-center py-2">
                            <i class="fas fa-plane text-white mr-2"></i>
                            <span class="flight-type text-white">Flight 2</span>
                            <div class="line-multi-search"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row no-gutters">
                        <div class="col-md-9 px-1 mt-3">
                            <div class="exchange-result">
                                <i class="fas fa-exchange-alt exchange-icon"></i>
                            </div>
                            <div class="flight-orign">
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="wt4csw-7 ePXLMS sc-kgoBCf kPCxEb">
                                    <path d="M50 1C22.9 1 1 22.9 1 50s21.9 49 49 49 49-21.9 49-49C99 23 77 1 50 1zm43.4 53.2C91.4 75 75 91.4 54.2 93.4l-1.5.2V73.3c0-1.5-1.2-2.7-2.7-2.7s-2.7 1.2-2.7 2.7v20.2l-1.5-.2C25 91.4 8.6 75 6.6 54.2l-.2-1.5h20.2c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H6.4l.2-1.5C8.6 25 25 8.6 45.8 6.6l1.5-.2v18.1c0 1.5 1.2 2.7 2.7 2.7s2.7-1.2 2.7-2.7V6.4l1.5.2C75 8.6 91.4 25 93.4 45.8l.2 1.5H75.5c-1.5 0-2.7 1.2-2.7 2.7s1.2 2.7 2.7 2.7h18.1l-.2 1.5z"></path>
                                </svg>
                                <input class="AutoComplete__Input  phbroq-2 cerrLM" data-testid="FlightSearchBox__FromAirportInput" placeholder="Origin" value="">
                            </div>
                            <div class="flight-destination">
                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="wt4csw-9 hixXyt sc-kgoBCf kPCxEb">
                                    <path d="M68.8 5.5c-5-2.6-10.4-4.2-16-4.5H50C27.7 1 9.7 19.1 9.7 41.4c0 10.7 4.3 20.9 11.8 28.4l23.7 27c2.4 2.6 6.4 2.9 9.1.5l.5-.5 23.7-27c1.1-1.1 6.9-9.3 7.2-9.8 10.4-19.6 2.8-44.1-16.9-54.5zm15.1 38.1c-.5 6.6-2.9 13-6.9 18.2l-.1.2c-.9 1.2-1.9 2.3-2.9 3.3L50 92.6 26.1 65.4c-1-1-2-2.2-3-3.4-4.6-5.9-7-13.2-7-20.7 0-18.8 15.2-34 34-34 .8 0 1.6 0 2.4.1 18.7 1.3 32.7 17.5 31.4 36.2z"></path>
                                    <path d="M50 22.9c-10.2 0-18.5 8.3-18.5 18.5S39.8 59.9 50 59.9s18.5-8.3 18.5-18.5c-.1-10.2-8.3-18.5-18.5-18.5zm0 30.5c-6.7 0-12.1-5.4-12.1-12.1S43.3 29.2 50 29.2s12.1 5.4 12.1 12.1c0 6.7-5.4 12.1-12.1 12.1z"></path>
                                </svg>
                                <input placeholder="Destination" value="">
                            </div>
                        </div>
                        <div class="col-md-3 px-1 mt-3">
                            <div class="flight-date-picker">
                                <div class="">
                                    <input type="text" class="w-100 h-100 daterange">
                                    <svg focusable="false" color="gray850" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="">
                                        <path d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"></path>
                                    </svg>
                                    <span class="font-size-12">October</span>
                                    <h1 class=" mb-0 ">31</h1>
                                    <span class="font-size-12">Thursday</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1 d-none d-md-block">
                    <div class="multi-search-cross float-right">
                        <i class="fas fa-times-circle text-white fa-lg"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-8 p-0">
                <div class="line-multi-search mt-4"></div>
                <div class="d-flex justify-content-end align-items-center mt-2">
                    <span class="text-white">Add more flights (6 max)</span>
                    <i class="fas fa-plus-circle text-white ml-2 fa-lg"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import Typeahead from '../common-components/Typeahead';
    import Helper from '../helpers/Util';

    export default {
        name: "FlightSearchFormComponent",
        components: { Multiselect, Typeahead },
        data () {
            return {
                Helper: Helper,
                PassengerDropDownFlag: false,
                PassengerTypes: {
                    Adults: "Adults",
                    Children: "Children",
                    Infants: "Infants"
                },
                FlightTypes: {
                    Oneway: 'oneway',
                    Round: 'round',
                    MultiCity: 'multicity'
                },
                CabinClasses: [
                    { id: "Economy", label: "Economy" },
                    { id: "Premium Economy", label: "Premium Economy" },
                    { id: "Business", label: "Business" },
                    { id: "First", label: "First" }
                ],
                SearchQuery: {
                    Origin: "",
                    Destination: "",
                    DepartureTime: "",
                    ArrivalTime: "",
                    CabinClass: "",
                    FlightType: "oneway",
                    Passenger: {
                        Adults: 1,
                        Children: 0,
                        Infants: 0
                    }
                },
                DateRangePicker: {}
            }
        },
        mounted() {
            this.SearchQuery.CabinClass = this.CabinClasses[0];
            this.SearchQuery.DepartureTime = window.moment();
            this.SearchQuery.ArrivalTime = window.moment(window.moment().add(7, 'days'));

            $(document).ready(() => {
                this.RefreshDaterangepicker(true);
            });
        },
        methods: {
            IncrementPassenger(Passenger) {
                this.SearchQuery.Passenger[Passenger] += 1;
            },
            IncrementPassengerHotel(Passenger) {
                this.HotelSearchQuery.Passenger[Passenger] += 1;
            },
            DecrementPassenger(Passenger) {
                this.SearchQuery.Passenger[Passenger] -= 1;
            },
            TotalPassengers() {
                return (this.SearchQuery.Passenger.Adults + this.SearchQuery.Passenger.Children + this.SearchQuery.Passenger.Infants);
            },
            TogglePassengerDropDown() {
                this.PassengerDropDownFlag = !this.PassengerDropDownFlag;
            },
            RefreshDaterangepicker(singleDatePicker) {
                if (!singleDatePicker) {
                    let CurrentTime = window.moment(this.SearchQuery.DepartureTime);
                    this.SearchQuery.ArrivalTime = window.moment(CurrentTime.add(7, 'days'));
                }
                $(" .daterange ").daterangepicker({
                    singleDatePicker: singleDatePicker,
                    startDate: this.SearchQuery.DepartureTime,
                    endDate: this.SearchQuery.ArrivalTime,
                    autoApply: true,
                    locale: {
                        format: 'DD-MM-Y'
                    },
                    minDate: window.moment(),
                    maxDate: window.moment(window.moment().add(30, 'days'))
                }, (start, end, label) => {
                    this.SearchQuery.DepartureTime = new Date(start.format('YYYY-MM-DD'));
                    this.SearchQuery.ArrivalTime = new Date(end.format('YYYY-MM-DD'));
                });
            },
            GetActiveTab(tab) {
                return this.SearchQuery.FlightType == tab;
            },
            SetFlightType(type) {
                let singleDatePicker = (type == this.FlightTypes.Oneway) ? true : false;
                this.RefreshDaterangepicker(singleDatePicker);
                this.SearchQuery.FlightType = type;
            },
            SearchFlight() {
                let SearchQueryObject = {
                    traveltype: this.SearchQuery.FlightType,
                    from: this.SearchQuery.Origin,
                    to: this.SearchQuery.Destination,
                    departure_date: this.Helper.APIDateTimeFormat(this.SearchQuery.DepartureTime),
                    return_date: this.Helper.APIDateTimeFormat(this.SearchQuery.ArrivalTime),
                    adult: this.SearchQuery.Passenger.Adults,
                    child: this.SearchQuery.Passenger.Children,
                    infant: this.SearchQuery.Passenger.Infants,
                    class: this.SearchQuery.CabinClass.id
                };

                if (
                    !Helper.IsEmpty(SearchQueryObject.from) &&
                    !Helper.IsEmpty(SearchQueryObject.to) &&
                    !Helper.IsEmpty(SearchQueryObject.departure_date) &&
                    !Helper.IsEmpty(SearchQueryObject.adult) &&
                    !Helper.IsEmpty(SearchQueryObject.class)
                ) {
                    let SearchQueryString = jQuery.param(SearchQueryObject);
                    window.location.href = base_url+"search?"+SearchQueryString;
                }
            }
        }
    }
</script>

<style scoped>
    .main-header .typeahead {
        overflow: unset;
    }
</style>