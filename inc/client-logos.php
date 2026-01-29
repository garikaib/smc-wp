<?php
/**
 * Client Logos Custom Post Type
 */

function smc_register_client_logos() {
    $labels = array(
        'name'                  => _x( 'Client Logos', 'Post Type General Name', 'smc' ),
        'singular_name'         => _x( 'Client Logo', 'Post Type Singular Name', 'smc' ),
        'menu_name'             => __( 'Client Logos', 'smc' ),
        'name_admin_bar'        => __( 'Client Logo', 'smc' ),
        'archives'              => __( 'Item Archives', 'smc' ),
        'attributes'            => __( 'Item Attributes', 'smc' ),
        'all_items'             => __( 'All Logos', 'smc' ),
        'add_new_item'          => __( 'Add New Logo', 'smc' ),
        'add_new'               => __( 'Add New', 'smc' ),
        'new_item'              => __( 'New Logo', 'smc' ),
        'edit_item'             => __( 'Edit Logo', 'smc' ),
        'update_item'           => __( 'Update Logo', 'smc' ),
        'view_item'             => __( 'View Logo', 'smc' ),
        'view_items'            => __( 'View Items', 'smc' ),
        'search_items'          => __( 'Search Logo', 'smc' ),
        'featured_image'        => __( 'Logo Image', 'smc' ),
        'set_featured_image'    => __( 'Set logo image', 'smc' ),
        'remove_featured_image' => __( 'Remove logo image', 'smc' ),
        'use_featured_image'    => __( 'Use as logo image', 'smc' ),
    );
    $args = array(
        'label'                 => __( 'Client Logo', 'smc' ),
        'description'           => __( 'Partner/Client logos for the ticker', 'smc' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 21,
        'menu_icon'             => 'dashicons-awards',
        'show_in_nav_menus'     => false,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'client_logo', $args );
}
add_action( 'init', 'smc_register_client_logos', 0 );
