<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Testimonial Carousel 2
 */
class Maxbizz_Testimonials2 extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'itestimonials2';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Testimonial Carousel 2', 'maxbizz' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-testimonial-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_maxbizz' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'maxbizz' ),
			]
		);
		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'maxbizz' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'maxbizz' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'maxbizz' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'maxbizz' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials' => 'text-align: {{VALUE}};',
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'timage',
			[
				'label' => __( 'Avatar:', 'maxbizz' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => get_template_directory_uri().'/images/avatar-1.png',
				]
			]
		);

		$repeater->add_control(
			'tname',
			[
				'label' => __( 'Name:', 'maxbizz' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Emilia Clarke',
			]
		);

		$repeater->add_control(
			'tjob',
			[
				'label' => __( 'Job:', 'maxbizz' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Developer',
			]
		);
		$repeater->add_control(
			'tcontent',
			[
				'label' => __( 'Content:', 'maxbizz' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."',
			]
		);

		$this->add_control(
		    'testi_slider',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => false,
		        'default'     => [
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'maxbizz' ),
		                'timage'  => [
							'url' => get_template_directory_uri().'/images/avatar-1.png',
						],
						'tname'	  => 'Oliver Simson',
						'tjob'	  => 'Developer'
		 
		            ],
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'maxbizz' ),
		                'timage'  => [
							'url' => get_template_directory_uri().'/images/avatar-1.png',
						],
						'tname'	  => 'Mary Grey',
						'tjob'	  => 'Manager'
		 
		            ],
		            [
		             	'tcontent' => __( '"I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment."', 'maxbizz' ),
		                'timage'  => [
							'url' => get_template_directory_uri().'/images/avatar-1.png',
						],
						'tname'	  => 'Samanta Fox',
						'tjob'	  => 'Designer'
		 
		            ]
		            
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{tname}}}',
		    ]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'true' => __( 'Yes', 'maxbizz' ),
					'false' => __( 'No', 'maxbizz' ),
				]
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => __( 'Yes', 'maxbizz' ),
					'false' => __( 'No', 'maxbizz' ),
				]
			]
		);
		$this->add_control(
			'timeout',
			[
				'label' => __( 'Autoplay Timeout', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 1000,
						'max'  => 20000,
						'step' => 1000,
					],
				],
				'default' => [
					'size' => 7000,
				],
				'condition' => [
					'autoplay' => 'true',
				]
			]
		);
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Arrows', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true'   => __( 'Yes', 'maxbizz' ),
					'false'  => __( 'No', 'maxbizz' ),
				],
			]
		);
		$this->add_control(
			'arrow_align',
			[
				'label' => __( 'Arrows Align', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'middle'   => __( 'Middle', 'maxbizz' ),
					'bottom'   => __( 'Bottom', 'maxbizz' ),
				],
				'default' => 'middle',
				'prefix_class' => 'arrows-',
				'condition' => [
					'arrows' => 'true',
				],
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true'   => __( 'Yes', 'maxbizz' ),
					'false'  => __( 'No', 'maxbizz' ),
				],
			]
		);
		$this->add_control(
			'dots_style',
			[
				'label' => __( 'Dots Style', 'maxbizz' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'vertical'   => [
						'title' => esc_html__( 'Vertical', 'maxbizz' ),
						'icon'  => 'fa fa-ellipsis-v',
					],
					'horizontal' => [
						'title' => esc_html__( 'Horizontal', 'maxbizz' ),
						'icon'  => 'fa fa-ellipsis-h',
					],
				],
				'default'      => 'horizontal',
				'prefix_class' => 'dots-',
				'condition' => [
					'dots' => 'true',
				],
			]
		);

		$this->end_controls_section();

		// Styling.
		$this->start_controls_section(
			'style_general',
			[
				'label' => __( 'General', 'maxbizz' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tcontent_color',
			[
				'label' => __( 'Text Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials .ttext' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials .ttext',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_tinfo',
			[
				'label' => __( 'Information', 'maxbizz' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		/* image */
		$this->add_control(
			'style_timage',
			[
				'label' => __( 'Photo', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'spacing_img',
			[
				'label' => __( 'Spacing', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials .tphoto' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'maxbizz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quote_color',
			[
				'label' => __( 'Icon Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials .tphoto:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'quote_bg',
			[
				'label' => __( 'Icon Background', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials .tphoto:after' => 'background: {{VALUE}};',
				],
			]
		);

		/* name */
		$this->add_control(
			'style_tname',
			[
				'label' => __( 'Name', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'spacing_name',
			[
				'label' => __( 'Spacing', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials h6' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials h6',
			]
		);		

		/* job */
		$this->add_control(
			'style_tjob',
			[
				'label' => __( 'Job', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[
				'label' => __( 'Text Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-testimonials span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'job_typography',
				'selector' => '{{WRAPPER}} .ot-testimonials span',
			]
		);		

		$this->end_controls_section();

		// Dots.
		$this->start_controls_section(
			'navigation_section',
			[
				'label' => __( 'Dots', 'maxbizz' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots' => 'true',
				],
			]
		);

		$this->add_responsive_control(
			'dots_spacing',
			[
				'label' => __( 'Spacing', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.dots-horizontal .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.dots-vertical .owl-dots' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dots_bgcolor',
            [
                'label' => __( 'Color', 'maxbizz' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots button.owl-dot span' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->add_control(
            'dots_active_bgcolor',
            [
                'label' => __( 'Color Active', 'maxbizz' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .owl-dots button.owl-dot.active span' => 'background: {{VALUE}};',
				],
            ]
        );

        $this->end_controls_section();

        // Arrows.
		$this->start_controls_section(
			'style_nav',
			[
				'label' => __( 'Arrows', 'maxbizz' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'arrows' => 'true',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_spacing',
			[
				'label' => __( 'Spacing', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.arrows-bottom .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_width',
			[
				'label' => __( 'Width', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 30,
						'max' => 70,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __( 'Background', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_hcolor',
			[
				'label' => __( 'Color Hover', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'arrow_bg_hcolor',
			[
				'label' => __( 'Background Hover', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .owl-nav button:hover' => 'background: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'radius_arrow',
			[
				'label' => __( 'Border Radius', 'maxbizz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="ot-testimonials ot-testimonials-carousel-2" data-loop="<?php echo $settings['loop']; ?>" data-auto="<?php echo $settings['autoplay']; ?>" data-time="<?php echo $settings['timeout']['size']; ?>" data-arrows="<?php echo $settings['arrows']; ?>" data-dots="<?php echo $settings['dots']; ?>">
			<div class="owl-carousel owl-theme">
				<?php if ( ! empty( $settings['testi_slider'] ) ) : foreach ( $settings['testi_slider'] as $testi ) : ?>
				<div class="testi-item">
					<?php if($testi['timage']['url']) { ?>
						<div class="tphoto"><img src="<?php echo $testi['timage']['url']; ?>" alt="<?php echo $testi['tname']; ?>"></div>
					<?php } ?>
					<?php if($testi['tcontent']) { echo '<div class="ttext">' .$testi['tcontent']. '</div>'; } ?>			
					<div class="t-head">
						<div class="tinfo">
							<?php if($testi['tname']) { echo '<h6>' .$testi['tname']. '</h6>'; } ?>
							<?php if($testi['tjob']) { echo '<span>' .$testi['tjob']. '</span>'; } ?>
						</div>
					</div>
				</div>
				<?php endforeach; endif; ?>
			</div>				
	    </div>

	    <?php
	}

	public function get_keywords() {
		return [ 'slider', 'says', 'quote' ];
	}
}
// After the Schedule class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Maxbizz_Testimonials2() );