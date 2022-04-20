<?php

/**
 * PHP version 7
 *
 * @category   Index_Page
 * @package    scistories
 * @subpackage scistories-index
 * @author      SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

get_header();
if (have_posts()) {
	the_post();
?>
	<!-- page content -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

<?php
}
get_footer();
