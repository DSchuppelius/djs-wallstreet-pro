<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : 404.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
get_template_parts(["template-parts/index/index", "banner"], true); ?>
<div class="container error">
	<div class="row">	
		<div class="col-md-12">
			<div class="error_404">
				<h2><?php _e("Error 404", "wallstreet"); ?></h2>
				<h4><?php _e("Oops! Page not found", "wallstreet"); ?></h4>
				<p><?php _e("We are sorry, but the page you are looking for does not exist.", "wallstreet"); ?></p>
				<p><a class="button btn back" href="<?php echo esc_html(site_url()); ?>" id="blogdetail_btn"><?php _e("Go back", "wallstreet"); ?></a></p>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
