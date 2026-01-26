<?php
/**
 * Hero Slides Custom Post Type and Meta Boxes
 */

// Register Custom Post Type
function smc_register_hero_slides() {
    $labels = array(
        'name'                  => _x( 'Hero Slides', 'Post Type General Name', 'smc' ),
        'singular_name'         => _x( 'Hero Slide', 'Post Type Singular Name', 'smc' ),
        'menu_name'             => __( 'Hero Slides', 'smc' ),
        'name_admin_bar'        => __( 'Hero Slide', 'smc' ),
        'archives'              => __( 'Item Archives', 'smc' ),
        'attributes'            => __( 'Item Attributes', 'smc' ),
        'parent_item_colon'     => __( 'Parent Item:', 'smc' ),
        'all_items'             => __( 'All Slides', 'smc' ),
        'add_new_item'          => __( 'Add New Slide', 'smc' ),
        'add_new'               => __( 'Add New', 'smc' ),
        'new_item'              => __( 'New Slide', 'smc' ),
        'edit_item'             => __( 'Edit Slide', 'smc' ),
        'update_item'           => __( 'Update Slide', 'smc' ),
        'view_item'             => __( 'View Slide', 'smc' ),
        'view_items'            => __( 'View Items', 'smc' ),
        'search_items'          => __( 'Search Item', 'smc' ),
        'not_found'             => __( 'Not found', 'smc' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'smc' ),
        'featured_image'        => __( 'Slide Image', 'smc' ),
        'set_featured_image'    => __( 'Set slide image', 'smc' ),
        'remove_featured_image' => __( 'Remove slide image', 'smc' ),
        'use_featured_image'    => __( 'Use as slide image', 'smc' ),
        'insert_into_item'      => __( 'Insert into item', 'smc' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'smc' ),
        'items_list'            => __( 'Items list', 'smc' ),
        'items_list_navigation' => __( 'Items list navigation', 'smc' ),
        'filter_items_list'     => __( 'Filter items list', 'smc' ),
    );
    $args = array(
        'label'                 => __( 'Hero Slide', 'smc' ),
        'description'           => __( 'Slides for the homepage hero section', 'smc' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-images-alt2',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true, 
    );
    register_post_type( 'hero_slide', $args );
}
add_action( 'init', 'smc_register_hero_slides', 0 );

// Add Meta Box for Icon
function smc_add_slide_meta_boxes() {
    add_meta_box(
        'smc_slide_icon_box',
        __( 'Slide Icon (Emoji/Text)', 'smc' ),
        'smc_slide_icon_callback',
        'hero_slide',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'smc_add_slide_meta_boxes' );

function smc_slide_icon_callback( $post ) {
    wp_nonce_field( 'smc_save_slide_details', 'smc_slide_details_nonce' );
    $value = get_post_meta( $post->ID, '_smc_slide_icon', true );
    echo '<label for="smc_slide_icon">Icon (e.g. 🚀): </label>';
    echo '<input type="text" id="smc_slide_icon" name="smc_slide_icon" value="' . esc_attr( $value ) . '" size="25" />';
}

function smc_save_slide_meta( $post_id ) {
    if ( ! isset( $_POST['smc_slide_details_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['smc_slide_details_nonce'], 'smc_save_slide_details' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['smc_slide_icon'] ) ) {
        update_post_meta( $post_id, '_smc_slide_icon', sanitize_text_field( $_POST['smc_slide_icon'] ) );
    }
}
add_action( 'save_post', 'smc_save_slide_meta' );
