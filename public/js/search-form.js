$(document).ready(function() {
    $(".main-search-tab").on("click", function(e) {
        $(".main-header")
            .find(".active")
            .removeClass("active");
        e.target.classList.add("active");
        if ($(this).hasClass("flight-tab")) {
            $("#flight-data").addClass("active");
            // $(".flight-tour").closest("");
        } else if ($(this).hasClass("hotel-tab")) {
            $("#hotel-data").addClass("active");
        }
    });

    // $(".flight-tour").on("click", function() {
    //     $("#flight-data")
    //         .find(".show")
    //         .removeClass("show");
    //     $(this).addClass("show");
    //     $("#flight-data")
    //         .find(".fade-in")
    //         .removeClass("fade-in");
    //     if ($(this).hasClass("oneWay")) {
    //         $(".one-way-tour").addClass("fade-in");
    //     } else if ($(this).hasClass("roundTrip")) {
    //         $(".two-way-tour").addClass("fade-in");
    //     } else if ($(this).hasClass("multiCity")) {
    //         $(".multi-city-tour").addClass("fade-in");
    //     }
    // });

    // $(".add-return").on("click", function() {
    //     $("#flight-data")
    //         .find(".show")
    //         .removeClass("show");
    //     $("#flight-data")
    //         .find(".fade-in")
    //         .removeClass("fade-in");
    //     $(".two-way-tour").addClass("fade-in");
    //     $(".roundTrip").addClass("show");
    // });

    $(".btn-modify").on("click", function() {
        $(".modify-search").fadeIn();
        $(".modify-back").css({
            opacity: "0.5",
            visibility: "visible",
            zIndex: "13"
        });
    });
    $(".btn-search-modify-cancel").on("click", function() {
        $(".modify-search").fadeOut();
        $(".modify-back").css({
            opacity: "0",
            visibility: "hidden",
            zIndex: "-13"
        });
    });
    $(".select-class").on("click", function() {
        $(".select-class-drop").addClass("active");
    });
    $(".select-class-drop li").on("click", function () {
        $(this).parent().parent().removeClass("active");
        console.log($(this).parent().parent());
    });
    // $(".select-pessanger").on("click", function() {
    //     $(".select-passnger-drop").addClass("active");
    // });

    //     $(".daterange").daterangepicker({
    //     singleDatePicker: true,
    //     showDropdowns: false
    // }, function(start, end, label) {
    //     console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    // });
});
