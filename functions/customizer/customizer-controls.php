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
    if (!class_exists("WP_Color_Customize_Control")) {
        class WP_Color_Customize_Control extends WP_Customize_Control {
            public $type = "new_menu";

            function render_content() {
                echo "<h3>" . esc_html__("Light & Dark Predefined Colors Setting", "djs-wallstreet-pro") . "</h3>";
                $name = "_customize-color-radio-" . $this->id;
                $dark = true; ?>
<div class="dark_mode">
    <?php foreach ($this->choices as $key => $value) { ?>
    <?php if($dark && $key[0] != "#") {
                            $dark = false; ?>
</div>
<div class="light_mode">
    <?php } elseif ($key == "default.css") { ?>
</div>
<div class="custom_mode">
    <?php } ?>
    <label class="color_schema">
        <input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr($name); ?>"
            data-customize-setting-link="<?php echo esc_attr($this->id); ?>"
            <?php if ($this->value() == $key) { echo 'checked="checked"'; } ?> />
        <img <?php if ($this->value() == $key) { echo 'class="active"'; } ?>
            src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/bg-pattern/<?php echo $value; ?>"
            alt="<?php echo esc_attr($value); ?>" />
    </label>
    <?php } ?>
</div>
<script>
jQuery(document).ready(function($) {
    $("#customize-control-wallstreet_pro_options-stylesheet label img").click(function() {
        $("#customize-control-wallstreet_pro_options-stylesheet label img").removeClass("active");
        $(this).addClass("active");
    });
});
</script>
<?php
            }
        }
    }

    if (!class_exists("Wallstreet_Range_Slider_Control")) {
        class Wallstreet_Range_Slider_Control extends WP_Customize_Control {
            protected function get_wallstreet_resource_url() {
                if (strpos(wp_normalize_path(__DIR__), wp_normalize_path(WP_PLUGIN_DIR)) === 0) {
                    // We're in a plugin directory and need to determine the url accordingly.
                    return plugin_dir_url(__DIR__);
                }

                return trailingslashit(get_template_directory_uri());
            }
        }
    }

    if (!class_exists("Wallsteet_Slider_Custom_Control")) {
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
    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span><input type="number"
        id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>"
        value="<?php echo esc_attr($this->value()); ?>" class="customize-control-slider-value"
        <?php $this->link(); ?> />
    <div class="slider" slider-min-value="<?php echo esc_attr($this->input_attrs["min"]); ?>"
        slider-max-value="<?php echo esc_attr($this->input_attrs["max"]); ?>"
        slider-step-value="<?php echo esc_attr($this->input_attrs["step"]); ?>"></div><span
        class="slider-reset dashicons dashicons-image-rotate"
        slider-reset-value="<?php echo esc_attr($this->value()); ?>"></span>
</div>
<?php
            }
        }
    }
}