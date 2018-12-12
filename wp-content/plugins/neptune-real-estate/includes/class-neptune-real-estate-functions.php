<?php

/**
 * The file that defines all the miscellanous functions
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
class Neptune_Real_Estate_Functions {

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

    public function neptune_real_estate_header() {


	$image = get_field('hero_image'); 
	$bg = wp_get_attachment_image_url($image,'full');
	$herotext = get_field('hero_text_large');
	$herotextb = get_field('hero_text_small');
	$button1 = get_field('button_link_1');
	$button2 = get_field('button_link_2');


	

	if ( get_field( 'hero_toggle' )== 'enable' ): ?>		
		<div class="header-image" style="background-image: url('<?php echo $bg; ?>');background-size:cover;">
			<div class="overlay"></div>
		
	        <div class="welcome">
	           <div class="welcome-text">
	            <h1><?php echo $herotext; ?></h1>

	            <?php if ( $herotextb ) { ?>
	                   <h2><?php echo $herotextb; ?></h2>

				<?php  } if( $button1 ): ?>
					
					<a class="button" href="<?php echo $button1['url']; ?>" target="<?php echo $button1['target']; ?>">
						<?php echo $button1['title']; ?>
					</a>

				<?php endif; ?>

				<?php if( $button2 ): ?>
					
					<a class="button-alt" href="<?php echo $button2['url']; ?>" target="<?php echo $button2['target']; ?>">
						<?php echo $button2['title']; ?>
					</a>

				<?php endif; ?>

	           </div>
	       </div>
	       
	    		
		</div>
	<?php endif;
    }
    public function neptune_theme_check() {
		$theme = wp_get_theme(); // gets the current theme
		$url = 'https://thepixeltribe.com/downloads/best-free-wordpress-real-estate-theme/';
        if ( 'Neptune Real Estate' == $theme->name || 'neptune real estate' == $theme->parent_theme ) {
            
            echo '<div class="notice notice-success is-dismissible neptune-notice"><p>';
				printf( esc_html__("Neptune Theme & Plugin Activated, Get setup instructions %s!", "neptune_real_estate_pro"), '<a href="http://support.thepixeltribe.com/docs/neptune-real-estate/">here</a>' );
            echo '</p></div>';
        }else {
            
            echo '<div class="notice notice-error is-dismissible neptune-notice"><p>';
				printf( esc_html__("Its Recomended to use the free theme %s Neptune Real Estate </a>for a seamless real estate solution!", "neptune_real_estate_pro"), '<a href="https://thepixeltribe.com/downloads/best-free-wordpress-real-estate-theme/">Neptune Real Estate</a>' );
			echo '</p></div>';
            
         }
    }
    public function neptune_upgrade() {
        if (!function_exists('neptune_real_estate_pro')){
            echo '<div class="notice notice-success is-dismissible neptune-notice neptune-upgrade"><p>';
 
                printf( esc_html__("Want more features? like property search, Image gallery & Property Agents? %s for just $69 ,get 20&#37; off if you use this code neptune20","neptune_real_estate_pro"), '<a href="https://thepixeltribe.com/downloads/best-free-wordpress-real-estate-theme/">GO PRO</a>' );
            echo '</p></div>';            
        }
	}
	function neptune_register_required_plugins() {
		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
	
			// This is an example of how to include a plugin from the WordPress Plugin Repository.
			array(
				'name'      => 'Advanced Custom Fields',
				'slug'      => 'advanced-custom-fields',
				'required'  => false,
			),
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			/*
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
				'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
				// <snip>...</snip>
				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
			*/
		);
		tgmpa( $plugins, $config );
	
	}

	function neptune_list_blog() {
		$toggle = get_field('blog_toggle'); 
		if($toggle == 'enable'): 

			$title = get_field('blog_title');
			$blog_no = get_field('blogs_to_show');

			echo '<div id="primary" class="content-areaclear"><main id="main" class="site-main  grid-wide section">';
			echo '<h2 class="section-title">'. $title .'</h2>';
			global $post;
			$arr = array(
			'post_type' => 'post',
			'posts_per_page'  => $blog_no,
			 );
			$blog = new WP_Query( $arr );

			if($blog->have_posts()):
				while($blog->have_posts()): $blog->the_post();


				get_template_part( 'template-parts/content-preview', get_post_format() );

				endwhile;
			wp_reset_postdata();
			endif;
			echo '</div></div>';
		endif;
	}

	function neptune_cta() {
		$image = get_field('cta_bg');
		$bg = wp_get_attachment_image_url($image, 'large');
		$link = get_field('cta_link');
		$button_label = get_field('cta_button_label');
		$content = get_field('cta_text');
	if($content) {
		echo '<div class="cta section" style="background-image:url('.$bg.');">';
		echo '<div class="cta-overlay"></div><div class="grid-wide">';

		echo '<h3>' .$content .'</h3>';

		if( $link ):
			
			echo '<a class="button" href='. $link .'> '.$button_label .'</a>';

		endif;
		echo '</div></div>';
		echo '</div>';
	}
	}
	
	
}
