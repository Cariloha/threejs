<?php

/**
 * Header file for the scistories theme.
 * PHP version 7
 *
 * @category   Page_Template
 * @package    scistories
 * @subpackage scistories-page-header
 * @author     SciStories
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @link       http://scistories.com/
 * @since      1.0.0
 */

?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <!-- Required meta tags -->
    <meta charset="<?php esc_attr(bloginfo('charset')); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>

    <title>Scistories Lab Website</title>

</head>


<body <?php body_class(); ?>>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo-nav" href="<?php echo esc_attr(home_url()); ?>">
                <?php $logo_image_id = get_theme_mod('custom_logo');
                $logo_image_url = (('' !== $logo_image_id) ? wp_get_attachment_url($logo_image_id) : '');
                if ('' !== $logo_image_url) { ?>

                    <img class="img-fluid d-inline-block align-top" src="<?php echo esc_attr($logo_image_url); ?>" />
                <?php } else { ?>
                    <span><?php echo esc_attr(get_bloginfo('name')); ?></span>
                <?php } ?>
            </a>

            <button class="navbar-toggler custom-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#toggleMobileMenu" aria-controls="toggleMobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="toggleMobileMenu">
                <?php
                if (has_nav_menu('primary_menu')) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary_menu',
                            'menu_class' => 'navbar-nav menu mx-auto',
                            'bootstrap'       => true
                        )
                    );
                }
                ?>
            </div>
        </nav>
    </div>