<?php

/**
 * Manage Scripts
 * PHP version 7
 *
 * @category   Class
 * @package    scistories
 * @subpackage scistories-scripts
 * @author     SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

if (!class_exists('scistoriesScripts')) {
	/**
	 * Class to manage scripts for scistories
	 */
	class scistoriesScripts
	{
		const BOOTSTRAP_CDN_VERSION    = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css";
		const BOOTSTRAP_WITH_POPPER = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js";
		const FONTAWESOME_CDN_VERSION = "https://use.fontawesome.com/releases/v5.2.0/css/all.css";
		const THREEJS_CND = "https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js";
		/**
		 * Add hooks and filters
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 */
		public static function init()
		{
			add_action('wp_enqueue_scripts', __CLASS__ . '::wp_enqueue_scripts');
			// add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_enqueue_scripts' );
		}

		/**
		 * Function to handle wp_enqueue_scripts action
		 *
		 * @since  1.0
		 * @static
		 * @access public
		 */

		public static function wp_enqueue_scripts()
		{

			wp_enqueue_style('bootstrap', self::BOOTSTRAP_CDN_VERSION);
			wp_enqueue_style('scistories-style', get_stylesheet_uri(), array(), filemtime(scistories_DIR . '/style.css'));
			wp_enqueue_style('font-awesome', self::FONTAWESOME_CDN_VERSION);


			wp_enqueue_script('jquery', '', array(), true);
			wp_enqueue_script('bootstrap-popper', self::BOOTSTRAP_WITH_POPPER, array(), '', true);
			wp_enqueue_script('threejs', self::THREEJS_CND, array(), '', true);
			wp_enqueue_script('animation', scistories_URL . '/animation/js/script.js', array('jquery'), filemtime(scistories_DIR) . '/animation/js/script.js', true);
			wp_enqueue_script('scistories', scistories_URL . '/js/scistories.js', array('jquery'), filemtime(scistories_DIR) . '/js/scistories.js', true);

			wp_localize_script(
				'scistories',
				'wp_ajax',
				array(
					'ajax_url'   => admin_url('admin-ajax.php')
				)
			);
		}
	}

	/**
	 * Calling init function to activate hooks and filters.
	 */
	scistoriesScripts::init();
}
