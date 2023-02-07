<?php

namespace TJCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * TJ Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TJ_Blog_Post extends Widget_Base {

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
        return 'blogpost';
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
        return __('Blog Post', 'tjcore');
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
                    'left' => [
                        'title' => esc_html__('Left', 'tjcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'tjcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'tjcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .tj-sec-box' => 'text-align: {{VALUE}};'
                ]
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

        // Blog Query
        $this->start_controls_section(
            'tj_post_query',
            [
                'label' => esc_html__('Blog Query', 'tjcore'),
            ]
        );

        $post_type = 'post';
        $taxonomy = 'category';

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'tjcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'tjcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '3',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Include Categories', 'tjcore'),
                'description' => esc_html__('Select a category to include or leave blank for all.', 'tjcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tj_get_categories($taxonomy),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'exclude_category',
            [
                'label' => esc_html__('Exclude Categories', 'tjcore'),
                'description' => esc_html__('Select a category to exclude', 'tjcore'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => tj_get_categories($taxonomy),
                'label_block' => true
            ]
        );

        $this->add_control(
            'post__not_in',
            [
                'label' => esc_html__('Exclude Item', 'tjcore'),
                'type' => Controls_Manager::SELECT2,
                'options' => tj_get_all_types_post($post_type),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'tjcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ID' => 'Post ID',
                    'author' => 'Post Author',
                    'title' => 'Title',
                    'date' => 'Date',
                    'modified' => 'Last Modified Date',
                    'parent' => 'Parent Id',
                    'rand' => 'Random',
                    'comment_count' => 'Comment Count',
                    'menu_order' => 'Menu Order',
                ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc'     => esc_html__('Ascending', 'tjcore'),
                    'desc'     => esc_html__('Descending', 'tjcore')
                ],
                'default' => 'desc',

            ]
        );
        $this->add_control(
            'ignore_sticky_posts',
            [
                'label' => esc_html__('Ignore Sticky Posts', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tj_blog_title_word',
            [
                'label' => esc_html__('Title Word Count', 'tjcore'),
                'description' => esc_html__('Set how many word you want to displa!', 'tjcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '6',
            ]
        );

        $this->add_control(
            'tj_post_content',
            [
                'label' => __('Content', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'tjcore'),
                'label_off' => __('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'tj_post_content_limit',
            [
                'label' => __('Content Limit', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '14',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tj_post_content' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        // layout Panel
        $this->start_controls_section(
            'tj_post_',
            [
                'label' => esc_html__('Blog - Layout', 'tjcore'),
            ]
        );
        $this->add_control(
            'tj_design_style',
            [
                'label' => esc_html__('Select Layout', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('BLog Overlay', 'tjcore'),
                    'layout-2' => esc_html__('Blog List', 'tjcore')
                ],
                'default' => 'layout-1',
            ]
        );
        $this->add_control(
            'tj_post__height',
            [
                'label' => esc_html__('Height', 'tjcore'),
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
                    '{{WRAPPER}} .tj-project-img img' => 'height: {{SIZE}}{{UNIT}};object-fit: cover;',
                ],
            ]
        );
        $this->add_control(
            'tj_post__dots',
            [
                'label' => esc_html__('Dots?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tj_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tj_post__arrow',
            [
                'label' => esc_html__('Arrow Icons?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tj_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tj_post__infinite',
            [
                'label' => esc_html__('Infinite?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tj_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tj_post__autoplay',
            [
                'label' => esc_html__('Autoplay?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tj_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tj_post__autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => '2500',
                'title' => esc_html__('Enter autoplay speed', 'tjcore'),
                'label_block' => true,
                'condition' => array(
                    'tj_post__autoplay' => 'yes',
                    'tj_design_style' => 'layout-2',
                ),
            ]
        );
        $this->add_control(
            'tj_post__filter',
            [
                'label' => esc_html__('Filter?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => array(
                    'tj_design_style' => 'layout-3',
                ),
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
        $this->add_control(
            'tj_post__pagination',
            [
                'label' => esc_html__('Pagination', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => array(
                    'tj_design_style' => 'layout-1!',
                ),
            ]
        );
        $this->end_controls_section();

        // tj_post__columns_section
        $this->start_controls_section(
            'tj_post__columns_section',
            [
                'label' => esc_html__('Blog - Columns', 'tjcore'),
            ]
        );

        $this->add_control(
            'tj_post___for_desktop',
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
            'tj_post___for_laptop',
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
            'tj_post___for_tablet',
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

        // tj_post__slider_columns_section
        $this->start_controls_section(
            'tj_post__slider_columns_section',
            [
                'label' => esc_html__('Blog - Columns for Carousel', 'tjcore'),
            ]
        );

        $this->add_control(
            'tj_post__slider_for_xl_desktop',
            [
                'label' => esc_html__('Columns for Extra Large Desktop', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 1920px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__('1 Columns', 'tjcore'),
                    2 => esc_html__('2 Columns', 'tjcore'),
                    3 => esc_html__('3 Columns', 'tjcore'),
                    4 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns', 'tjcore'),
                    6 => esc_html__('6 Columns', 'tjcore'),
                    7 => esc_html__('7 Columns', 'tjcore'),
                    8 => esc_html__('8 Columns', 'tjcore'),
                    9 => esc_html__('9 Columns', 'tjcore'),
                    10 => esc_html__('10 Columns', 'tjcore'),
                    11 => esc_html__('10 Columns', 'tjcore'),
                    12 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_post__slider_for_desktop',
            [
                'label' => esc_html__('Columns for Desktop', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 1200px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__('1 Columns', 'tjcore'),
                    2 => esc_html__('2 Columns', 'tjcore'),
                    3 => esc_html__('3 Columns', 'tjcore'),
                    4 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns', 'tjcore'),
                    6 => esc_html__('6 Columns', 'tjcore'),
                    7 => esc_html__('7 Columns', 'tjcore'),
                    8 => esc_html__('8 Columns', 'tjcore'),
                    9 => esc_html__('9 Columns', 'tjcore'),
                    10 => esc_html__('10 Columns', 'tjcore'),
                    11 => esc_html__('10 Columns', 'tjcore'),
                    12 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_post__slider_for_laptop',
            [
                'label' => esc_html__('Columns for Laptop', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 992px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__('1 Columns', 'tjcore'),
                    2 => esc_html__('2 Columns', 'tjcore'),
                    3 => esc_html__('3 Columns', 'tjcore'),
                    4 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns', 'tjcore'),
                    6 => esc_html__('6 Columns', 'tjcore'),
                    7 => esc_html__('7 Columns', 'tjcore'),
                    8 => esc_html__('8 Columns', 'tjcore'),
                    9 => esc_html__('9 Columns', 'tjcore'),
                    10 => esc_html__('10 Columns', 'tjcore'),
                    11 => esc_html__('10 Columns', 'tjcore'),
                    12 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '3',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_post__slider_for_tablet',
            [
                'label' => esc_html__('Columns for Tablet', 'tjcore'),
                'description' => esc_html__('Screen width equal to or greater than 768px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__('1 Columns', 'tjcore'),
                    2 => esc_html__('2 Columns', 'tjcore'),
                    3 => esc_html__('3 Columns', 'tjcore'),
                    4 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns', 'tjcore'),
                    6 => esc_html__('6 Columns', 'tjcore'),
                    7 => esc_html__('7 Columns', 'tjcore'),
                    8 => esc_html__('8 Columns', 'tjcore'),
                    9 => esc_html__('9 Columns', 'tjcore'),
                    10 => esc_html__('10 Columns', 'tjcore'),
                    11 => esc_html__('10 Columns', 'tjcore'),
                    12 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '2',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_post__slider_for_mobile',
            [
                'label' => esc_html__('Columns for Mobile', 'tjcore'),
                'description' => esc_html__('Screen width less than 767', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__('1 Columns', 'tjcore'),
                    2 => esc_html__('2 Columns', 'tjcore'),
                    3 => esc_html__('3 Columns', 'tjcore'),
                    4 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns', 'tjcore'),
                    6 => esc_html__('6 Columns', 'tjcore'),
                    7 => esc_html__('7 Columns', 'tjcore'),
                    8 => esc_html__('8 Columns', 'tjcore'),
                    9 => esc_html__('9 Columns', 'tjcore'),
                    10 => esc_html__('10 Columns', 'tjcore'),
                    11 => esc_html__('10 Columns', 'tjcore'),
                    12 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'tj_post__slider_for_xs_mobile',
            [
                'label' => esc_html__('Columns for Extra Small Mobile', 'tjcore'),
                'description' => esc_html__('Screen width less than 575px', 'tjcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__('1 Columns', 'tjcore'),
                    2 => esc_html__('2 Columns', 'tjcore'),
                    3 => esc_html__('3 Columns', 'tjcore'),
                    4 => esc_html__('4 Columns', 'tjcore'),
                    5 => esc_html__('5 Columns', 'tjcore'),
                    6 => esc_html__('6 Columns', 'tjcore'),
                    7 => esc_html__('7 Columns', 'tjcore'),
                    8 => esc_html__('8 Columns', 'tjcore'),
                    9 => esc_html__('9 Columns', 'tjcore'),
                    10 => esc_html__('10 Columns', 'tjcore'),
                    11 => esc_html__('10 Columns', 'tjcore'),
                    12 => esc_html__('12 Columns', 'tjcore'),
                ],
                'separator' => 'before',
                'default' => '1',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


        // style control


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

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } else if (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        // include_categories
        $category_list = '';
        if (!empty($settings['category'])) {
            $category_list = implode(", ", $settings['category']);
        }
        $category_list_value = explode(" ", $category_list);

        // exclude_categories
        $exclude_categories = '';
        if (!empty($settings['exclude_category'])) {
            $exclude_categories = implode(", ", $settings['exclude_category']);
        }
        $exclude_category_list_value = explode(" ", $exclude_categories);

        $post__not_in = '';
        if (!empty($settings['post__not_in'])) {
            $post__not_in = $settings['post__not_in'];
            $args['post__not_in'] = $post__not_in;
        }
        $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
        $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
        $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';
        $offset_value = (!empty($settings['offset'])) ? $settings['offset'] : '0';
        $ignore_sticky_posts = (!empty($settings['ignore_sticky_posts']) && 'yes' == $settings['ignore_sticky_posts']) ? true : false;


        // number
        $off = (!empty($offset_value)) ? $offset_value : 0;
        $offset = $off + (($paged - 1) * $posts_per_page);
        $p_ids = array();

        // build up the array
        if (!empty($settings['post__not_in'])) {
            foreach ($settings['post__not_in'] as $p_idsn) {
                $p_ids[] = $p_idsn;
            }
        }

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => $posts_per_page,
            'orderby' => $orderby,
            'order' => $order,
            'offset' => $offset,
            'paged' => $paged,
            'post__not_in' => $p_ids,
            'ignore_sticky_posts' => $ignore_sticky_posts
        );

        // exclude_categories
        if (!empty($settings['exclude_category'])) {

            // Exclude the correct cats from tax_query
            $args['tax_query'] = array(
                array(
                    'taxonomy'    => 'category',
                    'field'         => 'slug',
                    'terms'        => $exclude_category_list_value,
                    'operator'    => 'NOT IN'
                )
            );

            // Include the correct cats in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query']['relation'] = 'AND';
                $args['tax_query'][] = array(
                    'taxonomy'    => 'category',
                    'field'        => 'slug',
                    'terms'        => $category_list_value,
                    'operator'    => 'IN'
                );
            }
        } else {
            // Include the cats from $cat_slugs in tax_query
            if (!empty($settings['category'])) {
                $args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category_list_value,
                ];
            }
        }

        $filter_list = $settings['category'];

        // The Query
        $query = new \WP_Query($args);

        // var_dump($query);

        $carousel_args = [
            'arrows' => ('yes' === $settings['tj_post__arrow']),
            'dots' => ('yes' === $settings['tj_post__dots']),
            'autoplay' => ('yes' === $settings['tj_post__autoplay']),
            'autoplay_speed' => absint($settings['tj_post__autoplay_speed']),
            'infinite' => ('yes' === $settings['tj_post__infinite']),
            'for_xl_desktop' => absint($settings['tj_post__slider_for_xl_desktop']),
            'slidesToShow' => absint($settings['tj_post__slider_for_desktop']),
            'for_laptop' => absint($settings['tj_post__slider_for_laptop']),
            'for_tablet' => absint($settings['tj_post__slider_for_tablet']),
            'for_mobile' => absint($settings['tj_post__slider_for_mobile']),
            'for_xs_mobile' => absint($settings['tj_post__slider_for_xs_mobile']),
        ];
        $this->add_render_attribute('tj-carousel-post-data', 'data-settings', wp_json_encode($carousel_args));

?>

        <?php if ($settings['tj_design_style']  == 'layout-2') :
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tj-el-title');
        ?>

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    global $post;
                    $categories = get_the_category($post->ID);
                ?>
                    <div class="blog__item mb-30 white-bg transition-3 mb-30">
                        <div class="blog__thumb w-img fix">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail($post->ID, $settings['thumbnail_size']); ?>
                            </a>
                        </div>
                        <div class="blog__content">
                            <div class="blog__tag">
                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                            </div>
                            <h3 class="blog__title">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tj_blog_title_word'], ''); ?></a>
                            </h3>
                            <?php if (!empty($settings['tj_post_content'])) :
                                $tj_post_content_limit = (!empty($settings['tj_post_content_limit'])) ? $settings['tj_post_content_limit'] : '';
                            ?>
                                <p class="blogBlock__text"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tj_post_content_limit, ''); ?></p>
                            <?php endif; ?>
                            <div class="blog__meta">
                                <ul>
                                    <li>
                                        <span><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.6848 6.99994C10.6848 8.48494 9.48476 9.68494 7.99976 9.68494C6.51476 9.68494 5.31476 8.48494 5.31476 6.99994C5.31476 5.51494 6.51476 4.31494 7.99976 4.31494C9.48476 4.31494 10.6848 5.51494 10.6848 6.99994Z" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.99976 13.2025C10.6473 13.2025 13.1148 11.6425 14.8323 8.94254C15.5073 7.88504 15.5073 6.10754 14.8323 5.05004C13.1148 2.35004 10.6473 0.790039 7.99976 0.790039C5.35226 0.790039 2.88476 2.35004 1.16726 5.05004C0.492261 6.10754 0.492261 7.88504 1.16726 8.94254C2.88476 11.6425 5.35226 13.2025 7.99976 13.2025Z" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg><a href="<?php the_permalink(); ?>"><?php print get_the_author(); ?></a></span>
                                    </li>
                                    <li>
                                        <span><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.4998 9C16.4998 13.14 13.1398 16.5 8.99976 16.5C4.85976 16.5 1.49976 13.14 1.49976 9C1.49976 4.86 4.85976 1.5 8.99976 1.5C13.1398 1.5 16.4998 4.86 16.4998 9Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M11.7822 11.3848L9.45723 9.99732C9.05223 9.75732 8.72223 9.17982 8.72223 8.70732V5.63232" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg><a href="<?php the_permalink(); ?>"><?php the_time('d M Y'); ?></a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_query(); ?>
            <?php endif; ?>

        <?php else :
            $this->add_render_attribute('title_args', 'class', 'sectionTitle__big tj-el-title');
        ?>

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    global $post;


                    $categories = get_the_category($post->ID);
                ?>
                    <div class="blog__item-float blog__item-float-overlay p-relative fix transition-3 mb-30 d-flex align-items-end">
                        <div class="blog__thumb-bg w-img fix" data-background="<?php the_post_thumbnail_url($post->ID, $settings['thumbnail_size']); ?>"></div>
                        <div class="blog__content-float">
                            <div class="blog__tag-float mb-15">
                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                            </div>
                            <h3 class="blog__title-float">
                                <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), $settings['tj_blog_title_word'], ''); ?></a>
                            </h3>
                            <?php if (!empty($settings['tj_post_content'])) :
                                $tj_post_content_limit = (!empty($settings['tj_post_content_limit'])) ? $settings['tj_post_content_limit'] : '';
                            ?>
                                <p class="blogBlock__text"><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $tj_post_content_limit, ''); ?></p>
                            <?php endif; ?>
                            <div class="blog__meta-float">
                                <ul>
                                    <li>
                                        <span><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.4998 9C16.4998 13.14 13.1398 16.5 8.99976 16.5C4.85976 16.5 1.49976 13.14 1.49976 9C1.49976 4.86 4.85976 1.5 8.99976 1.5C13.1398 1.5 16.4998 4.86 16.4998 9Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M11.7822 11.3848L9.45723 9.99732C9.05223 9.75732 8.72223 9.17982 8.72223 8.70732V5.63232" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg><a href="<?php the_permalink(); ?>"><?php the_time(get_option('date_format')); ?></a></span>
                                    </li>

                                    <li>
                                        <span><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.6848 6.99994C10.6848 8.48494 9.48476 9.68494 7.99976 9.68494C6.51476 9.68494 5.31476 8.48494 5.31476 6.99994C5.31476 5.51494 6.51476 4.31494 7.99976 4.31494C9.48476 4.31494 10.6848 5.51494 10.6848 6.99994Z" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M7.99976 13.2025C10.6473 13.2025 13.1148 11.6425 14.8323 8.94254C15.5073 7.88504 15.5073 6.10754 14.8323 5.05004C13.1148 2.35004 10.6473 0.790039 7.99976 0.790039C5.35226 0.790039 2.88476 2.35004 1.16726 5.05004C0.492261 6.10754 0.492261 7.88504 1.16726 8.94254C2.88476 11.6425 5.35226 13.2025 7.99976 13.2025Z" stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg><a href="<?php the_permalink(); ?>"><?php comments_number(); ?></a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_query(); ?>
            <?php endif; ?>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TJ_Blog_Post());
