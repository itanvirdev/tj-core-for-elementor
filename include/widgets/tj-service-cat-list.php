<?php


/**
 * TJ Latest Services Cat List Widget
 *
 *
 * @author 		Theme_Junction
 * @category 	Widgets
 * @package 	TJCore/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */

add_action('widgets_init', 'TJ_Latest_Services_Cat_List_Widget');
function TJ_Latest_Services_Cat_List_Widget() {
	register_widget('TJ_Latest_Services_Cat_List_Widget');
}

class TJ_Latest_Services_Cat_List_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct('tj-services-cats-list', 'TJ Services Category List', array(
			'description'	=> 'TJ Services List'
		));
	}


	public function widget($args, $instance) {

		extract($args);
		echo $before_widget;
		if ($instance['title']) :
			echo $before_title; ?>
			<?php echo apply_filters('widget_title', $instance['title']); ?>
			<?php echo $after_title; ?>
		<?php endif; ?>

		<div class="services__widget-content">
			<div class="services__link">
				<ul>
					<?php
					$categories = get_terms(array(
						'taxonomy' => 'service-categories',
						'hide_empty' => true,
					));
					?>
					<?php if (!empty($categories)) : ?>
						<?php foreach ($categories as $category) : ?>
							<li>
								<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
									<?php echo esc_html($category->name); ?>
								</a>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php

					?>
				</ul>
			</div>
		</div>

		<?php echo $after_widget; ?>

	<?php
	}



	public function form($instance) {
		$title = !empty($instance['title']) ? $instance['title'] : '';
		$count = !empty($instance['count']) ? $instance['count'] : esc_html__('3', 'tjcore');
		$posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : esc_html__('DESC', 'tjcore');
	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
			<input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($count); ?>" class="widefat">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
			<select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
				<option value="" disabled="disabled">Select Post Order</option>
				<option value="ASC" <?php if ($posts_order === 'ASC') {
															echo 'selected="selected"';
														} ?>>ASC</option>
				<option value="DESC" <?php if ($posts_order === 'DESC') {
																echo 'selected="selected"';
															} ?>>DESC</option>
			</select>
		</p>

<?php }
}
