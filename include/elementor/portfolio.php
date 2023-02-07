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
class TJ_Portfolio extends Widget_Base {

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
        return 'portfolio-list';
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
        return __('Portfolio', 'tjcore');
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

        // Service group
        $this->start_controls_section(
            'tj_portfolio',
            [
                'label' => esc_html__('Portfolio List', 'tjcore'),
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
                    'style_3' => __('Style 3', 'tjcore'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tj_portfolio_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tjcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $repeater->add_control(
            'tj_portfolio_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tj_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tjcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tj_portfolio_description',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tj_portfolio_link_switcher',
            [
                'label' => esc_html__('Add Services link', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'tj_portfolio_btn_text',
            [
                'label' => esc_html__('Button Text', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tjcore'),
                'title' => esc_html__('Enter button text', 'tjcore'),
                'label_block' => true,
                'condition' => [
                    'tj_portfolio_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'tj_portfolio_link_type',
            [
                'label' => esc_html__('Service Link Type', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tj_portfolio_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tj_portfolio_link',
            [
                'label' => esc_html__('Service Link link', 'tjcore'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'tjcore'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'condition' => [
                    'tj_portfolio_link_type' => '1',
                    'tj_portfolio_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tj_portfolio_page_link',
            [
                'label' => esc_html__('Select Service Link Page', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tj_get_all_pages(),
                'condition' => [
                    'tj_portfolio_link_type' => '2',
                    'tj_portfolio_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'tj_portfolio_list',
            [
                'label' => esc_html__('Services - List', 'tjcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tj_portfolio_title' => esc_html__('Business Stratagy', 'tjcore'),
                    ],
                    [
                        'tj_portfolio_title' => esc_html__('Website Development', 'tjcore')
                    ],
                    [
                        'tj_portfolio_title' => esc_html__('Marketing & Reporting', 'tjcore')
                    ],
                    [
                        'tj_portfolio_title' => esc_html__('Mobile Development', 'tjcore')
                    ],
                    [
                        'tj_portfolio_title' => esc_html__('Marketing & Reporting', 'tjcore')
                    ],
                    [
                        'tj_portfolio_title' => esc_html__('Mobile Development', 'tjcore')
                    ],
                ],
                'title_field' => '{{{ tj_portfolio_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tj_portfolio_align',
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


        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                // 'default' => 'tj-post-thumb',
            ]
        );
        $this->end_controls_section();

        // tj_portfolio_columns_section
        $this->start_controls_section(
            'tj_portfolio_columns_section',
            [
                'label' => esc_html__('Portfolio - Columns', 'tjcore'),
            ]
        );

        $this->add_control(
            'tj_portfolio__for_desktop',
            [
                'label' => esc_html__('Columns for Desktop', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'tjcore'),
                    6 => esc_html__('2 Columns', 'tjcore'),
                    4 => esc_html__('3 Columns', 'tjcore'),
                    3 => esc_html__('4 Columns', 'tjcore'),
                    2 => esc_html__('6 Columns', 'tjcore'),
                    1 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_portfolio__for_laptop',
            [
                'label' => esc_html__('Columns for Laptop', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'tjcore'),
                    6 => esc_html__('2 Columns', 'tjcore'),
                    4 => esc_html__('3 Columns', 'tjcore'),
                    3 => esc_html__('4 Columns', 'tjcore'),
                    2 => esc_html__('6 Columns', 'tjcore'),
                    1 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '4',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_portfolio__for_tablet',
            [
                'label' => esc_html__('Columns for Tablet', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 576px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'tjcore'),
                    6 => esc_html__('2 Columns', 'tjcore'),
                    4 => esc_html__('3 Columns', 'tjcore'),
                    3 => esc_html__('4 Columns', 'tjcore'),
                    2 => esc_html__('6 Columns', 'tjcore'),
                    1 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '6',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            '
            ',
            [
                'label' => esc_html__('Columns for Mobile', 'tjcore'),
                'description' => esc_html__('Screen width less than 576px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    12 => esc_html__('1 Columns', 'tjcore'),
                    6 => esc_html__('2 Columns', 'tjcore'),
                    4 => esc_html__('3 Columns', 'tjcore'),
                    3 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns (For Carousel Item)', 'tjcore'),
                    2 => esc_html__('6 Columns', 'tjcore'),
                    1 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '12',
                'style_transfer' => true,
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

?>

        <?php if ($settings['tj_design_style']  == 'layout-2') : ?>
            <section class="portfolio-area">
                <div class="container-fluid p-0 overflow-hidden">
                    <div class="row g-0">
                        <?php foreach ($settings['tj_portfolio_list'] as $key => $item) :
                            if (!empty($item['tj_portfolio_image']['url'])) {
                                $tj_portfolio_image_url = !empty($item['tj_portfolio_image']['id']) ? wp_get_attachment_image_url($item['tj_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tj_portfolio_image']['url'];
                                $tj_portfolio_image_alt = get_post_meta($item["tj_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // Link
                            if ('2' == $item['tj_portfolio_link_type']) {
                                $link = get_permalink($item['tj_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tj_portfolio_link']['url']) ? $item['tj_portfolio_link']['url'] : '';
                                $target = !empty($item['tj_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tj_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }

                            $active = $key == 1 ? 'portfolioBlock--active' : '';
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['tj_portfolio__for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tj_portfolio__for_laptop']); ?> col-md-<?php echo esc_attr($settings['tj_portfolio__for_tablet']); ?> col-<?php echo esc_attr($settings['tj_portfolio__for_mobile']); ?>">
                                <div class="portfolioBlock portfolioBlock--style2 position-relative <?php echo esc_attr($active); ?>">
                                    <figure class="portfolioBlock__figure">

                                        <img class="portfolioBlock__figure__thumb" src="<?php echo esc_url($tj_portfolio_image_url); ?>" alt="<?php echo esc_url($tj_portfolio_image_alt); ?>">

                                        <div class="portfolioBlock__figure__shape">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shapes/portfolio-shape-2.svg" alt="shape">
                                            <?php if ($item['tj_portfolio_link_switcher'] == 'yes') : ?>
                                                <a class="portfolioBlock__more" href="<?php echo esc_url($link); ?>">
                                                    <svg width="20" height="13" viewBox="0 0 20 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.6758 0.734375L11.8164 1.59375C11.6445 1.80859 11.6445 2.10938 11.8594 2.32422L15.2969 5.63281H0.515625C0.214844 5.63281 0 5.89062 0 6.14844V7.35156C0 7.65234 0.214844 7.86719 0.515625 7.86719H15.2969L11.8594 11.2188C11.6445 11.4336 11.6445 11.7344 11.8164 11.9492L12.6758 12.8086C12.8906 12.9805 13.1914 12.9805 13.4062 12.8086L19.0781 7.13672C19.25 6.92188 19.25 6.62109 19.0781 6.40625L13.4062 0.734375C13.1914 0.5625 12.8906 0.5625 12.6758 0.734375Z" fill="white" />
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </figure>
                                    <div class="portfolioBlock__content">
                                        <?php if (!empty($link)) : ?>
                                            <div class="sv-btn">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="portfolioBlock__hashLink mb-10"><span><?php echo tj_kses($item['tj_portfolio_btn_text']); ?></span></a>
                                            </div>
                                        <?php endif; ?>
                                        <h2 class="portfolioBlock__heading text-uppercase">
                                            <?php if ($item['tj_portfolio_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo tj_kses($item['tj_portfolio_title']); ?></a>
                                            <?php else : ?>
                                                <?php echo tj_kses($item['tj_portfolio_title']); ?>
                                            <?php endif; ?>
                                        </h2>
                                        <?php if (!empty($item['tj_portfolio_description'])) : ?>
                                            <p><?php echo tj_kses($item['tj_portfolio_description']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
        ?>

            <section class="portfolio">
                <div class="container-fluid p-0 overflow-hidden">
                    <div class="row g-0">
                        <?php foreach ($settings['tj_portfolio_list'] as $item) :
                            if (!empty($item['tj_portfolio_image']['url'])) {
                                $tj_portfolio_image_url = !empty($item['tj_portfolio_image']['id']) ? wp_get_attachment_image_url($item['tj_portfolio_image']['id'], $settings['thumbnail_size']) : $item['tj_portfolio_image']['url'];
                                $tj_portfolio_image_alt = get_post_meta($item["tj_portfolio_image"]["id"], "_wp_attachment_image_alt", true);
                            }

                            // Link
                            if ('2' == $item['tj_portfolio_link_type']) {
                                $link = get_permalink($item['tj_portfolio_page_link']);
                                $target = '_self';
                                $rel = 'nofollow';
                            } else {
                                $link = !empty($item['tj_portfolio_link']['url']) ? $item['tj_portfolio_link']['url'] : '';
                                $target = !empty($item['tj_portfolio_link']['is_external']) ? '_blank' : '';
                                $rel = !empty($item['tj_portfolio_link']['nofollow']) ? 'nofollow' : '';
                            }
                        ?>
                            <div class="col-xl-<?php echo esc_attr($settings['tj_portfolio__for_desktop']); ?> col-lg-<?php echo esc_attr($settings['tj_portfolio__for_laptop']); ?> col-md-<?php echo esc_attr($settings['tj_portfolio__for_tablet']); ?> col-<?php echo esc_attr($settings['tj_portfolio__for_mobile']); ?>">
                                <div class="portfolioBlock position-relative">
                                    <figure class="portfolioBlock__figure">
                                        <img class="portfolioBlock__figure__thumb" src="<?php echo esc_url($tj_portfolio_image_url); ?>" alt="<?php echo esc_url($tj_portfolio_image_alt); ?>">
                                        <div class="portfolioBlock__figure__shape">
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/image/shapes/portfolio-shape.png" alt="Gainioz">
                                        </div>
                                    </figure>
                                    <div class="portfolioBlock__content">
                                        <h2 class="portfolioBlock__heading text-uppercase">
                                            <?php if ($item['tj_portfolio_link_switcher'] == 'yes') : ?>
                                                <a href="<?php echo esc_url($link); ?>"><?php echo tj_kses($item['tj_portfolio_title']); ?></a>
                                            <?php else : ?>
                                                <?php echo tj_kses($item['tj_portfolio_title']); ?>
                                            <?php endif; ?>
                                        </h2>

                                        <?php if (!empty($item['tj_portfolio_description'])) : ?>
                                            <p><?php echo tj_kses($item['tj_portfolio_description']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <div class="sv-btn">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="portfolioBlock__hashLink"><span><?php echo tj_kses($item['tj_portfolio_btn_text']); ?></span></a>
                                            </div>
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

$widgets_manager->register(new TJ_Portfolio());
