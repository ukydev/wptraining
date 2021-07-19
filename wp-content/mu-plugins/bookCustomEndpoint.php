<?php

add_action('rest_api_init', 'tenup_get_books');

function tenup_get_books() {
    register_rest_route('library', 'book', array(
        'method' => 'GET',
        'callback' => 'get_book_by_title'
    ));
}

function get_book_by_title($data) {
    $title = $data->get_param( 'term' );
    $args = array(
        'post_type' => 'tenup_book',
        'title' => $title
    );

    $result = get_posts(
        $args
     );

    return rest_ensure_response($result);
}