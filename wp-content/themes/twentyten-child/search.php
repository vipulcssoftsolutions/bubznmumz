<?php
/**
 * Template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>



<?php if ( have_posts() ) : ?>
		<div class="container">
			<div id="content" role="main">
				<h1 class="page-title">
				<?php
				/* translators: %s: Search query. */
				printf( __( 'Search Results for: %s', 'twentyten' ), '<span>' . get_search_query() . '</span>' );
				?>
				</h1>
				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				get_template_part( 'loop', 'search' );
				?>
				</div>
				</div>
<?php else : ?>
    <div class="not-fd-main">
	<div class="container">
	 <div class="col-md-6 ">
              <div class="for-zero-form">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/404.jpg">
              </div>  
            </div>  
			<div class="col-md-6">
			<div id="post-0" class="post no-results not-found">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyten' ); ?></h1>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
            </div>
				
	</div>
				</div><!-- #content -->
<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
