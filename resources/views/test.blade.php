<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Document</title>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <!-- WEB FONTS : use %7C instead of | (pipe) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

    <!-- CORE CSS -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- THEME CSS -->
    <link href="{{ asset('css/essentials.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css" />

    <!-- THEME RED SCRIPTS -->
    <link href="{{ asset('css/header-1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/color_scheme/red.css') }}" rel="stylesheet" type="text/css" id="color_scheme" />
    <link href="{{ asset('css/booking-widget.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- CUSTOM RTOTO CSS -->
    <link href="{{ asset('css/custom-rtoto.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" type="text/css" />
    @stack("styles")
    <style>
        .container {
            max-width: 1200px !important;
            width: 100%;
        }
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
        .HotelDetails-Room-Option:not(:first-child) .room-service-title {
            display: none;

        }
    </style>
    <link href="{{ asset('css/hotel-listing.css') }}" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div data-v-1742c8fd="" class="row py-2"><div data-v-1742c8fd="" class="col-md-4">Trip No: <span data-v-1742c8fd="" class="color-red">NTS2</span></div> <div data-v-1742c8fd="" class="col-md-4">Trip Name: <span data-v-1742c8fd="" class="color-red" style="">Test Family (business-fmaily)</span></div> <div data-v-1742c8fd="" class="col-md-4"><button data-v-1742c8fd="" data-toggle="modal" data-target="#viewTripsModal" class="btn btn-primary btn-sm float-right">View Trips [2]</button></div></div>

            <div class="pull-left"><span class="hotel-search-heading">Select hotel</span>
                <span class="hotel-search-found">482 properties found</span></div>
            <div data-v-1742c8fd="" class="pull-right"><button data-v-1742c8fd="" data-toggle="modal" data-target="#mailToModal" class="btn btn-default btn-sm mb-2 float-right">Send Email Itinerary [0]</button></div>
        </div>
    </div>
    <div class="hr"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="hotel-map">
                <div class="view-map">Map view</div>
                <img
                        class="img-fluid"
                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMjc5Ljk2OSIgaGVpZ2h0PSI5MSI+CiAgICA8ZGVmcz4KICAgICAgICA8cmVjdCBpZD0iYSIgd2lkdGg9IjI3OS45NjkiIGhlaWdodD0iOTEiIC8+CiAgICAgICAgPGZpbHRlciBpZD0iYiIgd2lkdGg9IjI3OS45NjkiIGhlaWdodD0iOTEiIGZpbHRlclVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCI+CiAgICAgICAgICAgIDxmZU9mZnNldCBpbj0iU291cmNlQWxwaGEiIHJlc3VsdD0ic2hhZG93T2Zmc2V0T3V0ZXIxIi8+CiAgICAgICAgICAgIDxmZUdhdXNzaWFuQmx1ciBpbj0ic2hhZG93T2Zmc2V0T3V0ZXIxIiByZXN1bHQ9InNoYWRvd0JsdXJPdXRlcjEiIC8+CiAgICAgICAgICAgIDxmZUNvbG9yTWF0cml4IGluPSJzaGFkb3dCbHVyT3V0ZXIxIiB2YWx1ZXM9IjAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAuMSAwIi8+CiAgICAgICAgPC9maWx0ZXI+CiAgICA8L2RlZnM+CiAgICA8ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxtYXNrIGlkPSJjIiBmaWxsPSIjZmZmIj4KICAgICAgICAgICAgPHVzZSB4bGluazpocmVmPSIjYSIvPgogICAgICAgIDwvbWFzaz4KICAgICAgICA8dXNlIGZpbGw9IiMwMDAiIGZpbHRlcj0idXJsKCNiKSIgeGxpbms6aHJlZj0iI2EiLz4KICAgICAgICA8dXNlIGZpbGw9IiNGRkYiIHhsaW5rOmhyZWY9IiNhIi8+CiAgICAgICAgPGcgbWFzaz0idXJsKCNjKSI+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNENEU4RjQiIGQ9Ik0uMDE1IDIyOS41MzdoMjc5Ljk3Vi4wMTNILjAxNXoiLz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0ZGRiIgZD0iTS4wMTUgMjI5LjUzN2gyNzkuOTdWLjAxM0guMDE1eiIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjQ0VDRUM4IiBkPSJNMCAyMjkuNTI0aDI3OS45N1YwSDB6Ii8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiM5NkJCRTciIGQ9Ik04OC4wMTggMjI5LjUzN2w3OC4wODktNDEuODE2YzMuNDk3LTEuODcyIDYuNjQtNC4xMTcgOS4zNjUtNi42NDlhNDAuNjAzIDQwLjYwMyAwIDAgMCAzLjI4NS0zLjQyMiAzOC4wNzIgMzguMDcyIDAgMCAwIDMuNzYyLTUuMjQyYzIuNTI0LTQuMjUyIDQuMDk5LTguODkgNC41NTMtMTMuNjc0IDEuOTg3LTIwLjkxIDE4LjkyLTM4LjgzMyA0My4xNC00NS42NjNsNDkuNzczLTE0LjAzNHYxNS4yNjVsLTQ0LjAzIDEyLjQxNmMtMTcuNTc2IDQuOTU1LTI5Ljg2NSAxNy45NjEtMzEuMzA1IDMzLjEzNS0uNTAyIDUuMjgtMiAxMC41MDYtNC4zOTkgMTUuNDMzYTQ5LjA3MyA0OS4wNzMgMCAwIDEtMy4wMTQgNS4zMSA0OS41NTIgNDkuNTUyIDAgMCAxLTIuMjQ5IDMuMTcxYy0uMTA3LjE0LS4yMTYuMjgtLjMyNS40Mi00Ljg3IDYuMjA1LTExLjM2OCAxMS41NzctMTguOTA1IDE1LjYxNGwtNTUuNTMyIDI5LjczNkg4OC4wMTh6TTE2NC44MDUuMDEzaDExNS4xOHYyOS42NjZjLTExLjkzMiAxLjE0Mi00Mi4wNjYgMy40MS02Ni4wODYuMDMtMjEuNDkyLTMuMDI0LTM5Ljk2Ny0xOS44ODItNDkuMDk0LTI5LjY5NnoiLz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0UyRTVFNyIgZD0iTTM4LjcwNSA2My44ODZsNDUuMDg5IDIwLjQ0NyAyLjc5LTEuNDE2aC4wMDJsODQuNTgzLTQyLjkwNS0yMy4yODYtMzEuNDA1LTEwOS4xNzggNTUuMjh6bS04LjAyMyA0LjA2M0wuMDE1IDgzLjQ3NnYtNy45MjNsMjIuNDEyLTExLjM0OEwuMDE1IDU0LjA0M3YtNy43MDFMMzAuNDUgNjAuMTQzIDE0My42MSAyLjg0N2wtMi4xLTIuODM0aDkuNjA4bDI4LjMyNiAzOC4yMDJoMTAwLjU0djYuNzEySDE3Ny4xMDlsLTI1LjA3NyAxMi43MiAzNS43NjUgNDguMzYgOTIuMTg5LTI4LjE5djcuMTg1bC05MC4zMyAyNy42Mi0yMS40NzQgNTUuNDAzLTIuNDY2IDEuMzE1LTMuNTkyIDEuOTE1LS4yNi4xNC4yMDEuMDMyIDM3LjA3IDUuOTkgODAuODUgMTMuMDY5djYuODY4bC04NC45MjYtMTMuNzI2LTE5LjA4OC0zLjA4NS0yMy43ODgtMy44NDUtLjIwNS0uMDMzLS4zNTQuMTg5LTk4LjE1MSA1Mi4zM0gzOC40MDlsNjYuNTQ5LTM1LjQ4Mi02MC4zMDItODEuNTktNDQuNjQgMjIuNjQ0di03LjkyN2w3NC44NzMtMzcuOTguODQ3LS40MjkuMDQyLS4wMjItNDUuMDk2LTIwLjQ1em0xMTMuMzggMTA0LjkwM2wtNjEuMS04MC4xNy0uMDc4LjA0LS44NzEuNDQyLTMwLjM1OCAxNS4zOTkgNjAuMjA2IDgxLjQ1OSAzMi4yMDItMTcuMTd6bTYuODkzLTMuNjc0bDEwLjI4My01LjQ4MyAyMC40OS01Mi44NjItMzYuNzA1LTQ5LjYzLTU1LjA3IDI3LjkzNCA2MS4wMDIgODAuMDR6TS4wMTUgMjQuMjM1TDQ3Ljc0NC4wMTNoMTUuNjg1TC4wMTUgMzIuMTk2di03Ljk2eiIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjQTJDMDg5IiBkPSJNLjAxNS4wMTNoMjcuMTc4TC4wMTUgMTMuODA1Vi4wMTN6bTAgMTUwLjEyNmwyMS0xMC42NWMyLjU5My0xLjMxNiA1Ljc4My0xLjU2IDguNjI2LS42NjIgOC4xMjggMi41NjcgMTUuMzkgNi41MDQgMjEuMzgxIDExLjQ3NCA1Ljk5MiA0Ljk3MiAxMC43MTIgMTAuOTc3IDEzLjc1NCAxNy42OCAyLjU0IDUuNTk1IDMuODMgMTEuNTA0IDMuODMgMTcuNDQgMCAyLjI4LS4xOTEgNC41NjMtLjU3MyA2LjgzNWwtMS4yOSA3LjY2MmMtLjM4NiAyLjI5OC0xLjk2NiA0LjM0NS00LjMzIDUuNjE0bC00NC43NjkgMjQuMDA1SC4wMTV2LTc5LjM5OHptMTgxLjEzNi05NS42NjNoODIuOTA1YzEuMTc0IDAgMi4xMjQuNzc4IDIuMTI0IDEuNzM4djE0LjkzYzAgLjczMy0uNTY0IDEuMzg5LTEuNDA5IDEuNjM2bC03MS4yOSAyMC44NWMtLjk0NS4yNzctMS45OTgtLjAyNS0yLjUyNC0uNzI1TDE2OC4xNCA2Mi41NjJjLS42MjItLjgyNy0uMjk1LTEuOTEuNzI1LTIuNDA3bDExLjIwMi01LjQzNmEyLjQ4IDIuNDggMCAwIDEgMS4wODQtLjI0M3ptNTMuOTcgMTc1LjA2bDEuMjgyLTUuNDM4YzMuMjExLTEzLjYyIDE5LjM2My0yMi41NCAzNi4wNzUtMTkuOTIybDcuNTA3IDEuMTc2djI0LjE4NUgyMzUuMTJ6Ii8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNCQkJCQjciIGQ9Ik0xNjcuMTU0IDExOC41OTRsLTkuNTQgMjQuNjcyYy0xLjQzNSAzLjcxMy03LjUyOCA0LjMwNi05Ljk4Ljk3MmwtMzUuMDY4LTQ3LjY4M2MtMi40NDUtMy4zMjUtMS4yMDUtNy42NDUgMi43OS05LjcyM2wxNy4yNC04Ljk2N2M0LjEyMi0yLjE0MyA5LjU4NS0xLjA4MyAxMi4xIDIuMzUxbDIxLjA4IDI4Ljc2OWMyLjEyIDIuODkyIDIuNjIxIDYuMzkyIDEuMzc4IDkuNjA5em0tNDMuNzktNjIuNTc1Yy0uODg0LjQ0NC0yLjAzNi4yMTItMi41NzQtLjUxOGwtMTIuMjI0LTE2LjYwN2MtLjUzOC0uNzMtLjI1Ni0xLjY4MS42MjgtMi4xMjRsMzQuMDctMTcuMDgyYy44ODQtLjQ0MiAyLjAzNi0uMjEgMi41NzMuNTE5bDEyLjIyNSAxNi42MDhjLjUzNi43My4yNTUgMS42OC0uNjI5IDIuMTIzbC0zNC4wNyAxNy4wODF6bS00My4yMDctNC4wOWwuMDE3LjAyNCAxOC42MzUtOS4yOTYuMDA4LjAxYy44NS0uNDI1IDEuOTU5LS4yMDIgMi40NzcuNDk2bDEyLjM0NSAxNi42OWMuNTE3LjY5OS4yNDYgMS42MS0uNjA1IDIuMDM0bC03Ljg1IDMuOTE2Yy0uODUuNDI0LTEuOTU4LjIwMi0yLjQ3NS0uNDk3bC0zLjAwNC00LjA2Yy0uNTE3LS42OTktMS42MjYtLjkyMi0yLjQ3Ny0uNDk3bC02LjE2NCAzLjA3NGMtLjg1LjQyNS0xLjEyMSAxLjMzNi0uNjA1IDIuMDM1bDIuOTc5IDQuMDI2Yy41MTcuNjk5LjI0NiAxLjYxLS42MDUgMi4wMzRsLTcuODUgMy45MTZjLS44NS40MjQtMS45NTguMjAyLTIuNDc1LS40OTdsLTEyLjM0Ni0xNi42OWMtLjUxNy0uNjk4LS4yNDYtMS42MDkuNjA1LTIuMDMzbDkuMzktNC42ODR6bTMzLjkwMi00My41NmMuNTQuNzI5LjI1NiAxLjY3OC0uNjMyIDIuMTJMODIuMzYxIDI1Ljk2Yy0uODg4LjQ0Mi0yLjA0NS4yMS0yLjU4NS0uNTE3bC00Ljg1OC02LjU1NWMtLjUzOC0uNzI4LS4yNTYtMS42NzcuNjMyLTIuMTJsMzEuMDY2LTE1LjQ2OWMuODg4LS40NDIgMi4wNDYtLjIxIDIuNTg2LjUxOGw0Ljg1NyA2LjU1M3ptLTQ4LjYzLTIuNTRjLS41NC0uNzI1LS4yNTgtMS42NzIuNjMtMi4xMTJMNzMuNTMuMDEzaDI1LjI3NGwtMjUuOTMgMTIuODYxYy0uODg5LjQ0MS0yLjA0Ny4yMS0yLjU4Ny0uNTE2TDY1LjQzIDUuODN6bS0zMy45NDcgNDUuMjRjLS44ODQuNDQyLTIuMDM2LjIxLTIuNTczLS41MThMMTYuNjggMzMuOTU3Yy0uNTM4LS43MjktLjI1Ni0xLjY3OC42MjgtMi4xMjFsMzguMzc5LTE5LjIyYy44ODUtLjQ0MyAyLjAzNy0uMjEyIDIuNTc1LjUxN0w3MC40OSAyOS43MjdjLjUzNi43MjguMjU1IDEuNjc4LS42MyAyLjEyMWwtMzguMzc5IDE5LjIyek0uMDE1IDkxLjI5N2wyOC4wMTYtMTMuOTYzYy44ODctLjQ0MSAyLjA0NC0uMjEgMi41ODIuNTE3TDQyLjg4IDk0LjQxOGMuNTQuNzI3LjI1NyAxLjY3NS0uNjMgMi4xMThMMS40OSAxMTYuODVjLS40Ni4yMjktLjk5My4yNzctMS40NzUuMTY3di0yNS43MnptMTk0LjEyNCAxMzguMjRsNC40MjQtMTguOTQyYy4yNDUtMS4wNSAxLjQ3OC0xLjczNyAyLjc1My0xLjUzNWwyNy4xNTIgNC4yOTRjMS4yNzQuMjAxIDIuMTEgMS4yMTUgMS44NjQgMi4yNjVsLTMuMjUgMTMuOTE4SDE5NC4xNHptOS4yNS0yNS43ODdjLTEuMjgxLS4yLTIuMTItMS4xOTgtMS44NzQtMi4yMzFsMS41NS02LjUwOWMuMjQ3LTEuMDM0IDEuNDg0LTEuNzEgMi43NjQtMS41MTJsMjYuOTQ0IDQuMThjMS4yOC4xOTggMi4xMTkgMS4xOTcgMS44NzMgMi4yM2wtMS41NSA2LjUxYy0uMjQ2IDEuMDMzLTEuNDgzIDEuNzEtMi43NjQgMS41MTFsLTI2Ljk0NC00LjE4em01NS4yMDUtMjYuNzMxYy0xLjI3Mi0uMi0yLjEwNy0xLjIwNS0xLjg2MS0yLjI0NGwzLjYzOS0xNS40NzVjLjI0NC0xLjA0IDEuNDc1LTEuNzIxIDIuNzQ2LTEuNTJsMTYuODY3IDIuNjQ4djE5Ljk1bC0yMS4zOS0zLjM1OXptLTExLjY0My0yNy4yNjhjLTEuMjc1LS4xOTktMi4xMTItMS4yMDMtMS44NjYtMi4yNGwzLjY0OS0xNS40NDZjLjI0Ni0xLjAzNyAxLjQ3OS0xLjcxOCAyLjc1NS0xLjUxOGwyOC40OTYgNC40NTV2MTkuOTEzbC0zMy4wMzQtNS4xNjR6bS0yOS43NzQgMjAuMDg4Yy0xLjI3LS4yLTIuMTAxLTEuMjEtMS44NTgtMi4yNTVsMS45MzMtOC4yNzZjLjI0NC0xLjA0NSAxLjQ3Mi0xLjczIDIuNzQxLTEuNTI5bDI2LjE2OSA0LjEzOGMxLjI3LjIwMiAyLjEwMSAxLjIxMSAxLjg1OCAyLjI1N2wtMS45MzMgOC4yNzRjLS4yNDQgMS4wNDYtMS40NzIgMS43My0yLjc0MSAxLjUzbC0yNi4xNjktNC4xMzl6TTc2LjcxMiAxMjUuMzNjLS42NzUtLjkxMy0uMzE4LTIuMS43OTctMi42NTFMODguOTc0IDExN2MxLjExNS0uNTUyIDIuNTY1LS4yNiAzLjI0LjY1M2wyMC45MTUgMjguM2MuNjc0LjkxMi4zMTggMi4xLS43OTggMi42NTJsLTExLjQ2NSA1LjY3OGMtMS4xMTQuNTUyLTIuNTY0LjI2LTMuMjM4LS42NTJsLTIwLjkxNi0yOC4zMDJ6bTI2LjMyNyAzNS43MjNjLS43LS45NDYtLjMzLTIuMTc2LjgyNy0yLjc0OGwxMS4yNi01LjU3NWMxLjE1NS0uNTcyIDIuNjYtLjI3IDMuMzU4LjY3Nmw4Ljc4IDExLjg3M2MyLjU4IDMuNDkgMS4yMTUgOC4wMzEtMy4wNTEgMTAuMTQyLTQuMjY1IDIuMTEyLTkuODE0Ljk5NC0xMi4zOTUtMi40OTVsLTguNzgtMTEuODczem0tMzcuOTc0LTUwLjk4NmMtLjY3Ni0uOTA2LS4zMTgtMi4wODUuOC0yLjYzM2wxMS41MDUtNS42NDNjMS4xMTgtLjU0OCAyLjU3NC0uMjU5IDMuMjUuNjQ5bDUuMzMgNy4xNDJjLjY3Ny45MDYuMzE5IDIuMDg1LS44IDIuNjM0bC0xMS41MDQgNS42NDJjLTEuMTE4LjU0OS0yLjU3NC4yNTgtMy4yNS0uNjQ4bC01LjMzLTcuMTQzem0xMDkuNjYyIDExOS40N2w1LjA0NS0yMS43NjZjLjI0NC0xLjA1MyAxLjQ3LTEuNzQxIDIuNzM5LTEuNTRsNS44NDguOTMyYzEuMjY4LjIwMyAyLjEgMS4yMiAxLjg1NSAyLjI3MmwtNC42NiAyMC4xMDNoLTEwLjgyN3oiLz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPgo="
                />
            </div>
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
                                    <input
                                            placeholder="Search hotel name..."
                                            class="form-control rounded-0"
                                            value=""
                                    />
                                    <button type="button" class="btn btn-danger rounded-0">
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 24 24"
                                                preserveAspectRatio="xMidYMid meet"
                                                width="24px"
                                                height="24px"
                                                class="sc-kgoBCf kPCxEb"
                                        >
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
                                    <div
                                            direction="to right"
                                            min="119"
                                            max="8800"
                                            values="119,8800"
                                            class="hotel-filter-scale"
                                            style="cursor: inherit;"
                                    >
                                        <div
                                                class="hotel-filter-pointer"
                                                style="position: absolute; z-index: 0; cursor: grab; user-select: none; touch-action: none; top:-9px; left:0;"
                                        ></div>
                                        <div
                                                class="hotel-filter-pointer"
                                                style="position: absolute; z-index: 1; cursor: grab; user-select: none; touch-action: none; top:-9px; right:0;"
                                        ></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <div class="Price__Wrapper">
                                        <span class="Price__Currency">AED</span>
                                        <span class="Price__Value">119</span>
                                    </div>
                                    <div class="Price__Wrapper">
                                        <span class="Price__Currency">AED</span>
                                        <span class="Price__Value">8,800</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border-bottom pb-3">
                                <div class="hotel-filter-title">Star Rating</div>
                                <div class="d-flex justify-content-between">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="star-rating-0" class="mr-1">
                                        <label title="" type="checkbox" for="star-rating-0" class="">5 stars</label>
                                    </div>
                                    <span class="font-size-12">(125)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="star-rating-1" class="mr-1">
                                        <label title="" type="checkbox" for="star-rating-1" class="">4 stars</label>
                                    </div>
                                    <span class="font-size-12">(211)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="star-rating-2" class="mr-1">
                                        <label title="" type="checkbox" for="star-rating-2" class="">3 stars</label>
                                    </div>
                                    <span class="font-size-12">(137)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="star-rating-3" class="mr-1">
                                        <label title="" type="checkbox" for="star-rating-3" class="">2 stars</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="star-rating-4" class="mr-1">
                                        <label title="" type="checkbox" for="star-rating-4" class="">1 stars</label>
                                    </div>
                                    <span class="font-size-12">(27)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="star-rating-5" class="mr-1">
                                        <label title="" type="checkbox" for="star-rating-5" class="">0 stars</label>
                                    </div>
                                    <span class="font-size-12">(17)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border-bottom pb-3">
                                <div class="hotel-filter-title">Guest Rating</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">9+ Excellent</label>
                                    </div>
                                    <span class="font-size-12">(125)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">8+ Very good</label>
                                    </div>
                                    <span class="font-size-12">(211)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">7+ Good</label>
                                    </div>
                                    <span class="font-size-12">(137)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">6+ Fair</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border-bottom pb-3">
                                <div class="hotel-filter-title">Property Amenities</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Wi-Fi</label>
                                    </div>
                                    <span class="font-size-12">(125)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Front desk</label>
                                    </div>
                                    <span class="font-size-12">(211)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Luggage storage</label>
                                    </div>
                                    <span class="font-size-12">(137)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Breakfast</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Lifts</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">
                                            Dry Cleaning service
                                        </label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <a class="font-size-12 text-danger text-decoration-none" role="button" href="#">Show 10 more <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="10px" height="10px" class=""><path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border-bottom pb-3">
                                <div class="hotel-filter-title">Property Type</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Hotel</label>
                                    </div>
                                    <span class="font-size-12">(125)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Aparthotel</label>
                                    </div>
                                    <span class="font-size-12">(211)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Apartment</label>
                                    </div>
                                    <span class="font-size-12">(137)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Resort</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Guesthouse</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">
                                            Private vacation home
                                        </label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <a class="font-size-12 text-danger text-decoration-none" role="button" href="#">Show 10 more <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="10px" height="10px" class=""><path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border-bottom pb-3">
                                <div class="hotel-filter-title">Meals</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Breakfast included</label>
                                    </div>
                                    <span class="font-size-12">(125)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Breakfast + lunch or dinner</label>
                                    </div>
                                    <span class="font-size-12">(211)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Continental Breakfast</label>
                                    </div>
                                    <span class="font-size-12">(137)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">All meals included</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">All meals + select drinks</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="border-bottom pb-3">
                                <div class="hotel-filter-title">Chain</div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Independent</label>
                                    </div>
                                    <span class="font-size-12">(125)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Others</label>
                                    </div>
                                    <span class="font-size-12">(211)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Accor</label>
                                    </div>
                                    <span class="font-size-12">(137)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Marriott International</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">Hilton</label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="font-size-12">
                                        <input type="checkbox" id="" class="mr-1">
                                        <label title="" type="checkbox" for="" class="">
                                            InterContinental
                                        </label>
                                    </div>
                                    <span class="font-size-12">(34)</span>
                                </div>
                                <a class="font-size-12 text-danger text-decoration-none" role="button" href="#">Show 10 more <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 150 150" preserveAspectRatio="xMidYMid meet" width="10px" height="10px" class=""><path d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"></path></svg>
                                </a>
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
                    <span class="">dubai</span>
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
                    <span class="">04 Nov 2019</span>
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
                    <span class="">05 Nov 2019</span>
                </div>
                <div class="col-3 hotel-search-room-adult">
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
                        <circle cx="75" cy="37.5" r="37.5"></circle>
                        <path
                                d="M138 112.5c-39.3-20.2-86-20.2-125.2 0C4.9 116.9.1 125.2 0 134.2V150h150v-15.8c.1-8.8-4.5-17.1-12-21.7z"
                        ></path>
                    </svg
                    >
                    <span class="sc-dvCyap fquFad">1 room, 2 guests</span>
                </div>
            </div>
            <div class="hotel-sorting">
                <div class="row  mt-3">
                    <div class="col-1 p-0">
                        <div>Sort by:</div>
                    </div>
                    <div class="col-11 p-0">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn-hotel-sorting active">
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
                            </button
                            >
                            <button type="button" class="btn-hotel-sorting">
                                Lowest Price</button
                            ><button type="button" class="btn-hotel-sorting">
                                Highest Guest Ratings</button
                            >
                            <button type="button" class="btn-hotel-sorting">
                                Distance
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
            <div class="row">
                <div class="col-12 p-0">
                    <div class="hotel-search-result row no-gutters">
                        <div class="col-md-3">
                            <a href="#">
                                <img
                                        src="https://imgproc.tjwlcdn.com/fit-in/220x222/http://hotelcms-contents-live.tajawal.com/72cf5371-5bb2-4835-8d15-409e719f7c0d.jpg"
                                        class="hotel-search-img"
                                />
                            </a>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="d-flex align-items-center">
                                <a target="_blank" href="#"
                                ><span class="hotel-search-title"
                                    >Hilton Dubai Al Habtoor City</span
                                    ></a
                                >
                                <div class="icon-stars">
                                    <div class="icon-check icon-stars">
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 16 15"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="16"
                                                width="16"
                                                height="16"
                                                class="sc-kgoBCf hDGZbe"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M9.038.685l1.624 3.972 4.329.312c1.023.1 1.353 1.327.592 1.864l-3.367 2.735 1.034 4.116c.218.98-.874 1.666-1.633 1.126l-3.705-2.281-3.69 2.231c-.888.507-1.894-.296-1.601-1.167l1.077-4.146L.384 6.71c-.768-.668-.296-1.85.642-1.848l4.372-.281L7.039.659c.414-.919 1.71-.846 1.999.026"
                                            ></path>
                                        </svg
                                        >
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 16 15"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="16"
                                                width="16"
                                                height="16"
                                                class="sc-kgoBCf hDGZbe"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M9.038.685l1.624 3.972 4.329.312c1.023.1 1.353 1.327.592 1.864l-3.367 2.735 1.034 4.116c.218.98-.874 1.666-1.633 1.126l-3.705-2.281-3.69 2.231c-.888.507-1.894-.296-1.601-1.167l1.077-4.146L.384 6.71c-.768-.668-.296-1.85.642-1.848l4.372-.281L7.039.659c.414-.919 1.71-.846 1.999.026"
                                            ></path>
                                        </svg
                                        >
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 16 15"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="16"
                                                width="16"
                                                height="16"
                                                class="sc-kgoBCf hDGZbe"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M9.038.685l1.624 3.972 4.329.312c1.023.1 1.353 1.327.592 1.864l-3.367 2.735 1.034 4.116c.218.98-.874 1.666-1.633 1.126l-3.705-2.281-3.69 2.231c-.888.507-1.894-.296-1.601-1.167l1.077-4.146L.384 6.71c-.768-.668-.296-1.85.642-1.848l4.372-.281L7.039.659c.414-.919 1.71-.846 1.999.026"
                                            ></path>
                                        </svg
                                        >
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 16 15"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="16"
                                                width="16"
                                                height="16"
                                                class="sc-kgoBCf hDGZbe"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M9.038.685l1.624 3.972 4.329.312c1.023.1 1.353 1.327.592 1.864l-3.367 2.735 1.034 4.116c.218.98-.874 1.666-1.633 1.126l-3.705-2.281-3.69 2.231c-.888.507-1.894-.296-1.601-1.167l1.077-4.146L.384 6.71c-.768-.668-.296-1.85.642-1.848l4.372-.281L7.039.659c.414-.919 1.71-.846 1.999.026"
                                            ></path>
                                        </svg>
                                    </div>
                                    <svg
                                            focusable="false"
                                            color="inherit"
                                            fill="currentcolor"
                                            aria-hidden="true"
                                            role="presentation"
                                            viewBox="0 0 16 15"
                                            preserveAspectRatio="xMidYMid meet"
                                            size="16"
                                            width="16"
                                            height="16"
                                            class="uncheck"
                                    >
                                        <path
                                                fill="currentColor"
                                                fill-rule="evenodd"
                                                d="M9.038.685l1.624 3.972 4.329.312c1.023.1 1.353 1.327.592 1.864l-3.367 2.735 1.034 4.116c.218.98-.874 1.666-1.633 1.126l-3.705-2.281-3.69 2.231c-.888.507-1.894-.296-1.601-1.167l1.077-4.146L.384 6.71c-.768-.668-.296-1.85.642-1.848l4.372-.281L7.039.659c.414-.919 1.71-.846 1.999.026"
                                        ></path>
                                    </svg>
                                </div>
                                <span class="proprity-type">Hotel</span>
                            </div>
                            <div class="hotel-address">
                                Boulevard Street Downtown Burj Khalifa, Downtown Dubai,
                                Dubai, United Arab Emirates
                            </div>
                            <div class="hotel-distance">
                                <svg
                                        focusable="false"
                                        color="inherit"
                                        fill="currentcolor"
                                        aria-hidden="true"
                                        role="presentation"
                                        viewBox="0 0 420 420"
                                        preserveAspectRatio="xMidYMid meet"
                                        width="24px"
                                        height="24px"
                                        class="sc-dEoRIm kLZxCZ sc-kgoBCf kPCxEb"
                                >
                                    <path
                                            d="M405.264 194.553L214.936 4.225c-5.633-5.632-14.757-5.632-20.39 0L4.224 194.553C1.519 197.258 0 200.927 0 204.746s1.519 7.487 4.224 10.196l190.322 190.321a14.338 14.338 0 0 0 10.193 4.228 14.36 14.36 0 0 0 10.196-4.228l190.328-190.321c2.702-2.709 4.228-6.377 4.228-10.196s-1.525-7.488-4.227-10.193zm-133.475-5.116l-37.254 37.245a14.33 14.33 0 0 1-10.196 4.228 14.35 14.35 0 0 1-10.19-4.228c-5.632-5.633-5.632-14.754 0-20.387l12.749-12.739h-64.609v76.9c0 7.963-6.452 14.424-14.42 14.424-7.962 0-14.417-6.461-14.417-14.424v-91.321c0-7.957 6.455-14.417 14.417-14.417h78.819l-15.51-15.501c-5.63-5.633-5.63-14.76 0-20.393 5.632-5.633 14.76-5.633 20.392 0l40.215 40.22c5.636 5.633 5.636 14.76.004 20.393z"
                                    ></path>
                                </svg
                                >
                                <span>45 km from </span>
                            </div>
                            <span class="hotel-facilities">Free Cancellation</span>
                            <span class="hotel-facilities">Breakfast</span>
                        </div>
                        <div class="col-md-3">
                            <div class="rating-price">
                                <div class="d-flex justify-content-end">
                                    <div class="hotel-rating-review">
                                        Very good<br />
                                        <span class="hotel-guest-review"
                                        >4928 Guest reviews</span
                                        >
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
                                        <span>8.2</span>
                                    </div>
                                </div>
                                <div class="hotel-price">
                                    <div class="">
                                        <span class="Price__Currency">AED</span>
                                        <span class="Price__Value">614</span>
                                    </div>
                                    <div class="hotel-stay">Total for 1 night</div>
                                    <button type="button" class="btn-select-room" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
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
                <div class="col-md-12 mt-50">
                    <div class="room-details collapse " id="collapseExample" style="">
                        <div class="HotelDetails-Room-Option">
                            <div class="include-room">
                                <div class="room-service-title">What’s Included</div>
                                <div class="include-room-contains">
                                    <div class="include-room-qty">Deluxe Twin</div>
                                    <ul class="room-cancelation-detail">
                                        <li class="sc-jGxEUC hqiHIh">
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez ekULev">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>FREE cancellation before 09 Dec 2019</span>
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 15 15" preserveAspectRatio="xMidYMid meet" size="14" width="14" height="14" class="sc-kGXeez dycctd">
                                                <path d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"></path>
                                            </svg>
                                        </li>
                                        <li class="sc-jGxEUC jmbUJj">
                                            <svg focusable="false" color="greenLimeDark" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez cwzVtt">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>Pay later option available</span>
                                        </li>
                                        <li>
                                            <i class=""></i>
                                            <i class="dot"></i>
                                            <span class="text-dark">Room only</span>
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
                                    Fits 2
                                </div>
                            </div>
                            <div class="total-stay-price">
                                <div class="room-service-title">
                                    Total For Stay
                                </div>
                                <div class="room-total-price">
                                    AED 939
                                </div>
                                <div class="room-stay">
                                    Total for 1 night
                                </div>
                            </div>
                            <div class="room-booknow">
                                <button type="button" class="btn-select-room btn-block">
                                    Save to Trip
                                </button>

                                <input id="" name="" type="checkbox" value="1">
                                <span class="fs-12 text-muted">Email Itinerary</span>

                            </div>
                        </div>
                        <div class="HotelDetails-Room-Option">
                            <div class="include-room">
                                <div class="room-service-title">What’s Included</div>
                                <div class="include-room-contains">
                                    <div class="include-room-qty">Deluxe Twin</div>
                                    <ul class="room-cancelation-detail">
                                        <li class="sc-jGxEUC hqiHIh">
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez ekULev">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>FREE cancellation before 09 Dec 2019</span>
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 15 15" preserveAspectRatio="xMidYMid meet" size="14" width="14" height="14" class="sc-kGXeez dycctd">
                                                <path d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"></path>
                                            </svg>
                                        </li>
                                        <li class="sc-jGxEUC jmbUJj">
                                            <svg focusable="false" color="greenLimeDark" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez cwzVtt">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>Pay later option available</span>
                                        </li>
                                        <li>
                                            <i class=""></i>
                                            <i class="dot"></i>
                                            <span class="text-dark">Room only</span>
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
                                    Fits 2
                                </div>
                            </div>
                            <div class="total-stay-price">
                                <div class="room-service-title">
                                    Total For Stay
                                </div>
                                <div class="room-total-price">
                                    AED 939
                                </div>
                                <div class="room-stay">
                                    Total for 1 night
                                </div>
                            </div>
                            <div class="room-booknow">
                                <button type="button" class="btn-select-room btn-block">
                                    Save to Trip
                                </button>

                                <input id="" name="" type="checkbox" value="1">
                                <span class="fs-12 text-muted">Email Itinerary</span>

                            </div>
                        </div>
                        <div class="HotelDetails-Room-Option">
                            <div class="include-room">
                                <div class="room-service-title">What’s Included</div>
                                <div class="include-room-contains">
                                    <div class="include-room-qty">Standard Double</div>
                                    <ul class="room-cancelation-detail">
                                        <li class="sc-jGxEUC hqiHIh">
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez ekULev">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>FREE cancellation before 09 Dec 2019</span>
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 15 15" preserveAspectRatio="xMidYMid meet" size="14" width="14" height="14" class="sc-kGXeez dycctd">
                                                <path d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"></path>
                                            </svg>
                                        </li>
                                        <li class="sc-jGxEUC jmbUJj">
                                            <svg focusable="false" color="greenLimeDark" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez cwzVtt">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>Pay later option available</span>
                                        </li>
                                        <li>
                                            <i class=""></i>
                                            <i class="dot"></i>
                                            <span class="text-dark">Bed and Breakfast</span>
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
                                    Fits 2
                                </div>
                            </div>
                            <div class="total-stay-price">
                                <div class="room-service-title">
                                    Total For Stay
                                </div>
                                <div class="room-total-price">
                                    AED 939
                                </div>
                                <div class="room-stay">
                                    Total for 1 night
                                </div>
                            </div>
                            <div class="room-booknow">
                                <button type="button" class="btn-select-room btn-block">
                                    Save to Trip
                                </button>

                                <input id="" name="" type="checkbox" value="1">
                                <span class="fs-12 text-muted">Email Itinerary</span>

                            </div>
                        </div>
                        <div class="HotelDetails-Room-Option">
                            <div class="include-room">
                                <div class="room-service-title">What’s Included</div>
                                <div class="include-room-contains">
                                    <div class="include-room-qty">Deluxe Twin</div>
                                    <ul class="room-cancelation-detail">
                                        <li class="sc-jGxEUC hqiHIh">
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez ekULev">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>FREE cancellation before 09 Dec 2019</span>
                                            <svg focusable="false" color="inherit" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 15 15" preserveAspectRatio="xMidYMid meet" size="14" width="14" height="14" class="sc-kGXeez dycctd">
                                                <path d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"></path>
                                            </svg>
                                        </li>
                                        <li class="sc-jGxEUC jmbUJj">
                                            <svg focusable="false" color="greenLimeDark" fill="currentcolor" aria-hidden="true" role="presentation" viewBox="0 0 10 8" preserveAspectRatio="xMidYMid meet" size="10" width="10" height="10" class="sc-kGXeez cwzVtt">
                                                <path d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"></path>
                                            </svg>
                                            <span>Pay later option available</span>
                                        </li>
                                        <li>
                                            <i class=""></i>
                                            <i class="dot"></i>
                                            <span class="text-dark">Room only</span>
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
                                    Fits 2
                                </div>
                            </div>
                            <div class="total-stay-price">
                                <div class="room-service-title">
                                    Total For Stay
                                </div>
                                <div class="room-total-price">
                                    AED 939
                                </div>
                                <div class="room-stay">
                                    Total for 1 night
                                </div>
                            </div>
                            <div class="room-booknow">
                                <button type="button" class="btn-select-room btn-block">
                                    Save to Trip
                                </button>

                                <input id="" name="" type="checkbox" value="1">
                                <span class="fs-12 text-muted">Email Itinerary</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('plugins/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>

    <script src="./assets/js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/script.js"></script></body>
</body>
</html>