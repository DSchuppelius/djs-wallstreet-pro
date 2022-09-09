<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : comments.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$current_options = get_current_options();

if (post_password_required()) { ?>
	<p class="nopassword"><?php _e("This post is password protected. Enter the password to view any comments.", "wallstreet"); ?></p>
	<?php return;
}

// code for comment
if (!function_exists("wallstreet_comment")) {
    function wallstreet_comment($comment, $args, $depth) {
        global $comment_data;
        $is_answer = isset($comment_data["translation_reply_to_coment"]);
        $leave_reply = $is_answer ? $comment_data["translation_reply_to_coment"] : __("Reply", "wallstreet"); ?>	
	
		<div <?php comment_class("media comment_box"); ?> id="comment-<?php comment_ID(); ?>">
			<a class="pull-left-comment" href="<?php the_author_meta("user_url"); ?>">
				<?php echo get_avatar($comment, 70); ?>
			</a>
			<div class="media-body">
				<div class="comment-detail">
					<h4 class="comment-detail-title"><a href="<?php comment_author_url();?>"><?php comment_author(); ?></a>
						<span class="comment-date">
							<a href="<?php echo get_comment_link($comment->comment_ID); ?>">
								<?php _e("Posted on", "wallstreet"); echo "&nbsp;" . get_comment_date("j.M Y") . " (" . get_comment_time("H:i:s") . ")"; ?>
							</a>
						</span>
					</h4>
					<?php comment_text(); ?>
					<?php edit_comment_link(__("Edit", "wallstreet"), '<div class="edit-link">', "</div>"); ?>
					<div class="<?php echo $is_answer ? 'reply answer' : 'reply'; ?>">
						<?php comment_reply_link(array_merge($args, [
                            "reply_text" => $leave_reply,
                            "depth" => $depth,
                            "max_depth" => $args["max_depth"],
                            "per_page" => $args["per_page"],
                            ])
                        ); ?>
					</div>
					
					<?php if ($comment->comment_approved == "0") { ?>
						<em class="comment-awaiting-moderation"><?php _e("Your comment is awaiting moderation.", "wallstreet"); ?></em>
						<br/>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php }
}

if (have_comments()) { ?>
	<div class="comment-section<?php innerrow_frame_border(" "); ?>">
		<div class="comment-title">
			<h3><i class="fa-solid fa-comments"></i><?php comments_number(__("No comments so far", "wallstreet"), __("1 comment so far", "wallstreet"), __("% comments so far", "wallstreet")); ?></h3>
		</div>
		<?php wp_list_comments(["callback" => "wallstreet_comment"]); ?>
	</div>

	<?php if (get_comment_pages_count() > 1 && get_option("page_comments")) { ?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php _e("Comment navigation", "wallstreet"); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__("&larr; Older Comments", "wallstreet")); ?></div>
			<div class="nav-next"><?php next_comments_link(__("Newer Comments &rarr;", "wallstreet")); ?></div>
		</nav>
	<?php } elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), "comments")) {
     _e("Comments Are Closed!!!", "wallstreet");
    }
}

if ("open" == $post->comment_status) {
    if (get_option("comment_registration") && !$user_ID) { ?>
		<p><?php echo sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', "wallstreet"), site_url("wp-login.php") . "?redirect_to=" . urlencode(get_permalink())); ?></p>
	<?php } else { ?>
		<div class="comment-form-section<?php innerrow_frame_border(" "); ?>">
            <?php $fields = [
                "url" => '<div class="blog-form-group-full"><input class="blog-form-control" name="url" id="url" value="" type="url" placeholder="' . __("Website", "wallstreet") . '" /></div>',
                "author" => '<div class="blog-form-group"><input class="blog-form-control" name="author" id="author" value="" type="name" placeholder="' . __("Name", "wallstreet") . '" /></div>',
                "email" => '<div class="blog-form-group"><input class="blog-form-control" name="email" id="email" value="" type="email" placeholder="' . __("Email", "wallstreet") . '" /></div>',
            ];

            function my_fields($fields) {
                return $fields;
            }
            add_filter("comment_form_default_fields", "my_fields");

            $defaults = [
                "fields" => apply_filters("comment_form_default_fields", $fields),
                "comment_field" => '<div class="blog-form-group-textarea" ><textarea id="comments" rows="5" class="blog-form-control-textarea" name="comment" type="text" placeholder="' . __("Leave your message", "wallstreet") . '"></textarea></div>',
                "logged_in_as" => '<p class="logged-in-as">' . __("Logged in as", "wallstreet") . ' <a href="' . admin_url("profile.php") . '">' . $user_identity . "</a>" . '<a href="' . wp_logout_url(get_permalink()) . '" title="' . __("Log out from this Account", "wallstreet") . '"> ' . __("Log out", "wallstreet") . "</a>" . "</p>",
                "id_submit" => "blogdetail_btn",
                "class_submit" => "btn submit",
                "label_submit" => __("Send Message", "wallstreet"),
                "submit_button" => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />%4$s</button>',
                "comment_notes_before" => "<p>" . $current_options["before_comment"] . "</p>",
                "comment_notes_after" => "<p>" . $current_options["after_comment"] . "</p>",
                "title_reply" => '<div class="comment-title"><h3><i class="fa-solid fa-comment-dots"></i>' . __("Leave a Reply", "wallstreet") . "</h3></div>",
                'title_reply_to' => '<div class="comment-title answer"><h3><i class="fa-solid fa-comment-dots"></i>' . __("Leave a Reply to %s", "wallstreet") . "</h3></div>",
                "id_form" => "commentform",
            ];
            comment_form($defaults); ?>
		</div>	
	<?php }
} ?>
