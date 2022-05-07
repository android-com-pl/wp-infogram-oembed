<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Infogram oEmbedd support
 * Description:       A simple plugin that adds oEmbed Infogram support.
 * Version:           1.0.0
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
	require_once( dirname( __FILE__ ) . '/class-amp-infogram-oembed-handler.php' );
	$handlerClasses['ACP_Infogram_Embed_Handler'] = [];

	return $handlerClasses;
} );
