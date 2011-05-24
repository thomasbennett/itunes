<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>iTunes Top Songs - Weekly Chart</title>
        <!--[if lte IE 8]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <link rel="stylesheet" type="screen" href="tweetbox.css" type="text/css" />
        <style>
div.jquery_jplayer_1 {
  display: block;
  left: 20px;
  position: absolute;
  top: 20px;
  width: 265px;
  z-index: 999;
}

div.jp-audio {
  /*
    background: #454545;
    border-radius: 10px;
    -webkit-box-shadow: inset 0px 0px 12px #000;
    padding: 10px;
  */
  position: absolute;
  right: 0;
  top: 165px;
  width: 245px;
}

div.jp-audio ul {
  list-style: none;
}

.jp-controls {
  list-style: none;
  width: 300px;
}

.jp-controls li {
  float: left;
  height: 30px;
  margin-right: 5px;
  width: 45px;
}
</style>        
    </head>
    <body>
		<aside id="feedbox">
            <div id="feed">
            	<div id="tweets">
                	<noscript>This widget has super-awesome features which require the use of JavaScript. Please enable it for a better internet experience</noscript>
                    <ol id="itunes-feed"></ol>
                    <script id="itunes" type="text/x-jquery-tmpl">
                        <li>
                            <span class="chart-item">
                                <img src="${image}" alt="${artist} | ${songName}" class="left itunes-img" />
                                <div class="songName">${songName}</div>
                                <div class="artistName">${artist}</div>
                                <a class="songPlayer sm2_link" href="${player}">Play me!</a>
                            </span>
                        </li>
                    </script>

                    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                    <div class="jp-audio">
                      <div class="jp-type-single">
                        <div id="jp_interface_1" class="jp-interface">
                            <ul class="jp-controls">
                              <li><a href="#" class="btn corners jp-play" tabindex="1" onclick="javascript:void()">Pause</a></li>
                              <li><a href="#" class="btn corners jp-stop" tabindex="2" onclick="javascript:void()">Stop</a></li>
                            </ul>

                          <div class="jp-progress">
                            <div class="jp-seek-bar">
                              <div class="jp-play-bar"></div>
                            </div>
                          </div>
                          <div class="jp-current-time"></div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="inspctr"></div>
        </aside>
        <script src="jquery.js"></script>
        <script src="jquery.tmpl.min.js"></script>
        <script src="jquery.jplayer.min.js"></script>
        <script src="inspctr.js"></script>

        <script>
            // grabbing the itunes json feed
            jQuery(function($){
                $('.inspctr').jPlayerInspector({jPlayer:$('#jquery_player_1')});

                // itunes top songs feed
                feed = <?php echo file_get_contents('http://itunes.apple.com/us/rss/topsongs/limit=10/explicit=true/json'); ?>;

                var songs = [];
                $.each(feed['feed']['entry'], function(index, obj){
                    songs.push({
                        image: obj['im:image'][2]['label'],
                        songName: obj['im:name']['label'],
                        artist: obj['im:artist']['label'],
                        player: obj['link'][1]['attributes']['href']
                    });
                });
                $('#itunes').tmpl(songs).appendTo('#itunes-feed');
                $('#itunes-feed').find('li:nth-child(even)').addClass('even');
            });
        </script>
    </body>
</html>
