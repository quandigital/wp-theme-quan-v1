$('#lang-change').change( function(){
	$.cookie( 'lang', $(this).val(), { path: '/' } );
	$(window).scrollTop(0);
	location.reload();
});