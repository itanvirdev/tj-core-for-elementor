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
class TJ_Contact_Info extends Widget_Base {

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
        return 'contact-info';
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
        return __('Contact Info', 'tjcore');
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


    protected static function get_profile_names() {
        return [
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

        // Service group
        $this->start_controls_section(
            '_TJ_contact_info',
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
                    'default' => 'fa fa-star',
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
            'tj_title',
            [
                'label' => esc_html__('Title', 'tjcore'),
                'description' => tj_get_allowed_html_desc('basic'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'tjcore'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tj_description',
            [
                'label' => esc_html__('Description', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tj_contact_link',
            [
                'label' => esc_html__('Description CTA', 'tjcore'),
                'description' => tj_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Phone and Email',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tj_list',
            [
                'label' => esc_html__('Services - List', 'tjcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tj_title' => esc_html__('united states', 'tjcore'),
                    ],
                    [
                        'tj_title' => esc_html__('south Africa', 'tjcore')
                    ],
                    [
                        'tj_title' => esc_html__('United Kingdom', 'tjcore')
                    ]
                ],
                'title_field' => '{{{ tj_title }}}',
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


        <div class="contact__info white-bg p-relative z-index-1">
            <div class="contact__info-inner white-bg">
                <ul>
                    <?php foreach ($settings['tj_list'] as $item) : ?>
                        <li>
                            <div class="contact__info-item d-flex align-items-start mb-35">
                                <div class="contact__info-icon mr-15">
                                    <?php if ($item['tj_features_icon_type'] !== 'image') : ?>
                                        <?php if (!empty($item['tj_features_icon']) || !empty($item['tj_features_selected_icon']['value'])) : ?>
                                            <span class="contact_info_icon"><?php tj_render_icon($item, 'tj_features_icon', 'tj_features_selected_icon'); ?></span>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <span class="contact_info_icon">
                                            <?php if (!empty($item['tj_features_image']['url'])) : ?>
                                                <img src="<?php echo $item['tj_features_image']['url']; ?>" alt="<?php echo get_post_meta(attachment_url_to_postid($item['tj_features_image']['url']), '_wp_attachment_image_alt', true); ?>">
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="contact__info-text">
                                    <h4><?php echo tj_kses($item['tj_title']); ?></h4>
                                    <?php if (!empty($item['tj_description'])) : ?>
                                        <p><?php echo tj_kses($item['tj_description']); ?></p>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>


                <?php if ($settings['show_profiles'] && is_array($settings['profiles'])) : ?>
                    <div class="contact__social pl-30">
                        <h4><?php echo esc_html__('Follow Us', 'tjcore'); ?></h4>
                        <ul>
                            <?php
                            foreach ($settings['profiles'] as $profile) :
                                $icon = $profile['name'];
                                $url = esc_url($profile['link']['url']);

                                printf(
                                    '<li><a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a></li>',
                                    $url,
                                    esc_attr($profile['_id']),
                                    esc_attr($icon)
                                );
                            endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>

<?php
    }
}

$widgets_manager->register(new TJ_Contact_Info());
