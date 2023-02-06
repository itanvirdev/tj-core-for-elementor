<?php

namespace TJCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * TJ Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TP_Big_Text extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'big-text';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Big Text', 'tjcore');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'tj-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['tjcore'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['tjcore'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {

        // layout Panel
        $this->start_controls_section(
            'tp_layout',
            [
                'label' => esc_html__('Design Layout', 'tjcore'),
            ]
        );
        $this->add_control(
            'tp_design_style',
            [
                'label' => esc_html__('Select Layout', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'tjcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // tp_section_title
        $this->start_controls_section(
            'tp_section_title',
            [
                'label' => esc_html__('Title & Content', 'tjcore'),
            ]
        );

        $this->add_control(
            'tp_number',
            [
                'label' => esc_html__('Number', 'tjcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('250', 'tjcore'),
                'placeholder' => esc_html__('Type Number', 'tjcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_after_number',
            [
                'label' => esc_html__('After number', 'tjcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('mln', 'tjcore'),
                'placeholder' => esc_html__('Type Text', 'tjcore'),
            ]
        );

        $this->add_control(
            'tp_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TJ Title Here', 'tjcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tjcore'),
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // tp_btn_button_group
        $this->start_controls_section(
            'tp_btn_button_group',
            [
                'label' => esc_html__('Button', 'tjcore'),
            ]
        );

        $this->add_control(
            'tp_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => true,
            ]
        );

        $this->add_control(
            'tp_btn_text',
            [
                'label' => esc_html__('Button Text', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tjcore'),
                'title' => esc_html__('Enter button text', 'tjcore'),
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tp_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tp_btn_link',
            [
                'label' => esc_html__('Button link', 'tjcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tjcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tp_btn_link_type' => '1',
                    'tp_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tp_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tjcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tp_get_all_pages(),
                'condition' => [
                    'tp_btn_link_type' => '2',
                    'tp_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        // Link
        if ('2' == $settings['tp_btn_link_type']) {
            $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
            $this->add_render_attribute('tj-button-arg', 'target', '_self');
            $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--black it-btn');
        } else {
            if (!empty($settings['tp_btn_link']['url'])) {
                $this->add_link_attributes('tj-button-arg', $settings['tp_btn_link']);
                $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--black it-btn');
            }
        }

?>

        <?php if ($settings['tp_design_style']  == 'layout-2') : ?>
            <section class="hero hero--style2">

            </section>


        <?php else :
            if (!empty($settings['tp_image']['url'])) {
                $tp_image = !empty($settings['tp_image']['id']) ? wp_get_attachment_image_url($settings['tp_image']['id'], $settings['tp_image_size_size']) : $settings['tp_image']['url'];
                $tp_image_alt           = get_post_meta($settings["tp_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hero__title hero__title--big wow animate__fadeInUp');
            $this->add_render_attribute('title_args', 'data-wow-duration', '1200ms');
            $this->add_render_attribute('title_args', 'data-wow-delay', '300ms');

        ?>

            <div class="donnerArea">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="donnerAreaContent text-center mb-30">
                                <?php if (!empty($settings['tp_number'])) : ?>
                                    <h2 class="donnerAreaContent__bigTitle">
                                        <span class="donnerAreaContent__bigTitle__number"><?php echo tp_kses($settings['tp_number']); ?></span>
                                        <span class="donnerAreaContent__bigTitle__text"><?php echo tp_kses($settings['tp_after_number']); ?></span>
                                    </h2>
                                <?php endif; ?>

                                <?php if (!empty($settings['tp_title'])) : ?>
                                    <h3 class="donnerAreaContent__heading text-uppercase"><?php echo tp_kses($settings['tp_title']); ?></h3>
                                <?php endif; ?>

                                <?php if (!empty($settings['tp_btn_text'])) : ?>
                                    <div class="tj-hero-btn">
                                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                            <span class="btn__text"><?php echo $settings['tp_btn_text']; ?></span> <i class="fa-solid fa-heart btn__icon"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

<?php

    }
}

$widgets_manager->register(new TP_Big_Text());
