<?php


/**
 * Common functions class.
 * PHP version 7
 *
 * @category   Functions
 * @package    scistories
 * @subpackage Functions
 * @author     SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

define('scistories_DIR', get_template_directory());
define('scistories_URL', get_template_directory_uri());
define('SS_PREFIX', 'ss_');

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

// include_once scistories_DIR . '/plugins/reusable-metaboxes/metaboxes/meta_box.php';
include_once scistories_DIR . '/classes/BootstrapMenu.php';
require_once scistories_DIR . '/classes/SciStoriesPage.php';
require_once scistories_DIR . '/classes/Scripts.php';
require_once scistories_DIR . '/classes/ThemeSupport.php';
require_once scistories_DIR . '/classes/PostType.php';
require_once scistories_DIR . '/classes/Customizer.php';
require_once scistories_DIR . '/classes/Publications.php';

/*Metaboxes*/
require_once scistories_DIR . '/metaboxes/GlobalMetaboxes.php';
//require_once scistories_DIR . '/metaboxes/team-metabox.php';

/*Custom posts metaboxes*/
require_once scistories_DIR . '/metaboxes/custom_posts/research-cpt-metabox.php';
