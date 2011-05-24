(function($) {  	
    var songs = [];
    $.each(feed['feed']['entry'], function(index, obj){
        console.log(obj);
        //songs.push({
            //artist: obj['im:artist']
        //});
    });
    $('#itunes').tmpl(songs).appendTo('#itunes-feed');
})(jQuery);
