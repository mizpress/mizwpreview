<?php

/**
 * The file that defines all functions related to listing & querying property post type
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themespla.net
 * @since      1.0.0
 *
 * @package    Neptune_Real_Estate
 * @subpackage Neptune_Real_Estate/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Neptune_Real_Estate
 * @subpackage Neptune_Real_Estate/includes
 * @author     themes planet <support@themespla.net>
 */
class Neptune_Real_Estate_Property {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Neptune_Real_Estate_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {


	}

	public function neptune_property_location(){

	//$category = get_the_category('location');
	$category = the_terms( $post->ID, 'location' );
	if ($category) {
	  echo '<span class="location"><a href="' . get_category_link( $category[0]->term_id ) . '" title="' . sprintf( __( "View all posts in %s", "neptune-real-estate" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a></span> ';
	}
	}

	public function neptune_google_map_api( $api ){
		
		$api['key'] = 'AIzaSyAvE8NvGvQBZqowSUtCliFMcKKdD--CIuA';
		
		return $api;
		
	}

	public function neptune_property_amenities(){
		$title = 'Amenities';
		echo '<h2>' . $title .'</h2>';
	    echo '<ul class="amenities clear">';
		    
		    $terms = wp_get_post_terms( get_the_ID(), 'amenities');

		        foreach ( $terms as $term) { 
		                         echo '<li>' . $term->name .'</li>';
		                      	}   
	    echo '</ul>';
	}
	

	public Function neptune_all_details(){

		$status = get_field('status');
		$price = get_field('price');
		$currency = get_theme_mod('currency');
		$rooms = get_field('rooms');
		$bedrooms = get_field('bedrooms');
		$bathrooms = get_field('bathrooms');
		$garage = get_field('garage');
		$area = get_field('area');
		$floors = get_field('floors');
		$heating = get_field('heating');
		$fireplace = get_field('fireplace');
		$appliance = get_field('appliances');
		$sewer = get_field('sewer');

		$title = 'Property Details';
		ob_start();
		echo '<h2>' . $title .'</h2>';
		echo '<ul class="amenities clear">';
			echo '<li>'. __('Status','neptune-real-estate') .'<b>: '. $status .'</b></li>';
			echo '<li>'. __('Bed','neptune-real-estate') .'<b>: '. $bedrooms .'</b></li>';
			echo '<li>'. __('Rooms','neptune-real-estate') .'<b>: '. $rooms .'</b></li>';
			echo '<li>'. __('Baths','neptune-real-estate') .'<b>: '. $bathrooms .'</b></li>';
			echo '<li>'. __('Garage','neptune-real-estate') .'<b>: '. $garage .'</b></li>';
			echo '<li>'. __('Area','neptune-real-estate') .'<b>: '. $area .'</b></li>';
			echo '<li>'. __('Appliance','neptune-real-estate') .'<b>: '. $appliance .'</b></li>';
			echo '<li>'. __('Heating','neptune-real-estate') .'<b>: '. $heating .'</b></li>';
			echo '<li>'. __('FirePlace','neptune-real-estate') .'<b>: '. $fireplace .'</b></li>';
			echo '<li>'. __('Sewer','neptune-real-estate') .'<b>: '. $sewer .'</b></li>';
			
		echo '</ul>';

	}
	

	public function neptune_price() {
		$currency = get_theme_mod('currency');
		$price = get_field('price');
		echo '<span><h3>'. $currency .'' . $price . '</h3></span>';

	}
	

	public function neptune_list_properties() {
	$toggle = get_field('property_toggle'); 
	if($toggle == 'enable'): 

		$title = get_field('section_title');
		$property_no = get_field('number_of_properties_to_show');

		echo '<div class="property-wrapper clear"> <div class="grid-wide property-preview section">';
		echo '<h2 class="section-title">'. $title .'</h2>';
		global $post;
		$arr = array(
		'post_type' => 'property',
		'posts_per_page'  => $property_no,
		 );
		$property = new WP_Query( $arr );

		if($property->have_posts()):
			while($property->have_posts()): $property->the_post();

			$status = get_field('status');
			$price = get_field('price');
			$currency = get_theme_mod('currency');
			$rooms = get_field('rooms');
			$bedrooms = get_field('bedrooms');
			$bathrooms = get_field('bathrooms');
			$garage = get_field('garage');
			$area = get_field('area');
		?>

			<div class="col-4-12 property">
				<?php 	if ( has_post_thumbnail() ) { 
					$thumb = get_the_post_thumbnail_url(get_the_ID(),'large');
				}
				else {
					$thumb = get_template_directory_uri() .'/img/header-default.jpg';
				} ?>
				<a href="<?php the_permalink(); ?>" >
					<div class="thumbnail" style="background-image:url('<?php echo $thumb; ?>'); background-size: cover;">
						<?php if($status == 'Rent') {?>
						<span class="for-rent"><?php _e('Rental','neptune-real-estate');?></span>
						<?php } elseif($status == "Sale") { ?>
						<span class="for-sale"><?php _e('For Sale','neptune-real-estate');?></span>
						<?php } else {?>
						<span class="sold"><?php _e('SOLDs','neptune-real-estate');?></span>
						<?php } ?>
					</div>
				</a>
				<div class="property-details">
					<?php //neptune_property_location(); ?>
					<span class="location"><?php the_terms( $post->ID, 'location' ); ?></span>
					<?php 
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>
					<span class="price"><?php echo $currency , $price; ?></span>
					<div class="property-amenities-small">
						<?php if($area) { ?>
						<span><?php echo  $area; ?></span> /
						<?php } 
						if($bedrooms) { ?>
						<span><?php _e('Bed','neptune-real-estate'); echo ': '. $bedrooms; ?></span> / 
						<?php } 
						if($bathrooms) { ?>
						<span><?php _e('Baths','neptune-real-estate'); echo ': '. $bathrooms; ?></span>/ 
						<?php } 
						if($garage) { ?>
						<span><?php _e('Garage','neptune-real-estate'); echo ': '. $garage; ?></span>
						<?php } ?>

					</div>
				</div>
			</div>


			<?php 
			endwhile;
		wp_reset_postdata();
		endif;
		echo '</div></div>';
	endif;
	}


	public function neptune_list_all_properties() {

		$title = get_field('section_title');
		$property_no = get_field('number_of_properties_to_show');

		echo '<div class="property-wrapper clear"> <div class="grid-wide property-preview section">';
		echo '<h2 class="section-title">'. $title .'</h2>';
		global $post;
		$arr = array(
		'post_type' => 'property',
		 );
		$property = new WP_Query( $arr );

		if($property->have_posts()):
			while($property->have_posts()): $property->the_post();

			$status = get_field('status');
			$price = get_field('price');
			$currency = get_theme_mod('currency');
			$rooms = get_field('rooms');
			$bedrooms = get_field('bedrooms');
			$bathrooms = get_field('bathrooms');
			$garage = get_field('garage');
			$area = get_field('area');
		?>

			<div class="col-4-12 property">
				<?php 	if ( has_post_thumbnail() ) { 
					$thumb = get_the_post_thumbnail_url(get_the_ID(),'large');
				}
				else {
					$thumb = get_template_directory_uri() .'/img/header-default.jpg';
				} ?>
				<a href="<?php the_permalink(); ?>" >
					<div class="thumbnail" style="background-image:url('<?php echo $thumb; ?>'); background-size: cover;">
						<?php if($status == 'Rent') {?>
						<span class="for-sale"><?php _e('For Sale','neptune-real-estate');?></span>
						<?php } elseif($status == "Sale") { ?>
						<span class="for-rent"><?php _e('Rental','neptune-real-estate');?></span>
						<?php } else {?>
						<span class="for-sale"><?php _e('SOLD','neptune-real-estate');?></span>
						<?php } ?>
					</div>
				</a>
				<div class="property-details">
					<?php //neptune_property_location(); ?>
					<span class="location"><?php the_terms( $post->ID, 'location' ); ?></span>
					<?php 
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>
					<span class="price"><?php echo $currency , $price; ?></span>
					<div class="property-amenities-small">
						<?php if($area) { ?>
						<span><?php echo  $area; ?></span> /
						<?php } 
						if($bedrooms) { ?>
						<span><?php _e('Bed','neptune-real-estate'); echo ': '. $bedrooms; ?></span> / 
						<?php } 
						if($bathrooms) { ?>
						<span><?php _e('Baths','neptune-real-estate'); echo ': '. $bathrooms; ?></span>/ 
						<?php } 
						if($garage) { ?>
						<span><?php _e('Garage','neptune-real-estate'); echo ': '. $garage; ?></span>
						<?php } ?>

					</div>
				</div>
			</div>


			<?php 
			endwhile;
		wp_reset_postdata();
		endif;
		echo '</div></div>';
	}
}