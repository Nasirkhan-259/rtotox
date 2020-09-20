<template>
    <section class="p-50" id="hotel-listing-component">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <span class="hotel-search-heading">Select hotel</span>
                    <span class="hotel-search-found">{{this.hotels.length}} properties found</span>
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
                                            <input v-model="NameHotel" placeholder="Search hotel name..."
                                                    class="form-control rounded-0"
                                                    value="" style="height: 40px !important;"/>
                                            <button v-on:click="SearchByName()"  type="button" class="btn btn-danger rounded-0">
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
                                        <div class="mt-3">
                                            <div id="slider-range"></div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3">
                                            <div class="Price__Wrapper">
                                                <span class="Price__Currency">USD</span>
                                                <span class="Price__Value">{{this.min_price}}</span>
                                            </div>
                                            <div class="Price__Wrapper">
                                                <span class="Price__Currency">USD</span>
                                                <span class="Price__Value">{{this.max_price}}</span>
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
                                        d="M80.3 250.6H32V80H0v330.7h32v-85.4h426.7v85.3h32v-160z"></path>
                                <circle cx="85.3" cy="197.3" r="44.7"></circle>
                            </svg>
                            <span class="search-summary-title">SEARCH SUMMARY</span>
                            <button type="button" class="hotel-modify-btn" v-on:click="ShowSearchFormModal()">
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
                                    height="15px"
                            >
                                <path
                                        d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"
                                ></path>
                            </svg
                            >
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
                    <h1 class="text-center" v-if="hotels.length == 0">No Result Found</h1>
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
                                        <a target="_blank" href="#"><span class="hotel-search-title">{{hotel.company_name}}</span></a>
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

                                            <form v-bind:action='base_urls+"hotels/details"' method="get">
                                                <input type="hidden" name="SessionId" :value="hotel.session_id">
                                                <input type="hidden" name="ResultIndex" :value="hotel.ResultIndex">
                                                <input type="hidden" name="HotelId" :value="hotel.id">
                                            <button type="submit" class="btn-select-room">
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="modal fade" id="SearchFormModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-lg">
                    <hotel-search-form-component></hotel-search-form-component>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>


        <!-- /REGISTER -->


    </section>

</template>

<script>
    import * as _ from "lodash";
    import HotelSearchFormComponent from "./HotelSearchFormComponent";
    export default {
        components: {HotelSearchFormComponent},
        props: ['payload'],
        data() {
          return {
              hotels: [],
              orignal_hotels: [],
              params: {},
              ActiveFiltration : "",
              NameHotel : "",
              HotelStars : [],
              HotelTripAdvisor : {2:0,3:0,4:0},
              HotelStarModel : [],
              HotelTripAdviserModel : [],
              min_price: 0,
              max_price: 0,
              base_urls : "",
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')

          }
        },
        mounted() {
            this.base_urls = base_url;
            this.params = JSON.parse(this.payload);
            this.params.adults = Number(this.params.adults);
            this.params.children = Number(this.params.children);
            this.params.rooms = Number(this.params.rooms);
            axios.get(base_url + 'hotels/searchHotel', {
                params: JSON.parse(this.payload)
            })
            .then((res) => {
                if (true) {
                    this.$parent.loader = false;
                    this.hotels = res.data.hotels;
                    var status = res.data.status;
                    this.hotels.forEach((item,index,array)=> {
                        array[index].price = Number(array[index].price);


                        if ((item.price < this.min_price) || (this.min_price == 0)) {
                            this.min_price = item.price
                        }
                        if (item.price > this.max_price) {
                            this.max_price = item.price
                        }

                        array[index].trip_advisor_rating = Number(array[index].trip_advisor_rating)
                        array[index].rating = this.getStars(item.rating);

                        if(array[index].trip_advisor_rating <= 2){
                            this.HotelTripAdvisor[2]  =  this.HotelTripAdvisor[2] +   1;
                            array[index].filter_trip_advisor_rating = 2;
                        }else if(array[index].trip_advisor_rating <= 4 && array[index].trip_advisor_rating  > 2 ){
                            this.HotelTripAdvisor[3]  =  this.HotelTripAdvisor[3] +   1;
                            array[index].filter_trip_advisor_rating = 3;
                        }else if(array[index].trip_advisor_rating > 4){
                            this.HotelTripAdvisor[4]  =  this.HotelTripAdvisor[4] +   1;
                            array[index].filter_trip_advisor_rating = 4;

                        }


                    });
                    this.HotelStars = _.countBy(this.hotels, 'rating');
                    this.orignal_hotels = this.hotels;
                    var _this = this;
                        $( "#slider-range" ).slider({
                            range: true,
                            min: _this.min_price,
                            max: _this.max_price,
                            values: [_this.min_price, _this.max_price],
                            slide: function( event, ui ) {
                                $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                                var price_arr = [];
                                _this.hotels = _this.orignal_hotels;
                                _this.hotels.forEach((item) => {
                                    if (ui.values[0] < item.price && ui.values[1] > item.price) {
                                        price_arr.push(item)
                                    }
                                });
                                _this.hotels = price_arr

                            }
                        });



                    
                }
            })

            .catch(function (error) {
                console.log(error);
            });
        },
        methods: {

            ShowSearchFormModal() {
                $("#SearchFormModal").modal("show");
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
               var a = moment([from[2], from[1]-1, from[0]]);
               var b = moment([to[2], to[1]-1, to[0]]);
               return b.diff(a, 'days');
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
