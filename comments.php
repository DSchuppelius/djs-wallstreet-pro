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
    <p class="nopassword surface-card">
        <?php esc_html_e("This post is password protected. Enter the password to view any comments.", "djs-wallstreet-pro"); ?>
    </p>
    <?php return;
}

if (!function_exists("wallstreet_comment")) {
    /**
     * Ausgabe eines einzelnen Kommentars (wp_list_comments-Callback, Name bleibt kompatibel).
     */
    function wallstreet_comment($comment, $args, $depth) {
        $author_url = get_comment_author_url($comment);
        $tag        = $args["style"] === "div" ? "div" : "li"; ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(["comment-item", empty($args["has_children"]) ? "" : "parent"]); ?>>
            <article class="comment-card">
                <div class="comment-card__avatar">
                    <?php echo get_avatar($comment, 56, "", "", ["class" => "comment-img"]); ?>
                </div>
                <div class="comment-card__body">
                    <header class="comment-card__header">
                        <span class="comment-card__author">
                            <?php if ($author_url) { ?>
                                <a href="<?php echo esc_url($author_url); ?>" rel="nofollow ugc"><?php comment_author(); ?></a>
                            <?php } else {
                                comment_author();
                            } ?>
                        </span>
                        <a class="comment-card__date" href="<?php echo esc_url(get_comment_link($comment)); ?>">
                            <time datetime="<?php comment_time("c"); ?>">
                                <?php echo esc_html(get_comment_date(DJS_Wallstreet_Pro_Theme_Setup::instance()->get("fulldatetimeformat"), $comment)); ?>
                            </time>
                        </a>
                    </header>

                    <?php if ($comment->comment_approved == "0") { ?>
                        <p class="comment-awaiting-moderation badge badge-warning badge-soft"><?php esc_html_e("Your comment is awaiting moderation.", "djs-wallstreet-pro"); ?></p>
                    <?php } ?>

                    <div class="comment-content entry-content"><?php comment_text(); ?></div>

                    <footer class="comment-card__actions">
                        <?php if (comments_open()) {
                            comment_reply_link(array_merge($args, [
                                "reply_text" => '<span class="material-icons" aria-hidden="true">reply</span>' . esc_html__("Reply", "djs-wallstreet-pro"),
                                "depth"      => $depth,
                                "max_depth"  => $args["max_depth"],
                            ]));
                        }
                        edit_comment_link(esc_html__("Edit", "djs-wallstreet-pro"), '<span class="edit-link">', "</span>"); ?>
                    </footer>
                </div>
            </article>
        <?php
        // Das schliessende </li> setzt wp_list_comments() selbst (end-callback).
    }
} ?>

<section id="comments" class="comments-area">
    <?php if (have_comments()) { ?>
        <div class="comment-section surface-card">
            <h2 class="comments-title comment-title">
                <span class="material-icons" aria-hidden="true">forum</span>
                <?php comments_number(esc_html__("No comments so far", "djs-wallstreet-pro"), esc_html__("1 comment so far", "djs-wallstreet-pro"), esc_html__("% comments so far", "djs-wallstreet-pro")); ?>
            </h2>
            <ol class="comment-list">
                <?php wp_list_comments(["callback" => "wallstreet_comment", "style" => "ol", "avatar_size" => 56]); ?>
            </ol>

            <?php the_comments_pagination([
                "prev_text" => esc_html__("← Older Comments", "djs-wallstreet-pro"),
                "next_text" => esc_html__("Newer Comments →", "djs-wallstreet-pro"),
                "class"     => "comment-pagination",
            ]); ?>
        </div>
    <?php } ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), "comments")) { ?>
        <p class="comments-closed surface-card"><?php esc_html_e("Comments Are Closed!!!", "djs-wallstreet-pro"); ?></p>
    <?php } ?>

    <?php if (comments_open()) {
        $before = (string) $current_setup->get("before_comment");
        $after  = (string) $current_setup->get("after_comment");
        $req    = get_option("require_name_email");

        $fields = [
            "author" => '<p class="comment-form-author form-field"><label for="author">' . esc_html__("Name", "djs-wallstreet-pro") . ($req ? " *" : "") . '</label><input id="author" name="author" type="text" autocomplete="name" value="' . esc_attr(wp_get_current_commenter()["comment_author"]) . '"' . ($req ? " required" : "") . "></p>",
            "email"  => '<p class="comment-form-email form-field"><label for="email">' . esc_html__("Email", "djs-wallstreet-pro") . ($req ? " *" : "") . '</label><input id="email" name="email" type="email" autocomplete="email" value="' . esc_attr(wp_get_current_commenter()["comment_author_email"]) . '"' . ($req ? " required" : "") . "></p>",
            "url"    => '<p class="comment-form-url form-field"><label for="url">' . esc_html__("Website", "djs-wallstreet-pro") . '</label><input id="url" name="url" type="url" autocomplete="url" value="' . esc_attr(wp_get_current_commenter()["comment_author_url"]) . '"></p>',
        ];

        comment_form([
            "class_container"      => "comment-respond comment-form-section surface-card",
            "fields"               => apply_filters("comment_form_default_fields", $fields),
            "comment_field"        => '<p class="comment-form-comment form-field form-field--full"><label for="comment">' . esc_html__("Leave your message", "djs-wallstreet-pro") . ' *</label><textarea id="comment" name="comment" rows="6" required></textarea></p>',
            "title_reply"          => '<span class="material-icons" aria-hidden="true">rate_review</span>' . esc_html__("Leave a Reply", "djs-wallstreet-pro"),
            /* translators: %s: comment author */
            "title_reply_to"       => '<span class="material-icons" aria-hidden="true">reply</span>' . esc_html__("Leave a Reply to %s", "djs-wallstreet-pro"),
            "title_reply_before"   => '<h2 id="reply-title" class="comment-reply-title comment-title">',
            "title_reply_after"    => "</h2>",
            "comment_notes_before" => $before === "" ? "" : '<p class="comment-notes"><strong>' . esc_html__("Please Note:", "djs-wallstreet-pro") . "</strong> " . wp_kses_post($before) . "</p>",
            "comment_notes_after"  => $after === "" ? "" : '<p class="comment-notes">' . wp_kses_post($after) . "</p>",
            "class_submit"         => "btn btn-primary submit",
            "id_submit"            => "blogdetail_btn",
            "label_submit"         => esc_html__("Send Message", "djs-wallstreet-pro"),
            "submit_button"        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        ]);
    } ?>
</section>
