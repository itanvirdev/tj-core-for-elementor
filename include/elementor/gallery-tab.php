<?php

namespace TJCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * TJ Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TJ_Gallery_Tab extends Widget_Base {

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
        return 'gallery-tab';
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
        return __('Gallery', 'tjcore');
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

        $this->start_controls_section(
            '_section_gallery',
            [
                'label' => esc_html__('Gallery - Content', 'tjcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'images',
            [
                'type' => Controls_Manager::MEDIA,
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
                'label' => esc_html__('Title', 'tjcore'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type gallery title', 'tjcore'),
                'default' => esc_html__('Gallery Title', 'tjcore'),
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Type description here', 'tjcore'),
                'default' => esc_html__('If you are going to use a passage of Lorem Ipsum, you need to be sure there is anything embarrassing hidden in the middle of text', 'tjcore'),
            ]
        );
        $repeater->add_control(
            'filter',
            [
                'label' => esc_html__('Filter Name (Category)', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type gallery filter name', 'tjcore'),
                'description' => esc_html__('Filter name will be used in filter menu. Added more category by , separator.', 'tjcore'),
                'default' => esc_html__('Filter Name', 'tjcore'),
            ]
        );

        $repeater->add_control(
            'tj_services_link_switcher',
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
            'tj_services_btn_text',
            [
                'label' => esc_html__('Button Text', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'tjcore'),
                'title' => esc_html__('Enter button text', 'tjcore'),
                'label_block' => true,
                'condition' => [
                    'tj_services_link_switcher' => 'yes'
                ],
            ]
        );
        $repeater->add_control(
            'tj_services_link_type',
            [
                'label' => esc_html__('Service Link Type', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'condition' => [
                    'tj_services_link_switcher' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'tj_services_link',
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
                    'tj_services_link_type' => '1',
                    'tj_services_link_switcher' => 'yes',
                ]
            ]
        );
        $repeater->add_control(
            'tj_services_page_link',
            [
                'label' => esc_html__('Select Service Link Page', 'tjcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => tj_get_all_pages(),
                'condition' => [
                    'tj_services_link_type' => '2',
                    'tj_services_link_switcher' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'gallery',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'title_field' => sprintf(esc_html__('Filter Group: %1$s', 'tjcore'), '{{filter}}'),
                'default' => [
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__('Web Design', 'tjcore'),
                        'title' => esc_html__('Ecommerce Product Apps', 'tjcore'),

                    ],
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__('Logo Design', 'tjcore'),
                        'title' => esc_html__('Cryptocurrency web Application', 'tjcore'),

                    ],
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__('Mobile App', 'tjcore'),
                        'title' => esc_html__('Making 3d Illustration', 'tjcore'),

                    ],
                    [
                        'images' => Utils::get_placeholder_image_src(),
                        'filter' => esc_html__('Ui/Kit', 'tjcore'),
                        'title' => esc_html__('Hilon - Personal Portfolio', 'tjcore'),

                    ]
                ]
            ]
        );

        $this->add_control(
            'title_tag',
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
                'default' => 'h4',
                'toggle' => false,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'gallery_thumbnail',
                'default' => 'tj-gallery-thumb',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );
        $this->add_control(
            'show_filter',
            [
                'label' => esc_html__('Show Filter', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'separator' => 'before',
                'return_value' => 'yes',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'show_all_filter',
            [
                'label' => esc_html__('Show "All Project" Filter?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Enable to display "All Project" filter in filter menu.', 'tjcore'),
                'condition' => [
                    'show_filter' => 'yes'
                ],
                'style_transfer' => true,
            ]
        );
        $this->add_control(
            'all_filter_label',
            [
                'label' => esc_html__('Filter Label', 'tjcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('All Project', 'tjcore'),
                'placeholder' => esc_html__('Type filter label', 'tjcore'),
                'description' => esc_html__('Type "All Project" filter label.', 'tjcore'),
                'condition' => [
                    'show_all_filter' => 'yes',
                    'show_filter' => 'yes'
                ]
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


        if (empty($settings['gallery'])) {
            return;
        }


        $categories = array();
        $cats = array();
        foreach ($settings['gallery'] as $index => $gallery) :

            $cats = explode(",", $gallery['filter']);

            foreach ($cats as $i => $cat) {
                $categories[tj_slugify($cat)] = $cat;
            }
        endforeach;

        $this->add_render_attribute('title_args', 'class', 'title');

?>


        <section class="portfolio__inner">
            <div class="container">
                <?php if ($settings['show_filter'] === 'yes') : ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="portfolio__inner__nav">
                                <?php if ($settings['show_all_filter'] === 'yes') : ?>
                                    <button data-filter="*" class="active"><?php echo esc_html($settings['all_filter_label']); ?></button>
                                <?php endif; ?>
                                <?php foreach ($categories as $key => $val) : ?>
                                    <button data-filter=".<?php echo esc_attr($key); ?>"><span class="filter-text"><?php echo esc_html($val); ?></span></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="portfolio__inner__active">
                    <?php
                    $cars = array();
                    foreach ($settings['gallery'] as $index => $gallery) :
                        $cars = explode(",",  $gallery['filter']);
                        $big_image  = (!empty(wp_get_attachment_image_url($gallery['images']['id'], 'full'))) ? wp_get_attachment_image_url($gallery['images']['id'], 'full') : Utils::get_placeholder_image_src();

                        // Link
                        if ('2' == $gallery['tj_services_link_type']) {
                            $link = get_permalink($gallery['tj_services_page_link']);
                            $target = '_self';
                            $rel = 'nofollow';
                        } else {
                            $link = !empty($gallery['tj_services_link']['url']) ? $gallery['tj_services_link']['url'] : '';
                            $target = !empty($gallery['tj_services_link']['is_external']) ? '_blank' : '';
                            $rel = !empty($gallery['tj_services_link']['nofollow']) ? 'nofollow' : '';
                        }
                    ?>

                        <?php foreach ($cars as $key => $value) : ?>
                            <?php
                            $item_classes = tj_slugify($value);
                            ?>
                        <?php endforeach; ?>


                        <div class="portfolio__inner__item grid-item <?php echo esc_attr($item_classes); ?>">
                            <div class="row gx-0 align-items-center">
                                <div class="col-lg-6 col-md-10">
                                    <div class="portfolio__inner__thumb">
                                        <a href="<?php echo esc_url($link); ?>">
                                            <?php if (!empty(wp_get_attachment_image($gallery['images']['id']))) { ?>
                                                <?php echo wp_get_attachment_image($gallery['images']['id'], $settings['gallery_thumbnail_size']); ?>
                                            <?php } else { ?>
                                                <?php echo Group_Control_Image_Size::get_attachment_image_html($gallery, 'full', 'images') ?>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-10">
                                    <div class="portfolio__inner__content">
                                        <?php if (!empty($gallery['filter'])) : ?>
                                            <span class="gallery-category"><?php echo esc_html($gallery['filter']); ?></span>
                                        <?php endif; ?>

                                        <?php
                                        if (!empty($gallery['title'])) :
                                            printf(
                                                '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                                tag_escape($settings['title_tag']),
                                                $this->get_render_attribute_string('title_args'),
                                                tj_kses($gallery['title']),
                                                esc_url($link)
                                            );
                                        endif;
                                        ?>

                                        <?php if (!empty($gallery['description'])) : ?>
                                            <p><?php echo tj_kses($gallery['description']); ?></p>
                                        <?php endif; ?>

                                        <?php if (!empty($link)) : ?>
                                            <div class="gallery-btn">
                                                <a target="<?php echo esc_attr($target); ?>" rel="<?php echo esc_attr($rel); ?>" href="<?php echo esc_url($link); ?>" class="link"><?php echo tj_kses($gallery['tj_services_btn_text']); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


<?php
    }
}

$widgets_manager->register(new TJ_Gallery_Tab());
