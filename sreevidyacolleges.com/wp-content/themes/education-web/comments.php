<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Education_Web
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'education-web' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'education-web' ) ),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<ul class="comment-list">

	    	<?php wp_list_comments('type=comment&callback=education_web_comment'); ?>

	  	</ul>

		<?php the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'education-web' ); ?></p>
		<?php
		endif;

	endif; // Check for have_comments().

		$args = array(
			
			'fields' => apply_filters(        
				'comment_form_default_fields', array(

				'author' =>'
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">'. 
								'<i class="fa fa-user"></i><input placeholder="'.esc_html__( 'Full Name *', 'education-web' ).'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" />'.
							'</div>
						</div>',

				'email'  => '
						<div class="col-md-6">
							<div class="form-group">' . 
								'<i class="fa fa-envelope"></i><input id="buzz-email" placeholder="'.esc_html__( 'Email Address *', 'education-web' ).'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" />'  .
							'</div>
						</div>'
				)
			),

			'comment_field' => '
					<div class="col-md-12">
						<div class="form-group">
							<div class="buzz-controls">' .
								'<i class="fa fa-pencil"></i><textarea id="comment" name="comment" placeholder="'.esc_html__( 'Comment *', 'education-web' ).'" ></textarea>' .
							'</div>
						</div>
					</div>',

			'comment_notes_after' => '',

			'label_submit' =>esc_html__( 'ADD COMMENT', 'education-web' ),

			'comment_notes_before' => '',
		);
		       
		comment_form($args);
		

	?>

</div><!-- #comments -->
