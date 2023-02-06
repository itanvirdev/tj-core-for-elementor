<?php

namespace TJCore;

use TJCore\PageSettings\Page_Settings;
use Elementor\Controls_Manager;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class TJ_Core_Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Add Category
	 */

	public function tj_core_elementor_category($manager) {
		$manager->add_category(
			'tjcore',
			array(
				'title' => esc_html__('TJ Addons', 'tjcore'),
				'icon' => 'eicon-banner',
			)
		);
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script('tjcore', plugins_url('/assets/js/hello-world.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		wp_enqueue_script(
			'tjcore-editor',
			plugins_url('/assets/js/editor/editor.js', __FILE__),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}


	/**
	 * tj_enqueue_editor_scripts
	 */
	function tj_enqueue_editor_scripts() {
		wp_enqueue_style('tj-element-addons-editor', TJCORE_ADDONS_URL . 'assets/css/editor.css', null, '1.0');
	}


	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle) {
		if ('tjcore-editor' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets($widgets_manager) {
		// Its is now safe to include Widgets files
		foreach ($this->tjcore_widget_list() as $widget_file_name) {
			require_once(TJCORE_ELEMENTS_PATH . "/{$widget_file_name}.php");
		}

		// Charitable_Campaign
		if (function_exists('tutor')) {
			foreach ($this->tjcore_widget_list_tutor() as $widget_file_name) {
				require_once(TJCORE_ELEMENTS_PATH . "/{$widget_file_name}.php");
			}
		}
	}

	public function tjcore_widget_list() {
		return [
			'heading',
		];
	}

	// tjcore_widget_list_campaign
	public function tjcore_widget_list_tutor() {
		return [
			// 'tutor-course',
		];
	}

	/**
	 * Register controls
	 *
	 * @param Controls_Manager $controls_Manager
	 */

	// public function register_controls(Controls_Manager $controls_Manager) {
	// 	include_once(TJCORE_ADDONS_DIR . '/controls/tpgradient.php');
	// 	$tpgradient = 'TJCore\Elementor\Controls\Group_Control_TPGradient';
	// 	$controls_Manager->add_group_control($tpgradient::get_type(), new $tpgradient());

	// 	include_once(TJCORE_ADDONS_DIR . '/controls/tpbggradient.php');
	// 	$tpbggradient = 'TJCore\Elementor\Controls\Group_Control_TPBGGradient';
	// 	$controls_Manager->add_group_control($tpbggradient::get_type(), new $tpbggradient());
	// }




	public function tj_add_custom_icons_tab($tabs = array()) {

		// font awesome light
		$tabs['fontawesome-light'] = array(
			'name'          => 'fontawesome-light',
			'label'         => esc_html__('TJ Font Awesome - Light', 'tjcore'),
			'labelIcon'     => 'fab fa-font-awesome-alt',
			'prefix'        => 'fa-',
			'displayPrefix' => 'fal',
			'url'           => TJCORE_ADDONS_URL . './include/icons/font-awesome/css/fontawesome-all.min.css',
			'fetchJson'     => TJCORE_ADDONS_URL . './include/icons/font-awesome/fonts/font-awesome.json',
			'ver'           => '1.0.0',
		);

		// Elementor Icons
		$tabs['elementor'] = array(
			'name'          => 'elementor',
			'label'         => esc_html__('TJ Elementor', 'tjcore'),
			'labelIcon'     => 'eicon-elementor-circle',
			'prefix'        => 'eicon-',
			'displayPrefix' => 'eicon',
			'url'           => TJCORE_ADDONS_URL . './include/icons/elementor/css/elementor-icons.min.css',
			'fetchJson'     => TJCORE_ADDONS_URL . './include/icons/elementor/fonts/elementor.json',
			'ver'           => '1.0.0',
		);

		// feather
		$tabs['feather'] = array(
			'name'          => 'feather',
			'label'         => esc_html__('TJ Feather', 'tjcore'),
			'labelIcon'     => 'feather feather-feather',
			'prefix'        => 'feather-',
			'displayPrefix' => 'feather',
			'url'           => TJCORE_ADDONS_URL . './include/icons/feather/feather.min.css',
			'fetchJson'     => TJCORE_ADDONS_URL . './include/icons/feather/fonts/feather.json',
			'ver'           => '1.0.0',
		);

		// material design icons
		$tabs['material-design'] = array(
			'name'          => 'material-design',
			'label'         => esc_html__('TJ Material Design Icons', 'tjcore'),
			'labelIcon'     => 'fab fa-google',
			'prefix'        => 'md-',
			'displayPrefix' => 'material-icons',
			'url'           => TJCORE_ADDONS_URL . './include/icons/material-icons/css/material-icons.min.css',
			'fetchJson'     => TJCORE_ADDONS_URL . './include/icons/material-icons/fonts/material-icons.json',
			'ver'           => '1.0.0',
		);

		// $feather_icons_path = include(TJCORE_INCLUDE_PATH . '/icons/feather-fonts.php');
		return $tabs;
	}


	// campaign_template_fun
	// public function campaign_template_fun($campaign_template) {

	// 	if ((get_post_type() == 'campaign') && is_single()) {
	// 		$campaign_template_file_path = __DIR__ . '/include/template/single-campaign.php';
	// 		$campaign_template           = $campaign_template_file_path;
	// 	}
	// 	if ((get_post_type() == 'tribe_events') && is_single()) {
	// 		$campaign_template_file_path = __DIR__ . '/include/template/single-event.php';
	// 		$campaign_template           = $campaign_template_file_path;
	// 	}

	// 	if (!$campaign_template) {
	// 		return $campaign_template;
	// 	}
	// 	return $campaign_template;
	// }

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/register', [$this, 'register_widgets']);

		// Register editor scripts
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		// Register custom category
		add_action('elementor/elements/categories_registered', [$this, 'tj_core_elementor_category']);

		// Register custom controls
		// add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

		// Register custom icons
		add_filter('elementor/icons_manager/additional_tabs', [$this, 'tj_add_custom_icons_tab']);

		// $this->tj_add_custom_icons_tab();

		add_action('elementor/editor/after_enqueue_scripts', [$this, 'tj_enqueue_editor_scripts']);

		// add_filter('template_include', [$this, 'campaign_template_fun'], 99);

	}
}

// Instantiate Plugin Class
TJ_Core_Plugin::instance();
