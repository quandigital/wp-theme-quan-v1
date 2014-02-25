$('.tags a').click(function(ev){

    ev.preventDefault();
    var tagID = $(this).parent().attr('id');

    var queryUrl = ajaxpost_localization.blog_url + '?tag=' + tagID ;

    window.location.href = queryUrl;
});
