<?php
/**
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */

/**
*	Get all photos
**/ 

session_start();
$menu_sets_query = '';

if(!empty($term))
{
	$menu_sets_query.= $term;
	$obj_term = get_term_by('slug', $term, 'menu-cats');
}

$portfolio_items = -1;

$args = array( 
	'post_type' => array('menus'), 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'menu-cats' => $term,
	'order' => 'ASC',
	'orderby' => 'date',
); 
if(!empty($term))
{
	$args['menu_cats'].= $term;
}
$all_menu_arr = get_posts( $args );

//pp_debug($all_menu_arr);

?>
<script type="text/javascript"> 
$j(function() { $j('#map_contact').css('visibility', 'hidden'); });
$j(document).ready(function(){ 
	setTimeout(function() {
    	$j('#homepage_wrapper').animate({width: 'toggle'},{
			duration: 500,
		    complete: function() {
		    	$j('#homepage_wrapper').fadeIn();
		    	$j('#homepage_wrapper').children('.inner').fadeIn('slow');
		    	$j('#corner_right').css('display', 'block');
		    	$j('#corner_right_bottom').css('display', 'block');
		    	$j('#slidecaption').css('visibility', 'visible');
		    	$j('#supersized-loader').css({display: 'none'});
    	    }
		});
    }, 2000);
});
</script>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/screen.css" type="text/css" media="screen" />
<?php
if(isset($_SESSION['pp_skin']))
{
    $pp_skin = $_SESSION['pp_skin'];
}
else
{
    $pp_skin = get_option('pp_skin');
}

if($pp_skin == 'dark')
{
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/dark.css" type="text/css" media="screen" />
<?php
}
elseif($pp_skin == 'transparent')
	{
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/transparent.css" type="text/css" media="screen" />
<?php
	}
?>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/custom.js"></script>
		
<!-- Begin content -->
<div id="page_content_wrapper">
    
    <?php
    		$pp_gallery_width = 60;
    		$pp_gallery_height = 60;
    ?>
    
    <div class="inner">

    	<div class="inner_wrapper">
    	
    	<div class="sidebar_content">
    		<h1 class="page_header"><?php echo $obj_term->name; ?></h1><hr/>
    		
    		<?php
    			if(!empty($obj_term->description))
    			{
    		?>
    			<p><?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($obj_term->description)))); ?></p>
    			<br/><br/>
    		<?php
    			}
    		?>
    	
    	<?php
    		foreach($all_menu_arr as $key => $menu)
    		{
    			$small_image_url = '';
    			$image_thumb = array();
    			
    			if(has_post_thumbnail($menu->ID, 'large'))
				{
				    $image_id = get_post_thumbnail_id($menu->ID);
				    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
				}
    			
    			if(isset($image_thumb[0]))
    			{
    				$small_image_url = $full_image_url = wp_get_attachment_image_src($image_id, 'thumbnail', true);
    			}
    			
    			$menu_price = get_post_meta($menu->ID, 'menu_price', true);
    			$menu_stars = get_post_meta($menu->ID, 'menu_stars', true);
    			if(empty($menu_stars))
    			{
    				$menu_stars = 5;
    			}
    			
    			$yellow_stars = $menu_stars;
    			$blank_stars = 5 - $menu_stars
    	?>
    	
    	<div style="width:100%">
    		<?php 
    			if(!empty($small_image_url))
    			{
    		?>		
    			<div style="float:left;width:82px">
    				<a rel="gallery" href="<?php echo $image_thumb[0]; ?>">
    					<img src="<?php echo $small_image_url[0]; ?>" alt="" class="frame img_nofade food_thumb"/>
    				</a>
    			</div>
    		<?php
    			}		
    		?>			
    		<div style="float:left;width:300px">
    			<h5 class="cufon"><?php echo $menu->post_title ?></h5>
    			<?php
    				for($i=1;$i<=$yellow_stars;$i++)
    				{
    			?>
    				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_star.png" style="float:left;margin-right:2px" alt=""/>
    			<?php
    				}
    			?>
    			<?php
    				for($j=1;$j<=$blank_stars;$j++)
    				{
    			?>
    				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_star_empty.png" style="float:left;margin-right:2px" alt=""/>
    			<?php
    				}
    			?>
    			
    			<br class="clear"/>
    			<div class="menu_description">
	    			<?php echo $menu->post_content ?>
	    		</div>
    		</div>
    		<div style="float:right;width:50px">
    			<strong class="price"><?php echo $menu_price ?></strong>
    		</div>
    	</div>
    	
    	<br class="clear"/><br/><hr/>
    	
    	<?php
    		}
    	?>
    	</div>
    
    </div>
    <br class="clear"/>
    
</div>
<!-- End content -->

</div>

<?php get_footer(); ?>