<?php

/**
 * Manage Custom Post Type
 * PHP version 7
 *
 * @category   Class
 * @package    scistories
 * @subpackage scistories-custom-posttype
 * @author      SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

if (!class_exists('scistories_Custom_Posttype')) {
	/**
	 * Class to manage Custom Post Type for scistories
	 */
	class scistories_Custom_Posttype
	{
		/**
		 * Add hooks and filters
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 */
		public static function init()
		{
			/* Adding Post Type */
			add_action('init', __CLASS__ . '::add_post_type');
			add_action('init', __CLASS__ . '::create_taxonomies');
		}

		/**
		 * Function to create add_post_type Post Type
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 */
		public static function add_post_type()
		{

			/* To create a team Post Type */
			register_post_type(
				'team',
				[
					'labels'       => [
						'name'          => __('Team', 'scistories'),
						'singular_name' => __('Team', 'scistories'),
					],
					'public'       => true,
					'show_in_rest' => true,
					'show_ui'      => true,
					'menu_icon'    => 'dashicons-groups',
					'supports'     => ['title', 'editor', 'thumbnail'],
				]
			);

			/* To create a careers Post Type */
			register_post_type(
				'research_areas',
				[
					'labels'       => [
						'name'          => __('Research', 'scistories'),
						'singular_name' => __('Research', 'scistories'),
					],
					'public'       => true,
					'show_in_rest' => true,
					'show_ui'      => true,
					'menu_icon'    => 'dashicons-id-alt',
					'supports'     => ['title', 'editor', 'thumbnail'],
				]
			);

			/* To create a publications Post Type */
			register_post_type(
				'publications',
				[
					'labels'       => [
						'name'          => __('Publications', 'scistories'),
						'singular_name' => __('Publications', 'scistories'),
					],
					'public'       => true,
					'show_in_rest' => true,
					'menu_icon'    => 'dashicons-text-page',
					'supports'     => ['title', 'editor', 'thumbnail'],
				]
			);
		}


		public static function create_taxonomies()
		{

			register_taxonomy('team-type', 'team', [
				'labels' => [
					'name' => __('Team Categories', SS_PREFIX),
					'singular_name'  => __('Team Categories', SS_PREFIX),
					'menu_name' => __('Team Categories', SS_PREFIX),
					'all_items' => __('All Team Members', SS_PREFIX),
					'add_new' => __('Add New', SS_PREFIX),
					'add_new_item' => __('Add New Team Member', SS_PREFIX),
					'edit_item' => __('Edit Team Member', SS_PREFIX),
					'new_item' => __('New Team Member', SS_PREFIX),
					'view_item' => __('View Team Member', SS_PREFIX),
					'search_items' => __('Search Team Members', SS_PREFIX),
					'not_found' => __('No Team Members found', SS_PREFIX),
					'not_found_in_trash' => __('No Team Members found in Trash', SS_PREFIX)
				],
				'hierarchical' => true,
				'show_in_rest' => true,
				'show_admin_column' => true
			]);
		}
	}

	/**
	 * Calling init function to activate hooks and filters.
	 */
	scistories_Custom_Posttype::init();
}
