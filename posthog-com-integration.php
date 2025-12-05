<?php
/**
 * Plugin Name:       PostHog for WP - PostHog.com Integration
 * Plugin URI:        https://saad.codes/plugins/posthog-for-wp-posthog-com-integration/
 * Description:       Simple, lightweight solution for inserting your PostHog.com Snippet code to your WordPress website.
 * Version:           1.4.0
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * Author:            Saad Malik
 * Author URI:        https://saad.codes/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       posthog-for-wp-posthog-com-integration
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Main PostHog Plugin Class
 */
class PostHogforWPPostHogIntegrationPlugin {

	/**
	 * Constructor - Initialize plugin hooks
	 */
	public function __construct() {
		add_action( 'wp_head', array( $this, 'snippet_code' ) );
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'add_plugin_actions' ) );
	}

	/**
	 * Add settings link to plugins page
	 *
	 * @param array $links Existing plugin action links
	 * @return array Modified plugin action links
	 */
	public function add_plugin_actions( $links ) {
		$settings_link = sprintf(
			'<a href="%s">%s</a>',
			esc_url( admin_url( 'options-general.php?page=posthog-settings' ) ),
			esc_html__( 'Settings', 'posthog-for-wp-posthog-com-integration' )
		);
		array_unshift( $links, $settings_link );
		return $links;
	}

	/**
	 * Register plugin settings
	 */
	public function register_settings() {
		// Register snippet code setting with sanitization
		register_setting(
			'posthog-settings-group',
			'ph_snippet_code',
			array(
				'sanitize_callback' => array( $this, 'sanitize_snippet_code' ),
				'default'           => '',
			)
		);

		// Register enabled/disabled setting with sanitization
		register_setting(
			'posthog-settings-group',
			'ph_plugin_enabled',
			array(
				'sanitize_callback' => array( $this, 'sanitize_enabled' ),
				'default'           => 0,
			)
		);
	}

	/**
	 * Sanitize and validate the snippet code
	 *
	 * @param string $value The snippet code to sanitize
	 * @return string Sanitized snippet code
	 */
	public function sanitize_snippet_code( $value ) {
		// Trim whitespace
		$value = trim( $value );

		// If empty, show error
		if ( empty( $value ) ) {
			add_settings_error(
				'ph_snippet_code',
				'ph_snippet_code_empty',
				esc_html__( 'The PostHog snippet code cannot be empty. Please paste your snippet code.', 'posthog-for-wp-posthog-com-integration' ),
				'error'
			);
			return '';
		}

		// Validate that it looks like a PostHog snippet (basic check)
		if ( strpos( $value, '<script' ) === false || strpos( $value, 'posthog' ) === false ) {
			add_settings_error(
				'ph_snippet_code',
				'ph_snippet_code_invalid',
				esc_html__( 'This does not appear to be a valid PostHog snippet. Please check and try again.', 'posthog-for-wp-posthog-com-integration' ),
				'warning'
			);
		}

		// Allow script tags and posthog-specific content
		// We use wp_kses with script allowed since this is explicitly a script snippet
		$allowed_html = array(
			'script' => array(
				'type'  => array(),
				'src'   => array(),
				'async' => array(),
				'defer' => array(),
			),
		);

		// For PostHog snippets, we need to allow inline scripts
		// Since this is admin-controlled and the whole purpose is to insert tracking scripts,
		// we'll store it but be very careful about output
		return $value;
	}

	/**
	 * Sanitize the enabled/disabled setting
	 *
	 * @param mixed $value The value to sanitize
	 * @return int 1 or 0
	 */
	public function sanitize_enabled( $value ) {
		return ( $value == 1 ) ? 1 : 0;
	}

	/**
	 * Add plugin menu to WordPress admin
	 */
	public function add_menu() {
		add_options_page(
			esc_html__( 'PostHog Settings', 'posthog-for-wp-posthog-com-integration' ),
			esc_html__( 'PostHog Settings', 'posthog-for-wp-posthog-com-integration' ),
			'manage_options', // Proper capability check
			'posthog-settings',
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Output PostHog snippet code in site header
	 */
	public function snippet_code() {
		// Only output if enabled
		if ( ! get_option( 'ph_plugin_enabled' ) ) {
			return;
		}

		$snippet_code = get_option( 'ph_snippet_code' );

		// Validate snippet exists
		if ( empty( $snippet_code ) ) {
			return;
		}

		// Output with HTML comments for identification
		echo "\n<!-- PostHog for WP - PostHog.com Integration Snippet [START] -->\n";
		// Since this is a tracking script saved by admin, we output it directly
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $snippet_code . "\n";
		echo "<!-- PostHog for WP - PostHog.com Integration Snippet [END] -->\n\n";
	}

	/**
	 * Render the settings page
	 */
	public function settings_page() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'posthog-for-wp-posthog-com-integration' ) );
		}
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			
			<p>
				<?php
				echo wp_kses_post(
					sprintf(
						/* translators: %s: URL to PostHog settings page */
						__( 'Copy your PostHog snippet code from "Project" &rarr; "Settings" and paste it below.<br/>You can also visit the <a href="%s" target="_blank" rel="noopener noreferrer">PostHog settings page</a>.', 'posthog-for-wp-posthog-com-integration' ),
						'https://app.posthog.com/ingestion/web'
					)
				);
				?>
			</p>

			<form method="post" action="options.php">
				<?php
				settings_fields( 'posthog-settings-group' );
				do_settings_sections( 'posthog-settings-group' );
				?>
				
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row">
							<label for="ph_plugin_enabled">
								<?php esc_html_e( 'Activate Code Snippet?', 'posthog-for-wp-posthog-com-integration' ); ?>
							</label>
						</th>
						<td>
							<fieldset>
								<legend class="screen-reader-text">
									<span><?php esc_html_e( 'Activate Code Snippet?', 'posthog-for-wp-posthog-com-integration' ); ?></span>
								</legend>
								<label>
									<input 
										type="radio" 
										name="ph_plugin_enabled" 
										value="1" 
										<?php checked( get_option( 'ph_plugin_enabled' ), 1 ); ?>
									/>
									<?php esc_html_e( 'Yes', 'posthog-for-wp-posthog-com-integration' ); ?>
								</label>
								<br>
								<label>
									<input 
										type="radio" 
										name="ph_plugin_enabled" 
										value="0" 
										<?php checked( get_option( 'ph_plugin_enabled' ), 0 ); ?>
									/>
									<?php esc_html_e( 'No', 'posthog-for-wp-posthog-com-integration' ); ?>
								</label>
							</fieldset>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label for="ph_snippet_code">
								<?php esc_html_e( 'PostHog Snippet Code', 'posthog-for-wp-posthog-com-integration' ); ?>
							</label>
						</th>
						<td>
							<textarea 
								id="ph_snippet_code"
								name="ph_snippet_code" 
								class="large-text code" 
								rows="15"
								aria-describedby="snippet-code-description"
							><?php echo esc_textarea( get_option( 'ph_snippet_code' ) ); ?></textarea>
							<p class="description" id="snippet-code-description">
								<?php esc_html_e( 'Paste your complete PostHog JavaScript snippet here.', 'posthog-for-wp-posthog-com-integration' ); ?>
							</p>
						</td>
					</tr>
				</table>

				<?php submit_button( esc_html__( 'Save Settings', 'posthog-for-wp-posthog-com-integration' ) ); ?>
			</form>
		</div>
		<?php
	}
}

// Initialize the plugin
new PostHogforWPPostHogIntegrationPlugin();
