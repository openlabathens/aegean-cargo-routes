<?php
add_shortcode('aegean_sail_routes', 'aegean_sail_routes_template');
function aegean_sail_routes_template()
{

	//Add scripts
	wp_enqueue_script('aegean-sail-jquery', 'https://code.jquery.com/jquery-3.7.1.min.js');
	wp_enqueue_script('aegean-sail-roundslider', 'https://cdn.jsdelivr.net/npm/round-slider@1.6.1/dist/roundslider.min.js');
	wp_enqueue_script('aegean-sail-routes', plugins_url('/js/routes.js', __FILE__), 'jquery');
	ob_start();
?>

	<div class="container-fluid green-routes">

		<div class="row routes-info">
			<div class="col-md-12" id="routes-info-placement" data-numbering="1">
			</div>
		</div>

		<div class="row routes-menu">

			<!-- Pick Route -->
			<div class="col-lg-5 routes-menu-left">
				<h3><?php _e('pick a route', 'aegean-sail'); ?></h3>
				<div class="island-list">
					<?php
					//Get island
					$args = array(
						'post_type' => 'island',
						'posts_per_page' => -1,
						'orderby' => 'menu_order',
						'order' => 'ASC'
					);
					$the_query = new WP_Query($args);
					if ($the_query->have_posts()) :

						while ($the_query->have_posts()) :
							$the_query->the_post(); ?>
							<div class="island" data-island="<?php echo get_the_ID();  ?>">
								<div class="island-icon" style="background-image: url('<?php echo get_field('island_icon_wh'); ?>')"></div>
								<h4><?php echo get_the_title(); ?></h4>
							</div>
					<?php
						endwhile;
					endif;
					?>
				</div>
			</div>
			<!-- Pick Weather -->
			<div class="col-lg-7 routes-menu-right">
				<h3><?php _e('define current weather conditions', 'aegean-sail'); ?></h3>
				<div class="row weather-controls">
					<div class="col-lg-12 col-xl-6 control wind">
						<h5><?php _e('wind direction', 'aegean-sail'); ?></h5>
						<div id="wind-slider" class="weather-slider wind-slider"></div>

					</div>
					<div class="col-lg-12 col-xl-6 control speed">
						<h5><?php _e('wind speed (kt)', 'aegean-sail'); ?></h5>
						<div id="speed-slider" class="weather-slider speed-slider"></div>
					</div>
				</div>
				<input id="island-departure" type="hidden" name="departure" value="0">
				<input id="island-destination" type="hidden" name="destination" value="0">

				<button id="calculate-route" class="calculate-button disabled">
					<img src="<?php echo plugins_url('/assets/blow-icon.png', __FILE__); ?>">
					<?php _e('Calculate', 'aegean-sail'); ?>
				</button>
			</div>

		</div>



	</div>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}


?>