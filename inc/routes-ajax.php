<?php
add_action('wp_ajax_nopriv_aegean_sail_show_route_info', 'show_route_info_template');
add_action('wp_ajax_aegean_sail_show_route_info', 'show_route_info_template');
function show_route_info_template()
{
    //Get route data
    $numbering = $_POST['numbering'];
    $departure_id = $_POST['departure'];
    $destination_id =  $_POST['destination'];
    $windDirection = $_POST['windDirection'];
    $windDirectionMapped = routes_map_wind_direction($windDirection);
    $windSpeed = $_POST['windSpeed'];
    $windSpeedMapped = routes_map_wind_speed($windSpeed);
    //Find route
    $args = array(
        'post_type' => 'route',
        'posts_per_page' => 1,
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
    $selected_route = new WP_Query($args);
    if ($selected_route->have_posts()) :
        while ($selected_route->have_posts()) :
            //Get main data
            $selected_route->the_post();
            $departure_island = get_post($departure_id);
            $destination_island = get_post($destination_id);
            //Get time data
            $travel_data = array();
            if (have_rows('route_wind')):
                while (have_rows('route_wind')) : the_row();
                    $sub_wind_direction = get_sub_field('route_wind_direction');
                    $sub_time_petrol = get_sub_field('route_travel_time_petrol');
                    $sub_time_wind = get_sub_field('route_travel_time_wind');
                    $sub_time_electricity = get_sub_field('route_travel_time_electricity');
                    $travel_data[$sub_wind_direction] = array(
                        'time_petrol' => $sub_time_petrol,
                        'time_wind' => $sub_time_wind,
                        'time_electricity' => $sub_time_electricity
                    );
                endwhile;
            endif;
?>
            <div id="route-<?php echo $numbering; ?>" class="route route-<?php echo get_the_ID(); ?>">
                <div class="row route-title">
                    <div class="col-md-12 route-islands">
                        <h3 class="dep" style="background-image: url('<?php echo get_the_post_thumbnail_url($departure_island->ID, 'full'); ?>');">
                            <?php echo $departure_island->post_title; ?>
                        </h3>
                        <h4 class="direction">
                            <?php echo routes_map_direction(get_post_meta(get_the_ID(), 'route_direction', true)); ?>
                        </h4>
                        <h3 class="dest" style="background-image: url('<?php echo get_the_post_thumbnail_url($destination_island->ID, 'full'); ?>');">
                            <?php echo $destination_island->post_title; ?>
                        </h3>
                        <?php routes_reverse_route($numbering, $destination_island->ID, $departure_island->ID, $windDirection, $windSpeed); ?>
                    </div>
                </div>

                <div class="row route-data">
                    <div class="col-lg-7 route-data-winds">
                        <label><?php _e('current weather conditions', 'aegean-sail'); ?></label>
                        <div class="row">
                            <div class="col-md-6">
                                <h5><?php _e('wind direction', 'aegean-sail'); ?></h5>
                                <div id="wind-slider-data-<?php echo $numbering; ?>" class="weather-slider wind-slider"></div>
                            </div>
                            <div class="col-md-6">
                                <h5><?php _e('wind speed (kt)', 'aegean-sail'); ?></h5>
                                <div id="speed-slider-data-<?php echo $numbering; ?>" class="weather-slider speed-slider"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 route-data-time">
                        <div class="row">
                            <div class="col-6 distance icon-holder">
                                <label class="two-lines"><?php _e('Straight line distance', 'aegean-sail'); ?></label>
                            </div>
                            <div class="col-6">
                                <span><?php echo get_post_meta(get_the_ID(), 'route_distance', true); ?>NM</span>
                            </div>
                        </div>
                        <h4><?php _e('Travel without fossil fuel'); ?></h4>
                        <div class="row">
                            <div class="col-6 time icon-holder">
                                <label><?php _e('Total time', 'aegean-sail'); ?></label>
                            </div>
                            <div class="col-6">
                                <span><?php echo $travel_data[$windDirectionMapped]['time_wind']['route_travel_time_wind_' . $windSpeedMapped] . __('h', 'aegean-sail'); ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 battery icon-holder">
                                <label><?php _e('Battery Usage', 'aegean-sail'); ?></label>
                            </div>
                            <div class="col-6">
                                <span><?php echo $travel_data[$windDirectionMapped]['time_electricity']['route_travel_time_electricity_' . $windSpeedMapped] . __('h', 'aegean-sail'); ?></span>
                            </div>
                        </div>
                        <h4><?php _e('Travel with fossil fuel'); ?></h4>
                        <div class="row">
                            <div class="col-6 petrol icon-holder">
                                <label><?php _e('Total time', 'aegean-sail'); ?></label>
                            </div>
                            <div class="col-6">
                                <span><?php echo $travel_data[$windDirectionMapped]['time_petrol'] . __('h', 'aegean-sail'); ?></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row route-table-data">
                    <?php $winds_speeds = array(
                        '0_5' => __('0-5 kt', 'aegean-sail'),
                        '6_10' => __('5-10 kt', 'aegean-sail'),
                        '10_20' => __('10-20 kt', 'aegean-sail'),
                        '20_30' => __('20-30 kt', 'aegean-sail'),
                    ); ?>
                    <h4 class="section-devide"><?php _e('Routes info for all wheather conditions', 'aegean-sail'); ?></h4>
                    <div class="col-lg-7 route-table-data-winds">
                        <div class="route-table">
                            <div class="row table-title">
                                <div class="col-3">
                                    <label><?php _e('Wind', 'aegean-sail'); ?></label>
                                </div>
                                <div class="col-7">
                                    <label><?php _e('Travel without fossil fuel', 'aegean-sail'); ?></label>
                                </div>
                                <div class="col-2">
                                    <label><?php _e('Travel with fossil fuel', 'aegean-sail'); ?></label>
                                </div>
                            </div>
                            <div class="row table-labels">
                                <div class="col-3"></div>
                                <div class="col-7">
                                    <div class="row">
                                        <?php foreach ($winds_speeds as $wind_key => $wind_label) : ?>
                                            <div class="col-3">
                                                <label><?php echo  $wind_label; ?></label>
                                                <div class="row">
                                                    <div class="col-6 white-line">
                                                        <img src="<?php echo plugins_url('../assets/time.png', __FILE__); ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <img src="<?php echo plugins_url('../assets/battery.png', __FILE__); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-2 petrol-icon">
                                    <img src="<?php echo plugins_url('../assets/petrol.png', __FILE__); ?>">
                                </div>
                            </div>
                            <?php foreach ($travel_data as $windDirectionKey => $routeInfoTable) : ?>
                                <div class="row table-content">
                                    <div class="col-3 table-content-direction">
                                        <label><?php echo routes_map_direction($windDirectionKey); ?></label>
                                    </div>
                                    <div class="col-7 table-content-time-wind">
                                        <div class="row">
                                            <?php foreach ($winds_speeds as $wind_key => $wind_label) : ?>
                                                <div class="col-3 wind-speed-<?php echo $wind_key; ?>">
                                                    <div class="row">
                                                        <div class="col-6 white-line">
                                                            <span>
                                                                <?php echo $routeInfoTable['time_wind']['route_travel_time_wind_' . $wind_key] . __('h', 'aegean-sail'); ?>
                                                            </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <span>
                                                                <?php echo $routeInfoTable['time_electricity']['route_travel_time_electricity_' . $wind_key] . __('h', 'aegean-sail'); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-2 table-content-time-petrol">
                                        <span><?php echo $routeInfoTable['time_petrol'] . __('h', 'aegean-sail'); ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-lg-5 route-table-data-instrcutions">
                        <?php if (get_the_content()) : ?>
                            <h5><?php _e('Practical informations on the trip', 'aegean-sail'); ?></h5>
                            <div class="route-table-data-instrcutions-content">
                                <?php the_content(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($departure_island->post_content||$destination_island->post_content): ?>
                <div class="row route-islands-products">
                    <h4 class="section-devide"><?php _e('Products transfered by Aegean Cargo Sailing', 'aegean-sail'); ?></h4>
                    <div class="col-lg-8 offset-lg-2">
                        <div class="row route-islands">
                            <div class="col-md-6">
                                <h5 class="dep" style="background-image: url('<?php echo get_the_post_thumbnail_url($departure_island->ID, 'full'); ?>');">
                                    <?php echo $departure_island->post_title; ?>
                                </h5>
                                <div class="route-islands-products-content">
                                    <?php echo apply_filters('the_content', $departure_island->post_content);  ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="dest" style="background-image: url('<?php echo get_the_post_thumbnail_url($destination_island->ID, 'full'); ?>');">
                                    <?php echo $destination_island->post_title; ?>
                                </h5>
                                <div class="route-islands-products-content">
                                    <?php echo apply_filters('the_content', $destination_island->post_content); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ; ?>
            </div>
<?php
        endwhile;
        wp_reset_postdata();
    endif;
    wp_die();
} ?>