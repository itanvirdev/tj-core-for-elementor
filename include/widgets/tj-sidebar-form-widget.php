<?php

/**
 * TJ Sidebar Form Widget
 *
 *
 * @author 		Theme_Junction
 * @category 	Widgets
 * @package 	TJCore/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */


add_action('widgets_init', 'TJ_Sidebar_Form_Widget');
function TJ_Sidebar_Form_Widget() {
	register_widget('TJ_Sidebar_Form_Widget');
}

class TJ_Sidebar_Form_Widget  extends WP_Widget {

	public function __construct() {
		parent::__construct('TJ_Sidebar_Form_Widget', esc_html__('TJ Sidebar Form', 'tjcore'), array(
			'description' => esc_html__('TJ Sidebar Form Widget', 'tjcore'),
		));
	}

	public function widget($args, $instance) {
		extract($args);
		extract($instance);
		print $before_widget;

		if (!empty($title)) {
			print $before_title . apply_filters('widget_title', $title) . $after_title;
		}
?>

		<?php if (!empty($tj_form_shortcode)) : ?>
			<div class="sidebar_form_widget">
				<div class="tj_sidebar_form sidebar__contact">
					<?php print do_shortcode($tj_form_shortcode); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php print $after_widget; ?>

	<?php
	}


	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	public function form($instance) {
		$title  = isset($instance['title']) ? $instance['title'] : '';
		$tj_form_shortcode  = isset($instance['tj_form_shortcode']) ? $instance['tj_form_shortcode'] : '';
	?>
		<p>
			<label for="title"><?php esc_html_e('Title:', 'tjcore'); ?></label>
		</p>
		<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

		<p>
			<label for="title"><?php esc_html_e('Form Shortcode:', 'tjcore'); ?></label>
		</p>
		<input type="text" id="<?php print esc_attr($this->get_field_id('tj_form_shortcode')); ?>" class="widefat" name="<?php print esc_attr($this->get_field_name('tj_form_shortcode')); ?>" value="<?php print esc_attr($tj_form_shortcode); ?>">

<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['subscribe_style'] = (!empty($new_instance['subscribe_style'])) ? strip_tags($new_instance['subscribe_style']) : '';
		$instance['tj_form_shortcode'] = (!empty($new_instance['tj_form_shortcode'])) ? strip_tags($new_instance['tj_form_shortcode']) : '';
		return $instance;
	}
}
