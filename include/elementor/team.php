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
class TP_Team extends Widget_Base {

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
        return 'tj-team';
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
        return __('Team', 'tjcore');
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
                    'layout-2' => esc_html__('Layout 2', 'tjcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // member list
        $this->start_controls_section(
            '_section_teams',
            [
                'label' => __('Members', 'tjcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tp_team_bg_color',
            [
                'label' => __('Shape BG Color', 'tjcore'),
                'type' => Controls_Manager::COLOR,
                'default' => '#A794C8',
                'frontend_available' => true,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .team__thumb-shape::after' => 'background-color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );
        $repeater->start_controls_tabs(
            '_tab_style_member_box_itemr'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __('Information', 'tjcore'),
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __('Image', 'tjcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __('Title', 'tjcore'),
                'default' => __('TJ Member Title', 'tjcore'),
                'placeholder' => __('Type title here', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __('Job Title', 'tjcore'),
                'default' => __('TJ Officer', 'tjcore'),
                'placeholder' => __('Type designation here', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'item_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __('Type link here', 'tjcore'),
                'default' => __('#', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __('Links', 'tjcore'),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __('Show Options?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'tjcore'),
                'label_off' => __('No', 'tjcore'),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Website Address', 'tjcore'),
                'placeholder' => __('Add your profile link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Email', 'tjcore'),
                'placeholder' => __('Add your email link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Phone', 'tjcore'),
                'placeholder' => __('Add your phone link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Facebook', 'tjcore'),
                'default' => __('#', 'tjcore'),
                'placeholder' => __('Add your facebook link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Twitter', 'tjcore'),
                'default' => __('#', 'tjcore'),
                'placeholder' => __('Add your twitter link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Instagram', 'tjcore'),
                'default' => __('#', 'tjcore'),
                'placeholder' => __('Add your instagram link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('LinkedIn', 'tjcore'),
                'placeholder' => __('Add your linkedin link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Youtube', 'tjcore'),
                'placeholder' => __('Add your youtube link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Google Plus', 'tjcore'),
                'placeholder' => __('Add your Google Plus link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Flickr', 'tjcore'),
                'placeholder' => __('Add your flickr link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Vimeo', 'tjcore'),
                'placeholder' => __('Add your vimeo link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Behance', 'tjcore'),
                'placeholder' => __('Add your hehance link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Dribbble', 'tjcore'),
                'placeholder' => __('Add your dribbble link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Pinterest', 'tjcore'),
                'placeholder' => __('Add your pinterest link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __('Github', 'tjcore'),
                'placeholder' => __('Add your github link', 'tjcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
        $this->add_control(
            'teams',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'tjcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __('H1', 'tjcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __('H2', 'tjcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __('H3', 'tjcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __('H4', 'tjcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __('H5', 'tjcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __('H6', 'tjcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'tjcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'tjcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'tjcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'tjcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
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

        <!-- style 2 -->
        <?php if ($settings['tp_design_style'] === 'layout-2') : ?>


            <!-- style default -->
        <?php else :
            $this->add_render_attribute('title', 'class', 'team__title');
        ?>

            <section class="team__area">
                <div class="container">
                    <div class="row">
                        <?php foreach ($settings['teams'] as $item) :
                            $title = tp_kses($item['title']);
                            $item_url = esc_url($item['item_url']);

                            if (!empty($item['image']['url'])) {
                                $tp_team_image_url = !empty($item['image']['id']) ? wp_get_attachment_image_url($item['image']['id'], $settings['thumbnail_size']) : $item['image']['url'];
                                $tp_team_image_alt = get_post_meta($item["image"]["id"], "_wp_attachment_image_alt", true);
                            }
                        ?>
                            <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6">
                                <div class="team__item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> text-center mb-40">
                                    <div class="team__thumb team__thumb-shape">
                                        <?php if (!empty($tp_team_image_url)) : ?>
                                            <img src="<?php echo esc_url($tp_team_image_url); ?>" alt="<?php echo esc_attr($tp_team_image_alt); ?>">
                                        <?php endif; ?>

                                        <?php if (!empty($item['show_social'])) : ?>
                                            <div class="team__social transition-3">
                                                <?php if (!empty($item['web_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['web_title']); ?>"><i class="fa-regular fa-globe"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['email_title'])) : ?>
                                                    <a href="mailto:<?php echo esc_url($item['email_title']); ?>"><i class="fa-regular fa-envelope"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['phone_title'])) : ?>
                                                    <a href="tell:<?php echo esc_url($item['phone_title']); ?>"><i class="fa-regular fa-phone"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['facebook_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['facebook_title']); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['twitter_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['twitter_title']); ?>"><i class="fa-brands fa-twitter"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['instagram_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['instagram_title']); ?>"><i class="fa-brands fa-instagram"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['linkedin_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['linkedin_title']); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['youtube_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['youtube_title']); ?>"><i class="fa-brands fa-youtube"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['googleplus_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['googleplus_title']); ?>"><i class="fa-brands fa-google-plus-g"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['flickr_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['flickr_title']); ?>"><i class="fa-brands fa-flickr"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['vimeo_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['vimeo_title']); ?>"><i class="fa-brands fa-vimeo-v"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['behance_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['behance_title']); ?>"><i class="fa-brands fa-behance"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['dribble_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['dribble_title']); ?>"><i class="fa-brands fa-dribbble"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['pinterest_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['pinterest_title']); ?>"><i class="fa-brands fa-pinterest-p"></i></a>
                                                <?php endif; ?>

                                                <?php if (!empty($item['gitub_title'])) : ?>
                                                    <a href="<?php echo esc_url($item['gitub_title']); ?>"><i class="fa-brands fa-github"></i></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="team__content">
                                        <?php printf(
                                            '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                            tag_escape($settings['title_tag']),
                                            $this->get_render_attribute_string('title'),
                                            $title,
                                            $item_url
                                        ); ?>

                                        <?php if (!empty($item['designation'])) : ?>
                                            <span class="team__designation"><?php echo tp_kses($item['designation']); ?></span>
                                        <?php endif; ?>
                                        <?php if (!empty($item['description'])) : ?>
                                            <p><?php echo tp_kses($item['description']); ?></p>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>


        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TP_Team());
