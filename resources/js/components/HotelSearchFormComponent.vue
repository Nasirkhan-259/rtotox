<template>
        <div class="row no-gutters">
            <div class="col-md-4 px-1">
                <div class="search-hotel">
                    <svg
                            focusable="false"
                            color="inherit"
                            fill="currentcolor"
                            aria-hidden="true"
                            role="presentation"
                            viewBox="0 0 100 100"
                            preserveAspectRatio="xMidYMid meet"
                            width="24px"
                            height="24px"
                            class="wt4csw-9 hixXyt sc-kgoBCf kPCxEb"
                    >
                        <path
                                d="M68.8 5.5c-5-2.6-10.4-4.2-16-4.5H50C27.7 1 9.7 19.1 9.7 41.4c0 10.7 4.3 20.9 11.8 28.4l23.7 27c2.4 2.6 6.4 2.9 9.1.5l.5-.5 23.7-27c1.1-1.1 6.9-9.3 7.2-9.8 10.4-19.6 2.8-44.1-16.9-54.5zm15.1 38.1c-.5 6.6-2.9 13-6.9 18.2l-.1.2c-.9 1.2-1.9 2.3-2.9 3.3L50 92.6 26.1 65.4c-1-1-2-2.2-3-3.4-4.6-5.9-7-13.2-7-20.7 0-18.8 15.2-34 34-34 .8 0 1.6 0 2.4.1 18.7 1.3 32.7 17.5 31.4 36.2z"
                        ></path>
                        <path
                                d="M50 22.9c-10.2 0-18.5 8.3-18.5 18.5S39.8 59.9 50 59.9s18.5-8.3 18.5-18.5c-.1-10.2-8.3-18.5-18.5-18.5zm0 30.5c-6.7 0-12.1-5.4-12.1-12.1S43.3 29.2 50 29.2s12.1 5.4 12.1 12.1c0 6.7-5.4 12.1-12.1 12.1z"
                        ></path>
                    </svg
                    >
                    <select v-model="HotelSearchQuery.Destination" id="HotelCities"   ></select>
                </div>
            </div>
            <div class="col-md-3 px-1">
                <div class="datepickerhotel">
                    <div  class="hotel-check-in">
                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="">
                            <path d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"></path>
                        </svg>
                        <span   class="daterange_hotel" >{{HotelSearchQuery.Checkin}}</span>
                    </div>
                    <span class="spacer"></span>
                    <div class="hotel-check-out">
                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid meet" width="24px" height="24px" class="">
                            <path d="M40.6 73.9c1.2 1 2.8.8 3.8-.3 1-1.2.8-2.8-.3-3.8l-.1-.1-7.7-6.1h35.6c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H36.1l7.8-6.3c1.2-1 1.4-2.6.4-3.8s-2.6-1.4-3.8-.4L26.8 58.8c-.6.5-1 1.3-1 2.2 0 .8.4 1.6 1 2.1l13.8 10.8z"></path>
                            <path d="M90.4 10.6H75V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H28.8V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H9.6C5.4 10.6 2 14 2 18.3v69.2c0 4.2 3.4 7.6 7.6 7.6h80.7c4.2 0 7.6-3.4 7.6-7.6V18.3c.1-4.3-3.3-7.7-7.5-7.7zm3.8 76.9c0 2.2-1.8 3.8-3.8 3.8H9.6c-2.2 0-3.8-1.8-3.8-3.8V33.6h88.4v53.9zm.1-57.7H5.8V18.3c0-2.2 1.8-3.8 3.8-3.8H25v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h42.3v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h15.4c2.2 0 3.8 1.8 3.8 3.8v11.5z"></path>
                        </svg>
                        <span class="daterange_hotel_checkout" >{{HotelSearchQuery.Checkout}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 px-1">
                <div class="hotel-select-person">
                    <div class="" v-on:click="TogglePassengerDropDown()">
                        <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="12px" height="12px" class="">
                            <circle cx="75" cy="37.5" r="37.5"></circle>
                            <path d="M138 112.5c-39.3-20.2-86-20.2-125.2 0C4.9 116.9.1 125.2 0 134.2V150h150v-15.8c.1-8.8-4.5-17.1-12-21.7z"></path>
                        </svg>
                        <span class="">{{HotelSearchQuery.Passenger.Rooms}} Room, {{HotelSearchQuery.Passenger.Adults}} Adults, {{HotelSearchQuery.Passenger.Children}} Children</span>
                    </div>
                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="12px" height="12px" class="sc-kgoBCf haKxnN">
                        <path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path>
                    </svg>
                </div>
                <div class="select-passnger-drop"  v-bind:class="{ active: PassengerDropDownFlag }">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Adults (12+ years)
                            <div class="d-flex align-items-center">
                                <div v-on:click="DecrementPassengerHotel('Adults')"><i class="fas fa-minus-circle fa-lg"></i></div>
                                <span class="px-2">{{ HotelSearchQuery.Passenger.Adults }}</span>
                                <div v-on:click="IncrementPassengerHotel(PassengerTypes.Adults)"><i class="fas fa-plus-circle fa-lg"></i></div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Children (2 -11 years)
                            <div class="d-flex align-items-center">
                                <div v-on:click="DecrementPassengerHotel('Children')"><i class="fas fa-minus-circle fa-lg"></i></div>
                                <span class="px-2">{{ HotelSearchQuery.Passenger.Children }}</span>
                                <div v-on:click="IncrementPassengerHotel('Children')"><i class="fas fa-plus-circle fa-lg"></i></div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Rooms
                            <div class="d-flex align-items-center">
                                <div v-on:click="DecrementPassengerHotel('Rooms')"><i class="fas fa-minus-circle fa-lg"></i></div>
                                <span class="px-2">{{ HotelSearchQuery.Passenger.Rooms }}</span>
                                <div v-on:click="IncrementPassengerHotel('Rooms')"><i class="fas fa-plus-circle fa-lg"></i></div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-md-2 px-1">
                <button type="button" class="btn-search-sm btn" v-on:click="SearchHotel()">
                    <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" width="25px" height="25px" class="sc-1vkdpp9-4 jkvvkK sc-kgoBCf kDqZno">
                        <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        <path d="M0 0h24v24H0z" fill="none"></path>
                    </svg>
                    Search hotels
                </button>
            </div>
        </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import Helper from '../helpers/Util';

    export default {
        name: "HotelSearchFormComponent",
        components: { Multiselect },
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
                } ,
                HotelSearchQuery: {
                    Destination: "",
                    Checkin: "",
                    Checkout: "",
                    Passenger: {
                        Adults: 1,
                        Children: 0,
                        Rooms: 1
                    }
                },
                DateRangePicker: {},
                HotelDateRangePicker: {}
            }
        },
        mounted() {
            this.SearchQuery.DepartureTime = new Date();
            this.SearchQuery.ArrivalTime = new Date();
            this.SearchQuery.CabinClass = this.CabinClasses[0];
            this.SearchQuery.DepartureTime = moment();
            this.SearchQuery.ArrivalTime = moment(moment().add(7, 'days'));

            this.HotelSearchQuery.Checkin =  moment().format('DD-MM-Y');
            this.HotelSearchQuery.Checkout = moment(moment().add(1, 'days')).format('DD-MM-Y');

            $(document).ready(() => {

                this.HotelDateRangePicker = $(".daterange_hotel").daterangepicker({
                    singleDatePicker: false,
                    autoApply: true,
                    locale: {
                        format: 'DD-MM-Y'
                    },
                    startDate: this.HotelSearchQuery.Checkin,
                    endDate: this.HotelSearchQuery.Checkout,
                    minDate:moment().format('DD-MM-Y'),
                }, (start, end, label) => {
                    this.HotelSearchQuery.Checkin = start.format('DD-MM-Y');
                    this.HotelSearchQuery.Checkout = end.format('DD-MM-Y');
                    $('.daterange_hotel_checkout').data('daterangepicker').setStartDate(this.HotelSearchQuery.Checkin);
                    $('.daterange_hotel_checkout').data('daterangepicker').setEndDate(this.HotelSearchQuery.Checkout);
                });

                this.HotelDateRangePicker = $(".daterange_hotel_checkout").daterangepicker({
                    singleDatePicker: false,
                    autoApply: true,
                    locale: {
                        format: 'DD-MM-Y'
                    },
                    startDate: this.HotelSearchQuery.Checkin,
                    endDate: this.HotelSearchQuery.Checkout,
                    minDate:moment().format('DD-MM-Y'),
                }, (start, end, label) => {
                    this.HotelSearchQuery.Checkin = start.format('DD-MM-Y');
                    this.HotelSearchQuery.Checkout = end.format('DD-MM-Y');
                    $('.daterange_hotel').data('daterangepicker').setStartDate(this.HotelSearchQuery.Checkin);
                    $('.daterange_hotel').data('daterangepicker').setEndDate(this.HotelSearchQuery.Checkout);
                });
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
            DecrementPassengerHotel(Passenger) {
                var PassengerCount = this.HotelSearchQuery.Passenger[Passenger];
                    if(Passenger == "Adults"  &&  PassengerCount != 1 )
                    PassengerCount -= 1;
                else if(Passenger == "Rooms"  && PassengerCount != 1 )
                    PassengerCount -= 1;
                else if(Passenger == "Children" && PassengerCount != 0)
                    PassengerCount -= 1;


                this.HotelSearchQuery.Passenger[Passenger] = PassengerCount;


            },
            TotalPassengers() {
                return (this.SearchQuery.Passenger.Adults + this.SearchQuery.Passenger.Children + this.SearchQuery.Passenger.Infants);
            },
            TogglePassengerDropDown() {
                this.PassengerDropDownFlag = !this.PassengerDropDownFlag;
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
            },
            SearchHotel() {
                let SearchQueryObject = {
                    city_id: this.HotelSearchQuery.Destination,
                    checkin: this.HotelSearchQuery.Checkin,
                    checkout: this.HotelSearchQuery.Checkout,
                    adults: this.HotelSearchQuery.Passenger.Adults,
                    children: this.HotelSearchQuery.Passenger.Children,
                    rooms: this.HotelSearchQuery.Passenger.Rooms,
                };

                if (!Helper.IsEmpty(this.HotelSearchQuery.Destination)){
                    let SearchQueryString = jQuery.param(SearchQueryObject);
                    window.location.href = base_url+"hotels/search?"+SearchQueryString;
                }
            }
        }
    }
</script>

<style scoped>
</style>