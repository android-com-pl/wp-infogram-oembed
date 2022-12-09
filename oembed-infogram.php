<?php
/**
 * @wordpress-plugin
 * Plugin Name:       oEmbed Infogram
 * Description:       A simple plugin that adds support for embedding Infogram.
 * Version:           1.1.0
 * Plugin URI:        https://github.com/android-com-pl/oembed-infogram
 * Author:            android.com.pl
 * Author URI:        https://android.com.pl/
 * License:           GPL v3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 */

namespace ACP\oEmbed;

defined( 'ABSPATH' ) || die;

class Infogram {
	/**
	 * The unique instance of the plugin
	 * @var ?Infogram
	 */
	protected static ?Infogram $instance = null;

	/**
	 * Gets an instance of plugin
	 * @return Infogram
	 */
	public static function get_instance(): Infogram {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', [ $this, 'add_provider' ] );
		add_filter( 'amp_content_embed_handlers', [ $this, 'add_amp_handler' ], 10, 2 );
	}

	public function add_provider() {
		wp_oembed_add_provider( 'https://infogram.com/*', 'https://infogram.com/oembed/?format=json' );
	}

	/**
	 * AMP Support
	 *
	 * @param array $handler_classes
	 *
	 * @return array
	 * @see https://amp-wp.org/documentation/playbooks/custom-embed-handler/
	 */
	public function add_amp_handler( array $handler_classes ): array {
		require_once( plugin_dir_path( __FILE__ ) . 'class-amp-infogram-oembed-handler.php' );
		$handler_classes[ __NAMESPACE__ . '\\Infogram_Embed_Handler' ] = [];

		return $handler_classes;
	}
}

$oembed_infogram = Infogram::get_instance();
