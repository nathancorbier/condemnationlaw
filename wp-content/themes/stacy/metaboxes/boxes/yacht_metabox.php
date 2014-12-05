<?php 
   $prefix = 'ast_';
    $yacht_cabins_no=explode("-", get_option('ast_ydetails'));
      $arr1=array();
     for ($i=intval(trim($yacht_cabins_no[0])); $i<=intval(trim($yacht_cabins_no[1])); $i++)
     {
      $arr1[]=array("label"=>$i,"value"=>$i);
     }
     $yacht_category=explode(",",get_option("ast_ycdetails"));
 ///print_r($cabin_types);
 $arr2=array();
    foreach($yacht_category as $item){
        $item=trim($item);
        if(isset($item)){
       $arr2[]=array("label"=>$item,"value"=>$item); 
        }
    }
    $yacht_price=explode(",",get_option("ast_ypdetails"));
 ///print_r($cabin_types);
 $arr3=array();
    foreach($yacht_price as $item1){
        $item1=trim($item1);
        if(isset($item1)){
       $arr3[]=array("label"=>$item1,"value"=>$item1); 
        }
    }
    
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
    ),
 ); 
    $fields = array(  
    array( // Textarea
        'label'    => 'Accomodation', // <label>
        'desc'    => 'Enter Accomodation Details', // description
        'id'    => $prefix.'accomodation', // field id and name
        'type'    => 'textarea' // type of field
    ),  
        array( 
        'label'    => 'Yacht Cabin No', 
        'desc'    => 'Please choose the no. of cabins',
        'id'    => $prefix.'cabin_no', 
        'type'    => 'select', 
        'options' => $arr1
    ),
         array( 
        'label'    => 'Yacht Category', 
        'desc'    => 'Please Choose the Yacht Types',
        'id'    => $prefix.'category', 
        'type'    => 'select', 
        'options' => $arr2

    ),
   
    array( 
        'label'    => 'Built', 
        'desc'    => 'Enter the built year',
        'id'    => $prefix.'built', 
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Crew',
        'desc'    => 'Please enter crew details', 
        'id'    => $prefix.'crew', 
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Length', 
        'desc'    => 'Please enter length',
        'id'    => $prefix.'length',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'AC', 
        'desc'    => 'AC available or not', 
        'id'    => $prefix.'ac',
        'type'    => 'checkbox'
    ),
    array( 
        'label'    => 'Beam', 
        'desc'    => 'Please enter beam details', 
        'id'    => $prefix.'beam', 
        'type'    => 'text'
    ),
    array( 
        'label'    => 'Speed', 
        'desc'    => 'Enter speed limit',
        'id'    => $prefix.'speed',
        'type'    => 'text'
    ),
    array( 
        'label'    => 'Draft',
        'desc'    => 'Enter draft details',
        'id'    => $prefix.'draft',
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Engine', 
        'desc'    => 'Please enter engine details',
        'id'    => $prefix.'engine', 
        'type'    => 'text' 
    ),
    array( 
        'label'    => 'Generator', 
        'desc'    => 'Please enter generator details',
        'id'    => $prefix.'generator',
        'type'    => 'text' 
    ),
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
        'label'    => 'Repeatable', // <label>
        'desc'    => 'A description for the field.', // description
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
    ),
    array(// Repeatable Fields for Departure Dates
    'label'    => 'Departure Details', // <label>
        'desc'    => 'Enter Departure Details.', // description
        'id'    => $prefix.'departure_dates', // field id and name
        'type'    => 'repeatable', // type of field
        'sanitizer' => array( // array of sanitizers with matching kets to next array
            'featured' => 'meta_box_santitize_boolean',
            'title' => 'sanitize_text_field',
            'desc' => 'wp_kses_data'
        ),
        'repeatable_fields' => array (
        'title' => array(
                'label' => 'Departure Dates',
                'id' => 'ddates',
                'type' => 'text'
            )
    )
    )
    
 );

$fields1 = array(
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
        'repeatable_fields' => array ( // array of fields to be repeated

            array( // Select box
        'label'    => 'Yacht Months', // <label>
        'desc'    => 'Please Choose the Month', // description
        'id'    => $prefix.'month', // field id and name
        'type'    => 'select', // type of field
        'options' => array ( // array of options
            'one' => array ( // array key needs to be the same as the option value
                'label' => 'April', // text displayed as the option
                'value'    => 'April' // value stored for the option
            ),
            'two' => array (
                'label' => 'May',
                'value'    => 'May'
            ),
            'three' => array (
                'label' => 'June',
                'value'    => 'June'
            ),
            'four' => array (
                'label' => 'July',
                'value'    => 'July'
            ),
            'five' => array (
                'label' => 'August',
                'value'    => 'August'
            ),
            'six' => array (
                'label' => 'September',
                'value'    => 'September'
            ),
            'seven' => array (
                'label' => 'October',
                'value'    => 'October'
            )
            
        )
    ),
           'price_value' => array(
                'label' => 'Price',
                'id' => 'price_value',
                'type' => 'text'
            )
        )
    )

    );
   
             
 
 
 
 $sample_box = new custom_add_meta_box( 'yacht_details', 'Yacht Details', $fields, 'yacht', true );
 $sample_box11 = new custom_add_meta_box( 'yacht_price_details', 'Yacht Price Details', $fields1, 'yacht', true );
 $sample_box2 = new custom_add_meta_box( 'yacht_deal', 'Yacht Deal', $fields2, 'yacht', true );

 