$('a.ajax').removeClass('current');
$('a.ajax').addClass('current'); //adds class current to the category menu item being displayed so you can style it with css
$('#category-menu a').click(function(ev){

    ev.preventDefault();
    var catID = $(this).parent().attr('id');
    
    var queryStrings = {
        id: catID
    }
    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            action: 'quan_query_posts',
            query_strings: queryStrings 
        },
        success: function(response) {
            var newPostIDs = $.parseJSON(response);
            var currentPostIDs = $.parseJSON( $('#postids').val() );
            var toRemove = $.map( currentPostIDs, function( val ) { return val; });
            var toStay = newPostIDs;
            var toStay = $.map( newPostIDs, function( val ) { return val; });

            $.each( newPostIDs, function( index,value ) {
                toRemove.splice($.inArray(value, toRemove), 1);
            });
            
            newPostIDs.reverse();
            $.each( newPostIDs, function( i, val ) {
                $('#post-' + val).prependTo('#loop .main-loop');
            });

            $.each( toStay, function( i,val ) {
                $('#post-' + val).fadeTo(500,1);
            }); 

            $.each( toRemove, function( i,val ) {
                $('#post-' + val).fadeTo(500,0);
            }); 

            console.log([ currentPostIDs, newPostIDs, toRemove, toStay ]);
            return false;
        }
    });
});