<?php

/**
 * Template Name: Team Page
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

    <!---Team---->

    <div class="container">

        <div class="row">
            <div class="col-12">
                <h2>Team</h2>
            </div>
        </div>

        <div class="row">
            <?php
            $team = SciStoriesPage::getPosts('members', -1, 'DESC');

            if ($team->have_posts()) {
                while ($team->have_posts()) {
                    $team->the_post();

                    $featured_image_url = get_the_post_thumbnail_url();
                    $team_title = carbon_get_post_meta(get_the_ID(), 'crb_team_title');
                    $team_email = carbon_get_post_meta(get_the_ID(), 'crb_team_email');
                    $team_icon_id = carbon_get_post_meta(get_the_ID(), 'crb_team_icon');
                    $team_icon_url = SciStoriesPage::printMetaImg($team_icon_id, 'thumbnail');
            ?>

                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <img class="img-fluid" src="<?php echo $featured_image_url; ?>" alt="">
                            </div>

                            <div class="col-12 team-member-img">
                                <img class="img-fluid thumbnail-icon" src="<?php echo $team_icon_url; ?>" alt="">
                            </div>

                            <div class="col-12 team-member-txt">
                                <h3 class="uppercase"><a><?php the_title(); ?></a></h3>
                                <p><?php echo $team_title; ?></p>
                                <a href="mailto:<?php echo $team_email; ?>"><i class="fas fa-envelope team-member-icon"></i></a>
                            </div>
                        </div>
            <?php

                }
                wp_reset_postdata();
            }
        }
        get_footer(); ?>