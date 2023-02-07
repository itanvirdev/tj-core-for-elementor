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
class TJ_Hero_Banner extends Widget_Base {

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
        return 'hero-banner';
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
        return __('Hero Banner', 'tjcore');
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
                'default' => true,
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
            '_tj_image_section',
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

        // _tj_image
        $this->start_controls_section(
            '_tj_shape_image_section',
            [
                'label' => esc_html__('Shape Image', 'tjcore'),
            ]
        );
        $this->add_control(
            'tj_shape_image',
            [
                'label' => esc_html__('Choose Image', 'tjcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tj_shape_image_2',
            [
                'label' => esc_html__('Choose Image 2', 'tjcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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

        // Link
        if ('2' == $settings['tj_btn_link_type']) {
            $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
            $this->add_render_attribute('tj-button-arg', 'target', '_self');
            $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('tj-button-arg', 'class', 'tj-btn-green');
        } else {
            if (!empty($settings['tj_btn_link']['url'])) {
                $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                $this->add_render_attribute('tj-button-arg', 'class', 'tj-btn-green');
            }
        }

?>

        <?php if ($settings['tj_design_style']  == 'layout-2') :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt           = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'hero__title hero__title--big');
        ?>
            <section class="hero hero--style2">
                <div class="container container--custom">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-12">
                            <div class="hero__content text-center">
                                <?php if (!empty($settings['tj_section_title_show'])) : ?>
                                    <?php if (!empty($settings['tj_sub_title'])) : ?>
                                        <span class="hero__title hero__title--small"><?php echo tj_kses($settings['tj_sub_title']); ?></span>
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
                                        <p class="hero__text wow animate__fadeInUp animate__animated" data-wow-duration="1200ms" data-wow-delay="400ms"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <div class="hero__topDown mt-30">
                                    <?php if (!empty($settings['tj_btn_text'])) : ?>
                                        <div class="tj-hero-btn">
                                            <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                                <span class="btn__text"><?php echo $settings['tj_btn_text']; ?></span> <i class="fa-solid fa-heart btn__icon"></i></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                            <div class="col-12">
                                <figure class="hero__figure hero__figure--style2">
                                    <img class="hero__figure__thumbs" src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                                </figure>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tj_design_style']  == 'layout-3') :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt           = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }
            $this->add_render_attribute('title_args', 'class', 'hero__title hero__title--big');
        ?>



        <?php else :
            if (!empty($settings['tj_image']['url'])) {
                $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
                $tj_image_alt           = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['tj_shape_image']['url'])) {
                $tj_shape_image = !empty($settings['tj_shape_image']['id']) ? wp_get_attachment_image_url($settings['tj_shape_image']['id'], 'large') : $settings['tj_shape_image']['url'];
                $tj_shape_image_alt           = get_post_meta($settings["tj_shape_image"]["id"], "_wp_attachment_image_alt", true);
            }

            if (!empty($settings['tj_shape_image_2']['url'])) {
                $tj_shape_image_2 = !empty($settings['tj_shape_image_2']['id']) ? wp_get_attachment_image_url($settings['tj_shape_image_2']['id'], 'large') : $settings['tj_shape_image_2']['url'];
                $tj_shape_image_2_alt           = get_post_meta($settings["tj_shape_image_2"]["id"], "_wp_attachment_image_alt", true);
            }

            $this->add_render_attribute('title_args', 'class', 'slider__title-2');

        ?>
            <section class="slider__area slider__height-2 include-bg d-flex align-items-center">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xxl-6 col-lg-6">
                            <div class="slider__content-2 mt-30">
                                <?php if (!empty($settings['tj_sub_title'])) : ?>
                                    <span><?php echo tj_kses($settings['tj_sub_title']); ?></span>
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
                                    <p><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($settings['tj_btn_text'])) : ?>
                                    <div class="tj-hero-btn">
                                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                                            <?php echo $settings['tj_btn_text']; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-6">
                            <div class="slider__thumb-2 p-relative">
                                <div class="slider__shape">
                                    <img class="slider__shape-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/slider-cap-1.png" alt="img">
                                    <img class="slider__shape-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/slider-cap-2.png" alt="img">
                                    <img class="slider__shape-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/slider/2/shape/slider-cap-3.png" alt="img">

                                    <?php if (!empty($tj_shape_image)) : ?>
                                        <img class="slider__shape-4" src="<?php echo esc_url($tj_shape_image); ?>" alt="<?php echo esc_attr($tj_shape_image_alt); ?>">
                                    <?php endif; ?>
                                    <?php if (!empty($tj_shape_image_2)) : ?>
                                        <img class="slider__shape-5" src="<?php echo esc_url($tj_shape_image_2); ?>" alt="<?php echo esc_attr($tj_shape_image_2_alt); ?>">
                                    <?php endif; ?>

                                </div>
                                <?php if (!empty($tj_image)) : ?>
                                    <span class="slider__thumb-mask">
                                        <img src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                                    </span>
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

$widgets_manager->register(new TJ_Hero_Banner());
