<?php

use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action('carbon_fields_register_fields', 'crb_research');
function crb_research()
{
    Container::make('post_meta', __('Research Content'))
        ->where('post_id', '=', SciStoriesPage::page_get_id('research'))
        ->add_fields(array(
            Field::make('rich_text', 'crb_research_richtext', __('Rich text metabox')),
            Field::make('text', 'crb_research_text', __('Text metabox')),
            Field::make('image', 'crb_image', 'Load image metabox'),
            Field::make('media_gallery', 'crb_research_gallery', __('Media gallery metabox')),
            Field::make('file', 'crb_research_file', __('Research file metabox')),
            Field::make('file', 'crb_research_video', __('Video metabox'))
                ->set_type(array('video')),

            Field::make('complex', 'crb_research_complex', 'Complex metabox')
                ->set_layout('tabbed-horizontal')
                ->add_fields(array(
                    Field::make('image', 'crb_complex_image', 'Complex metabox image'),
                    Field::make('text', 'crb_complex_text', 'Complex metabox text'),
                )),
        ));
}
