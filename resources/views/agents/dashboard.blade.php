@extends('layouts.app')
@section('breadcrumb')
    <section class="page-header page-header-xs">
        <div class="container">

            <h1>AGENT DASHBOARD</h1>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active">Agent Dashboard</li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
@endsection
@section('content')
<div class="container container-box">
<div class="row">
        @include('agents.sidebar')

    
        <div class="col-md-9 col-sm-9">
            <h3> Latest Bookings </h3>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#home" data-toggle="tab">Flights</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#profile" data-toggle="tab">Hotels</a></li>

            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="home">

                    <div class="table-responsive">

                        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="table-sm table-bordered fs-12">
                            <tbody>
                            <tr>
                                <th>B-ID</th>
                                <th>PNR</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <th>Customer Name</th>
                                <th>Dep On</th>
                                <th>AD</th>
                                <th>CH</th>
                                <th>IN</th>
                                <th>Date Of Booking</th>
                            </tr>
                            <tr>
                                <td>100901</td>
                                <td>5Q2JWQ</td>
                                <td>NBO</td>
                                <td>DAR</td>
                                <td>Mr Tom Smith</td>
                                <td>30/03/2018</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>22/03/2018</td>
                            </tr>
                            <tr>
                                <td>100803</td>
                                <td>3FJQTQ</td>
                                <td>DAR</td>
                                <td>MCT</td>
                                <td>Ms Evon Jay</td>
                                <td>30/03/2018</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>05/03/2018</td>
                            </tr>
                            <tr>
                                <td>100799</td>
                                <td>3BRFHI</td>
                                <td>DAR</td>
                                <td>MCT</td>
                                <td>Ms Evon Jay</td>
                                <td>30/03/2018</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>04/03/2018</td>
                            </tr>
                            <tr>
                                <td>100797</td>
                                <td>2GK9T2</td>
                                <td>NBO</td>
                                <td>MCT</td>
                                <td>Mr Tom Smith</td>
                                <td>30/03/2018</td>
                                <td>1</td>
                                <td>0</td>
                                <td>0</td>
                                <td>04/03/2018</td>
                            </tr>
                            <tr>
                                <td>100374</td>
                                <td>AQCGQ8</td>
                                <td>DXB</td>
                                <td>BOM</td>
                                <td>Mr Lewis Strauss</td>
                                <td>23/02/2018</td>
                                <td>2</td>
                                <td>0</td>
                                <td>0</td>
                                <td>12/01/2018</td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-outline-danger float-right"><a href="agent-flight-bookings.php">View All</a></button>

                    </div>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div class="table-responsive">

                        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="table-sm table-bordered fs-12">
                            <tbody>
                            <tr>
                                <th>B-ID</th>
                                <th>Hotel Name</th>
                                <th>Sector</th>
                                <th>Customer Name</th>
                                <th>Arrival Date</th>
                                <th>Departure Date</th>
                            </tr>
                            <tr>
                                <td>100859</td>
                                <td>HILTON GARDEN INN LONDON HEATHROW AIRPORT (ex. JURYS INN LONDON
                                    HEATHROW)</td>
                                <td>London</td>
                                <td>Tom Smith</td>
                                <td>30/07/2018</td>
                                <td>05/08/2018</td>
                            </tr>
                            <tr>
                                <td>100857</td>
                                <td>HILTON LONDON HEATHROW AIRPORT</td>
                                <td>London</td>
                                <td>Tom Smith</td>
                                <td>30/07/2018</td>
                                <td>05/08/2018</td>
                            </tr>
                            <tr>
                                <td>100854</td>
                                <td>HILTON GARDEN INN LONDON HEATHROW AIRPORT (ex. JURYS INN LONDON
                                    HEATHROW)</td>
                                <td>London</td>
                                <td>Tom Smith</td>
                                <td>30/07/2018</td>
                                <td>05/08/2018</td>
                            </tr>
                            <tr>
                                <td>100498</td>
                                <td>Baglioni</td>
                                <td>London</td>
                                <td>James Martin</td>
                                <td>08/02/2018</td>
                                <td>11/02/2018</td>
                            </tr>
                            <tr>
                                <td>100489</td>
                                <td>Champs Elysees</td>
                                <td>Dubai</td>
                                <td>Paul Parker</td>
                                <td>10/02/2018</td>
                                <td>13/02/2018</td>
                            </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-outline-danger float-right"><a href="agent-hotel-bookings.php">View All</a></button>

                    </div>
                </div>

            </div>


        </div>

        </div>
</div>
@endsection

