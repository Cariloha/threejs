<?php

use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action('carbon_fields_register_fields', 'crb_publications_fields');
function crb_publications_fields()
{
    Container::make('post_meta', __('Publications Settings'))
        ->where('post_type', '=', 'publications')
        ->add_fields(array(
            Field::make('text', 'crb_authors', __('Publication Authors in Proper Format')),
            Field::make('text', 'crb_publication_journal', __('Publication Journal')),
            Field::make('text', 'crb_publication_issue', __('Publication Issue')),
            Field::make('text', 'crb_download', __('Publication Download')),

            Field::make('multiselect', 'crb_publication_authors', __('Authors for filter'))
                ->add_options('crb_publications_options'),

            Field::make('multiselect', 'crb_publication_research', __('Publication Research area'))
                ->add_options('crb_publications_options_research'),

            Field::make('multiselect', 'crb_publication_tech', __('Publication Technology'))
                ->add_options('crb_publications_options_tech'),

        ));
}

function crb_publications_options()
{
    $post_options = SciStoriesPage::createOptionsArray('members');
    return $post_options;
}

function crb_publications_options_research()
{
    $post_options = SciStoriesPage::createOptionsArray('research_areas');
    return $post_options;
}

function crb_publications_options_tech()
{
    $post_options = SciStoriesPage::createOptionsArray('technology');
    return $post_options;
}
