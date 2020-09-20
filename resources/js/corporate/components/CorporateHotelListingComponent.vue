<template>
    <section class="p-50" id="hotel-listing-component">
        <div class="container">
            <div class="row py-2">
                <div class="col-md-4">Trip No: <span class="color-red" v-text="Trip.tripno"/></div>
                <div class="col-md-4">Trip Name: <span class="color-red" v-show="Trip.tripname" v-text="Trip.tripname +' ('+ Trip.triptype +')'"/></div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#viewTripsModal">View Trips [{{SavedTrips.length}}]</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <span class="hotel-search-heading">Select hotel</span>
                    <span class="hotel-search-found">{{hotels.length}} properties found</span>
                    <div data-v-1742c8fd="" class="pull-right"><button data-v-1742c8fd="" data-toggle="modal" data-target="#mailToModal" class="btn btn-default btn-sm mb-2 float-right">Send Email Itinerary [{{EmailItnery.length}}]</button></div>

                </div>
            </div>
            <div class="hr"></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="hotel-filter">
                        <div class="row">
                            <div class="col-12">
                                <div class="filter-title">Filter</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row  mt-3">
                                <div class="col-12">
                                    <div class="border-bottom pb-3">
                                        <div class="hotel-filter-title">Hotel Name</div>
                                        <div class="d-flex">
                                            <input v-model="NameHotel" v-on:keyup.enter="SearchByName()" placeholder="Search hotel name..."
                                                    class="form-control rounded-0"
                                                    value="" style="height: 40px !important;"/>
                                            <button v-on:click="SearchByName()"   type="button" class="btn btn-danger rounded-0">
                                                <svg  focusable="false"
                                                        color="inherit"
                                                        fill="currentcolor"
                                                        aria-hidden="true"
                                                        role="presentation"
                                                        viewBox="0 0 24 24"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        width="24px"
                                                        height="24px"
                                                        class="sc-kgoBCf kPCxEb" >
                                                    <path
                                                            d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"
                                                    ></path>
                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="border-bottom pb-3">
                                        <div class="hotel-filter-title">Price</div>
                                        <div class="border-bottom pb-3">
                                            <div class="mt-3">
                                                <div id="slider-range"></div>
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <div class="Price__Wrapper">
                                                    <span class="Price__Currency">{{params.currency}}</span>
                                                    <span class="Price__Value">{{this.min_price_range}}</span>
                                                </div>
                                                <div class="Price__Wrapper">
                                                    <span class="Price__Currency">{{params.currency}}</span>
                                                    <span class="Price__Value">{{this.max_price_range}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="border-bottom pb-3">
                                        <div class="hotel-filter-title">Star Rating</div>
                                        <div v-for="(HotelStar,key) in HotelStars" class="d-flex justify-content-between">
                                            <div class="font-size-12">
                                                <input v-model="HotelStarModel" type="checkbox"
                                                       v-on:change="FilterHotels"  v-bind:id="key" :value="key"  class="mr-1">
                                                <label title=""   type="checkbox" v-bind:for="key" class="">{{key}} stars</label>
                                            </div>
                                            <span class="font-size-12">({{HotelStar}})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="border-bottom pb-3">
                                        <div class="hotel-filter-title">Guest Rating</div>
                                        <div v-for="(HotelTrip,key) in HotelTripAdvisor" v-if="HotelTrip != 0 " class="d-flex justify-content-between align-items-center">
                                            <div class="font-size-12">
                                                <input v-model="HotelTripAdviserModel" v-bind:value="key" v-on:change="FilterHotels" v-bind:id="key" type="checkbox"  class="mr-1">
                                                <label title="" type="checkbox" v-bind:for="key" class="">{{key}}+ {{getTripAdvisarRating(key)}} </label>
                                            </div>
                                            <span class="font-size-12">({{HotelTrip}})</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="hotel-search-summary col-12">
                            <svg
                                    focusable="false"
                                    color="inherit"
                                    fill="currentcolor"
                                    aria-hidden="true"
                                    role="presentation"
                                    viewBox="0 0 550 550"
                                    preserveAspectRatio="xMidYMid meet"
                                    width="18px"
                                    height="18px"
                            >
                                <path
                                        d="M436.2 154.6H182.4c-12.4 0-33.1 4.7-33.1 36.6V240h320v-48.8c0-31.8-20.7-36.6-33.1-36.6z"
                                ></path>
                                <path
                                        d="M80.3 250.6H32V80H0v330.7h32v-85.4h426.7v85.3h32v-160z"
                                ></path>
                                <circle cx="85.3" cy="197.3" r="44.7"></circle>
                            </svg
                            >
                            <span class="search-summary-title">SEARCH SUMMARY</span
                            ><button type="button" class="hotel-modify-btn">
                            Modify Search
                        </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5 hotel-search-city">
                            <svg
                                    focusable="false"
                                    color="inherit"
                                    fill="currentcolor"
                                    aria-hidden="true"
                                    role="presentation"
                                    viewBox="0 0 150 150"
                                    preserveAspectRatio="xMidYMid meet"
                                    width="15px"
                                    height="15px"
                            >
                                <path
                                        d="M129.8 54.5C129.4 24.2 104.5 0 74.3.4 44.6.9 20.6 24.9 20.2 54.5c0 12.7 4.5 25.1 12.6 34.8L75 150l42.8-61.5c1.5-1.9 3-3.9 4.2-6.1l.4-.6h-.1c4.9-8.3 7.5-17.7 7.5-27.3zm-28.5 0C101.4 69.6 89.2 82 74 82c-15.1.1-27.5-12.1-27.5-27.3-.1-15.1 12.1-27.5 27.3-27.5h.2c15.1 0 27.4 12.2 27.3 27.3z"
                                ></path>
                            </svg
                            >
                            <span class="">{{this.params.city_name}}</span>
                        </div>
                        <div class="hotel-search-from col-2">
                            <svg
                                    focusable="false"
                                    color="inherit"
                                    fill="currentcolor"
                                    aria-hidden="true"
                                    role="presentation"
                                    viewBox="0 0 150 150"
                                    preserveAspectRatio="xMidYMid meet"
                                    width="15px"
                                    height="15px">
                                <path
                                        d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"
                                ></path>
                            </svg>
                            <span class="">{{this.params.checkin}}</span>
                        </div>
                        <div class="col-2 hotel-search-to">
                            <svg
                                    focusable="false"
                                    color="inherit"
                                    fill="currentcolor"
                                    aria-hidden="true"
                                    role="presentation"
                                    viewBox="0 0 100 100"
                                    preserveAspectRatio="xMidYMid meet"
                                    width="15px"
                                    height="15px"
                            >
                                <path
                                        d="M40.6 73.9c1.2 1 2.8.8 3.8-.3 1-1.2.8-2.8-.3-3.8l-.1-.1-7.7-6.1h35.6c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H36.1l7.8-6.3c1.2-1 1.4-2.6.4-3.8s-2.6-1.4-3.8-.4L26.8 58.8c-.6.5-1 1.3-1 2.2 0 .8.4 1.6 1 2.1l13.8 10.8z"
                                ></path>
                                <path
                                        d="M90.4 10.6H75V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H28.8V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H9.6C5.4 10.6 2 14 2 18.3v69.2c0 4.2 3.4 7.6 7.6 7.6h80.7c4.2 0 7.6-3.4 7.6-7.6V18.3c.1-4.3-3.3-7.7-7.5-7.7zm3.8 76.9c0 2.2-1.8 3.8-3.8 3.8H9.6c-2.2 0-3.8-1.8-3.8-3.8V33.6h88.4v53.9zm.1-57.7H5.8V18.3c0-2.2 1.8-3.8 3.8-3.8H25v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h42.3v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h15.4c2.2 0 3.8 1.8 3.8 3.8v11.5z"
                                ></path>
                            </svg
                            >
                            <span class="">{{this.params.checkout}}</span>
                        </div>
                        <div class="col-3 hotel-search-room-adult">
                            <svg focusable="false"
                                    color="inherit"
                                    fill="currentcolor"
                                    aria-hidden="true"
                                    role="presentation"
                                    viewBox="0 0 150 150"
                                    preserveAspectRatio="xMidYMid meet"
                                    width="15px"
                                    height="15px">
                                <circle cx="75" cy="37.5" r="37.5"></circle>
                                <path
                                        d="M138 112.5c-39.3-20.2-86-20.2-125.2 0C4.9 116.9.1 125.2 0 134.2V150h150v-15.8c.1-8.8-4.5-17.1-12-21.7z"
                                ></path>
                            </svg
                            >
                            <span class="sc-dvCyap fquFad">{{this.params.rooms}} Room, {{this.params.adults + this.params.children}} Guests</span>
                        </div>
                    </div>
                    <div class="hotel-sorting">
                        <div class="row  mt-3">
                            <div class="col-1 p-0">
                                <div>Sort by:</div>
                            </div>
                            <div class="col-11 p-0">
                                <div class="d-flex justify-content-between">
                                    <button type="button" v-on:click="ActiveFilter('Recommendations')"  v-bind:class="{ 'active': (ActiveFiltration == 'Recommendations') }" class="btn-hotel-sorting">
                                        Recommendations
                                        <div class="btn-sorting-tool-tip">
                                            <div data-toggle="recommend" title="horry">
                                                <svg    focusable="false"
                                                        color="secondaryDark"
                                                        fill="currentcolor"
                                                        aria-hidden="true"
                                                        role="presentation"
                                                        viewBox="0 0 15 15"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        size="14"
                                                        width="14"
                                                        height="14"
                                                        class="sc-kgoBCf jgxWqh">
                                                    <path
                                                            d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </button>
                                    <button v-on:click="ActiveFilter('Lowest Price')"  v-bind:class="{ 'active': (ActiveFiltration == 'Lowest Price') }" type="button" class="btn-hotel-sorting">
                                        Lowest Price</button>
                                    <button type="button"  v-on:click="ActiveFilter('Highest Price')"  v-bind:class="{ 'active': (ActiveFiltration == 'Highest Price') }"   class="btn-hotel-sorting">
                                        Highest Price</button>
                                    <button type="button"  v-on:click="ActiveFilter('Stars')"  v-bind:class="{ 'active': (ActiveFiltration == 'Stars') }" class="btn-hotel-sorting">
                                        Stars
                                        <div class="btn-sorting-tool-tip">
                                            <div data-toggle="distance" title="horry">
                                                <svg
                                                        focusable="false"
                                                        color="secondaryDark"
                                                        fill="currentcolor"
                                                        aria-hidden="true"
                                                        role="presentation"
                                                        viewBox="0 0 15 15"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        size="14"
                                                        width="14"
                                                        height="14"
                                                        class="sc-kgoBCf jgxWqh"
                                                >
                                                    <path
                                                            d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                    <h1 class="text-center" v-if="hotels.length == 0">No Result Found</h1>
                    </div>
                    <div class="row" v-for="(hotel, hotelIndex) in hotels" >
                        <div class="col-12 p-0">
                            <div class="hotel-search-result row no-gutters">
                                <div class="col-md-3">
                                    <a href="#">
                                        <img v-bind:src="hotel.image" class="hotel-search-img"/>
                                    </a>
                                </div>
                                <div class="col-md-6 p-3">
                                    <div class="d-flex align-items-center">
                                        <span class="hotel-search-title">{{hotel.company_name}}</span>
                                        <div class="icon-stars">
                                            <div class="icon-stars">
                                                <svg  v-for="n in hotel.rating" focusable="false"
                                                        color="inherit"
                                                        fill="currentcolor"
                                                        aria-hidden="true"
                                                        role="presentation"
                                                        viewBox="0 0 16 15"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        size="16"
                                                        width="16"
                                                        height="16"
                                                        class="sc-kgoBCf hDGZbe">
                                                    <path
                                                            fill="currentColor"
                                                            fill-rule="evenodd"
                                                            d="M9.038.685l1.624 3.972 4.329.312c1.023.1 1.353 1.327.592 1.864l-3.367 2.735 1.034 4.116c.218.98-.874 1.666-1.633 1.126l-3.705-2.281-3.69 2.231c-.888.507-1.894-.296-1.601-1.167l1.077-4.146L.384 6.71c-.768-.668-.296-1.85.642-1.848l4.372-.281L7.039.659c.414-.919 1.71-.846 1.999.026"
                                                    ></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hotel-address">
                                        {{hotel.address}}
                                    </div>
                                    <div>
                                        <small>{{Corporate.api_data.alias}}</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="rating-price">
                                        <div class="d-flex justify-content-end">
                                            <div class="hotel-rating-review">
                                                {{getTripAdvisarRating(hotel.trip_advisor_rating)}}<br />
                                            </div>
                                            <div class="">
                                                <svg
                                                        focusable="false"
                                                        color="inherit"
                                                        fill="currentcolor"
                                                        aria-hidden="true"
                                                        role="presentation"
                                                        viewBox="0 0 60 54"
                                                        preserveAspectRatio="xMidYMid meet"
                                                        width="24px"
                                                        height="24px"
                                                        class=""
                                                >
                                                    <path
                                                            fill="currentColor"
                                                            fill-rule="evenodd"
                                                            d="M31.039 42.668L19.497 53.563c-.964.91-2.684.304-2.684-.945v-9.95H2.273A2.273 2.273 0 0 1 0 40.395V2.273A2.273 2.273 0 0 1 2.273 0h55.454A2.273 2.273 0 0 1 60 2.273v38.122a2.273 2.273 0 0 1-2.273 2.273H31.04z"
                                                    ></path>
                                                </svg
                                                >
                                                <span>{{ hotel.trip_advisor_rating}}</span>
                                            </div>
                                        </div>
                                        <div class="hotel-price">
                                            <div class="">
                                                <span class="Price__Currency">{{hotel.currencies}}</span>
                                                <span class="Price__Value">{{hotel.price}}</span>
                                            </div>
                                            <div class="hotel-stay">Total for {{getDifferentDate(params.checkin,params.checkout)}} night</div>

                                            <button v-on:click="getHotelRooms(hotel.session_id,hotel.ResultIndex,hotel.id,hotelIndex)"  class="btn-select-room" >
                                                See rooms
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
                                                        class="sc-dxgOiQ sc-cqCuEk bDaflA sc-kgoBCf kPCxEb"
                                                >
                                                    <path
                                                            d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="col-md-12 mt-50 collapse"  :id="'collapse-'+hotelIndex"   :aria-labelledby="'heading-'+hotelIndex" data-parent="#accordionFareRule" >
                            <div v-for="(item,room_index) in hotel.Rooms"  class="room-details"  style="">
                                <div class="HotelDetails-Room-Option">
                                    <div class="include-room">
                                        <div class="room-service-title">What’s Included</div>
                                        <div class="include-room-contains">
                                            <div class="include-room-qty" v-html="item.room_name"></div>
                                            <ul v-if="item.Inclusion != ''" class="room-cancelation-detail">
                                                <li class="sc-jGxEUC jmbUJj">
                                                    <svg focusable="false" color="greenLimeDark" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez cwzVtt">
                                                        <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                                    </svg>
                                                    <span>{{item.Inclusion}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="room-guest">
                                        <div class="room-service-title">
                                            Guests
                                        </div>
                                        <div class="room-guest-qty">
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="24px" height="24px">
                                                <circle cx="75" cy="37.5" r="37.5"></circle>
                                                <path d="M138 112.5c-39.3-20.2-86-20.2-125.2 0C4.9 116.9.1 125.2 0 134.2V150h150v-15.8c.1-8.8-4.5-17.1-12-21.7z"></path>
                                            </svg>
                                            {{params.adults + params.children}}
                                        </div>
                                    </div>
                                    <div class="total-stay-price">
                                        <div class="room-service-title">
                                            Total For Stay
                                        </div>
                                        <div class="room-total-price">
                                            {{item.price}}
                                        </div>
                                        <div class="room-stay">
                                            Total for {{getDifferentDate(params.checkin,params.checkout)}} night
                                        </div>
                                    </div>
                                    <div class="room-booknow">
                                        <div>
                                            <button class="btn-select" v-if="(ItnieraryInCarts.includes(item.room_type_code))" v-bind:class="{active: (ItnieraryInCarts.includes(item.room_type_code))}">
                                                Saved
                                            </button>
                                            <button class="btn-select btn-block" v-else v-bind:class="{active: (ItnieraryInCarts.includes(item.room_type_code))}" v-on:click="TripSave(hotel,item)">
                                                Save Trip</button>
                                        </div>

                                        <input v-model="EmailItnery" :id="'room'+room_index" :value="MailItineraryValue(room_index,hotel.image,hotel.company_name,item.room_name,item.Inclusion,item.price,hotel.rating)" name="" type="checkbox">
                                        <span class="fs-12 text-muted">Email Itinerary</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="mailToModal" tabindex="-1" role="dialog" aria-labelledby="mailToModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mailToModalLabel">Email Itinerary</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#" class="form form-inline" method="POST" v-on:submit.prevent="MailItinerary()">
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
                                    <button type="submit" class="btn btn-primary">Send Hotel Email Itinerary</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

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
                                            <strong class="text-danger ml-10 font-size-12" v-text="params.checkin"/>
                                        </div>
                                        <div>
                                            <strong class="font-size-12">Travel End Date:</strong>
                                            <strong class="text-danger ml-10 font-size-12" v-text="params.checkout"/>
                                        </div>
                                    </div>

                                    <div v-for="(ItineraryOfSavedTrips, ItineraryOfSavedTripsIndex)  in SavedTrips">
                                        <div v-if="ItineraryOfSavedTrips.service_type == 'flight'" class="trip-container">
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
                                                                            <span v-text="CabinClass"/>
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
                                        <div v-if="ItineraryOfSavedTrips.service_type == 'hotel'" class="trip-container">
                                                    <div data-v-1742c8fd="" class="trip-header p-10 bg-danger rounded-top">
                                                        <div data-v-1742c8fd="" class="row align-items-center">
                                                            <div data-v-1742c8fd="" class="col-md-2">
                                                                <div data-v-1742c8fd="" class="d-flex align-items-center justify-content-between">
                                                                    <h4 data-v-1742c8fd="" class="text-white mb-0">Hotel</h4>
                                                                </div>
                                                            </div>
                                                            <div data-v-1742c8fd="" class="col-md-10">
                                                                <div data-v-1742c8fd="" class="d-flex justify-content-end align-items-center">
                                                                    <div data-v-1742c8fd=""
                                                                         class="text-white px-3 py-2 border  border-rounded font-size-12"><span
                                                                            data-v-1742c8fd=""> {{ItineraryOfSavedTrips.currency_code}} {{ItineraryOfSavedTrips.total_base_fare}}</span></div>
                                                                    <div data-v-1742c8fd=""
                                                                         class="text-white px-3 py-2 border border-rounded font-size-12 mx-2">Adults:<span
                                                                            data-v-1742c8fd="">{{ItineraryOfSavedTrips.total_adults}}</span></div>
                                                                    <div data-v-1742c8fd=""
                                                                         class="text-white px-3 py-2 border border-rounded font-size-12 mx-2">Children:<span
                                                                            data-v-1742c8fd="">{{ItineraryOfSavedTrips.total_children }}</span></div>
                                                                    <div data-v-1742c8fd=""
                                                                         class="text-white px-3 py-2 border border-rounded font-size-12 mx-2">Rooms:<span
                                                                            data-v-1742c8fd="">{{ItineraryOfSavedTrips.total_rooms }}</span></div>
                                                                    <button v-on:click="RemoveTripFromCart(ItineraryOfSavedTrips)"
                                                                            class="px-2 py-2 bg-white border border-rounded font-size-12 btn"
                                                                            style="height: auto;">Remove</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div data-v-1742c8fd="" class="border p-20">
                                                        <div data-v-1742c8fd="" class="row align-items-center clearfix">
                                                            <div data-v-1742c8fd="" class="pull-left mr-20">
                                                                <strong>{{ItineraryOfSavedTrips.hotel_name}}</strong>
                                                            </div>
                                                            <div class="aside-rating font-size-12 pull-right">
                                                                <i v-for="i in ConvertoNumber(ItineraryOfSavedTrips.hotel_ratings)" class="fas fa-star text-warning"></i>
                                                            </div>


                                                        </div>
                                                        <div class="row label-dark fs-12">{{ItineraryOfSavedTrips.hotel_address}}
                                                        </div>


                                                        <div class="row bg-silver">
                                                            <div class="col-md-3">
                                                                <p>Check In</p>
                                                                <p><strong>{{ItineraryOfSavedTrips.checkin}}</strong></p>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <p>Check Out</p>
                                                                <p><strong>{{ItineraryOfSavedTrips.checkout}}</strong></p>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <p>Check In</p>
                                                                <p><strong>{{ItineraryOfSavedTrips.checkin}}</strong></p>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <p>Room Type</p>
                                                                <p><strong>{{ItineraryOfSavedTrips.hotel_room_type }}</strong></p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

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


        </div>



        <!-- /REGISTER -->


    </section>

</template>

<script>
    import * as _ from "lodash";
    export default {
        props: ['payload'],
        data() {
          return {
              hotels: [],
              EmailItnery: [],
              orignal_hotels: [],
              Corporate: [],
              params: {},
              ActiveFiltration : "",
              SavedTrips: [],
              NameHotel : "",
              HotelStars : [],
              ItnieraryInCarts: [],
              Trip: {},
              min_price: 0,
              max_price: 0,
              min_price_range: 0,
              max_price_range: 0,
              MailToTrips: [],
              MailTo: {},
              CabinClass : "Ecnomic",
              HotelTripAdvisor : {2:0,3:0,4:0},
              HotelStarModel : [],
              HotelTripAdviserModel : [],
              base_urls : "",
          }
        },
        mounted() {
            this.base_urls = base_url;
            this.params = JSON.parse(this.payload);
            console.log( this.params)
            this.params.adults = this.params.adults.split("_").reduce(function(a,b){ return  Number(a) + Number(b) });
            this.params.adults = Number(this.params.adults);
            this.params.children = this.params.children.split("_").reduce(function(a,b){ return  Number(a) + Number(b) });
            this.params.rooms = Number(this.params.rooms);
            this.params.children = Number(this.params.children);

            axios.get(base_url + 'corporate/searchHotel', {
                params: JSON.parse(this.payload)
            })
            .then((res) => {
                this.$parent.loader = false;
                this.hotels = res.data.hotels;
                this.Corporate = res.data.corporate;
                var status = res.data.status;
                this.Trip = res.data.Trip;
                var stay = this.getDifferentDate(this.params.checkin,this.params.checkout);
                this.LoadSavedItinerariesIntoCart(this.Trip.id);
                if(status != "success"){

                }else {
                    this.hotels.forEach((item, index, array) => {
                        array[index].price = Number(array[index].price);
                        array[index].trip_advisor_rating = Number(array[index].trip_advisor_rating)
                        array[index].rating = this.getStars(item.rating);
                        array[index].Rooms = [];

                        if(this.Corporate.is_hotel_percentage_markup){
                            var temp_price = item.price/100;
                            array[index].price = Math.ceil(item.price + (temp_price * Number(this.Corporate.hotel_markup_totalnights_percentage)));
                        }else{
                            var temp_price = Number(this.Corporate.hotel_markup_perroom_pernight) * stay;
                            temp_price = temp_price * Number(this.params.rooms);
                            array[index].price = Math.ceil(temp_price +  array[index].price);
                        }

                        if ((item.price < this.min_price) || (this.min_price == 0)) {
                            this.min_price = item.price
                            this.min_price_range = this.min_price;
                        }
                        if (item.price > this.max_price) {
                            this.max_price = item.price
                            this.max_price_range = this.max_price;
                        }

                        if (array[index].trip_advisor_rating <= 2) {
                            this.HotelTripAdvisor[2] = this.HotelTripAdvisor[2] + 1;
                            array[index].filter_trip_advisor_rating = 2;

                        } else if (array[index].trip_advisor_rating <= 4 && array[index].trip_advisor_rating > 2) {
                            this.HotelTripAdvisor[3] = this.HotelTripAdvisor[3] + 1;
                            array[index].filter_trip_advisor_rating = 3;

                        } else if (array[index].trip_advisor_rating > 4) {
                            this.HotelTripAdvisor[4] = this.HotelTripAdvisor[4] + 1;
                            array[index].filter_trip_advisor_rating = 4;

                        }

                    });

                    var _this = this;
                    $("#slider-range").slider({
                        range: true,
                        min: _this.min_price,
                        max: _this.max_price,
                        values: [_this.min_price, _this.max_price],
                        slide: function (event, ui) {
                            slide(event, ui);

                            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                            var price_arr = [];
                            _this.min_price_range = ui.values[0];
                            _this.max_price_range = ui.values[1];
                            _this.hotels = _this.orignal_hotels;
                            _this.hotels.forEach((item) => {
                                if (ui.values[0] < item.price && ui.values[1] > item.price) {
                                    price_arr.push(item)
                                }
                            });
                            _this.hotels = price_arr


                        },

                    });

                    function slide(event, ui) {
                        // Allow time for exact positioning
                    }


                    this.HotelStars = _.countBy(this.hotels, 'rating');
                    this.orignal_hotels = this.hotels;
                }
            })
            .catch(function (error) {
                console.log(error);
            });


        },
        methods: {
            /**
             * @return {string}
             */
            MailItineraryValue(id,image,company_name,room_name,Inclusion,price,ratings){
                return JSON.stringify({
                    "id":id,
                    "image":image,
                    "company_name":company_name,
                    "room_name":room_name,
                    "Inclusion":Inclusion,
                    "price":price,
                    "rating":ratings,
                });
            },
            GetCarrierImage(Carrier) {
                if (Carrier.Code != undefined) {
                    return base_url+"images/airlines/"+Carrier.Code+".png";
                } else {
                    return base_url+"images/airlines/"+Carrier+".png";
                }
            },
            ConvertoNumber(value){
                return Number(value);
            },
            GetFlightTime(dateTimeString) {
                let dateTime = dateTimeString.split(" ");

                return dateTime[1];
            },
            TripSave(hotels,rooms) {
                // Save trip into db cart
                axios.post(base_url+'corporate/save_hotel_itineraries_in_cart', {
                    TripId: this.Trip.id,
                    hotels: hotels,
                    rooms: rooms,
                    params: this.params,
                    FlightOptionIndex: 0
                })
                    .then((response) => {
                        this.SavedTrips.push(response.data.Itinerary);
                        this.ItnieraryInCarts.push(rooms.room_type_code);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            GetCarrierName(Carrier) {
                if (Carrier != undefined) {
                    return Carrier.Name
                }
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
            TransitDelay(ArrivalTime, DepartureTime) {
                ArrivalTime = this.reverseDateFormat(ArrivalTime);
                DepartureTime = this.reverseDateFormat(DepartureTime);
                let Difference = moment(DepartureTime).diff(moment(ArrivalTime));

                return moment.utc(Difference).format("HH[h] mm[m]");
            },
            reverseDateFormat(dateTimeString) {
                var dateTime = dateTimeString.split(" ");
                if (dateTime.length == 2) {
                    return dateTime[0].split("-").reverse().join("-") + " " + dateTime[1];
                } else {
                    return dateTime[0].split("-").reverse().join("-");
                }

            },
            GetFlightDuration(Segment) {
                let ArrivalTime = this.reverseDateFormat(Segment.ArrivalTime);
                let DepartureTime = this.reverseDateFormat(Segment.DepartureTime);
                let Difference = moment(ArrivalTime).diff(moment(DepartureTime));

                return moment.utc(Difference).format("HH[h] mm[m]");
            },
            LoadSavedItinerariesIntoCart(TripId) {
                axios.get(base_url + 'corporate/load_saved_itineraries', {
                    params: {
                        corporate_trip_master_id: TripId
                    }
                }).then((res) => {
                    console.log(res.data)
                        this.SavedTrips = res.data.Itineraries;
                        // this.ItnieraryInCarts = res.data.RecommendationKeys;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            MailItinerary() {
                axios.post(base_url+'corporate/hotels/mail_itineraries_to_user', {
                    MailTo: this.MailTo,
                    Itineraries: this.EmailItnery,
                    params: this.params
                })
                    .then((response) => {

                        $("#mailToModal").modal('hide');
                        alert("Email Send Successfully");
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            getStars(star){
                if(star == "ThreeStar"){
                    return 3
                }else if(star == "TwoStar"){
                    return  2
                }else if(star == "OneStar"){
                    return  1
                }else if(star == "FourStar"){
                    return  4
                }else if(star == "FiveStar"){
                    return  5
                }else if(star == "SixStar"){
                    return  6
                }else if(star == "SeavenStar"){
                    return  7
                }else {
                    return "";
                }
            } ,
            getTripAdvisarRating(rating){
                if(rating <= 2){
                    return "Good";
                }else if(rating <= 4 && rating > 2 ){
                    return "Very Good";
                }else if(rating > 4){
                    return  "Excellent";
                }
            },
            getDifferentDate(from,to){
               from =   from.split('-');
               to =   to.split('-');
               var a = moment([from[0], from[1]-1, from[2]]);
               var b = moment([to[0], to[1]-1, to[2]]);
               return b.diff(a, 'days');
            },
            getHotelRooms(SessionIndex,ResultIndex,HotelId,ID){
                if(this.hotels[ID].Rooms.length != 0 ){
                    document.querySelector("#collapse-"+ID).classList.toggle("show");
                }else{
                    this.SearchRooms(SessionIndex,ResultIndex,HotelId,ID);
                }
            },
            SearchRooms(SessionIndex,ResultIndex,HotelId,ID){
                this.$parent.loader = true;

                var data = {"SessionIndex" : SessionIndex,"ResultIndex":ResultIndex,"HotelId":HotelId };
                var stay = this.getDifferentDate(this.params.checkin,this.params.checkout);

                axios.get(base_url + 'corporate/searchHotelDetails', {
                    params: data
                }).then((res) => {
                    this.$parent.loader = false;

                    if(res.data.status){
                            this.hotels[ID].Rooms = res.data.result;
                            this.hotels[ID].Rooms.forEach((item,index,array)=>{

                                if(this.Corporate.is_hotel_percentage_markup){
                                    var temp_price = item.price/100;
                                    array[index].price = Math.ceil(item.price + (temp_price * Number(this.Corporate.hotel_markup_totalnights_percentage)));
                                }else{
                                    temp_price = Number(this.Corporate.hotel_markup_perroom_pernight) * stay;
                                    temp_price = temp_price * Number(this.params.rooms)
                                    array[index].price = Math.ceil(temp_price +  array[index].price);

                                }
                            });
                            var temp = this.hotels;
                            this.hotels = [];
                            this.hotels = temp;
                            document.querySelector("#collapse-"+ID).classList.toggle("show");
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });


            },
            ActiveFilter(value){
                this.ActiveFiltration = value;
                if(value == "Lowest Price"){
                    this.hotels = _.orderBy(this.hotels, ['price'], ['asc']);
                }else if(value == "Highest Price"){
                    this.hotels = _.orderBy(this.hotels, ['price'], ['desc']);
                }else if(value == "Stars"){
                    this.hotels = _.orderBy(this.hotels, ['rating'], ['desc']);
                }else if(value == "Recommendations"){
                    this.hotels = _.orderBy(this.hotels, ['trip_advisor_rating'], ['desc']);
                }
            },
            in_array: function (needle, haystack) {
                for (var i in haystack) {
                    if (haystack[i] == needle) return true;
                }
                return false;
            },
            SearchByName(){
                this.FilterHotels()
            },
            FilterHotels(){
                var filter_hotels = [];
                this.hotels = this.orignal_hotels;
                if(this.NameHotel.trim() == "" &&  this.HotelStarModel.length == 0 && this.HotelTripAdviserModel.length == 0){
                    this.hotels = this.orignal_hotels;
                    return;
                }

                if(this.NameHotel.trim() != ""){
                    filter_hotels = [];
                    this.orignal_hotels.forEach((item)=>{
                        if(item.company_name.toLowerCase().includes(this.NameHotel.trim().toLowerCase())){
                            filter_hotels.push(item);
                        }
                    });
                    this.hotels = filter_hotels;
                }
                if(this.HotelStarModel.length != 0) {
                    filter_hotels = [];
                    this.hotels.forEach((item)=>{
                        if(this.in_array(item.rating,this.HotelStarModel)){
                            filter_hotels.push(item);
                        }
                    });
                    this.hotels = filter_hotels;
                }
                if(this.HotelTripAdviserModel.length != 0) {
                    filter_hotels = [];
                    console.log(this.HotelTripAdviserModel)

                    this.hotels.forEach((item)=>{
                        if(this.in_array(item.filter_trip_advisor_rating,this.HotelTripAdviserModel)){
                            filter_hotels.push(item);
                        }
                    });
                    this.hotels = filter_hotels;
                }
            }
        }
    }
</script>
