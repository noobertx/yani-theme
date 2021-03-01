<?php
add_action('rest_api_init', 'itemSearch');
function itemSearch(){
      register_rest_route('search/v1', 'item', array(
        'methods' => \WP_REST_SERVER::READABLE,
        'callback' => 'postSearchResults'
      ));
}


function postSearchResults($data){
      global $wpdb;
      $mainQuery = new WP_Query(array(
        's' => sanitize_text_field($data['term']),
        'posts_per_page' => -1
      ));

      $result = array();

      while($mainQuery->have_posts()) {
        $mainQuery->the_post();
        array_push($result, array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'image' => get_the_post_thumbnail_url(get_the_ID())
        ));
      }
      return $result;
    }
?>