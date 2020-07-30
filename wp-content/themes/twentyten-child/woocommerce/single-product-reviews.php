<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<h2>Ratings & Reviews </h2> 
	<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Write a review
</button>

                  <?php
                        $rating_1 = $product->get_rating_count(1);
                        $rating_2 = $product->get_rating_count(2);
                        $rating_3 = $product->get_rating_count(3);
                        $rating_4 = $product->get_rating_count(4);
                        $rating_5 = $product->get_rating_count(5);
                        $totalreview_count = $product->get_review_count();
    
                    ?>

<div class="review-shadow-wrap">
    <div class="rating-progress-section">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h2>Rating Snapshot</h2>
                <div class="sec-blck">
                    <span> 5 <i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo  $rating_5/$totalreview_count * 100; ?>%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ind-rat-val">
                    <?php echo $rating_5; ?>
                </span>    
                </div>    
                <div class="sec-blck">
                    <span> 4 <i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo  $rating_4/$totalreview_count * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ind-rat-val">
                    <?php echo $rating_4; ?>
                </span>     
                </div>    
                <div class="sec-blck">
                    <span> 3 <i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo  $rating_3/$totalreview_count * 100; ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="ind-rat-val">
                    <?php echo $rating_3; ?>
                </span>      
                </div>    
               <div class="sec-blck">
                   <span> 2 <i class="fa fa-star" aria-hidden="true"></i></span>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo  $rating_2/$totalreview_count * 100; ?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                   <span class="ind-rat-val">
                    <?php echo $rating_2; ?>
                </span> 
                </div>                
                <div class="sec-blck">
                <span> 1 <i class="fa fa-star" aria-hidden="true"></i></span>
                 <div class="progress">
                     <div class="progress-bar" role="progressbar" style="width: <?php echo  $rating_1/$totalreview_count * 100; ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                 <span class="ind-rat-val">
                    <?php echo $rating_1; ?>
                </span>     
                </div>    
            </div>
            <div class="col-md-6 col-sm-12">
                <h2>Average Customer Ratings</h2>
                <div class="sec-blck">
                   <span>Overall </span> <div class="review_rating text-center woocommerce">
                              <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
                            </div>
                </div>    
            </div>
        </div>      
    </div>
	
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
			} else {
				esc_html_e( 'Ratings & Reviews', 'woocommerce' );
			}
			?>
		</h2>

		<?php if ( have_comments() ) : ?>
			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => '<i class="fa fa-angle-left"></i>',
							'next_text' => '<i class="fa fa-angle-right"></i>',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	  </div>
	</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <div class="img-prdc">
			  <img src="<?php echo get_the_post_thumbnail_url($product->get_id()); ?>"> <span class="prod-title"><?php echo get_the_title($product->get_id()); ?></span>
			</div>  
        <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'woocommerce' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'woocommerce' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Post Review', 'woocommerce' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    => __( 'Name', 'woocommerce' ),
						'type'     => 'text',
						'value'    => $commenter['comment_author'],
						'required' => $name_email_required,
					),
					'email'  => array(
						'label'    => __( 'Email', 'woocommerce' ),
						'type'     => 'email',
						'value'    => $commenter['comment_author_email'],
						'required' => $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
					$field_html .= '<label for="' . esc_attr( $key ) . '">' . esc_html( $field['label'] );

					if ( $field['required'] ) {
						$field_html .= '&nbsp;<span class="required">*</span>';
					}

					$field_html .= '</label><input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Overall Rating', 'woocommerce' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Click for Rate', 'woocommerce' ) . '</option>
						<option value="5">' . esc_html__( 'Excellent', 'woocommerce' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
						<option value="2">' . esc_html__( 'Fair', 'woocommerce' ) . '</option>
						<option value="1">' . esc_html__( 'Poor', 'woocommerce' ) . '</option>
					</select><span class="rate-val">Click to rate!</div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Review', 'woocommerce' ) . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>
	<?php else : ?>
		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>
	<?php endif; ?>
      </div>
    </div>
  </div>
</div>
	

	<div class="clear"></div>
</div>

