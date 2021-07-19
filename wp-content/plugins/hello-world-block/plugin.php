<?php
/**
 * Plugin Name: 10up Gutenberg Training - Hello World Block
 * Plugin URI:
 * Description: Hello world block plugin.
 * Version:     0.1.0
 * Author:      10up
 * Author URI:  https://10up.com
 *
 * @package HelloWorldBlock
 */

/**
 * Hooking our register_block function into the WordPress init action.
 */
add_action( 'init', 'hello_world_register_block' );

/**
 * Register Block Assets and the Block itself
 */
function hello_world_register_block() {

	/**
	 * Register the index.js file from the build folder
	 */
	wp_register_script(
		'editor-script',
		plugin_dir_url( __FILE__ ) . 'build/index.js',
		[ 'wp-blocks' ],
		time(),
		false
	);

	/**
	 * Register the block with a render callback and the refference to the registered editor script
	 */
	register_block_type(
		'tenup-exercises/hello-world',
		[
			'editor_script'   => 'editor-script',
			'render_callback' => 'hello_world_render_callback',
		]
	);
};

/**
 * Hello World Block Render Callback
 */
function hello_world_render_callback($attributes) {
	return '<h1>Books</h1>';
	$posts = get_posts(
	    [
	        'category' => $attributes['selected'],
            'posts_per_page' => $attributes['posts_per_page']
        ]
    );

	ob_start();
	foreach($posts as $post) {
	    echo '<h2>'. $post->post_tile.'</h2>';
    }
	return ob_get_clean();
};
