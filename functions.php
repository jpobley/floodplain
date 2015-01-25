<?php
function floodplain_projects_fields( $fields ) {
    $fields['date'] = array(
        'name'          => __( 'Date', 'projects' ),
        'description'   => __( 'Enter a date for this project.', 'projects' ),
        'type'          => 'text',
        'default'       => '',
        'section'       => 'info'
    );

    $fields['location'] = array(
        'name'          => __( 'Location', 'projects' ),
        'description'   => __( 'Enter a location for this project.', 'projects' ),
        'type'          => 'text',
        'default'       => '',
        'section'       => 'info'
    );

    return $fields;
}
add_filter( 'projects_custom_fields', 'floodplain_projects_fields' );

function display_new_projects_fields() {
    global $post;
    $location = esc_attr( get_post_meta( $post->ID, '_location', true ) );
    $date = esc_attr( get_post_meta( $post->ID, '_date', true ) );

    echo '<p>' . __( 'Date: ', 'projects' ) . $date . '</p>';
    echo '<p>' . __( 'Location: ', 'projects' ) . $location . '</p>';

}
add_action( 'projects_after_loop_item', 'display_new_projects_fields', 10 );

function floodplain_projects_categories_menu() {
    the_widget( 'Woothemes_Widget_Project_Categories', 'title=&hierarchical=0&count=0' );
}
function floodplain_load_flexslider() {
    wp_enqueue_script("fp_flexslider", get_stylesheet_directory_uri() . "/flex-slider/jquery.flexslider-min.js", array("jquery"), true);
    wp_enqueue_script("fp_flexslider_custom", get_stylesheet_directory_uri() . "/assets/fp_flexslider.js", array("jquery", "fp_flexslider"), true);
    wp_enqueue_style("fp_flexslider", get_stylesheet_directory_uri() . "/flex-slider/flexslider.css");
}
