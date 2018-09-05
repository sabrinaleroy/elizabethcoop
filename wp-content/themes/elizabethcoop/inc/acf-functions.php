<?php

/**
 * only show post of the current taxonomy being edited
 * in the descending order by date
 **/
function select_posts_category($args, $field, $post_id)
{

    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    $args['tax_query'] = array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => array(str_replace("term_", "", $post_id))
        ),
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => array(str_replace("term_", "", $post_id))
        )
    );

    // return
    return $args;

}


// filter for every field
/**
 * 'acf/fields/relationship/query' >> This hook allows you to modify the $args array which is used to query the posts shown in the the relationship field list.
 */
add_filter('acf/fields/post_object/query/name=choose_the_posts_manually_taxo', 'select_posts_category', 10, 3);
