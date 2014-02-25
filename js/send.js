$(document).ready(function(){

	$('#submit').click(function(e){
		e.preventDefault(); 
		$.post(message_localization.send_php, $("#contact-form").serialize(),  function(response) {
			$('#mail-success').html(response);
			sentModal();
		});
		return false;
	});

	$('body').click(function(){
		$('#mail-success').fadeTo(300, 0);
		setTimeout( function(){
			$('#mail-success').css({
				'display':'none'
			});
		}, 300);
	});

});

function sentModal() {
	$('#mail-success').css('disoplay','block');
	setTimeout(function(){
		$('#mail-success').fadeTo(300, 1);
	}, 50);

	sentModalDim();
}

function sentModalDim() {
	console.log($('#mail-success').outerWidth());
	$('#mail-success').css({
			'margin-top': $('#mail-success').outerHeight()/-2,
			'margin-left': $('#mail-success').outerWidth()/-2
	});
	//stupid redundany, otherwise jquery does not know how big the modal is
	setTimeout(function(){
		$('#mail-success').css({
			'margin-top': $('#mail-success').outerHeight()/-2,
			'margin-left': $('#mail-success').outerWidth()/-2
		});
	},50);
	console.log($('#mail-success').outerWidth());
}