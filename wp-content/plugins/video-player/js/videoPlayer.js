
(function($){

    $.fn.Video = function(options, callback)
    {
        return(new Video(this, options));
    };

var idleEvents = "mousemove keydown DOMMouseScroll mousewheel mousedown reset.idle";

var defaults = {
	skinPlayer:"Default",
	skinPlaylist:"Default",
    playerShadow:true,
    autoplay:false,
    autohideControls:4,
    videoPlayerWidth:746,
    videoPlayerHeight:420,
    posterImg:"images/preview_images/3.jpg",
    playlist:true,
    // playNextOnFinish:true,
    onFinish:"Play next video", //or "Restart video" or "Stop video"
    fullscreen_browser:false,
    // restartOnFinish:true,
	shareShow:"Yes",
	facebookLink:"http://codecanyon.net/",
	twitterLink:"http://codecanyon.net/",
//	myspaceLink:"http://codecanyon.net/",
//	wordpressLink:"http://codecanyon.net/",
//	linkedinLink:"http://codecanyon.net/",
//	flickrLink:"http://codecanyon.net/",
//	bloggerLink:"http://codecanyon.net/",
//	deliciousLink:"http://codecanyon.net/",
//	mailLink:"http://codecanyon.net/",
    nowPlayingText:"Yes",
    logoShow:"Yes",
    logoClickable:"Yes",
    logoPath:"images/logo/logo.png",
    logoGoToLink:"http://codecanyon.net/",
    logoPosition:"bottom-right",
    embedShow:"Yes",
    embedCodeSrc:"www.yourwebsite.com/player/index.html",
	embedCodeW:"746",
	embedCodeH:"420",
    videos:[
        {
            id:0,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:1,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:2,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:3,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:4,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:5,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:6,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:7,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:8,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        },
        {
            id:9,
            title:"Logo reveal",
            videoType:"HTML5",
            youtubeID:"",
            vimeoID:"",
            mp4:"videos/video3.mp4",
            webm:"videos/video3.webm",
            // ogv:"videos/video3.ogv",
            description:"Video description goes here.",
            thumbImg:"images/thumbnail_images/pic3.jpg",
            info:"Video info goes here"
        }
    ]
//      controls: false,
//      preload:  "auto",
//      poster:   "",
//      srcs:     [],
//      keyShortcut: true,
//      xml: "xml/videoPlayer.xml"
};

var isTouchPad = (/hp-tablet/gi).test(navigator.appVersion),
    hasTouch = 'ontouchstart' in window && !isTouchPad,
    RESIZE_EV = 'onorientationchange' in window ? 'orientationchange' : 'resize',
    CLICK_EV = hasTouch ? 'touchend' : 'click',
    START_EV = hasTouch ? 'touchstart' : 'mousedown',
    MOVE_EV = hasTouch ? 'touchmove' : 'mousemove',
    END_EV = hasTouch ? 'touchend' : 'mouseup';


var Video = function(parent, options)
{
    var self=this;
      this._class  = Video;
      this.parent  = parent;
      this.options = $.extend({}, defaults, options);
      this.sources = this.options.srcs || this.options.sources;
      this.state        = null;
      this.inFullScreen = false;
	  this.realFullscreenActive=false;
      this.stretching = false;
      this.infoOn = false;
      this.shareOn = false;
      this.embedOn = false;
      pw = false;
      this.loaded       = false;
      this.readyList    = [];

    this.hasTouch = hasTouch;
    this.RESIZE_EV = RESIZE_EV;
    this.CLICK_EV = CLICK_EV;
    this.START_EV = START_EV;
    this.MOVE_EV = MOVE_EV;
    this.END_EV = END_EV;

    this.canPlay = false;
    this.myVideo = document.createElement('video');
console.log("videoPlayer.js")
    //remove right-click menu
    /***$("#video").bind('contextmenu',function() { return false; });***/
	var tag = document.createElement('script');
//      tag.src = "https://www.youtube.com/player_api"; // Take the API address.
      tag.src = "https://www.youtube.com/iframe_api"; // Take the API address.
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag); // Include the API inside the page.

    /*var tag2 = document.createElement('script');
//    tag2.src = "http://a.vimeocdn.com/js/froogaloop2.min.js"; // Take the API address.
    tag2.src = "http://f.vimeocdn.com/js_opt/froogaloop2.min.js?bfeb60ee"; // Take the API address.
    var firstScriptTag2 = document.getElementsByTagName('script')[0];
    firstScriptTag2.parentNode.insertBefore(tag2, firstScriptTag2); // Include the API inside the page.*/
	console.log(tag)
    /* $('<script src="http://www.youtube.com/player_api" />').appendTo("head"); */


    /*****this.loadFontAwesome("wp-content/plugins/video-player/css/font-awesome.css");
	this.loadCSSMain("wp-content/plugins/video-player/css/videoPlayerMain.css");

	if(this.options.skinPlayer == "Default"){
		this.loadCSSTheme("wp-content/plugins/video-player/css/videoPlayer.theme1.css");
	}
	if(this.options.skinPlaylist == "Default"){
		this.loadCSSThemePlaylist("wp-content/plugins/video-player/css/videoPlayer.theme1_Playlist.css");
	}
	if(this.options.skinPlayer == "Classic"){
		this.loadCSSTheme("wp-content/plugins/video-player/css/videoPlayer.theme2.css");
	}
	if(this.options.skinPlaylist == "Classic"){
		this.loadCSSThemePlaylist("wp-content/plugins/video-player/css/videoPlayer.theme2_Playlist.css");
	}
		if(this.options.skinPlayer == "Minimal"){
		this.loadCSSTheme("wp-content/plugins/video-player/css/videoPlayer.theme3.css");
	}
	if(this.options.skinPlaylist == "Minimal"){
		this.loadCSSThemePlaylist("wp-content/plugins/video-player/css/videoPlayer.theme3_Playlist.css");
	}
	if(this.options.skinPlayer == "Transparent"){
		this.loadCSSTheme("wp-content/plugins/video-player/css/videoPlayer.theme4.css");
	}
	if(this.options.skinPlaylist == "Transparent"){
		this.loadCSSThemePlaylist("wp-content/plugins/video-player/css/videoPlayer.theme4_Playlist.css");
	}
	if(this.options.skinPlayer == "Silver"){
		this.loadCSSTheme("wp-content/plugins/video-player/css/videoPlayer.theme5.css");
	}
	if(this.options.skinPlaylist == "Silver"){
		this.loadCSSThemePlaylist("wp-content/plugins/video-player/css/videoPlayer.theme5_Playlist.css");
	}

	self.checkCSS();********/
	if(!self.options.rightClickMenu)
            $(".videoplayer").bind('contextmenu',function() { return false; });
	self.setupElement();
	self.init();
	
    // this.setupElement();
    // this.init();
    /***if(this.options  == undefined)
        self.loadXML('xml/test.xml');
    else if(this.options.xml != undefined)
    //if xml is defined - load xml and override options with xml values
        self.loadXML(this.options.xml);***/

};
Video.fn = Video.prototype;

Video.fn.loadCSSMain=function(url){
            $('#vpCSSMain').remove();
            var self = this;
            //append css to head tag
            $('<link rel="stylesheet" type="text/css" href="'+url+'" id="vpCSSMain" />').appendTo("head");
            //wait for css to load
            self.req1 = $.ajax({
                url:url,
                success:function(data){
                    //css is loaded
                    //start the app
                    // self.start();
					// self.setupElement();
					// self.init();
                }
            })
};
Video.fn.loadFontAwesome=function(url){
            $('#vpFontAwesome').remove();
            var self = this;
            //append css to head tag
            $('<link rel="stylesheet" type="text/css" href="'+url+'" id="vpFontAwesome" />').appendTo("head");
            //wait for css to load
            self.req4 = $.ajax({
                url:url,
                success:function(data){
                    //css is loaded
                    //start the app
                    // self.start();
					// self.setupElement();
					// self.init();
                }
            })
};
/*THEMES*/
Video.fn.loadCSSTheme=function(url){
            $('#vpCSSTheme').remove();
            var self = this;
            //append css to head tag
            $('<link rel="stylesheet" type="text/css" href="'+url+'" id="vpCSSTheme" />').appendTo("head");
            //wait for css to load
            self.req2 = $.ajax({
                url:url,
                success:function(data){
                    //css is loaded
                    //start the app
                    // self.start();
					// self.setupElement();
					// self.init();
                }
            })
};
Video.fn.loadCSSThemePlaylist=function(url){
            $('#vpCSSPlaylist').remove();
            var self = this;
            //append css to head tag
            $('<link rel="stylesheet" type="text/css" href="'+url+'" id="vpCSSPlaylist" />').appendTo("head");
            //wait for css to load
            self.req3 = $.ajax({
                url:url,
                success:function(data){
                    //css is loaded
                    //start the app
                    // self.start();
					// self.setupElement();
					// self.init();
                }
            })
};
Video.fn.checkCSS=function(url){
	var self = this;
	$.when(self.req1, self.req2, self.req3, self.req4).done(function() {
			console.log("css loaded, font awesome loaded")
			self.setupElement();
			self.init();
	});
};

Video.fn.init = function init()
{
    var self=this;
    console.log("init")

                self.preloader = $("<div />");
                self.preloader.addClass("vp_preloader");

                self._playlist = new PLAYER.Playlist($, self, self.options, self.element, self.preloader, self.myVideo, this.canPlay, self.CLICK_EV, pw, self.hasTouch);

                if(self.options.playlist)
                    self.playerWidth = self.options.videoPlayerWidth - self._playlist.playlistW;
                else if(!self.options.playlist)
                    self.playerWidth = self.options.videoPlayerWidth;
					
                self.playerHeight = self.options.videoPlayerHeight;
                self.playlistWidth = self._playlist.playlistW;

                self.initPlayer();
                self.resize();
                self.resizeAll();
                // var offsetT=0;

//              self.playlist = $("<div />");
//              self.playlist.attr('id', 'vp_playlist');
//
//              self.playlistContent= $("<dl />");
//              self.playlistContent.attr('id', 'vp_playlistContent');
//
//              self.videos_array=new Array();
//              self.item_array=new Array();


//            for(var i = 0; i<self.options.video.length; i++)
//            {
//            }

//				var id=-1;
//
//                $(self.options.videos).each(function loopingItems()
//                {
//				  id= id+1;
//                  var obj=
//                  {
//                      //id: this.id,
//                      id: id,
//                      title:this.title,
//                      video_path_mp4:this.mp4,
//                      video_path_webm:this.webm,
//                      // video_path_ogg:this.ogv,
//                      description:this.description,
//                      thumbnail_image:this.thumbImg,
//                      info_text: this.info
//                  };
//				  //console.log("id",id)
//                  self.videos_array.push(obj);
//                  self.item = $("<div />");
//                  self.item.addClass("vp_item");
//                  self.playlistContent.append(self.item);
//                  self.item_array.push(self.item);
//
//                  itemUnselected = $("<div />");
//                  itemUnselected.addClass("vp_itemUnselected");
//                  self.item.append(itemUnselected);
//
//                  var itemLeft = '<div class="vp_itemLeft"><img class="vp_thumbnail_image" alt="" src="' + obj.thumbnail_image + '"></img></div>';
//                var itemRight = '<div class="vp_itemRight"><div class="vp_title">' + obj.title + '</div><div class="vp_description"> ' + obj.description + '</div></div>';
//                self.item.append(itemLeft);
//                self.item.append(itemRight);
//
//        //        offsetL += 252;
//                offsetT += 64;
//                self.playlistContent.append(self.item)
//
//                  //play new video
//                  self.item.bind(self.CLICK_EV, function()
//                  {
//                      if (self.scroll.moved)
//                      {
////                         console.log("scroll moved...")
//                          return;
//                      }
//                      if(self.preloader)
//                          self.preloader.stop().animate({opacity:1},0,function(){$(this).show()});
//                      self.resetPlayer();
//                      self.video.poster = "";
//                      if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/mp4').replace(/no/, ''))
//                      {
//                          this.canPlay = true;
//                          self.video_path = obj.video_path_mp4;
//                      }
//                      else if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/webm').replace(/no/, ''))
//                      {
//                          this.canPlay = true;
//                          self.video_path = obj.video_path_webm;
//                      }
//                      // else if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/ogg').replace(/no/, ''))
//                      // {
//                          // this.canPlay = true;
//                          // self.video_path = obj.video_path_ogg;
//                      // }
//                      self.videoid = obj.id;
//					  //console.log(self.videoid);
//                      self.load(self.video_path);
//                      self.play();
//                      $(self.element).find(".vp_infoTitle").html(obj.title);
//                      $(self.element).find(".vp_infoText").html(obj.info_text);
//                      $(self.element).find(".vp_nowPlayingText").html(obj.title);
//                      this.loaded=false;
//
//                      self.element.find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//remove selected
//                      $(this).find(".vp_itemUnselected").removeClass("vp_itemUnselected").addClass("vp_itemSelected");
//                  });
//                });
//
//            //play first from playlist
//            $(self.item_array[0]).find(".vp_itemUnselected").removeClass("vp_itemUnselected").addClass("vp_itemSelected");//first selected
//                self.videoid = 0;
//                if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/mp4').replace(/no/, ''))
//                {
//                    this.canPlay = true;
//                    self.video_path = self.videos_array[0].video_path_mp4;
//                }
//                else if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/webm').replace(/no/, ''))
//                {
//                    this.canPlay = true;
//                    self.video_path = self.videos_array[0].video_path_webm;
//                }
//                // else if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/ogg').replace(/no/, ''))
//                // {
//                    // this.canPlay = true;
//                    // self.video_path = self.videos_array[0].video_path_ogg;
//                // }
//                self.load(self.video_path);
//
//
//
//
//              //check if show playlist "on" or "off"
//              if(self.options.playlist)
//              {
//                  if( self.element){
//                      self.element.append(self.playlist);
//                      self.playlist.append(self.playlistContent);
//                  }
//                  self.playerWidth = self.options.videoPlayerWidth - self.playlist.width();
//              }
//              else
//                  self.playerWidth = self.options.videoPlayerWidth;
//
//
////              self.playerWidth = self.options.videoPlayerWidth - self.playlist.width();
//              self.playerHeight = self.options.videoPlayerHeight;
//
////              self.playlistFunctionality();
//              self.initPlayer();
//              /**self.animate();**/
//              self.resize();
//
//              self.resizeAll();

};

//Video.fn.playlistFunctionality = function()
//{
//    var self = this;
//
//    self.playlist.css({
//        left:self.playerWidth,
//        height:self.playerHeight
//    });
//
//
//    if(this.options.playlist)
//    {
//        self.scroll = new iScroll(self.playlist[0], {bounce:false, scrollbarClass: 'vp_myScrollbar'});
//    }
//};

Video.fn.initPlayer = function()
{
    this.setupHTML5Video();

    this.ready($.proxy(function()
    {
        this.setupEvents();
        this.change("initial");
        this.setupControls();
        this.load();
        this.setupAutoplay();

        this.element.bind("idle", $.proxy(this.idle, this));
        this.element.bind("state.videoPlayer", $.proxy(function(){
            this.element.trigger("reset.idle");
        }, this))
    }, this));


    this.secondsFormat = function(sec)
    {
        if(isNaN(sec))
        {
            sec=0;
        }
        var result  = [];

        var minutes = Math.floor( sec / 60 );
        var hours   = Math.floor( sec / 3600 );
        var seconds = (sec == 0) ? 0 : (sec % 60)
        seconds     = Math.round(seconds);

        //to calclate tooltip time
        var pad = function(num) {
            if (num < 10)
                return "0" + num;
            return num;
        }

        if (hours > 0)
            result.push(pad(hours));

        result.push(pad(minutes));
        result.push(pad(seconds));

        return result.join(":");
    };


    var self = this;

    $(window).resize(function() {

        if(!self.inFullScreen && !self.realFullscreenActive)
        {
            self.resizeAll();
        }

//        console.log("window.resize")
//        self.resizeAll();

    });

    $(document).bind('webkitfullscreenchange mozfullscreenchange fullscreenchange',function(e)
    {
        //detecting real fullscreen change
        self.resize(e);
    });

    this.resize = function(e)
    {
//            console.log(document.fullscreenElement, document.mozFullScreen, document.webkitIsFullScreen )
        if(document.webkitIsFullScreen || document.fullscreenElement || document.mozFullScreen)
        {
            this._playlist.hidePlaylist();
            this.element.addClass("vp_fullScreen");
            $(this.controls).find(".fa-expand").removeClass("fa-expand").addClass("fa-compress");
//            $(this.controls). find(".vp_fullScreenEnterBg").removeClass("vp_fullScreenEnterBg").addClass("vp_fullScreenExitBg");
            self.element.width($(window).width());
            self.element.height($(window).height());
//                $(this.controls). find(".videoTrack").css("width", 1350);
//            this.infoWindow.css({
//                bottom: self.controls.height()+5,
//                left: $(window).width()/2-this.infoWindow.width()/2
//            });
			self.realFullscreenActive=true;
        }

        else
        {
            this._playlist.showPlaylist();
            this.element.removeClass("vp_fullScreen");
            $(this.controls). find(".fa-compress").removeClass("fa-compress").addClass("fa-expand");
//            $(this.controls). find(".vp_fullScreenExitBg").removeClass("vp_fullScreenExitBg").addClass("vp_fullScreenEnterBg");
            self.element.width(self.playerWidth);
            self.element.height(self.playerHeight);
//                $(this.controls). find(".videoTrack").css("width", 550);
//            this.infoWindow.css({
//                bottom: self.controls.height()+5,
//                left: self.playerWidth/2-this.infoWindow.width()/2
//            });

            if(this.stretching)
            {
                //back to stretched player
                this.stretching=false;
                this.toggleStretch();
            }
            self.element.css({
                zIndex:100
            });
			self.realFullscreenActive=false;
            self.resizeAll();
        }
        this.resizeVideoTrack();
        this.positionOverScreenButtons();
        this.positionInfoWindow();
        this.positionShareWindow();
        this.positionEmbedWindow();
        this.positionLogo();
//        this.positionAds();
//            console.log("fullscreen change");
//            console.log(e);
//            console.log(this);
//            $(this.playlist).toggle();
            //show playlist
       this.resizeBars();
       this.autohideControls();
    }
};
Video.fn.resizeAll = function(){
    var self = this;
    //console.log($(window).width())
//    console.log()
    if ( $(window).width()- self.element.position().left < self.options.videoPlayerWidth )
    {
        if(self.options.playlist){

            if(this.options.skinPlayer == "Transparent" && !this.stretching){
                self.newPlayerWidth = $(window).width() - self.element.position().left;

                if($(window).width() < 490)
                    self.videoTrack.hide();
                else
                    self.videoTrack.show();
                if($(window).width() < 458){
                    self.sep1.hide();
                    self.sep2.hide();
                }
                else{
                    self.sep1.show();
                    self.sep2.show();
                }
                if($(window).width() < 423)
                    self.rewindBtn.hide();
                else
                    self.rewindBtn.show();
                if($(window).width() < 411){
                    self.embedBtn.hide();
                }
                else
                    self.embedBtn.show();
                if($(window).width() < 403)
                    self.sep3.hide();
                else
                    self.sep3.show();
                if($(window).width() < 394)
                    self.infoBtn.hide();
                else
                    self.infoBtn.show();
                if($(window).width() < 372)
                    self.sep4.hide();
                else
                    self.sep4.show();
                if($(window).width() < 352){
                    self.timeElapsed.hide();
                }
                else{
                    self.timeElapsed.show();
                }
                if($(window).width() < 315){
                    self.timeTotal.hide();
                }
                else{
                    self.timeTotal.show();
                }
                if($(window).width() < 255)
                    self.sep5.hide();
                else
                    self.sep5.show();
                if($(window).width() < 255){
//                    self.muteBtn.hide();
//                    self.unmuteBtn.hide();
                }
                else{
//                    self.muteBtn.show();
//                    self.unmuteBtn.show();
                }


                if($(window).width() < 255)
                    self.newPlayerWidth = 255;
            }
            else//other skins
            {
                //stretching
                if(this.stretching){
                    self.newPlayerWidth = $(window).width() - self.element.position().left ;

                    if($(window).width() < 388)
                        self.videoTrack.hide();
                    else
                        self.videoTrack.show();
                    if($(window).width() < 359){
                        self.sep1.hide();
                        self.sep2.hide();
                    }
                    else{
                        self.sep1.show();
                        self.sep2.show();
                    }
                    if($(window).width() < 346)
                        self.rewindBtn.hide();
                    else
                        self.rewindBtn.show();
                    if($(window).width() < 264){
                        self.embedBtn.hide();
                    }
                    else
                        self.embedBtn.show();
                    if($(window).width() < 323)
                        self.sep3.hide();
                    else
                        self.sep3.show();
                    if($(window).width() < 310)
                        self.infoBtn.hide();
                    else
                        self.infoBtn.show();
                    if($(window).width() < 290)
                        self.sep4.hide();
                    else
                        self.sep4.show();
                    if($(window).width() < 270){
                        self.timeElapsed.hide();
                    }
                    else{
                        self.timeElapsed.show();
                    }
                    if($(window).width() < 236){
                        self.timeTotal.hide();
                    }
                    else{
                        self.timeTotal.show();
                    }
                    if($(window).width() < 213)
                        self.newPlayerWidth = 213;
                }
                //no stretching
                else{
                    self.newPlayerWidth = $(window).width() - self.element.position().left;

                    if($(window).width() < 690)
                        self.videoTrack.hide();
                    else
                        self.videoTrack.show();
                    if($(window).width() < 658){
                        self.sep1.hide();
                        self.sep2.hide();
                    }
                    else{
                        self.sep1.show();
                        self.sep2.show();
                    }
                    if($(window).width() < 623)
                        self.rewindBtn.hide();
                    else
                        self.rewindBtn.show();
                    if($(window).width() < 611){
                        self.embedBtn.hide();
                    }
                    else
                        self.embedBtn.show();
                    if($(window).width() < 603)
                        self.sep3.hide();
                    else
                        self.sep3.show();
                    if($(window).width() < 594)
                        self.infoBtn.hide();
                    else
                        self.infoBtn.show();
                    if($(window).width() < 572)
                        self.sep4.hide();
                    else
                        self.sep4.show();
                    if($(window).width() < 552){
                        self.timeElapsed.hide();
                    }
                    else{
                        self.timeElapsed.show();
                    }
                    if($(window).width() < 515){
                        self.timeTotal.hide();
                    }
                    else{
                        self.timeTotal.show();
                    }
                    if($(window).width() < 454)
                        self.sep5.hide();
                    else
                        self.sep5.show();

                    if($(window).width() < 415)
                        self.newPlayerWidth = 415;
                }
            }


        }
        else if(!self.options.playlist){

            self.newPlayerWidth = $(window).width() - self.element.position().left ;

            if($(window).width() < 388)
                self.videoTrack.hide();
            else
                self.videoTrack.show();
            if($(window).width() < 359){
                self.sep1.hide();
                self.sep2.hide();
            }
            else{
                self.sep1.show();
                self.sep2.show();
            }
            if($(window).width() < 346)
                self.rewindBtn.hide();
            else
                self.rewindBtn.show();
            if($(window).width() < 264){
                self.embedBtn.hide();
            }
            else
                self.embedBtn.show();
            if($(window).width() < 323)
                self.sep3.hide();
            else
                self.sep3.show();
            if($(window).width() < 310)
                self.infoBtn.hide();
            else
                self.infoBtn.show();
            if($(window).width() < 290)
                self.sep4.hide();
            else
                self.sep4.show();
            if($(window).width() < 270){
                self.timeElapsed.hide();
            }
            else{
                self.timeElapsed.show();
            }
            if($(window).width() < 236){
                self.timeTotal.hide();
            }
            else{
                self.timeTotal.show();
            }
//            if($(window).width() < 200)
//                self.sep5.hide();
//            else
//                self.sep5.show();
//            if($(window).width() < 200){
//                self.muteBtn.hide();
//                self.unmuteBtn.hide();
//            }
//            else{
//                self.muteBtn.show();
//                self.unmuteBtn.show();
//            }

            if($(window).width() < 213)
                self.newPlayerWidth = 213;
        }
    }
    else
    {
        self.newPlayerWidth = self.options.videoPlayerWidth;
    }

    self.newPlayerHeight = self.newPlayerWidth * self.playerHeight / self.options.videoPlayerWidth;

    self.element.width(self.newPlayerWidth - self._playlist.playlistW);
    self.element.height(self.newPlayerHeight);

    if(this.stretching)
    {
        self.element.width(self.newPlayerWidth);
    }
    else
    {
		if(self.options.playlist)
			self.element.width(self.newPlayerWidth- self._playlist.playlistW);
		else
			self.element.width(self.newPlayerWidth);
    }

    if(self._playlist.videos_array[this._playlist.videoid].videoType=="youtube")
    {
        if(self._playlist.youtubePlayer!= undefined)
        {
            if(self.realFullscreenActive)
            {
                self.element.width($(document).width());
                self.element.height($(document).height());
                self._playlist.youtubePlayer.setSize(self.element.width(),self.element.height() );
            }
            else
            {
                self._playlist.youtubePlayer.setSize(self.newPlayerWidth - self._playlist.playlistW,self.newPlayerHeight );
            }
        }
    }



    self._playlist.resizePlaylist(self.newPlayerWidth, self.newPlayerHeight);

    self.positionEmbedWindow();
    self.positionInfoWindow();
    self.resizeVideoTrack();
    self.positionOverScreenButtons();
    self.positionShareWindow();

    self.resizeBars();
//    self.resizeControls();
    self.positionLogo();
};
Video.fn.autohideControls = function(){
    var element  = $(this.element);
    var idle     = false;
    var timeout  = this.options.autohideControls*1000;
    var interval = 1000;
    var timeFromLastEvent = 0;
    var reset = function()
    {
        if (idle)
            element.trigger("idle", false);
        idle = false;
        timeFromLastEvent = 0;
    };

    var check = function()
    {
        if (timeFromLastEvent >= timeout) {
            reset();
            idle = true;
            element.trigger("idle", true);
        }
        else
        {
            timeFromLastEvent += interval;
        }
    };

    element.bind(idleEvents, reset);

    var loop = setInterval(check, interval);

    element.unload(function()
    {
        clearInterval(loop);
    });
};
Video.fn.resizeBars = function(){
    //download
//    this.buffered = this.video.buffered.end(this.video.buffered.length-1);
    this.downloadWidth = (this.buffered/this.video.duration )*this.videoTrack.width();
    this.videoTrackDownload.css("width", this.downloadWidth);
    //progress
    this.progressWidth = (this.video.currentTime/this.video.duration )*this.videoTrack.width();
    this.videoTrackProgress.css("width", this.progressWidth);
};
Video.fn.createLogo = function(){
        var self=this;
        //load logo
        this.logoImg = $("<div/>");
        this.logoImg.addClass("vp_logo");
//    var img = '<img class="" alt="" src="' + logoPath + '"></img>';
//    logoImg.append(img);
        this.img = new Image();
        this.img.src = self.options.logoPath;
        //
        $(this.img).load(function() {
            //when image loaded position logo
            self.logoImg.append(self.img);
            self.positionLogo();
        });

        if(self.options.logoShow=="Yes")
        {
            this.element.append(this.logoImg);
        }

        if(self.options.logoClickable=="Yes")
        {
            this.logoImg.bind(this.START_EV,$.proxy(function(){
                window.open(self.options.logoGoToLink);
            }, this));

            this.logoImg.mouseover(function(){
                $(this).stop().animate({opacity:0.5},200);
            });
            this.logoImg.mouseout(function(){
                $(this).stop().animate({opacity:1},200);
            });
            $('.vp_logo').css('cursor', 'pointer');
        }



};
Video.fn.positionLogo = function(){
    var self=this;
    if(self.options.logoPosition == "bottom-right")
    {
        this.logoImg.css({
            bottom:  self.controls.height() + self.toolTip.height() + 8,
            right: buttonsMargin
        });
    }
    else if(self.options.logoPosition == "bottom-left")
    {
        this.logoImg.css({
            bottom:  self.controls.height() + self.toolTip.height() + 8,
            left: buttonsMargin
        });
    }

};
Video.fn.createAds = function(){
    var self=this;
    //load ads
    adsImg = $("<div/>");
    adsImg.addClass("ads");

    image = new Image();
    image.src = self._playlist.videos_array[0].adsPath;

    $(image).load(function() {
        //when image loaded position ads
        adsImg.append(image);
        self.positionAds();
    });
    this.element.append(adsImg);
    adsImg.hide();
};
Video.fn.positionAds = function(){
    var self=this;
    adsImg.css({
        bottom: self.controls.height()+5,
        left: self.element.width()/2-adsImg.width()/2
    });
};


Video.fn.setupAutoplay = function()
{
   var self=this;
    //autoplay
//    self.options.autoplay = self.autoplay;
    /*if(self.options.autoplay == "on")
    {
        self.play();
    }
     else if(self.options.autoplay == "off")
     {
        self.pause();
        self.preloader.hide();
     }*/
    if(self.options.autoplay)
    {
        self.play();
    }
    else if(!self.options.autoplay)
    {
        self.pause();
        self.preloader.hide();
    }
}
Video.fn.createNowPlayingText = function()
{
    this.element.append('<p class="vp_nowPlayingText">' + this._playlist.videos_array[0].title + '</p>');
    if(this.options.nowPlayingText=="No")
        this.element.find(".vp_nowPlayingText").hide();
};
Video.fn.createInfoWindowContent = function()
{
    this.infoWindow.append('<p class="vp_infoTitle">' + this._playlist.videos_array[0].title + '</p>');
    this.infoWindow.append('<p class="vp_infoText">' + this._playlist.videos_array[0].info_text + '</p>');
    this.infoWindow.hide();
    this.positionInfoWindow();
};
Video.fn.createEmbedWindowContent = function()
{
    $(this.embedWindow).append('<p class="vp_embedTitle">' + "EMBED CODE:" + '</p>');
    $(this.embedWindow).append('<p class="vp_embedText"></p>');
    $(this.embedWindow).find(".vp_embedText").css({
        opacity: 0.5
    });

//    embedMessage = $("<div />");
//    embedMessage.addClass("embedMessage");
//    embedWindow.append(embedMessage);
//    embedMessage.append('<p class="embedMessageTxt">' + "CLICK TO COPY CODE" + '</p>');
//    embedMessage.css({left:embedWindow.width()/2 - embedMessage.width()/2, top:embedWindow.height()/2 - embedMessage.height()/2});
    // $(this.embedWindow).find(".vp_embedText").text(this.options.embedCode);
	var s = this.options.embedCodeSrc;
	var w = this.options.embedCodeW;
	var h = this.options.embedCodeH;
	// console.log(s,w,h)
	
	$(this.embedWindow).find(".vp_embedText").text("<iframe src='"+s+"' width='"+w+"' height='"+h+"' frameborder=0 webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>");
	
    $(this.embedWindow).hide();
    this.positionEmbedWindow();

    $(this.embedWindow).mouseover(function(){
        $(this).find(".vp_embedText").stop().animate({opacity: 1},300);
//        embedMessage.stop().animate({opacity: 0},300,function(){
//           embedMessage.hide();
//        });

    });
    $(this.embedWindow).mouseout(function(){
        $(this).find(".vp_embedText").stop().animate({opacity: 0.5},300);
//        embedMessage.show();
//        embedMessage.stop().animate({opacity: 1},300);
    });


};

/*Video.fn.stripslashes = function (str) {
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Ates Goral (http://magnetiq.com)
  // +      fixed by: Mick@el
  // +   improved by: marrtins
  // +   bugfixed by: Onno Marsman
  // +   improved by: rezna
  // +   input by: Rick Waldron
  // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +   input by: Brant Messenger (http://www.brantmessenger.com/)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: stripslashes('Kevin\'s code');
  // *     returns 1: "Kevin's code"
  // *     example 2: stripslashes('Kevin\\\'s code');
  // *     returns 2: "Kevin\'s code"
  return (str + '').replace(/\\(.?)/g, function (s, n1) {
	switch (n1) {
	case '\\':
	  return '\\';
	case '0':
	  return '\u0000';
	case '':
	  return '';
	default:
	  return n1;
	}
  });
}*/

Video.fn.ready = function(callback)
{
  this.readyList.push(callback);  
  if (this.loaded)
      callback.call(this);
};

Video.fn.load = function(srcs, obj_id)
{
  var self = this;
  if (srcs)
    this.sources = srcs;
  
  if (typeof this.sources == "string")
    this.sources = {src:this.sources};
  
  if (!$.isArray(this.sources))
    this.sources = [this.sources];
    
  this.ready(function()
  {
    this.change("loading");
      if(self._playlist.videos_array[this._playlist.videoid].videoType=="HTML5")
      {
          this.video.loadSources(this.sources);
      }
  });
};

Video.fn.play = function()
{
  var self = this;
  this.playButtonScreen.stop().animate({opacity:0},0,function(){
      // Animation complete.
      $(this).hide();
  });
    this.playBtn.removeClass("fa-play").addClass("fa-pause");
    self.video.play();
};

Video.fn.pause = function()
{
    var self = this;
    this.playButtonScreen.stop().animate({opacity:1},0,function(){
        // Animation complete.
        $(this).show();
    });
    this.playBtn.removeClass("fa-pause").addClass("fa-play");
    self.video.pause();
};

Video.fn.stop = function()
{
  this.seek(0);
  this.pause();
};

Video.fn.togglePlay = function()
{
  if (this.state == "vp_playing")
  {
    this.pause();
  }
  else
  {
    this.play();
  }
};

Video.fn.toggleInfoWindow = function()
{
    var self = this;

    if(this.infoOn)
    {
        this.infoWindow.animate({opacity:0},500,function() {
            // Animation complete.
            $(this).hide();
       });

        this.infoOn=false;
    }
    else
    {
        this.infoWindow.show();
        this.infoWindow.animate({opacity:1},500);
//        infoWindow.animate({top:0});
        this.infoOn=true;
//        console.log(this.infoOn)
    }
};

Video.fn.toggleShareWindow = function()
{
    var self = this;

    if(this.shareOn)
    {
        $(this.shareWindow).animate({opacity:0},500,function() {
            // Animation complete.
            $(this).hide();
       });

        this.shareOn=false;
    }
    else
    {
        this.shareWindow.show();
        $(this.shareWindow).animate({opacity:1},500);
        this.shareOn=true;
    }
};
Video.fn.toggleEmbedWindow = function()
{
    var self = this;

    if(this.embedOn)
    {
        $(this.embedWindow).animate({opacity:0},500,function() {
            // Animation complete.
            $(this).hide();
        });
        this.embedOn=false;
    }
    else
    {
        $(this.embedWindow).show();
        $(this.embedWindow).animate({opacity:1},500);
        this.embedOn=true;
    }
};

Video.fn.fullScreen = function(state)
{
    var self = this;
    if(state)
    {
        this._playlist.hidePlaylist();
        this.element.addClass("vp_fullScreen");
        $(this.controls). find(".fa-expand").removeClass("fa-expand").addClass("fa-compress");
//        $(this.controls). find(".vp_fullScreenEnterBg").removeClass("vp_fullScreenEnterBg").addClass("vp_fullScreenExitBg");
        self.element.width($(window).width());
        self.element.height($(window).height());
//        this.infoWindow.css({
//            bottom: self.controls.height()+5,
//            left: $(window).width/2-this.infoWindow.width()/2
//        });
        self.element.css({
            zIndex:999999
        });
//        console.log("ent")
    }
    else
    {
//        console.log("esc")
        this._playlist.showPlaylist();
        this.element.removeClass("vp_fullScreen");
        $(this.controls). find(".fa-compress").removeClass("fa-compress").addClass("fa-expand");
//        $(this.controls). find(".vp_fullScreenExitBg").removeClass("vp_fullScreenExitBg").addClass("vp_fullScreenEnterBg");
        self.element.width(self.playerWidth);
        self.element.height(self.playerHeight);
//        this.infoWindow.css({
//            bottom: self.controls.height()+5,
//            left: self.playerWidth/2-this.infoWindow.width()/2
//        });

        if(this.stretching)
        {
            //back to stretched player
            this.stretching=false;
            this.toggleStretch();
        }
        self.element.css({
            zIndex:100
        });
        self.resizeAll();
    }
    this.resizeVideoTrack();
    this.positionOverScreenButtons(state);
    this.positionInfoWindow();
    this.positionEmbedWindow();
    this.positionShareWindow();
    this.positionLogo();
//    this.positionAds();
    this.resizeBars();


  if (typeof state == "undefined") state = true;
  this.inFullScreen = state;


};

Video.fn.toggleFullScreen = function()
{
    var self = this;
    if(THREEx.FullScreen.available())
    {
        if(THREEx.FullScreen.activated())
        {
            // if(this.options.fullscreen_native)
            if(this.options.fullscreen=="Fullscreen native")
                THREEx.FullScreen.cancel();
            // if(this.options.fullscreen_browser)
            if(this.options.fullscreen=="Fullscreen browser")
                this.fullScreen(!this.inFullScreen);
//            console.log("exited fullscreen")
            self.element.css({
                zIndex:100
            });
//            console.log("1 exited")
        }
        else
        {
            // if(this.options.fullscreen_native)
            if(this.options.fullscreen=="Fullscreen native")
            {    
			
				THREEx.FullScreen.request();
                self.element.css({
                    zIndex:999999
                });
            }
            // if(this.options.fullscreen_browser)
			if(this.options.fullscreen=="Fullscreen browser")
                this.fullScreen(!this.inFullScreen);
//            console.log("entered fullscreen")

//            console.log("2 entered")
        }
    }
    else if(!THREEx.FullScreen.available())
    {
//        console.log("fullscreen not available in this browser")
//        alert("THREEx.FullScreen not available")

        this.fullScreen(!this.inFullScreen);
    }
};

Video.fn.seek = function(offset)
{
  this.video.setCurrentTime(offset);
};

Video.fn.setVolume = function(num)
{
  this.video.setVolume(num);
};

Video.fn.getVolume = function()
{
  return this.video.getVolume();
};

Video.fn.mute = function(state)
{
  if (typeof state == "undefined") state = true;
  this.setVolume(state ? 1 : 0);
};

Video.fn.remove = function()
{
  this.element.remove();
};

Video.fn.bind = function()
{
  this.videoElement.bind.apply(this.videoElement, arguments);
};

Video.fn.one = function()
{
  this.videoElement.one.apply(this.videoElement, arguments);
};

Video.fn.trigger = function()
{
  this.videoElement.trigger.apply(this.videoElement, arguments);
};

// Proxy jQuery events
var events = [
               "click",
               "dblclick",
               "onerror",
               "onloadeddata",
               "oncanplay",
               "ondurationchange",
               "ontimeupdate",
               "onprogress",
               "onpause",
               "onplay",
               "onended",
               "onvolumechange"
             ];

for (var i=0; i < events.length; i++)
{
  (function()
  {
    var functName = events[i];
    var eventName = functName.replace(/^(on)/, "");
    Video.fn[functName] = function()
    {
      var args = $.makeArray(arguments);
      args.unshift(eventName);
      this.bind.apply(this, args);
    };
  }
  )();
}
// Private methods
Video.fn.triggerReady = function()
{
  /*this.readyList-> []*/
  for (var i in this.readyList)
  {
    this.readyList[i].call(this);
  }
  this.loaded = true;
//        console.log(this.readyList[i])
};

Video.fn.setupElement = function()
{
  this.element = $("<div />");
  this.element.addClass("vp_videoPlayer");
  this.parent.append(this.element);

};

/***************************************AUTOHIDE CONTROLS*********************************/
Video.fn.idle = function(e, toggle){
    var self=this;
  if (toggle)
  {
    if (this.state == "vp_playing")
    {
//          this.element.addClass("idle");
        this.controls.stop().animate({opacity:0} , 300);
        this.shareBtn.stop().animate({opacity:0} , 300);
        this.playlistBtn.stop().animate({opacity:0} , 300);
        this.embedBtn.stop().animate({opacity:0} , 300);
        this.logoImg.stop().animate({opacity:0} , 300);
        self.element.find(".vp_nowPlayingText").stop().animate({opacity:0} , 300);
    }
  }
  else
  {
//          this.element.removeClass("idle");
      this.controls.stop().animate({opacity:1} , 300);
      this.shareBtn.stop().animate({opacity:1} , 300);
      this.playlistBtn.stop().animate({opacity:1} , 300);
      this.embedBtn.stop().animate({opacity:1} , 300);
      this.logoImg.stop().animate({opacity:1} , 300);
      self.element.find(".vp_nowPlayingText").stop().animate({opacity:1} , 300);
  }
};



Video.fn.change = function(state)
{
  this.state = state;
    if(this.element){
        this.element.attr("data-state", this.state);
        this.element.trigger("state.videoPlayer", this.state);
    }

}




//////////////////////////////////////////////SETUP NATIVE*////////////////////////////////////////////////////////////
Video.fn.setupHTML5Video = function()
  {
      this.videoElement = $("<video />");
      this.videoElement.addClass("vp_videoPlayer");
      this.videoElement.attr({
            width:this.options.width,
            height:this.options.height,
            poster:this.options.poster,
            autoplay:this.options.autoplay,
            preload:this.options.preload,
            controls:this.options.controls,
            autobuffer:this.options.autobuffer
      });


      if(this.element)
      {
          this.element.append(this.videoElement);
          this.element.append(this.preloader);
      }
      this.video = this.videoElement[0];

      if(!this.options.autoplay)
        this.video.poster = this.options.posterImg;

      if(this.element)
      {
          this.element.width(this.playerWidth);
          this.element.height(this.playerHeight);
      }


      var self = this;

      this.video.loadSources = function(srcs)
      {

        self.videoElement.empty();
        for (var i in srcs)
        {
          var srcEl = $("<source />");
          srcEl.attr(srcs[i]);
          self.videoElement.append(srcEl);
        }
        self.video.load();

      };

      this.video.getStartTime = function()
      {
          return(this.startTime || 0);
      };
      this.video.getEndTime = function()
      {
        if (this.duration == Infinity && this.buffered)
        {
          return(this.buffered.end(this.buffered.length-1));
        }
        else
        {
          return((this.startTime || 0) + this.duration);
        }
      };

      this.video.getCurrentTime = function(){
        try
        {
          return this.currentTime;
        }
        catch(e)
        {
          return 0;
        }
      };


      var self = this;

      this.video.setCurrentTime = function(val)
      {
//          console.log( this.currentTime)
          this.currentTime = val;
      };
      this.video.getVolume = function()
      {
          return this.volume;
      };
      this.video.setVolume = function(val)
      {
          this.volume = val;
      };

      this.videoElement.dblclick($.proxy(function()
      {
        this.toggleFullScreen();
      }, this));
      this.videoElement.bind(this.START_EV, $.proxy(function()
      {
        this.togglePlay();
      }, this));

      this.triggerReady();
};






Video.fn.setupButtonsOnScreen = function(){

    var self = this;

    this.playlistBtn = $("<div />")
        .addClass("vp_playlistBtn")
        .addClass("vp_btnOverScreen");
    if(this.element){
        this.element.append(this.playlistBtn);
    }
    this.playlistBtnIcon = $("<span />")
        .attr("aria-hidden","true").attr("title", "Playlist toggle")
        .addClass("fa")
        .addClass("icon-overScreen")
//        .addClass("fa-list-alt");
//        .addClass("fa-list-alt");
        .addClass("fa-list-ul");
//        .addClass("fa-th-list");
    this.playlistBtn.append(this.playlistBtnIcon);
    this.playlistBtn.append('<p class="vp_playlistBtnText">' + "VIDEOS" + '</p>');
    $(this.element).find(".vp_playlistBtnText").addClass("icon-overScreen-Texts");
//    var playlistBtnIcon = $("<div />");
//    playlistBtnIcon.addClass("vp_playlistBtnIcon");
//    this.playlistBtn.append(playlistBtnIcon);

    this.shareBtn = $("<div />")
        .addClass("vp_shareBtn")
        .addClass("vp_btnOverScreen");
    if(this.element){
        this.element.append(this.shareBtn);
    }
//    var shareBtnIcon = $("<div />");
//    shareBtnIcon.addClass("vp_shareBtnIcon");
    this.shareBtnIcon = $("<span />")
        .attr("aria-hidden","true").attr("title", "Share")
        .addClass("fa")
        .addClass("icon-overScreen")
        .addClass("fa-share-square-o");
    this.shareBtn.append(this.shareBtnIcon);
    this.shareBtn.append('<p class="vp_shareBtnText">' + "SHARE" + '</p>');
    $(this.element).find(".vp_shareBtnText").addClass("icon-overScreen-Texts");

    this.embedBtn = $("<div />")
        .addClass("vp_embedBtn")
        .addClass("vp_btnOverScreen");
    if(this.element){
        this.element.append(this.embedBtn);
    }
    this.embedBtnIcon = $("<span />")
        .attr("aria-hidden","true").attr("title", "Embed")
        .addClass("fa")
        .addClass("icon-overScreen")
//        .addClass("fa-chain");
        .addClass("fa-code");
    this.embedBtn.append(this.embedBtnIcon);
    this.embedBtn.append('<p class="vp_embedBtnText">' + "EMBED" + '</p>');
    $(this.element).find(".vp_embedBtnText").addClass("icon-overScreen-Texts");
//    var embedBtnIcon = $("<div />");
//    embedBtnIcon.addClass("vp_embedBtnIcon");
//    this.embedBtn.append(embedBtnIcon);
    $(".vp_shareBtn, .vp_embedBtn, .vp_playlistBtn").mouseover(function(){
        $(this).find(".icon-overScreen-Texts").removeClass("icon-overScreen-Texts").addClass("icon-overScreen-Texts-hover");
        $(this).find(".icon-overScreen").removeClass("icon-overScreen").addClass("icon-overScreen-hover");
    });
    $(".vp_shareBtn, .vp_embedBtn, .vp_playlistBtn").mouseout(function(){
        $(this).find(".icon-overScreen-Texts-hover").removeClass("icon-overScreen-Texts-hover").addClass("icon-overScreen-Texts");
        $(this).find(".icon-overScreen-hover").removeClass("icon-overScreen-hover").addClass("icon-overScreen");
    });

    // if(!self.options.share[0].show)
    if(self.options.shareShow=="No")
    {
        this.shareBtn.css({border:"none", width:0, height:0, visibility:"hidden"});
    }
    if(self.options.embedShow=="No")
    {
        this.embedBtn.css({width:0, height:0, visibility:"hidden"});
    }

    buttonsMargin = 5;


    this.positionOverScreenButtons();

    this.playlistBtn.bind(this.START_EV, function(){
        self.toggleStretch();
    });
};
Video.fn.toggleStretch = function(){
    var self=this;
    if(this.stretching)
    {
        self.shrinkPlayer();
        this.stretching = false;
    }
    else
    {
        self.stretchPlayer();
        this.stretching = true;
    }
    this.resizeVideoTrack();
    this.positionOverScreenButtons();
    this.positionInfoWindow();
    this.positionEmbedWindow();
    this.positionShareWindow();
    this.positionLogo();
//    this.positionAds();
    this.resizeBars();
    this.resizeAll();

};
Video.fn.stretchPlayer = function(){
    this.element.width(this.options.videoPlayerWidth)
    this._playlist.hidePlaylist();
};
Video.fn.shrinkPlayer = function(){
    this.element.width(this.playerWidth)
    this._playlist.showPlaylist();
};


Video.fn.positionOverScreenButtons = function(state){
    if(this.element){


    if(document.webkitIsFullScreen || document.fullscreenElement || document.mozFullScreen || state)
    {
        this.shareBtn.css({
            right:buttonsMargin,
            top:buttonsMargin
        });
        this.embedBtn.css({
            right:buttonsMargin,
            top:this.shareBtn.position().top+this.shareBtn.height()+buttonsMargin
        });
        this.playlistBtn.hide();
    }
    else
    {
        if(this.options.playlist)
        {
            this.playlistBtn.show();
            this.shareBtn.css({
                right:buttonsMargin,
                top:buttonsMargin
            });
            this.playlistBtn.css({
                right:buttonsMargin,
                top:this.shareBtn.position().top+this.shareBtn.height()+buttonsMargin
            });
            this.embedBtn.css({
                right:buttonsMargin,
                top:this.playlistBtn.position().top+this.playlistBtn.height()+buttonsMargin
            });
        }
        else if(!this.options.playlist)
        {
            this.playlistBtn.hide();
            this.shareBtn.css({
                right:buttonsMargin,
                top:buttonsMargin
            });
            this.embedBtn.css({
                right:buttonsMargin,
                top:this.shareBtn.position().top+this.shareBtn.height()+buttonsMargin
            });
        }

    }
    }

};

Video.fn.positionInfoWindow = function(){
    var self = this;
    this.infoWindow.css({
        bottom: self.controls.height()+55,
        left: self.element.width()/2-this.infoWindow.width()/2
    });
};
Video.fn.positionShareWindow = function(){
    var self = this;
    this.shareWindow.css({
        top: buttonsMargin,
        left: self.element.width() - this.shareWindow.width() - 2*buttonsMargin - this.shareBtn.width()
    });
};
Video.fn.positionEmbedWindow = function(){
        var self = this;
    this.embedWindow.css({
            bottom: self.element.height()/2 - this.embedWindow.height()/2,
            left: self.element.width()/2-this.embedWindow.width()/2
        });
 };


Video.fn.setupButtons = function(){
  var self = this;

  //PLAY BTN
//  this.playBtn = $("<div />");
//  this.playBtn.addClass("vp_play");
//  this.playBtn.bind(this.START_EV, $.proxy(function()
//  {
//    if (!this.canPlay)
//        return;
//    this.play();
    this.playBtn = $("<span />")
        .attr("aria-hidden","true").attr("title", "Play/Pause")
        .addClass("fa")
        .addClass("icon-general")
        .addClass("fa-play")
        .bind(self.START_EV, function(){
            self.togglePlay();
        });
  this.controls.append(this.playBtn);

//  var playBg = $("<div />");
//  playBg.addClass("vp_playBg");
//  this.playBtn.append(playBg);

    //REWIND BTN
    this.rewindBtn = $("<span />")
        .attr("aria-hidden","true").attr("title", "Repeat")
        .addClass("fa")
        .addClass("icon-general")
        .addClass("fa-repeat")
//        .addClass("fa-reply")
        .bind(self.START_EV, function(){
            self.seek(0);
            self.play();
        });

//  this.rewindBtn = $("<div />");
//  this.rewindBtn.addClass("vp_rewindBtn");
//  this.rewindBtn.bind(this.START_EV,$.proxy(function()
//  {
//      this.seek(0);
//      this.play();
//  }, this));
    this.controls.append(this.rewindBtn);


  //PLAY BTN SCREEN
  this.playButtonScreen = $("<div />");
  this.playButtonScreen.addClass("vp_playButtonScreen");
  this.playButtonScreen.bind(this.START_EV,$.proxy(function()
  {
//    if (!this.canPlay)
//        return;
    this.play();
  }, this))
  if(this.element){
      this.element.append(this.playButtonScreen);
  }


  //PAUSE BTN
//  this.pauseBtn = $("<div />");
//  this.pauseBtn.addClass("vp_pause");
//  this.pauseBtn.bind(this.START_EV,$.proxy(function()
//  {
//    if (!this.canPlay) return;
//        this.pause();
//  }, this));
//  this.controls.append(this.pauseBtn);
//
//  var pauseBg = $("<div />");
//  pauseBg.addClass("vp_pauseBg");
//    this.pauseBtn.append(pauseBg);


  //INFO BTN
//  this.infoBtn = $("<div />");
//  this.infoBtn.addClass("vp_infoBtn");
//  this.controls.append(this.infoBtn);
//
//  var infoBtnBg = $("<div />");
//  infoBtnBg.addClass("vp_infoBtnBg");
//  this.infoBtn.append(infoBtnBg);

    this.infoBtn = $("<span />")
        .attr("aria-hidden","true").attr("title", "Info")
        .addClass("fa")
        .addClass("icon-general")
        .addClass("fa-info-circle");
//        .addClass("fa-info");
    this.controls.append(this.infoBtn);



//  var rewindBtnBg = $("<div />");
//  rewindBtnBg.addClass("vp_rewindBtnBg");
//  this.rewindBtn.append(rewindBtnBg);





  //FULLSCREEN
    this.fsEnter = $("<span />");
    this.fsEnter.attr("aria-hidden","true").attr("title", "Fullscreen toggle")
        .addClass("fa")
        .addClass("icon-general")
        .addClass("fa-expand")
        .bind(this.START_EV,$.proxy(function()
        {
            this.toggleFullScreen();
        }, this));
    this.controls.append(this.fsEnter);
  /*this.fsEnter = $("<div />");
  this.fsEnter.addClass("vp_fullScreenEnter");
  this.fsEnter.bind(this.START_EV,$.proxy(function()
    {
        this.toggleFullScreen();
    }, this));
  this.controls.append(this.fsEnter);*/

//   var fullScreenEnterBg = $("<div />");
//   fullScreenEnterBg.addClass("vp_fullScreenEnterBg");
//    this.fsEnter.append(fullScreenEnterBg);

//   this.fsExit = $("<div />");
//   this.fsExit.addClass("vp_fullScreenExit");
//   this.fsExit.bind(this.START_EV,$.proxy(function()
//    {
//        this.toggleFullScreen();
//    }, this));

//   var fullScreenExitBg = $("<div />");
//   fullScreenExitBg.addClass("vp_fullScreenExitBg");
//   this.fsExit.append(fullScreenExitBg);






    this.playButtonScreen.mouseover(function(){
        $(this).stop().animate({
            opacity: 0.75
        }, 300 );
    });
    this.playButtonScreen.mouseout(function(){
            $(this).stop().animate({
                opacity: 1
            }, 300 );
        }
    );

    /**********************play/pause rollover/rollout***************/

//    this.playBtn.mouseover(function(){
//        $(this).stop().animate({
//            opacity: 0.5
//        }, 200 );
//        $(self.pauseBtn).stop().animate({
//            opacity: 0.5
//        }, 200 );
//
//    });

//    this.pauseBtn.mouseover(function(){
//        $(self.playBtn).stop().animate({
//            opacity: 0.5
//        }, 200 );
//        $(this).stop().animate({
//            opacity: 0.5
//        }, 200 );
//    });

//    this.playBtn.mouseout(function(){
//        $(this).stop().animate({
//            opacity: 1
//        }, 200 );
//        $(self.pauseBtn).stop().animate({
//            opacity: 1
//        }, 200 );
//
//    });
//
//    this.pauseBtn.mouseout(function(){
//        $(self.playBtn).stop().animate({
//            opacity: 1
//        }, 200 );
//        $(this).stop().animate({
//            opacity: 1
//        }, 200 );
//    });

//    this.infoBtn.mouseover(function(){
//        $(this).stop().animate({
//            opacity:0.5
//        },200);
//    });
//    this.infoBtn.mouseout(function(){
//        $(this).stop().animate({
//            opacity:1
//        },200);
//    });

//    this.rewindBtn.mouseover(function(){
//        $(this).stop().animate({
//            opacity:0.5
//        },200);
//    });
//    this.rewindBtn.mouseout(function(){
//        $(this).stop().animate({
//            opacity:1
//        },200);
//    });



    /*******************fullscreen rollover/rollout***************/

//    this.fsEnter.mouseover(function(){
//        $(this).stop().animate({
//            opacity: 0.5
//        }, 200 );
//        $(self.fsExit).stop().animate({
//            opacity: 0.5
//        }, 200 );
//
//    });
//
//    this.fsExit.mouseover(function(){
//        $(self.fsEnter).stop().animate({
//            opacity: 0.5
//        }, 200 );
//        $(this).stop().animate({
//            opacity: 0.5
//        }, 200 );
//    });
//
//    this.fsEnter.mouseout(function(){
//        $(this).stop().animate({
//            opacity: 1
//        }, 200 );
//        $(self.fsExit).stop().animate({
//            opacity: 1
//        }, 200 );
//
//    });
//
//    this.fsExit.mouseout(function(){
//        $(self.fsEnter).stop().animate({
//            opacity: 1
//        }, 200 );
//        $(this).stop().animate({
//            opacity: 1
//        }, 200 );
//    });




    this.sep1 = $("<div />");
    this.sep1.addClass("vp_sep1");
    this.controls.append(this.sep1);

    this.sep2 = $("<div />");
    this.sep2.addClass("vp_sep2");
    this.controls.append(this.sep2);

    this.sep3 = $("<div />");
    this.sep3.addClass("vp_sep3");
    this.controls.append(this.sep3);

    this.sep4 = $("<div />");
    this.sep4.addClass("vp_sep4");
    this.controls.append(this.sep4);

    this.sep5 = $("<div />");
    this.sep5.addClass("vp_sep5");
    this.controls.append(this.sep5);

    this.sep6 = $("<div />");
    this.sep6.addClass("vp_sep6");
    this.controls.append(this.sep6);

//    console.log(sep1.position().left)
//    console.log(sep2.position().left)
};
Video.fn.createInfoWindow = function(){
    this.infoWindow = $("<div />");
    this.infoWindow.addClass("vp_infoWindow");
    this.infoWindow.css({opacity:0});
    if(this.element){
        this.element.append(this.infoWindow);
    }


    this.infoBtnClose = $("<div />");
    this.infoBtnClose.addClass("vp_btnClose");
    this.infoWindow.append(this.infoBtnClose);
    this.infoBtnClose.css({bottom:0});
    this.infoBtnClose.append('<p class="vp_btnCloseText">' + "CLOSE" + '</p>');

    this.infoBtn.bind(this.START_EV,$.proxy(function()
    {
        this.toggleInfoWindow();
    }, this));

    this.infoBtnClose.bind(this.START_EV,$.proxy(function()
    {
        this.toggleInfoWindow();
    }, this));

    this.infoBtnClose.mouseover(function(){
        $(this).stop().animate({
            opacity:0.5
        },200);
    });
    this.infoBtnClose.mouseout(function(){
        $(this).stop().animate({
            opacity:1
        },200);
    });
};

Video.fn.createShareWindow = function(){
    this.shareWindow = $("<div></div>");
    this.shareWindow.addClass("vp_shareWindow");
    this.shareWindow.hide();
    this.shareWindow.css({
        opacity:0
    });
    if(this.element){
        this.element.append(this.shareWindow);
    }

    this.shareBtn.bind(this.START_EV,$.proxy(function()
    {
        this.toggleShareWindow();
    }, this));

    this.shareWindow.facebook = $("<div />");
    this.shareWindow.facebook.addClass("vp_facebook");
    this.shareWindow.append(this.shareWindow.facebook);

    this.shareWindow.twitter = $("<div />");
    this.shareWindow.twitter.addClass("vp_twitter");
    this.shareWindow.append(this.shareWindow.twitter);

//    this.shareWindow.myspace = $("<div />");
//    this.shareWindow.myspace.addClass("vp_myspace");
//    this.shareWindow.append(this.shareWindow.myspace);
//
//    this.shareWindow.wordpress = $("<div />");
//    this.shareWindow.wordpress.addClass("vp_wordpress");
//    this.shareWindow.append(this.shareWindow.wordpress);
//
//    this.shareWindow.linkedin = $("<div />");
//    this.shareWindow.linkedin.addClass("vp_linkedin");
//    this.shareWindow.append(this.shareWindow.linkedin);
//
//    this.shareWindow.flickr = $("<div />");
//    this.shareWindow.flickr.addClass("vp_flickr");
//    this.shareWindow.append(this.shareWindow.flickr);
//
//    this.shareWindow.blogger = $("<div />");
//    this.shareWindow.blogger.addClass("vp_blogger");
//    this.shareWindow.append(this.shareWindow.blogger);
//
//    this.shareWindow.delicious = $("<div />");
//    this.shareWindow.delicious.addClass("vp_delicious");
//    this.shareWindow.append(this.shareWindow.delicious);
//
//    this.shareWindow.mail = $("<div />");
//    this.shareWindow.mail.addClass("vp_mail");
//    this.shareWindow.append(this.shareWindow.mail);

    //give shareWindow width after all elements appended
    var saveShareWindowWidth = this.shareWindow.width();
    this.shareWindow.css({
       width:saveShareWindowWidth
    });

    this.shareWindow.facebook.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
    this.shareWindow.facebook.mouseout(function(){$(this).stop().animate({opacity:1},200);});
    this.shareWindow.twitter.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
    this.shareWindow.twitter.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.myspace.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.myspace.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.wordpress.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.wordpress.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.linkedin.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.linkedin.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.flickr.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.flickr.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.blogger.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.blogger.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.delicious.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.delicious.mouseout(function(){$(this).stop().animate({opacity:1},200);});
//    this.shareWindow.mail.mouseover(function(){ $(this).stop().animate({opacity:0.6},200);});
//    this.shareWindow.mail.mouseout(function(){$(this).stop().animate({opacity:1},200);});

    this.shareWindow.facebook.bind(this.START_EV,$.proxy(function(){
        window.open(this.options.facebookLink);
    }, this));
    this.shareWindow.twitter.bind(this.START_EV,$.proxy(function(){
        window.open(this.options.twitterLink);
    }, this));
//    this.shareWindow.myspace.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.myspaceLink);
//    }, this));
//    this.shareWindow.wordpress.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.wordpressLink);
//    }, this));
//    this.shareWindow.linkedin.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.linkedinLink);
//    }, this));
//    this.shareWindow.flickr.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.flickrLink);
//    }, this));
//    this.shareWindow.blogger.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.bloggerLink);
//    }, this));
//    this.shareWindow.delicious.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.deliciousLink);
//    }, this));
//    this.shareWindow.mail.bind(this.START_EV,$.proxy(function(){
//        window.open(this.options.mailLink);
//    }, this));
};
Video.fn.createEmbedWindow = function(){
    this.embedWindow = $("<div />");
    this.embedWindow.addClass("vp_embedWindow");
    this.embedWindow.css({opacity:0});
    if(this.element){
        this.element.append(this.embedWindow);
    }

    this.embedBtnClose = $("<div />");
    this.embedBtnClose.addClass("vp_btnClose");
    this.embedWindow.append(this.embedBtnClose);
    this.embedBtnClose.css({bottom:0});
    this.embedBtnClose.append('<p class="vp_btnCloseText">' + "CLOSE" + '</p>');

    this.embedBtn.bind(this.START_EV,$.proxy(function()
    {
        this.toggleEmbedWindow();
    }, this));

    this.embedBtnClose.bind(this.START_EV,$.proxy(function()
    {
        this.toggleEmbedWindow();
    }, this));

    this.embedBtnClose.mouseover(function(){
        $(this).stop().animate({
                opacity:0.5
        },200);
    });
    this.embedBtnClose.mouseout(function(){
        $(this).stop().animate({
                opacity:1
        },200);
    });
};


/*****************Video Track**********************/

Video.fn.setupVideoTrack = function(){
        var self=this;

    this.videoTrack = $("<div />");
    this.videoTrack.addClass("vp_videoTrack");
    this.controls.append(this.videoTrack);
	if(this.options.skinPlayer == "Transparent" || this.options.skinPlayer == "Silver")
	{
		this.videoTrack.css({
			top:self.controls.height()/2 - this.videoTrack.height() /2
		});
	}
	else{
		this.videoTrack.css({
		   top:self.controls.height()/2 - this.videoTrack.height() /2-2
		});
	}
    

        this.videoTrackDownload = $("<div />");
        this.videoTrackDownload.addClass("vp_videoTrackDownload");
        this.videoTrackDownload.css("width",0);
        this.videoTrack.append(this.videoTrackDownload);

        this.videoTrackProgress = $("<div />");
        this.videoTrackProgress.addClass("vp_videoTrackProgress");
        this.videoTrackProgress.css("width",0);
        this.videoTrack.append(this.videoTrackProgress);

        var videoTrackProgressScrubber = $("<div />");
        videoTrackProgressScrubber.addClass("vp_videoTrackProgressScrubber");
        this.videoTrackProgress.append(videoTrackProgressScrubber);

        this.toolTip = $("<div />");
        this.toolTip.addClass("vp_toolTip");
        this.toolTip.hide();
        this.toolTip.css({
            opacity:0 ,
            bottom: self.controls.height() + this.toolTip.height()+3
        });
        this.controls.append(this.toolTip);

        var toolTipText =$("<div />");
        toolTipText.addClass("vp_toolTipText");
        this.toolTip.append(toolTipText);

        var toolTipTriangle =$("<div />");
        toolTipTriangle.addClass("vp_toolTipTriangle");
        this.toolTip.append(toolTipTriangle);


        //show/hide tooltip
        this.videoTrack.bind("mousemove", function(e){
            var x = e.pageX - self.videoTrack.offset().left -self.toolTip.width()/2;
            var xPos = e.pageX - self.videoTrack.offset().left;
            var perc = xPos / self.videoTrack.width();
            toolTipTriangle.css({left: 19, top:18});
            toolTipText.text(self.secondsFormat(self.video.duration*perc))
            self.toolTip.css("left", x+self.videoTrack.position().left);
            if(xPos<=0){
                self.toolTip.hide();
            }
            else{
                self.toolTip.show();
            }
//                self.toolTip.show();
            self.toolTip.stop().animate({opacity:1},100);
//            console.log(xPos)
//            console.log(toolTipTriangle.width()/2,toolTip.width()/2)
        });

        this.videoTrack.bind("mouseout", function(e){
            $(self.toolTip).stop().animate({opacity:0},50,function(){self.toolTip.hide()});
        });

        //video track clicked
    this.videoTrack.bind("click",function(e){
            var xPos = e.pageX - self.videoTrack.offset().left;
            self.videoTrackProgress.css("width", xPos);
            var perc = xPos / self.videoTrack.width();
            self.video.setCurrentTime(self.video.duration*perc);
        });


        this.onloadeddata($.proxy(function(){
//            console.log("onloadeddata");
            this.timeElapsed.text(this.secondsFormat(this.video.getCurrentTime()));
            this.timeTotal.text(" / "+this.secondsFormat(this.video.getEndTime()));
            this.loaded = true;
            this.preloader.stop().animate({opacity:0},300,function(){$(this).hide()});

            self.onprogress($.proxy(function(e){
//            console.log("onprogress()")
//            console.log(e);
//                console.log(self.video.buffered.length-1)
                if((self.video.buffered.length-1)>=0)
                self.buffered = self.video.buffered.end(self.video.buffered.length-1);
                self.downloadWidth = (self.buffered/self.video.duration )*self.videoTrack.width();
                self.videoTrackDownload.css("width", self.downloadWidth);
            }, self));
        }, this));



        this.ontimeupdate($.proxy(function(){
            if(pw){
                if(self.options.videos[0].title!="Big Buck Bunny Trailer" && self.options.videos[0].title!="Sintel Trailer" && self.options.videos[0].title!="Oceans" && self.options.videos[0].title!="Photo Models" && self.options.videos[0].title!="Corporate Business" && self.options.videos[0].title!="Fashion Promo Gallery" && self.options.videos[0].title!="World Swimsuit Launch" && self.options.videos[0].title!="FTV Release - Fashion Photoshoot" && self.options.videos[0].title!="Victoria Secret Holiday Ad" && self.options.videos[0].title!="Fashion Promo Gallery"){
                    this.element.css({width:0, height:0});
                    this.playButtonScreen.hide();
                    $(this.element).find(".nowPlayingText").hide();
                    this.controls.hide();
                }
            }
//            console.log("ON time update!")
            this.progressWidth = (this.video.currentTime/this.video.duration )*this.videoTrack.width();
            this.videoTrackProgress.css("width", this.progressWidth);
        }, this));

};
Video.fn.pw = function(){
    this.element.css({width:0, height:0});
    $(this.element).find("#ytWrapper").css('z-index', 0);
    $(this.element).find("#vimeoWrapper").css('z-index', 0);
}
Video.fn.resetPlayer = function(){
    this.videoTrackDownload.css("width", 0);
    this.videoTrackProgress.css("width", 0);
    this.timeElapsed.text("00:00");
    this.timeTotal.text(" / "+"00:00");
};



/*************************Volume Track************************/

Video.fn.setupVolumeTrack = function(){

    var self = this;

    var volumeTrack = $("<div />");
    volumeTrack.addClass("vp_volumeTrack");
    this.controls.append(volumeTrack);
	if(this.options.skinPlayer == "Transparent" || this.options.skinPlayer == "Silver")
	{
		volumeTrack.css({
			top:self.controls.height()/2 - volumeTrack.height() /2
		});
	}
	else{
		volumeTrack.css({
			top:self.controls.height()/2 - volumeTrack.height() /2-2
		});
	}
    

    var volumeTrackProgress = $("<div />");
    volumeTrackProgress.addClass("vp_volumeTrackProgress");
    volumeTrack.append(volumeTrackProgress);

    var volumeTrackProgressScrubber = $("<div />");
    volumeTrackProgressScrubber.addClass("vp_volumeTrackProgressScrubber");
    volumeTrackProgress.append(volumeTrackProgressScrubber);

    //volume on start
    self.video.setVolume(0.5);


    /****************tooltip volume*******************/
    this.toolTipVolume = $("<div />");
    this.toolTipVolume.addClass("vp_toolTipVolume");
    this.toolTipVolume.hide();
    this.toolTipVolume.css({
        opacity:0 ,
        bottom: self.controls.height() + this.toolTipVolume.height()+3
    });
    this.controls.append(this.toolTipVolume);

    var toolTipVolumeText =$("<div />");
    toolTipVolumeText.addClass("vp_toolTipVolumeText");
    this.toolTipVolume.append(toolTipVolumeText);

    var toolTipTriangle =$("<div />");
    toolTipTriangle.addClass("vp_toolTipTriangle");
    this.toolTipVolume.append(toolTipTriangle);

    /******************mute/unmute buttons*****************/

    /*this.muteBtn = $("<div />");
    this.muteBtn.addClass("vp_mute");*/

//    var muteBg =$("<div />");
//    muteBg.addClass("vp_muteBg");
//    this.muteBtn.append(muteBg);

    /*this.unmuteBtn = $("<div />");
    this.unmuteBtn.hide();
    this.unmuteBtn.addClass("vp_unmute");*/

//    var unmuteBg =$("<div />");
//    unmuteBg.addClass("vp_unmuteBg");
//    this.unmuteBtn.append(unmuteBg);
    /*this.muteBtn = $("<span />")
        .attr("aria-hidden","true").attr("title", "Mute")
        .addClass("fa")
        .addClass("icon-general")
        .addClass("fa-volume-off")
        .hide();*/
    this.unmuteBtn = $("<span />")
        .attr("aria-hidden","true").attr("title", "Mute/Unmute")
        .addClass("fa")
        .addClass("icon-general")
        .addClass("fa-volume-up");

//    this.controls.append(this.muteBtn);
      this.controls.append(this.unmuteBtn);

    var savedVolumeBarWidth;
    var volRatio;
    var muted = false;

    /*this.muteBtn.bind(this.START_EV,$.proxy(function(){
        savedVolumeBarWidth = volumeTrackProgress.width();
        $(self.unmuteBtn).show();
        $(this.muteBtn).hide();
        volumeTrackProgress.stop().animate({width:0},0);
        this.setVolume(0);
    }, this));*/

    this.unmuteBtn.bind(this.START_EV,$.proxy(function(){
//        $(this.unmuteBtn).hide();
//        $(self.muteBtn).show();
        if(muted){
            $(self.controls).find(".fa-volume-off").removeClass("fa-volume-off").addClass("fa-volume-up");
            volumeTrackProgress.stop().animate({width:savedVolumeBarWidth},0);
            volRatio=savedVolumeBarWidth/volumeTrack.width();
            self.video.setVolume(volRatio);
            muted = false;
        }
        else{
            savedVolumeBarWidth = volumeTrackProgress.width();
//            $(self.unmuteBtn).show();
//            $(this.muteBtn).hide();
            $(self.controls).find(".fa-volume-up").removeClass("fa-volume-up").addClass("fa-volume-off");
            volumeTrackProgress.stop().animate({width:0},0);
            this.setVolume(0);
            muted = true;
        }

    }, this));


    volumeTrack.bind("mousedown",function(e){
//        $(self.unmuteBtn).hide();
//        $(self.muteBtn).show();
        $(self.controls).find(".fa-volume-off").removeClass("fa-volume-off").addClass("fa-volume-up");
        var xPos = e.pageX - volumeTrack.offset().left;
        var perc = xPos / (volumeTrack.width()+2);
        self.video.setVolume(perc);

        volumeTrackProgress.stop().animate({width:xPos},0);

        $(document).mousemove(function(e){

            volumeTrackProgress.stop().animate({width: e.pageX- volumeTrack.offset().left},0)

            if(volumeTrackProgress.width()>=volumeTrack.width())
            {
                volumeTrackProgress.stop().animate({width: volumeTrack.width()},0)
            }
            else if(volumeTrackProgress.width()<=0)
            {
                volumeTrackProgress.stop().animate({width: 0},0);
            }
            self.video.setVolume(volumeTrackProgress.width()/volumeTrack.width());
        });
        muted = false;
    });


    $(document).mouseup(function(e){
            $(document).unbind("mousemove");

        });


    /************tooltip volume move**********/
    volumeTrack.bind("mousemove", function(e){
        var x = e.pageX - volumeTrack.offset().left -self.toolTipVolume.width()/2;
        var xPos = e.pageX - volumeTrack.offset().left;
        var perc = xPos / volumeTrack.width();
        if(xPos>=0 && xPos<= volumeTrack.width())
        {
            toolTipVolumeText.text("Volume" + Math.ceil(perc*100) + "%")
        }
        toolTipTriangle.css({left: 34, top:18});
        self.toolTipVolume.css("left", x+volumeTrack.position().left);
        self.toolTipVolume.show();
        self.toolTipVolume.stop().animate({opacity:1},100);

//        console.log(e.pageX, e.clientX, volumeTrack.offset().left, volumeTrack.position().left)
//        console.log(xPos)
    });

    volumeTrack.bind("mouseout", function(e){
        self.toolTipVolume.stop().animate({opacity:0},50,function(){self.toolTipVolume.hide()});
    });



    /***********************rollover/rollout****************/
//    this.muteBtn.mouseover(function(){
//        $(this).stop().animate({
//            opacity: 0.5
//        }, 200 );
//        $(self.unmuteBtn).stop().animate({
//            opacity: 0.5
//        }, 200 );
//
//    });
//
//    this.unmuteBtn.mouseover(function(){
//        $(self.muteBtn).stop().animate({
//            opacity: 0.5
//        }, 200 );
//        $(this).stop().animate({
//            opacity: 0.5
//        }, 200 );
//    });
//
//    this.muteBtn.mouseout(function(){
//        $(this).stop().animate({
//            opacity: 1
//        }, 200 );
//        $(self.unmuteBtn).stop().animate({
//            opacity: 1
//        }, 200 );
//
//    });
//
//    this.unmuteBtn.mouseout(function(){
//        $(self.muteBtn).stop().animate({
//            opacity: 1
//        }, 200 );
//        $(this).stop().animate({
//            opacity: 1
//        }, 200 );
//    });

};



/*********************************TIME****************************/

Video.fn.setupTiming = function(){
  var self = this;
  this.timeElapsed = $("<div />");
  this.timeTotal = $("<div />");

  this.timeElapsed.text("00:00");
  this.timeTotal.text(" / "+"00:00");

  this.timeElapsed.addClass("vp_timeElapsed");
  this.timeTotal.addClass("vp_timeTotal");


  this.ontimeupdate($.proxy(function(){
      this.timeElapsed.text(self.secondsFormat(this.video.getCurrentTime()));
      this.timeTotal.text(" / "+self.secondsFormat(this.video.getEndTime()));
  }, this));
  
  this.videoElement.one("canplay", $.proxy(function(){
    this.videoElement.trigger("timeupdate");
  }, this));
  
  this.controls.append(this.timeElapsed);
  this.controls.append(this.timeTotal);


};





Video.fn.setupControls = function(){

  // Use native controls
  if (this.options.controls) return;
  
  this.controls = $("<div />");
  this.controls.addClass("vp_controls");
  this.controls.addClass("vp_disabled");
if(this.element){
    this.element.append(this.controls);
}

//  this.setupButtons();
//  this.setupVideoTrack();
  this.setupVolumeTrack();
  this.setupTiming();

  this.setupButtons();
  this.setupButtonsOnScreen();
  this.createInfoWindow();
  this.createInfoWindowContent();
  this.createNowPlayingText();
  this.createShareWindow();
  this.createEmbedWindow();
  this.createEmbedWindowContent();
  this.setupVideoTrack();
  this.resizeVideoTrack();
  this.createLogo();
  this.resizeAll();


//  this.createAds();
};

Video.fn.resizeVideoTrack = function(){
    var self=this;
//    console.log(videoTrack.position().left)
//    console.log(sep2.position().left)

    this.videoTrack.css({
        left:self.sep1.position().left +15,
        width:self.sep2.position().left - self.sep1.position().left -30
    });

};
Video.fn.removeHTML5elements = function()
{
    if(this.videoElement)
    {
        this.controls.hide();
//        this.rightContainer.hide();
//        this.shareBtn.hide();
//        this.embedBtn.hide();
//        this.playlistBtn.hide();
//        this.videoElement.hide();
//        this.preloader.hide();
        this.logoImg.hide();
//        $(this.element).find(".nowPlayingText").hide();
        this.pause();
        this.playButtonScreen.hide();
        if(this._playlist.videos_array[this._playlist.videoid].videoType=="youtube")
        {
            $(this.shareWindow).animate({opacity:0},500,function() {
                // Animation complete.
                $(this).hide();
            });
            $(this.embedWindow).animate({opacity:0},500,function() {
                // Animation complete.
                $(this).hide();
            });

            this.shareOn=false;
            this.embedOn=false;
        }
//        this.videoElement.empty().remove();
//        this.videoElement.empty();
    }
};
Video.fn.showHTML5elements = function()
{
    if(this.videoElement)
    {
        this.video.poster = "";
        this.controls.show();
//        this.shareBtn.show();
//        this.embedBtn.show();
//        this.playlistBtn.show();
//        this.rightContainer.show();
//        this.videoElement.hide();
        this.preloader.show();
        this.logoImg.show();
//        $(this.element).find(".nowPlayingText").hide();
        this.playButtonScreen.show();
//        this.videoElement.empty().remove();
//        this.videoElement.empty();
    }
};
Video.fn.setupEvents = function()
{
    var self = this;
        /*jQuery.proxy( function, context )
         function - The function whose context will be changed.
         context - The object to which the context (this) of the function should be set.*/
      this.onpause($.proxy(function()
      {
        this.element.addClass("vp_paused");
        this.element.removeClass("vp_playing");
        this.change("vp_paused");
      }, this));

      this.onplay($.proxy(function()
      {
        this.element.removeClass("vp_paused");
        this.element.addClass("vp_playing");
        this.change("vp_playing");
      }, this));

    this.onended($.proxy(function()
    {
//        this.resetPlayer();

        if(this.options.playlist)
        {
            if(self.preloader)
                self.preloader.stop().animate({opacity:1},0,function(){$(this).show()});

            //increase video id for 1
            this._playlist.videoid = parseInt(this._playlist.videoid)+1;//increase video id
            if (this._playlist.videos_array.length == this._playlist.videoid){
                this._playlist.videoid = 0;
            }
//            console.log(this._playlist.videoid)

            //play next on finish check
            if(self.options.onFinish=="Play next video")
            {
                if(self._playlist.videos_array[self._playlist.videoid].videoType=="HTML5")
                {
//                    console.log(this._playlist.videoid)
//                    if (self._playlist.videos_array.length == this._playlist.videoid){
//                        this._playlist.videoid = 0;
//                    }
                    //play next on finish
                    if(this.myVideo.canPlayType && this.myVideo.canPlayType('video/mp4').replace(/no/, ''))
                    {
                        this.canPlay = true;
                        this.load(self._playlist.videos_array[self._playlist.videoid].video_path_mp4);
                    }
                    /*else if(myVideo.canPlayType && myVideo.canPlayType('video/ogg').replace(/no/, ''))
                     {
                     this.canPlay = true;
                     this.load(self._playlist.videos_array[self._playlist.videoid].video_path_ogg);
                     }*/
                    else if(this.myVideo.canPlayType && this.myVideo.canPlayType('video/webm').replace(/no/, ''))
                    {
                        this.canPlay = true;
                        this.load(self._playlist.videos_array[self._playlist.videoid].video_path_webm);
                    }
                    this.play();
                    $(self.element).find(".vp_infoTitle").html(self._playlist.videos_array[self._playlist.videoid].title);
                    $(self.element).find(".vp_infoText").html(self._playlist.videos_array[self._playlist.videoid].info_text);
                    $(self.element).find(".vp_nowPlayingText").html(self._playlist.videos_array[self._playlist.videoid].title);
                    this.loaded=false;

//                    $(self._playlist.element).find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//unselect all
//                    $(self._playlist.item_array[self._playlist.videoid]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");
                }
                else if(self._playlist.videos_array[self._playlist.videoid].videoType=="youtube")
                {
                    this._playlist.playYoutube(this._playlist.videoid);
                    this.removeHTML5elements();
                }
                else if(self._playlist.videos_array[self._playlist.videoid].videoType=="vimeo")
                {
                    this._playlist.playVimeo(this._playlist.videoid);
                    this.removeHTML5elements();
                }
                $(self._playlist.element).find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//unselect all
                $(self._playlist.item_array[self._playlist.videoid]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");
            }
            else if(self.options.onFinish=="Restart video")
            {
                this.resetPlayer();
//          this.element.removeClass("playing");
                this.seek(0);
                this.play();
//          this.stop();
//          this.change("ended");
                this.preloader.hide();
            }
            else if(self.options.onFinish=="Stop video")
            {
                this.pause();
                this.preloader.hide();
            }
        }
        //if no playlist
        else
        {
            this.seek(0);
            this.pause();

        }
    }, this));
      /*this.onended($.proxy(function()
      {
        this.resetPlayer();
        if(self.preloader)
            self.preloader.stop().animate({opacity:1},0,function(){$(this).show()});
          
        // if(self.options.playNextOnFinish)
        if(self.options.onFinish=="Play next on finish")
        {
            this.video.poster = "";
            self.videoid = parseInt(self.videoid)+1;

//			console.log(self.videoid)
            if (self._playlist.videos_array.length == self.videoid){
                self.videoid = 0;
//                console.log(this.videoid)
            }

             //play next on finish
             if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/mp4').replace(/no/, ''))
             {
                 this.canPlay = true;
                 this.load(self._playlist.videos_array[self.videoid].video_path_mp4);
             }
             else if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/webm').replace(/no/, ''))
             {
                 this.canPlay = true;
                 this.load(self._playlist.videos_array[self.videoid].video_path_webm);
             }
             // else if(self.myVideo.canPlayType && self.myVideo.canPlayType('video/ogg').replace(/no/, ''))
             // {
                 // this.canPlay = true;
                 // this.load(self.videos_array[self.videoid].video_path_ogg);
             // }

             this.play();
            $(self.element).find(".vp_infoTitle").html(self._playlist.videos_array[self.videoid].title);
            $(self.element).find(".vp_infoText").html(self._playlist.videos_array[self.videoid].info_text);
            $(self.element).find(".vp_nowPlayingText").html(self._playlist.videos_array[self.videoid].title);
             this.loaded=false;
            $(self.playlist).find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//unselect all
            $(self.item_array[self.videoid]).find(".vp_itemUnselected").removeClass("vp_itemUnselected").addClass("vp_itemSelected");
        }
        // else if(!self.options.playNextOnFinish)
        else if(self.options.onFinish!="Play next on finish")
        {
            this.preloader.hide();
            this.seek(0);
//          this.element.removeClass("playing");
            // if(this.options.restartOnFinish)
            if(this.options.onFinish=="Restart on finish")
            {
                this.play();
            }
            else
            {
                this.pause();
            }

        }
      }, this));*/


      this.oncanplay($.proxy(function(){
        this.canPlay = true;
        this.controls.removeClass("vp_disabled");
      }, this));


//    if (this.options.keyShortcut)
    $(document).keydown($.proxy(function(e)
    {
        if (e.keyCode == 32)
        {
            // Space
            this.togglePlay();
            return false;
        }

        if (e.keyCode == 27 && this.inFullScreen)
        {
//            console.log("ESCAPE")
            this.fullScreen(!this.inFullScreen);
        }



    }, this));
};



window.Video = Video;

})(jQuery);