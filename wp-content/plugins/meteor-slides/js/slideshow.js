var $j=jQuery.noConflict();$j(document).ready(function(){var e=parseInt(meteorslidessettings.meteorslideshowspeed);var t=parseInt(meteorslidessettings.meteorslideshowduration);var n=parseInt(meteorslidessettings.meteorslideshowheight);var r=parseInt(meteorslidessettings.meteorslideshowwidth);var i=meteorslidessettings.meteorslideshowtransition;$j(".meteor-slides").cycle({cleartypeNoBg:true,fit:1,fx:i,height:n,next:"#meteor-next",pager:"#meteor-buttons",pagerEvent:"click",pause:1,prev:"#meteor-prev",slideExpr:".mslide",speed:e,timeout:t,width:r});$j(".meteor-slides").touchwipe({wipeLeft:function(){$j(".meteor-slides").cycle("next")},wipeRight:function(){$j(".meteor-slides").cycle("prev")},preventDefaultEvents:false});$j(".meteor-slides").hover(function(){$j(this).addClass("navhover")},function(){$j(this).removeClass("navhover")});if(typeof document.body.style.maxWidth==="undefined"){$j(".meteor-nav a").height(n)}$j(".meteor-slides").each(function(){meteormetadata=$j(this).metadata();if(meteormetadata.align=="left"){$j(this).addClass("meteor-left")}else if(meteormetadata.align=="right"){$j(this).addClass("meteor-right")}else if(meteormetadata.align=="center"){$j(this).addClass("meteor-center")}})})