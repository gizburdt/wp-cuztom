<?php

/**
 * Cuztom Field Class
 *
 * @author Gijs Jorissen
 * @since 0.3.3
 *
 */
class Cuztom_Field
{
	var $id_name		= '';
	var $name 			= '';
    var $label 			= '';
    var $description 	= '';
	var $hide 			= true;
	var $default_value 	= '';
	var $options 		= array();
	var $repeatable 	= false;
	var $show_column 	= false;
	var $pre			= '';
	var $after			= '';
	var $meta_box		= '';
	var $output 		= '';
	
	
	function __construct( $field, $meta_box )
	{
		// Build array with defaults
		$field = self::_build_array( $field );
		
		// Set variables
		$this->name 			= $field['name'];
		$this->label			= $field['label'];
		$this->description		= $field['description'];
		$this->hide				= $field['hide'];
		$this->default_value	= $field['default_value'];
		$this->options			= $field['options'];
		$this->repeatable		= $field['repeatable'];
		$this->show_column		= $field['show_column'];
		$this->pre				= '';
		$this->after			= '';
		$this->meta_box			= $meta_box;
		
		$this->id_name 			= $this->_build_id_name( $this->name, $meta_box );
		
		$this->repeatable ? $this->generate_repeatable_output() : $this->generate_output();
	}
	
	
	/**
	 * Outputs a field based on its type
	 *
	 * @param string $field_id_name
	 * @param array $type
	 * @param array $meta
	 * @return mixed
	 *
	 * @author Gijs Jorissen
	 * @since 0.2
	 *
	 */
	function output()
	{
		echo $output;
	}
	
	
	/**
	 * Checks if the field supports repeatable functionality
	 *
	 * @param $field or $field_type
	 * @return boolean
	 *
	 * @author Gijs Jorissen
	 * @since 1.0
	 *
	 */
	function _supports_repeatable()
	{
		return in_array( $this->type, apply_filters( 'cuztom_supports_repeatable', array( 'text', 'textarea', 'select', 'post_select', 'term_select' ) ) );
	}
	
	
	/**
	 * Checks if the field supports bundle functionality
	 *
	 * @param $field or $field_type
	 * @return boolean
	 *
	 * @author Gijs Jorissen
	 * @since 1.2
	 *
	 */
	function _supports_bundle()
	{		
		return in_array( $this->type, apply_filters( 'cuztom_supports_bundle', array( 'text', 'textarea' ) ) );
	}
	
	
	/**
	 * Builds an string used as field id and name
	 *
	 * @param array $field
	 * @return string
	 *
	 * @author Gijs Jorissen
	 * @since 0.9
	 *
	 */
	function _build_id_name( $name, $meta_box )
	{		
		return apply_filters( 'cuztom_build_id_name', ( $this->hide ? '_' : '' ) . Cuztom::uglify( $meta_box ) . "_" . Cuztom::uglify( $name ) );
	}
	
	
	/**
	 * Builds an array of a field with all the arguments needed
	 *
	 * @param array $field
	 * @return array
	 *
	 * @author Gijs Jorissen
	 * @since 0.9
	 *
	 */
	static function _build_array( $field )
	{
		$field = array_merge(
		
			// Default
			array(
				'name'          => '',
	            'label'         => '',
	            'description'   => '',
	            'type'          => 'text',
				'hide'			=> true,
				'default_value'	=> '',
				'options'		=> array(),
				'repeatable'	=> false,
				'show_column'	=> false
			),
			
			// Given
			$field
		
		);
		
		return $field;
	}
}