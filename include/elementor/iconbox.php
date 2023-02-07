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
class TJ_IconBox extends Widget_Base {

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
        return 'iconbox';
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
        return __('Icon Box', 'tjcore');
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

        // _tj_icon
        $this->start_controls_section(
            '
                    _tj_icon',
            [
                'label' => esc_html__('Icon', 'tjcore'),
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
            $this->add_render_attribute('title_args', 'class', 'research__title');
        ?>

            <div class="research__item research__item-border text-center mb-30 transition-3">
                <div class="research__thumb mb-35">
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
                <div class="research__content">
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
                </div>
            </div>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'contact__title');

            // Link
            if ('2' == $settings['tj_btn_link_type']) {
                $this->add_render_attribute('tj-button-arg', 'href', get_permalink($settings['tj_btn_page_link']));
                $this->add_render_attribute('tj-button-arg', 'target', '_self');
                $this->add_render_attribute('tj-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tj-button-arg', 'class', 'tj-btn tj-btn-border');
            } else {
                if (!empty($settings['tj_btn_link']['url'])) {
                    $this->add_link_attributes('tj-button-arg', $settings['tj_btn_link']);
                    $this->add_render_attribute('tj-button-arg', 'class', 'tj-btn tj-btn-border ');
                }
            }
        ?>

            <div class="contact__item text-center mb-30 transition-3 white-bg">
                <div class="contact__icon d-flex justify-content-center align-items-end">
                    <?php if ($settings['tj_icon_type'] !== 'image') : ?>
                        <?php if (!empty($settings['tj_icon']) || !empty($settings['tj_selected_icon']['value'])) : ?>
                            <span class="keyFeatureBlock__icon">
                                <?php tj_render_icon($settings, 'tj_icon', 'tj_selected_icon'); ?>
                            </span>
                        <?php endif; ?>
                    <?php else : ?>
                        <span class="keyFeatureBlock__icon">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'full', 'tj_icon_image'); ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="contact__content">
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
                        <p class="keyFeatureBlock__text"><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($settings['tj_btn_button_show'])) : ?>
                        <a <?php echo $this->get_render_attribute_string('tj-button-arg'); ?>>
                            <?php echo $settings['tj_btn_text']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TJ_IconBox());
