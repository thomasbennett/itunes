(function($) {
	
	//tabs
	var tweetbox = $("#tweetbox"),
		tweetData = null,
		friendData = null,
		followData = null;

	tweetbox.find("a").click(function(e) {
		e.preventDefault();
		
		var link = $(this),
			target = link.attr("href").split("#")[1];

		tweetbox.find(".on").removeClass("on");
		link.addClass("on");
		
		tweetbox.find("#feed > div").hide();
		tweetbox.find("#" + target).show();
	});
	
	//format date
	convertDate = function(obj, i) {
		var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
			date = new Date(obj[i].created_at),
			formattedTimeStampArray = [days[obj[i].created_at], date.toLocaleDateString(), date.toLocaleTimeString()];
			
		return formattedTimeStampArray.join(" ");
	}
	
	//format text
	formatTweet = function(obj, i) {
				
			
	}
	
	//ajax defaults
	$.ajaxSetup({
		dataType: "jsonp"
	}).ajaxError(function(data) {
		alert("error")
	});
	
	//get twitter data
	function getTweets() {
		$.ajax("http://api.twitter.com/statuses/user_timeline/danwellman.json");
	}
	function getFriends() {
		return $.ajax("http://api.twitter.com/1/statuses/friends/danwellman.json", {
			success: function(data) {
				
				//get first 5 items
				var arr = [];
				
				for (var x = 0; x < 5; x++) {
					var dataItem = {};
					dataItem["screenname"] = data[x].screen_name;
					dataItem["img"] = data[x].profile_image_url;
					dataItem["name"] = data[x].name;
					dataItem["desc"] = data[x].description;
					arr.push(dataItem);
				}
				
				friendData = arr;
			}
		});
	}
	function getFollows() {
		return $.ajax("http://api.twitter.com/1/statuses/followers/danwellman.json", {
			success: function(data) {
				
				//get first 5 items
				var arr = [];
				
				for (var x = 0; x < 5; x++) {
					var dataItem = {};
					dataItem["screenname"] = data[x].screen_name;
					dataItem["img"] = data[x].profile_image_url;
					dataItem["name"] = data[x].name;
					dataItem["desc"] = data[x].description;
					arr.push(dataItem);
				}
				
				followData = arr;
			}
		});
	}
	
	//execute once all requests complete
	$.when(getTweets(), getFriends(), getFollows()).then(function(){
		
		//apply templates
		tweetbox.find("#tweetTemplate").tmpl(tweetData).appendTo("#tweetList");
		tweetbox.find("#ffTemplate").tmpl(friendData).appendTo("#friendList");
		tweetbox.find("#ffTemplate").tmpl(followData).appendTo("#followList");
		
		//show tweets
		tweetbox.find("#tweets").show();
		
	});
})(jQuery);