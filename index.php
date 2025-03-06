<?php
/**
 * Plugin Name: Custom User Login
 * Description: A simple plugin to add a custom login form.
 * Version: 1.0.0
 * Author: John Paul Clam
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Function to generate the login form HTML
function custom_login_form() {
	ob_start(); // Start output buffering

	if ( is_user_logged_in() ) {
		$current_user = wp_get_current_user();
		echo '<p>You are already logged in as ' . esc_html( $current_user->display_name ) . '.  <a href="' . esc_url( wp_logout_url( home_url() ) ) . '">Log out?</a></p>';
	} else {
		?>
		<div id="custom-login-form">
			<form name="loginform" id="loginform" action="<?php echo esc_url( site_url( 'wp-login.php' ) ); ?>" method="post">
				<p>
					<label for="user_login"><?php _e( 'Username or Email', 'custom-login' ); ?></label><br />
					<input type="text" name="log" id="user_login" class="input" value="<?php echo esc_attr( wp_get_session_token() ); ?>" size="20" autocapitalize="off" />
				</p>
				<p>
					<label for="user_pass"><?php _e( 'Password', 'custom-login' ); ?></label><br />
					<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" />
				</p>
				<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember Me', 'custom-login' ); ?></label></p>
				<p class="submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="<?php esc_attr_e( 'Log In', 'custom-login' ); ?>" />
					<input type="hidden" name="redirect_to" value="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" />
				</p>
			</form>
			<p id="nav">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'custom-login' ); ?></a>
				<?php if ( get_option( 'users_can_register' ) ) : ?>
					<br />
					<a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php _e( 'Register', 'custom-login' ); ?></a>
				<?php endif; ?>
			</p>
		</div>
		<?php
	}

	return ob_get_clean(); // Return the buffered output
}

// Add a shortcode to display the login form
add_shortcode( 'custom_login_form', 'custom_login_form' );

// Function to handle login errors.  This example just displays them on the same page.  You could also redirect to a specific error page.
add_action( 'wp_login_failed', 'custom_login_failed' );

function custom_login_failed( $username ) {
    $login_page  = home_url( '/login/' ); // Replace with the URL of your login page
    $login_page = add_query_arg( 'login', 'failed', $login_page );
    wp_redirect( $login_page );
    exit;
}

// Handle login errors on the login page.  You can adjust the error message.
add_action( 'init', 'custom_check_login_errors' );

function custom_check_login_errors() {
  if ( isset( $_GET['login'] ) && $_GET['login'] == 'failed' ) {
    add_action( 'the_content', 'custom_login_error_message' );
  }
}

function custom_login_error_message( $content ) {
  if ( is_page( 'login' ) ) { // Replace 'login' with your login page's slug
    $error_message = '<div class="login-error"><strong>ERROR</strong>: Incorrect username or password.</div>';
    $content = $error_message . $content;
  }
  return $content;
}

// Optional:  Add some basic CSS styling.  You should enqueue this in a real plugin!
function custom_login_styles() {
  echo '<style type="text/css">
		#custom-login-form {
			max-width: 400px;
			margin: 20px auto;
			padding: 20px;
			border: 1px solid #ccc;
			background-color: #f9f9f9;
			border-radius: 5px;
		}
		#custom-login-form p {
			margin-bottom: 10px;
		}
		#custom-login-form label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}
		#custom-login-form .input {
			width: 100%;
			padding: 8px;
			border: 1px solid #ccc;
			border-radius: 3px;
			box-sizing: border-box;
		}
		#custom-login-form .submit {
			text-align: center;
		}
		#custom-login-form .login-error {
			color: red;
			margin-bottom: 10px;
			padding: 8px;
			border: 1px solid red;
			background-color: #ffebee;
			border-radius: 3px;
		}
    </style>';
}
add_action( 'wp_head', 'custom_login_styles' );


// Optional:  Enable translation.  Create a /languages/ folder in your plugin directory.
function custom_login_load_textdomain() {
	load_plugin_textdomain( 'custom-login', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'custom_login_load_textdomain' );

?>
