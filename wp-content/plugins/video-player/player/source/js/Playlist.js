var PLAYER= PLAYER || {};


PLAYER.Playlist = function ($, video, options, element, preloader, myVideo, canPlay, click_ev, pw, hasTouch) {
    console.log("PLAYLIST.js")
    //constructor
    var self = this;

    this.VIDEO = video;
    this.element = element;
    this.canPlay = canPlay;
    this.CLICK_EV = click_ev;
    this.hasTouch = hasTouch;
    this.preloader = preloader;
    this.options = options;
    this.videoid = "VIDEOID";
    this.adStartTime = "ADSTARTTIME";
    this.videoAdPlaying = false;

    this.playlist = $("<div />");
    this.playlist.attr('id', 'vp_playlist');

    this.playlistContent= $("<dl />");
    this.playlistContent.attr('id', 'vp_playlistContent');

    self.videos_array=new Array();
    self.item_array=new Array();

    this.ytWrapper = $('<div></div>');
    this.ytWrapper.attr('id', 'vp_ytWrapper');
    if( self.element){
        self.element.append(self.ytWrapper);
    }

    this.ytPlayer = $('<div></div>');
    this.ytPlayer.attr('id', 'vp_ytPlayer');
    this.ytWrapper.append(this.ytPlayer);

    this.vimeoWrapper = $('<div></div>');
    this.vimeoWrapper.attr('id', 'vp_vimeoWrapper');
    if( self.element){
        self.element.append(self.vimeoWrapper);
    }

    $('#vp_vimeoWrapper').html('<iframe id="vimeo_video" src="" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');


//    var offsetL=0;
    var offsetT=0;

    document.addEventListener("eventYoutubeReady", onPlayerReady, false);
    /* window.addEventListener("eventYoutubeReady", onPlayerReady, false); */

    function onPlayerReady(eventYoutubeReady) {
        console.log("youtube ready")
        if(options.videos[0].videoType=="youtube")
        {
            self.VIDEO.removeHTML5elements();
            self.youtubePlayer.cueVideoById(self.videos_array[0].youtubeID);

            if(!this.hasTouch){
                if(options.autoplay)
                    (self.youtubePlayer).playVideo();
            }
            self.VIDEO.resizeAll();
        }
    }
    function onPlayerStateChange(event) {
        if(event.data === 0) {
            //ended
            if(options.playlist)
            {
                self.videoid = parseInt(self.videoid)+1;//increase video id
                if (self.videos_array.length == self.videoid){
                    self.videoid = 0;
                }
                //play next on finish
//                if(options.playNextOnFinish)
                if(options.onFinish=="Play next video")
                {
                    self.element.find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//remove selected
                    $(self.item_array[self.videoid]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");//selected

                    if(options.videos[self.videoid].videoType=="youtube")
                    {
                        self.ytWrapper.css({zIndex:501});
                        self.VIDEO.removeHTML5elements();
                        if(self.youtubePlayer!= undefined){
                            self.youtubePlayer.cueVideoById(self.videos_array[self.videoid].youtubeID);
                            self.youtubePlayer.setSize(element.width(), element.height());
                            if(!this.hasTouch){
                                (self.youtubePlayer).playVideo();
                            }
                        }

                    }
                    else if(options.videos[self.videoid].videoType=="HTML5")
                    {
                        self.ytWrapper.css({zIndex:0});
                        self.VIDEO.showHTML5elements();
                        if(self.youtubePlayer!= undefined){
                            self.youtubePlayer.stopVideo();
                            self.youtubePlayer.clearVideo();
                            self.youtubePlayer.setSize(1, 1); 
                        }


                        if(myVideo.canPlayType && myVideo.canPlayType('video/mp4').replace(/no/, ''))
                        {
                            this.canPlay = true;
                            //                            alert(".mp4 can play" + this.canPlay);
                            video_path = self.videos_array[self.videoid].video_path_mp4;
                        }
                        else if(myVideo.canPlayType && myVideo.canPlayType('video/webm').replace(/no/, ''))
                        {
                            this.canPlay = true;
                            //                         alert(".webm can play" + this.canPlay);
                            video_path = self.videos_array[self.videoid].video_path_webm;
                        }
                        self.VIDEO.resizeAll();
                        self.VIDEO.load(video_path, self.videoid);
                        self.VIDEO.play();

                        $(self.element).find(".vp_infoTitle").html(self.videos_array[self.videoid].title);
                        $(self.element).find(".vp_infoText").html(self.videos_array[self.videoid].info_text);
                        $(self.element).find(".vp_nowPlayingText").html(self.videos_array[self.videoid].title);
                    }
                }
//                else if(!options.playNextOnFinish)
                else if(options.onFinish=="Restart video")
                {
                    if(self.youtubePlayer!= undefined){
                        self.youtubePlayer.seekTo(0);
                        self.youtubePlayer.playVideo();
                    }

                }
                else if(options.onFinish=="Stop video")
                {
                    // load more videos
                }
            }
        }
    }
    function onPauseVimeo(id) {
        self.vimeoStatus.text('paused');
//        console.log("vimeo paused")
    }

    function onFinishVimeo(id) {
        self.vimeoStatus.text('finished');
//        console.log("vimeo finished")

        if(options.playlist)
        {
            self.videoid = parseInt(self.videoid)+1;//increase video id
            if (self.videos_array.length == self.videoid){
                self.videoid = 0;
            }
            //play next on finish
//                if(options.playNextOnFinish)
            if(options.onFinish=="Play next video")
            {
                self.element.find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//remove selected
                $(self.item_array[self.videoid]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");//selected

                if(options.videos[self.videoid].videoType=="youtube")
                {
                    self.preloader.stop().animate({opacity:0},0,function(){$(this).hide()});
                    self.vimeoWrapper.css({zIndex:0});
//                self.vimeoPlayer.api('unload');
                    $('iframe#vimeo_video').attr('src','');
                    self.ytWrapper.css({zIndex:501});
                    self.VIDEO.removeHTML5elements();
                    if(self.youtubePlayer!= undefined){
                        self.youtubePlayer.cueVideoById(self.videos_array[self.videoid].youtubeID);
                        self.youtubePlayer.setSize(element.width(), element.height());
                        if(!this.hasTouch){
                            (self.youtubePlayer).playVideo();
                        }
                    }

                }
                else if(options.videos[self.videoid].videoType=="HTML5")
                {
                    self.preloader.stop().animate({opacity:0},0,function(){$(this).hide()});
                    self.vimeoWrapper.css({zIndex:0});
//                self.vimeoPlayer.api('unload');
                    $('iframe#vimeo_video').attr('src','');
                    self.ytWrapper.css({zIndex:0});
                    self.VIDEO.showHTML5elements();
                    if(self.youtubePlayer!= undefined){
                        self.youtubePlayer.stopVideo();
                        self.youtubePlayer.clearVideo();
                        self.youtubePlayer.setSize(1, 1);
                    }


                    if(myVideo.canPlayType && myVideo.canPlayType('video/mp4').replace(/no/, ''))
                    {
                        this.canPlay = true;
                        //                            alert(".mp4 can play" + this.canPlay);
                        video_path = self.videos_array[self.videoid].video_path_mp4;
                    }
                    else if(myVideo.canPlayType && myVideo.canPlayType('video/webm').replace(/no/, ''))
                    {
                        this.canPlay = true;
                        //                         alert(".webm can play" + this.canPlay);
                        video_path = self.videos_array[self.videoid].video_path_webm;
                    }
                    self.VIDEO.resizeAll();
                    self.VIDEO.load(video_path, self.videoid);
                    self.VIDEO.play();

                    $(self.element).find(".vp_infoTitle").html(self.videos_array[self.videoid].title);
                    $(self.element).find(".vp_infoText").html(self.videos_array[self.videoid].info_text);
                    $(self.element).find(".vp_nowPlayingText").html(self.videos_array[self.videoid].title);
                }
                else if(options.videos[self.videoid].videoType=="vimeo")
                {
                    $('iframe#vimeo_video').attr('src','');
                    self.preloader.stop().animate({opacity:0},700,function(){$(this).hide()});
                    if(!self.hasTouch){
                        document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[self.vdeoid].vimeoID+"?autoplay=1?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;
                    }
                    else{
                        document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[self.vdeoid].vimeoID+"?autoplay=0?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;
                    }
                }
            }
//                else if(!options.playNextOnFinish)
            else if(options.onFinish=="Restart video")
            {
                self.vimeoPlayer.api('play');

            }
            else if(options.onFinish=="Stop video")
            {
                //load more videos
            }
        }
    }
    function onPlayProgressVimeo(data, id) {
        self.vimeoStatus.text(data.seconds + 's played');
//        console.log("onProgress")
    }
    function addVimeoListeners() {
        self.vimeoIframe = $('#vimeo_video')[0];
        self.vimeoPlayer = $f(self.vimeoIframe);
        self.vimeoStatus = $('.status');
        // When the player is ready, add listeners for pause, finish, and playProgress
//            addVimeoListeners();
        self.vimeoPlayer.addEvent('ready', function() {
            console.log("vimeo ready");
            self.vimeoPlayer.addEvent('pause', onPauseVimeo);
            self.vimeoPlayer.addEvent('finish', onFinishVimeo);
            self.vimeoPlayer.addEvent('playProgress', onPlayProgressVimeo);
        });
    }

    /*function onPause(id) {
        self.status.text('paused');
        console.log("onpause")
    }

    function onFinish(id) {
        self.status.text('finished');
        console.log("onFinish")

    }

    function onPlayProgress(data, id) {
        self.status.text(data.seconds + 's played');
        console.log("onPlay")
    }*/




    var id=-1;
    $(options.videos).each(function loopingItems()
    {
        id= id+1;
        var obj=
        {
            id: id,
            title:this.title,
            videoType:this.videoType,
            youtubeID:this.youtubeID,
            vimeoID:this.vimeoID,
            video_path_mp4:this.mp4,
            video_path_webm:this.webm,
//            video_path_ogg:this.ogv,
            description:this.description,
            thumbnail_image:this.thumbImg,
            info_text: this.info
        };
        self.videos_array.push(obj);
        self.item = $("<div />");
        self.item.addClass("vp_item").css("top",String(offsetT)+"px");
        self.item_array.push(self.item);
        self.item.addClass("vp_itemUnselected");
        var itemLeft = '<div class="vp_itemLeft"><img class="vp_thumbnail_image" alt="" src="' + obj.thumbnail_image + '"></img></div>';
        var itemRight = '<div class="vp_itemRight"><div class="vp_title">' + obj.title + '</div><div class="vp_description"> ' + obj.description + '</div></div>';
        self.item.append(itemLeft);
        self.item.append(itemRight);
        offsetT += 64;
        self.playlistContent.append(self.item);

        //play new video
        self.item.bind(self.CLICK_EV, function()
        {
//             self.VIDEO.stretchPlayer();
            if (self.scroll.moved)
            {
//                 console.log("scroll moved...")
                return;
            }
            if(self.preloader)
                self.preloader.stop().animate({opacity:1},0,function(){$(this).show()});
            self.videoid = obj.id;

            self.VIDEO.resetPlayer();

            if(options.videos[obj.id].videoType=="youtube")
            {
                self.preloader.stop().animate({opacity:0},0,function(){$(this).hide()});
                self.ytWrapper.css({zIndex:501});
                self.VIDEO.removeHTML5elements();
                self.vimeoWrapper.css({zIndex:0});
//                self.vimeoPlayer.api('unload');
                $('iframe#vimeo_video').attr('src','');
                if(self.youtubePlayer!= undefined){
                    self.youtubePlayer.setSize(element.width(), element.height());
    //                self.youtubePlayer.cueVideoById(self.videos_array[obj.id].youtubeID);
                    if(self.CLICK_EV=="click")
                    {
                        self.youtubePlayer.loadVideoById(self.videos_array[obj.id].youtubeID);
    //                    self.youtubePlayer.playVideo();
                    }
                    if(self.CLICK_EV=="touchend")
                    {
                        self.youtubePlayer.cueVideoById(self.videos_array[obj.id].youtubeID);
                    }
                }

            }
            else if(options.videos[obj.id].videoType=="HTML5")
            {
                self.ytWrapper.css({zIndex:0});
                self.vimeoWrapper.css({zIndex:0});
//                self.vimeoPlayer.api('unload');
                $('iframe#vimeo_video').attr('src','');
                self.VIDEO.showHTML5elements();
                self.VIDEO.resizeAll();
                if(self.youtubePlayer!= undefined){
                    self.youtubePlayer.stopVideo();
                    self.youtubePlayer.clearVideo();
                    self.youtubePlayer.setSize(1, 1);
                }

                if(myVideo.canPlayType && myVideo.canPlayType('video/mp4').replace(/no/, ''))
                {
                    this.canPlay = true;
//                            alert(".mp4 can play" + this.canPlay);
                    self.video_path = obj.video_path_mp4;
                }
                else if(myVideo.canPlayType && myVideo.canPlayType('video/webm').replace(/no/, ''))
                {
                    this.canPlay = true;
//                         alert(".webm can play" + this.canPlay);
                    self.video_path = obj.video_path_webm;
                }
                /*else if(myVideo.canPlayType && myVideo.canPlayType('video/ogg').replace(/no/, ''))
                 {
                 this.canPlay = true;
                 //                            alert(".oggTheora can play" + this.canPlay);
                 video_path = obj.video_path_ogg;
                 }*/
                self.VIDEO.load(self.video_path, obj.id);
                self.VIDEO.play();

                $(self.element).find(".vp_infoTitle").html(obj.title);
                $(self.element).find(".vp_infoText").html(obj.info_text);
                $(self.element).find(".vp_nowPlayingText").html(obj.title);
                this.loaded=false;
            }
            if(options.videos[obj.id].videoType=="vimeo")
            {
                self.preloader.stop().animate({opacity:0},700,function(){$(this).hide()});
                self.vimeoWrapper.css({zIndex:501});
                if(self.CLICK_EV=="click")
                    document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[obj.id].vimeoID+"?autoplay=1?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;
                if(self.CLICK_EV=="touchend")
                    document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[obj.id].vimeoID+"?autoplay=1?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;

                self.VIDEO.removeHTML5elements();
                self.ytWrapper.css({zIndex:0});
                if(self.youtubePlayer!= undefined){
                    self.youtubePlayer.stopVideo();
                    self.youtubePlayer.clearVideo();
                    self.youtubePlayer.setSize(1, 1);
                }
                addVimeoListeners();
            }


            self.element.find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//remove selected
            $(this).removeClass("vp_itemUnselected").addClass("vp_itemSelected");
        });


        //play first from playlist
        $(self.item_array[0]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");//first selected
        self.videoid = 0;

        if(options.videos[0].videoType=="youtube")
        {
            self.ytWrapper.css({zIndex:501});
            self.vimeoWrapper.css({zIndex:0});
            // create youtube player
            window.onYouTubePlayerAPIReady= function(){
                self.youtubePlayer = new YT.Player(document.getElementById('vp_ytPlayer'), {
                    height: '1',
                    width: '1',
//                    videoId: 'INmtQXUXez8',
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            };

        }
        else if(options.videos[0].videoType=="HTML5")
        {
            self.ytWrapper.css({zIndex:0});
            self.vimeoWrapper.css({zIndex:0});
            // create youtube player
            window.onYouTubePlayerAPIReady= function(){
                self.youtubePlayer = new YT.Player(document.getElementById('vp_ytPlayer'), {
                    height: '1',
                    width: '1',
//                    videoId: 'INmtQXUXez8',
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            };
            if(myVideo.canPlayType && myVideo.canPlayType('video/mp4').replace(/no/, ''))
            {
                this.canPlay = true;
                self.video_path = self.videos_array[0].video_path_mp4;
            }
            /*else if(myVideo.canPlayType && myVideo.canPlayType('video/ogg').replace(/no/, ''))
             {
             this.canPlay = true;
             video_path = self.videos_array[0].video_path_ogg;
             }*/
            else if(myVideo.canPlayType && myVideo.canPlayType('video/webm').replace(/no/, ''))
            {
                this.canPlay = true;
                self.video_path = self.videos_array[0].video_path_webm;
            }
            self.VIDEO.load(self.video_path, "0");
        }
        else if(options.videos[0].videoType=="vimeo")
        {
            // create youtube player
            window.onYouTubePlayerAPIReady= function(){
                self.youtubePlayer = new YT.Player(document.getElementById('vp_ytPlayer'), {
                    height: '1',
                    width: '1',
//                    videoId: 'INmtQXUXez8',
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            };
            self.preloader.stop().animate({opacity:0},700,function(){$(this).hide()});
            self.vimeoWrapper.css({zIndex:501});

            if(!self.hasTouch){
                if(options.autoplay)
                    document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[0].vimeoID+"?autoplay=1?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;
                else
                    document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[0].vimeoID+"?autoplay=0?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;
            }
            else{
                document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+self.videos_array[0].vimeoID+"?autoplay=0?api=1&player_id=vimeo_video"+"&color="+options.vimeoColor;
            }
            addVimeoListeners();

        }

    });


    self.playlistContent.css("height",String(offsetT)+"px");

    self.totalWidth = options.videoPlayerWidth;
    self.totalHeight = options.videoPlayerHeight;

    //check if show playlist "on" or "off"
    if(options.playlist)
    {
        if( self.element){
            self.element.append(self.playlist);
            self.playlist.append(self.playlistContent);
        }
    }
    self.playerWidth = self.totalWidth - self.playlist.width();
    self.playerHeight = self.totalHeight - self.playlist.height();

    self.playlist.css({
        height:self.playerHeight,
        top:0
    });

    if(options.playlist)
    {
        self.scroll = new iScroll(self.playlist[0], {bounce:false,scrollbarClass: 'vp_myScrollbar'});
    }

    this.playlistW = this.playlist.width();
    this.playlistH = this.playlist.height();


};


//prototype object, here goes public functions
PLAYER.Playlist.prototype = {

    hidePlaylist:function(){
        this.playlist.hide();
    },
    showPlaylist:function(){
        this.playlist.show();
    },
    resizePlaylist:function(xPosPlaylist, newHeight){
        this.playlist.css({
            left:xPosPlaylist - this.playlist.width(),
            top:0,
            height:newHeight
        });

    },
    playYoutube:function(obj_id){
//        this.element.find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//remove selected
//        $(this.item_array[obj_id]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");//selected
        if(this.youtubePlayer!= undefined){
            this.youtubePlayer.cueVideoById(this.videos_array[obj_id].youtubeID);
            if(!this.hasTouch)
                this.youtubePlayer.playVideo();
        }

//        this.youtubePlayer.setSize(element.width(), element.height());
        this.VIDEO.resizeAll();
    },
    playVimeo:function(obj_id){
//        console.log(this.item_array[obj_id])
//        this.element.find(".vp_itemSelected").removeClass("vp_itemSelected").addClass("vp_itemUnselected");//remove selected
//        $(this.item_array[obj_id]).removeClass("vp_itemUnselected").addClass("vp_itemSelected");//selected
        this.preloader.hide();
        this.vimeoWrapper.css({zIndex:501});
        if(!this.hasTouch){
            document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+this.videos_array[obj_id].vimeoID+"?autoplay=1?api=1&player_id=vimeo_video"+"&color="+this.options.vimeoColor;
        }
        else{
            document.getElementById("vimeo_video").src ="http://player.vimeo.com/video/"+this.videos_array[obj_id].vimeoID+"?autoplay=0?api=1&player_id=vimeo_video"+"&color="+this.options.vimeoColor;
        }

    }


};