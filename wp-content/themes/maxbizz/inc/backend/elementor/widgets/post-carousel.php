<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Post Carousel
 */
class Maxbizz_Post_Carousel extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ipostcarousel';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Post Carousel', 'maxbizz' );
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

		//Content
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Posts', 'maxbizz' ),
			]
		);
		$this->add_control(
			'post_cat',
			[
				'label' => __( 'Select Categories', 'maxbizz' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->select_param_cate_post(),
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __( 'All Categories', 'maxbizz' ),
			]
		);
		$this->add_control(
			'post_num',
			[
				'label' => __( 'Show Number Posts', 'maxbizz' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '6',
			]
		);	
		$this->add_control(
			'exc',
			[
				'label' => esc_html__( 'Excerpt Length', 'theratio' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0',
			]
		);
		$this->add_control(
			'post_thumbnail',
			[
				'label' => __( 'Thumbnail Image Size', 'onum' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'maxbizz-post-thumbnail-grid',
				'options' => [
					'maxbizz-post-thumbnail-grid' => __( 'Default', 'onum' ),
					'full' => __( 'Full', 'onum' ),
				],
			]
		);
		$this->add_control(
			'heading_slider',
			[
				'label' => __( 'Slider', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$slides_show = range( 1, 4 );
		$slides_show = array_combine( $slides_show, $slides_show );

		$this->add_responsive_control(
			'tshow',
			[
				'label' => __( 'Slides to Show', 'maxbizz' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'Default', 'maxbizz' ),
				] + $slides_show,
				'default' => ''
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
				'default' => 'false',
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

		$this->start_controls_section(
			'posts_style',
			[
				'label' => __( 'Post Items', 'maxbizz' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_general',
			[
				'label' => __( 'General', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'radius_box',
			[
				'label' => __( 'Border Radius', 'maxbizz' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .post-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'item_bg',
			[
				'label' => __( 'Background', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-inner' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_box_shadow',
				'selector' => '{{WRAPPER}} .post-inner',
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
			'title_spacing',
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
					'{{WRAPPER}} .post-box h5' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .post-box h5 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .post-box h5 a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-box h5 a',
			]
		);

		/* excerpt */
		$this->add_control(
			'heading_excerpt',
			[
				'label' => __( 'Excerpt', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .the-excerpt' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .post-box .the-excerpt',
			]
		);

		/* category */
		$this->add_control(
			'heading_cat',
			[
				'label' => __( 'Category', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_cat',
			[
				'label' => __( 'Show Category', 'maxbizz' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'maxbizz' ),
				'label_off' => __( 'Hide', 'maxbizz' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'cat_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-cat a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);
		$this->add_control(
			'cat_bg',
			[
				'label' => __( 'Background', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .post-cat a' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'selector' => '{{WRAPPER}} .post-box .post-cat a',
				'condition' => [
					'show_cat' => 'yes',
				]
			]
		);

		/* meta */
		$this->add_control(
			'heading_meta',
			[
				'label' => __( 'Meta', 'maxbizz' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta, {{WRAPPER}} .post-box .entry-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'meta_hover_color',
			[
				'label' => __( 'Hover Color', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .post-box .btn-details:hover' => 'border-color: {{VALUE}}; background: transparent;',
				],
			]
		);
		$this->add_control(
			'meta_bg',
			[
				'label' => __( 'Background', 'maxbizz' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .post-box .entry-meta' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'selector' => '{{WRAPPER}} .post-box .entry-meta',
				
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

        // Arrow.
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
		?>

		<div class="post-slider" data-loop="<?php echo $settings['loop']; ?>" data-auto="<?php echo $settings['autoplay']; ?>" data-time="<?php echo $settings['timeout']['size']; ?>" data-arrows="<?php echo $settings['arrows']; ?>" data-dots="<?php echo $settings['dots']; ?>" data-show="<?php echo $settings['tshow']; ?>" data-tshow="<?php echo esc_attr( $settings['tshow_tablet'] ); ?>" data-mshow="<?php echo esc_attr( $settings['tshow_mobile'] ); ?>" data-gaps="<?php echo esc_attr( $settings['w_gaps']['size'] ); ?>" data-tgaps="<?php echo esc_attr( $settings['w_gaps_tablet']['size'] ); ?>" data-mgaps="<?php echo $settings['w_gaps_mobile']['size']; ?>">
			<div class="owl-carousel owl-theme">
	        <?php
	        	$number_show = (!empty($settings['post_num']) ? $settings['post_num'] : 9);

	        	if( $settings['post_cat'] ){
	                $args = array(
			            'post_type' => 'post',
			            'post_status' => 'publish',
			            'posts_per_page' => $number_show,
			            'tax_query' => array(
					        array(
					            'taxonomy' => 'category',
					            'field'    => 'slug',
					            'terms'    => $settings['post_cat']
					        ),
					    ),
			        );
	            }else{
	                $args = array(
	                    'post_type' => 'post',
			            'post_status' => 'publish',
			            'posts_per_page' => $number_show,
	                );
	            }

		        $blogpost = new \WP_Query($args);
				if($blogpost->have_posts()) : while($blogpost->have_posts()) : $blogpost->the_post(); ?> 
				
					<article id="post-<?php the_ID(); ?>" <?php post_class('post-box'); ?>>
						<div class="post-inner">

							<?php if ( has_post_thumbnail() ) { ?>
								<div class="entry-media">
									<?php if( $settings['show_cat'] ) { maxbizz_posted_in(); } ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail($settings['post_thumbnail']); ?>
									</a>
								</div>
							<?php } ?>

							<div class="inner-post">
								<?php if( !has_post_thumbnail() && $settings['show_cat'] ) maxbizz_posted_in(); ?>
								<div class="entry-header">

									<?php the_title( '<h5 class="entry-title"><a class="title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>

								</div>

								<?php if( $settings['exc'] ) { echo '<div class="entry-summary the-excerpt">' .maxbizz_excerpt($settings['exc']). '...</div>'; } ?>
							</div>
							<div class="entry-meta">
								<?php if( maxbizz_get_option( 'post_entry_meta' ) ) { maxbizz_post_meta(); } ?>
								<a href="<?php the_permalink(); ?>" class="btn-details"><i class="ot-flaticon-trajectory"></i></a>
							</div>

						</div>
					</article>

		        <?php endwhile; wp_reset_postdata(); endif; ?>
		    </div>
	    </div>
		<?php
	}

	protected function select_param_cate_post() {
		$args = array( 'orderby=name&order=ASC&hide_empty=0' );
		$terms = get_terms( 'category', $args );
		$cat = array();
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){		    
		    foreach ( $terms as $term ) {
		        $cat[$term->slug] = $term->name;
		    }
		}
	  	return $cat;
	}
}
// After the Maxbizz_Post_Carousel class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register_widget_type( new Maxbizz_Post_Carousel() );