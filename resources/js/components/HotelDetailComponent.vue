<template>
    <section class="p-50" id="hotel-detail-component">
        <div class="hotel-detail-slider img-container">
            <div class="row no-gutters">
                <div class="col-md-6 pr-1-px">
                    <div class="row no-gutters" style="height: 500px;">
                        <div  class="col-12 mb-1-px " style="height: 67%;">
                            <img v-bind:src="hotel.slider_image"
                                 alt=""
                                 class="img-fluid w-100 h-100"/>
                        </div>
                        <div class="col-4 pr-1-px" style="height:33%">
                            <div class="hotel-map mb-0 h-100">
                                <div class="view-map">Map view</div>
                                <img class="img-fluid h-100 h-100"
                                     src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iMjc5Ljk2OSIgaGVpZ2h0PSI5MSI+CiAgICA8ZGVmcz4KICAgICAgICA8cmVjdCBpZD0iYSIgd2lkdGg9IjI3OS45NjkiIGhlaWdodD0iOTEiIC8+CiAgICAgICAgPGZpbHRlciBpZD0iYiIgd2lkdGg9IjI3OS45NjkiIGhlaWdodD0iOTEiIGZpbHRlclVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCI+CiAgICAgICAgICAgIDxmZU9mZnNldCBpbj0iU291cmNlQWxwaGEiIHJlc3VsdD0ic2hhZG93T2Zmc2V0T3V0ZXIxIi8+CiAgICAgICAgICAgIDxmZUdhdXNzaWFuQmx1ciBpbj0ic2hhZG93T2Zmc2V0T3V0ZXIxIiByZXN1bHQ9InNoYWRvd0JsdXJPdXRlcjEiIC8+CiAgICAgICAgICAgIDxmZUNvbG9yTWF0cml4IGluPSJzaGFkb3dCbHVyT3V0ZXIxIiB2YWx1ZXM9IjAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAuMSAwIi8+CiAgICAgICAgPC9maWx0ZXI+CiAgICA8L2RlZnM+CiAgICA8ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPgogICAgICAgIDxtYXNrIGlkPSJjIiBmaWxsPSIjZmZmIj4KICAgICAgICAgICAgPHVzZSB4bGluazpocmVmPSIjYSIvPgogICAgICAgIDwvbWFzaz4KICAgICAgICA8dXNlIGZpbGw9IiMwMDAiIGZpbHRlcj0idXJsKCNiKSIgeGxpbms6aHJlZj0iI2EiLz4KICAgICAgICA8dXNlIGZpbGw9IiNGRkYiIHhsaW5rOmhyZWY9IiNhIi8+CiAgICAgICAgPGcgbWFzaz0idXJsKCNjKSI+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNENEU4RjQiIGQ9Ik0uMDE1IDIyOS41MzdoMjc5Ljk3Vi4wMTNILjAxNXoiLz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0ZGRiIgZD0iTS4wMTUgMjI5LjUzN2gyNzkuOTdWLjAxM0guMDE1eiIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjQ0VDRUM4IiBkPSJNMCAyMjkuNTI0aDI3OS45N1YwSDB6Ii8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiM5NkJCRTciIGQ9Ik04OC4wMTggMjI5LjUzN2w3OC4wODktNDEuODE2YzMuNDk3LTEuODcyIDYuNjQtNC4xMTcgOS4zNjUtNi42NDlhNDAuNjAzIDQwLjYwMyAwIDAgMCAzLjI4NS0zLjQyMiAzOC4wNzIgMzguMDcyIDAgMCAwIDMuNzYyLTUuMjQyYzIuNTI0LTQuMjUyIDQuMDk5LTguODkgNC41NTMtMTMuNjc0IDEuOTg3LTIwLjkxIDE4LjkyLTM4LjgzMyA0My4xNC00NS42NjNsNDkuNzczLTE0LjAzNHYxNS4yNjVsLTQ0LjAzIDEyLjQxNmMtMTcuNTc2IDQuOTU1LTI5Ljg2NSAxNy45NjEtMzEuMzA1IDMzLjEzNS0uNTAyIDUuMjgtMiAxMC41MDYtNC4zOTkgMTUuNDMzYTQ5LjA3MyA0OS4wNzMgMCAwIDEtMy4wMTQgNS4zMSA0OS41NTIgNDkuNTUyIDAgMCAxLTIuMjQ5IDMuMTcxYy0uMTA3LjE0LS4yMTYuMjgtLjMyNS40Mi00Ljg3IDYuMjA1LTExLjM2OCAxMS41NzctMTguOTA1IDE1LjYxNGwtNTUuNTMyIDI5LjczNkg4OC4wMTh6TTE2NC44MDUuMDEzaDExNS4xOHYyOS42NjZjLTExLjkzMiAxLjE0Mi00Mi4wNjYgMy40MS02Ni4wODYuMDMtMjEuNDkyLTMuMDI0LTM5Ljk2Ny0xOS44ODItNDkuMDk0LTI5LjY5NnoiLz4KICAgICAgICAgICAgPHBhdGggZmlsbD0iI0UyRTVFNyIgZD0iTTM4LjcwNSA2My44ODZsNDUuMDg5IDIwLjQ0NyAyLjc5LTEuNDE2aC4wMDJsODQuNTgzLTQyLjkwNS0yMy4yODYtMzEuNDA1LTEwOS4xNzggNTUuMjh6bS04LjAyMyA0LjA2M0wuMDE1IDgzLjQ3NnYtNy45MjNsMjIuNDEyLTExLjM0OEwuMDE1IDU0LjA0M3YtNy43MDFMMzAuNDUgNjAuMTQzIDE0My42MSAyLjg0N2wtMi4xLTIuODM0aDkuNjA4bDI4LjMyNiAzOC4yMDJoMTAwLjU0djYuNzEySDE3Ny4xMDlsLTI1LjA3NyAxMi43MiAzNS43NjUgNDguMzYgOTIuMTg5LTI4LjE5djcuMTg1bC05MC4zMyAyNy42Mi0yMS40NzQgNTUuNDAzLTIuNDY2IDEuMzE1LTMuNTkyIDEuOTE1LS4yNi4xNC4yMDEuMDMyIDM3LjA3IDUuOTkgODAuODUgMTMuMDY5djYuODY4bC04NC45MjYtMTMuNzI2LTE5LjA4OC0zLjA4NS0yMy43ODgtMy44NDUtLjIwNS0uMDMzLS4zNTQuMTg5LTk4LjE1MSA1Mi4zM0gzOC40MDlsNjYuNTQ5LTM1LjQ4Mi02MC4zMDItODEuNTktNDQuNjQgMjIuNjQ0di03LjkyN2w3NC44NzMtMzcuOTguODQ3LS40MjkuMDQyLS4wMjItNDUuMDk2LTIwLjQ1em0xMTMuMzggMTA0LjkwM2wtNjEuMS04MC4xNy0uMDc4LjA0LS44NzEuNDQyLTMwLjM1OCAxNS4zOTkgNjAuMjA2IDgxLjQ1OSAzMi4yMDItMTcuMTd6bTYuODkzLTMuNjc0bDEwLjI4My01LjQ4MyAyMC40OS01Mi44NjItMzYuNzA1LTQ5LjYzLTU1LjA3IDI3LjkzNCA2MS4wMDIgODAuMDR6TS4wMTUgMjQuMjM1TDQ3Ljc0NC4wMTNoMTUuNjg1TC4wMTUgMzIuMTk2di03Ljk2eiIvPgogICAgICAgICAgICA8cGF0aCBmaWxsPSIjQTJDMDg5IiBkPSJNLjAxNS4wMTNoMjcuMTc4TC4wMTUgMTMuODA1Vi4wMTN6bTAgMTUwLjEyNmwyMS0xMC42NWMyLjU5My0xLjMxNiA1Ljc4My0xLjU2IDguNjI2LS42NjIgOC4xMjggMi41NjcgMTUuMzkgNi41MDQgMjEuMzgxIDExLjQ3NCA1Ljk5MiA0Ljk3MiAxMC43MTIgMTAuOTc3IDEzLjc1NCAxNy42OCAyLjU0IDUuNTk1IDMuODMgMTEuNTA0IDMuODMgMTcuNDQgMCAyLjI4LS4xOTEgNC41NjMtLjU3MyA2LjgzNWwtMS4yOSA3LjY2MmMtLjM4NiAyLjI5OC0xLjk2NiA0LjM0NS00LjMzIDUuNjE0bC00NC43NjkgMjQuMDA1SC4wMTV2LTc5LjM5OHptMTgxLjEzNi05NS42NjNoODIuOTA1YzEuMTc0IDAgMi4xMjQuNzc4IDIuMTI0IDEuNzM4djE0LjkzYzAgLjczMy0uNTY0IDEuMzg5LTEuNDA5IDEuNjM2bC03MS4yOSAyMC44NWMtLjk0NS4yNzctMS45OTgtLjAyNS0yLjUyNC0uNzI1TDE2OC4xNCA2Mi41NjJjLS42MjItLjgyNy0uMjk1LTEuOTEuNzI1LTIuNDA3bDExLjIwMi01LjQzNmEyLjQ4IDIuNDggMCAwIDEgMS4wODQtLjI0M3ptNTMuOTcgMTc1LjA2bDEuMjgyLTUuNDM4YzMuMjExLTEzLjYyIDE5LjM2My0yMi41NCAzNi4wNzUtMTkuOTIybDcuNTA3IDEuMTc2djI0LjE4NUgyMzUuMTJ6Ii8+CiAgICAgICAgICAgIDxwYXRoIGZpbGw9IiNCQkJCQjciIGQ9Ik0xNjcuMTU0IDExOC41OTRsLTkuNTQgMjQuNjcyYy0xLjQzNSAzLjcxMy03LjUyOCA0LjMwNi05Ljk4Ljk3MmwtMzUuMDY4LTQ3LjY4M2MtMi40NDUtMy4zMjUtMS4yMDUtNy42NDUgMi43OS05LjcyM2wxNy4yNC04Ljk2N2M0LjEyMi0yLjE0MyA5LjU4NS0xLjA4MyAxMi4xIDIuMzUxbDIxLjA4IDI4Ljc2OWMyLjEyIDIuODkyIDIuNjIxIDYuMzkyIDEuMzc4IDkuNjA5em0tNDMuNzktNjIuNTc1Yy0uODg0LjQ0NC0yLjAzNi4yMTItMi41NzQtLjUxOGwtMTIuMjI0LTE2LjYwN2MtLjUzOC0uNzMtLjI1Ni0xLjY4MS42MjgtMi4xMjRsMzQuMDctMTcuMDgyYy44ODQtLjQ0MiAyLjAzNi0uMjEgMi41NzMuNTE5bDEyLjIyNSAxNi42MDhjLjUzNi43My4yNTUgMS42OC0uNjI5IDIuMTIzbC0zNC4wNyAxNy4wODF6bS00My4yMDctNC4wOWwuMDE3LjAyNCAxOC42MzUtOS4yOTYuMDA4LjAxYy44NS0uNDI1IDEuOTU5LS4yMDIgMi40NzcuNDk2bDEyLjM0NSAxNi42OWMuNTE3LjY5OS4yNDYgMS42MS0uNjA1IDIuMDM0bC03Ljg1IDMuOTE2Yy0uODUuNDI0LTEuOTU4LjIwMi0yLjQ3NS0uNDk3bC0zLjAwNC00LjA2Yy0uNTE3LS42OTktMS42MjYtLjkyMi0yLjQ3Ny0uNDk3bC02LjE2NCAzLjA3NGMtLjg1LjQyNS0xLjEyMSAxLjMzNi0uNjA1IDIuMDM1bDIuOTc5IDQuMDI2Yy41MTcuNjk5LjI0NiAxLjYxLS42MDUgMi4wMzRsLTcuODUgMy45MTZjLS44NS40MjQtMS45NTguMjAyLTIuNDc1LS40OTdsLTEyLjM0Ni0xNi42OWMtLjUxNy0uNjk4LS4yNDYtMS42MDkuNjA1LTIuMDMzbDkuMzktNC42ODR6bTMzLjkwMi00My41NmMuNTQuNzI5LjI1NiAxLjY3OC0uNjMyIDIuMTJMODIuMzYxIDI1Ljk2Yy0uODg4LjQ0Mi0yLjA0NS4yMS0yLjU4NS0uNTE3bC00Ljg1OC02LjU1NWMtLjUzOC0uNzI4LS4yNTYtMS42NzcuNjMyLTIuMTJsMzEuMDY2LTE1LjQ2OWMuODg4LS40NDIgMi4wNDYtLjIxIDIuNTg2LjUxOGw0Ljg1NyA2LjU1M3ptLTQ4LjYzLTIuNTRjLS41NC0uNzI1LS4yNTgtMS42NzIuNjMtMi4xMTJMNzMuNTMuMDEzaDI1LjI3NGwtMjUuOTMgMTIuODYxYy0uODg5LjQ0MS0yLjA0Ny4yMS0yLjU4Ny0uNTE2TDY1LjQzIDUuODN6bS0zMy45NDcgNDUuMjRjLS44ODQuNDQyLTIuMDM2LjIxLTIuNTczLS41MThMMTYuNjggMzMuOTU3Yy0uNTM4LS43MjktLjI1Ni0xLjY3OC42MjgtMi4xMjFsMzguMzc5LTE5LjIyYy44ODUtLjQ0MyAyLjAzNy0uMjEyIDIuNTc1LjUxN0w3MC40OSAyOS43MjdjLjUzNi43MjguMjU1IDEuNjc4LS42MyAyLjEyMWwtMzguMzc5IDE5LjIyek0uMDE1IDkxLjI5N2wyOC4wMTYtMTMuOTYzYy44ODctLjQ0MSAyLjA0NC0uMjEgMi41ODIuNTE3TDQyLjg4IDk0LjQxOGMuNTQuNzI3LjI1NyAxLjY3NS0uNjMgMi4xMThMMS40OSAxMTYuODVjLS40Ni4yMjktLjk5My4yNzctMS40NzUuMTY3di0yNS43MnptMTk0LjEyNCAxMzguMjRsNC40MjQtMTguOTQyYy4yNDUtMS4wNSAxLjQ3OC0xLjczNyAyLjc1My0xLjUzNWwyNy4xNTIgNC4yOTRjMS4yNzQuMjAxIDIuMTEgMS4yMTUgMS44NjQgMi4yNjVsLTMuMjUgMTMuOTE4SDE5NC4xNHptOS4yNS0yNS43ODdjLTEuMjgxLS4yLTIuMTItMS4xOTgtMS44NzQtMi4yMzFsMS41NS02LjUwOWMuMjQ3LTEuMDM0IDEuNDg0LTEuNzEgMi43NjQtMS41MTJsMjYuOTQ0IDQuMThjMS4yOC4xOTggMi4xMTkgMS4xOTcgMS44NzMgMi4yM2wtMS41NSA2LjUxYy0uMjQ2IDEuMDMzLTEuNDgzIDEuNzEtMi43NjQgMS41MTFsLTI2Ljk0NC00LjE4em01NS4yMDUtMjYuNzMxYy0xLjI3Mi0uMi0yLjEwNy0xLjIwNS0xLjg2MS0yLjI0NGwzLjYzOS0xNS40NzVjLjI0NC0xLjA0IDEuNDc1LTEuNzIxIDIuNzQ2LTEuNTJsMTYuODY3IDIuNjQ4djE5Ljk1bC0yMS4zOS0zLjM1OXptLTExLjY0My0yNy4yNjhjLTEuMjc1LS4xOTktMi4xMTItMS4yMDMtMS44NjYtMi4yNGwzLjY0OS0xNS40NDZjLjI0Ni0xLjAzNyAxLjQ3OS0xLjcxOCAyLjc1NS0xLjUxOGwyOC40OTYgNC40NTV2MTkuOTEzbC0zMy4wMzQtNS4xNjR6bS0yOS43NzQgMjAuMDg4Yy0xLjI3LS4yLTIuMTAxLTEuMjEtMS44NTgtMi4yNTVsMS45MzMtOC4yNzZjLjI0NC0xLjA0NSAxLjQ3Mi0xLjczIDIuNzQxLTEuNTI5bDI2LjE2OSA0LjEzOGMxLjI3LjIwMiAyLjEwMSAxLjIxMSAxLjg1OCAyLjI1N2wtMS45MzMgOC4yNzRjLS4yNDQgMS4wNDYtMS40NzIgMS43My0yLjc0MSAxLjUzbC0yNi4xNjktNC4xMzl6TTc2LjcxMiAxMjUuMzNjLS42NzUtLjkxMy0uMzE4LTIuMS43OTctMi42NTFMODguOTc0IDExN2MxLjExNS0uNTUyIDIuNTY1LS4yNiAzLjI0LjY1M2wyMC45MTUgMjguM2MuNjc0LjkxMi4zMTggMi4xLS43OTggMi42NTJsLTExLjQ2NSA1LjY3OGMtMS4xMTQuNTUyLTIuNTY0LjI2LTMuMjM4LS42NTJsLTIwLjkxNi0yOC4zMDJ6bTI2LjMyNyAzNS43MjNjLS43LS45NDYtLjMzLTIuMTc2LjgyNy0yLjc0OGwxMS4yNi01LjU3NWMxLjE1NS0uNTcyIDIuNjYtLjI3IDMuMzU4LjY3Nmw4Ljc4IDExLjg3M2MyLjU4IDMuNDkgMS4yMTUgOC4wMzEtMy4wNTEgMTAuMTQyLTQuMjY1IDIuMTEyLTkuODE0Ljk5NC0xMi4zOTUtMi40OTVsLTguNzgtMTEuODczem0tMzcuOTc0LTUwLjk4NmMtLjY3Ni0uOTA2LS4zMTgtMi4wODUuOC0yLjYzM2wxMS41MDUtNS42NDNjMS4xMTgtLjU0OCAyLjU3NC0uMjU5IDMuMjUuNjQ5bDUuMzMgNy4xNDJjLjY3Ny45MDYuMzE5IDIuMDg1LS44IDIuNjM0bC0xMS41MDQgNS42NDJjLTEuMTE4LjU0OS0yLjU3NC4yNTgtMy4yNS0uNjQ4bC01LjMzLTcuMTQzem0xMDkuNjYyIDExOS40N2w1LjA0NS0yMS43NjZjLjI0NC0xLjA1MyAxLjQ3LTEuNzQxIDIuNzM5LTEuNTRsNS44NDguOTMyYzEuMjY4LjIwMyAyLjEgMS4yMiAxLjg1NSAyLjI3MmwtNC42NiAyMC4xMDNoLTEwLjgyN3oiLz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPgo="
                                />
                            </div>
                        </div>
                        <div class="col-4 pr-1-px" style="height:33%">
                            <img v-bind:src="Images[0]"
                                 alt=""
                                 class="img-fluid w-100 h-100"
                            />
                        </div>
                        <div class="col-4" style="height:33%">
                            <img
                                    v-bind:src="Images[1]"
                                    alt=""
                                    class="img-fluid w-100 h-100"
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row no-gutters" style="height: 500px;">
                        <div class="col-6 h-50 pr-1-px mb-1-px">
                            <img
                                    v-bind:src="Images[2]"
                                    alt=""
                                    class="img-fluid w-100 h-100"
                            />
                        </div>
                        <div class="col-6 h-50 pr-1-px mb-1-px">
                            <img
                                    v-bind:src="Images[3]"
                                    alt=""
                                    class="img-fluid w-100 h-100"
                            />
                        </div>
                        <div class="col-6 h-50 pr-1-px mb-1-px">
                            <img
                                    v-bind:src="Images[4]"
                                    alt=""
                                    class="img-fluid w-100 h-100"
                            />
                        </div>
                        <div class="col-6 h-50 pr-1-px mb-1-px">
                            <img
                                    v-bind:src="Images[5]"
                                    alt=""
                                    class="img-fluid w-100 h-100"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="hotel-gallary-seemore">
                See all<!-- -->
                <!-- -->38<!-- -->
                <!-- -->photos
            </div>
        </div>
        <div class="hotel-detail-wrapper">
            <div class="container">
                <div class="nav hotel-detail-nav">
                    <a href="#" class="nav-item active">Photos</a>
                    <a href="#room-choices" class="nav-item">Room Choices</a>
                    <a href="#about-hotel" class="nav-item">About The Hotel</a>
                    <a href="#hotel-aminities" class="nav-item">Hotel Amenities</a><a href="#hotel-detail-review" class="nav-item">Reviews</a><a href="#similar-hotels" class="nav-item">Similar Hotels</a>
                </div>
                <div class="d-flex justify-content-between flex-wrap mb-3">
                    <div class="d-flex flex-column align-items-start">
                        <div>
                            <h3 class="hotel-detail-title">{{hotel.company_name}}</h3>
                        </div>
                        <div class="hotel-address">
                            <i class="fas fa-map-marker-alt"></i>
                            {{hotel.address}}
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="d-flex text-right ml-3">
                            <div class="mr-2">
                                <div class="hotel-detail-rate-text">{{getTripAdvisarRating(hotel.TripAdvisorRation)}}</div>
                                <div class="font-size-12 text-muted">
                                </div>
                                <div class="font-size-12">
                                    Reviews by TripAdvisor
                                </div>
                            </div>
                            <div class="eVgktJ">
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
                                        class="sc-bxivhb wwKZm"
                                >
                                    <path
                                            fill="currentColor"
                                            fill-rule="evenodd"
                                            d="M31.039 42.668L19.497 53.563c-.964.91-2.684.304-2.684-.945v-9.95H2.273A2.273 2.273 0 0 1 0 40.395V2.273A2.273 2.273 0 0 1 2.273 0h55.454A2.273 2.273 0 0 1 60 2.273v38.122a2.273 2.273 0 0 1-2.273 2.273H31.04z"
                                    ></path>
                                </svg
                                >
                                <span>{{hotel.TripAdvisorRation}}</span>
                            </div>
                        </div>
                    </div>
                </div><div class="hotel-modify-back hide"></div>
                <div class="hotel-detail-modify">

                    <div class="row">
                        <div class="col-12">
                            <div class="modiify-head">
                                <div class="font-weight-bold font-size-14">SEARCH SUMMARY</div>
                                <button type="button" class="btn btn-danger text-white" id="btn-hotel-modify">
                                    Modify search
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row no-gutters px-3 py-2">
                        <div class="col-4">
                            <div class="hotel-detail-form d-flex align-items-center">
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
                                        class="mr-2"
                                >
                                    <path
                                            d="M91.1 71.2l23.5 18.9c1.1.9 1.7 2.2 1.7 3.6s-.6 2.7-1.8 3.6L91 115.8c-2 1.6-4.9 1.2-6.4-.8-1.6-2-1.2-4.9.8-6.4l13.1-10.3H37.8c-2.5 0-4.6-2.1-4.6-4.6s2.1-4.6 4.6-4.6h60.9L85.4 78.4c-1.9-1.7-2.1-4.6-.4-6.5 1.5-1.8 4.2-2.1 6.1-.7zM0 25.5v108c0 6.6 5.4 12 12 12h126c6.6 0 12-5.4 12-12v-108c0-6.6-5.4-12-12-12h-24v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H42v-6c0-1.7-1.3-3-3-3s-3 1.3-3 3v6H12c-6.6 0-12 5.4-12 12zm6 24h138v84c0 3.3-2.7 6-6 6H12c-3.3 0-6-2.7-6-6v-84zm0-24c0-3.3 2.7-6 6-6h24v6.8c-2.9 1.7-3.9 5.3-2.2 8.2 1.7 2.9 5.3 3.9 8.2 2.2 2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h66v6.8c-2.9 1.7-3.9 5.3-2.2 8.2s5.3 3.9 8.2 2.2c2.9-1.7 3.9-5.3 2.2-8.2-.5-.9-1.3-1.7-2.2-2.2v-6.8h24c3.3 0 6 2.7 6 6v18H6v-18z"
                                    ></path>
                                </svg>
                                <span class="">04 Nov 2019</span>
                            </div>
                        </div>
                        <div class="col-4 px-2">
                            <div class="hotel-detail-form d-flex align-items-center">
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
                                        class="mr-2"
                                >
                                    <path
                                            d="M40.6 73.9c1.2 1 2.8.8 3.8-.3 1-1.2.8-2.8-.3-3.8l-.1-.1-7.7-6.1h35.6c1.5 0 2.7-1.2 2.7-2.7s-1.2-2.7-2.7-2.7H36.1l7.8-6.3c1.2-1 1.4-2.6.4-3.8s-2.6-1.4-3.8-.4L26.8 58.8c-.6.5-1 1.3-1 2.2 0 .8.4 1.6 1 2.1l13.8 10.8z"
                                    ></path>
                                    <path
                                            d="M90.4 10.6H75V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H28.8V6.8c-.2-1.1-1.3-1.8-2.4-1.6-.8.2-1.4.8-1.6 1.6v3.8H9.6C5.4 10.6 2 14 2 18.3v69.2c0 4.2 3.4 7.6 7.6 7.6h80.7c4.2 0 7.6-3.4 7.6-7.6V18.3c.1-4.3-3.3-7.7-7.5-7.7zm3.8 76.9c0 2.2-1.8 3.8-3.8 3.8H9.6c-2.2 0-3.8-1.8-3.8-3.8V33.6h88.4v53.9zm.1-57.7H5.8V18.3c0-2.2 1.8-3.8 3.8-3.8H25v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h42.3v4.4c-1.9 1.1-2.5 3.4-1.4 5.3s3.4 2.5 5.3 1.4 2.5-3.4 1.4-5.3c-.3-.6-.8-1.1-1.4-1.4v-4.4h15.4c2.2 0 3.8 1.8 3.8 3.8v11.5z"
                                    ></path>
                                </svg>
                                <span class="">05 Nov 2019</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div
                                    class="hotel-detail-form d-flex align-items-center justify-content-between"
                            >
                                <div>
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
                                            class="mr-2"
                                    >
                                        <circle cx="75" cy="37.5" r="37.5"></circle>
                                        <path
                                                d="M138 112.5c-39.3-20.2-86-20.2-125.2 0C4.9 116.9.1 125.2 0 134.2V150h150v-15.8c.1-8.8-4.5-17.1-12-21.7z"
                                        ></path>
                                    </svg>
                                    <span>1 room, 2 guests</span>
                                </div>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="room-section" id="room-choices">
                    <div class="room-container">
                        <div class="room-type-title">
                            <h3>Club Room</h3>
                        </div>
                        <div class="inner-room">
                            <div class="room-items">
                                <div class="room-images">
                                    <img
                                            src="https://imgproc.tjwlcdn.com/fit-in/500x0/https://hotelcmsimages.s3-eu-west-1.amazonaws.com/room/hotels/2000000/1700000/1696200/1696177/518814d3_z.jpg"
                                    />
                                    <div>
                                        <span>More photos</span>
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 18 16"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="14"
                                                width="14"
                                                height="14"
                                                class="sc-bxivhb dDEJnk"
                                        >
                                            <g fill="none" fill-rule="nonzero">
                                                <path d="M0-1h18v18H0z"></path>
                                                <path
                                                        fill="currentColor"
                                                        d="M16.875 3.429v11.428h-13.5V3.43h13.5zM18 2.286H2.25V16H18V2.286zM4.5 12.57h11.25L13.5 5.714l-3.375 4.572L7.875 8 4.5 12.571zm1.125-6.857c-.622 0-1.125.511-1.125 1.143S5.003 8 5.625 8 6.75 7.489 6.75 6.857s-.503-1.143-1.125-1.143zM0 0v13.714h1.125V1.143H15.75V0H0z"
                                                ></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="room-bed">
                                        <span> 2 twin beds</span>
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 16 16"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="15"
                                                width="15"
                                                height="15"
                                                class="sc-kGXeez cxEqkg"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M1 13v-3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3H1zm9-6H6V6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1zM3 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v4h-2V6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2v1H3V3zm11 4.185V3c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v4.185A2.995 2.995 0 0 0 0 10v6h1v-2h14v2h1v-6a2.993 2.993 0 0 0-2-2.815z"
                                            ></path>
                                        </svg>
                                        <svg
                                                focusable="false"
                                                color="inherit"
                                                fill="currentcolor"
                                                aria-hidden="true"
                                                role="presentation"
                                                viewBox="0 0 16 16"
                                                preserveAspectRatio="xMidYMid meet"
                                                size="15"
                                                width="15"
                                                height="15"
                                                class="sc-kGXeez cxEqkg"
                                        >
                                            <path
                                                    fill="currentColor"
                                                    fill-rule="evenodd"
                                                    d="M1 13v-3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3H1zm9-6H6V6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1zM3 3a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v4h-2V6c0-1.103-.897-2-2-2H7c-1.103 0-2 .897-2 2v1H3V3zm11 4.185V3c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v4.185A2.995 2.995 0 0 0 0 10v6h1v-2h14v2h1v-6a2.993 2.993 0 0 0-2-2.815z"
                                            ></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="room-aminities">
                                    <div>
                                        <img
                                                src="https://www.tajawal.ae/assets/icons/amenities/icon-roomsize.svg"
                                                alt="Size: 38m2"
                                        />
                                        <span>Size: 38 m<sup>2</sup></span>
                                    </div>
                                    <div>
                                        <img
                                                src="https://hotelcms-contents-live.tajawal.com/amenity-search-blackIcon-190.png"
                                                alt="Wi-Fi"
                                        />
                                        <span>Wi-Fi</span>
                                    </div>
                                    <div>
                                        <img
                                                src="https://hotelcms-contents-live.tajawal.com/amenity-search-blackIcon-184.png"
                                                alt="Air conditioning"
                                        />
                                        <span>Air conditioning</span>
                                    </div>
                                    <div>
                                        <img
                                                src="https://hotelcms-contents-live.tajawal.com/amenity-search-blackIcon-188.png"
                                                alt="Soundproofing"
                                        />
                                        <span>Soundproofing</span>
                                    </div>
                                    <div>
                                        <img
                                                src="https://hotelcms-contents-live.tajawal.com/amenity-search-blackIcon-147.png"
                                                alt="TV"
                                        />
                                        <span>TV</span>
                                    </div>
                                </div>
                                <a
                                        class="font-size-12 text-danger text-decoration-none"
                                        role="button"
                                        href="#"
                                >
                                    Show 10 more
                                    <svg
                                            focusable="false"
                                            color="inherit"
                                            fill="currentcolor"
                                            aria-hidden="true"
                                            role="presentation"
                                            viewBox="0 0 150 150"
                                            preserveAspectRatio="xMidYMid meet"
                                            width="10px"
                                            height="10px"
                                            class=""
                                    >
                                        <path
                                                d="M86.8 118.6l60.1-61.5c5.5-5.7 5.5-14.8 0-20.5l-5-5.1c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2L76 78.4 30.1 31.5c-5.4-5.5-14.3-5.6-19.8-.2l-.2.2-5 5.1c-5.5 5.7-5.5 14.8 0 20.5l60.1 61.5c2.8 2.9 6.8 4.4 10.8 4.1 4 .3 8-1.3 10.8-4.1z"
                                        ></path>
                                    </svg>
                                </a>
                            </div>
                            <div class="room-details">
                                <div class="HotelDetails-Room-Option">
                                    <div class="include-room">
                                        <div class="room-service-title">What’s Included</div>
                                        <div class="include-room-contains">
                                            <div class="include-room-qty">Room only</div>
                                            <ul class="room-cancelation-detail">
                                                <li class="sc-jGxEUC hqiHIh">
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez ekULev"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
                                                    <span>FREE cancellation before 09 Dec 2019</span
                                                    >
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 15 15"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="14"
                                                            width="14"
                                                            height="14"
                                                            class="sc-kGXeez dycctd"
                                                    >
                                                        <path
                                                                d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"
                                                        ></path>
                                                    </svg>
                                                </li>
                                                <li class="sc-jGxEUC jmbUJj">
                                                    <svg
                                                            focusable="false"
                                                            color="greenLimeDark"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez cwzVtt"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
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
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                                <div class="HotelDetails-Room-Option">
                                    <div class="include-room">
                                        <div class="room-service-title">What’s Included</div>
                                        <div class="include-room-contains">
                                            <div class="include-room-qty">Room only</div>
                                            <ul class="room-cancelation-detail">
                                                <li class="sc-jGxEUC hqiHIh">
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez ekULev"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
                                                    <span>FREE cancellation before 09 Dec 2019</span
                                                    >
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 15 15"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="14"
                                                            width="14"
                                                            height="14"
                                                            class="sc-kGXeez dycctd"
                                                    >
                                                        <path
                                                                d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"
                                                        ></path>
                                                    </svg>
                                                </li>
                                                <li class="sc-jGxEUC jmbUJj">
                                                    <svg
                                                            focusable="false"
                                                            color="greenLimeDark"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez cwzVtt"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
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
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                                <div class="HotelDetails-Room-Option">
                                    <div class="include-room">
                                        <div class="room-service-title">What’s Included</div>
                                        <div class="include-room-contains">
                                            <div class="include-room-qty">Room only</div>
                                            <ul class="room-cancelation-detail">
                                                <li class="sc-jGxEUC hqiHIh">
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez ekULev"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
                                                    <span>FREE cancellation before 09 Dec 2019</span
                                                    >
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 15 15"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="14"
                                                            width="14"
                                                            height="14"
                                                            class="sc-kGXeez dycctd"
                                                    >
                                                        <path
                                                                d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"
                                                        ></path>
                                                    </svg>
                                                </li>
                                                <li class="sc-jGxEUC jmbUJj">
                                                    <svg
                                                            focusable="false"
                                                            color="greenLimeDark"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez cwzVtt"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
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
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                                <div class="HotelDetails-Room-Option">
                                    <div class="include-room">
                                        <div class="room-service-title">What’s Included</div>
                                        <div class="include-room-contains">
                                            <div class="include-room-qty">Room only</div>
                                            <ul class="room-cancelation-detail">
                                                <li class="sc-jGxEUC hqiHIh">
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez ekULev"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
                                                    <span>FREE cancellation before 09 Dec 2019</span
                                                    >
                                                    <svg
                                                            focusable="false"
                                                            color="inherit"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 15 15"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="14"
                                                            width="14"
                                                            height="14"
                                                            class="sc-kGXeez dycctd"
                                                    >
                                                        <path
                                                                d="M8.758 11.602c-.38.15-.683.264-.91.343-.226.079-.49.118-.789.118-.46 0-.818-.112-1.073-.337a1.087 1.087 0 0 1-.382-.854c0-.134.01-.272.029-.412.019-.14.05-.298.091-.474l.476-1.68c.042-.162.078-.315.107-.457a2.01 2.01 0 0 0 .042-.396c0-.214-.044-.364-.132-.448-.09-.084-.258-.126-.508-.126-.123 0-.249.019-.378.057-.129.039-.24.075-.331.11l.126-.518c.31-.127.609-.235.893-.325a2.64 2.64 0 0 1 .807-.137c.457 0 .809.112 1.057.332a1.1 1.1 0 0 1 .371.86c0 .073-.008.201-.025.385a2.58 2.58 0 0 1-.095.507L7.66 9.825a4.739 4.739 0 0 0-.105.46 2.49 2.49 0 0 0-.045.391c0 .223.049.375.149.455.099.08.272.121.517.121a1.5 1.5 0 0 0 .391-.06c.145-.04.25-.076.316-.106l-.127.516zm-.084-6.798a1.13 1.13 0 0 1-.797.307 1.14 1.14 0 0 1-.8-.307.982.982 0 0 1-.333-.746c0-.29.112-.54.333-.747a1.13 1.13 0 0 1 .8-.311c.31 0 .577.103.797.31a.99.99 0 0 1 .331.748c0 .292-.11.54-.331.746zM7.5 15C3.343 15 0 11.636 0 7.545 0 3.364 3.343 0 7.5 0S15 3.364 15 7.545C14.91 11.636 11.566 15 7.5 15zM7.5.91C3.886.91.904 3.91.904 7.544c0 3.637 2.891 6.546 6.506 6.546 3.614 0 6.506-2.91 6.506-6.546S11.024.91 7.5.91z"
                                                        ></path>
                                                    </svg>
                                                </li>
                                                <li class="sc-jGxEUC jmbUJj">
                                                    <svg
                                                            focusable="false"
                                                            color="greenLimeDark"
                                                            fill="currentcolor"
                                                            aria-hidden="true"
                                                            role="presentation"
                                                            viewBox="0 0 10 8"
                                                            preserveAspectRatio="xMidYMid meet"
                                                            size="10"
                                                            width="10"
                                                            height="10"
                                                            class="sc-kGXeez cwzVtt"
                                                    >
                                                        <path
                                                                d="M9.83 1.21L4.5 7.76A.65.65 0 0 1 4 8a.67.67 0 0 1-.42-.16L.25 4.93a.77.77 0 0 1-.1-1A.62.62 0 0 1 1 3.75h.06l2.86 2.52 4.92-6a.62.62 0 0 1 .88-.12l.06.06a.76.76 0 0 1 .05 1z"
                                                        ></path>
                                                    </svg
                                                    >
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
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section id="hotel-aminities" class="hotel-aminates-section">
                    <h3 class="hotel-aminities-title">Hotel Amenities</h3>
                    <div class="hotel-aminities-container">
                        <div class="row">
                            <div v-for="amenity in hotel.amenities" class="col-md-3">
                                <div class="aminities-inner-sub-data">
                                    <i class="fas fa-check"></i> <span>{{amenity}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="about-hotel" class="about-hotel">
                    <h3 class="about-hotel-heading">About the hotel</h3>
                    <div class="about-hotel-container">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="about-hotel-heading">Hotel description</h3>
                                <div class="about-hotel-descript">
                                    <p class="hotel-about-desc" v-html="hotel.description">
                                        {{ hotel.description }}
                                    </p>
                                </div>
                                <div class="hotel-about-loction">
                                    <h5 class="about-hotel-title">Location</h5>
                                    <p class="hotel-about-desc">{{hotel.address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</template>


<script>
    import * as _ from "lodash";
    export default {
        props: ['payload'],
        data() {
            return {
                hotel: [],
                Images: [],
                orignal_hotels: [],
                params: {},
                ActiveFiltration : "",
                NameHotel : "",
                HotelStars : [],
                HotelTripAdvisor : {2:0,3:0,4:0},
                HotelStarModel : [],
                HotelTripAdviserModel : [],
                base_urls : ""
            }
        },
        mounted() {
            this.base_urls = base_url;

            this.params = JSON.parse(this.payload);
            this.params.adults = Number(this.params.adults);
            this.params.children = Number(this.params.children);
            this.params.rooms = Number(this.params.rooms);
            axios.get(base_url + 'hotels/searchHotelDetails', {
                params: JSON.parse(this.payload)
            })
                .then((res) => {
                    if (true) {
                        this.$parent.loader = false;
                        this.hotel = res.data.hotels;
                        this.Images = this.hotel.images;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        methods: {
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
                rating = Number(rating)
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
                    this.hotels.forEach((item)=>{
                        if(this.in_array(item.trip_advisor_rating,this.HotelTripAdviserModel)){
                            filter_hotels.push(item);
                        }
                    });
                    this.hotels = filter_hotels;
                }
            }
        }
    }
</script>
