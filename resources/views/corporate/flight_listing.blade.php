@extends('layouts.corporate_admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/flight-listing.css') }}"/>
    <style>
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
    </style>
@endpush
@section('content')
    <div class="loading" v-show="loader">
        <img src="{{asset('images/loader_3.gif')}}" alt="loader">
    </div>
    <div class="container">
        <div class="listing">
            <corporate-flight-listing-component payload='{{ $params }}'></corporate-flight-listing-component>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/flight-listing.js') }}"></script>
@endpush