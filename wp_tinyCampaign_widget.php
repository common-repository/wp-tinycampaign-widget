<?php
/*
  Plugin Name: WP tinyCampaign Widget
  Plugin URI: https://www.joshparker.name/
  Description: WordPress site administrators can integrate their tinyCampaign installation and their WordPress site with this sidebar widget.
  Author: Joshua Parker
  Version: 1.0.1
  Author URI: https://www.joshparker.name/
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * tinyc_widget
 *
 * Register the widget
 *
 * @return void
 */
function tinyc_widget()
{
    register_widget('tinyc_widget');
}
add_action('widgets_init', 'tinyc_widget');

class tinyc_widget extends WP_Widget
{

    /**
     * tinyc_widget
     *
     * @return void
     */
    function __construct()
    {
        $widget_ops = array('classname' => 'tinyc-widget', 'description' => __('A simple sign-up widget that integrates with tinyCampaign', 'wp-tinycampaign-widget'));
        parent::__construct('tinyc-widget', __('WP tinyCampaign Widget', 'wp-tinycampaign-widget'), $widget_ops);
    }

    /**
     * widget
     *
     * Output the widget
     *
     * @return void
     */
    function widget($args, $instance)
    {

        extract($args, EXTR_SKIP);
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $descr = empty($instance['descr']) ? '' : esc_attr($instance['descr']);
        $base_url = esc_url($instance['base_url']);
        $list_code = empty($instance['list_code']) ? '' : esc_attr($instance['list_code']);
        $placeholder = empty($instance['placeholder']) ? '' : esc_attr($instance['placeholder']);
        $label = empty($instance['label']) ? '' : esc_attr($instance['label']);
        $button_txt = empty($instance['button_txt']) ? '' : esc_attr($instance['button_txt']);
        $ajax_form = empty($instance['ajax_form']) ? 'false' : 'true';

        echo $before_widget;
        if (!empty($title)) {
            echo '<h2>' . $before_title . $title . $after_title . '</h2>' . PHP_EOL;
            echo '<p>' . $descr . '</p>' . PHP_EOL;
        }

        if ($ajax_form == 'true') :

            ?>
            <script type="text/css" src="<?php echo untrailingslashit($base_url); ?>/static/assets/css/tinyc/style.css"></script>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
            <script type="text/javascript" src="<?php echo untrailingslashit($base_url); ?>/static/assets/js/tinyc/magic.js"></script>
            <div id="newsletterform">
                <div class="wrap">
                    <form id="newsletter" name="newsletter" method="post" action="<?php echo untrailingslashit($base_url); ?>/asubscribe/">
                        <label for="email"><?php echo $label; ?></label>
                        <input type="email" id="signup-email" name="email" placeholder="<?php echo $placeholder; ?>" /><br />
                        <input type="hidden" name="m6qIHt4Z5evV" />
                        <input type="hidden" name="YgexGyklrgi1" />
                        <input type="hidden" name="code" value="<?php echo $list_code; ?>" />
                        <input type="submit" name="signup-button" id="signup-button" value="<?php echo $button_txt; ?>">
                        <span class="arrow"></span>
                    </form>
                    <div id="response"></div>
                </div>
            </div>

            <?php
            
        else :

            ?>
            <script type="text/css" src="<?php echo untrailingslashit($base_url); ?>/static/assets/css/tinyc/style.css"></script>
            <div id="newsletterform">
                <div class="wrap">
                    <form id="newsletter" name="newsletter" method="post" action="<?php echo untrailingslashit($base_url); ?>/subscribe/">
                        <label for="email"><?php echo $label; ?></label>
                        <input type="email" id="signup-email" name="email" placeholder="<?php echo $placeholder; ?>" /><br />
                        <input type="hidden" name="m6qIHt4Z5evV" />
                        <input type="hidden" name="YgexGyklrgi1" />
                        <input type="hidden" name="code" value="<?php echo $list_code; ?>" />
                        <input type="submit" name="signup-button" id="signup-button" value="<?php echo $button_txt; ?>">
                        <span class="arrow"></span>
                    </form>
                    <div id="response"></div>
                </div>
            </div>

        <?php
        endif;
        echo $after_widget;
    }

    /**
     * form
     *
     * Edit widget form
     *
     * @return void
     */
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array('title' => __('tinyCampaign Widget', 'wp-tinycampaign-widget'), 'descr' => __('', 'wp-tinycampaign-widget'), 'base_url' => __('', 'wp-tinycampaign-widget'), 'placeholder' => __('', 'wp-tinycampaign-widget'), 'label' => __('', 'wp-tinycampaign-widget'), 'button_txt' => __('', 'wp-tinycampaign-widget')));
        $title = esc_attr($instance['title']);
        $descr = esc_attr($instance['descr']);
        $base_url = esc_url('base_url');
        $list_code = esc_attr($instance['list_code']);
        $placeholder = esc_attr($instance['placeholder']);
        $label = esc_attr($instance['label']);
        $button_txt = esc_attr($instance['button_txt']);
        $ajax_form = esc_attr($instance['ajax_form']);

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('descr'); ?>"><?php _e('Text before form', 'wp-tinycampaign-widget'); ?>:</label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('descr'); ?>" name="<?php echo $this->get_field_name('descr'); ?>"><?php echo $instance['descr']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('base_url'); ?>"><?php _e('Base URL of tinyCampaign Install', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('base_url'); ?>" name="<?php echo $this->get_field_name('base_url'); ?>" type="text" value="<?php echo $instance['base_url']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('list_code'); ?>"><?php _e('Unique List Code', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('list_code'); ?>" name="<?php echo $this->get_field_name('list_code'); ?>" type="text" value="<?php echo $instance['list_code']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('placeholder'); ?>"><?php _e('Placeholder text (inside input box)', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('placeholder'); ?>" name="<?php echo $this->get_field_name('placeholder'); ?>" type="text" value="<?php echo $instance['placeholder']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('label'); ?>"><?php _e('Label text (above input box)', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('label'); ?>" name="<?php echo $this->get_field_name('label'); ?>" type="text" value="<?php echo $instance['label']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_txt'); ?>"><?php _e('Button text (e.g, "Subscribe")', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_txt'); ?>" name="<?php echo $this->get_field_name('button_txt'); ?>" type="text" value="<?php echo $instance['button_txt']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('ajax_form'); ?>"><?php _e('Use Ajax?', 'wp-tinycampaign-widget'); ?>:</label>
            <input class="checkbox" type="checkbox" <?php checked($instance['ajax_form'], 'on'); ?> id="<?php echo $this->get_field_id('ajax_form'); ?>" name="<?php echo $this->get_field_name('ajax_form'); ?>" /> 
        </p>
        <?php
    }

    /**
     * update
     *
     * Save the new widget instance
     *
     * @return array
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['descr'] = strip_tags($new_instance['descr']);
        $instance['base_url'] = esc_url($new_instance['base_url']);
        $instance['list_code'] = strip_tags($new_instance['list_code']);
        $instance['placeholder'] = strip_tags($new_instance['placeholder']);
        $instance['label'] = strip_tags($new_instance['label']);
        $instance['button_txt'] = strip_tags($new_instance['button_txt']);
        $instance['ajax_form'] = strip_tags($new_instance['ajax_form']);
        return $instance;
    }
}

// i18n
$plugin_dir = basename(dirname(__FILE__)) . '/languages';
load_plugin_textdomain('wp-tinycampaign-widget', WP_PLUGIN_DIR . '/' . $plugin_dir, $plugin_dir);
