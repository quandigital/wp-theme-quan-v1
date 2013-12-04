<?php 
	/*
		Template Name: Easy Contact Form
	*/
?>

	<section id="contact">
		<h2>Heuern Sie uns an</h2>

		<form id="contact-form" action="send.php" method="post">
			<input type="email" name="email" placeholder="E-Mail"/>
			<input type="tel" name="tel" placeholder="Telefonnummer" />
			<input type="text" name="subject" placeholder="Betreff" />
			<label id="leave_me" for="leave_me">Bitte leer lassen um das Kontakformular abzusenden
				<input type="text" name="leave_me" placeholder="Leer lassen" />
			</label>
			<input type="submit" id="submit" />
		</form>

	</section>

	<div id="mail-success" class="modal"></div>
