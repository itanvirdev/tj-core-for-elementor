<?php

namespace TJCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * TJ Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TJ_Mission extends Widget_Base {

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
        return 'tj-mission';
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
        return __('Mission', 'tjcore');
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
            'tj_video_url',
            [
                'label' => esc_html__('Video URL', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'tjcore'),
                'placeholder' => esc_html__('Video url here.', 'tjcore'),
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

        // Service group
        $this->start_controls_section(
            'tj_services',
            [
                'label' => esc_html__('Fact List', 'tjcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tjcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'fact_bg_color',
            [
                'label' => __('BG Color', 'tjcore'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7fb432',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}}  {{CURRENT_ITEM}}' => 'background: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'tj_service_icon_type',
            [
                'label' => esc_html__('Select Icon Type', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image', 'tjcore'),
                    'icon' => esc_html__('Icon', 'tjcore'),
                ],
            ]
        );

        $repeater->add_control(
            'tj_service_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tjcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tj_service_icon_type' => 'image'
                ]

            ]
        );

        if (tj_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tj_service_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tj_service_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tj_service_selected_icon',
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
                        'tj_service_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tj_service_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tj_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('1600', 'tjcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tj_service_description',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'SOLAR PANEL',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tj_service_list',
            [
                'label' => esc_html__('Services - List', 'tjcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tj_service_title' => esc_html__('1600', 'tjcore'),
                    ],
                    [
                        'tj_service_title' => esc_html__('289', 'tjcore')
                    ],
                    [
                        'tj_service_title' => esc_html__('16k', 'tjcore')
                    ],
                    [
                        'tj_service_title' => esc_html__('24mln', 'tjcore')
                    ]
                ],
                'title_field' => '{{{ tj_service_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tj_service_align',
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
                'toggle' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();


        // TAB_STYLE
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

        $this->add_render_attribute('title_args', 'class', 'sectionTitle__big text-white');
?>

        <section class="missionSection missionSection--style1 position-relative" data-bg-image="">
            <div class="sectionShape sectionShape--top">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shapes/breadcrumb-shape-1.png" alt="Gainioz">
            </div>
            <div class="sectionShape sectionShape--bottom">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shapes/breadcrumb-shape-2.png" alt="Gainioz">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="missionContent">
                            <!-- Section Heading/Title -->
                            <div class="sectionTitle mb-35">
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
                                <?php if (!empty($settings['tj_desctiption'])) : ?>
                                    <p class="aboutContent__text"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Section Heading/Title End -->
                            <div class="row g-4">
                                <?php foreach ($settings['tj_service_list'] as $item) : ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="missionBlock bgSecondary elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                                            <div class="missionBlock__icon">
                                                <?php if ($item['tj_service_icon_type'] !== 'image') : ?>
                                                    <?php if (!empty($item['tj_service_icon']) || !empty($item['tj_service_selected_icon']['value'])) : ?>
                                                        <div class="tj-sv-icon">
                                                            <?php tj_render_icon($item, 'tj_service_icon', 'tj_service_selected_icon'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <div class="tj-sv-icon">
                                                        <?php if (!empty($item['tj_service_image']['url'])) : ?>
                                                            <img src="<?php echo $item['tj_service_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tj_service_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="missionBlock__content">
                                                <?php if (!empty($item['tj_service_title'])) : ?>
                                                    <span class="missionBlock__counter"><?php echo tj_kses($item['tj_service_title']); ?></span>
                                                <?php endif; ?>
                                                <?php if (!empty($item['tj_service_description'])) : ?>
                                                    <p class="missionBlock__title"><?php echo tj_kses($item['tj_service_description']); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($settings['tj_video_url'])) : ?>
                        <div class="col-lg-6">
                            <div class="missionVideo">
                                <div class="mission-video-main">
                                    <div class="promo-video">
                                        <div class="waves-block">
                                            <div class="waves wave-1"></div>
                                            <div class="waves wave-2"></div>
                                            <div class="waves wave-3"></div>
                                        </div>
                                    </div>
                                    <a href="<?php echo tj_kses($settings['tj_video_url']); ?>" class="video popup-video mfp-iframe"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

<?php
    }
}

$widgets_manager->register(new TJ_Mission());
