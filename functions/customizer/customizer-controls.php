<?php
/*
 * Created on   : Wed Jun 22 2022
 * Author       : Daniel Jörg Schuppelius
 * Author Uri   : https://schuppelius.org
 * Filename     : customizer-controls.php
 * License      : GNU General Public License v3 or later
 * License Uri  : http://www.gnu.org/licenses/gpl.html
 */
if (class_exists("WP_Customize_Control")) {
    class Wallstreet_Range_Slider_Control extends WP_Customize_Control {
        protected function get_busiprof_resource_url() {
            if (strpos(wp_normalize_path(__DIR__), wp_normalize_path(WP_PLUGIN_DIR)) === 0) {
                // We're in a plugin directory and need to determine the url accordingly.
                return plugin_dir_url(__DIR__);
            }

            return trailingslashit(get_template_directory_uri());
        }
    }

    class Wallsteet_Slider_Custom_Control extends Wallstreet_Range_Slider_Control {
        /**
         * The type of control being rendered
         */
        public $type = "slider_control";
        /**
         * Enqueue our scripts and styles
         */
        public function enqueue() {
            wp_enqueue_script("wallstreet-custom-controls-js", THEME_ASSETS_PATH_URI . "/customizer/slider/js/customizer.js", ["jquery", "jquery-ui-core"], "1.0", true);
            wp_enqueue_style("wallstreet-custom-controls-css", THEME_ASSETS_PATH_URI . "/customizer/slider/css/customizer.css", [], "1.0", "all");
        }
        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span><input type="number" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($this->value()); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr($this->input_attrs["min"]); ?>" slider-max-value="<?php echo esc_attr($this->input_attrs["max"]); ?>" slider-step-value="<?php echo esc_attr($this->input_attrs["step"]); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr($this->value()); ?>"></span>
			</div>
		<?php
        }
    }
}