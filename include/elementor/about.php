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
class TJ_About extends Widget_Base {

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
        return 'about';
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
        return __('About', 'tjcore');
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
                    'layout-2' => esc_html__('Layout 2', 'tjcore'),
                    'layout-3' => esc_html__('Layout 3', 'tjcore'),
                    'layout-4' => esc_html__('Layout 4', 'tjcore'),
                    'layout-5' => esc_html__('Layout 5', 'tjcore'),
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
            'tj_section_title_show',
            [
                'label' => esc_html__('Section Title & Content', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tj_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tjcore'),
                'description' => tj_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TJ Sub Title', 'tjcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tjcore'),
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
            'tj_desctiption',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TJ section description here', 'tjcore'),
                'placeholder' => esc_html__('Type section description here', 'tjcore'),
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

        // Features group
        $this->start_controls_section(
            'tj_features',
            [
                'label' => esc_html__('Features List', 'tjcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tjcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_condition',
            [
                'label' => __('Field condition', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'tjcore'),
                    'style_2' => __('Style 2', 'tjcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        $repeater->add_control(
            'tj_features_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tjcore'),
                    'icon' => esc_html__('Icon', 'tjcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tj_features_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tjcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tj_features_icon_type' => 'image'
                ]

            ]
        );

        if (tj_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tj_features_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa-solid fa-check',
                    'condition' => [
                        'tj_features_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tj_features_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tj_features_icon_type' => 'icon'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'tj_features_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tj_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tjcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tj_features_list',
            [
                'label' => esc_html__('Services - List', 'tjcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tj_features_title' => esc_html__('Discover', 'tjcore'),
                    ],
                    [
                        'tj_features_title' => esc_html__('Define', 'tjcore')
                    ],
                    [
                        'tj_features_title' => esc_html__('Develop', 'tjcore')
                    ]
                ],
                'title_field' => '{{{ tj_features_title }}}',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            '_tj_icon',
            [
                'label' => esc_html__('Icon', 'tjcore'),
                'condition' => [
                    'tj_design_style' => 'layout-5'
                ],
            ]
        );
        $this->add_control(
            'tj_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'image' => esc_html__('Image', 'tjcore'),
                    'icon' => esc_html__('Icon', 'tjcore'),
                ],
            ]
        );

        $this->add_control(
            'tj_icon_image',
            [
                'label' => esc_html__('Upload Image', 'tjcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tj_icon_type' => 'image'
                ]

            ]
        );
        if (tj_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tj_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tj_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tj_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tj_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $this->end_controls_section();

        // tj_btn_button_group
        $this->start_controls_section(
            'tj_btn_button_group',
            [
                'label' => esc_html__('Button', 'tjcore'),
            ]
        );

        $this->add_control(
            'tj_btn_button_show',
            [
                'label' => esc_html__('Show Button', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tj_btn_text',
            [
                'label' => esc_html__('Button Text', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tjcore'),
                'title' => esc_html__('Enter button text', 'tjcore'),
                'label_block' => true,
                'condition' => [
                    'tj_btn_button_show' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'tj_btn_link_type',
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
                    'tj_btn_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tj_btn_link',
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
                    'tj_btn_link_type' => '1',
                    'tj_btn_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tj_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'tjcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tj_get_all_pages(),
                'condition' => [
                    'tj_btn_link_type' => '2',
                    'tj_btn_button_show' => 'yes'
                ]
            ]
        );
        $this->end_controls_section();

        // _tj_image
        $this->start_controls_section(
            '_tj_image',
            [
                'label' => esc_html__('Thumbnail', 'tjcore'),
            ]
        );
        $this->add_control(
            'tj_image',
            [
                'label' => esc_html__('Choose Image', 'tjcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tj_image_2',
            [
                'label' => esc_html__('Choose Image 2', 'tjcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_control(
            'tj_image_3',
            [
                'label' => esc_html__('Choose Image 3', 'tjcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tj_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'tj_image_overlap',
            [
                'label' => esc_html__('Image overlap to top?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'tj_image_height',
            [
                'label' => esc_html__('Image Height', 'tjcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tj-overlap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tj_image_overlap_x',
            [
                'label' => esc_html__('Image overlap position', 'tjcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tj-overlap img' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => array(
                    'tj_image_overlap' => 'yes',
                ),
            ]
        );
        $this->end_controls_section();


        // _section_exp_info
        $this->start_controls_section(
            '_section_exp_info',
            [
                'label' => __('Experience Info', 'tjcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tj_design_style' => ['layout-2', 'layout-5'],
                ],
            ]
        );

        $this->add_control(
            'exp_num',
            [
                'label' => __('Number', 'tjcore'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('1998', 'tjcore'),
                'placeholder' => __('Type number Here', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'exp_title',
            [
                'label' => __('Title', 'tjcore'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __('..Since..', 'tjcore'),
                'placeholder' => __('Type your text', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
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
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');

            // Link
            if ('2' == $settings['tj_btn_link_type']) {
                $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
                $this->add_render_attribute('tj-button-arg', 'target', '_self');
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tj-button-arg', 'class', ' btn btn--styleOne btn--secondary it-btn');
            } else {
                if (!empty($settings['tj_btn_link']['url'])) {
                    $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                    $this->add_render_attribute('tj-button-arg', 'class', ' btn btn--styleOne btn--secondary it-btn');
                }
            }

        ?>

            <section class="about">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-lg-6 mb-30">
                            <div class="aboutContent aboutContent--style2">
                                <!-- Section Heading/Title -->
                                <div class="sectionTitle mb-20">
                                    <?php if (!empty($settings['tj_sub_title'])) : ?>
                                        <span class="sectionTitle__small">
                                            <i class="fa-solid fa-heart btn__icon"></i><?php echo tj_kses($settings['tj_sub_title']); ?>
                                        </span>
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
                                </div>
                                <!-- Section Heading/Title End -->
                                <?php if (!empty($settings['tj_desctiption'])) : ?>
                                    <p class="aboutContent__text"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($settings['tj_short_desctiption'])) : ?>
                                    <span class="aboutContent__quote"><?php echo tj_kses($settings['tj_short_desctiption']); ?></span>
                                <?php endif; ?>

                                <?php if (!empty($settings['tj_btn_text'])) : ?>
                                    <div class="tj-hero-btn">
                                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                            <span class="btn__text"><?php echo $settings['tj_btn_text']; ?></span>
                                            <i class="fa-solid fa-heart btn__icon"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                            <div class="col-lg-5">
                                <div class="aboutThumb">
                                    <div class="aboutThumb__text">
                                        <?php if (!empty($settings['exp_title'])) : ?>
                                            <span class="aboutThumb__text__title"><?php echo tj_kses($settings['exp_title']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($settings['exp_num'])) : ?>
                                            <span class="aboutThumb__text__year"><?php echo tj_kses($settings['exp_num']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <figure class="aboutThumb__figure m-0">
                                        <img src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                                    </figure>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tj_design_style']  == 'layout-3') :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            // Link
            if ('2' == $settings['tj_btn_link_type']) {
                $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
                $this->add_render_attribute('tj-button-arg', 'target', '_self');
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
            } else {
                if (!empty($settings['tj_btn_link']['url'])) {
                    $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                    $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
                }
            }
        ?>

            <section class="fact fact--layout1 position-relative">
                <div class="container">
                    <div class="volunteer">
                        <div class="container">
                            <div class="row align-items-center">
                                <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                                    <div class="col-lg-6 mb-30">
                                        <div class="volunteerUser">
                                            <div class="volunteerUser__box">
                                                <div class="volunteerUser__thumb">
                                                    <img class="hero__figure__thumbs" src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                                                </div>
                                                <div class="volunteerUser__profile">
                                                    <ul>
                                                        <li>
                                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user1.jpg" alt="Gainioz"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user2.jpg" alt="Gainioz"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user3.jpg" alt="Gainioz"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user4.jpg" alt="Gainioz"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user5.jpg" alt="Gainioz"></a>
                                                        </li>
                                                        <li>
                                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/image/users/volunteer-user6.jpg" alt="Gainioz"></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-6 mb-30">
                                    <div class="aboutContent aboutContent--style3">
                                        <?php if (!empty($settings['tj_section_title_show'])) : ?>
                                            <!-- Section Heading/Title -->
                                            <div class="sectionTitle mb-20">
                                                <?php if (!empty($settings['tj_sub_title'])) : ?>
                                                    <span class="sectionTitle__small">
                                                        <i class="fa-solid fa-heart btn__icon"></i><?php echo tj_kses($settings['tj_sub_title']); ?>
                                                    </span>
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
                                            </div>
                                            <!-- Section Heading/Title End -->
                                            <?php if (!empty($settings['tj_short_desctiption'])) : ?>
                                                <span class="aboutContent__quote text-uppercase"><?php echo tj_kses($settings['tj_short_desctiption']); ?></span>
                                            <?php endif; ?>
                                            <?php if (!empty($settings['tj_desctiption'])) : ?>
                                                <p class="aboutContent__text"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if (!empty($settings['tj_btn_text'])) : ?>
                                            <div class="aboutContent__buttons">
                                                <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                                    <span class="btn__text"><?php echo $settings['tj_btn_text']; ?></span>
                                                    <i class="fa-solid fa-heart btn__icon"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tj_design_style']  == 'layout-4') :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            // Link
            if ('2' == $settings['tj_btn_link_type']) {
                $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
                $this->add_render_attribute('tj-button-arg', 'target', '_self');
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--secondary it-btn');
            } else {
                if (!empty($settings['tj_btn_link']['url'])) {
                    $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                    $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--secondary it-btn');
                }
            }
        ?>

            <section class="joinSection position-relative overflow-hidden">
                <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                    <div class="joinSectionThumb d-none d-lg-block">
                        <img src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-lg-6">
                            <div class="joinContent">
                                <?php if (!empty($settings['tj_section_title_show'])) : ?>
                                    <div class="row justify-content-end">
                                        <div class="col-10">
                                            <!-- Section Heading/Title -->
                                            <div class="sectionTitle mb-20">
                                                <?php if (!empty($settings['tj_sub_title'])) : ?>
                                                    <span class="sectionTitle__small justify-content-end">
                                                        <i class="fa-solid fa-heart btn__icon"></i><?php echo tj_kses($settings['tj_sub_title']); ?>
                                                    </span>
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
                                            </div>
                                            <!-- Section Heading/Title End -->
                                        </div>
                                    </div>

                                    <?php if (!empty($settings['tj_desctiption'])) : ?>
                                        <p class="joinContent__text"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($settings['tj_btn_text'])) : ?>
                                    <div class="aboutContent__buttonss">
                                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                            <span class="btn__text"><?php echo $settings['tj_btn_text']; ?></span>
                                            <i class="fa-solid fa-heart btn__icon"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tj_design_style']  == 'layout-5') :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big');
            // Link
            if ('2' == $settings['tj_btn_link_type']) {
                $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
                $this->add_render_attribute('tj-button-arg', 'target', '_self');
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
            } else {
                if (!empty($settings['tj_btn_link']['url'])) {
                    $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                    $this->add_render_attribute('tj-button-arg', 'class', 'btn btn--styleOne btn--primary it-btn');
                }
            }
        ?>

            <section class="about gray-bg about--style3">
                <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                    <div class="aboutThumb3 d-none d-lg-block">
                        <img src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                    </div>
                <?php endif; ?>
                <div class="container">
                    <div class="row align-items-end justify-content-between">
                        <div class="col-lg-6 mb-30">
                            <div class="aboutContent aboutContent--style2">
                                <!-- Section Heading/Title -->
                                <?php if (!empty($settings['tj_section_title_show'])) : ?>
                                    <div class="sectionTitle mb-20">
                                        <?php if (!empty($settings['tj_sub_title'])) : ?>
                                            <span class="sectionTitle__small">
                                                <i class="fa-solid fa-heart btn__icon"></i><?php echo tj_kses($settings['tj_sub_title']); ?>
                                            </span>
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
                                    </div>
                                    <!-- Section Heading/Title End -->
                                    <?php if (!empty($settings['tj_desctiption'])) : ?>
                                        <p class="aboutContent__text"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($settings['tj_short_desctiption'])) : ?>
                                    <span class="aboutContent__quote"><?php echo tj_kses($settings['tj_short_desctiption']); ?></span>
                                <?php endif; ?>


                                <?php if (!empty($settings['tj_btn_text'])) : ?>
                                    <div class="aboutContent__buttons">
                                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                            <span class="btn__text"><?php echo $settings['tj_btn_text']; ?></span>
                                            <i class="fa-solid fa-heart btn__icon"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="aboutThumb aboutThumb--style3">
                                <div class="aboutThumb__text d-none d-lg-block">
                                    <?php if (!empty($settings['exp_title'])) : ?>
                                        <span class="aboutThumb__text__title"><?php echo tj_kses($settings['exp_title']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($settings['exp_num'])) : ?>
                                        <span class="aboutThumb__text__year"><?php echo tj_kses($settings['exp_num']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php else :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['tj_image_2']['url'])) {
                $tj_image_2 = !empty($settings['tj_image_2']['id']) ? wp_get_attachment_image_url($settings['tj_image_2']['id'], $settings['tj_image_size_size']) : $settings['tj_image_2']['url'];
                $tj_image_2_alt = get_post_meta($settings["tj_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['tj_image_3']['url'])) {
                $tj_image_3 = !empty($settings['tj_image_3']['id']) ? wp_get_attachment_image_url($settings['tj_image_3']['id'], $settings['tj_image_size_size']) : $settings['tj_image_3']['url'];
                $tj_image_3_alt = get_post_meta($settings["tj_image_3"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'section__title');

            // Link
            if ('2' == $settings['tj_btn_link_type']) {
                $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
                $this->add_render_attribute('tj-button-arg', 'target', '_self');
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tj-button-arg', 'class', 'tj-btn tj-btn-2');
            } else {
                if (!empty($settings['tj_btn_link']['url'])) {
                    $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                    $this->add_render_attribute('tj-button-arg', 'class', 'tj-btn tj-btn-2');
                }
            }
        ?>

            <section class="about__area p-relative">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-7 col-xl-7 col-lg-7">
                            <div class="about__thumb-wrapper d-sm-flex mr-20 p-relative">
                                <div class="about__shape">
                                    <img class="about__shape-1 d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-shape-1.png" alt="img">
                                    <img class="about__shape-2 d-none d-sm-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-shape-2.png" alt="img">
                                    <img class="about__shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-shape-3.png" alt="img">
                                </div>
                                <div class="about__thumb-left mr-10">
                                    <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                                        <div class="about__thumb-1 mb-10">
                                            <img src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($settings['tj_image_2']['url'] || $settings['tj_image_2']['id']) : ?>
                                        <div class="about__thumb-1 mb-10 text-end">
                                            <img src="<?php echo esc_url($tj_image_2); ?>" alt="<?php echo esc_attr($tj_image_2_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($settings['tj_image_3']['url'] || $settings['tj_image_3']['id']) : ?>
                                    <div class="about__thumb-2 mb-10">
                                        <img src="<?php echo esc_url($tj_image_3); ?>" alt="<?php echo esc_attr($tj_image_3_alt); ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-xl-5 col-lg-5">
                            <div class="about__content pl-70 pr-25">
                                <?php if (!empty($settings['tj_section_title_show'])) : ?>

                                    <div class="section__title-wrapper mb-15">
                                        <?php if (!empty($settings['tj_sub_title'])) : ?>
                                            <span class="section__title-pre">
                                                <?php echo tj_kses($settings['tj_sub_title']); ?>
                                            </span>
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
                                    </div>

                                    <?php if (!empty($settings['tj_desctiption'])) : ?>
                                        <p><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <div class="about__list mb-40">
                                    <ul>
                                        <?php foreach ($settings['tj_features_list'] as $item) : ?>
                                            <li>
                                                <?php if ($item['tj_features_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['tj_features_icon']) || !empty($item['tj_features_selected_icon']['value'])) : ?>
                                                        <span><?php tj_render_icon($item, 'tj_features_icon', 'tj_features_selected_icon'); ?></span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <span class="keyFeatureBlock__icon">
                                                        <?php if (!empty($item['tj_features_image']['url'])) : ?>
                                                            <img class="light" src="<?php echo $item['tj_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tj_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?>
                                                    </span>
                                                <?php endif; ?>
                                                <?php echo tj_kses($item['tj_features_title']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                                <?php if (!empty($settings['tj_btn_text'])) : ?>
                                    <div class="about__btn">
                                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                            <?php echo $settings['tj_btn_text']; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TJ_About());
