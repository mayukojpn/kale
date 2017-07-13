<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'kirki';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'kale' ),
				'background-image'      => esc_attr__( 'Background Image', 'kale' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'kale' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'kale' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'kale' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'kale' ),
				'inherit'               => esc_attr__( 'Inherit', 'kale' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'kale' ),
				'cover'                 => esc_attr__( 'Cover', 'kale' ),
				'contain'               => esc_attr__( 'Contain', 'kale' ),
				'background-size'       => esc_attr__( 'Background Size', 'kale' ),
				'fixed'                 => esc_attr__( 'Fixed', 'kale' ),
				'scroll'                => esc_attr__( 'Scroll', 'kale' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'kale' ),
				'left-top'              => esc_attr__( 'Left Top', 'kale' ),
				'left-center'           => esc_attr__( 'Left Center', 'kale' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'kale' ),
				'right-top'             => esc_attr__( 'Right Top', 'kale' ),
				'right-center'          => esc_attr__( 'Right Center', 'kale' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'kale' ),
				'center-top'            => esc_attr__( 'Center Top', 'kale' ),
				'center-center'         => esc_attr__( 'Center Center', 'kale' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'kale' ),
				'background-position'   => esc_attr__( 'Background Position', 'kale' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'kale' ),
				'on'                    => esc_attr__( 'ON', 'kale' ),
				'off'                   => esc_attr__( 'OFF', 'kale' ),
				'all'                   => esc_attr__( 'All', 'kale' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'kale' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'kale' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'kale' ),
				'greek'                 => esc_attr__( 'Greek', 'kale' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'kale' ),
				'khmer'                 => esc_attr__( 'Khmer', 'kale' ),
				'latin'                 => esc_attr__( 'Latin', 'kale' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'kale' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'kale' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'kale' ),
				'arabic'                => esc_attr__( 'Arabic', 'kale' ),
				'bengali'               => esc_attr__( 'Bengali', 'kale' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'kale' ),
				'tamil'                 => esc_attr__( 'Tamil', 'kale' ),
				'telugu'                => esc_attr__( 'Telugu', 'kale' ),
				'thai'                  => esc_attr__( 'Thai', 'kale' ),
				'serif'                 => _x( 'Serif', 'font style', 'kale' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'kale' ),
				'monospace'             => _x( 'Monospace', 'font style', 'kale' ),
				'font-family'           => esc_attr__( 'Font Family', 'kale' ),
				'font-size'             => esc_attr__( 'Font Size', 'kale' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'kale' ),
				'line-height'           => esc_attr__( 'Line Height', 'kale' ),
				'font-style'            => esc_attr__( 'Font Style', 'kale' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'kale' ),
				'top'                   => esc_attr__( 'Top', 'kale' ),
				'bottom'                => esc_attr__( 'Bottom', 'kale' ),
				'left'                  => esc_attr__( 'Left', 'kale' ),
				'right'                 => esc_attr__( 'Right', 'kale' ),
				'center'                => esc_attr__( 'Center', 'kale' ),
				'justify'               => esc_attr__( 'Justify', 'kale' ),
				'color'                 => esc_attr__( 'Color', 'kale' ),
				'add-image'             => esc_attr__( 'Add Image', 'kale' ),
				'change-image'          => esc_attr__( 'Change Image', 'kale' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'kale' ),
				'add-file'              => esc_attr__( 'Add File', 'kale' ),
				'change-file'           => esc_attr__( 'Change File', 'kale' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'kale' ),
				'remove'                => esc_attr__( 'Remove', 'kale' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'kale' ),
				'variant'               => esc_attr__( 'Variant', 'kale' ),
				'subsets'               => esc_attr__( 'Subset', 'kale' ),
				'size'                  => esc_attr__( 'Size', 'kale' ),
				'height'                => esc_attr__( 'Height', 'kale' ),
				'spacing'               => esc_attr__( 'Spacing', 'kale' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'kale' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'kale' ),
				'light'                 => esc_attr__( 'Light 200', 'kale' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'kale' ),
				'book'                  => esc_attr__( 'Book 300', 'kale' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'kale' ),
				'regular'               => esc_attr__( 'Normal 400', 'kale' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'kale' ),
				'medium'                => esc_attr__( 'Medium 500', 'kale' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'kale' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'kale' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'kale' ),
				'bold'                  => esc_attr__( 'Bold 700', 'kale' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'kale' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'kale' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'kale' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'kale' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'kale' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'kale' ),
				'add-new'           	=> esc_attr__( 'Add new', 'kale' ),
				'row'           		=> esc_attr__( 'row', 'kale' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'kale' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'kale' ),
				'back'                  => esc_attr__( 'Back', 'kale' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'kale' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'kale' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'kale' ),
				'none'                  => esc_attr__( 'None', 'kale' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'kale' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'kale' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'kale' ),
				'initial'               => esc_attr__( 'Initial', 'kale' ),
				'select-page'           => esc_attr__( 'Select a Page', 'kale' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'kale' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'kale' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'kale' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'kale' ),
			);

			// Apply global changes from the kirki/config filter.
			// This is generally to be avoided.
			// It is ONLY provided here for backwards-compatibility reasons.
			// Please use the kirki/{$config_id}/l10n filter instead.
			$config = apply_filters( 'kirki/config', array() );
			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			// Apply l10n changes using the kirki/{$config_id}/l10n filter.
			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
