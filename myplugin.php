<?php

/**
 * @package myplugin
 */
/*
Plugin Name: My Plugin
Plugin URI: #
Description: Example Plugin as part of exercise Linkedin Learning Course WordPress Plugin Development
Version: 4.2.4
Author: Neeraj Malwal
Author URI: #
License: GPLv2 or later
Text Domain: myplugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/


//No direct access security measure
if (!defined('ABSPATH')) {
    exit;
}

function create_custom_post_type() {
    $args = array(
        'label'                 => __( 'Movies', 'myplugin' ), // Human-readable name of the post type.
        'description'           => __( 'Custom post type for movies', 'myplugin' ), // Description of the post type.
        'labels'                => array(
            'name'          => __( 'Movies', 'myplugin' ),
            'singular_name' => __( 'Movie', 'myplugin' ),
            'add_new'       => __( 'Add New', 'myplugin' ),
            'add_new_item'  => __( 'Add New Movie', 'myplugin' ),
            'edit_item'     => __( 'Edit Movie', 'myplugin' ),
            'new_item'      => __( 'New Movie', 'myplugin' ),
            'all_items'     => __( 'All Movies', 'myplugin' ),
            'view_item'     => __( 'View Movie', 'myplugin' ),
            'search_items'  => __( 'Search Movies', 'myplugin' ),
            'not_found'     => __( 'No movies found', 'myplugin' ),
            'not_found_in_trash' => __( 'No movies found in Trash', 'myplugin' ),
            'parent_item_colon' => '',
            'menu_name'     => __( 'Movies', 'myplugin' ),
        ),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'movies' ),
        'capability_type'       => 'post',
        'has_archive'           => true,
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'taxonomies'            => array( 'category', 'post_tag' ),
        'show_in_rest'          => true,
        'rest_base'             => 'movies',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );
    register_post_type( 'movies', $args );
}

function my_plugin_register_meta() {
    register_post_meta(
        'movies',
        'genre',
        array(
            'single'        => true,
            'type'          => 'string',
            'auth_callback' => '__return_true',
            'default'       => 'drama',
            'show_in_rest'  => true,
        )
    );
}

function my_plugin_test_code() {
    $meta_keys = get_registered_meta_keys( 'post', 'movies' );
    var_dump($meta_keys);
    if ( registered_meta_key_exists( 'post', 'genre', 'movies' ) ) {
        echo 'The "genre" meta key is registered for the "movies" post type.';
        die;
    } else {
        echo 'The "genre" meta key is not registered for the "movies" post type.';
        die;
    }
}
add_action( 'init', 'create_custom_post_type' );
add_action( 'init', 'my_plugin_register_meta' );
add_action( 'init', 'my_plugin_test_code' );
