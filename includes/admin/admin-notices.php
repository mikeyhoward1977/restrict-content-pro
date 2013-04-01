<?php

function rcp_admin_notices() {
	global $rcp_options;

	$message = ! empty( $_GET['rcp_message'] ) ? urldecode( $_GET['rcp_message'] ) : false;
	$class   = 'updated';
	$text    = '';

	// only show notice if settings have never been saved
	if( ! is_array( $rcp_options ) || empty( $rcp_options ) ) {
		echo '<div class="updated"><p>' . __( 'You should now configure your Restrict Content Pro settings', 'rcp' ) . '</p></div>';
	}

	if( rcp_check_if_upgrade_needed() ) {
		echo '<div class="error"><p>' . __( 'The Restrict Content Pro database needs updated: ', 'rcp' ) . ' ' . '<a href="' . esc_url( add_query_arg( 'rcp-action', 'upgrade', admin_url() ) ) . '">' . __( 'upgrade now', 'rcp' ) . '</a></p></div>';
	}
	if( isset( $_GET['rcp-db'] ) && $_GET['rcp-db'] == 'updated' ) {
		echo '<div class="updated fade"><p>' . __( 'The Restrict Content Pro database has been updated', 'rcp' ) . '</p></div>';
	}


	switch( $message ) :

		case 'payment_deleted' :

			$text = __( 'Payment deleted', 'rcp' );
			break;

		case 'upgrade-complete' :

			$text =  __( 'Database upgrade complete', 'rcp' );
			break;

		case 'user_added' :

			$text = __( 'The user\'s subscription has been added', 'rcp' );
			break;

		case 'user_not_added' :

			$text = __( 'The user\'s subscription could not be added', 'rcp' );
			$class = 'error';
			break;

		case 'user_updated' :

			$text = __( 'Member updated' );
			break;

	endswitch;

	if( $message )
		echo '<div class="' . $class . '"><p>' . $text . '</p></div>';

}
add_action( 'admin_notices', 'rcp_admin_notices' );