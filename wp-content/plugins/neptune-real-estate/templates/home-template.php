<?php
/**
 * Template name: home
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Neptune WP
 */

get_header(); ?>


<?php
do_action('neptune_real_estate_header');
 $toggle = get_field('intro_toggle'); 
if($toggle == 'enable'): ?>
	<div class="section">
		<div class="grid-wide intro">
			<h2 class="section-title"> <?php the_field('title');?> </h2>
			<?php the_field('content'); ?>
		</div>
	</div>
<?php endif;// end intro section

 //properties
do_action('neptune_real_estate_list_properties'); 
do_action('neptune_real_estate_cta');
do_action('neptune_list_blog');

get_footer();
