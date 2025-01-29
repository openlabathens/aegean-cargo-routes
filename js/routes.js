(function ($) {

  $(document).ready(function() {

    //Wind direction
    $("#wind-slider-data").roundSlider({
      disabled:true,
      min: 0,
      max: 360,
      step: 90,
      value: 90,
      sliderType: "min-range",
      radius: 150,
      showTooltip: false
    });

    //Wind speed
    $("#speed-slider-data").roundSlider({
      disabled:true,
      min: 0,
      max: 360,
      step: 45,
      value: 150,
      sliderType: "min-range",
      radius: 130,
      showTooltip: false
    });
  });

  //On DOM ready for the selection menu
  $(document).ready(function () {

    //Set up Island Menu

    //Hover effect
    $(".island").hover(
      function () {
        //Remove from selected if any
        $(".island").removeClass("selected-up");
        $(".island").next().removeClass("selected-down");
        //Disable select button
        $("#calculate-route").addClass("disabled");
        //Unstore data
        $("#island-departure").val(0);
        $("#island-destination").val(0);
        //Add to hovered
        $(this).addClass("hovered-up");
        $(this).next().addClass("hovered-down");
      }, function () {
        //Removed from hovered out
        $(this).removeClass("hovered-up");
        $(this).next().removeClass("hovered-down");
      }
    );

    //Select island
    $(".island").click(
      function () {
        //Select start
        var departure = $(this).data("island");
        $(this).addClass("selected-up");
        //Select end
        var destination = $(this).next().data("island");
        $(this).next().addClass("selected-down");
        //Store data
        $("#island-departure").val(departure);
        $("#island-destination").val(destination);
        //Enable button
        $("#calculate-route").removeClass("disabled");
      }
    );

    //Set up Weather Menu

    //Wind direction
    $("#wind-slider").roundSlider({
      min: 0,
      max: 360,
      step: 90,
      value: 90,
      sliderType: "min-range",
      radius: 150,
      showTooltip: false
    }
    );

    //Wind speed
    $("#speed-slider").roundSlider({
      min: 0,
      max: 360,
      step: 45,
      value: 90,
      sliderType: "min-range",
      radius: 130,
      showTooltip: false
    }
    );

    //Calculate route
    $("#calculate-route").click(function () {

      if ($(this).hasClass("disabled")) {
        //Do nothing
      } else {

        //Send data
        $.ajax({
          type: "post",
          url: `${window.location.origin}/wp-admin/admin-ajax.php`,
          data: {
            action: "aegean_sail_show_route_info",
            departure: $("#island-departure").val(),
            destination: $("#island-destination").val(),
            windDirection: $("#wind-slider").roundSlider("option", "value"),
            windSpeed: $("#speed-slider").roundSlider("option", "value")
          },
          success: function (res) {
            $("#routes-info-placement").append(res);
            $("#routes-info-placement").show();
            $('html, body').animate({
              scrollTop: $("#routes-info-placement").offset().top
            }, 1000);
          }
        });

      }

    });

  });

})(jQuery);