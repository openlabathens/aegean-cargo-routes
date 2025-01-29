<?php
/**
 * Plugin Name: Aegean Cargo Routes
 * Description: Displays data for selected routes between islands of the Aegean Sea. It presents the routes traveling time with Solar and Wind power, and with fossil fuel engine.
 * Version: 1.0
 * Author: Open Lab Athens
 * Author URI: https://olathens.gr/
 * Text Domain: aegean-sail
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 **/

// Register Post Types
require_once('registration/register-post-types.php');

//Shortcode to show routes
require_once('routes-template.php');

//Include
require_once('inc/routes-helpers.php');
require_once('inc/routes-ajax.php');

//Include Style
function aegean_sail_enqueue_style() {
	wp_enqueue_style( 'aegean-sail-routes', plugins_url('/css/aegean-sail.css', __FILE__) );
	wp_enqueue_style( 'aegean-sail-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );
	wp_enqueue_style( 'aegean-sail-roundslider', 'https://cdn.jsdelivr.net/npm/round-slider@1.6.1/dist/roundslider.min.css' );
	wp_enqueue_style( 'aegean-sail-font','https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&display=swap" rel="stylesheet');

}
add_action( 'wp_enqueue_scripts', 'aegean_sail_enqueue_style' );


