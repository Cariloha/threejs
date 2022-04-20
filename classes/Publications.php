<?php

/* Manage Theme support
* PHP version 7
*
* @category   Class
* @author     SciStories
* @since      1.0.0
*/

if (!class_exists('Publications')) {

    class Publications
    {
        public static function init()
        {

            /* Ajax request to load publication pagination record */
            add_action('wp_ajax_pagination-load-publication', __CLASS__ . '::publication_filter');
            add_action('wp_ajax_nopriv_pagination-load-publication', __CLASS__ . '::publication_filter');
        }


        /**
         * Function to Load publication content
         *
         * @since 1.0
         * @static
         * @access public
         */
        public static function publication_filter()
        {
            $page  = ((isset($_POST['page']) && intval($_POST['page']) > 0) ? intval($_POST['page']) : 1);

            $param_data  = (isset($_POST['data']) ?  $_POST['data'] : '');
            $params = array();
            parse_str($param_data, $params);

            $pub_author  = (isset($params['members']) ? $params['members']  : '');
            $pub_research  = (isset($params['research-areas']) ? $params['research-areas']  : '');
            $pub_tech = (isset($params['technology']) ? $params['technology'] : '');

            $filter_data = array('members' => $pub_author, 'research_areas' => $pub_research, 'technology' => $pub_tech);

            self::load_publications($page, $filter_data);
            die;
        }


        /**
         * Function to get values from research, members and technology
         *
         * @since 1.0
         * @static
         * @access public
         *
         * @param Integer $page Page number as integer.
         * @param Array   $filter_data Filter data for pagination as array.
         */

        public static function get_carbon_values($property, array $meta_content)
        {

            $resource = [];
            if (isset($meta_content)) {
                foreach ($meta_content as $key => $value) {
                    if (strpos($key, $property)) {
                        if (is_array($value)) {
                            $resource = array_merge($resource, $value);
                        } else {
                            $resource[] = $value;
                        }
                    }
                }
            }
            return $resource;
        }
        /**
         * Function to Load publication content
         *
         * @since 1.0
         * @static
         * @access public
         *
         * @param Integer $page Page number as integer.
         * @param Array   $filter_data Filter data for pagination as array.
         */
        public static function load_publications($page = 1, $filter_data = array())
        {
            $research_area_filter = isset($filter_data['research_areas']) ? $filter_data['research_areas'] : '';
            $author_filter = isset($filter_data['members']) ? $filter_data['members'] : '';
            $tech_area_filter = isset($filter_data['technology']) ? $filter_data['technology'] : '';


            $limit      = 10;
            $start      = ($page - 1) * $limit;
            $args       = array(
                'post_type'      => 'publications',
                'posts_per_page' => $limit,
                'post_status '   => 'publish',
                'offset'         => $start,
                'order_by'       => 'date',
                'order'          => 'desc',
            );

            $meta_query = [];
            if (!empty($research_area_filter)) {
                $meta_query[] =
                    [
                        [
                            'key'     => 'crb_publication_research',
                            'value' => [$research_area_filter],
                        ],
                    ];
            }

            if (!empty($author_filter)) {
                $meta_query[] = [

                    [
                        'key' => 'crb_publication_authors',
                        'value'   => [$author_filter],
                    ],
                ];
            }

            if (!empty($tech_area_filter)) {
                $meta_query[] = [
                    [
                        'key'     => 'crb_publication_tech',
                        'value' => [$tech_area_filter],
                    ],
                ];
            }
            $args['meta_query'] = $meta_query;


            $publications = new WP_Query($args);
            $total_record = $publications->found_posts;

            // var_dump($total_record);
?>
            <?php
            if ($publications->have_posts()) :
                while ($publications->have_posts()) :
                    $publications->the_post();
                    $featured_image_url = get_the_post_thumbnail_url();
                    $post_date = get_the_date('Y');
                    $authors = carbon_get_post_meta(get_the_ID(), 'crb_authors');
                    $pub_journal = carbon_get_post_meta(get_the_ID(), 'crb_publication_journal');
                    $pub_issue = carbon_get_post_meta(get_the_ID(), 'crb_publication_issue');
            ?>

                    <div class="row publication-content">
                        <div class="col-12 col-md-4 publication-img ">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <img class="img-fluid" src="<?php echo $featured_image_url; ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8 publication-txt">
                            <h3><a><?php the_title(); ?></a></h3>
                            <div><?php echo $authors; ?></div>
                            <div class="pub-journal"> <?php echo $pub_journal ?></div>
                            <div class="pub-date"><?php echo "(" . $post_date . "), ", $pub_issue; ?> </div>
                            <div class="row">

                                <?php
                                $meta_content = get_post_meta(get_the_ID());
                                $pub_authors_id = static::get_carbon_values('crb_publication_authors', $meta_content);

                                $pub_tech_id = static::get_carbon_values('crb_publication_tech', $meta_content);

                                $pub_research_id = static::get_carbon_values('crb_publication_research', $meta_content);

                                $pub_authors = SciStoriesPage::getChosenPosts($pub_authors_id, 'members');
                                $pub_research = SciStoriesPage::getChosenPosts($pub_research_id, 'research_areas');
                                $pub_tech = SciStoriesPage::getChosenPosts($pub_tech_id, 'technology');

                                ?>
                                <div class="col-12">
                                    <?php
                                    if ($pub_authors->have_posts()) {
                                        while ($pub_authors->have_posts()) {
                                            $pub_authors->the_post();
                                            $pub_authors_icon_id = carbon_get_post_meta(get_the_ID(), 'crb_team_icon');
                                            $pub_authors_icon_url = SciStoriesPage::printMetaImg($pub_authors_icon_id, 'full');
                                    ?>
                                            <img class="img-fluid thumbnail-icon" src="<?php echo $pub_authors_icon_url; ?>" alt="">
                                        <?php
                                        }
                                    };
                                    if ($pub_research->have_posts()) {
                                        while ($pub_research->have_posts()) {
                                            $pub_research->the_post();
                                            $pub_research_icon_id = carbon_get_post_meta(get_the_ID(), 'crb_research_icon');
                                            $pub_research_icon_url = SciStoriesPage::printMetaImg($pub_research_icon_id, 'full');
                                        ?>
                                            <img class="img-fluid thumbnail-icon" src="<?php echo $pub_research_icon_url; ?>" alt="">
                                        <?php
                                        }
                                    };
                                    if ($pub_tech->have_posts()) {
                                        while ($pub_tech->have_posts()) {
                                            $pub_tech->the_post();
                                            $pub_tech_icon_id = carbon_get_post_meta(get_the_ID(), 'crb_tech_icon');
                                            $pub_tech_icon_url = SciStoriesPage::printMetaImg($pub_tech_icon_id, 'full');
                                        ?>
                                            <img class="img-fluid thumbnail-icon" src="<?php echo $pub_tech_icon_url; ?>" alt="">
                                    <?php

                                        }
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                endwhile;
            else :
                ?>
                <div class="col-12 text-center pt-5 pb-5">No Results Found</div>
            <?php
            endif;
            wp_reset_postdata();

            /*load pagination section*/
            self::pagination_section($page, $total_record, $limit);
        }
        /**
         * Function to Load Pagination section
         *
         * @since 1.0
         * @static
         * @access public
         *
         * @param Integer $page Page number as integer.
         * @param Integer $total_record Total number of record as integer.
         * @param Integer $limit  Record per page as integer.
         * El id de la paginación en el js, es el id del contenedor de la función de load_news o load_publication.
         */
        public static function pagination_section($page = 1, $total_record = 0, $limit = 1)
        {
            $no_of_pages = ceil($total_record / $limit);

            if ($no_of_pages > 1) {
            ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12 page-pagination-container d-flex justify-content-end">
                            <nav class="page-pagination" aria-label="page-navigation">
                                <ul class="pagination">
                                    <?php
                                    $range     = 2;
                                    $init_page = $page - $range;
                                    $last_page = $page + $range;

                                    if ($init_page < 1) {
                                        $last_page = $last_page + (1 - $init_page);
                                        $init_page = 1;
                                    }

                                    if ($last_page > $no_of_pages) {
                                        $init_page = $init_page - ($last_page - $no_of_pages);
                                        $last_page = $no_of_pages;
                                    }

                                    for ($i = $init_page; $i <= $last_page; $i++) {
                                        if ($i > 0 && $i <= $last_page) {
                                            if (intval($i) === intval($page)) {
                                    ?>
                                                <li class="page-item"><a class="page-link active">
                                                        <?php echo esc_html($i); ?> </a>
                                                </li>
                                            <?php } else {
                                            ?>
                                                <li class="page-item"><a class="page-link" data-page="<?php echo esc_html($i); ?>"><?php echo esc_html($i) ?></a></li>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
<?php
            }
        }
    }

    Publications::init();
}
