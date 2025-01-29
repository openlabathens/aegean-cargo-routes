<?php

function routes_map_direction($direction){

    $direction_mapping = array(
        'SE'=> __('SouthEast','aegean-sail'),
        'S'=> __('South','aegean-sail'),
        'SSE'=> __('SouthSouthEast','aegean-sail'),
        'N'=> __('North','aegean-sail'),
        'E'=> __('East','aegean-sail'),
        'W'=> __('West','aegean-sail'),
    );

    return $direction_mapping[$direction];
}

function routes_map_wind_direction($windDirection){

    $wind_direction_mapping = array(
        '90'=> 'N',
        '180'=> 'E',
        '270'=> 'S',
        '0'=> 'W'
    );

    return $wind_direction_mapping[$windDirection];
}

function routes_map_wind_speed($windSpeed){

    $wind_speed_mapping = array(
        '90'=> '0_5',
        '135'=> '0_5',
        '180'=> '6_10',
        '225'=> '10_20',
        '270'=> '10_20',
        '315'=> '10_20',
        '0'=> '20_30',
        '45'=> '20_30',
    );

    return $wind_speed_mapping[$windSpeed];
}


?>