<template>
    <section id="flight-listing-component">
        <div class="container">
            <br/>
            <div class="row py-2">
                <div class="col-md-4">Trip No: <span class="color-red" v-text="Trip.tripno"/></div>
                <div class="col-md-4">Trip Name: <span class="color-red" v-show="Trip.tripname" v-text="Trip.tripname +' ('+ Trip.triptype +')'"/></div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#viewTripsModal">View Trips [{{SavedTrips.length}}]</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div v-show="responseMessage" class="alert alert-danger" v-text="responseMessage"></div>
                </div>

                <!-- View Trips Modal -->
                <div class="modal fade" id="viewTripsModal" tabindex="-1" role="dialog" aria-labelledby="viewTripsModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="#" class="form form-inline" method="post" v-on:submit.prevent="">
                                <div class="modal-body">

                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong class="font-size-12">Trip No:</strong>
                                                <strong class="text-danger ml-10 font-size-12" v-text="Trip.tripno"/>
                                            </div>
                                            <div>
                                                <strong class="font-size-12">Trip Name:</strong>
                                                <strong class="text-danger ml-10 font-size-12">
                                                    <span v-text="Trip.tripname"/> (<span v-text="Trip.triptype"/>)
                                                </strong>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong class="font-size-12">Travel Start Date:</strong>
                                                <strong class="text-danger ml-10 font-size-12" v-text="DepartureDate"/>
                                            </div>
                                            <div>
                                                <strong class="font-size-12">Travel End Date:</strong>
                                                <strong class="text-danger ml-10 font-size-12" v-text="ArrivalDate"/>
                                            </div>
                                        </div>

                                        <div v-for="(ItineraryOfSavedTrips, ItineraryOfSavedTripsIndex)  in SavedTrips">
                                            <div class="trip-container">
                                                <div class="trip-header p-10 bg-danger rounded-top">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-2">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <h4 class="text-white mb-0">Flight</h4>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="d-flex justify-content-end align-items-center">
                                                                <div class="text-white px-3 py-2 border  border-rounded font-size-12">
                                                                    <span v-text="ItineraryOfSavedTrips.Currency+' '+ItineraryOfSavedTrips.TotalPrice"/>
                                                                </div>
                                                                <div class="text-white px-3 py-2 border border-rounded font-size-12 mx-2">Adults:<span v-text="ItineraryOfSavedTrips.total_adults"/></div>
                                                                <div class="text-white px-3 py-2 border border-rounded font-size-12 mx-2">Children:<span v-text="ItineraryOfSavedTrips.total_children"/></div>
                                                                <div class="text-white px-3 py-2 border border-rounded font-size-12 mx-2">Infants:<span v-text="ItineraryOfSavedTrips.total_infants"/></div>
                                                                <button v-on:click="RemoveTripFromCart(ItineraryOfSavedTrips)" class="px-2 py-2 bg-white border border-rounded font-size-12 btn" style="height:auto">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="border p-20" v-for="(AirLeg, AirLegIndex) in ItineraryOfSavedTrips.FlightOptionsList.FlightOption">
                                                    <div class="row align-items-center clearfix">
                                                        <div class="col-md-7">
                                                            <div class="d-flex align-items-center">
                                                                <div class="origin" v-text="AirLeg.Option[0].FlightLabelInfo.Origin.AirportName"/>
                                                                <img v-bind:src="GetCarrierImage(AirLeg.Option[0].Carrier)" width="17px" class="mx-3" alt="Airline">
                                                                <div class="to" v-text="AirLeg.Option[0].FlightLabelInfo.Destination.AirportName"/>
                                                                <strong class="font-size-12 ml-10" v-text="AirLeg.Option[0].FlightLabelInfo.DepartureDate"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 d-none d-md-block">
                                                            <span class="d-inline-block px-2 py-2 bg-aqua float-right font-size-12 text-white">
                                                                Total Time: <span v-text="AirLeg.Option[0].FlightLabelInfo.Duration"/>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div v-for="(BookingInfo, BookingInfoIndex) in AirLeg.Option[0].BookingInfo">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="d-flex justify-content-between mt-30 flex-wrap">
                                                                    <div class="d-flex width20">
                                                                        <div class="mr-10">
                                                                            <img v-bind:src="GetCarrierImage(AirLeg.Option[0].Carrier)" alt="airline" width="24px">
                                                                        </div>
                                                                        <div>
                                                                            <strong class="font-size-12" v-text="GetCarrierName(AirLeg.Option[0].Carrier)"/>
                                                                            <div class="font-size-12 text-muted">
                                                                                <span v-text="BookingInfo.Segment.Carrier+'-'+BookingInfo.Segment.Equipment"/><br/>
                                                                                <span v-text="ItineraryOfSavedTrips.cabin_class"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="width20 text-right my-sm-20">
                                                                        <h4 class="mb-5"><span v-text="BookingInfo.Segment.OriginCode"/> <span v-text="GetFlightTime(BookingInfo.Segment.DepartureTime)"/></h4>
                                                                        <strong class="font-size-12" v-text="BookingInfo.Segment.DepartureTime"/>
                                                                        <div class="font-size-12 text-muted">
                                                                            <span v-text="BookingInfo.Segment.OriginDetail.Name"/> <br/>
                                                                            <span v-text="BookingInfo.Segment.OriginDetail.City"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="width20 align-self-center text-center d-none d-md-block">
                                                                        <i class='fas fa-arrow-right' v-if="AirLegIndex == 0"></i>
                                                                        <i class='fas fa-arrow-left' v-else></i>
                                                                    </div>
                                                                    <div class="width20">
                                                                        <h4 class="mb-5"><span v-text="GetFlightTime(BookingInfo.Segment.ArrivalTime)"/> <span v-text="BookingInfo.Segment.DestinationCode"/></h4>
                                                                        <strong class="font-size-12" v-text="BookingInfo.Segment.ArrivalTime"/>
                                                                        <div class="font-size-12 text-muted">
                                                                            <span v-text="BookingInfo.Segment.DestinationDetail.Name"/> <br/>
                                                                            <span v-text="BookingInfo.Segment.DestinationDetail.City"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class='font-size-12 width20 text-center'>
                                                                        <span v-text="GetFlightDuration(BookingInfo.Segment)"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" v-if="AirLeg.Option[0].BookingInfo[BookingInfoIndex+1] != undefined">
                                                            <div class="col-md-12">
                                                                <div class="layover font-size-12 text-center my-3">
                                                                    Waiting time in <strong><span v-text="BookingInfo.Segment.Destination"/>, <span v-text="BookingInfo.Segment.DestinationDetail.Name"/></strong> is
                                                                    <span class="font-weight-bold" v-text="TransitDelay(BookingInfo.Segment.ArrivalTime, AirLeg.Option[0].BookingInfo[BookingInfoIndex+1].Segment.DepartureTime)"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" v-on:click="ProceedForApproval()">Proceed for Approval</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MailTo Modal -->
                <div class="modal fade" id="mailToModal" tabindex="-1" role="dialog" aria-labelledby="mailToModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mailToModalLabel">Email Itinerary</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#" class="form form-inline" method="post" v-on:submit.prevent="MailItinerary()">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="fname" class="col-md-3">Name*:</label>
                                        <input type="text" class="form-control col-md-9" v-model="MailTo.name" placeholder="Enter name" id="fname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="femail" class="col-md-3">Email Id*:</label>
                                        <input type="email" class="form-control col-md-9" v-model="MailTo.email" placeholder="Enter email" id="femail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fmobile" class="col-md-3">Mobile No:</label>
                                        <input type="text" class="form-control col-md-9" v-model="MailTo.mobile" placeholder="Enter mobile" id="fmobile">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Send Flight Email Itinerary</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <aside class="filter">
                        <div class="filter-title">Filter</div>
                        <div class="filter-box-content">
                            <div class="filter-box-heading">
                                <span class="price">Price <span v-show="FTotalPrice > 0" v-text="'['+FTotalPrice+']'"/></span>
                                <div>
                                    <button class="filter-rest" v-on:click="ResetFilters('PriceRange')">Reset</button>
                                    <svg v-on:click="FiltersDisplayHandler('PriceRange')"
                                         focusable="false"
                                         color="secondaryDark"
                                         fill="currentcolor"
                                         aria-hidden="true"
                                         role="presentation"
                                         viewBox="0 0 150 150"
                                         preserveAspectRatio="xMidYMid meet"
                                         width="10px" height="10px"
                                         class="sc-ckVGcZ oGVBx sc-kgoBCf MBqPu">
                                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="price-range" v-show="DivDisplay.PriceRange">
                                <div id="slider"></div>
                                <div class="price-select">
                                    <span v-text="Currency+' '+PriceSliderOption.range.min"/>
                                    <span v-text="Currency+' '+PriceSliderOption.range.max"/>
                                </div>
                            </div>
                        </div>
                        <div class="filter-box-content">
                            <div class="filter-box-heading">
                                <span class="stop">Stops</span>
                                <div>
                                    <button class="filter-rest" v-on:click="ResetFilters('Layovers')">Reset</button>
                                    <svg v-on:click="FiltersDisplayHandler('Layovers')"
                                         focusable="false"
                                         color="secondaryDark"
                                         fill="currentcolor"
                                         aria-hidden="true"
                                         role="presentation"
                                         viewBox="0 0 150 150"
                                         preserveAspectRatio="xMidYMid meet"
                                         width="10px" height="10px"
                                         class="sc-ckVGcZ oGVBx sc-kgoBCf MBqPu">
                                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="direct-stop" v-show="DivDisplay.Layovers">
                                <div class="dsp-inl-flex">
                                    <input id="Direct" v-model="DirectOrStopFlihgt" value="0" type="checkbox">
                                    <label for="Direct">Direct</label>
                                </div> <br />
                                <div class="dsp-inl-flex">
                                    <input id="Stop1" v-model="DirectOrStopFlihgt" value="1"  type="checkbox">
                                    <label for="Stop1">1 Stop</label>
                                </div> <br />
                                <div class="dsp-inl-flex">
                                    <input id="Stop2" v-model="DirectOrStopFlihgt" value="2"  type="checkbox">
                                    <label for="Stop2">2 Stops</label>
                                </div> <br />
                                <div class="dsp-inl-flex">
                                    <input id="Stop3" v-model="DirectOrStopFlihgt" value="3"  type="checkbox">
                                    <label for="Stop3">2+ Stops</label>
                                </div> <br />
                            </div>
                        </div>
                        <div class="filter-box-content">
                            <div class="filter-box-heading">
                                <span class="out-in">Outbound departure</span>
                                <div>
                                    <button class="filter-rest" v-on:click="ResetFilters('Departure')">Reset</button>
                                    <svg v-on:click="FiltersDisplayHandler('Departure')"
                                         focusable="false"
                                         color="secondaryDark"
                                         fill="currentcolor"
                                         aria-hidden="true"
                                         role="presentation"
                                         viewBox="0 0 150 150"
                                         preserveAspectRatio="xMidYMid meet"
                                         width="10px" height="10px"
                                         class="sc-ckVGcZ oGVBx sc-kgoBCf MBqPu">
                                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="outbound out-in-box" v-show="DivDisplay.Departure">
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassOutbound == 'Outbound-00-06') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill="currentColor" fill-rule="evenodd">
                                            <path fill-rule="nonzero"
                                                  d="M1.333 11.667h2.575a.333.333 0 1 0 0-.667H1.333a.333.333 0 1 0 0 .667zM10.333 18.333v2.575a.333.333 0 1 0 .667 0v-2.575a.333.333 0 1 0-.667 0zM10.333 1.333v2.575a.333.333 0 1 0 .667 0V1.333a.333.333 0 1 0-.667 0zM2.459 7.023a.333.333 0 0 0-.25.618l1.49.602a.333.333 0 0 0 .248-.618L2.46 7.023zM7.204 3.34a.333.333 0 0 0-.613.261l.628 1.48a.333.333 0 0 0 .613-.262l-.628-1.478zM5.635 5.968a.332.332 0 0 0 .236-.569L3.569 3.098a.334.334 0 0 0-.471.47L5.399 5.87a.33.33 0 0 0 .236.099zM17.87 3.098a.334.334 0 0 0-.47 0l-2.302 2.3a.333.333 0 1 0 .471.471l2.302-2.3c.13-.13.13-.341 0-.471zM5.635 16a.332.332 0 0 1 .236.568L3.569 18.87a.334.334 0 0 1-.471-.47l2.301-2.302A.33.33 0 0 1 5.635 16zM17.87 18.87a.334.334 0 0 1-.47 0l-2.302-2.302a.333.333 0 1 1 .471-.47l2.302 2.3c.13.13.13.341 0 .471zM17.333 8.294a.327.327 0 0 0 .13-.027l1.48-.628a.333.333 0 0 0-.26-.613l-1.48.628a.333.333 0 0 0 .13.64zM13.15 5.197a.327.327 0 0 0 .073-.111l.603-1.49a.333.333 0 0 0-.617-.25l-.603 1.49a.333.333 0 0 0 .544.36zM7.204 19.08a.333.333 0 0 1-.613-.261l.628-1.478a.333.333 0 0 1 .613.262l-.628 1.478zM13.15 17.236c.03.03.056.067.073.11l.603 1.49a.333.333 0 0 1-.617.25l-.603-1.49a.333.333 0 0 1 .544-.36zM2.459 14.244a.333.333 0 0 1-.25-.618l1.49-.602a.333.333 0 0 1 .248.618l-1.488.602zM17.333 13c.043 0 .088.008.13.027l1.48.627a.333.333 0 0 1-.26.614l-1.48-.628a.333.333 0 0 1 .13-.64zM19.908 11h-2.575a.333.333 0 1 0 0 .667h2.575a.333.333 0 1 0 0-.667z"></path>
                                            <ellipse cx="10.833" cy="10.827" stroke="currentColor" rx="5.833"
                                                     ry="5.827"></ellipse>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Outbound', '00-06')">
                                        <div>00:00</div>
                                        <div>-</div>
                                        <div>06:00</div>
                                    </div>
                                </div>
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassOutbound == 'Outbound-06-12') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill="none" fill-rule="evenodd">
                                            <path fill="currentColor" fill-rule="nonzero"
                                                  d="M1.333 11.667h2.575a.333.333 0 1 0 0-.667H1.333a.333.333 0 1 0 0 .667zM10.333 18.333v2.575a.333.333 0 1 0 .667 0v-2.575a.333.333 0 1 0-.667 0zM10.333 1.333v2.575a.333.333 0 1 0 .667 0V1.333a.333.333 0 1 0-.667 0zM2.459 7.023a.333.333 0 0 0-.25.618l1.49.602a.333.333 0 0 0 .248-.618L2.46 7.023zM7.204 3.34a.333.333 0 0 0-.613.261l.628 1.48a.333.333 0 0 0 .613-.262l-.628-1.478zM5.635 5.968a.332.332 0 0 0 .236-.569L3.569 3.098a.334.334 0 0 0-.471.47L5.399 5.87a.33.33 0 0 0 .236.099zM17.87 3.098a.334.334 0 0 0-.47 0l-2.302 2.3a.333.333 0 1 0 .471.471l2.302-2.3c.13-.13.13-.341 0-.471zM5.635 16a.332.332 0 0 1 .236.568L3.569 18.87a.334.334 0 0 1-.471-.47l2.301-2.302A.33.33 0 0 1 5.635 16zM17.87 18.87a.334.334 0 0 1-.47 0l-2.302-2.302a.333.333 0 1 1 .471-.47l2.302 2.3c.13.13.13.341 0 .471zM17.333 8.294a.327.327 0 0 0 .13-.027l1.48-.628a.333.333 0 0 0-.26-.613l-1.48.628a.333.333 0 0 0 .13.64zM13.15 5.197a.327.327 0 0 0 .073-.111l.603-1.49a.333.333 0 0 0-.617-.25l-.603 1.49a.333.333 0 0 0 .544.36zM7.204 19.08a.333.333 0 0 1-.613-.261l.628-1.478a.333.333 0 0 1 .613.262l-.628 1.478zM13.15 17.236c.03.03.056.067.073.11l.603 1.49a.333.333 0 0 1-.617.25l-.603-1.49a.333.333 0 0 1 .544-.36zM2.459 14.244a.333.333 0 0 1-.25-.618l1.49-.602a.333.333 0 0 1 .248.618l-1.488.602zM17.333 13c.043 0 .088.008.13.027l1.48.627a.333.333 0 0 1-.26.614l-1.48-.628a.333.333 0 0 1 .13-.64zM19.908 11h-2.575a.333.333 0 1 0 0 .667h2.575a.333.333 0 1 0 0-.667z"></path>
                                            <ellipse cx="10.833" cy="10.827" stroke="currentColor" rx="5.833"
                                                     ry="5.827"></ellipse>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Outbound', '06-12')">
                                        <div>06:00</div>
                                        <div>-</div>
                                        <div>12:00</div>
                                    </div>
                                </div>
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassOutbound == 'Outbound-12-18') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill-rule="evenodd">
                                            <path fill-rule="nonzero"
                                                  d="M18.367 16.336c-.336.031-.68.047-1.026.047-3.434 0-6.497-1.444-8.193-3.864C6.91 9.326 7.284 5.02 8.58 2.37a.256.256 0 0 0-.054-.299.262.262 0 0 0-.304-.041c-.32.17-.624.353-.904.545a8.977 8.977 0 0 0-3.781 5.821 8.914 8.914 0 0 0 1.484 6.764 9.172 9.172 0 0 0 7.513 3.888 9.144 9.144 0 0 0 6.032-2.261.257.257 0 0 0 .067-.297.26.26 0 0 0-.265-.155z"></path>
                                            <path d="M13.167 4.216l-.168.967a.232.232 0 0 0 .337.242l.878-.456.878.457a.233.233 0 0 0 .244-.018.228.228 0 0 0 .092-.224l-.167-.968.71-.685a.228.228 0 0 0 .059-.236.231.231 0 0 0-.188-.156l-.98-.141-.44-.88c-.078-.157-.337-.157-.416 0l-.439.88-.98.14a.231.231 0 0 0-.188.157.228.228 0 0 0 .059.236l.709.685z"></path>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Outbound', '12-18')">
                                        <div>12:00</div>
                                        <div>-</div>
                                        <div>18:00</div>
                                    </div>
                                </div>
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassOutbound == 'Outbound-18-24') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill="none" fill-rule="evenodd">
                                            <path fill-rule="nonzero" stroke="currentColor"
                                                  d="M18.367 16.336c-.336.031-.68.047-1.026.047-3.434 0-6.497-1.444-8.193-3.864C6.91 9.326 7.284 5.02 8.58 2.37a.256.256 0 0 0-.054-.299.262.262 0 0 0-.304-.041c-.32.17-.624.353-.904.545a8.977 8.977 0 0 0-3.781 5.821 8.914 8.914 0 0 0 1.484 6.764 9.172 9.172 0 0 0 7.513 3.888 9.144 9.144 0 0 0 6.032-2.261.257.257 0 0 0 .067-.297.26.26 0 0 0-.265-.155z"></path>
                                            <path fill="currentColor"
                                                  d="M13.167 4.216l-.168.967a.232.232 0 0 0 .337.242l.878-.456.878.457a.233.233 0 0 0 .244-.018.228.228 0 0 0 .092-.224l-.167-.968.71-.685a.228.228 0 0 0 .059-.236.231.231 0 0 0-.188-.156l-.98-.141-.44-.88c-.078-.157-.337-.157-.416 0l-.439.88-.98.14a.231.231 0 0 0-.188.157.228.228 0 0 0 .059.236l.709.685z"></path>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Outbound', '18-24')">
                                        <div>18:00</div>
                                        <div>-</div>
                                        <div>24:00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-box-content" v-if="TripType == 'round'">
                            <div class="filter-box-heading">
                                <span class="out-in">Inbound departure</span>
                                <div>
                                    <button class="filter-rest" v-on:click="ResetFilters('Arrival')">Reset</button>
                                    <svg v-on:click="FiltersDisplayHandler('Arrival')"
                                         focusable="false"
                                         color="secondaryDark"
                                         fill="currentcolor"
                                         aria-hidden="true"
                                         role="presentation"
                                         viewBox="0 0 150 150"
                                         preserveAspectRatio="xMidYMid meet"
                                         width="10px" height="10px"
                                         class="sc-ckVGcZ oGVBx sc-kgoBCf MBqPu">
                                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="inbound out-in-box" v-show="DivDisplay.Arrival">
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassInbound == 'Inbound-00-06') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill="currentColor" fill-rule="evenodd">
                                            <path fill-rule="nonzero"
                                                  d="M1.333 11.667h2.575a.333.333 0 1 0 0-.667H1.333a.333.333 0 1 0 0 .667zM10.333 18.333v2.575a.333.333 0 1 0 .667 0v-2.575a.333.333 0 1 0-.667 0zM10.333 1.333v2.575a.333.333 0 1 0 .667 0V1.333a.333.333 0 1 0-.667 0zM2.459 7.023a.333.333 0 0 0-.25.618l1.49.602a.333.333 0 0 0 .248-.618L2.46 7.023zM7.204 3.34a.333.333 0 0 0-.613.261l.628 1.48a.333.333 0 0 0 .613-.262l-.628-1.478zM5.635 5.968a.332.332 0 0 0 .236-.569L3.569 3.098a.334.334 0 0 0-.471.47L5.399 5.87a.33.33 0 0 0 .236.099zM17.87 3.098a.334.334 0 0 0-.47 0l-2.302 2.3a.333.333 0 1 0 .471.471l2.302-2.3c.13-.13.13-.341 0-.471zM5.635 16a.332.332 0 0 1 .236.568L3.569 18.87a.334.334 0 0 1-.471-.47l2.301-2.302A.33.33 0 0 1 5.635 16zM17.87 18.87a.334.334 0 0 1-.47 0l-2.302-2.302a.333.333 0 1 1 .471-.47l2.302 2.3c.13.13.13.341 0 .471zM17.333 8.294a.327.327 0 0 0 .13-.027l1.48-.628a.333.333 0 0 0-.26-.613l-1.48.628a.333.333 0 0 0 .13.64zM13.15 5.197a.327.327 0 0 0 .073-.111l.603-1.49a.333.333 0 0 0-.617-.25l-.603 1.49a.333.333 0 0 0 .544.36zM7.204 19.08a.333.333 0 0 1-.613-.261l.628-1.478a.333.333 0 0 1 .613.262l-.628 1.478zM13.15 17.236c.03.03.056.067.073.11l.603 1.49a.333.333 0 0 1-.617.25l-.603-1.49a.333.333 0 0 1 .544-.36zM2.459 14.244a.333.333 0 0 1-.25-.618l1.49-.602a.333.333 0 0 1 .248.618l-1.488.602zM17.333 13c.043 0 .088.008.13.027l1.48.627a.333.333 0 0 1-.26.614l-1.48-.628a.333.333 0 0 1 .13-.64zM19.908 11h-2.575a.333.333 0 1 0 0 .667h2.575a.333.333 0 1 0 0-.667z"></path>
                                            <ellipse cx="10.833" cy="10.827" stroke="currentColor" rx="5.833"
                                                     ry="5.827"></ellipse>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Inbound', '00-06')">
                                        <div>00:00</div>
                                        <div>-</div>
                                        <div>06:00</div>
                                    </div>
                                </div>
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassInbound == 'Inbound-06-12') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill="none" fill-rule="evenodd">
                                            <path fill="currentColor" fill-rule="nonzero"
                                                  d="M1.333 11.667h2.575a.333.333 0 1 0 0-.667H1.333a.333.333 0 1 0 0 .667zM10.333 18.333v2.575a.333.333 0 1 0 .667 0v-2.575a.333.333 0 1 0-.667 0zM10.333 1.333v2.575a.333.333 0 1 0 .667 0V1.333a.333.333 0 1 0-.667 0zM2.459 7.023a.333.333 0 0 0-.25.618l1.49.602a.333.333 0 0 0 .248-.618L2.46 7.023zM7.204 3.34a.333.333 0 0 0-.613.261l.628 1.48a.333.333 0 0 0 .613-.262l-.628-1.478zM5.635 5.968a.332.332 0 0 0 .236-.569L3.569 3.098a.334.334 0 0 0-.471.47L5.399 5.87a.33.33 0 0 0 .236.099zM17.87 3.098a.334.334 0 0 0-.47 0l-2.302 2.3a.333.333 0 1 0 .471.471l2.302-2.3c.13-.13.13-.341 0-.471zM5.635 16a.332.332 0 0 1 .236.568L3.569 18.87a.334.334 0 0 1-.471-.47l2.301-2.302A.33.33 0 0 1 5.635 16zM17.87 18.87a.334.334 0 0 1-.47 0l-2.302-2.302a.333.333 0 1 1 .471-.47l2.302 2.3c.13.13.13.341 0 .471zM17.333 8.294a.327.327 0 0 0 .13-.027l1.48-.628a.333.333 0 0 0-.26-.613l-1.48.628a.333.333 0 0 0 .13.64zM13.15 5.197a.327.327 0 0 0 .073-.111l.603-1.49a.333.333 0 0 0-.617-.25l-.603 1.49a.333.333 0 0 0 .544.36zM7.204 19.08a.333.333 0 0 1-.613-.261l.628-1.478a.333.333 0 0 1 .613.262l-.628 1.478zM13.15 17.236c.03.03.056.067.073.11l.603 1.49a.333.333 0 0 1-.617.25l-.603-1.49a.333.333 0 0 1 .544-.36zM2.459 14.244a.333.333 0 0 1-.25-.618l1.49-.602a.333.333 0 0 1 .248.618l-1.488.602zM17.333 13c.043 0 .088.008.13.027l1.48.627a.333.333 0 0 1-.26.614l-1.48-.628a.333.333 0 0 1 .13-.64zM19.908 11h-2.575a.333.333 0 1 0 0 .667h2.575a.333.333 0 1 0 0-.667z"></path>
                                            <ellipse cx="10.833" cy="10.827" stroke="currentColor" rx="5.833"
                                                     ry="5.827"></ellipse>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Inbound', '06-12')">
                                        <div>06:00</div>
                                        <div>-</div>
                                        <div>12:00</div>
                                    </div>
                                </div>
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassInbound == 'Inbound-12-18') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill-rule="evenodd">
                                            <path fill-rule="nonzero"
                                                  d="M18.367 16.336c-.336.031-.68.047-1.026.047-3.434 0-6.497-1.444-8.193-3.864C6.91 9.326 7.284 5.02 8.58 2.37a.256.256 0 0 0-.054-.299.262.262 0 0 0-.304-.041c-.32.17-.624.353-.904.545a8.977 8.977 0 0 0-3.781 5.821 8.914 8.914 0 0 0 1.484 6.764 9.172 9.172 0 0 0 7.513 3.888 9.144 9.144 0 0 0 6.032-2.261.257.257 0 0 0 .067-.297.26.26 0 0 0-.265-.155z"></path>
                                            <path d="M13.167 4.216l-.168.967a.232.232 0 0 0 .337.242l.878-.456.878.457a.233.233 0 0 0 .244-.018.228.228 0 0 0 .092-.224l-.167-.968.71-.685a.228.228 0 0 0 .059-.236.231.231 0 0 0-.188-.156l-.98-.141-.44-.88c-.078-.157-.337-.157-.416 0l-.439.88-.98.14a.231.231 0 0 0-.188.157.228.228 0 0 0 .059.236l.709.685z"></path>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Inbound', '12-18')">
                                        <div>12:00</div>
                                        <div>-</div>
                                        <div>18:00</div>
                                    </div>
                                </div>
                                <div class="out-in-element" v-bind:class="{ 'filter-active': (ActiveFilterClassInbound == 'Inbound-18-24') }">
                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true"
                                         role="presentation" viewBox="0 0 22 22" preserveAspectRatio="xMidYMid meet"
                                         width="24px" height="24px" class="icon-out-in">
                                        <g fill="none" fill-rule="evenodd">
                                            <path fill-rule="nonzero" stroke="currentColor"
                                                  d="M18.367 16.336c-.336.031-.68.047-1.026.047-3.434 0-6.497-1.444-8.193-3.864C6.91 9.326 7.284 5.02 8.58 2.37a.256.256 0 0 0-.054-.299.262.262 0 0 0-.304-.041c-.32.17-.624.353-.904.545a8.977 8.977 0 0 0-3.781 5.821 8.914 8.914 0 0 0 1.484 6.764 9.172 9.172 0 0 0 7.513 3.888 9.144 9.144 0 0 0 6.032-2.261.257.257 0 0 0 .067-.297.26.26 0 0 0-.265-.155z"></path>
                                            <path fill="currentColor"
                                                  d="M13.167 4.216l-.168.967a.232.232 0 0 0 .337.242l.878-.456.878.457a.233.233 0 0 0 .244-.018.228.228 0 0 0 .092-.224l-.167-.968.71-.685a.228.228 0 0 0 .059-.236.231.231 0 0 0-.188-.156l-.98-.141-.44-.88c-.078-.157-.337-.157-.416 0l-.439.88-.98.14a.231.231 0 0 0-.188.157.228.228 0 0 0 .059.236l.709.685z"></path>
                                        </g>
                                    </svg>
                                    <div v-on:click="FilterByTime('Inbound', '18-24')">
                                        <div>18:00</div>
                                        <div>-</div>
                                        <div>24:00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <div class="filter-box-content">-->
<!--                            <div class="filter-box-heading" id="airport">-->
<!--                                <span class="airports">Airports</span>-->

<!--                                <div>-->
<!--                                    <button class="filter-rest">Reset</button>-->
<!--                                    <svg focusable="false" color="secondaryDark" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="10px" height="10px" class="sc-ckVGcZ oGVBx sc-kgoBCf MBqPu"><path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path></svg>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="filter-airport clearfix">-->
<!--                                <div class="filter-des-from mb-1">Depart from Dubai</div>-->
<!--                                <div class="filter-airport-check"><input  type="checkbox"><label class="form-check-label" for="1">DXB: Dubai International Airport</label></div>-->
<!--                                <div class="filter-airport-check"><input  type="checkbox"><label class="form-check-label ">XNB: Dubai, United Arab Emirates (XNB-Dubai Bus Station)</label></div>-->
<!--                                <div class="filter-des-in mt-4 mb-1">Arrive in Lahore</div>-->
<!--                                <div class="filter-airport-check"><input type="checkbox"><label class="form-check-label" for="1">LHE: Allama Iqbal International Airport</label></div>-->
<!--                                <div class="filter-des-from mt-4">Depart from Lahore</div>-->
<!--                                <div class="filter-airport-check"><input type="checkbox"><label class="form-check-label" for="1">LHE: Allama Iqbal International Airport</label></div>-->
<!--                                <div class="filter-des-in mt-4 mb-1">Arrive in Dubai</div>-->
<!--                                <div class="filter-airport-check"><input  type="checkbox"><label class="form-check-label" for="1">DXB: Dubai International Airport</label></div>-->
<!--                                <div class="filter-airport-check"><input  type="checkbox"><label class="form-check-label ">XNB: Dubai, United Arab Emirates (XNB-Dubai Bus Station)</label></div>-->

<!--                            </div>-->

<!--                        </div>-->
                        <div class="filter-box-content">
                            <div class="filter-box-heading">
                                <span class="airports">Airlines</span>
                                <div>
                                    <button class="filter-rest" v-on:click="ResetFilters('Airline')">Reset</button>
                                    <svg v-on:click="FiltersDisplayHandler('Airline')"
                                         focusable="false"
                                         color="secondaryDark"
                                         fill="currentcolor"
                                         aria-hidden="true"
                                         role="presentation"
                                         viewBox="0 0 150 150"
                                         preserveAspectRatio="xMidYMid meet"
                                         width="10px" height="10px"
                                         class="sc-ckVGcZ oGVBx sc-kgoBCf MBqPu">
                                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="filter-airline clearfix" v-show="DivDisplay.Airline">
                                <div class="filter-des-from mb-1">Depart from <span v-text="Origin"/></div>
                                <div class="filter-airline-check" v-for="Carrier in Carriers">
                                    <input v-model="FSelectedCarrier" v-bind:value="Carrier.CarrierCode" type="checkbox" v-bind:id="Carrier.CarrierCode">
                                    <label v-bind:for="Carrier.CarrierCode">
                                        <span v-text="Carrier.CarrierCode"/>: <span v-text="Carrier.CarrierName"/>
                                    </label>
                                </div>
                            </div>
<!--                            <div class="filter-airline clearfix">-->
<!--                                <div class="filter-des-from mb-1">Depart from Lahore</div>-->
<!--                                <div class="filter-airline-check"><input  type="checkbox" ><label>EK: Emirates</label></div>-->
<!--                                <div class="filter-airline-check"><input  type="checkbox" ><label>EY: Etihad Airways</label></div>-->
<!--                                <div class="filter-airline-check"><input  type="checkbox" ><label>WY: Oman Air</label></div>-->
<!--                            </div>-->
                        </div>
                    </aside>
                </div>

                <div class="col-md-9">
                    <div class="modify">
                        <div class="d-flex">
                            <div class="search-region">
                                <strong v-text="OriginCode"></strong>
                                <p v-text="Origin"></p>
                            </div>
                            <div class="origen-img">
                                <i class="fas fa-exchange-alt text-muted"></i>
                            </div>
                            <div class="search-dest">
                                <strong v-text="DestinationCode"></strong>
                                <p v-text="Destination"></p>
                            </div>
                            <div class="modify-depart">
                                <span>Departure</span>
                                <p v-text="DepartureDate"></p>
                            </div>
                            <div class="modify-return">
                                <span>Return</span>
                                <p v-text="ArrivalDate"></p>
                            </div>
                            <div class="modify-pass">
                                <span>Passenger</span>
                                <p v-text="Travler.Total"></p>
                            </div>
                            <div class="modify-cabin">
                                <span>Cabin</span>
                                <p v-text="CabinClass"></p>
                            </div>
                            <button class="btn-modify inside-alert float-right">Modify search</button>
                        </div>
                    </div>


                    <!-- filter -->
                    <div class="filter-result">
                        <div class="row">
                            <div class="col-md-6">
                                <span v-text="TotalFlights+' Flights Found'"/>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-default btn-sm mb-2 float-right" data-toggle="modal" data-target="#mailToModal">Send Email Itinerary [{{MailToTrips.length}}]</button>
                            </div>
                        </div>
                    </div>

                    <div class="flight-itinerary" v-for="(Itinerary, flightIndex) in flights" v-bind:key="flightIndex">
                        <div class="filght-detail">
                            <div class="row">
                                <div class="col-md-8 align-self-center">

                                    <div class="flight-segment" v-for="AirLeg in Itinerary.FlightOptionsList.FlightOption">
                                        <div class="row align-items-center">
                                            <div class="col-md-3 pl-0">
                                                <div class="flight-img-name">
                                                    <img v-bind:src="GetCarrierImage(AirLeg.Option[0].Carrier)" alt="Airline" class="img-airline"/>
                                                    <div>
                                                        <span class="flight-name" v-text="GetCarrierName(AirLeg.Option[0].Carrier)"></span>
                                                        <span class="flight-code d-block" v-text="GetCarrierCode(AirLeg.Option[0].Carrier)"></span>
                                                        <span class="flight-code d-block" v-text="Itinerary.AirPricePointList.AirPricingInfo[0].FareDetails[0].CabinClass"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 pl-0">
                                                <div class="d-flex">
                                                    <div class="pr-4">
                                                        <div class="depart-time" v-text="AirLeg.Option[0].FlightLabelInfo.DepartureTime"></div>
                                                        <div class="depart-from" v-text="AirLeg.Origin"></div>
                                                    </div>
                                                    <div class="flight-duration">
                                                        <span class="text-direct" v-text="GetFlightType(AirLeg.Option[0].FlightLabelInfo)"></span>
                                                        <div class="line-dashed"></div>
                                                        <div class="plane">
                                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 16 16" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="sc-rBLzX jUAMsh sc-kgoBCf bZoWtY">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <path d="M0 0h16v16H0z"></path>
                                                                    <path fill="currentcolor" d="M8.002 13.429h.42c.557 0 1.009-.44 1.009-.572v.572c0-.316-.44-.572-1.003-.572h-.14l1.714-1.714h.14c.554 0 1.003-.439 1.003-.572v.572c0-.316-.449-.572-.857-.572l1.143-1.428c0-.286.857-.288.857-.288s1.43.028 2.287.002C15.432 8.883 16 8.286 16 8c.003-.286-.568-.857-1.425-.857h-2.287s-.857 0-.857-.286L10.288 5.43c.012 0 0 0 0 0 .473 0 .857-.44.857-.572v.572c0-.316-.438-.572-1.003-.572h-.14L8.287 3.143h.14c.555 0 1.004-.439 1.004-.572v.572c0-.316-.444-.572-.992-.572h-.46L6.253.534S5.895 0 5.39 0l-.441.029s.482.828 1.625 3.4C7.716 6 7.716 6 7.716 6.857l-.572.286H4.572c0 .055-.285 0-1.428.286L1.453 5.547S.857 4.857 0 4.857l1.429 2.857L0 8l1.429.286L0 11.143c.857 0 1.363-.44 1.363-.44l1.78-2.132c1.144.286 1.43.286 1.43.286h2.571l.572.286c0 .857 0 .857-1.143 3.428C5.43 15.143 4.977 16 4.977 16h.412s.516-.108.863-.506l1.75-2.065z"></path>
                                                                </g>
                                                            </svg>
                                                        </div>

                                                        <span class="flight-duration-time">Flight duration: <span v-text="AirLeg.Option[0].FlightLabelInfo.Duration"/></span>
                                                    </div>
                                                    <div class="pl-4">
                                                        <div class="arival-time" v-text="AirLeg.Option[0].FlightLabelInfo.ArrivalTime"></div>
                                                        <div class="arival-from" v-text="AirLeg.Destination"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex btn-baggage-box">
                                        <div class="flight-bag align-self-end text-right">
                                            <button v-on:click="PopulateSelectedFlight(flightIndex)" class="d-inline-block mb-3 flight-detail-btn">Flight details</button>
                                            <span>
                                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="10px" height="10px" class="sc-ckVGcZ sc-iFMziU cQzbRn sc-kgoBCf kPCxEb">
                                                    <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                                </svg>
                                            </span>
                                            <div class="baggage-inc mt-4 mb-3" data-toggle="baggage" title="Hooray!">
                                                <span>
                                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 16 16" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="sc-kgoBCf kPCxEb">
                                                        <path d="M12.9 6.36H12.9l-5.654 5.655a.74.74 0 0 1-1.046 0l-3.067-3.07A1.12 1.12 0 1 1 4.714 7.36L6.723 9.37l4.593-4.593A1.12 1.12 0 0 1 12.9 6.36m3.092 1.28a8 8 0 1 0-15.983.72 8 8 0 0 0 15.983-.72"></path>
                                                    </svg>
                                                </span>
                                                Baggage included
                                            </div>
                                        </div>
                                        <div class="select-flight ml-auto">
                                            <div class="cur text-right"><span v-text="Currency"/></div>
                                            <div class="price text-right"><span v-text="Itinerary.TotalPrice"/></div>
                                            <button class="btn-select" v-if="(ItnieraryInCarts.includes(Itinerary.RecommendationKey))" v-bind:class="{active: (ItnieraryInCarts.includes(Itinerary.RecommendationKey))}">
                                                Saved
                                            </button>
                                            <button class="btn-select" v-else v-bind:class="{active: (ItnieraryInCarts.includes(Itinerary.RecommendationKey))}" v-on:click="TripSave(Itinerary)">Save Trip</button>
                                            <p class="email-trip">
                                                <input type="checkbox" v-bind:id="'email-trip-'+flightIndex" v-on:click="TripToMailSave(Itinerary)"> <label class="email-trip" v-bind:for="'email-trip-'+flightIndex">Email Trip</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div v-show="Selectedflight == flightIndex" class="col-md-12 flight-detail">
                                    <div class="flight-detail-top">
                                        <button class="btn-flight-detail" v-bind:class="{ active: IsActive('ItineraryInfo') }" v-on:click="FlightDetailChildTab = 'ItineraryInfo'">Flight itinerary</button>
                                        <button class="btn-flight-detail" v-bind:class="{ active: IsActive('BaggageInfo') }" v-on:click="FlightDetailChildTab = 'BaggageInfo'">Baggage info</button>
                                        <button class="btn-flight-detail" v-bind:class="{ active: IsActive('FareRulesInfo') }" v-on:click="FlightDetailChildTab = 'FareRulesInfo'" v-show="Policies.fareBreakdownFlag">Fare summary & rules</button>
                                    </div>

                                    <div class="px-3" v-for="AirLeg in Itinerary.FlightOptionsList.FlightOption">
                                        <div v-bind:class="{ active: IsActive('ItineraryInfo') }" v-show="FlightDetailChildTab == 'ItineraryInfo'">
                                            <div class="FlightSearchResult">
                                                <div class="d-flex align-items-center">
                                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 20 20" preserveAspectRatio="xMidYMid meet" size="20" width="20" height="20" class="sc-kgoBCf gDXyiS">
                                                        <path fill="currentColor" fill-rule="evenodd" d="M1.612 9.202l.593-.208L.172 5.543a.478.478 0 0 1-.039-.402.466.466 0 0 1 .283-.284l.64-.228a.463.463 0 0 1 .425.062l3.285 2.37 9.782-3.482c1.789-.637 2.13-.622 2.623-.537.14.024.273.047.52.039.74-.028 1.29.042 1.68.214.386.17.537.406.596.574.077.218.18.982-1.704 1.685L13.3 7.33l-4.293 3.424a.376.376 0 0 1-.107.06l-1.357.483a.377.377 0 0 1-.436-.143.386.386 0 0 1 .017-.462l1.48-1.82-6.753 1.24a.468.468 0 0 1-.535-.344.472.472 0 0 1 .296-.566zM0 17v-1.255h19.545V17H0z"></path>
                                                    </svg>
                                                    <div class="mx-3 depart">
                                                        Departure, <span v-text="AirLeg.Option[0].FlightLabelInfo.Origin.AirportName"/>
                                                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 9 13" preserveAspectRatio="xMidYMid meet" size="15" width="15" height="15" class="sc-iAyFgw sc-hzDEsm ePIPIe sc-kgoBCf dNupwy">
                                                            <path d="M8.865 4.243c.18.183.18.472 0 .655a.45.45 0 0 1-.639 0L4.955 1.575v10.966c0 .256-.2.459-.452.459a.458.458 0 0 1-.458-.459V1.575L.78 4.898a.458.458 0 0 1-.645 0 .464.464 0 0 1 0-.655L4.181.133a.45.45 0 0 1 .639 0l4.045 4.11z"></path>
                                                        </svg>
                                                        Arrival, <span v-text="AirLeg.Option[0].FlightLabelInfo.Destination.AirportName"/>
                                                    </div>
                                                </div>
                                                <div class="durantion-time">Total duration <span v-text="AirLeg.Option[0].FlightLabelInfo.Duration"/></div>
                                            </div>
                                            <div class="pt-4" v-for="(BookingInfo, BookingInfoIndex) in AirLeg.Option[0].BookingInfo">
                                                <div class="mb-4">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-3">
                                                            <div class="aircraft-det">
                                                                <img v-bind:src="GetCarrierImage(BookingInfo.Segment.Carrier)" alt="Airline" width="40px" class="img-airline"/>
                                                                <div>
                                                                    <div v-text="BookingInfo.Segment.CarrierName"/>
                                                                    <div v-text="BookingInfo.Segment.Carrier+'-'+BookingInfo.Segment.FlightNumber"/>
                                                                    <div>Equipment - <span v-text="BookingInfo.Segment.Equipment"/></div>
                                                                    <div><span v-text="Itinerary.AirPricePointList.AirPricingInfo[0].FareDetails[0].CabinClass"/></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="Flight-itinerary-orign">
                                                                <div><span v-text="BookingInfo.Segment.Origin"/> <strong v-text="GetFlightTime(BookingInfo.Segment.DepartureTime)"/></div>
                                                                <span v-text="getDateLabel(BookingInfo.Segment.DepartureTime)"/>
                                                                <div class="Flight-itinerary-orign-airp" v-text="BookingInfo.Segment.OriginDetail.Name"/>
                                                                <p><span v-text="BookingInfo.Segment.OriginDetail.City"/>, <span v-text="BookingInfo.Segment.OriginDetail.Country"/></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="Flight-itinerary-dest">
                                                                <div><span v-text="BookingInfo.Segment.Destination"/><strong v-text="GetFlightTime(BookingInfo.Segment.ArrivalTime)"/></div>
                                                                <span v-text="getDateLabel(BookingInfo.Segment.ArrivalTime)"/>
                                                                <div class="Flight-itinerary-orign-airp" v-text="BookingInfo.Segment.DestinationDetail.Name"/>
                                                                <p><span v-text="BookingInfo.Segment.DestinationDetail.City"/>, <span v-text="BookingInfo.Segment.DestinationDetail.Country"/></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="Flight-itinerary-dur">
                                                                <span v-text="GetFlightDuration(BookingInfo.Segment)"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="AirLeg.Option[0].BookingInfo[BookingInfoIndex+1] != undefined">
                                                    <div class="waiting-time">
                                                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 16 16" preserveAspectRatio="xMidYMid meet" size="16" width="16" height="16" class="sc-kgoBCf hDGZbe"><path id="a" d="M8 0C3.578 0 0 3.578 0 8c0 4.422 3.578 8 8 8 4.422 0 8-3.578 8-8 0-4.422-3.578-8-8-8zm0 14.933A6.941 6.941 0 0 1 1.067 8 6.941 6.941 0 0 1 8 1.067 6.941 6.941 0 0 1 14.933 8 6.941 6.941 0 0 1 8 14.933zm1.81-7.43H8.067v-2.97a.533.533 0 0 0-1.067 0v3.504c0 .295.239.533.533.533H9.81a.533.533 0 0 0 0-1.066z"></path><g fill="none" fill-rule="evenodd"><path d="M0 0h16v16H0z"></path><mask id="b" fill="#fff"><use xlink="#a"></use></mask><use fill="currentColor" fill-rule="nonzero"></use><g fill="none" mask="url(#b)"><path d="M0 0h16v16H0z"></path></g></g></svg>
                                                        Waiting time in <span v-text="BookingInfo.Segment.Destination"/>, <span v-text="BookingInfo.Segment.DestinationDetail.Name"/> <span class="float-right font-weight-bold" v-text="TransitDelay(BookingInfo.Segment.ArrivalTime, AirLeg.Option[0].BookingInfo[BookingInfoIndex+1].Segment.DepartureTime)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-bind:class="{ active: IsActive('BaggageInfo') }" v-show="FlightDetailChildTab == 'BaggageInfo'">
                                            <div class="m-4" v-for="(RefOfLeg, RefOfLegIndex) in AirLeg.Option[0].FareInfo.RequestedSegmentRef">
                                                <div class="baggage-origin-dest">
                                                    <strong>
                                                        <span v-text="AirLeg.Option[0].BookingInfo[RefOfLegIndex].Segment.Origin"/> - <span v-text="AirLeg.Option[0].BookingInfo[RefOfLegIndex].Segment.Destination"/>
                                                    </strong>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="cabin-baggage">
                                                            <div class="baggage-for">Cabin baggage</div>
                                                            <div class="max-baggage">
                                                                <div class="wait">7 KG (max 1 piece)</div><div class="freetag">FREE</div>
                                                            </div>
                                                        </div>
                                                        <div class="checked-baggage">
                                                            <div class="baggage-for"> Checked baggage</div>
                                                            <div class="max-baggage">
                                                                <div class="wait">
                                                                    <span v-text="AirLeg.Option[0].FareInfo.FreeBaggageAllowance.freeAllowance"/>
                                                                    <span v-if="AirLeg.Option[0].FareInfo.FreeBaggageAllowance.quantityCode == 'N'">PIECES</span>
                                                                    <span v-if="AirLeg.Option[0].FareInfo.FreeBaggageAllowance.freeAllowance == 'W'">KG Weight</span>
                                                                </div>
                                                                <div class="freetag">FREE</div>
                                                            </div>
                                                        </div>
<!--                                                        <div>-->
<!--                                                            Key: <span v-text="AirLeg.Option[0].FareInfo.Key"/><br />-->
<!--                                                            RequestedSegmentRef: <span v-text="AirLeg.Option[0].FareInfo.RequestedSegmentRef"/><br />-->
<!--                                                            serviceFeesType: <span v-text="AirLeg.Option[0].FareInfo.serviceFeesType"/><br />-->
<!--                                                            PassengerRef: <span v-text="AirLeg.Option[0].FareInfo.PassengerRef"/><br />-->
<!--                                                            RefOfLeg: <span v-text="AirLeg.Option[0].FareInfo.RefOfLeg"/><br />-->
<!--                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-bind:class="{ active: IsActive('FareRulesInfo') }" v-show="FlightDetailChildTab == 'FareRulesInfo'">
                                        <corporate-fare-summary v-bind:Itinerary="Itinerary"></corporate-fare-summary>
                                    </div>

                                    <div class="flight-detail-bottom">
                                        <button class="btn-hide-detail" v-on:click="Selectedflight = -1">Hide details</button>
                                        <button class="btn-select">Save Trip <span v-text="Currency +' '+ Itinerary.TotalPrice"/>
                                            <span>
                                        <svg class="svgDown" focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10">
                                            <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                        </svg>
                                    </span>
                                        </button>
                                    </div>
                                </div> <!--/. flight-detail -->
                            </div>
                        </div> <!--/. flight-detail -->



                        <!-- More Options -->
                        <div v-show="MoreflightOptions == flightIndex" class="filght-detail more-options">
                            <div class="row flight-option" v-for="(OptionNumber, OptionIndex) in Itinerary.FlightOptionsList.FlightOption[0].Option.length - 1">
                                <div class="col-md-8 align-self-center" v-for="(AirLegNumber, AirLegIndex) in Itinerary.FlightOptionsList.FlightOption.length">
                                    <div class="flight-segment">
                                        <div class="row align-items-center">
                                            <div class="col-md-3 pl-0">
                                                <div class="flight-img-name">
                                                    <img v-bind:src="GetCarrierImage(Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].Carrier)" alt="Airline" class="img-airline"/>
                                                    <div>
                                                        <span class="flight-name" v-text="GetCarrierName(Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].Carrier)"></span>
                                                        <span class="flight-code d-block" v-text="GetCarrierCode(Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].Carrier)"></span>
                                                        <span class="flight-code d-block" v-text="Itinerary.AirPricePointList.AirPricingInfo[0].FareDetails[0].CabinClass"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 pl-0">
                                                <div class="d-flex">
                                                    <div class="pr-4">
                                                        <div class="depart-time" v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.DepartureTime"></div>
                                                        <div class="depart-from" v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.Origin.Code"></div>
                                                    </div>
                                                    <div class="flight-duration">
                                                        <span class="text-direct" v-text="GetFlightType(Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo)"></span>
                                                        <div class="line-dashed"></div>
                                                        <div class="plane">
                                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 16 16" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="sc-rBLzX jUAMsh sc-kgoBCf bZoWtY">
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <path d="M0 0h16v16H0z"></path>
                                                                    <path fill="currentcolor" d="M8.002 13.429h.42c.557 0 1.009-.44 1.009-.572v.572c0-.316-.44-.572-1.003-.572h-.14l1.714-1.714h.14c.554 0 1.003-.439 1.003-.572v.572c0-.316-.449-.572-.857-.572l1.143-1.428c0-.286.857-.288.857-.288s1.43.028 2.287.002C15.432 8.883 16 8.286 16 8c.003-.286-.568-.857-1.425-.857h-2.287s-.857 0-.857-.286L10.288 5.43c.012 0 0 0 0 0 .473 0 .857-.44.857-.572v.572c0-.316-.438-.572-1.003-.572h-.14L8.287 3.143h.14c.555 0 1.004-.439 1.004-.572v.572c0-.316-.444-.572-.992-.572h-.46L6.253.534S5.895 0 5.39 0l-.441.029s.482.828 1.625 3.4C7.716 6 7.716 6 7.716 6.857l-.572.286H4.572c0 .055-.285 0-1.428.286L1.453 5.547S.857 4.857 0 4.857l1.429 2.857L0 8l1.429.286L0 11.143c.857 0 1.363-.44 1.363-.44l1.78-2.132c1.144.286 1.43.286 1.43.286h2.571l.572.286c0 .857 0 .857-1.143 3.428C5.43 15.143 4.977 16 4.977 16h.412s.516-.108.863-.506l1.75-2.065z"></path>
                                                                </g>
                                                            </svg>
                                                        </div>

                                                        <span class="flight-duration-time">Flight duration: <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.Duration"/></span>
                                                    </div>
                                                    <div class="pl-4">
                                                        <div class="arival-time" v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.ArrivalTime"></div>
                                                        <div class="arival-from" v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.Destination.Code"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex btn-baggage-box">
                                        <div class="flight-bag align-self-end text-right">
                                            <button v-on:click="PopulateSelectedMoreflightOptionFlightDetail('I'+flightIndex+'O'+OptionIndex)" class="d-inline-block mb-3 flight-detail-btn">Flight details</button>
                                            <span>
                                                <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="10px" height="10px" class="sc-ckVGcZ sc-iFMziU cQzbRn sc-kgoBCf kPCxEb">
                                                    <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                                </svg>
                                            </span>
                                            <div class="baggage-inc mt-4 mb-3" data-toggle="baggage" title="Hooray!">
                                                <span>
                                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 16 16" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="sc-kgoBCf kPCxEb">
                                                        <path d="M12.9 6.36H12.9l-5.654 5.655a.74.74 0 0 1-1.046 0l-3.067-3.07A1.12 1.12 0 1 1 4.714 7.36L6.723 9.37l4.593-4.593A1.12 1.12 0 0 1 12.9 6.36m3.092 1.28a8 8 0 1 0-15.983.72 8 8 0 0 0 15.983-.72"></path>
                                                    </svg>
                                                </span>
                                                Baggage included
                                            </div>
                                        </div>
                                        <div class="select-flight ml-auto">
                                            <div class="cur text-right"><span v-text="Currency"/></div>
                                            <div class="price text-right"><span v-text="Itinerary.TotalPrice"/></div>
                                            <button class="btn-select">
                                                Save Trip
                                                <span>
                                                    <svg class="svgDown" focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10">
                                                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div v-show="MoreflightOptionFlightDetail == 'I'+flightIndex+'O'+OptionIndex" class="col-md-12 flight-detail more-option-detail">
                                    <div class="flight-detail-top">
                                        <button class="btn-flight-detail" v-bind:class="{ active: IsActive('ItineraryInfo') }" v-on:click="FlightDetailChildTab = 'ItineraryInfo'">Flight itinerary</button>
                                        <button class="btn-flight-detail" v-bind:class="{ active: IsActive('BaggageInfo') }" v-on:click="FlightDetailChildTab = 'BaggageInfo'">Baggage info</button>
                                        <button class="btn-flight-detail" v-bind:class="{ active: IsActive('FareRulesInfo') }" v-on:click="FlightDetailChildTab = 'FareRulesInfo'" v-show="Policies.fareBreakdownFlag">Fare summary & rules</button>
                                    </div>

                                    <div class="px-3">
                                        <div id="flight-more-option-itinerary" class="active" v-for="(AirLegNumber, AirLegIndex) in Itinerary.FlightOptionsList.FlightOption.length">
                                            <div class="FlightSearchResult">
                                                <div class="d-flex align-items-center">
                                                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 20 20" preserveAspectRatio="xMidYMid meet" size="20" width="20" height="20" class="sc-kgoBCf gDXyiS">
                                                        <path fill="currentColor" fill-rule="evenodd" d="M1.612 9.202l.593-.208L.172 5.543a.478.478 0 0 1-.039-.402.466.466 0 0 1 .283-.284l.64-.228a.463.463 0 0 1 .425.062l3.285 2.37 9.782-3.482c1.789-.637 2.13-.622 2.623-.537.14.024.273.047.52.039.74-.028 1.29.042 1.68.214.386.17.537.406.596.574.077.218.18.982-1.704 1.685L13.3 7.33l-4.293 3.424a.376.376 0 0 1-.107.06l-1.357.483a.377.377 0 0 1-.436-.143.386.386 0 0 1 .017-.462l1.48-1.82-6.753 1.24a.468.468 0 0 1-.535-.344.472.472 0 0 1 .296-.566zM0 17v-1.255h19.545V17H0z"></path>
                                                    </svg>
                                                    <div class="mx-3 depart">
                                                        Departure, <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.Origin.AirportName"/>
                                                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 9 13" preserveAspectRatio="xMidYMid meet" size="15" width="15" height="15" class="sc-iAyFgw sc-hzDEsm ePIPIe sc-kgoBCf dNupwy">
                                                            <path d="M8.865 4.243c.18.183.18.472 0 .655a.45.45 0 0 1-.639 0L4.955 1.575v10.966c0 .256-.2.459-.452.459a.458.458 0 0 1-.458-.459V1.575L.78 4.898a.458.458 0 0 1-.645 0 .464.464 0 0 1 0-.655L4.181.133a.45.45 0 0 1 .639 0l4.045 4.11z"></path>
                                                        </svg>
                                                        Arrival, <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.Destination.AirportName"/>
                                                    </div>
                                                </div>
                                                <div class="durantion-time">Total duration <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FlightLabelInfo.Duration"/></div>
                                            </div>
                                            <div class="pt-4" v-bind:class="{ active: IsActive('ItineraryInfo') }" v-show="FlightDetailChildTab == 'ItineraryInfo'" v-for="(BookingInfo, BookingInfoIndex) in Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].BookingInfo">
                                                <div class="mb-4">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-3">
                                                            <div class="aircraft-det">
                                                                <img v-bind:src="GetCarrierImage(BookingInfo.Segment.Carrier)" alt="Airline" width="40px" class="img-airline"/>
                                                                <div>
                                                                    <div v-text="BookingInfo.Segment.CarrierName"/>
                                                                    <div v-text="BookingInfo.Segment.Carrier+'-'+BookingInfo.Segment.FlightNumber"/>
                                                                    <div>Equipment - <span v-text="BookingInfo.Segment.Equipment"/></div>
                                                                    <div><span v-text="Itinerary.AirPricePointList.AirPricingInfo[0].FareDetails[0].CabinClass"/> class</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="Flight-itinerary-orign">
                                                                <div><span v-text="BookingInfo.Segment.Origin"/> <strong v-text="GetFlightTime(BookingInfo.Segment.DepartureTime)"/></div>
                                                                <span v-text="getDateLabel(BookingInfo.Segment.DepartureTime)"/>
                                                                <div class="Flight-itinerary-orign-airp" v-text="BookingInfo.Segment.OriginDetail.Name"/>
                                                                <p><span v-text="BookingInfo.Segment.OriginDetail.City"/>, <span v-text="BookingInfo.Segment.OriginDetail.Country"/></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="Flight-itinerary-dest">
                                                                <div><span v-text="BookingInfo.Segment.Destination"/><strong v-text="GetFlightTime(BookingInfo.Segment.ArrivalTime)"/></div>
                                                                <span v-text="getDateLabel(BookingInfo.Segment.ArrivalTime)"/>
                                                                <div class="Flight-itinerary-orign-airp" v-text="BookingInfo.Segment.DestinationDetail.Name"/>
                                                                <p><span v-text="BookingInfo.Segment.DestinationDetail.City"/>, <span v-text="BookingInfo.Segment.DestinationDetail.Country"/></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="Flight-itinerary-dur">
                                                                <span v-text="GetFlightDuration(BookingInfo.Segment)"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-if="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].BookingInfo[BookingInfoIndex+1] != undefined">
                                                    <div class="waiting-time">
                                                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 16 16" preserveAspectRatio="xMidYMid meet" size="16" width="16" height="16" class="sc-kgoBCf hDGZbe"><path id="a" d="M8 0C3.578 0 0 3.578 0 8c0 4.422 3.578 8 8 8 4.422 0 8-3.578 8-8 0-4.422-3.578-8-8-8zm0 14.933A6.941 6.941 0 0 1 1.067 8 6.941 6.941 0 0 1 8 1.067 6.941 6.941 0 0 1 14.933 8 6.941 6.941 0 0 1 8 14.933zm1.81-7.43H8.067v-2.97a.533.533 0 0 0-1.067 0v3.504c0 .295.239.533.533.533H9.81a.533.533 0 0 0 0-1.066z"></path><g fill="none" fill-rule="evenodd"><path d="M0 0h16v16H0z"></path><mask id="b" fill="#fff"><use xlink="#a"></use></mask><use fill="currentColor" fill-rule="nonzero"></use><g fill="none" mask="url(#b)"><path d="M0 0h16v16H0z"></path></g></g></svg>
                                                        Waiting time in <span v-text="BookingInfo.Segment.Destination"/>, <span v-text="BookingInfo.Segment.DestinationDetail.Name"/> <span class="float-right font-weight-bold" v-text="TransitDelay(BookingInfo.Segment.ArrivalTime, Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].BookingInfo[BookingInfoIndex+1].Segment.DepartureTime)"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-bind:class="{ active: IsActive('BaggageInfo') }" v-show="FlightDetailChildTab == 'BaggageInfo'" id="flight-more-option-baggage-info">

                                                <div class="m-4" v-for="(RefOfLeg, RefOfLegIndex) in Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FareInfo.RequestedSegmentRef">
                                                    <div class="baggage-origin-dest">
                                                        <strong>
                                                            <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].BookingInfo[RefOfLegIndex].Segment.Origin"/> - <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].BookingInfo[RefOfLegIndex].Segment.Destination"/>
                                                        </strong>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="cabin-baggage">
                                                                <div class="baggage-for">Cabin baggage</div>
                                                                <div class="max-baggage">
                                                                    <div class="wait">7 KG (max 1 piece)</div><div class="freetag">FREE</div>
                                                                </div>
                                                            </div>
                                                            <div class="checked-baggage">
                                                                <div class="baggage-for"> Checked baggage</div>
                                                                <div class="max-baggage">
                                                                    <div class="wait">
                                                                        <span v-text="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FareInfo.FreeBaggageAllowance.freeAllowance"/>
                                                                        <span v-if="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FareInfo.FreeBaggageAllowance.quantityCode == 'N'">PIECES</span>
                                                                        <span v-if="Itinerary.FlightOptionsList.FlightOption[AirLegIndex].Option[OptionIndex].FareInfo.FreeBaggageAllowance.freeAllowance == 'W'">KG Weight</span>
                                                                    </div>
                                                                    <div class="freetag">FREE</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div v-bind:class="{ active: IsActive('FareRulesInfo') }" v-show="FlightDetailChildTab == 'FareRulesInfo'" id="flight-more-option-fare-rules">
                                                <corporate-fare-summary v-bind:Itinerary="Itinerary"></corporate-fare-summary>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flight-detail-bottom">
                                        <button class="btn-hide-detail" v-on:click="MoreflightOptionFlightDetail = -1">Hide details</button>
                                        <button class="btn-select">Save Trip <span v-text="Currency +' '+ Itinerary.TotalPrice"/>
                                            <span>
                                            <svg class="svgDown" focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10">
                                                <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                                            </svg>
                                        </span>
                                        </button>
                                    </div>
                                </div> <!--/. flight-detail -->

                            </div> <!--/. row -->
                        </div> <!--/. flight-detail -->

                        <button class="ShowMoreButton">
                            <div v-show="Itinerary.FlightOptionsList.FlightOption[0].Option.length - 1 > 0" v-on:click="ShowMoreflightOptions(flightIndex)">
                                <div class="sc-eilVRo fhKRnQ"><div></div></div>
                                    Show <span v-text="Itinerary.FlightOptionsList.FlightOption[0].Option.length - 1"/> more flight timing options for the same price
                                <div class="sc-eilVRo koPXNF"><div></div></div>
                            </div>
                        </button>
                    </div> <!-- flight itinerary -->

                </div>
            </div>

            <!-- Fare family modal box -->
            <div class="modal" id="fareFamilyModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Fare details for {{ FareFamilyDetail.Carrier }}</h5>
                        </div>
                        <div class="modal-body">

                            <div class="accordion" id="accordionFareRule">
                                <div class="card" v-for="(Rule, RuleIndex) in FareFamilyDetail.Data">
                                    <div class="card-header" :id="'heading-'+RuleIndex">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" :data-target="'#collapse-'+RuleIndex" aria-expanded="true" :aria-controls="'collapse-'+RuleIndex">
                                                {{ Rule.Title }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div :id="'collapse-'+RuleIndex" class="collapse" v-bind:class="{show: RuleIndex == 0}" :aria-labelledby="'heading-'+RuleIndex" data-parent="#accordionFareRule">
                                        <div class="card-body">
                                            <div class="description" v-html="Rule.Description"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import CorporateFareSummary from "./CorporateFareSummary"

    export default {
        props: ['payload'],
        component: { CorporateFareSummary },
        data() {
            return {
                base_url: "",
                flightSearchRequest: {},
                flights: [],
                Origin: "",
                OriginCode: "",
                Destination: "",
                DestinationCode: "",
                DepartureDate: "",
                ArrivalDate: "",
                Travler: {},
                TotalFlights: 0,
                Carriers: [],
                CabinClass: "",
                showFlightOption: false,
                responseMessage: "",
                TripType: "",
                Currency: "",
                _flights: [],
                Selectedflight: -1,
                FSelectedCarrier: [],
                DirectOrStopFlihgt: [],
                MoreflightOptions: -1,
                MoreflightOptionFlightDetail: -1,
                FlightDetailChildTab: 'ItineraryInfo',
                ActiveFilterClassLeg: "",
                ActiveFilterClassOutbound: "",
                ActiveFilterClassInbound: "",
                FCarriers: [],
                PriceSliderOption: {
                    start: 0,
                    step: 100,
                    range: {
                        min: 0,
                        max: 0
                    }
                },
                FTotalPrice: -1,
                SavedTrips: [],
                MailToTrips: [],
                MailTo: {},
                TripNumber: "",
                TripName: "",
                ItnieraryInCarts: [],
                Trip: {},
                FamilyInformation: [],
                FareFamilyDetail: {
                    Carrier: "",
                    Data: []
                },
                DivDisplay: {
                    Airline: true,
                    PriceRange: true,
                    Layovers: true,
                    Departure: true,
                    Arrival: true
                },
                Policies: {
                    fareBreakdownFlag: 0
                }
            }
        },
        mounted() {
            console.log('Corporate flight listing component mounted.');

            this.base_url = base_url;

            axios.get(base_url + 'corporate/search_flight', {
                params: JSON.parse(this.payload)
            })
            .then((res) => {
                this.$parent.loader = false;

                if (res.data.response.status !== "ERR") {
                    let flightSearchRequest = res.data.request;
                    this.FamilyInformation = res.data.familyInformation;
                    this.flightSearchRequest = flightSearchRequest;
                    this.Origin = flightSearchRequest.Origin.Name;
                    this.OriginCode = flightSearchRequest.Origin.Code;
                    this.Destination = flightSearchRequest.Destination.Name;
                    this.DestinationCode = flightSearchRequest.Destination.Code;
                    this.DepartureDate = flightSearchRequest.Departure.dateString;
                    this.ArrivalDate = flightSearchRequest.Arrival.dateString;
                    this.Travler = flightSearchRequest.Travler;
                    this.CabinClass = flightSearchRequest.CabinClass;
                    this.TripType = flightSearchRequest.TripType;
                    this.Trip = res.data.trip;
                    this.Policies = res.data.policies;

                    this.flights = res.data.response.original.data;
                    this._flights = res.data.response.original.data;
                    this.TotalFlights = res.data.response.original.totalFlights;
                    this.Carriers = res.data.response.original.carriers;
                    this.Currency = res.data.response.original.currency;
                    this.PriceSliderOption.range.min = this._flights[0].TotalPrice;
                    this.PriceSliderOption.range.max = this._flights[this._flights.length - 1].TotalPrice;
                    this.InitPriceRange();

                    // Load saved trips into cart
                    this.LoadSavedItinerariesIntoCart(this.Trip.id);

                } else {

                    let errorCode = res.data.response.messages[0].code;
                    let errorMessage = res.data.response.messages[0].text;
                    this.responseMessage = "Error [" + errorCode + "]: " + errorMessage;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        watch: {
            FSelectedCarrier() {
                this.ApplyFilter();
            },
            DirectOrStopFlihgt() {
                this.ApplyFilter();
            },
            FTotalPrice() {
                this.ApplyFilter();
            }
        },
        methods: {
            FiltersDisplayHandler(Elem) {
                this.DivDisplay[Elem] = !this.DivDisplay[Elem];
            },
            InitPriceRange() {
                let slider = document.getElementById("slider");
                noUiSlider.create(slider, {
                    start: this.PriceSliderOption.start,
                    step: this.PriceSliderOption.step,
                    range: {
                        min: parseInt(this.PriceSliderOption.range.min),
                        max: parseInt(this.PriceSliderOption.range.max)
                    }
                });
                slider.noUiSlider.on("change", (value) => {
                    this.FTotalPrice = parseInt(value[0]);
                });
            },
            ResetFilters(Elem) {
                if (Elem === 'Airline') {
                    this.FSelectedCarrier = [];
                } else if (Elem === 'PriceRange') {
                    this.FTotalPrice = 0;
                } else if (Elem === 'Layovers') {
                    this.DirectOrStopFlihgt = [];
                } else if (Elem === 'Departure') {
                    this.ActiveFilterClassLeg = 'Outbound';
                    this.ActiveFilterClassOutbound = '';
                } else if (Elem === 'Arrival') {
                    this.ActiveFilterClassLeg = 'Inbound';
                    this.ActiveFilterClassInbound = '';
                }

                this.ApplyFilter();
            },
            ApplyFilter() {
                let CurrentFlightsList = this._flights;
                let FilteredFlights = [];

                // Filter airline
                if (this.FSelectedCarrier.length) {
                    if (FilteredFlights.length) {
                        CurrentFlightsList = FilteredFlights;
                    }
                    this.FSelectedCarrier.forEach((CarrierCode) => {
                        CurrentFlightsList.forEach((Itinerary) => {
                            if (Itinerary.FlightOptionsList.FlightOption[0].Option[0].Carrier.Code === CarrierCode) {
                                FilteredFlights.push(Itinerary);
                            }
                        });
                    });
                }

                // Filter layovers
                if (this.DirectOrStopFlihgt.length && this.DirectOrStopFlihgt.length < 2) {
                    if (FilteredFlights.length) {
                        CurrentFlightsList = FilteredFlights;
                    }
                    let filteredList = CurrentFlightsList.filter((Itinerary) => {
                        if (
                            this.DirectOrStopFlihgt[0] === "0" &&
                            Itinerary.FlightOptionsList.FlightOption[0].Option[0].FlightLabelInfo.TotalStop === 0
                        ) {
                            return true;
                        }

                        if (
                            this.DirectOrStopFlihgt[0] === "1" &&
                            Itinerary.FlightOptionsList.FlightOption[0].Option[0].FlightLabelInfo.TotalStop === 1
                        ) {
                            return true;
                        }

                        if (
                            this.DirectOrStopFlihgt[0] === "2" &&
                            Itinerary.FlightOptionsList.FlightOption[0].Option[0].FlightLabelInfo.TotalStop === 2
                        ) {
                            return true;
                        }

                        if (
                            this.DirectOrStopFlihgt[0] === "3" &&
                            Itinerary.FlightOptionsList.FlightOption[0].Option[0].FlightLabelInfo.TotalStop >= 3
                        ) {
                            return true;
                        }
                    });
                    if (filteredList.length) {
                        FilteredFlights = filteredList;
                    }
                }

                // Filter price range
                if (this.FTotalPrice > 0) {
                    if (FilteredFlights.length) {
                        CurrentFlightsList = FilteredFlights;
                    }
                    let filteredList = CurrentFlightsList.filter((Itinerary) => {
                        return (parseInt(Itinerary.TotalPrice) <= parseInt(this.FTotalPrice));
                    });
                    if (filteredList.length) {
                        FilteredFlights = filteredList;
                    }
                }

                // Filter Departure/Arrival date time.
                if (this.ActiveFilterClassLeg === 'Outbound') {
                    let DateTimeString = this.ActiveFilterClassOutbound.split('-');

                    if (DateTimeString[1] !== undefined && DateTimeString[2] !== undefined) {
                        let DepartureHour = DateTimeString[1];
                        let ArrivalHour = DateTimeString[2];
                        if (FilteredFlights.length) {
                            CurrentFlightsList = FilteredFlights;
                        }
                        let filteredList = CurrentFlightsList.filter((Itinerary) => {
                            let DepartureTimeHour = Itinerary.FlightOptionsList.FlightOption[0].Option[0].FlightLabelInfo.DepartureTime.split(":")[0];
                            if (DepartureTimeHour >= DepartureHour && DepartureTimeHour <= ArrivalHour) {
                                return true;
                            }
                        });
                        if (filteredList.length) {
                            FilteredFlights = filteredList;
                        }
                    }

                } else if (this.ActiveFilterClassLeg === 'Inbound') {

                    let DateTimeString = this.ActiveFilterClassInbound.split('-');
                    if (DateTimeString[1] !== undefined && DateTimeString[2] !== undefined) {
                        let DepartureHour = DateTimeString[1];
                        let ArrivalHour = DateTimeString[2];

                        if (FilteredFlights.length) {
                            CurrentFlightsList = FilteredFlights;
                        }
                        let filteredList = CurrentFlightsList.filter((Itinerary) => {
                            let ArrivalTimeHour = Itinerary.FlightOptionsList.FlightOption[0].Option[0].FlightLabelInfo.ArrivalTime.split(":")[0];
                            if (ArrivalTimeHour >= DepartureHour && ArrivalTimeHour <= ArrivalHour) {
                                return true;
                            }
                        });
                        if (filteredList.length) {
                            FilteredFlights = filteredList;
                        }
                    }
                }


                if (FilteredFlights.length) {
                    this.flights = FilteredFlights;
                } else {
                    this.flights = CurrentFlightsList;
                }
            },
            LoadSavedItinerariesIntoCart(TripId) {
                axios.get(base_url + 'corporate/load_saved_itineraries', {
                    params: {
                        corporate_trip_master_id: TripId
                    }
                })
                .then((res) => {
                    this.SavedTrips = res.data.Itineraries;
                    // this.ItnieraryInCarts = res.data.RecommendationKeys;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            ProceedForApproval() {
                window.location.href = base_url + "corporate/trip/"+this.Trip.id+"/proceed_for_approval";
            },
            MailItinerary() {
                axios.post(base_url+'corporate/mail_itineraries_to_user', {
                    MailTo: this.MailTo,
                    Itineraries: this.MailToTrips,
                    flightSearchRequest: this.flightSearchRequest
                })
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            TripSave(Itinerary) {
                // Save trip into db cart
                axios.post(base_url+'corporate/save_itineraries_in_cart', {
                    TripId: this.Trip.id,
                    Itinerary: Itinerary,
                    FlightSearchRequest: this.flightSearchRequest,
                    FlightOptionIndex: 0
                })
                .then((response) => {
                    this.SavedTrips.push(response.data.Itinerary);
                    this.ItnieraryInCarts.push(Itinerary.RecommendationKey);
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            RemoveTripFromCart(Itinerary) {
                // Delete trip from db cart
                axios.post(base_url+'corporate/delete_itinerary_from_cart', {
                    CorporateTripServiceId: Itinerary.CorporateTripServiceId
                })
                    .then((rsp) => {
                        console.log(rsp.data.Message);
                        this.SavedTrips = this.SavedTrips.filter(function (_Itinerary) {
                            return _Itinerary.CorporateTripServiceId !== Itinerary.CorporateTripServiceId;
                        });
                        this.DeleteObjectFromList(Itinerary.RecommendationKey, this.ItnieraryInCarts);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            TripToMailSave(Itinerary) {
                if (this.MailToTrips.indexOf(Itinerary) === -1) {
                    this.MailToTrips.push(Itinerary);
                } else {
                    this.DeleteObjectFromList(Itinerary, this.MailToTrips);
                }
            },
            FilterByTime(AirLeg, DepartureArrivalHourString) {
                this.ActiveFilterClassLeg = AirLeg;
                if (this.ActiveFilterClassLeg == 'Outbound') {
                    this.ActiveFilterClassOutbound = AirLeg+"-"+DepartureArrivalHourString;
                } else if (this.ActiveFilterClassLeg == 'Inbound') {
                    this.ActiveFilterClassInbound = AirLeg+"-"+DepartureArrivalHourString;
                }

                this.ApplyFilter();
            },
            DeleteObjectFromList(needle, haystack) {
                haystack.splice(haystack.indexOf(needle),1);
            },
            IsActive(TabName) {
                return this.FlightDetailChildTab == TabName;
            },
            ShowMoreflightOptions(flightIndex) {
                if (this.MoreflightOptions != -1) {
                    this.MoreflightOptions = -1
                } else {
                    this.MoreflightOptions = flightIndex;
                }
            },
            GetFlightTime(dateTimeString) {
                let dateTime = dateTimeString.split(" ");

                return dateTime[1];
            },
            TransitDelay(ArrivalTime, DepartureTime) {
                ArrivalTime = this.reverseDateFormat(ArrivalTime);
                DepartureTime = this.reverseDateFormat(DepartureTime);
                let Difference = moment(DepartureTime).diff(moment(ArrivalTime));

                return moment.utc(Difference).format("HH[h] mm[m]");
            },
            GetFlightDuration(Segment) {
                let ArrivalTime = this.reverseDateFormat(Segment.ArrivalTime);
                let DepartureTime = this.reverseDateFormat(Segment.DepartureTime);
                let Difference = moment(ArrivalTime).diff(moment(DepartureTime));

                return moment.utc(Difference).format("HH[h] mm[m]");
            },
            GetCarrierImage(Carrier) {
                if (Carrier.Code !== undefined) {
                    return base_url+"images/airlines/"+Carrier.Code+".png";
                } else {
                    return base_url+"images/airlines/"+Carrier+".png";
                }
            },
            GetCarrierCode(Carrier) {
                if (Carrier != undefined) {
                    return Carrier.Code
                }
            },
            GetCarrierName(Carrier) {
                if (Carrier != undefined) {
                    return Carrier.Name
                }
            },
            GetFlightType(FlightLabelInfo) {
              return (FlightLabelInfo.TotalStop == 0) ? 'Direct' : FlightLabelInfo.TotalStop + ' Stop';
            },
            PopulateSelectedFlight(_selectedflight) {
                if (this.Selectedflight != -1) {
                    this.Selectedflight = -1
                } else {
                    this.Selectedflight = _selectedflight;
                }
            },
            PopulateSelectedMoreflightOptionFlightDetail(_selectedflight) {
                if (this.MoreflightOptionFlightDetail != -1) {
                    this.MoreflightOptionFlightDetail = -1
                } else {
                    this.MoreflightOptionFlightDetail = _selectedflight;
                }
            },
            getRouteLabel(BookingInfo) {
                var firstSegment = BookingInfo[0];
                var lastSegment = BookingInfo[BookingInfo.length - 1];
                return firstSegment.Segment.OriginDetail.Name + " → " + lastSegment.Segment.DestinationDetail.Name;
            },
            moment(dateTimeString) {
                var dateTimeString = (dateTimeString) ? dateTimeString : new Date();
                return moment(dateTimeString);
            },
            getDepartureLabel(BookingInfo) {
                var firstSegment = BookingInfo[0];
                var dateObj = new Date(this.reverseDateFormat(firstSegment.Segment.DepartureTime));
                return moment(dateObj).format("DD MMM, YYYY");
            },
            reverseDateFormat(dateTimeString) {
                var dateTime = dateTimeString.split(" ");
                if (dateTime.length == 2) {
                    return dateTime[0].split("-").reverse().join("-") + " " + dateTime[1];
                } else {
                    return dateTime[0].split("-").reverse().join("-");
                }

            },
            getDateLabel(dateTimeString) {
                var dateObj = new Date(this.reverseDateFormat(dateTimeString));
                return moment(dateObj).format("DD MMM, YYYY");
            },
            getTimeLabel(dateTimeString) {
                var dateObj = new Date(this.reverseDateFormat(dateTimeString));
                return moment(dateObj).format("HH:mm");
            },
            encode_base64(data) {
                return btoa(encodeURI(JSON.stringify(data)));
            }
        }
    }
</script>
<style scoped>
    svg {
        cursor: pointer;
    }
    .modal-dialog {
        max-width: 700px;
    }
</style>