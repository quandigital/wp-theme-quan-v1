$.urlParam = function(name){
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

window.quanLang = $.urlParam('lang');

if( quanLang ) {
	window.history.replaceState( quanLang, 'BOO', './' );
}
