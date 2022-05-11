<?php
/**
 * @wordpress-plugin
 * Plugin Name:       oEmbed Infogram
 * Description:       A simple plugin that adds support for embedding Infogram.
 * Version:           1.0.2
 * Plugin URI:        https://github.com/android-com-pl/oembed-infogram
 * Author:            android.com.pl
 * Author URI:        https://android.com.pl/
 * License:           GPL v3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'init', function () {
	wp_oembed_add_provider( 'https://infogram.com/*', 'https://infogram.com/oembed/?format=json' );
} );

//AMP
add_filter( 'amp_content_embed_handlers', function ( $handlerClasses ) {
	require_once( plugin_dir_path( __FILE__ ) . 'class-amp-infogram-oembed-handler.php' );
	$handlerClasses['ACP_Infogram_Embed_Handler'] = [];

	return $handlerClasses;
} );
