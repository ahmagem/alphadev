<div class="qodef-comment-holder clearfix" id="comments">
	<div class="qodef-comment-number">
		<div class="qodef-comment-number-inner">
			<h6><?php comments_number( esc_html__('No Comments','startit'), '1'.esc_html__(' Comment ','startit'), '% '.esc_html__(' Comments ','startit')); ?></h6>
		</div>
	</div>
<div class="qodef-comments">
<?php if ( post_password_required() ) : ?>
				<p class="qodef-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'startit' ); ?></p>
			</div></div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>

	<ul class="qodef-comment-list">
		<?php wp_list_comments(array( 'callback' => 'startit_qode_comment')); ?>
	</ul>


<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'startit'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$qodef_consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> esc_html__( 'Post a Comment','startit' ),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','startit' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','startit' ),
	'label_submit' => esc_html__( 'Send message','startit' ),
	'comment_field' => '<span class="qodef-input-title">' . esc_html__( 'Comment','startit' ) .'</span><textarea id="comment" placeholder="'.esc_attr__( 'Write your comment here...','startit' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="qodef-three-columns clearfix"><div class="qodef-three-columns-inner"><div class="qodef-column"><div class="qodef-column-inner"><span class="qodef-input-title">' . esc_html__( 'Name','startit' ) .'</span><input id="author" name="author" placeholder="'. esc_attr__( 'Your full name','startit' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="qodef-column"><div class="qodef-column-inner"><span class="qodef-input-title">' . esc_html__( 'Email','startit' ) .'</span><input id="email" name="email" placeholder="'. esc_attr__( 'E-mail address','startit' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		'email' => '<div class="qodef-column"><div class="qodef-column-inner"><span class="qodef-input-title">' . esc_html__( 'Website','startit' ) .'</span><input id="url" name="url" type="text" placeholder="'. esc_attr__( 'Website','startit' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div>',
        'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $qodef_consent . ' />' .
            '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'startit' ) . '</label></p>'
		 ) ) );
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="qodef-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>
 <div class="qodef-comment-form">
	<?php comment_form($args); ?>
</div>
								
							


