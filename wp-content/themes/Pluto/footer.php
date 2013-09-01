<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Kratong
 */
?>

<?php
		/**
    	*	Setup Google Analyric Code
    	**/
    	include (TEMPLATEPATH . "/google-analytic.php");
?>

<div id="footer">
	<br class="clear"/><br/><br/>
	<div id="copyright">
	    <?php
	    	/**
	    	 * Get footer text
	    	 */
	
	    	$pp_footer_text = get_option('pp_footer_text');
	    	echo stripslashes(html_entity_decode($pp_footer_text));
	    ?>
	</div>
</div>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
