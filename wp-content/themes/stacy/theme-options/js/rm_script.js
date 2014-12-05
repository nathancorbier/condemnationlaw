    jQuery(document).ready(function(){
		
        //jQuery('.rm_options').slideUp();
		/*
		jQuery('.rm_section h3').click(function(){		
			if(jQuery(this).parent().next('.rm_options').css('display')=='none')
				{	jQuery(this).removeClass('inactive');
					jQuery(this).addClass('active');
					jQuery(this).children('img').removeClass('inactive');
					jQuery(this).children('img').addClass('active');
					
				}
			else
				{	jQuery(this).removeClass('active');
					jQuery(this).addClass('inactive');		
					jQuery(this).children('img').removeClass('active');			
					jQuery(this).children('img').addClass('inactive');
				}
				
			jQuery(this).parent().next('.rm_options').slideToggle('slow');	
		});
        */
});
jQuery(function($) {
            var items = jQuery('#vtab li.rm_item');
            var id = items.first().attr("id");
            
            jQuery(".rm_section#"+id).fadeIn();
            
            items.first().addClass("selected");
            
            items.click(function() {
                items.removeClass('selected');
                jQuery(this).addClass('selected');

                var index = items.index(jQuery(this));  
                jQuery('#vtab>div').hide().eq(index).fadeIn("slow");
            }).eq(1).mouseover();
            
             //Ajax Form Submit//
            var options = { 
    beforeSend: function() 
    {
      
      jQuery("#message").fadeOut("slow");  
      jQuery(".loader-rm").show();  
      
    },
    success: function(response) 
    {
       jQuery("#message").addClass('updated below-h2').fadeIn("slow").children("p").html("Settings Successfully Saved.");
       jQuery(".loader-rm").hide();
       jQuery("body").scrollTop({top:0});
       //alert("done");
    },
     error: function()
    {
      
        jQuery("#message").addClass('error').fadeIn("slow").children("p").html("Some Error Occured.");
        jQuery(".loader-rm").hide();
         jQuery("body").scrollTop({top:0});
    }
}; 
            
         jQuery('#rm_form_settings').ajaxForm(options); 
         
         $('.rm_checkbox input[type=checkbox]').tzCheckbox({labels:['ON','OFF']});
         
         $("#vtab").css("min-height",$(".tabul").height());
        
                  

        });