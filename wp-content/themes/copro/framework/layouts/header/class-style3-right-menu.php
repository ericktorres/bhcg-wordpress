<?php
/**
 *
 * Class used to call layout template part to be displayed.
 *
 * @package   IvanFramework
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 * @version 1.0
 * @since 1.0
 */

class Ivan_Layout_Header_Style3_Right_Menu extends Ivan_Layout  {

	// Layout slug used as parameters to actions and filters
	public $slug = '_style3_right_menu';

	public function return_template_path() {
		return 'style3-right-menu';
	}

	/**
	 * Initialize the layout defining actions, filters and any necessary function/task
	 *
	 * @since     1.0.0
	 */
	public function __construct() {

		/* Actions and Filters */
		add_action( 'ivan_header', array( $this, 'display' ), 20 );
		//add_filter( '@TODO', array( $this, 'filter_method_name' ) );

	}

	/**
	 * Calls the respective template part or markup that must be displayed
	 *
	 * @since     1.0.0
	 */
	public function display() {

		get_template_part( 'framework/templates/header/part', apply_filters('ivan_header_get_template', 'style3-right-menu') );
		
	}
}