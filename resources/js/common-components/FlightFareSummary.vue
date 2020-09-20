<template>
    <div class="flight-fare-summary">
        <div class="row no-gutters">
            <div class="col-md-6">
                <div class="fare-total">
                    <div class="fare-heading">Fare total</div>
                    <div class="fare" v-for="AirPricingInfo in Itinerary.AirPricePointList.AirPricingInfo">
                        <span>{{ AirPricingInfo.PassengerType.Code }} Fare</span>
                        <span>{{ Itinerary.Currency }} {{ AirPricingInfo.TotalPrice - AirPricingInfo.Taxes }}</span>
                    </div>

                    <div class="tax-fees" v-for="AirPricingInfo in Itinerary.AirPricePointList.AirPricingInfo">
                        <div>{{ AirPricingInfo.PassengerType.Code }} Taxes</div>
                        <span>{{ Itinerary.Currency }} {{ AirPricingInfo.Taxes }}</span>
                    </div>

                    <div class="vat">
                        <div>IPP Total (USD 0 per adult)</div>
                        <span>USD 0</span>
                    </div>

                    <div class="vat">
                        <div>Service Fee</div>
                        <span>USD 0</span>
                    </div>
                    <div class="total-fare">
                        <span>Grand Total</span>
                        <span>{{ Itinerary.Currency }} {{ Itinerary.TotalPrice }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="cancelation">
                    <div>
                        <br/>
                        <button class="btn btn-sm btn-danger"
                                v-on:click="LoadFareRules(Itinerary.AirPricePointList.AirPricingInfo[0].FareDetails, Itinerary.FlightOptionsList.FlightOption[0].Option[0])">
                            Click here for Fare Rules
                        </button>
                    </div>

                    <div class="cancel-detail">
                        <ul>
                            <li v-for="PricingMessage in Itinerary.AirPricePointList.AirPricingInfo[0].PricingMessages">
                                {{ PricingMessage.Description }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FlightFareSummary",
        props: ["Itinerary"],
        data() {
          return {}
        },
        mounted() {
            console.log("Fare summary component mounted");
        },
        methods: {
            LoadFareRules(FareDetails, Option) {
                this.$parent.$parent.loader = true;
                window.axios.get(base_url + 'flights/load-fare-rules', {
                    params: {
                        FareBasis: FareDetails[0].GroupOfFares[0].FareBasis,
                        Carrier: Option.Carrier.Code,
                        Origin: Option.FlightLabelInfo.Origin.Code,
                        Destination: Option.FlightLabelInfo.Destination.Code
                    }
                })
                .then((res) => {
                    this.$parent.$parent.loader = false;
                    this.$parent.FareFamilyDetail.Carrier = res.data.data.Carrier;
                    this.$parent.FareFamilyDetail.Data = res.data.data.FareRuleDescriptionText;
                    $("#fareFamilyModal").modal("show");
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>
    .cancel-detail {
        margin-top: 10px;
    }
    .cancel-detail ul {
        margin: 0px;
    }
</style>