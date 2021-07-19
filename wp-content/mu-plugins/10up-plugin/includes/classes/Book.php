<?php

/*
Plugin Name: Register Book
Plugin URI: http://github.com/ukydev
Description: This plugin will register new post type, taxonomy and meta field for 'Book'.
Version: 1.0
Author: Kemal YILMAZ
Author URI:http://github.com/ukydev
License: GPLv2
*/

namespace TenUpPlugin;

class Book
{

	private static $instance;

	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initialize Plugin
	 */
	public function setup()
	{
		// Actions
		add_action('init',[$this, 'tenup_register_post_type']);
		add_action('init',[$this,'tenup_book']);
		add_action('init',[$this, 'tenup_register_post_type']);
		add_action('add_meta_boxes', [$this, 'book_register_meta_boxes']);
		add_action('save_post', [$this, 'book_save_meta_box']);
	}


	/**
	 * REGISTERS A NEW POST TYPE BOOK
	 */
	public function tenup_register_post_type()
	{
		$labels = array(
			'name' => __('Books', '10up'),
			'singular_name' => __('Book', '10up'),
			'add_new' => __('New Book', '10up'),
			'add_new_item' => __('Add New Book', '10up'),
			'edit_item' => __('Edit Book', '10up'),
			'new_item' => __('New Book', '10up'),
			'view_item' => __('View Books', '10up'),
			'search_items' => __('Search Books', '10up'),
			'not_found' => __('No Books Found', '10up'),
			'not_found_in_trash' => __('No Books found in Trash', '10up'),
		);

		$args = array(
			'labels' => $labels,
			'has_archive' => true,
			'public' => true,
			'hierarchical' => false,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'custom-fields',
				'thumbnail',
				'page-attributes'
			),
			'taxonomies' => 'category',
			'rewrite' => array('slug' => 'book'),
			'show_in_rest' => true
		);
		register_post_type('tenup_book', $args);


	}

	/**
	 * REGISTER 'GENRE' TAXONOMY FOR POST TYPE 'BOOK'
	 *
	 * @see register_post_type() for registering post types.
	 */
	public function tenup_book()
	{
		$args = array(
			'label' => __('Genre', 'textdomain'),
			'public' => true,
			'rewrite' => true,
			'hierarchical' => true
		);

		register_taxonomy('genre', 'tenup_book', $args);
	}



	/**
	 * REGISTER THE META FIELD
	 */

	/**
	 * Register meta boxes.
	 */
	public function book_register_meta_boxes()
	{
		add_meta_box('hcf-1', __('Books Custom Field', 'hcf'), 'book_display_callback', 'tenup_book');
	}


	/**
	 * Meta box display callback.
	 *
	 * @param WP_Post $post Current post object.
	 */
	public function book_display_callback($post)
	{
		include plugin_dir_path(__FILE__) . './form.php';
	}

	/**
	 * Save meta box content.
	 *
	 * @param int $post_id Post ID
	 */
	public function book_save_meta_box($post_id)
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		if ($parent_id = wp_is_post_revision($post_id)) {
			$post_id = $parent_id;
		}
		$fields = [
			'book_author',
			'book_published_date',
			'book_price',
		];
		foreach ($fields as $field) {
			if (array_key_exists($field, $_POST)) {
				update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
			}
		}
	}
}
