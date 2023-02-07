<?php

namespace TJCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * TJ Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TJ_Live_Donation extends Widget_Base {

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
        return 'live-donation';
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
        return __('Live Donation', 'tjcore');
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
            'tj_layout',
            [
                'label' => esc_html__('Design Layout', 'tjcore'),
            ]
        );
        $this->add_control(
            'tj_design_style',
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

        // tj_section_title
        $this->start_controls_section(
            'tj_section_title',
            [
                'label' => esc_html__('Title & Content', 'tjcore'),
            ]
        );

        $this->add_control(
            'tj_donate_percentage',
            [
                'label' => esc_html__('Percentage', 'tjcore'),
                'description' => tj_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('80', 'tjcore'),
                'placeholder' => esc_html__('Type Percentage Number', 'tjcore'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tj_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TJ Title Here', 'tjcore'),
                'placeholder' => esc_html__('Type Heading Text', 'tjcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tj_donate_number',
            [
                'label' => esc_html__('Donation Number', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('28,0000', 'tjcore'),
                'placeholder' => esc_html__('Type donation number here', 'tjcore'),
            ]
        );

        $this->add_control(
            'tj_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'tjcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'tjcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'tjcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'tjcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'tjcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'tjcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'tjcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'tj_align',
            [
                'label' => esc_html__('Alignment', 'tjcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__('Left', 'tjcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'text-center' => [
                        'title' => esc_html__('Center', 'tjcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'text-right' => [
                        'title' => esc_html__('Right', 'tjcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'tjcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => __('Text Transform', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'tjcore'),
                    'uppercase' => __('UPPERCASE', 'tjcore'),
                    'lowercase' => __('lowercase', 'tjcore'),
                    'capitalize' => __('Capitalize', 'tjcore'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
                ],
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

?>

        <?php if ($settings['tj_design_style']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>
            <?php if (!empty($settings['tj_section_title_show'])) : ?>
                <div class="contact__info">
                    <div class="contact__info__icon">
                        <?php if ($settings['tj_icon_type'] !== 'image') : ?>
                            <?php if (!empty($settings['tj_icon']) || !empty($settings['tj_selected_icon']['value'])) : ?>
                                <div class="tj-icon">
                                    <?php tj_render_icon($settings, 'tj_icon', 'tj_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="icon">
                                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'tj_icon_image'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="contact__info__content">
                        <?php if (!empty($settings['tj_donate_percentage'])) : ?>
                            <span class="sub-title tj-el-subtitle"><?php echo tj_kses($settings['tj_donate_percentage']); ?></span>
                        <?php endif; ?>

                        <?php
                        if (!empty($settings['tj_title'])) :
                            printf(
                                '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape($settings['tj_title_tag']),
                                $this->get_render_attribute_string('title_args'),
                                tj_kses($settings['tj_title'])
                            );
                        endif;
                        ?>

                        <?php if (!empty($settings['tj_donate_number'])) : ?>
                            <span><?php echo tj_kses($settings['tj_donate_number']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>


        <?php else :
            $this->add_render_attribute('title_args', 'class', 'sponsorsTitle__heading text-uppercase');
        ?>

            <div class="featureTab__content p-0">
                <div class="sponsorsTitle sponsorsTitle--style2">
                    <span class="sponsorsTitle__line"></span>
                    <?php
                    if (!empty($settings['tj_title'])) :
                        printf(
                            '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape($settings['tj_title_tag']),
                            $this->get_render_attribute_string('title_args'),
                            tj_kses($settings['tj_title'])
                        );
                    endif;
                    ?>
                    <span class="sponsorsTitle__line"></span>
                </div>

                <?php if (!empty($settings['tj_donate_number'])) : ?>
                    <h3 class="featureTab__content__counter"><?php echo tj_kses($settings['tj_donate_number']); ?></h3>
                <?php endif; ?>
                <?php if (!empty($settings['tj_donate_percentage'])) : ?>
                    <div class="featureBlock__donation__progress">
                        <div class="featureBlock__donation__bar">
                            <span class="featureBlock__donation__text skill-bar skill-bar--text" data-width="<?php echo tj_kses($settings['tj_donate_percentage']); ?>%"><span><?php echo tj_kses($settings['tj_donate_percentage']); ?>%</span></span>
                            <div class="featureBlock__donation__line">
                                <span class="skill-bars">
                                    <span class="skill-bars__line skill-bar" data-width="<?php echo tj_kses($settings['tj_donate_percentage']); ?>%"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TJ_Live_Donation());
