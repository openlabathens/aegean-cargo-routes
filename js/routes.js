(function ($) {

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
        if (destination > 0) {
          //Enable button
          $("#calculate-route").removeClass("disabled");
        }
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

        //Get gata
        var routeNumberning = $("#routes-info-placement").data("numbering");

        var windDirection = $("#wind-slider").roundSlider("option", "value");
        var windSpeed = $("#speed-slider").roundSlider("option", "value");

        //Send data
        $.ajax({
          type: "post",
          url: `${window.location.origin}/wp-admin/admin-ajax.php`,
          data: {
            action: "aegean_sail_show_route_info",
            numbering: routeNumberning,
            departure: $("#island-departure").val(),
            destination: $("#island-destination").val(),
            windDirection: windDirection,
            windSpeed: windSpeed
          },
          success: function (res) {
            //Add content
            $("#routes-info-placement").append(res);
            $("#routes-info-placement").show();
            //Activate round sliders
            $("#wind-slider-data-" + routeNumberning).roundSlider({
              disabled: true,
              min: 0,
              max: 360,
              step: 90,
              value: windDirection,
              sliderType: "min-range",
              radius: 150,
              showTooltip: false
            });
            $("#speed-slider-data-" + routeNumberning).roundSlider({
              disabled: true,
              min: 0,
              max: 360,
              step: 45,
              value: windSpeed,
              sliderType: "min-range",
              radius: 130,
              showTooltip: false
            });
            //Animate to added route
            $('html, body').animate({
              scrollTop: $("#route-" + routeNumberning).offset().top
            }, 1000);
            //Add route handler
            $("#reverse-button-" + routeNumberning).click(function () {
              loadReverseRoute(routeNumberning);
            });
            //Update numbering
            newRouteNumberning = routeNumberning + 1;
            $("#routes-info-placement").data("numbering", newRouteNumberning);
          }
        });

      }

    });

  });

  //Load the reverse route when asked
  function loadReverseRoute(rNumbering) {

    var rDeparture = $("#reverse-route-data-" + rNumbering).data("departure");
    var rDestination = $("#reverse-route-data-" + rNumbering).data("destination");
    var rWindDirection = $("#reverse-route-data-" + rNumbering).data("winddirection");
    var rWindSpeed = $("#reverse-route-data-" + rNumbering).data("windspeed");

    //Send data
    $.ajax({
      type: "post",
      url: `${window.location.origin}/wp-admin/admin-ajax.php`,
      data: {
        action: "aegean_sail_show_route_info",
        numbering: rNumbering,
        departure: rDeparture,
        destination: rDestination,
        windDirection: rWindDirection,
        windSpeed: rWindSpeed
      },
      success: function (res) {
        //Add content
        $("#route-" + rNumbering).replaceWith(res);
        //Activate round sliders
        $("#wind-slider-data-" + rNumbering).roundSlider({
          disabled: true,
          min: 0,
          max: 360,
          step: 90,
          value: rWindDirection,
          sliderType: "min-range",
          radius: 150,
          showTooltip: false
        });
        $("#speed-slider-data-" + rNumbering).roundSlider({
          disabled: true,
          min: 0,
          max: 360,
          step: 45,
          value: rWindSpeed,
          sliderType: "min-range",
          radius: 130,
          showTooltip: false
        });
         //Add route handler
         $("#reverse-button-" + rNumbering).click(function () {
          loadReverseRoute(rNumbering);
        });
      }
    });

  }


})(jQuery);