/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
window.moment = require('moment');
window.JQuery = $;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.app = new Vue({
    el: '#app',
    data() {
      return {
          alertBox: false,
          loader: true,
          searchForm: {
              origin: "",
              destination: "",
              departureDate: "",
              returnDate: "",
              preferredAirline: "",
              employeeId: "",
              policyLevel: "",
              tripName: "",
              costCenter: ""
          },
          HotelSearchForm: {
              Destination: "",
              Checkin: "",
              NumberRooms : 1,
              Checkout: "",
              employeeId: "",
              policyLevel: "",
              costCenter: "",
              Adults_count : [1],
              Children_count : [0],
              Passenger: {
                  Adults: 1,
                  Children: 0,
                  Rooms: 1
              }
          },
          TotalNumberOfRooms : 1,
          FlightType: 'business',
          HotelType: 'business',
          TripType: 'oneway',
          ValidationError: "",
          ValidationHotelError: "",
          CostCenterInput: false,
          searchFormCostCenterLable: "",
          AirlinesDiv : [],
      }
    },
    created() {
        this.searchForm.tripType = 'oneway';
        this.searchForm.flightType = 'business';
        this.HotelSearchForm.hotelType = 'business';
        this.searchForm.adults = 1;
        this.searchForm.children = 0;
        this.searchForm.infants = 0;
        this.searchForm.cabinClass = 'Economy';
        this.AirlinesDiv.push(1);
    },
    watch : {
      'HotelSearchForm.NumberRooms' : function () {

          this.HotelSearchForm.Adults_count = [];

          for(var i = 0; i<this.HotelSearchForm.NumberRooms;i++){
              this.HotelSearchForm.Adults_count[i] = 1;
              this.HotelSearchForm.Children_count[i] = 0;
          }

      }
    },
    methods: {
        SetTripType(tripType) {
            this.TripType = tripType;
            let TripFlag = (tripType == 'oneway') ? true : false;
            this.InitDaterangepicker("#returnDate", TripFlag);
        },
        ChangeSelect2(propertyName, propertyValue) {
            this.searchForm[propertyName] = propertyValue;
        },
        HotelChangeSelect2(propertyName, propertyValue) {
            this.HotelSearchForm[propertyName] = propertyValue;
        },
        ChangeText(e){
            console.log($(e));
        },
        ConvertNumber(value) {
          return  Number( value);
        },
        OpenFlightModelBox() {
            let showModalBox = true;
            console.log(this.searchForm);
            if (!this.searchForm.origin) {
                this.ValidationError = "Origin is required";
                showModalBox = false;
            } else if (!this.searchForm.destination) {
                this.ValidationError = "Destination is required";
                showModalBox = false;
            } else if (!this.searchForm.departureDate) {
                this.ValidationError = "Depature Date is required";
                showModalBox = false;
            }

            if (showModalBox) {
                this.ValidationError = "";
                jQuery(".bs-flight-modal-lg").modal("show");
            }
        },
        OpenHotelModelBox() {
            let showModalBox = true;
            console.log(this.HotelSearchForm)
            if (!this.HotelSearchForm.destination) {
                this.ValidationHotelError = "Destination is required";
                showModalBox = false;
            } else if (!this.HotelSearchForm.Checkin) {
                this.ValidationHotelError = "Checkin is required";
                showModalBox = false;
            } else if (!this.HotelSearchForm.Checkout) {
                this.ValidationHotelError = "Checkout is required";
                showModalBox = false;
            }
            if (showModalBox) {
                this.ValidationHotelError = "";
                jQuery(".bs-hotel-modal-lg").modal("show");
            }
        },
        ChangeDate(propertyName, propertyValue) {
            if (propertyName == "departureDate") {
                this.searchForm.departureDate = propertyValue;
            } else if (propertyName == "returnDate") {
                this.searchForm.returnDate = propertyValue;
            }else if(propertyName == "Checkin"){
                this.HotelSearchForm.Checkin = propertyValue;
            }else if(propertyName == "Checkout"){
                this.HotelSearchForm.Checkout = propertyValue;
            }
        },
        CloneAirlineDiv(){
            this.AirlinesDiv.push(this.AirlinesDiv.length+2);
        },
        ChangeHotelType(value){
            this.HotelType = value;
            console.log(value)
            if(value == 'business' || value == 'rotation' ){
                this.TotalNumberOfRooms = 1;
            }else{
                this.TotalNumberOfRooms = 4;
            }
        },
        SaveAndSearchTripHotel() {
            let isValidationOk = true;
            if (!this.HotelSearchForm.tripName) {
                this.ValidationError = "Trip name is required";
                isValidationOk = false;
            } else if (!this.HotelSearchForm.employeeId) {
                this.ValidationError = "Employee is required";
                isValidationOk = false;
            } else if (!this.HotelSearchForm.costCenter) {

                this.ValidationError = "Cost center is required";
                isValidationOk = false;
            } else {
                this.ValidationError = "";
            }
            this.HotelSearchForm.Passenger.Children = this.HotelSearchForm.Adults_count.join("_");
            this.HotelSearchForm.Passenger.Adults = this.HotelSearchForm.Children_count.join("_");

            if (isValidationOk) {
                this.ValidationError = "";
                let costCenter = JSON.parse(this.HotelSearchForm.costCenter);
                this.HotelSearchForm.cost_Center = costCenter.id;
                // Save trip and apply search query
                axios.post(base_url+'corporate/saveTripHotel', this.HotelSearchForm)
                    .then((response) => {
                        if (response.data.status == "success") {
                            window.location.href = base_url+"corporate/hotel_search?"+response.data.searchQuery;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        SaveAndSearchTrip() {
            let isValidationOk = true;
            if (!this.searchForm.tripName) {
                this.ValidationError = "Trip name is required";
                isValidationOk = false;
            } else if (!this.searchForm.employeeId) {
                this.ValidationError = "Employee is required";
                isValidationOk = false;
            } else if (!this.searchForm.costCenter) {
                this.ValidationError = "Cost center is required";
                isValidationOk = false;
            } else {
                this.ValidationError = "";
            }

            if (isValidationOk) {
                this.ValidationError = "";
                // Save trip and apply search query
                axios.post(base_url+'corporate/saveTrip', this.searchForm)
                    .then((response) => {
                        if (response.data.status == "success") {
                            window.location.href = base_url+"corporate/flight_search?"+response.data.searchQuery;
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        SearchTrip() {
            let searchPayload = {
                "traveltype": this.searchForm.tripType,
                "from": this.searchForm.origin,
                "to": this.searchForm.destination,
                "departure_date": this.searchForm.departureDate,
                "return_date": this.searchForm.returnDate,
                "adult": this.searchForm.adults,
                "child": this.searchForm.children,
                "infant": this.searchForm.infants,
                "class": this.searchForm.cabinClass,
                "preferredAirline": this.searchForm.preferredAirline,
                "requestedFlightType": this.searchForm.requestedFlightType,
                "existingTripId": this.searchForm.existingTripId
            };

            let esc = encodeURIComponent;
            let searchQuery = Object.keys(searchPayload)
                .map(k => esc(k) + '=' + esc(searchPayload[k]))
                .join('&');

            window.location.href = base_url+"corporate/flight_search?"+searchQuery;
        },
        HotelSearchTrip() {

            this.HotelSearchForm.Passenger.Adults = this.HotelSearchForm.Adults_count.join("_");
            this.HotelSearchForm.Passenger.Children = this.HotelSearchForm.Children_count.join("_");

            let searchPayload = {
                "city_id": this.HotelSearchForm.destination,
                "checkin": this.HotelSearchForm.Checkin,
                "checkout": this.HotelSearchForm.Checkout,
                "adults": this.HotelSearchForm.Passenger.Adults,
                "children": this.HotelSearchForm.Passenger.Children,
                "rooms": this.HotelSearchForm.NumberRooms,
                "existingTripId": this.HotelSearchForm.existingTripId,
            };
            let esc = encodeURIComponent;
            let searchQuery = Object.keys(searchPayload)
                .map(k => esc(k) + '=' + esc(searchPayload[k]))
                .join('&');

            window.location.href = base_url+"corporate/hotel_search?"+searchQuery;
        }
    }
});
