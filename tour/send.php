<?php
	define( 'WP_USE_THEMES', false );
	require( '../wp-load.php' );

	//process the contact form
	if( !empty( $_POST['leave_me']) ) {
		echo 'Shame on you';
		die();
	}

	$mail    = $_POST['email'];
	$tel     = $_POST['tel'];
	$subject = $_POST['subject'];

	$to = get_option( 'quan_contact_email' );
	$subject = $subject;
	$message = 'FROM: ' . $mail . "\n Tel: " . $tel . "\n Message: " . $subject;
	$headers = 'From: mail@quandigital.com' . "\r\n" . 'Reply-To: ' . $mail;

	$errors = array();
	if( empty($tel) ) {
		$errors['tel'] = true;
	}
	
	if( empty($mail) ) {
		$errors['mail'] = true;
	}
	
	if( empty($subject) ) {
		$errors['subject'] = true;
	}

	if( ! isset( $errors ) || empty( $errors ) ) {
		if( filter_var($mail, FILTER_VALIDATE_EMAIL) ) { 
			mail($to, $subject, $message, $headers);
			echo '<h2>' . __( 'Your Message has been sent.', 'quan' ) . '</h2><p>' . __( 'We will get back to you shortly!', 'quan' ) . '</p><div class="ion-ios7-close-empty" id="modal-close"><div>';
		} else {
			echo '<h2>&middot;&middot;&middot;---&middot;&middot;&middot; &middot;&middot;&middot;---&middot;&middot;&middot; &middot;&middot;&middot;---&middot;&middot;&middot;</h2><p>' . __( 'Please enter a valid email address.', 'quan' ) . '</p><div class="ion-ios7-close-empty" id="modal-close"><div>';
		}
	} else {
		$response  = '<h2>&middot;&middot;&middot;---&middot;&middot;&middot; &middot;&middot;&middot;---&middot;&middot;&middot; &middot;&middot;&middot;---&middot;&middot;&middot;</h2><div class="ion-ios7-close-empty" id="modal-close"><div></div></div>';

		if( isset($errors['mail']) ) {
			$response .= '<p>' . __( 'Please enter an email address.', 'quan' ) . '</p>';
		}

		if( isset($errors['tel']) ) {
			$response .= '<p>' . __( 'Please enter a phone number.', 'quan' ) . '</p>';
		}

		if( isset($errors['subject']) ) {
			$response .= '<p>' . __( 'Please enter a subject.', 'quan' ) . '</p>';
		}
				
		echo $response;
		include( './images/shipwreck.svg' );
	}