@extends('layouts.corporate_admin')
@section('slider')
    <!-- NOTE: you can add multiple images separated by comma -->
    @push('styles')
        <link href="{{ asset('css/custom-rtoto.css') }}" rel="stylesheet" type="text/css" />
        <style>

            .HotelDetails-Room-Option{
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                width: 100%;
                border-width: 1px;
                border-style: solid;
                border-color: rgb(224, 224, 224);
                -o-border-image: initial;
                border-image: initial;
                -webkit-box-flex: 1;
                -ms-flex: 1 1 0%;
                flex: 1 1 0%;

            }
            .HotelDetails-Room-Option:not(:last-of-type) {
                border-bottom: none;
            }
            .include-room{
                -ms-flex-preferred-size: 44%;
                flex-basis: 44%;
                max-width: 44%;
                padding: 15px;
                border-right: 1px solid rgb(224, 224, 224);
            }
            .room-service-title{
                font-size: 12px;
                font-weight: 600;
                color: rgb(58, 58, 58);
                margin-top: -45px;
                padding-bottom: 25px;
                margin-left: -15px;
            }
            .include-room-contains{
                color: rgb(58, 58, 58);
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                height: 100%;
            }
            .include-room-qty{
                font-size: 14px;
                font-weight: 600;
                margin-bottom: 10px;
            }
            .room-cancelation-detail{
                margin-bottom: 15px;
                padding: 0px;
                list-style: none;
                -webkit-box-flex: 1;
                -ms-flex: 1 1 0%;
                flex: 1 1 0%;
            }
            .room-cancelation-detail li{
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                margin-bottom: 5px;
                font-size: 12px;
                font-weight: 600;
            }
            .room-cancelation-detail li:last-child{
                margin-bottom: 0;
            }
            .room-cancelation-detail li svg{
                color: rgb(29, 172, 8);
                margin-right: 4px;
                width: 16px;
            }
            .room-cancelation-detail li span{
                color: rgb(29, 172, 8);
            }
            .room-cancelation-detail li span:not(:last-child) {
                margin-right: 5px;

            }
            .dot{
                display: inline-block;
                width: 4px;
                height: 4px;
                margin-right: 10px;
                margin-left: 6px;
                border-radius: 50%;
                background: rgb(58, 58, 58);
            }
            .room-guest{-ms-flex-preferred-size: 17%;flex-basis: 17%;
                max-width: 17%;
                padding: 15px 35px 15px 15px;
                border-right: 1px solid rgb(224, 224, 224);}
            .room-guest-qty{
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                color: rgb(58, 58, 58);
                font-size: 12px;
                font-weight: 600;
            }
            .room-guest-qty svg{
                height: 14px;
                width: 14px;
                color: rgb(58, 58, 58);
                margin-right: 5px;
            }
            .total-stay-price{
                -ms-flex-preferred-size: 17%;
                flex-basis: 17%;
                max-width: 17%;
                padding: 15px 35px 15px 15px;
                border-right: 1px solid rgb(224, 224, 224);
            }
            .total-stay-price .room-total-price{
                color: rgb(58, 58, 58);
                font-weight: 600;
                font-size: 18px;
            }
            .total-stay-price .room-stay{
                font-size: 12px;
                font-weight: normal;
                color: rgb(119, 119, 119);
            }
            .room-booknow{
                -ms-flex-preferred-size: 22%;
                flex-basis: 22%;
                padding: 15px 20px;
            }
            .room-details:not(:first-child) .room-service-title {
                display: none;

            }

            section#flight-listing-component {
                padding-top: 27px !important;
            }

            label {
                display: inline-block !important;
            }

            .filter-result .data-cheapest .cheapest label,
            .filter-result .data-cheapest .shortest label {
                padding-left: 28px;
            }

            .email-trip {
                font-size: 12px;
                cursor: pointer;
            }

            #mailToModal .form-control {
                margin: 2px auto;
            }

            .btn-select {
                background: #d32f2f;
            }

            .btn-select.active {
                background: #b75f5f;
            }

            #viewTripsModal .modal-dialog {
                max-width: 800px;
            }
            .loading {
                position: fixed;
                z-index: 9999;
                width: 100%;
                height: 100%;
                background:#000000d9;
                color:#fff;
                text-align: center;
                top: 0px;
                padding-top: 15%;
            }

        </style>
        <link href="{{ asset('css/hotel-listing.css') }}" rel="stylesheet" type="text/css" />

    @endpush
@endsection
@section('content')
            <div class="loading" v-show="loader" >Searching...</div>
            <div class="listing">
                <div class="listing">
                    <corporate-hotel-listing-component payload='{{ json_encode($params)  }}'></corporate-hotel-listing-component>
                </div>
            </div>
@endsection
@push('scripts')

    <script>
        jQuery(window).ready(function() {
            loadScript(plugin_path + 'jquery/jquery-ui.min.js', function() {
                /** jQuery UI **/
                loadScript(plugin_path + 'jquery/jquery.ui.touch-punch.min.js', function() {
                    /** Mobile Touch Slider **/
                    loadScript(plugin_path + 'form.slidebar/jquery-ui-slider-pips.min.js',
                        function() {
                            /** Slider Script **/
                            /** Slider 1
                             ******************** **/
                            var $slider1 = jQuery("#slider1").slider({
                                range: true,
                                animate: true,
                                min: 0,
                                max: 10,
                                values: [2, 8]
                            });
                            jQuery("#slider1").slider("pips", {
                                first: "pip",
                                last: "pip"
                            });
                            /** Slider 1
                             ******************** **/
                            var $slider2 = jQuery("#slider2").slider({
                                range: true,
                                animate: true,
                                min: 0,
                                max: 10,
                                values: [2, 8]
                            });
                            jQuery("#slider2").slider("pips", {
                                first: "pip",
                                last: "pip"
                            });
                            /** Slider 3
                             ******************** **/
                            var $slider3 = jQuery("#slider3").slider({
                                range: true,
                                animate: true,
                                min: 0,
                                max: 10,
                                values: [2, 8]
                            });
                            jQuery("#slider3").slider("pips", {
                                first: "pip",
                                last: "pip"
                            });
                        });
                });
            });
        });
    </script>


@endpush
