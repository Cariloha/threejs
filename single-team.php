<?php

/**
 * Single Team for the Scistories theme.
 * PHP version 7
 *
 * @category   Page_Template
 * @package    naik
 * @subpackage naik-single-team
 * @author     SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

get_header();

if (have_posts()) {
    the_post();

    $your_query = new WP_Query('pagename=team');
    while ($your_query->have_posts()) : $your_query->the_post();

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

    <?php
    endwhile;
    wp_reset_postdata();
    ?>

    <!--Team info-->
    <?php
    $featured_image_url = get_the_post_thumbnail_url();
    $team_title = carbon_get_post_meta(get_the_ID(), 'crb_team_title');
    $team_email = carbon_get_post_meta(get_the_ID(), 'crb_team_email');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col-12">
                        <img class="img-fluid" src="<?php echo $featured_image_url; ?>" alt="">
                    </div>

                    <div class=" col-12 modal-member-txt text-center">
                        <h2 class="uppercase"><?php the_title(); ?></h2>
                        <p><?php echo $team_title ?></p>
                        <a href="mailto:<?php echo $team_email ?>">
                            <?php if (!empty($team_email)) { ?>
                                <i class="fas fa-envelope team-member-icon"></i>
                            <?php } ?>
                        </a>
                    </div>

                    <div class="col-12 modal-bio-txt">
                        <p><?php the_content(); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 modal-desktop-side-txt">
                <div class="row">
                    <div class="col-12">
                        <h2 class="wizard-title">WIZARD FEATURES</h2>
                    </div>
                </div>
                <div class="row">
                    <?php $wizard_content = carbon_get_post_meta(get_the_ID(), 'crb_team_hybrid_text') ?>

                    <div class="col-12 modal-wizard-txt">
                        <?php echo $wizard_content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    wp_reset_postdata();
    ?>

<?php }
get_footer(); ?>