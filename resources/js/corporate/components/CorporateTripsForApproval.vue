<template>
    <div class="container">
        <br/>
        <div class="row">
            <div class="col-md-8">
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

                <div class="trip-container">
                    <div v-for="(ItineraryOfSavedTrips, ItineraryOfSavedTripsIndex) in SavedTrips">
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
                        <div class="border my-5 p-10">
                            <div v-for="(AirLeg, AirLegIndex) in ItineraryOfSavedTrips.FlightOptionsList.FlightOption">
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

                            <!-- employee family member -->
                            <div class="my-5">
                                <!-- Adults -->
                                <div class="form-inline" v-for="(AdultNumber, PaxNumberIndex) in ItineraryOfSavedTrips.total_adults">
                                    <div class="col-md-2">
                                        <label>Adult {{ AdultNumber }}</label>
                                    </div>

                                    <div class="col-md-10">
                                        <select @input="PushToSelectedFamilyMembers($event)" class="form-control" style="width: 50%">
                                            <option value="">Select Adult</option>
                                            <option v-for="Member in EmployeeFamilyMembers.Adults"
                                                    v-show="IfObjectNotInList(AddParams(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Adult'), ItineraryOfSavedTripsIndex)"
                                                    v-bind:value="JSONStringify(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Adult')">
                                                {{ Member.first_name +' '+ Member.last_name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <table class="table table-sm table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Country</th>
                                                    <th>Passport No</th>
                                                    <th>Passport Expiry</th>
                                                    <th>Date of Birth</th>
                                                    <th>FF Number</th>
                                                    <th>Meal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="Member in SelectedFamilyMembers"
                                                    v-if="CheckPaxIdentity(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Adult')">
                                                    <td>{{ Member.salutation }}</td>
                                                    <td>{{ Member.first_name }}</td>
                                                    <td>{{ Member.last_name }}</td>
                                                    <td>{{ Member.country_id }}</td>
                                                    <td>{{ Member.passportno }}</td>
                                                    <td>{{ Member.passport_dateofexpiry }}</td>
                                                    <td>{{ Member.dob }}</td>
                                                    <td>N/A</td>
                                                    <td>{{ Member.prefferred_mealplan }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Children -->
                                <div class="form-inline" v-for="(ChildNumber, PaxNumberIndex) in ItineraryOfSavedTrips.total_children">
                                    <div class="col-md-2">
                                        <label>Child {{ ChildNumber }}</label>
                                    </div>

                                    <div class="col-md-10">
                                        <select @input="PushToSelectedFamilyMembers($event)" class="form-control" style="width: 50%">
                                            <option value="">Select Adult</option>
                                            <option v-for="Member in EmployeeFamilyMembers.Children"
                                                    v-show="IfObjectNotInList(AddParams(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Child'), ItineraryOfSavedTripsIndex)"
                                                    v-bind:value="JSONStringify(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Child')">
                                                {{ Member.first_name +' '+ Member.last_name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <table class="table table-sm table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Country</th>
                                                <th>Passport No</th>
                                                <th>Passport Expiry</th>
                                                <th>Date of Birth</th>
                                                <th>FF Number</th>
                                                <th>Meal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="Member in SelectedFamilyMembers"
                                                v-if="CheckPaxIdentity(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Child')">
                                                <td>{{ Member.salutation }}</td>
                                                <td>{{ Member.first_name }}</td>
                                                <td>{{ Member.last_name }}</td>
                                                <td>{{ Member.country_id }}</td>
                                                <td>{{ Member.passportno }}</td>
                                                <td>{{ Member.passport_dateofexpiry }}</td>
                                                <td>{{ Member.dob }}</td>
                                                <td>N/A</td>
                                                <td>{{ Member.prefferred_mealplan }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Infants -->
                                <div class="form-inline" v-for="(InfantNumber, PaxNumberIndex) in ItineraryOfSavedTrips.total_infants">
                                    <div class="col-md-2">
                                        <label>Infant {{ InfantNumber }}</label>
                                    </div>

                                    <div class="col-md-10">
                                        <select @input="PushToSelectedFamilyMembers($event)" class="form-control" style="width: 50%">
                                            <option value="">Select Adult</option>
                                            <option v-for="Member in EmployeeFamilyMembers.Infants"
                                                    v-show="IfObjectNotInList(AddParams(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Infant'), ItineraryOfSavedTripsIndex)"
                                                    v-bind:value="JSONStringify(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Infant')">
                                                {{ Member.first_name +' '+ Member.last_name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <table class="table table-sm table-bordered">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Country</th>
                                                <th>Passport No</th>
                                                <th>Passport Expiry</th>
                                                <th>Date of Birth</th>
                                                <th>FF Number</th>
                                                <th>Meal</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="Member in SelectedFamilyMembers"
                                                v-if="CheckPaxIdentity(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, 'Infant')">
                                                <td>{{ Member.salutation }}</td>
                                                <td>{{ Member.first_name }}</td>
                                                <td>{{ Member.last_name }}</td>
                                                <td>{{ Member.country_id }}</td>
                                                <td>{{ Member.passportno }}</td>
                                                <td>{{ Member.passport_dateofexpiry }}</td>
                                                <td>{{ Member.dob }}</td>
                                                <td>N/A</td>
                                                <td>{{ Member.prefferred_mealplan }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-30" v-for="ApproverWorkFlow in ApproverWorkFlowList">
                        <div class="col-md-5">
                            <label class="font-size-12">Select level {{ ApproverWorkFlow.Level }} Approver<span class="text-danger">*</span></label>
                            <multiselect
                                    v-model="SelectedApprovers[ApproverWorkFlow.Level]"
                                    :options="ApproverWorkFlow.Members"
                                    :multiple="true"
                                    :close-on-select="false"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    placeholder="Pick Approver"
                                    label="firstname"
                                    track-by="firstname"
                                    :preselect-first="true">
                            </multiselect>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-5">
                            <label class="font-size-12">Reason For Trip <span class="text-danger">*</span></label>
                            <select v-model="TripReason" class="form-control font-size-12">
                                <option value="">Select Reason</option>
                                <option v-for="Reason in CoporateTripReasonList" v-bind:value="Reason.id">{{ Reason.tripreason }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="font-size-12">Comments<span class="text-danger">*</span></label>
                            <textarea v-model="Comment" cols="30" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <p class="font-size-12 mb-0">
                                <input type="checkbox" class="mr-10" v-model="AcceptPolicyCheck"> I have read and agree to the terms,condition and fare rules(if any)
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-danger font-size-12" v-bind:disabled="!AcceptPolicyCheck" v-on:click="SendForApproval">Send For Approval</button>
                    </div>
                    <br/>
                </div>
            </div>
            <div class="col-md-4 my-5">
                <div class="credit-info">
                    <div class="credit-info-title">Fare Summary</div>
                    <div class="d-flex justify-content-between font-size-12 ">
                        Flight: {{ FareSummary.ItinerariesTotal }}
                    </div>
                    <div class="d-flex justify-content-between font-size-12">
                        Hotel: {{ FareSummary.HotelRoomsTotal }}
                    </div>
                    <div class="d-flex justify-content-between font-size-12">
                        Transfer: {{ FareSummary.Transfer }}
                    </div>
                    <div class="d-flex justify-content-between pb-10 font-size-12">
                        Charter Flight: {{ FareSummary.CharterFlight }}
                    </div>
                    <div class="d-flex justify-content-between border-top-dashed pt-10 ">
                        Grand Total: <strong>{{ FareSummary.GrandTotal }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        name: "CorporateTripsForApproval",
        props: ["PCorporateTripMaster", "PEmployeeFamilyMembers", "PApproverWorkFlowList", "PCoporateTripReasonList"],
        components: { Multiselect },
        data () {
          return {
              base_url: "",
              Trip: {},
              EmployeeFamilyMembers: [],
              ApproverWorkFlowList: [],
              SavedTrips: [],
              SelectedApprovers: {
                  "1": [],
                  "2": [],
                  "3": []
              },
              TripReason: "",
              Comment: "",
              AcceptPolicyCheck: false,
              CoporateTripReasonList: [],
              FareSummary: {
                  ItinerariesTotal: 0,
                  HotelRoomsTotal: 0,
                  Transfer: 0,
                  CharterFlight: 0,
                  GrandTotal: 0
              },
              SelectedFamilyMembers: []
          }
        },
        mounted() {
            this.Trip = JSON.parse(this.PCorporateTripMaster);
            this.EmployeeFamilyMembers = JSON.parse(this.PEmployeeFamilyMembers);
            this.ApproverWorkFlowList = JSON.parse(this.PApproverWorkFlowList);
            this.CoporateTripReasonList = JSON.parse(this.PCoporateTripReasonList);

            this.LoadSavedItinerariesIntoCart(this.Trip.id);
        },
        methods: {
            CheckPaxIdentity(Member, ItineraryOfSavedTripsIndex, PaxNumberIndex, PaxType) {
                return (
                    Member.ItineraryOfSavedTripsIndex == ItineraryOfSavedTripsIndex &&
                    Member.PaxNumberIndex == PaxNumberIndex &&
                    Member.PaxType == PaxType
                );
            },
            AddParams(Option, ItineraryOfSavedTripsIndex, PaxNumberIndex, PaxType) {
                Option["ItineraryOfSavedTripsIndex"] = ItineraryOfSavedTripsIndex;
                Option["PaxNumberIndex"] = PaxNumberIndex;
                Option["PaxType"] = PaxType;
                return Option;
            },
            PushToSelectedFamilyMembers(event) {
                if (event.target.value != "") {
                    let Option = JSON.parse(event.target.value);
                    if (this.IfFamilyMemberNotInList(Option)) {
                        this.SelectedFamilyMembers.push(Option);
                    } else {
                        this.RemoveFamilyMemberFromList(Option);
                        this.SelectedFamilyMembers.push(Option);
                    }
                }
            },
            JSONStringify(Option, ItineraryOfSavedTripsIndex, PaxNumberIndex, PaxType) {
                Option["ItineraryOfSavedTripsIndex"] = ItineraryOfSavedTripsIndex;
                Option["PaxNumberIndex"] = PaxNumberIndex;
                Option["PaxType"] = PaxType;
                return JSON.stringify(Option);
            },
            IfObjectNotInList(Option, ItineraryOfSavedTripsIndex) {
                let result = this.SelectedFamilyMembers.filter((elem) => {
                    return elem.id == Option.id && elem.ItineraryOfSavedTripsIndex == ItineraryOfSavedTripsIndex;
                });
                return !result.length;
            },
            RemoveFamilyMemberFromList(Option) {
                this.SelectedFamilyMembers = this.SelectedFamilyMembers.filter((elem) => {
                    return (
                        elem.ItineraryOfSavedTripsIndex != Option.ItineraryOfSavedTripsIndex &&
                        elem.PaxNumberIndex != Option.PaxNumberIndex &&
                        elem.PaxType != Option.PaxType
                    );
                });
            },
            IfFamilyMemberNotInList(Option) {
                let result = this.SelectedFamilyMembers.filter((elem) => {
                    return (
                        elem.ItineraryOfSavedTripsIndex == Option.ItineraryOfSavedTripsIndex &&
                        elem.PaxNumberIndex == Option.PaxNumberIndex &&
                        elem.PaxType == Option.PaxType
                    );
                });
                return !result.length;
            },
            SendForApproval() {
                let CorporateTripServiceIds = [];
                this.SavedTrips.forEach((Itinerary) => {
                    CorporateTripServiceIds.push(Itinerary.CorporateTripServiceId);
                });
                axios.post(base_url + 'corporate/trip/save_and_send_notification_to_approvers', {
                    CorporateTripMasterId :this.Trip.id,
                    CorporateTripServiceIds: CorporateTripServiceIds,
                    SelectedApprovers: this.SelectedApprovers,
                    TripReason: this.TripReason,
                    SelectedFamilyMembers: this.SelectedFamilyMembers,
                    Comment: this.Comment
                })
                    .then((res) => {
                        console.log(res.data);
                        if (res.data.Status == "success") {
                            alert("Saved successfully");
                            window.location.href = base_url+"corporate/dashboard";
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            LoadSavedItinerariesIntoCart(TripId) {
                axios.get(base_url + 'corporate/load_saved_itineraries', {
                    params: {
                        corporate_trip_master_id: TripId
                    }
                })
                .then((res) => {
                    this.SavedTrips = res.data.Itineraries;
                    this.FareSummary.ItinerariesTotal = res.data.ItinerariesTotal;

                    this.FareSummary.GrandTotal += this.FareSummary.ItinerariesTotal;
                    this.FareSummary.GrandTotal += this.FareSummary.HotelRoomsTotal;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            GetCarrierImage(Carrier) {
                if (Carrier.Code != undefined) {
                    return base_url+"images/airlines/"+Carrier.Code+".png";
                } else {
                    return base_url+"images/airlines/"+Carrier+".png";
                }
            },
            GetFlightTime(dateTimeString) {
                let dateTime = dateTimeString.split(" ");

                return dateTime[1];
            },
            GetFlightDuration(Segment) {
                let ArrivalTime = this.reverseDateFormat(Segment.ArrivalTime);
                let DepartureTime = this.reverseDateFormat(Segment.DepartureTime);
                let Difference = moment(ArrivalTime).diff(moment(DepartureTime));

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
            TransitDelay(ArrivalTime, DepartureTime) {
                ArrivalTime = this.reverseDateFormat(ArrivalTime);
                DepartureTime = this.reverseDateFormat(DepartureTime);
                let Difference = moment(DepartureTime).diff(moment(ArrivalTime));

                return moment.utc(Difference).format("HH[h] mm[m]");
            },
            GetCarrierName(Carrier) {
                if (Carrier != undefined) {
                    return Carrier.Name
                }
            }
        }
    }
</script>

<style scoped></style>