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
class TP_Process extends Widget_Base {

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
        return 'process';
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
        return __('Process', 'tjcore');
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
                    'layout-3' => esc_html__('Layout 3', 'tjcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'tp_section_shape_show',
            [
                'label' => esc_html__('Shape ?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
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
            'tp_section_title_show',
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
            'tp_sub_title',
            [
                'label' => esc_html__('Sub Title', 'tjcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('TJ Sub Title', 'tjcore'),
                'placeholder' => esc_html__('Type Sub Heading Text', 'tjcore'),
                'label_block' => true,
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

        $this->add_control(
            'tp_desctiption',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('TJ section description here', 'tjcore'),
                'placeholder' => esc_html__('Type section description here', 'tjcore'),
            ]
        );

        $this->add_control(
            'tp_title_tag',
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
            'tp_align',
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
            'tp_process',
            [
                'label' => esc_html__('Process List', 'tjcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'tjcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tp_process_icon_type',
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
            'tp_process_image',
            [
                'label' => esc_html__('Upload Icon Image', 'tjcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_icon_type' => 'image'
                ]

            ]
        );

        $repeater->add_control(
            'tp_process_image_white',
            [
                'label' => esc_html__('Upload White Icon Image', 'tjcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tp_process_icon_type' => 'image'
                ]

            ]
        );

        if (tp_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tp_process_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        } else {
            $repeater->add_control(
                'tp_process_selected_icon',
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
                        'tp_process_icon_type' => 'icon'
                    ]
                ]
            );
        }
        $repeater->add_control(
            'tp_process_step',
            [
                'label' => esc_html__('Sub Title', 'tjcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Step - 01', 'tjcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_process_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tp_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tjcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tp_process_description',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'description' => tp_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tp_process_list',
            [
                'label' => esc_html__('Services - List', 'tjcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tp_process_title' => esc_html__('Discover', 'tjcore'),
                    ],
                    [
                        'tp_process_title' => esc_html__('Define', 'tjcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Develop', 'tjcore')
                    ],
                    [
                        'tp_process_title' => esc_html__('Deliver', 'tjcore')
                    ]
                ],
                'title_field' => '{{{ tp_process_title }}}',
            ]
        );
        $this->add_responsive_control(
            'tp_process_align',
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
        // Link
        if ('2' == !empty($settings['tp_btn_link_type'])) {
            $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tp_btn_page_link']));
            $this->add_render_attribute('tj-button-arg', 'target', '_self');
            $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('tj-button-arg', 'class', ' btn');
        } else {
            $this->add_render_attribute('tj-button-arg', 'class', ' btn');
            $this->add_render_attribute('tj-button-arg', 'data-wow-delay', ' .6s ');
            if (!empty($settings['tp_btn_link']['url'])) {
                $this->add_render_attribute('tj-button-arg', 'href', esc_url($settings['tp_btn_link']['url']));
            }
            if (!empty($settings['tp_btn_link']['is_external'])) {
                $this->add_render_attribute('tj-button-arg', 'target', '_blank');
            }
            if (!empty($settings['tp_btn_link']['nofollow'])) {
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
            }
        }

        // Button
        if (!empty($settings['tp_btn_link']['url']) || isset($settings['tp_btn_link_type'])) {
            // Link
            $button_html = '<a ' . $this->get_render_attribute_string('tj-button-arg') . '>' . $settings['tp_btn_text'] . '</a>';
        }

?>

        <?php if ($settings['tp_design_style']  == 'layout-2') : ?>
            <div class="style-2"></div>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'title');
            $shape_swtich = ($settings['tp_section_shape_show'] == 'yes') ? '' : 'shape-off p-0';
        ?>

            <section class="work__process <?php echo esc_attr($shape_swtich); ?>">
                <div class="container">
                    <?php if (!empty($settings['tp_section_title_show'])) : ?>
                        <div class="row justify-content-center">
                            <div class="col-xl-6 col-lg-8">
                                <div class="section__title text-center">
                                    <?php if (!empty($settings['tp_sub_title'])) : ?>
                                        <span class="sub-title tj-el-subtitle"><?php echo tp_kses($settings['tp_sub_title']); ?></span>
                                    <?php endif; ?>

                                    <?php
                                    if (!empty($settings['tp_title'])) :
                                        printf(
                                            '<%1$s %2$s>%3$s</%1$s>',
                                            tag_escape($settings['tp_title_tag']),
                                            $this->get_render_attribute_string('title_args'),
                                            tp_kses($settings['tp_title'])
                                        );
                                    endif;
                                    ?>

                                    <?php if (!empty($settings['tp_desctiption'])) : ?>
                                        <p class="desc"><?php echo tp_kses($settings['tp_desctiption']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row work__process__wrap">
                        <?php foreach ($settings['tp_process_list'] as $item) : ?>
                            <div class="col">
                                <div class="work__process__item">
                                    <?php if (!empty($item['tp_process_title'])) : ?>
                                        <span class="work__process_step"><?php echo tp_kses($item['tp_process_step']); ?></span>
                                    <?php endif; ?>
                                    <div class="work__process__icon">
                                        <?php if ($item['tp_process_icon_type'] !== 'image') : ?>
                                            <?php if (!empty($item['tp_process_icon']) || !empty($item['tp_process_selected_icon']['value'])) : ?>
                                                <div class="icon">
                                                    <?php tp_render_icon($item, 'tp_process_icon', 'tp_process_selected_icon'); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <div class="icon">
                                                <?php if (!empty($item['tp_process_image']['url'])) : ?>
                                                    <img class="light" src="<?php echo $item['tp_process_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>

                                                <?php if (!empty($item['tp_process_image_white']['url'])) : ?>
                                                    <img class="dark" src="<?php echo $item['tp_process_image_white']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tp_process_image_white']['url']), '_wp_attachment_image_alt', true); ?>">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="work__process__content">
                                        <?php if (!empty($item['tp_process_title'])) : ?>
                                            <h4 class="title">
                                                <?php echo tp_kses($item['tp_process_title']); ?>
                                            </h4>
                                        <?php endif; ?>

                                        <?php if (!empty($item['tp_process_description'])) : ?>
                                            <p><?php echo tp_kses($item['tp_process_description']); ?></p>
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

$widgets_manager->register(new TP_Process());
