var catID = $.urlParam('cat');
var tagID = $.urlParam('tag');


window.history.replaceState( history.state, 'BOO', './' );

if( catID !== null ) {
    
    var queryStrings = {
        cat_id: catID,
    }
    quanAjaxPosts( queryStrings );
}

if( tagID !== null ) {
    
    document.getElementById("tweetfilter").checked = false;

    var queryStrings = {
        tag_id: tagID,
        lang: $('#language-filter').val(),
    }

    quanAjaxPosts( queryStrings );
}

window.catCopy = 'all';

// $('#category-menu a').click(function(ev){

//     ev.preventDefault();
//     var catID = $(this).parent().attr('id');
//     var categoryName = $(this).text();
//     catCopy = catID;

//     $('#nothing-here').remove();
    
//     showHideLoading();

//     var queryStrings = {
//         cat_id: catID,
//         lang: $('#language-filter').val()
//     }
//     quanAjaxPosts( queryStrings );

//     $('.filter h2').fadeTo(500,0, function() { 
//         $('.filter h2').text( categoryName ) 
//     });
    
//     setTimeout(function(){
//         $('.filter h2').fadeTo(500,1);
//     }, 1000);
// });

$(document).ready(function(){
    $('#language-filter').show();
});

$('#language-filter').change(function(){
    $('#nothing-here').remove();

    showHideLoading();
    
    var queryStrings = {
        lang: $(this).val(),
        cat_id: catCopy,
        twitter: $('#tweetfilter').is(':checked')
    }
    quanAjaxPosts( queryStrings );
});

$('#tweetfilter').change(function(){
    $('#nothing-here').remove();

    showHideLoading();
    
    var queryStrings = {
        lang: $('#language-filter').val(),
        cat_id: catCopy,
        twitter: $(this).is(':checked')
    }
    quanAjaxPosts( queryStrings );
});

function quanAjaxPosts( queryStrings ) {
    $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            action: 'quan_query_posts',
            query_strings: queryStrings 
        },
        success: function(response) {
            // console.log( response );
            // return false;
            var newPostIDs = $.parseJSON(response);
            var currentPostIDs = $.parseJSON( $('#postids').val() );
            var toRemove = $.map( currentPostIDs, function( val ) { return val; });
            var toStay = newPostIDs;
            var toStay = $.map( newPostIDs, function( val ) { return val; });


            $.each( newPostIDs, function( index,value ) {
                toRemove.splice($.inArray(value, toRemove), 1);
            });

            setTimeout(function(){
                $.each( toStay, function( i,val ) {
                    $('#post-' + val).fadeTo(1000,1);
                }); 
            },550);

            $.each( toRemove, function( i,val ) {
                $('#post-' + val).fadeTo(500,0);
                setTimeout(function(){
                    $('#post-' + val).hide();
                },550);
            }); 

            newPostIDs.reverse();
            $.each( newPostIDs, function( i, val ) {
                setTimeout(function(){
                    $('#post-' + val).prependTo('#loop .main-loop');
                },550);
            });

            if( newPostIDs.length === 0 ) {
                if( $('#nothing-here').length === 0 ) {
                    setTimeout(function() {
                        $('#loop').append( ajaxpost_home_localization.nothing_here );
                    },900);
                }
            }
            setTimeout(function(){
                resetHeights();
            }, 550);
            setTimeout(function(){
                tweetAuthorPosition();
            }, 550);

            return false;
        }
    });
}

function showHideLoading() {
    
    $('#loading-canvas').css({
        'position':'fixed',
        'top': 0,
        'left': 0,
        'right': 0,
        'bottom': 0,
        'z-index': 9,
        'background-color': 'rgba(136,182,229,.4)'
    });

    var opts = {
        lines: 13, // The number of lines to draw
        length: 14, // The length of each line
        width: 10, // The line thickness
        radius: 22, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#000', // #rgb or #rrggbb or array of colors
        speed: 1, // Rounds per second
        trail: 51, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: true, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: 'auto', // Top position relative to parent in px
        left: 'auto' // Left position relative to parent in px
    };

    var target = document.getElementById('loading-canvas');
    var spinner = new Spinner(opts).spin(target);

    setTimeout(function(){
        $('#loading-canvas').css({
            'z-index': -9,
            'background-color': 'none'
        });
        spinner.stop();
    },1000);

}