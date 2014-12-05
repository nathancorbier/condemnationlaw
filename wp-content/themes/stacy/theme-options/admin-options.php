<?php
	$themename = "Stacy";
	$shortname = "stacy";
	
    $template_uri = get_template_directory_uri();
	
	
	
	//Theme options
	$options = array(
 
		array ( "name" => "Options","type" => "title" ),

		array ( "name" => "General",
        "type" => "section",
        "image" => $template_uri."/theme-options/images/home.png",
        'id' => 'general'),
                        
		array ( "type" => "open"),
        

		array ( "name" => "Logo",
                        "desc" => "Upload your logo image",
                        "id" => $shortname . "_logo",
                        "type" => "upload",
                        "std" => "" ), 
                       
        array ( "name" => "Static Banner Image",
                        "desc" => "Upload Static Banner Image For Inner Page",
                        "id" => $shortname . "_banner",
                        "type" => "upload",
                        "std" => "" ),     
        array ( "name" => "Custom CSS",
						"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
						"id" => $shortname . "_custom_css",
						"type" => "textarea",
						"std" => "" ),  

		array ( "type" => "close"),
        
       /* array ( "type" => "open"),
        
        array ( "name" => "Woocommerce",
                        "type" => "section",
                        "image" => $template_uri."/theme-options/images/home.png",
                        'id' => 'woocommerce' ),
        array ( "name" => "Display Pagination :",
                        "desc" => "Display pagination on category page?",
                        "id" => $shortname . "_is_pagination",
                        "type" => "checkbox",
                        "std" => "" ),
                        
         array ( "name" => "No of Product/Category :",
                        "desc" => "Give The number of category will show at category page",
                        "id" => $shortname . "_no_of_product_will_show",
                        "class" => "small",
                        "type" => "text",
                        "std" => "" ),
         array ( "name" => "Pagination page no :",
                        "desc" => "Give The number of page pagination will show.",
                        "id" => $shortname . "_no_page",
                        "class" => "small",
                        "type" => "text",
                        "std" => "" ),
                        
        array ( "type" => "close"), */
		
		
		array ( "name" => "Socials",
						"type" => "section",
                        "image" => $template_uri."/theme-options/images/home.png",
                        'id' => 'socials' ),

		array ("type" => "open"),

		array ( "name" => "Facebook Link",
                        "desc" => "Give the facebook link",
                        "id" => $shortname . "_fb",
                        "label_image" => $template_uri."/theme-options/images/home.png",
                        "type" => "text",
                        "std" => "" ),
        
        array ( "name" => "Twitter Link",
                        "desc" => "Give the twitter link",
                        "id" => $shortname . "_tw",
                        "label_image" => $template_uri."/theme-options/images/home.png",
                        "type" => "text",
                        "std" => "" ),
        
        array ( "name" => "You Tube Link",
						"desc" => "Give the Instagram link",
						"id" => $shortname . "_you",
                        "label_image" => $template_uri."/theme-options/images/home.png",
						"type" => "text",
						"std" => "" ),
                        
        array ( "name" => "Instagram Link",
                        "desc" => "Give the Instagram link",
                        "id" => $shortname . "_in",
                        "label_image" => $template_uri."/theme-options/images/home.png",
                        "type" => "text",
                        "std" => "" ),                 
        
		array ( "type" => "close"),

		
		

		array ( "name" => "Footer",
						"type" => "section",
                        "image" => $template_uri."/theme-options/images/home.png",
                        'id' => 'footer'),

		array ( "type" => "open"),
        
        array ( "name" => "Fee Structure Details Link",
                        "desc" => "Give the Fee Structure Details link",
                        "id" => $shortname . "_fee",
                        "label_image" => $template_uri."/theme-options/images/home.png",
                        "type" => "text",
                        "std" => "" ),   

		array(  "name" => "Footer copyright text",
						"desc" => "Enter text used in the right side of the footer. It can be HTML",
						"id" => $shortname."_footer_text",
						"type" => "textarea",
						"std" => ""),

		array(  "name" => "Google Analytics Code",
						"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
						"id" => $shortname."_ga_code",
						"type" => "textarea",
						"std" => ""),
		array( "type" => "close")

);