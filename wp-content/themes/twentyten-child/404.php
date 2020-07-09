<?php
/**
 * Template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
    <div class="not-fd-main">
	<div class="container">
		<div row="row">
            <div class="col-md-6 ">
              <div class="for-zero-form">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/404.jpg">
              </div>  
            </div>    
            <div class="col-md-6">
			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'twentyten' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->
            </div>
            
		</div><!-- #content -->
	</div><!-- #container -->
	</div>
	<script type="text/javascript">
		// Focus on search field after it has loaded.
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>
