/**
 * Created by Jerome on 21/01/2017.
 */
/*global $*/
$(document).ready(function () {
    "use strict";

    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        clearBtn: true,
        language: "fr",
        todayHighlight: true
    });
});