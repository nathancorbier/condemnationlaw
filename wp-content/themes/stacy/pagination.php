      <?php 
                                   if(is_product_category()):
                                      
                                   global  $number_of_cat_Found,$number_of_product;
                                         
                                         $term = get_queried_object();
                                          
                                          $category_link = get_category_link($term);
                                          
                                          $page_url = $category_link;
                                          
                                          
                                           
                                         
                                         $page_no =  intval($number_of_cat_Found/$number_of_product);
                                         
                                         $page_no = ($number_of_cat_Found % $number_of_product != 0) ? $page_no+1 : $page_no ;
                                         
                                         $page = (get_query_var('page')) ? get_query_var('page') : 1;
                                         
                                         $previous_page = ($page == 1) ? 1 : $page;
                                         
                                         $next_page =  $page+1 ;
                                         
                                        // print_r(get_queried_object());
                                       
                                          
                                         $class = "";
                                         
                                         if($number_of_cat_Found > $number_of_product):
                                         
                                   ?>
                                    <ul class="paginations">
                                     <li><a href="<?php echo add_query_arg(array('page' => 1),$category_link); ?>"> |< </a></li>
                                     <li><a href="<?php echo add_query_arg(array('page' => $previous_page),$category_link); ?>"> < </a></li>
                                    <?php
                                  
                                    for($i=1;$i<=$page_no;$i++){
                                        
                                        if($page == $i) {
                                            
                                            $class = "class='paginations-active'";
                                        }
                                        ?>
        
                                        <li <?php echo $class; ?> ><a href="<?php echo $page_url.$i; ?>"><?php echo $i; ?></a></li>
               
                                  <?php } ?> 
                                   
                                   <li><a href="<?php echo $page_url.$next_page; ?>"> > </a></li>
                                   <li><a href="<?php echo $page_url.$page_no; ?>"> >| </a></li>
                                    </ul>
                                <?php endif; ?>  
                                <?php endif; ?> 