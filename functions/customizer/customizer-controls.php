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
    class WP_GoTo_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        protected string $url_part;
        protected string $button_text;

        /**
         * Render the control's content.
         */
        public function render_content() { ?>
            <a href="<?php echo esc_url(get_bloginfo("url") . '/wp-admin/' . $this->url_part); ?>" class="button" target="_blank"><?php echo $this->button_text; ?></a>
        <?php }
    }

    class WP_Color_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
    
        function render_content() {
            echo "<h3>" . __("Light & Dark Predefined Colors Setting", "wallstreet") . "</h3>";
            $name = "_customize-color-radio-" . $this->id;
            $dark = true; ?>
            <div class="dark_mode">
                <?php foreach ($this->choices as $key => $value) { ?>
                    <?php if($dark && $key[0] != "#") {
                        $dark = false; ?>
                        </div><div class="light_mode">
                    <?php } elseif ($key == "default.css") { ?>
                        </div><div class="custom_mode">
                    <?php } ?>
                    <label class="color_schema">
                        <input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr($name); ?>" data-customize-setting-link="<?php echo esc_attr($this->id); ?>" <?php if ($this->value() == $key) { echo 'checked="checked"'; } ?> />
                        <img <?php if ($this->value() == $key) { echo 'class="active"'; } ?> src="<?php echo THEME_ASSETS_PATH_URI; ?>/images/bg-pattern/<?php echo $value; ?>" alt="<?php echo esc_attr($value); ?>" />
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

    class WP_Layout_Customize_Control extends WP_Customize_Control {
        public $type = "new_menu";
        /**
         * Render the control's content.
         */
        public function render_content() {
            $current_options = get_current_options();
            $data_enable = is_array($current_options["front_page_data"]) ? $current_options["front_page_data"] : explode(",", $current_options["front_page_data"]);
            $defaultenableddata = ["service", "portfolio", "team", "blog", "testimonials", "features", "client", "partner"];
            $layout_disable = array_diff($defaultenableddata, $data_enable);
            ?>
            <h3><?php _e("Enable", "wallstreet"); ?></h3>
            <ul class="sortable customizer_layout" id="enable">
                <?php if (!empty($data_enable[0])) {
                    foreach ($data_enable as $value) { ?>
                        <li class="ui-state" id="<?php echo $value; ?>"><?php echo $value; ?></li>
                    <?php }
                } ?>
            </ul>

            <h3><?php _e("Disable", "wallstreet"); ?></h3>
            <ul class="sortable customizer_layout" id="disable">
                <?php if (!empty($layout_disable)) {
                    foreach ($layout_disable as $val) { ?>
                        <li class="ui-state" id="<?php echo $val; ?>"><?php echo $val; ?></li>
                    <?php }
                } ?>
            </ul>

            <div class="section">
                <p><b><?php _e("Slider section always top on the home page", "wallstreet"); ?></b></p>
                <p><b><?php _e("Note :", "wallstreet"); ?></b> <?php _e("By default, all the sections are enabled on the homepage. If you do not want to display any section just drag that section to the disabled box.", "wallstreet"); ?></p>
                <p></p>
            </div>

            <script>
                jQuery(document).ready(function($) {
                    $(".sortable").sortable({
                        connectWith: '.sortable'
                    });
                });

                jQuery(document).ready(function($) {
                    // Get items id you can chose
                    function enabledItems(layoutItems) {
                        var columns = [];
                        $(layoutItems + ' #enable').each(function() {
                            columns.push($(this).sortable('toArray').join(','));
                        });
                        return columns.join('|');
                    }

                    function disabledItems(layoutItems) {
                        var columns = [];
                        $(layoutItems + ' #disable').each(function() {
                            columns.push($(this).sortable('toArray').join(','));
                        });
                        return columns.join('|');
                    }

                    //onclick check id
                    $('#enable .ui-state,#disable .ui-state').mouseleave(function() {
                        var enable = enabledItems('#customize-control-wallstreet_pro_options-layout_manager');
                        var disable = disabledItems('#customize-control-wallstreet_pro_options-layout_manager');

                        $("#customize-control-wallstreet_pro_options-front_page_data input[type = 'text']").val(enable);
                        $("#customize-control-wallstreet_pro_options-layout_textbox_disable input[type = 'text']").val(disable);
                        $("#customize-control-wallstreet_pro_options-front_page_data input[type = 'text']").change();
                    });
                });
            </script>
        <?php }
    }

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

    class Wallstreet_Customize_Slug extends WP_Customize_Control {
        public function render_content() { ?>
            <h3><?php _e("After changing the slug, please do not forget to save the permalinks. Without saving, the old permalinks will not update.", "wallstreet"); ?>
        <?php }
    }
}

if (class_exists('WP_GoTo_Customize_Control')) {
    class WP_GoTo_PostType_Customize_Control extends WP_GoTo_Customize_Control {
        protected string $post_type;

        /**
         * Render the control's content.
         */
        public function render_content() { 
            $this->url_part = 'edit.php?post_type=' . $this->post_type; 
            parent::render_content();
        }
    }

    //Permalinks
    class WP_Slug_Customize_Control extends WP_GoTo_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->url_part = "options-permalink.php";
            $this->button_text = __("Click here permalinks setting", "wallstreet");
        }
    }
}

if (class_exists('WP_GoTo_PostType_Customize_Control')) {
    //Client link
    class WP_Client_Customize_Control extends WP_GoTo_PostType_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->post_type = CLIENT_POST_TYPE;
            $this->button_text = __("Click here to add client", "wallstreet");
        }
    }

    //Partner link
    class WP_Partner_Customize_Control extends WP_GoTo_PostType_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->post_type = PARTNER_POST_TYPE;
            $this->button_text = __("Click here to add partner", "wallstreet");
        }
    }

    //Project link
    class WP_Project_Customize_Control extends WP_GoTo_PostType_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->post_type = PORTFOLIO_POST_TYPE;
            $this->button_text = __("Click here to add project", "wallstreet");
        }
    }

    //Service link
    class WP_Service_Customize_Control extends WP_GoTo_PostType_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->post_type = SERVICE_POST_TYPE;
            $this->button_text = __("Click here to add service", "wallstreet");
        }
    }

    //Slider link
    class WP_Slider_Customize_Control extends WP_GoTo_PostType_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->post_type = SLIDER_POST_TYPE;
            $this->button_text = __("Click here to add slider", "wallstreet");
        }
    }

    //Testimonial link
    class WP_Testmonial_Customize_Control extends WP_GoTo_PostType_Customize_Control {
        public function __construct($manager, $id, $args = []) {
            parent::__construct($manager, $id, $args);
            $this->post_type = TESTIMONIAL_POST_TYPE;
            $this->button_text = __("Click here to add testimonial", "wallstreet");
        }
    }
}
