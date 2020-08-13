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
		<div class="row">
		<!--
            <div class="col-md-6 ">
              <div class="for-zero-form">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/404.jpg">
              </div>  
            </div>  
            -->		
			
            <div class="col-md-12">
				<div id="post-0" class="post error404 not-found">
					<h1 class="entry-title"><?php _e( '404', 'twentyten' ); ?></h1>
					<div class="entry-content">
						<p><?php _e( "<span>Something's missing.</span>To find what you'are looking for,try our product search.", 'twentyten' ); ?></p>
			<form role="search" method="get" id="searchform" class="searchform" action="<?php echo site_url(); ?>">
				<div>
					<label class="screen-reader-text" for="s">Search for:</label>
					<input type="text" value="" name="s" id="s" placeholder="Search">
					<input type="submit" id="searchsubmit" value="">
				</div>
			</form>
			<a href="<?php echo site_url(); ?>">Go Back</a>
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
