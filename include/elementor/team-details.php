<?php

namespace TJCore\Widgets;

use Elementor\Widget_Base;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Box_Shadow;
use TJCore\Elementor\Controls\Group_Control_TJBGGradient;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * TJ Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TJ_Team_Details extends Widget_Base {

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
        return 'team-details';
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
        return __('Team Details', 'tjcore');
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

    protected static function get_profile_names() {
        return [
            '500px' => esc_html__('500px', 'tjcore'),
            'apple' => esc_html__('Apple', 'tjcore'),
            'behance' => esc_html__('Behance', 'tjcore'),
            'bitbucket' => esc_html__('BitBucket', 'tjcore'),
            'codepen' => esc_html__('CodePen', 'tjcore'),
            'delicious' => esc_html__('Delicious', 'tjcore'),
            'deviantart' => esc_html__('DeviantArt', 'tjcore'),
            'digg' => esc_html__('Digg', 'tjcore'),
            'dribbble' => esc_html__('Dribbble', 'tjcore'),
            'email' => esc_html__('Email', 'tjcore'),
            'facebook' => esc_html__('Facebook', 'tjcore'),
            'flickr' => esc_html__('Flicker', 'tjcore'),
            'foursquare' => esc_html__('FourSquare', 'tjcore'),
            'github' => esc_html__('Github', 'tjcore'),
            'houzz' => esc_html__('Houzz', 'tjcore'),
            'instagram' => esc_html__('Instagram', 'tjcore'),
            'jsfiddle' => esc_html__('JS Fiddle', 'tjcore'),
            'linkedin' => esc_html__('LinkedIn', 'tjcore'),
            'medium' => esc_html__('Medium', 'tjcore'),
            'pinterest' => esc_html__('Pinterest', 'tjcore'),
            'product-hunt' => esc_html__('Product Hunt', 'tjcore'),
            'reddit' => esc_html__('Reddit', 'tjcore'),
            'slideshare' => esc_html__('Slide Share', 'tjcore'),
            'snapchat' => esc_html__('Snapchat', 'tjcore'),
            'soundcloud' => esc_html__('SoundCloud', 'tjcore'),
            'spotify' => esc_html__('Spotify', 'tjcore'),
            'stack-overflow' => esc_html__('StackOverflow', 'tjcore'),
            'tripadvisor' => esc_html__('TripAdvisor', 'tjcore'),
            'tumblr' => esc_html__('Tumblr', 'tjcore'),
            'twitch' => esc_html__('Twitch', 'tjcore'),
            'twitter' => esc_html__('Twitter', 'tjcore'),
            'vimeo' => esc_html__('Vimeo', 'tjcore'),
            'vk' => esc_html__('VK', 'tjcore'),
            'website' => esc_html__('Website', 'tjcore'),
            'whatsapp' => esc_html__('WhatsApp', 'tjcore'),
            'wordpress' => esc_html__('WordPress', 'tjcore'),
            'xing' => esc_html__('Xing', 'tjcore'),
            'yelp' => esc_html__('Yelp', 'tjcore'),
            'youtube' => esc_html__('YouTube', 'tjcore'),
        ];
    }


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

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__('Social Profiles', 'tjcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Profile Name', 'tjcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'select2options' => [
                    'allowClear' => false,
                ],
                'options' => self::get_profile_names()
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Profile Link', 'tjcore'),
                'placeholder' => esc_html__('Add your profile link', 'tjcore'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'autocomplete' => false,
                'show_external' => false,
                'condition' => [
                    'name!' => 'email'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $this->add_control(
            'profiles',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                'default' => [
                    [
                        'link' => ['url' => 'https://facebook.com/'],
                        'name' => 'facebook'
                    ],
                    [
                        'link' => ['url' => 'https://linkedin.com/'],
                        'name' => 'linkedin'
                    ],
                    [
                        'link' => ['url' => 'https://twitter.com/'],
                        'name' => 'twitter'
                    ]
                ],
            ]
        );

        $this->add_control(
            'show_profiles',
            [
                'label' => esc_html__('Show Profiles', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'tjcore'),
                'label_off' => esc_html__('Hide', 'tjcore'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
                'style_transfer' => true,
            ]
        );


        $this->end_controls_section();


        // Skill
        $this->start_controls_section(
            'tj_progress_bar',
            [
                'label' => esc_html__('Skill Bar', 'tjcore'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Name', 'tjcore'),
                'default' => esc_html__('Design', 'tjcore'),
                'placeholder' => esc_html__('Type a skill name', 'tjcore'),
            ]
        );

        $repeater->add_control(
            'level',
            [
                'label' => esc_html__('Level (Out Of 100)', 'tjcore'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 95
                ],
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
        $repeater->add_control(
            'want_customize',
            [
                'label' => esc_html__('Want To Customize?', 'tjcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'tjcore'),
                'label_off' => esc_html__('No', 'tjcore'),
                'return_value' => 'yes',
                'description' => esc_html__('You can customize this skill bar color from here or customize from Style tab', 'tjcore'),
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'tjcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .title' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'percentage_color',
            [
                'label' => esc_html__('Percentage label Color', 'tjcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .percentage' => 'color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
                'style_transfer' => true,
            ]
        );


        $repeater->add_group_control(
            Group_Control_TJBGGradient::get_type(),
            [
                'name' => 'level_color',
                'label' => esc_html__('Level Color', 'tjcore'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .progress-bar',
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $repeater->add_control(
            'base_color',
            [
                'label' => esc_html__('Base Color', 'tjcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .progress' => 'background-color: {{VALUE}};',
                ],
                'condition' => ['want_customize' => 'yes'],
            ]
        );

        $this->add_control(
            'skills',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print((name || level.size) ? (name || "Skill") + " - " + level.size + level.unit : "Skill - 0%") #>',
                'default' => [
                    [
                        'name' => 'Design',
                        'level' => ['size' => 95, 'unit' => '%']
                    ],
                    [
                        'name' => 'UX',
                        'level' => ['size' => 85, 'unit' => '%']
                    ]
                ]
            ]
        );
        $this->add_control(
            'view',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Layout', 'tjcore'),
                'separator' => 'before',
                'default' => 'progress-bar--1',
                'options' => [
                    'progress-bar--2' => esc_html__('Thin', 'tjcore'),
                    'progress-bar--1' => esc_html__('Normal', 'tjcore'),
                    'progress-bar--3' => esc_html__('Bold', 'tjcore'),
                ],
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

        if (!empty($settings['tj_image']['url'])) {
            $tj_image = !empty($settings['tj_image']['id']) ? wp_get_attachment_image_url($settings['tj_image']['id'], $settings['tj_image_size_size']) : $settings['tj_image']['url'];
            $tj_image_alt = get_post_meta($settings["tj_image"]["id"], "_wp_attachment_image_alt", true);
        }
        $this->add_render_attribute('title_args', 'class', 'team-details-title text-uppercase mb-10');

?>

        <section class="volunteersSection">
            <div class="container">
                <div class="row">
                    <?php if ($settings['tj_image']['url'] || $settings['tj_image']['id']) : ?>
                        <div class="col-lg-5 col-md-6">
                            <div class="team-details-img">
                                <img src="<?php echo esc_url($tj_image); ?>" alt="<?php echo esc_attr($tj_image_alt); ?>">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-7 col-md-6">
                        <div class="team-details-content pt-40">

                            <?php if (!empty($settings['tj_section_title_show'])) : ?>
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
                                <?php if (!empty($settings['tj_sub_title'])) : ?>
                                    <span class="team-designation">
                                        <?php echo tj_kses($settings['tj_sub_title']); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                                    <div class="team-icon mt-15 mb-30">
                                        <?php
                                        foreach ($settings['profiles'] as $profile) :
                                            $icon = $profile['name'];
                                            $url = esc_url($profile['link']['url']);

                                            printf(
                                                '<a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a>',
                                                $url,
                                                esc_attr($profile['_id']),
                                                esc_attr($icon)
                                            );
                                        endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($settings['tj_desctiption'])) : ?>
                                    <p><?php echo tj_kses($settings['tj_desctiption']); ?></p>
                                <?php endif; ?>

                            <?php endif; ?>

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="featureBlock__donation__progress">
                                        <?php foreach ($settings['skills'] as $index => $skill) : ?>
                                            <div class="featureBlock__donation__bar mb-15 <?php echo esc_attr($settings['view']); ?> elementor-repeater-item-<?php echo $skill['_id']; ?>">
                                                <label><?php echo esc_html($skill['name']); ?></label>
                                                <span class="featureBlock__donation__text skill-bar" data-width="<?php echo esc_attr($skill['level']['size']); ?>%"><?php echo esc_attr($skill['level']['size']); ?>%</span>
                                                <div class="featureBlock__donation__line">
                                                    <span class="skill-bars">
                                                        <span class="skill-bars__line skill-bar" data-width="<?php echo esc_attr($skill['level']['size']); ?>%"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}

$widgets_manager->register(new TJ_Team_Details());
