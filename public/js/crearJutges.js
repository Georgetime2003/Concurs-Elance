import * as simpleSlider from "/js/simple-slider.min.js";

window.onload = function() {
    $("#nJutgesR").on("input", function() {
        $("#nJutges").val(this.value);
    });
    $("#nJutges").on("change", function() {
        $("#nJutgesR").animate({value: this.value}, {
            duration: 5,
            easing: "linear",
            step: function(now) {
                $(this).simpleSlider("setValue", now);
            }
        });
    });
}