<?php

function routes_map_direction($direction)
{

    $direction_mapping = array(
        'S' => __('South', 'aegean-sail'),
        'SE' => __('South East', 'aegean-sail'),
        'SSE' => __('South South East', 'aegean-sail'),
        'SW' => __('South West', 'aegean-sail'),
        'N' => __('North', 'aegean-sail'),
        'NE' => __('North East', 'aegean-sail'),
        'NW' => __('North West', 'aegean-sail'),
        'NNW' => __('North North West', 'aegean-sail'),
        'E' => __('East', 'aegean-sail'),
        'ESE' => __('East South East', 'aegean-sail'),
        'ENE' => __('East North East', 'aegean-sail'),
        'W' => __('West', 'aegean-sail'),
        'WSW' => __('West South West', 'aegean-sail'),
    );

    return $direction_mapping[$direction];
}

function routes_map_wind_direction($windDirection)
{

    $wind_direction_mapping = array(
        '90' => 'N',
        '180' => 'E',
        '270' => 'S',
        '360' => 'W',
        '0' => 'W'
    );

    return $wind_direction_mapping[$windDirection];
}

function routes_map_wind_speed($windSpeed)
{

    $wind_speed_mapping = array(
        '90' => '0_5',
        '135' => '0_5',
        '180' => '6_10',
        '225' => '10_20',
        '270' => '10_20',
        '315' => '10_20',
        '360' => '20_30',
        '0' => '20_30',
        '45' => '20_30',
    );

    return $wind_speed_mapping[$windSpeed];
}

//Show the reverse route button
function routes_reverse_route($numbering, $departure_id, $destination_id, $windDirection, $windSpeed)
{

    //Check if reverse route exists
    $args = array(
        'post_type' => 'route',
        'numberposts' => 1,
        'fields' => 'ids',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'route_departure',
                'value' => $departure_id
            ),
            array(
                'key' => 'route_destination',
                'value' => $destination_id
            ),
        )
    );
    $reverse_route  = get_posts($args);
    if ($reverse_route): ?>
        <span id="reverse-button-<?php echo $numbering; ?>" class="reverse-button">
            <img src="<?php echo plugins_url('../assets/loop-icon.png', __FILE__); ?>">
            <input id="reverse-route-data-<?php echo $numbering; ?>" type="hidden" data-departure="<?php echo $departure_id; ?>" data-destination="<?php echo $destination_id; ?>" data-winddirection="<?php echo $windDirection; ?>" data-windspeed="<?php echo $windSpeed; ?>">
        </span>
<?php endif;
}
?>