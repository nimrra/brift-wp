<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Image Box Carousel
 */
class Maxbizz_Image_Box_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'iiboxcarousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Image Box Carousel', 'maxbizz' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_maxbizz' ];
	}

	protected function register_controls() {

		//Content Image box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image Box', 'maxbizz' ),
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
					'{{WRAPPER}} .ot-image-box' => 'text-align: {{VALUE}};',
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'image_box',
			[
				'label' => __( 'Image', 'maxbizz' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'title_box',
			[
				'label' => __( 'Title', 'maxbizz' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Accounting & Finance',
			]
		);
		$repeater->add_control(
			'content_box',
			[
				'label' => __( 'Description', 'maxbizz' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => '10',
				'default' => 'A great corporate strategy combines five elements: a bold yet realistic ambition, a carefully considered portfolio.',
			]
		);
		$repeater->add_control(
			'link_box',
			[
				'label' => __( 'Link', 'maxbizz' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'maxbizz' ),
				'default' => [
					'url' => '#'
				],
			]
		);
		$this->add_control(
		    'image_boxes',
		    [
		        'label'       => '',
		        'type'        => Controls_Manager::REPEATER,
				'show_label'  => false,
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title_box}}}',
		    ]
		);
		
	    $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image_box_size', 
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);
		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h5',
			]
		);
		$this->add_control(
			'label_link',
			[
				'label' => 'Label Button',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Explore More', 'maxbizz' ),
				'label_block' => true
			]
		);

		$slides_show = range( 1, 10 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides To Show', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'maxbizz' ),
				] + $slides_show,
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'false',
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
		$this->add_responsive_control(
			'w_gaps',
			[
				'label' => __( 'Gap Width', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

		$this->end_controls_section();

		/***Style***/

		$this->start_controls_section(
			'style_content_section',
			[
				'label' => __( 'Content', 'maxbizz' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* gereral */
		$this->add_control(
			'heading_gereral',
			[
				'label' => __( 'Gereral', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'box_bg',
			[
				'label' => __( 'Background', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-image-box .content-box' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding Box', 'maxbizz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'radius_box',
			[
				'label' => __( 'Border Radius', 'maxbizz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .ot-image-box',
			]
		);

		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'maxbizz' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title-box' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-box a' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => __( 'Hover Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title-box a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .title-box',
			]
		);

		/* description */
		$this->add_control(
			'heading_des',
			[
				'label' => __( 'Description', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'des_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .content-box p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selector' => '{{WRAPPER}} .content-box p',
			]
		);

		/* button */
		$this->add_control(
			'heading_btn',
			[
				'label' => __( 'Button', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .link-box',
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_btn_style' );
		$this->start_controls_tab(
			'tab_btn_normal',
			[
				'label' => __( 'Normal', 'maxbizz' ),
				'condition' => [
					'label_link!' => '',
				],
			]
		);

		$this->add_control(
			'btn_bg_color',
			[
				'label' => __( 'Background Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .link-box' => 'background: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .link-box' => 'color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'btn_bcolor',
			[
				'label' => __( 'Border Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .link-box' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_btn_hover',
			[
				'label' => __( 'Hover', 'maxbizz' ),
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'hover_btn_bg_color',
			[
				'label' => __( 'Background Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .link-box:hover' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->add_control(
			'hover_btn_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .link-box:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'label_link!' => '',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'{{WRAPPER}} .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
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
		$this->add_render_attribute( 'heading', 'class', 'title-box' );
		?>
		<div class="image-box-carousel" data-loop="<?php echo $settings['loop']; ?>" data-auto="<?php echo $settings['autoplay']; ?>" data-time="<?php echo $settings['timeout']['size']; ?>" data-arrows="<?php echo $settings['arrows']; ?>" data-dots="<?php echo $settings['dots']; ?>" data-show="<?php echo $settings['tshow']; ?>" data-tshow="<?php echo esc_attr( $settings['tshow_tablet'] ); ?>" data-mshow="<?php echo esc_attr( $settings['tshow_mobile'] ); ?>" data-gaps="<?php echo esc_attr( $settings['w_gaps']['size'] ); ?>" data-tgaps="<?php echo esc_attr( $settings['w_gaps_tablet']['size'] ); ?>" data-mgaps="<?php echo $settings['w_gaps_mobile']['size']; ?>">
			<div class="owl-carousel owl-theme">
				<?php foreach ( $settings['image_boxes'] as $key => $boxes ) : 
					$photo_url = Group_Control_Image_Size::get_attachment_image_src( $boxes['image_box']['id'], 'image_box_size', $settings );
					$photo = '<img src="' . esc_url( $photo_url ) . '" alt="' . esc_attr( $boxes['title_box'] ) . '">';
					$tbox  = $boxes['title_box'];
					$tbox_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $tbox );

					if ( ! empty( $boxes['link_box']['url'] ) ) {
						$this->add_render_attribute( 'm_link' . $key, 'href', $boxes['link_box']['url'] );

						if ( $boxes['link_box']['is_external'] ) {
							$this->add_render_attribute( 'm_link' . $key, 'target', '_blank' );
						}

						if ( $boxes['link_box']['nofollow'] ) {
							$this->add_render_attribute( 'm_link' . $key, 'rel', 'nofollow' );
						}

						$photo = '<a ' .$this->get_render_attribute_string( 'm_link' . $key ). '>' .$photo. '</a>';
						$tbox_html = sprintf( '<%1$s %2$s><a ' .$this->get_render_attribute_string( 'm_link'. $key ). '>%3$s</a></%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $tbox );
					}
					$this->add_render_attribute( 'm_link'. $key, 'class', 'link-box font-second' );
				?>
				<div class="ot-image-box">
					<?php if( $boxes['image_box']['url'] ) { echo $photo; } ?>
					<div class="content-box">
						<?php if( $boxes['title_box'] ) { echo $tbox_html; } ?>
						<?php if( $boxes['content_box'] ) { echo '<p>' .$boxes['content_box']. '</p>'; } ?>
					</div>
					<?php if( $settings['label_link'] && $boxes['link_box']['url'] !== '' ){ echo '<a ' .$this->get_render_attribute_string( 'm_link'. $key ). '><span>' .$settings['label_link']. '</span><i class="ot-flaticon-trajectory"></i></a>'; } ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>

	    <?php
	}

	public function get_keywords() {
		return [ 'service' ];
	}
}
// After the Maxbizz_Image_Box_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Maxbizz_Image_Box_Carousel() );