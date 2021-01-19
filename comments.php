<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package online_mart
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

<div id="comments" class="comments-area container">

    <?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
	<a class="btn btn-primary" data-toggle="collapse" href="#comments-replay" role="button" aria-expanded="false" aria-controls="comments-replay">
		<?php ( 'Comentar'); ?> <i class="fas fa-question"></i></i>
  	</a>
    <div class="collapse row" id="comments-replay">
        <div class="col-md-6">
            <h2 class="comments-title">
                <?php
					$online_mart_comment_count = get_comments_number();
					if ( '1' === $online_mart_comment_count ) {
						printf(
							/* translators: 1: title. */
							esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'online_mart' ),
							'<span>' . wp_kses_post( get_the_title() ) . '</span>'
						);
					} else {
						printf( 
							/* translators: 1: comment count number, 2: title. */
							esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $online_mart_comment_count, 'comments title', 'online_mart' ) ),
							number_format_i18n( $online_mart_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'<span>' . wp_kses_post( get_the_title() ) . '</span>'
						);
					}
				?>
            </h2><!-- .comments-title -->
            <div class="container">
                <ul class="comment-list">
                    <?php
					wp_list_comments(
						array(
							'walker'            => null,
							'max_depth'         => '',
							'style'             => 'ul',
							'callback'          => null,
							'end-callback'      => null,
							'type'              => 'all',
							'page'              => '',
							'per_page'          => '',
							'avatar_size'       => 32,
							'reverse_top_level' => null,
							'reverse_children'  => '',
							'format'            => 'html5', // or 'xhtml' if no 'HTML5' theme support
							'short_ping'        => true,   // @since 3.6
							'echo'              => true     // boolean, default is true
						)
					);
				?>
                </ul><!-- .comment-list -->
            </div>
		</div>
		<div class="col-md-6">
			<?php
					the_comments_navigation();

					// If comments are closed and there are comments, let's leave a little note, shall we?
					if ( ! comments_open() ) :
			?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'online_mart' ); ?></p>
			<?php
					endif;

				endif; // Check for have_comments().

				comment_form();
			?>
		</div>
    </div>
    <?php the_comments_navigation(); ?>



    

</div><!-- #comments -->