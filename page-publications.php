<?php

/**
 * Template Name: Publications Page
 * PHP version 7
 *
 * @category   Page_Template
 * @package    scistories
 * @subpackage scistories-page-publications
 * @author      SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

get_header();
if (have_posts()) {
    the_post();

    $header_video_id = carbon_get_post_meta(get_the_ID(), 'crb_header_video');
    $header_video_url = wp_get_attachment_url($header_video_id);

?>

    <header class="header-pages">
        <video playsinline autoplay muted loop id="bgvid">
            <source src="<?php echo $header_video_url ?>" type="video/mp4">
        </video>
        <div class="container h-100 viewport-header">
            <div class="bannertext">
                <h1><?php echo carbon_get_post_meta(get_the_ID(), 'crb_header_title'); ?></h1>
            </div>

        </div>

    </header>

    <!----Publications---->

    <div class="container">
        <div class="row filter-drop-content">
            <div class="col-12 col-md-3 publication-filter-txt">
                <h3>FILTER BY</h3>
            </div>
            <?php

            $publication_param = array(
                'posts_per_page' => -1,
                'post_type'      => array('publications'),
                'post_status '      => 'publish',
                // 'field'         => 'ids',
            );

            $qry_publications = new WP_Query($publication_param);
            // var_dump($qry_publications);

            $total_record = $qry_publications->found_posts;

            $authors_array = [];
            $technologies_array = [];
            $research_array = [];

            if ($qry_publications->have_posts()) {
                while ($qry_publications->have_posts()) {
                    $qry_publications->the_post();

                    $meta_content = get_post_meta(get_the_ID());

                    $pub_tech_id = Publications::get_carbon_values('crb_publication_tech', $meta_content);
                    foreach ($pub_tech_id as $technology) {
                        if (!in_array($technology, $technologies_array)) {
                            $technologies_array[] = $technology;
                        }
                    }

                    $pub_research_id = Publications::get_carbon_values('crb_publication_research', $meta_content);
                    foreach ($pub_research_id as $research) {
                        if (!in_array($research, $research_array)) {
                            $research_array[] = $research;
                        }
                    }

                    $pub_authors_id = Publications::get_carbon_values('crb_publication_authors', $meta_content);
                    foreach ($pub_authors_id as $author) {
                        if (!in_array($author, $authors_array)) {
                            $authors_array[] = $author;
                        }
                    }
                }
            }
            wp_reset_postdata();

            $pub_authors = SciStoriesPage::getChosenPosts($authors_array, 'members');
            $pub_tech = SciStoriesPage::getChosenPosts($technologies_array, 'technology');
            $pub_research = SciStoriesPage::getChosenPosts($research_array, 'research_areas');
            ?>

            <div class="col-12 col-md-3 publication-filter-dropdown">
                <form data-js-form="filter">
                    <fieldset class="select-box-svg t-neutral">

                        <input type="hidden" name="action" value="filter">
                        <div class="select-box-svg__inner">
                            <select class="select-box-svg__select" name="technology" id="technology" data-container="body">
                                <option value="">
                                    - Technology -
                                </option>

                                <?php
                                if ($pub_tech->have_posts()) {
                                    while ($pub_tech->have_posts()) {
                                        $pub_tech->the_post();
                                ?>
                                        <option value="<?php echo get_the_ID(); ?>">
                                            <?php the_title(); ?>
                                        </option>
                                <?php
                                    }
                                };
                                ?>
                            </select>
                            <svg role="presentation" class="icon icon--arrow" width="42px" height="60px" viewBox="-458 261.7 41.8 38.3">
                                <rect x="-458" y="261.4" class="icon__box" width="42" height="60" />
                                <polygon class="icon__caret" points="-432.9,281.4 -437.1,286.4 -441.3,281.4 " />
                            </svg>
                        </div>


                    </fieldset>
                </form>
            </div>

            <div class="col-12 col-md-3 publication-filter-dropdown">
                <form data-js-form="filter">
                    <fieldset class="select-box-svg t-neutral">

                        <input type="hidden" name="action" value="filter">
                        <div class="select-box-svg__inner">
                            <select class="select-box-svg__select" name="research-areas" id="research-areas" data-container="body">
                                <option value="">
                                    - Research Areas -
                                </option>

                                <?php
                                if ($pub_research->have_posts()) {
                                    while ($pub_research->have_posts()) {
                                        $pub_research->the_post();
                                ?>
                                        <option value="<?php echo get_the_ID(); ?>">
                                            <?php the_title(); ?>
                                        </option>
                                <?php
                                    }
                                };
                                ?>
                            </select>
                            <svg role="presentation" class="icon icon--arrow" width="42px" height="60px" viewBox="-458 261.7 41.8 38.3">
                                <rect x="-458" y="261.4" class="icon__box" width="42" height="60" />
                                <polygon class="icon__caret" points="-432.9,281.4 -437.1,286.4 -441.3,281.4 " />
                            </svg>
                        </div>


                    </fieldset>
                </form>
            </div>

            <div class="col-12 col-md-3 publication-filter-dropdown">
                <form data-js-form="filter">
                    <fieldset class="select-box-svg t-neutral">

                        <input type="hidden" name="action" value="filter">
                        <div class="select-box-svg__inner">
                            <select class="select-box-svg__select" name="members" id="members" data-container="body">
                                <option value="">
                                    - Authors -
                                </option>

                                <?php
                                if ($pub_authors->have_posts()) {
                                    while ($pub_authors->have_posts()) {
                                        $pub_authors->the_post();
                                ?>
                                        <option value="<?php echo get_the_ID(); ?>">
                                            <?php the_title(); ?>
                                        </option>
                                <?php
                                    }
                                };
                                ?>
                            </select>
                            <svg role="presentation" class="icon icon--arrow" width="42px" height="60px" viewBox="-458 261.7 41.8 38.3">
                                <rect x="-458" y="261.4" class="icon__box" width="42" height="60" />
                                <polygon class="icon__caret" points="-432.9,281.4 -437.1,286.4 -441.3,281.4 " />
                            </svg>
                        </div>


                    </fieldset>
                </form>
            </div>
        </div>

        <div id="publications-content" class="pb-5" data-js-filter="target">
            <?php
            Publications::load_publications();
            ?>
        </div>

    </div>
<?php }
get_footer(); ?>