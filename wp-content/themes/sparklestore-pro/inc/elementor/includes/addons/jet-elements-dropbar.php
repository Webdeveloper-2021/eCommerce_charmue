<?php
/**
 * Class: Jet_Elements_Dropbar
 * Name: Dropbar
 * Slug: jet-dropbar
 */

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Jet_Elements_Dropbar extends Jet_Elements_Base {

	public function get_name() {
		return 'jet-dropbar';
	}

	public function get_title() {
		return esc_html__( 'Dropbar', 'sparklestore-pro' );
	}

	public function get_icon() {
		return 'jetelements-icon-42';
	}

	public function get_categories() {
		return array( 'cherry' );
	}

	protected function _register_controls() {
		$css_scheme = apply_filters(
			'jet-elements/dropbar/css-scheme',
			array(
				'dropbar'         => '.jet-dropbar',
				'inner'           => '.jet-dropbar__inner',
				'button'          => '.jet-dropbar__button',
				'button_icon'     => '.jet-dropbar__button-icon',
				'button_text'     => '.jet-dropbar__button-text',
				'content_wrapper' => '.jet-dropbar__content-wrapper',
				'content'         => '.jet-dropbar__content',
			)
		);

		/**
		 * `Dropbar` Section
		 */
		$this->start_controls_section(
			'section_dropbar_content',
			array(
				'label' => esc_html__( 'Dropbar', 'sparklestore-pro' ),
			)
		);

		$this->add_control(
			'button_heading',
			array(
				'label' => esc_html__( 'Button', 'sparklestore-pro' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => esc_html__( 'Text', 'sparklestore-pro' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Dropbar', 'sparklestore-pro' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_before_icon',
			array(
				'label' => esc_html__( 'Before icon', 'sparklestore-pro' ),
				'type'  => Controls_Manager::ICON,
			)
		);

		$this->add_control(
			'button_after_icon',
			array(
				'label' => esc_html__( 'After icon', 'sparklestore-pro' ),
				'type'  => Controls_Manager::ICON,
			)
		);

		$this->add_responsive_control(
			'button_align',
			array(
				'label' => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'  => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon' => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon' => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon' => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'sparklestore-pro' ),
						'icon' => 'fa fa-align-justify',
					),
				),
				'selectors_dictionary' => array(
					'left'    => 'margin-left: 0; margin-right: auto; width: auto;',
					'center'  => 'margin-left: auto; margin-right: auto; width: auto;',
					'right'   => 'margin-left: auto; margin-right: 0; width: auto;',
					'justify' => 'margin-left: 0; margin-right: 0; width: 100%;',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['inner'] => '{{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_heading',
			array(
				'label'     => esc_html__( 'Content', 'sparklestore-pro' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'content_type',
			array(
				'label'   => esc_html__( 'Content Type', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'simple',
				'toggle'  => false,
				'options' => array(
					'simple' => array(
						'title' => esc_html__( 'Simple Text', 'sparklestore-pro' ),
						'icon'  => 'fa fa-text-width',
					),
					'template' => array(
						'title' => esc_html__( 'Template', 'sparklestore-pro' ),
						'icon'  => 'fa fa-file',
					),
				),
			)
		);

		$this->add_control(
			'simple_content',
			array(
				'label'   => esc_html__( 'Simple Text', 'sparklestore-pro' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Dropbar Content', 'sparklestore-pro' ),
				'condition' => array(
					'content_type' => 'simple',
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$templates = jet_elements()->elementor()->templates_manager->get_source( 'local' )->get_items();

		$options = array(
			'0' => '— ' . esc_html__( 'Select', 'sparklestore-pro' ) . ' —',
		);

		$types = array();

		foreach ( $templates as $template ) {
			$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
			$types[ $template['template_id'] ] = $template['type'];
		}

		$this->add_control(
			'template_id',
			array(
				'label'       => esc_html__( 'Choose Template', 'sparklestore-pro' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => $options,
				'types'       => $types,
				'label_block' => 'true',
				'condition' => array(
					'content_type' => 'template',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * `Settings` Section
		 */
		$this->start_controls_section(
			'section_dropbar_settings',
			array(
				'label' => esc_html__( 'Settings', 'sparklestore-pro' ),
			)
		);

		$this->add_responsive_control(
			'position',
			array(
				'label'   => esc_html__( 'Position', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-left',
				'label_block' => true,
				'options' => array(
					'top-left'      => esc_html__( 'Top Left', 'sparklestore-pro' ),
					'top-center'    => esc_html__( 'Top Center', 'sparklestore-pro' ),
					'top-right'     => esc_html__( 'Top Right', 'sparklestore-pro' ),
					'bottom-left'   => esc_html__( 'Bottom Left', 'sparklestore-pro' ),
					'bottom-center' => esc_html__( 'Bottom Center', 'sparklestore-pro' ),
					'bottom-right'  => esc_html__( 'Bottom Right', 'sparklestore-pro' ),
					'left-top'      => esc_html__( 'Left Top', 'sparklestore-pro' ),
					'left-center'   => esc_html__( 'Left Center', 'sparklestore-pro' ),
					'left-bottom'   => esc_html__( 'Left Bottom', 'sparklestore-pro' ),
					'right-top'     => esc_html__( 'Right Top', 'sparklestore-pro' ),
					'right-center'  => esc_html__( 'Right Center', 'sparklestore-pro' ),
					'right-bottom'  => esc_html__( 'Right Bottom', 'sparklestore-pro' ),
				),
				'selectors_dictionary' => array(
					'top-left'      => 'top: auto; bottom: 100%; left: 0; right: auto; transform: none;',
					'top-center'    => 'top: auto; bottom: 100%; left: 50%; right: auto; transform: translateX(-50%);',
					'top-right'     => 'top: auto; bottom: 100%; left: auto; right: 0; transform: none;',

					'bottom-left'   => 'top: 100%; bottom: auto; left: 0; right: auto; transform: none;',
					'bottom-center' => 'top: 100%; bottom: auto; left: 50%; right: auto; transform: translateX(-50%);',
					'bottom-right'  => 'top: 100%; bottom: auto; left: auto; right: 0; transform: none;',

					'left-top'      => 'top: 0; bottom: auto; left: auto; right: 100%; transform: none;',
					'left-center'   => 'top: 50%; bottom: auto; left: auto; right: 100%; transform: translateY(-50%);',
					'left-bottom'   => 'top: auto; bottom: 0; left: auto; right: 100%; transform: none;',

					'right-top'     => 'top: 0; bottom: auto; left: 100%; right: auto; transform: none;',
					'right-center'  => 'top: 50%; bottom: auto; left: 100%; right: auto; transform: translateY(-50%);',
					'right-bottom'  => 'top: auto; bottom: 0; left: 100%; right: auto; transform: none;',
				),
				'prefix_class' => 'jet-dropbar%s-position-',
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['content_wrapper'] => '{{VALUE}}',
				),
			)
		);

		$this->add_control(
			'mode',
			array(
				'label'   => esc_html__( 'Mode', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => array(
					'hover' => esc_html__( 'Hover', 'sparklestore-pro' ),
					'click' => esc_html__( 'Click', 'sparklestore-pro' ),
				),
			)
		);

		$this->add_control(
			'hide_delay',
			array(
				'label'   => esc_html__( 'Hide Delay', 'sparklestore-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
				'min'     => 0,
				'max'     => 5000,
				'condition' => array(
					'mode' => 'hover',
				),
			)
		);

		$this->add_control(
			'show_effect',
			array(
				'label'   => esc_html__( 'Show Effect', 'sparklestore-pro' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'             => esc_html__( 'None', 'sparklestore-pro' ),
					'fade'             => esc_html__( 'Fade', 'sparklestore-pro' ),
					'zoom-in'          => esc_html__( 'Zoom In', 'sparklestore-pro' ),
					'zoom-out'         => esc_html__( 'Zoom Out', 'sparklestore-pro' ),
					'slide-up'         => esc_html__( 'Slide Up', 'sparklestore-pro' ),
					'slide-down'       => esc_html__( 'Slide Down', 'sparklestore-pro' ),
					'slide-left'       => esc_html__( 'Slide Left', 'sparklestore-pro' ),
					'slide-right'      => esc_html__( 'Slide Right', 'sparklestore-pro' ),
					'slide-up-big'     => esc_html__( 'Slide Up Big', 'sparklestore-pro' ),
					'slide-down-big'   => esc_html__( 'Slide Down Big', 'sparklestore-pro' ),
					'slide-left-big'   => esc_html__( 'Slide Left Big', 'sparklestore-pro' ),
					'slide-right-big'  => esc_html__( 'Slide Right Big', 'sparklestore-pro' ),
					'fall-perspective' => esc_html__( 'Fall Perspective', 'sparklestore-pro' ),
					'flip-in-x'        => esc_html__( 'Flip In X', 'sparklestore-pro' ),
					'flip-in-y'        => esc_html__( 'Flip In Y', 'sparklestore-pro' ),
				),
			)
		);

		$this->add_control(
			'offset',
			array(
				'label' => esc_html__( 'Offset', 'sparklestore-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default' => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors' => array(
					'{{WRAPPER}}[class*="jet-dropbar-position-top-"] ' . $css_scheme['content_wrapper']    => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
					'{{WRAPPER}}[class*="jet-dropbar-position-bottom-"] ' . $css_scheme['content_wrapper'] => 'margin: {{SIZE}}{{UNIT}} 0 0 0;',
					'{{WRAPPER}}[class*="jet-dropbar-position-left-"] ' . $css_scheme['content_wrapper']   => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
					'{{WRAPPER}}[class*="jet-dropbar-position-right-"] ' . $css_scheme['content_wrapper']  => 'margin: 0 0 0 {{SIZE}}{{UNIT}};',

					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-top-"] ' . $css_scheme['content_wrapper']    => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-bottom-"] ' . $css_scheme['content_wrapper'] => 'margin: {{SIZE}}{{UNIT}} 0 0 0;',
					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-left-"] ' . $css_scheme['content_wrapper']   => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-right-"] ' . $css_scheme['content_wrapper']  => 'margin: 0 0 0 {{SIZE}}{{UNIT}};',

					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-top-"] ' . $css_scheme['content_wrapper']    => 'margin: 0 0 {{SIZE}}{{UNIT}} 0;',
					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-bottom-"] ' . $css_scheme['content_wrapper'] => 'margin: {{SIZE}}{{UNIT}} 0 0 0;',
					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-left-"] ' . $css_scheme['content_wrapper']   => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;',
					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-right-"] ' . $css_scheme['content_wrapper']  => 'margin: 0 0 0 {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}[class*="jet-dropbar-position-top-"] ' . $css_scheme['content_wrapper'] . ':before'    => 'top: 100%; bottom: auto; left: 0; right: 0; height: {{SIZE}}{{UNIT}}; width: 100%;',
					'{{WRAPPER}}[class*="jet-dropbar-position-bottom-"] ' . $css_scheme['content_wrapper'] . ':before' => 'top: auto; bottom: 100%; left: 0; right: 0; height: {{SIZE}}{{UNIT}}; width: 100%;',
					'{{WRAPPER}}[class*="jet-dropbar-position-left-"] ' . $css_scheme['content_wrapper'] . ':before'   => 'top: 0; bottom: 0; left: 100%; right: auto; height: 100%; width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}[class*="jet-dropbar-position-right-"] ' . $css_scheme['content_wrapper'] . ':before'  => 'top: 0; bottom: 0; left: auto; right: 100%; height: 100%; width: {{SIZE}}{{UNIT}};',

					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-top-"] ' . $css_scheme['content_wrapper'] . ':before'    => 'top: 100%; bottom: auto; left: 0; right: 0; height: {{SIZE}}{{UNIT}}; width: 100%;',
					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-bottom-"] ' . $css_scheme['content_wrapper'] . ':before' => 'top: auto; bottom: 100%; left: 0; right: 0; height: {{SIZE}}{{UNIT}}; width: 100%;',
					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-left-"] ' . $css_scheme['content_wrapper'] . ':before'   => 'top: 0; bottom: 0; left: 100%; right: auto; height: 100%; width: {{SIZE}}{{UNIT}};',
					'(tablet){{WRAPPER}}[class*="jet-dropbar-tablet-position-right-"] ' . $css_scheme['content_wrapper'] . ':before'  => 'top: 0; bottom: 0; left: auto; right: 100%; height: 100%; width: {{SIZE}}{{UNIT}};',

					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-top-"] ' . $css_scheme['content_wrapper'] . ':before'    => 'top: 100%; bottom: auto; left: 0; right: 0; height: {{SIZE}}{{UNIT}}; width: 100%;',
					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-bottom-"] ' . $css_scheme['content_wrapper'] . ':before' => 'top: auto; bottom: 100%; left: 0; right: 0; height: {{SIZE}}{{UNIT}}; width: 100%;',
					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-left-"] ' . $css_scheme['content_wrapper'] . ':before'   => 'top: 0; bottom: 0; left: 100%; right: auto; height: 100%; width: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}}[class*="jet-dropbar-mobile-position-right-"] ' . $css_scheme['content_wrapper'] . ':before'  => 'top: 0; bottom: 0; left: auto; right: 100%; height: 100%; width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_width',
			array(
				'label' => esc_html__( 'Width', 'sparklestore-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range' => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['content_wrapper'] => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'fixed',
			array(
				'label'     => esc_html__( 'Fixed Layout', 'sparklestore-pro' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'fixed_position',
			array(
				'label' => esc_html__( 'Fixed Position', 'sparklestore-pro' ),
				'type'  => Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => array(
					'top-left'      => esc_html__( 'Top Left', 'sparklestore-pro' ),
					'top-center'    => esc_html__( 'Top Center', 'sparklestore-pro' ),
					'top-right'     => esc_html__( 'Top Right', 'sparklestore-pro' ),
					'center-left'   => esc_html__( 'Center Left', 'sparklestore-pro' ),
					'center-center' => esc_html__( 'Center Center', 'sparklestore-pro' ),
					'center-right'  => esc_html__( 'Center Right', 'sparklestore-pro' ),
					'bottom-left'   => esc_html__( 'Bottom Left', 'sparklestore-pro' ),
					'bottom-center' => esc_html__( 'Bottom Center', 'sparklestore-pro' ),
					'bottom-right'  => esc_html__( 'Bottom Right', 'sparklestore-pro' ),
				),
				'condition' => array(
					'fixed' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'fixed_gap',
			array(
				'label'      => esc_html__( 'Gap', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['dropbar'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' => array(
					'fixed' => 'yes',
				),
			)
		);

		$this->add_control(
			'fixed_z_index',
			array(
				'label' => esc_html__( 'Z-index', 'sparklestore-pro' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 0,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['dropbar'] => 'z-index: {{VALUE}};',
				),
				'condition' => array(
					'fixed' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * `Button` Style Section
		 */
		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => esc_html__( 'Button', 'sparklestore-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'selector' => '{{WRAPPER}} ' . $css_scheme['button_text'],
			)
		);
		
		$this->add_responsive_control(
			'button_icon_font_size',
			array(
				'label' => esc_html__( 'Icon Font Size', 'sparklestore-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['button_icon'] => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'button_before_icon',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'button_after_icon',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'button_icon_spacing',
			array(
				'label' => esc_html__( 'Icon Spacing', 'sparklestore-pro' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} ' . $css_scheme['button_icon'] . '--before:not(:only-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} ' . $css_scheme['button_icon'] . '--before:not(:only-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body:not(.rtl) {{WRAPPER}} ' . $css_scheme['button_icon'] . '--after:not(:only-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} ' . $css_scheme['button_icon'] . '--after:not(:only-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'button_before_icon',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'button_after_icon',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => esc_html__( 'Normal', 'sparklestore-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['button'],
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label' => esc_html__( 'Text Color', 'sparklestore-pro' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['button'] => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_icon_color',
			array(
				'label' => esc_html__( 'Icon Color', 'sparklestore-pro' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['button_icon'] => 'color: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'button_before_icon',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'button_after_icon',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['button'],
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => esc_html__( 'Hover', 'sparklestore-pro' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_background_hover',
				'selector' => '{{WRAPPER}} ' . $css_scheme['button'] . ':hover',
			)
		);

		$this->add_control(
			'button_color_hover',
			array(
				'label' => esc_html__( 'Text Color', 'sparklestore-pro' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['button'] . ':hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_icon_color_hover',
			array(
				'label' => esc_html__( 'Icon Color', 'sparklestore-pro' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['button'] . ':hover ' . $css_scheme['button_icon'] => 'color: {{VALUE}};',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'button_before_icon',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'button_after_icon',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label' => esc_html__( 'Border Color', 'sparklestore-pro' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['button'] . ':hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'button_border_border!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} ' . $css_scheme['button'] . ':hover',
			)
		);

		$this->add_control(
			'button_hover_animation',
			array(
				'label' => esc_html__( 'Hover Animation', 'sparklestore-pro' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} ' . $css_scheme['button'],
				'separator' => 'before',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['button'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['button'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * `Content` Style Section
		 */
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'sparklestore-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} ' . $css_scheme['content'],
			)
		);

		$this->add_responsive_control(
			'content_align',
			array(
				'label'   => esc_html__( 'Alignment', 'sparklestore-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => array(
					'left' => array(
						'title' => esc_html__( 'Left', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'sparklestore-pro' ),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['content'] => 'text-align: {{VALUE}};',
				),
			)
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'content_background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['content'],
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label' => esc_html__( 'Text Color', 'sparklestore-pro' ),
				'type'  => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['content'] => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'content_border',
				'selector' => '{{WRAPPER}} ' . $css_scheme['content'],
			)
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['content'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['content'],
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => esc_html__( 'Padding', 'sparklestore-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['content'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_z_index',
			array(
				'label' => esc_html__( 'Z-index', 'sparklestore-pro' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => 0,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['content_wrapper'] => 'z-index: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$this->__context = 'render';
		$this->__open_wrap();

		include $this->__get_global_template( 'index' );

		$this->__close_wrap();
	}

	public function get_dropbar_content() {
		$settings = $this->get_settings_for_display();
		$content  = '';

		$content_type = $settings['content_type'];

		switch ( $content_type ) :
			case 'simple':
				$content = $settings['simple_content'];
				break;

			case 'template':
				$template_id = $settings['template_id'];

				if ( '0' !== $template_id ) {
					$content = jet_elements()->elementor()->frontend->get_builder_content_for_display( $template_id );

					if ( jet_elements()->elementor()->editor->is_edit_mode() ) {
						$edit_url = add_query_arg(
							array(
								'elementor' => '',
							),
							get_permalink( $template_id )
						);

						$edit_link = sprintf( '<a class="jet-dropbar-edit-link" href="%s" title="%s" target="_blank"><i class="fa fa-pencil"></i></a>', esc_url( $edit_url ), esc_html__( 'Edit Template', 'sparklestore-pro' ) );

						$content .= $edit_link;
					}
				}

				break;

		endswitch;

		return $content;
	}

	public function get_dropbar_export_settings() {
		$settings = $this->get_settings_for_display();

		$allowed = apply_filters( 'jet-elements/dropbar/export-settings', array(
			'mode',
			'hide_delay',
		) );

		$result = array();

		foreach ( $allowed as $setting ) {
			$result[ $setting ] = isset( $settings[ $setting ] ) ? $settings[ $setting ] : false;
		}

		return json_encode( $result );
	}
}
