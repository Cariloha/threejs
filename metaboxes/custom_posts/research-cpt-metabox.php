<?php

use Carbon_Fields\Field;
use Carbon_Fields\Container;


add_action('carbon_fields_register_fields', 'crb_research_areas');
function crb_research_areas()
{
    Container::make('post_meta', __('Research Content Settings'))
        ->where('post_type', '=', 'research_areas')
        ->add_fields(array(
            Field::make('image', 'crb_research_icon', 'Research Area Icon'),
            Field::make('file', 'crb_research_video', 'Research Area Video File')
                ->set_type(array('video')),

        ));
}
