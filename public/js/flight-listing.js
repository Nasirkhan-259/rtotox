$(document).ready(function() {
    // $('[data-toggle="baggage"]').tooltip();
    // $('[data-toggle="taxesfare"]').tooltip();
    // $('[data-toggle="detailtaxesfare"]').tooltip();
    // $('[data-toggle="detailVat"]').tooltip();
    // $('[data-toggle="vat"]').tooltip();
    $(".flight-detail-btn").on("click", function(event) {
        event.preventDefault();
        var getId = event.target.href.split("#")[1];
        var dynId = document.getElementById(getId);
        if (!dynId.classList.contains("active")) {
            dynId.classList.add("active");
            $(dynId).slideDown();
        } else {
            dynId.classList.remove("active");
            $(dynId).slideUp();
        }
    });
    $(".btn-flight-detail").on("click", function() {
        $(".btn-flight-detail").removeClass("active");
        if (!$(this).hasClass("active")) {
            $(this).addClass("active");
            $("#Fare-rules").fadeIn();
        }
        if (this.textContent == "Flight itinerary") {
            $("#Flight-itinerary").fadeIn();
            $("#Baggage-info").hide();
            $("#Fare-rules").hide();
        } else if (this.textContent == "Baggage info") {
            $("#Baggage-info").fadeIn();
            $("#Flight-itinerary").hide();
            $("#Fare-rules").hide();
        } else if (this.textContent == "Fare summary & rules") {
            $("#Fare-rules").fadeIn();
            $("#Flight-itinerary").hide();
            $("#Baggage-info").hide();
        }
    });
    let fasdepart = $(".btn-depart").find(".fas");
    let icondisable = $(".btn-direct").find(".icon-disable");

    $(".btn-depart").on("click", function() {
        if ($(".btn-depart-data").css("display") == "none") {
            fasdepart.css("transform", "scale(-1)");
            $(".btn-depart-data").fadeIn();
        } else {
            $(".btn-depart-data").fadeOut();
            fasdepart.css("transform", "scale(1)");
        }
    });
    $(".btn-direct").on("click", function() {
        if (icondisable.css("display") == "none") {
            setTimeout(function() {
                icondisable.show();
                $(".btn-direct").css({
                    "background-color": "#d32f2f",
                    border: "1px solid #d32f2f",
                    color: "#fff"
                });
            }, 10);
        } else {
            setTimeout(function() {
                icondisable.hide();
                $(".btn-direct").css({
                    "background-color": "#fff",
                    border: "1px solid #cccacc",
                    color: "#3a3a3a"
                });
                $(".btn-direct").blur();
            }, 10);
        }
    });
    let fascheap = $(".btn-cheapest").find(".fas");
    $(".btn-cheapest").on("click", function() {
        if ($(".data-cheapest").css("display") == "none") {
            fascheap.css("transform", "scale(-1)");
            $(".data-cheapest").fadeIn();
        } else {
            fascheap.css("transform", "scale(1)");
            $(".data-cheapest").fadeOut();
        }
    });
    // $(".filter-box-heading").on("click", function() {
    //     if ($(this).is("#filter-price") && !$(this).hasClass("hide")) {
    //         $(this).addClass("hide");
    //         $(".price-range").hide();
    //     } else if ($(this).is("#filter-stop") && !$(this).hasClass("hide")) {
    //         $(this).addClass("hide");
    //         $(".direct-stop").hide();
    //     } else if ($(this).is("#outbound") && !$(this).hasClass("hide")) {
    //         $(this).addClass("hide");
    //         $(".outbound").hide();
    //     } else if ($(this).is("#inbound") && !$(this).hasClass("hide")) {
    //         $(this).addClass("hide");
    //         $(".inbound").hide();
    //     } else if ($(this).is("#airport") && !$(this).hasClass("hide")) {
    //         $(this).addClass("hide");
    //         $(".filter-airport").hide();
    //     } else if ($(this).is("#airline") && !$(this).hasClass("hide")) {
    //         $(this).addClass("hide");
    //         $(".filter-airline").hide();
    //     } else {
    //         $(this).removeClass("hide");
    //         $(".price-range").show();
    //         $(".direct-stop").show();
    //         $(".outbound").show();
    //         $(".inbound").show();
    //         $(".filter-airport").show();
    //         $(".filter-airline").show();
    //     }
    // });
    $("#add-frequent").on("change", function() {
        if ($(this).is(":checked")) {
            $("#frequent-det").fadeIn();
        } else {
            $("#frequent-det").fadeOut();
        }
    });
    $("#add-meal").on("change", function() {
        if ($(this).is(":checked")) {
            $("#meal-det").fadeIn();
        } else {
            $("#meal-det").fadeOut();
        }
    });
    $(".btn-meal-assistance").on("click", function() {
        var active = $("#meal-det").find(".active");
        $(active).removeClass("active");
        if ($(this).hasClass("btn-meal")) {
            $(this).addClass("active");
            $("#meal").addClass("active");
        } else if ($(this).hasClass("btn-assistance")) {
            $(this).addClass("active");
            $("#assistance").addClass("active");
        }
    });
    $(".traveler-baggage").on("click", function() {
        if ($("#traveler-bag-info").css("display") == "none") {
            $(this)
                .find(".arrow-down")
                .css("transform", "scale(-1)");
            $("#traveler-bag-info").fadeIn();
        } else {
            $(this)
                .find(".arrow-down")
                .css("transform", "scale(1)");
            $("#traveler-bag-info").fadeOut();
        }
    });

    $("#btn-taxFees").on("click", function(e) {
        $(".detail-aside")
            .find(".kPCxEb")
            .css("transform", "scale(-1)");
        e.preventDefault();
        if ($(".tax-fare").css("display") == "none") {
            $(".tax-fare").fadeIn();
        } else {
            $(".tax-fare").fadeOut();
            $(".detail-aside")
                .find(".kPCxEb")
                .css("transform", "scale(1)");
        }
    });
    $(window).scroll(function(event) {
        var scroll = $(window).scrollTop();
        if (scroll > 700) {
            $(".detail-aside").css({
                position: "relative",
                top: 0
            });
        } else {
            $(".detail-aside").css({
                position: "sticky",
                top: 0
            });
        }
    });
    $(".main-search-tab").on("click", function(e) {
        $(".main-header")
            .find(".active")
            .removeClass("active");
        e.target.classList.add("active");
        if ($(this).hasClass("flight-tab")) {
            $("#flight-data").addClass("active");
            $(".flight-tour").closest("");
        } else if ($(this).hasClass("hotel-tab")) {
            $("#hotel-data").addClass("active");
        }
    });
});

