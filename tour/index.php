<?php require_once('header.php'); ?>

	<div id="logo-home">
		<a href="<?php bloginfo( 'wpurl' ); ?>"><?php include( 'images/QuanDigital.svg' ); ?></a>
	</div>	
	<?php 
		//the content
	?>
		<section id="intro">
			<p><?php _e( 'Quan Digital began with the idea of providing better online marketing through innovative technology, high standards and a passion for our customers.', 'quan' ); ?></p>
			<div id="dang-1"><?php _e( 'Every brand has its own unique story.', 'quan' ); ?></div>
			<div id="dang-2"><?php _e( 'We tell it.', 'quan' ); ?></div>
		</section>

		<section id="consulting">
			<?php include( 'islands/consulting.php' ); ?>
		</section>

		<section id="content">
			<?php include( 'islands/content.php' ); ?>
		</section>

		<section id="socialmedia">
			<?php include( 'islands/socialmedia.php' ); ?>
		</section>

		<section id="visibility">
			<?php include( 'islands/linkbuilding.php' ); ?>
		</section>

		<section id="cpc">
			<?php include( 'islands/display.php' ); ?>
		</section>

		<section id="services">
			<?php include( 'islands/outreach.php' ); ?>
		</section>
		
		
		<?php include( 'contact.php' ); ?>
		<?php include( 'shipwreck.php' ); ?>
		
	<?php
		//the travel path svg
	?>
		<svg id="map-path" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 width="2000px" height="1000px" xml:space="preserve">
			<path id="travelPathIslandOne"></path>
			<path id="travelPathIslandTwo"></path>
			<path id="travelPathIslandThree"></path>
			<path id="travelPathIslandFour"></path>
			<path id="travelPathIslandFive"></path>
			<path id="travelPathIslandSix"></path>
		</svg>
	
	<?php
		//the landmass in the lower right corner
	?>
		<div id="land">
			<?php include( 'images/landmasse-prod.svg' ); ?>
		</div>
	<?php
		//the border or frame
		//shame on presentational markup
	?>
		<div id="left"></div>
		<div id="right"></div>
		<div id="top"></div>
		<div id="bottom"></div>

		<div id="frame"></div>
		<div id="inner-frame"></div>
	
	<?php
		//the islands svg
	?>
		<div class="map">
			<?php include( 'images/islands.svg' ); ?>
		</div>
	
	<?php include( 'click-navigation.php' ); ?>

	<?php 
		//the sailing ship
	?>

		<div id="sail">
			<?php include( 'images/sail.svg' ); ?>
		</div>

		<?php include( 'straight-navigation.php' ); ?>

	<?php
		//the QUAN
	?>

		<div id="instructions">
			<p><?php _e( 'Please use the scroll wheel of your mouse or the arrow keys on your keyboard to naviagte the page', 'quan' ); ?></p>
			<div id="mouse">
				<div class="clicks"></div>
				<div class="body"></div>
				<div class="back"></div>
			</div>

			<div id="or"><?php _e( 'OR', 'quan'); ?></div>

			<div id="keyboard">
				<div class="left-arrow">
					<span class="ion-ios7-skipbackward"></span>
					<div class="explanation">
						<?php _e( 'Next <abbr title="Point of Interest">POI</abbr>', 'quan' ); ?>
					</div>
				</div>
				<div class="down-arrow">
					<span class="ion-ios7-fastforward"></span>
					<div class="explanation">
						<?php _e( 'Keep the "down"-arrow pressed to travel.<br />Release it to stop.', 'quan' ); ?>
					</div>
				</div>
				<div class="right-arrow">
					<span class="ion-ios7-skipforward"></span>
					<div class="explanation">
						<?php _e( 'Previous <abbr title="Point of Interest">POI</abbr>', 'quan' ); ?>
					</div>
				</div>
				<div class="up-arrow">
					<span class="ion-ios7-rewind"></span>
					<div class="explanation">
						<?php _e( 'Keep the "up"-arrow pressed to travel backwards.<br />Release it to stop.', 'quan' ); ?>
					</div>
				</div>
			</div>
		</div>
		

	<!--div id="counter"></div-->

<?php require_once('footer.php'); ?>