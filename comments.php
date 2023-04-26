<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : comments.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */

$current_setup = DJS_Wallstreet_Pro_Theme_Setup::instance();

if (post_password_required()) { ?>
    <p class="nopassword"><?php esc_html_e("This post is password protected. Enter the password to view any comments.", "djs-wallstreet-pro"); ?></p>
    <?php return;
}

// code for comment
if (!function_exists("wallstreet_comment")) {
    function wallstreet_comment($comment, $args, $depth) {
        global $comment_data;
        $is_answer = isset($comment_data["translation_reply_to_coment"]);
        $leave_reply = $is_answer ? $comment_data["translation_reply_to_coment"] : esc_html__("Reply", "djs-wallstreet-pro"); ?>	
    
        <div <?php comment_class("media comment_box"); ?> id="comment-<?php comment_ID(); ?>">
            <a class="pull-left-comment" href="<?php esc_url(the_author_meta("user_url")); ?>">
                <?php echo get_avatar($comment, 70); ?>
            </a>
            <div class="media-body">
                <div class="comment-detail">
                    <h4 class="comment-detail-title"><a href="<?php esc_url(comment_author_url());?>"><?php comment_author(); ?></a>
                        <span class="comment-date">
                            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                <?php esc_html_e("Posted on", "djs-wallstreet-pro"); echo "&nbsp;" . get_comment_date("j.M Y") . " (" . get_comment_time("H:i:s") . ")"; ?>
                            </a>
                        </span>
                    </h4>
                    <?php comment_text(); ?>
                    <?php edit_comment_link(esc_html__("Edit", "djs-wallstreet-pro"), '<div class="edit-link">', "</div>");
                    if(comments_open()) { ?>
                    <div class="<?php echo $is_answer ? 'reply answer' : 'reply'; ?>">
                        <?php comment_reply_link(array_merge($args, [
                            "reply_text" => $leave_reply,
                            "depth" => $depth,
                            "max_depth" => $args["max_depth"],
                            "per_page" => $args["per_page"],
                            ])
                        ); ?>
                    </div>
                    
                    <?php }
                    if ($comment->comment_approved == "0") { ?>
                        <em class="comment-awaiting-moderation"><?php esc_html_e("Your comment is awaiting moderation.", "djs-wallstreet-pro"); ?></em>
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
            <h3><i class="fa-solid fa-comments"></i><?php comments_number(esc_html__("No comments so far", "djs-wallstreet-pro"), esc_html__("1 comment so far", "djs-wallstreet-pro"), esc_html__("% comments so far", "djs-wallstreet-pro")); ?></h3>
        </div>
        <?php wp_list_comments(["callback" => "wallstreet_comment"]); ?>
    </div>

    <?php if (get_comment_pages_count() > 1 && get_option("page_comments")) { ?>
        <nav id="comment-nav-below">
            <h1 class="assistive-text"><?php esc_html_e("Comment navigation", "djs-wallstreet-pro"); ?></h1>
            <div class="nav-previous"><?php previous_comments_link(esc_html__("&larr; Older Comments", "djs-wallstreet-pro")); ?></div>
            <div class="nav-next"><?php next_comments_link(esc_html__("Newer Comments &rarr;", "djs-wallstreet-pro")); ?></div>
        </nav>
    <?php } elseif (!comments_open() && !is_page() && post_type_supports(get_post_type(), "comments")) { ?>
        <div class="comment-section closed">
            <?php esc_html_e("Comments Are Closed!!!", "djs-wallstreet-pro"); ?>
        </div>     
    <?php }
}

if ("open" == $post->comment_status) {
    if (get_option("comment_registration") && !$user_ID) { ?>
        <p><?php echo sprintf(esc_html__('You must be <a href="%s">logged in</a> to post a comment.', "djs-wallstreet-pro"), esc_url(wp_login_url(get_permalink()))); ?></p>
    <?php } else { ?>
        <div class="comment-form-section<?php innerrow_frame_border(" "); ?>">
            <?php $fields = [
                "url" => '<div class="blog-form-group-full"><input class="blog-form-control" name="url" id="url" value="" type="url" placeholder="' . esc_html__("Website", "djs-wallstreet-pro") . '" /></div>',
                "author" => '<div class="blog-form-group"><input class="blog-form-control" name="author" id="author" value="" type="name" placeholder="' . esc_html__("Name", "djs-wallstreet-pro") . '" /></div>',
                "email" => '<div class="blog-form-group"><input class="blog-form-control" name="email" id="email" value="" type="email" placeholder="' . esc_html__("Email", "djs-wallstreet-pro") . '" /></div>',
            ];

            function my_fields($fields) {
                return $fields;
            }
            add_filter("comment_form_default_fields", "my_fields");

            $defaults = [
                "fields" => apply_filters("comment_form_default_fields", $fields),
                "comment_field" => '<div class="blog-form-group-textarea" ><textarea id="comments" rows="5" class="blog-form-control-textarea" name="comment" type="text" placeholder="' . esc_html__("Leave your message", "djs-wallstreet-pro") . '"></textarea></div>',
                "logged_in_as" => '<p class="logged-in-as">' . esc_html__("Logged in as", "djs-wallstreet-pro") . ' <a href="' . esc_url(admin_url("profile.php")) . '">' . $user_identity . "</a>" . '<a href="' . esc_url(wp_logout_url(get_permalink())) . '" title="' . esc_html__("Log out from this Account", "djs-wallstreet-pro") . '"> ' . esc_html__("Log out", "djs-wallstreet-pro") . "</a>" . "</p>",
                "id_submit" => "blogdetail_btn",
                "class_submit" => "btn submit",
                "label_submit" => esc_html__("Send Message", "djs-wallstreet-pro"),
                "submit_button" => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />%4$s</button>',
                "comment_notes_before" => empty($current_setup->get("before_comment")) ? "" : "<p><b>" . esc_html__("Please Note:", "djs-wallstreet-pro"). "</b>&nbsp;" . $current_setup->get("before_comment") . "</p>",
                "comment_notes_after" => empty($current_setup->get("after_comment")) ? "" :"<p>" . $current_setup->get("after_comment") . "</p>",
                "title_reply" => '<div class="comment-title"><h3><i class="fa-solid fa-comment-dots"></i>' . esc_html__("Leave a Reply", "djs-wallstreet-pro") . "</h3></div>",
                'title_reply_to' => '<div class="comment-title answer"><h3><i class="fa-solid fa-comment-dots"></i>' . esc_html__("Leave a Reply to %s", "djs-wallstreet-pro") . "</h3></div>",
                "id_form" => "commentform",
            ];
            comment_form($defaults); ?>
        </div>	
    <?php }
} ?>
