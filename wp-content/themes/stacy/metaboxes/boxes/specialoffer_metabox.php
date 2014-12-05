<?php 
   $prefix = 'ast_';
    $fields = array(    
        array( 
        'label'    => 'Page Link', 
        'desc'    => 'Please Enter the Offer Link',
        'id'    => $prefix.'offerlink', 
        'type'    => 'text' 
       ),
        array( 
        'label'    => 'Special Offer',
        'desc'    => 'Please Special Offer Details', 
        'id'    => $prefix.'specialoffer', 
        'type'    => 'text' 
    ),
   array( 
        'label'    => 'Box Type', 
        'desc'    => 'Please Choose the position', 
        'id'    => $prefix.'boxtype', 
        'type'    => 'select', 
        'options' => array (
            'one' => array ( 
                'label' => 'Left', 
                'value'    => 'left'
            ),
            'two' => array (
                'label' => 'Right',
                'value'    => 'right'
            )
        )
    ),
      
   );
  $sample_box = new custom_add_meta_box( 'special_offer_details', 'Special Offer Details', $fields, 'post', true );
