<?php
// inc/events-cpt.php

function smc_register_event_cpt() {
    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'smc' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'smc' ),
        'menu_name'             => __( 'Events', 'smc' ),
        'name_admin_bar'        => __( 'Event', 'smc' ),
        'archives'              => __( 'Event Archives', 'smc' ),
        'attributes'            => __( 'Event Attributes', 'smc' ),
        'parent_item_colon'     => __( 'Parent Event:', 'smc' ),
        'all_items'             => __( 'All Events', 'smc' ),
        'add_new_item'          => __( 'Add New Event', 'smc' ),
        'add_new'               => __( 'Add New', 'smc' ),
        'new_item'              => __( 'New Event', 'smc' ),
        'edit_item'             => __( 'Edit Event', 'smc' ),
        'update_item'           => __( 'Update Event', 'smc' ),
        'view_item'             => __( 'View Event', 'smc' ),
        'view_items'            => __( 'View Events', 'smc' ),
        'search_items'          => __( 'Search Event', 'smc' ),
        'not_found'             => __( 'Not found', 'smc' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'smc' ),
        'featured_image'        => __( 'Event Image', 'smc' ),
        'set_featured_image'    => __( 'Set event image', 'smc' ),
        'remove_featured_image' => __( 'Remove event image', 'smc' ),
        'use_featured_image'    => __( 'Use as event image', 'smc' ),
        'insert_into_item'      => __( 'Insert into event', 'smc' ),
        'uploaded_to_this_item' => __( 'Uploaded to this event', 'smc' ),
        'items_list'            => __( 'Events list', 'smc' ),
        'items_list_navigation' => __( 'Events list navigation', 'smc' ),
        'filter_items_list'     => __( 'Filter events list', 'smc' ),
    );
    $args = array(
        'label'                 => __( 'Event', 'smc' ),
        'description'           => __( 'SMC Events', 'smc' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type( 'smc_event', $args );
}
add_action( 'init', 'smc_register_event_cpt', 0 );

// Add Meta Boxes for Start/End Date and Location
function smc_add_event_meta_boxes() {
    add_meta_box(
        'smc_event_details',
        'Event Details',
        'smc_event_meta_box_callback',
        'smc_event'
    );
}
add_action( 'add_meta_boxes', 'smc_add_event_meta_boxes' );

function smc_event_meta_box_callback( $post ) {
    wp_nonce_field( 'smc_save_event_data', 'smc_event_meta_box_nonce' );

    $start_date = get_post_meta( $post->ID, '_smc_event_start_date', true );
    $end_date = get_post_meta( $post->ID, '_smc_event_end_date', true );
    $location = get_post_meta( $post->ID, '_smc_event_location', true );

    echo '<label for="smc_event_start_date">Start Date & Time</label>';
    echo '<input type="datetime-local" id="smc_event_start_date" name="smc_event_start_date" value="' . esc_attr( $start_date ) . '" style="width:100%; margin-bottom: 10px;">';

    echo '<label for="smc_event_end_date">End Date & Time</label>';
    echo '<input type="datetime-local" id="smc_event_end_date" name="smc_event_end_date" value="' . esc_attr( $end_date ) . '" style="width:100%; margin-bottom: 10px;">';

    echo '<label for="smc_event_location">Location</label>';
    echo '<input type="text" id="smc_event_location" name="smc_event_location" value="' . esc_attr( $location ) . '" style="width:100%;">';
}

function smc_save_event_data( $post_id ) {
    if ( ! isset( $_POST['smc_event_meta_box_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['smc_event_meta_box_nonce'], 'smc_save_event_data' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['smc_event_start_date'] ) ) {
        update_post_meta( $post_id, '_smc_event_start_date', sanitize_text_field( $_POST['smc_event_start_date'] ) );
    }
    if ( isset( $_POST['smc_event_end_date'] ) ) {
        update_post_meta( $post_id, '_smc_event_end_date', sanitize_text_field( $_POST['smc_event_end_date'] ) );
    }
    if ( isset( $_POST['smc_event_location'] ) ) {
        update_post_meta( $post_id, '_smc_event_location', sanitize_text_field( $_POST['smc_event_location'] ) );
    }
}
add_action( 'save_post', 'smc_save_event_data' );
