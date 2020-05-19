<?php
class Register_IP_Multisite {

	/**
	 * Let's get this party started
	 *
	 * @since 1.7
	 * @access public
	 */

	public function __construct() {
		add_action( 'init', array( &$this, 'init' ) );
	}

	/**
	 * All init functions
	 *
	 * @since 1.7
	 * @access public
	 */

	public function init() {
		add_action( 'user_register', array( $this, 'log_ip' ) );
		add_action( 'edit_user_profile', array( $this, 'edit_user_profile' ) );
		add_filter( 'plugin_row_meta', array( $this, 'donate_link' ), 10, 2 );
		add_action( 'manage_users_custom_column', array( $this, 'manage_users_custom_column' ), 10, 3 );
		add_filter( 'pre_get_users', array( $this, 'columns_sortability' ), 10, 2 );
		add_filter( 'manage_users_sortable_columns', array( $this, 'manage_users_sortable_columns' ) );

		if ( is_multisite() ) {
			add_filter( 'wpmu_users_columns', array( $this ,'column_header_signup_ip' ) );
		} else {
			add_filter( 'manage_users_columns', array( $this ,'column_header_signup_ip' ) );
		}

	}

	/**
	 * Log the IP address
	 *
	 * @since 1.0
	 * @access public
	 */
	public function log_ip($user_id){
		//Get the IP of the person registering
		$ip = $_SERVER['REMOTE_ADDR'];

		// If there's forwarding going on...
		if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$http_x_headers = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
			$ip             = sanitize_text_field( $http_x_headers[0] );
		}
		update_user_meta( $user_id, 'signup_ip', $ip ); //Add user metadata to the usermeta table
	}

	/**
	 * Show the IP on a profile
	 *
	 * @since 1.0
	 * @access public
	 */
	public function edit_user_profile() {
			$user_id = (int) $_GET['user_id'];
	?>
			<h3><?php _e( 'Signup IP Address', 'register-ip-mutisite' ); ?></h3>
			<p style="text-indent:15px;"><?php
			$ip_address = get_user_meta( $user_id, 'signup_ip', true );
			echo esc_html( $ip_address );
			?></p>
	<?php
	}

	/**
	 * Column Header
	 *
	 * @since 1.0
	 * @access public
	 */
	public function column_header_signup_ip( $column_headers ) {
		$column_headers['signup_ip'] = __( 'IP Address', 'register-ip-multisite' );
		return $column_headers;
	}

	/*
	 * Make Custom Columns Sortable
	 *
	 * @since 1.8.0
	 * @access public
	 */
	public function manage_users_sortable_columns( $columns ) {
		$columns['signup_ip']  = 'signup_ip';
		return $columns;
	}

	/*
	 * Create columns sortability for IP
	 *
	 * @since 1.8.0
	 * @access public
	 */
	public function columns_sortability( $query ) {
		if ( 'signup_ip' == $query->get( 'orderby' ) ) {
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'meta_key', 'signup_ip' );
		}
	}

	/**
	 * Column Output
	 *
	 * @since 1.0
	 * @access public
	 */
	public function manage_users_custom_column( $value, $column_name, $user_id ) {
		if ( $column_name == 'signup_ip' ) {
			$ip    = get_user_meta( $user_id, 'signup_ip', true );
			$value = '<em>'.__( 'None Recorded', 'register-ip-multisite' ).'</em>';
			if ( isset( $ip ) && $ip !== "" && $ip !== "none" ){
				$value = $ip;
				if ( has_filter( 'ripm_show_ip' ) ) {
					$value = apply_filters( 'ripm_show_ip', $value );
				}
			} else {
				update_user_meta( $user_id, 'signup_ip', 'none' );
			}
		}
		return $value;
	}

	/**
	 * Slap a donate link back into the plugin links. Show some love
	 *
	 * @since 1.0
	 * @access public
	 */
	public function donate_link($links, $file) {
		if ( $file == plugin_basename( __FILE__ ) ) {
			$donate_link = '<a href="https://ko-fi.com/A236CEN/">Donate</a>';
			$links[] = $donate_link;
		}
		return $links;
	}

}

new Register_IP_Multisite();
?>
