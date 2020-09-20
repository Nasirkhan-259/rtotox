const moment  = require('moment');

class Util {

    static GetMonthName(dateTime) {
        if (typeof dateTime == "object") {
            return moment(dateTime).format("MMMM");
        }
    }

    static GetDayName(dateTime) {
        if (typeof dateTime == "object") {
            return moment(dateTime).format("dddd");
        }
    }

    static GetDay(dateTime) {
        if (typeof dateTime == "object") {
            return moment(dateTime).format("DD");
        }
    }

    static APIDateTimeFormat(dateTime) {
        if (typeof dateTime == "object") {
            return moment(dateTime).format("YYYY-MM-DD");
        }
    }

    static IsEmpty(value) {
        if (value == null) {
            return true;
        } else if (value == "") {
            return true;
        } else if (value == 0) {
            return true;
        } else {
            return false;
        }
    }
}

module.exports = Util;