<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_global_theme_options');
function crb_global_theme_options()
{
    Container::make('post_meta', 'Header Settings')
        ->where('post_type', '=', 'page')
        ->add_fields(array(
            Field::make('file', 'crb_header_video', 'Banner Video File')
                ->set_type(array('video')),
        ));
}
