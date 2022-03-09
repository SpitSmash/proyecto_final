let date1 = "";
let date2 = "";
$(function () {
    var dateFormat = "dd/mm/yy",
        from = $("#from")
        .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
        })
        .on("change", function () {
            to.datepicker("option", "minDate", getDate(this));
            date1 = getDate(this);
            document.getElementById("date").innerHTML = "From" + date1;
        }),
        to = $("#to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 3
        })
        .on("change", function () {
            from.datepicker("option", "maxDate", getDate(this));
            date2 = getDate(this);
            document.getElementById("date").innerHTML += " To" + date2;

        });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }

        return date;
    }
});
