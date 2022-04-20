<?php

/**
 * Template Name: Research Page
 * PHP version 7
 *
 * @category   Page_Template
 * @package    scistories
 * @subpackage scistories-page-research
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

    <!---Research areas---->

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2>RESEARCH AREAS</h2>
            </div>
        </div>

        <div class="row">
            <?php $research_areas = SciStoriesPage::getPosts('research_areas', -1, 'DESC');

            if ($research_areas->have_posts()) {
                while ($research_areas->have_posts()) {
                    $research_areas->the_post();
                    $featured_image_url = get_the_post_thumbnail_url();
                    $research_area_icon_id = carbon_get_post_meta(get_the_ID(), 'crb_research_icon');
                    $research_area_icon_url = SciStoriesPage::printMetaImg($research_area_icon_id, 'full');
                    $video_id = carbon_get_post_meta(get_the_ID(), 'crb_research_video');
                    $video_url = wp_get_attachment_url($video_id);

            ?>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 research-video embed-responsive research-hex-container">
                                <video src="<?php echo $video_url ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' muted autoplay loop>
                                </video>

                            </div>
                            <div class="col-12 icon-circles pt-3">
                                <img class="img-fluid thumbnail-icon" src="<?php echo $research_area_icon_url; ?>" alt="">
                            </div>
                            <div class="col-12 research-areas-txt">
                                <h3 class="uppercase"><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                                <p><a href="<?php echo "publications/?r=" . get_the_ID(); ?>">Publications on <?php the_title(); ?></a></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            };
            wp_reset_postdata(); ?>
        </div>
    </div>

<?php }
get_footer(); ?>