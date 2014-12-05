<?php 
   $prefix = 'ast_';
   //Cabin Number
     $cabin_types=explode(",",get_option("ast_cdetails"));
 ///print_r($cabin_types);
 $arr1=array();
    foreach($cabin_types as $item){
        $item=trim($item);
        if(isset($item)){
       $arr1[]=array("label"=>$item,"value"=>$item); 
        }
    }
      $cabin_price=explode(",",get_option("ast_cpdetails"));
 //print_r($cabin_price);
 $arr3=array();
    foreach($cabin_price as $item1){
        $item1=trim($item1);
        if(isset($item1)){
       $arr3[]=array("label"=>$item1,"value"=>$item1); 
        }
    }
  
   $fields = array(    
        array( 
        'label'    => 'Type', 
        'desc'    => 'Please choose the no. of cabins',
        'id'    => $prefix.'category', 
        'type'    => 'select', 
        'options' => $arr1
    ),
    
    array( 
        'label'    => 'Gulet Name', 
        'desc'    => 'Enter the Gulet Name',
        'id'    => $prefix.'guname', 
        'type'    => 'text' 
    ),
   
     array( 
        'label'    => 'Destination', 
        'desc'    => 'Please Choose the Destination',
        'id'    => $prefix.'cabin_destination', 
        'type'    => 'text', 
       ),
   
    array( 
        'label'    => 'Duration', 
        'desc'    => 'Please Enter Duration',
        'id'    => $prefix.'duration',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Departure Days', 
        'desc'    => 'Please Enter Departure Days',
        'id'    => $prefix.'departure',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Embarkation', 
        'desc'    => 'Please Enter Embarkation',
        'id'    => $prefix.'embarkation',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Embarkation Time', 
        'desc'    => 'Please Enter Embarkation Time',
        'id'    => $prefix.'etime',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Disembarkation', 
        'desc'    => 'Please Enter Disembarkation',
        'id'    => $prefix.'disembarkation',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Disembarkation Time', 
        'desc'    => 'Please Enter Disembarkation Time',
        'id'    => $prefix.'dtime',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Optional Excursions', 
        'desc'    => 'Please Enter Optional Excursions',
        'id'    => $prefix.'excursions',
        'type'    => 'text' 
    )
    );
     $fields8 = array(        
         array( // Repeatable & Sortable Text inputs
        'label'    => 'Gallery', // <label>
        'desc'    => 'Please Insert Image for the Gallery', // description
        'id'    => $prefix.'repeatable', // field id and name
        'type'    => 'repeatable', // type of field
        'sanitizer' => array( // array of sanitizers with matching kets to next array
            'featured' => 'meta_box_santitize_boolean',
            'title' => 'sanitize_text_field',
            'desc' => 'wp_kses_data'
        ),
        'repeatable_fields' => array ( // array of fields to be repeated
             array( // Image ID field
                'label'    => 'Image', // <label>
                'id'    => 'image', // field id and name
                'type'    => 'image' // type of field
            ),
            'title' => array(
                'label' => 'Title',
                'id' => 'title',
                'type' => 'text'
            )
         )
    )
     );
 
 $fields2=array(
 array( // Single checkbox
        'label'    => 'Popular Deal', // <label>
        'desc'    => 'Is Popular Deal or Not? ', // description
        'id'    => $prefix.'deal', // field id and name
        'type'    => 'checkbox' // type of field
    ),
  
array( // Single checkbox
        'label'    => 'Special Offer', // <label>
        'desc'    => 'Is Special Offer or Not?', // description
        'id'    => $prefix.'offer', // field id and name
        'type'    => 'checkbox' // type of field
    )
 ); 
 $fields4 = array(      
    array( 
        'label'    => 'Average Price', 
        'desc'    => 'Please enter Average Price',
        'id'    => $prefix.'avgprice',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Offer Price', 
        'desc'    => 'Please enter Offer Price',
        'id'    => $prefix.'offer_price',
        'type'    => 'text' 
    ),
    array( // Repeatable & Sortable Text inputs
        'label'    => 'Price Details', // <label>
        'desc'    => 'A description for the field.', // description
        'id'    => $prefix.'price_details', // field id and name
        'type'    => 'repeatable', // type of field
        'sanitizer' => array( // array of sanitizers with matching kets to next array
            'featured' => 'meta_box_santitize_boolean',
            'title' => 'sanitize_text_field',
            'desc' => 'wp_kses_data'
        ), 
      
        'repeatable_fields' => array ( 
               'price_date1' => array(
                'label' => 'Date',
                'id' => 'price_date1',
                'type' => 'text'
            ),
             'price_value1' => array(
                'label' => 'Price',
                'id' => 'price_value1',
                'type' => 'text'
            )
        )
    ),
     
    
);
$fields6=array(
  array(// Repeatable Fields for Departure Dates
    'label'    => 'Departure Details', // <label>
        'desc'    => 'Enter Departure Details.', // description
        'id'    => $prefix.'departure_details', // field id and name
        'type'    => 'repeatable', // type of field
        'sanitizer' => array( // array of sanitizers with matching kets to next array
            'featured' => 'meta_box_santitize_boolean',
            'title' => 'sanitize_text_field',
            'desc' => 'wp_kses_data'
        ),
        'repeatable_fields' => array (
        'ddates' => array(
                'label' => 'Departure Dates',
                'id' => 'ddates',
                'type' => 'text'
            ),
        'dtimes' => array(
                'label' => 'Departure Times',
                'id' => 'dtimes',
                'type' => 'text'
            )
    )
    )
    );
 

      
 $sample_box = new custom_add_meta_box( 'cabin_charter_deal_options', 'Cabin Charter Deal Options', $fields2, 'ban',true );
 $sample_box = new custom_add_meta_box( 'cabin_charter_details', 'Cabin Charter Details', $fields, 'ban', true );
 $sample_box= new custom_add_meta_box( 'cabin_charter_price_details', 'Cabin Charter Price Details', $fields4,'ban',true ); 
 $sample_box= new custom_add_meta_box( 'cabin_charter_departure_details', 'Cabin Charter Departure Details', $fields6,'ban',true ); 
 $sample_box= new custom_add_meta_box( 'cabin_charter_gallery_details', 'Cabin Charter Gallery', $fields8,'ban',true ); 