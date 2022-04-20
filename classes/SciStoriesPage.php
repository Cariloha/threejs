<?php

/**
 * Manage scistories page content
 * PHP version 7
 *
 * @category   Class
 * @package    scistories
 * @subpackage SciStoriesPage
 * @author     SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

class SciStoriesPage
{

	public static function page_get_id($page_slug)
	{

		$page = get_page_by_path($page_slug);

		if ($page) {
			return $page->ID;
		} else {

			return null;
		}
	}

	public static function createOptionsArray($post_type)
	{
		$post_query = SciStoriesPage::getPosts($post_type, -1);
		$post_options = [];
		if ($post_query->have_posts()) {
			while ($post_query->have_posts()) {
				$post_query->the_post();
				$post_options[get_the_id()] = html_entity_decode(get_the_title(), ENT_QUOTES | ENT_SUBSTITUTE);
			}
		}
		return $post_options;
	}

	public static function getMeta($postId, $tempKey)
	{
		$key = SS_PREFIX . $tempKey;
		return get_post_meta($postId, $key, true);
	}

	public static function printBannerImage($postId, $key, $size = "full")
	{
		$postMetaKey = get_post_meta($postId, $key, true);
		return wp_get_attachment_url($postMetaKey, true, $size);
	}

	public static function printMetaImg($key, $size = "thumbnail")
	{
		return wp_get_attachment_image_url($key, $size);
	}

	public static function getPublicationYears()
	{
		global $wpdb;
		$sql = $wpdb->prepare("SELECT DISTINCT (YEAR(post_date)) AS year FROM {$wpdb->prefix}posts WHERE post_status = %s AND post_type = %s ORDER BY 1 DESC", 'publish', 'publication');
		return $wpdb->get_results($sql);
	}

	public static function getPublicationFromYear($year)
	{
		$args = [
			'post_type' => 'publication',
			'orderby'   => 'post_date',
			'order'     => 'ASC',
			'date_query' => [
				'year' => (int)$year
			],
		];
		return new WP_Query($args);
	}

	public static function getPosts($post_type, $posts_per_page)
	{
		$args = array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'order_by'       => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $posts_per_page,
		);
		return new WP_Query($args);
	}

	public static function getPostsByCategory($post_type, $taxonomy, $slug)
	{
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $slug
				)
			)
		);

		return new WP_Query($args);
	}

	public static function getChosenPosts(array $chosenIds, $metaboxId)
	{
		$args = [
			'post_type' => $metaboxId,
			'post__in'  => $chosenIds,
		];
		$postsChosen = new WP_Query($args);
		if (!$postsChosen) {
			$postsChosen = [];
		}
		return $postsChosen;
	}

	public static function getRepeatable($postId, $repeatableName)
	{
		$values = self::getMeta($postId, $repeatableName, true) ?? [];
		return $values;
	}

	public static function getTermById($id)
	{
		global $wpdb;
		$query = "SELECT wp_terms.* FROM wp_terms WHERE wp_terms.term_id = $id ";
		$results = $wpdb->get_results($query) ?? false;
		return $results;
	}
}
