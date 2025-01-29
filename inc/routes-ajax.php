<?php
add_action('wp_ajax_nopriv_aegean_sail_show_route_info', 'show_route_info_template');
add_action('wp_ajax_aegean_sail_show_route_info', 'show_route_info_template');
function show_route_info_template()
{

    //Get route
    $args = array(
        'post_type' => 'route',
        'posts_per_page' => 1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'route_departure',
                'value' => $_POST['departure'],
            ),
            array(
                'key' => 'route_destination',
                'value' => $_POST['destination'],
            ),
        )
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) : ?>
        GEIA
    <?php
    else:
        echo "fail";
    endif;
    wp_die();
}
