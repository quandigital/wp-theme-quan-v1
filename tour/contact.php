<?php 
	//easy contact form
?>

	<div id="end-ship">
		<?php 
			include( 'images/ship2.svg' );
		?>
	</div>

	<div id="end-logo">
		<a href="<?php bloginfo( 'wpurl' ); ?>">
			<?php 
				include( 'images/logo-blue.svg' );
			?>
		</a>
	</div>

	<section id="contact">
		<h2><?php _e( 'Get on board!', 'quan'); ?></h2>

		<form id="contact-form" action="send.php" method="post">
			<input type="email" name="email" placeholder="<?php _ex( 'E Mail', 'Contactform placeholder', 'quan' ); ?>"/>
			<input type="tel" name="tel" placeholder="<?php _ex( 'Phone', 'Contactform placeholder', 'quan' ); ?>" />
			<input type="text" name="subject" placeholder="<?php _ex( 'Subject', 'Contactform placeholder', 'quan' ); ?>" />
			<label id="leave_me" for="leave_me"><?php _ex( 'Please leave empty to send the contact form.', 'Spam Prevention', 'quan' ); ?>
				<input type="text" name="leave_me" placeholder="<?php _ex( 'Please leave empty', 'Spam Prevention', 'quan' ); ?>" />
			</label>
			<input type="submit" id="submit" value="<?php _e( 'Send', 'quan' ); ?>" />
		</form>

	</section>

	<div id="mail-success" class="modal"></div>
