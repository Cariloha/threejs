<?php

/**
 * Manage Theme support
 * PHP version 7
 *
 * @category   Class
 * @package    scistories
 * @subpackage scistories-theme-support
 * @author      SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

if (!class_exists('scistories_Theme_Support')) {
	/**
	 * Class to manage theme support for scistories
	 */
	class scistories_Theme_Support
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

			add_action('after_setup_theme', __CLASS__ . '::after_setup_theme');

			/* Add support for svg file */
			add_filter('upload_mimes', __CLASS__ . '::enable_svg_support', 10, 1);

			/* Add support for svg file in listing */
			add_filter('wp_check_filetype_and_ext', __CLASS__ . '::filetype_and_ext', 10, 4);
		}

		/**
		 * Function to handle after_setup_theme action
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 *
		 * @param Type $data file data.
		 * @param Type $file file.
		 * @param Type $filename type of file data.
		 * @param Type $mimes type of mime.
		 */
		public static function filetype_and_ext($data, $file, $filename, $mimes)
		{
			$filetype = wp_check_filetype($filename, $mimes);
			return array(
				'ext'             => $filetype['ext'],
				'type'            => $filetype['type'],
				'proper_filename' => $data['proper_filename'],
			);
		}

		/**
		 * Function to handle after_setup_theme action
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 *
		 * @param Type $mimes type of file type.
		 */
		public static function enable_svg_support($mimes)
		{
			$mimes['svg'] = 'image/svg';
			return $mimes;
		}

		/**
		 * Function to handle after_setup_theme action
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 */
		public static function after_setup_theme()
		{
			/* Add theme support for menu */
			add_theme_support('menus');

			/* Add theme support for title tag */
			add_theme_support('title-tag');

			/* Add theme support for Featured Image */
			add_theme_support('post-thumbnails');

			/* Add theme support for custom logo */
			add_theme_support('custom-logo');


			/* Register theme support for Menu Location */
			register_nav_menus(
				array(
					'primary_menu' => __('Primary Menu', 'scistories'),
				)
			);
		}
	}

	/**
	 * Calling init function to activate hooks and filters.
	 */
	scistories_Theme_Support::init();
}
