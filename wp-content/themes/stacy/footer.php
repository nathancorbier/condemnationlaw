    <div class="col-sm-12 footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="footer-left">
                        <h3>Connect With Us</h3>
                        <ul>
                            <li><a href="<?php echo get_option('stacy_fb'); ?>"><img src="<?php echo get_bloginfo('template_url');?>/img/fb.png" alt="fb"></a></li>
                            <li><a href="<?php echo get_option('stacy_tw'); ?>"><img src="<?php echo get_bloginfo('template_url');?>/img/twi.png" alt="twi"></a></li>
                            <li><a href="<?php echo get_option('stacy_you'); ?>"><img src="<?php echo get_bloginfo('template_url');?>/img/utuv.png" alt="utuv"></a></li>
                            <li><a href="<?php echo get_option('stacy_in'); ?>"><img src="<?php echo get_bloginfo('template_url');?>/img/in.png" alt="in"></a></li>
                        </ul>
                        <div class="clearfix"></div>
                        <h4>Disclaimer</h4>
                        <div class="footer-divider"></div>
                        <ul class="click">
                            <li><a href="<?php echo get_option('stacy_fee'); ?>" class="clikhere">Click here*</a></li>
                            <li><p>for a full explanation </p><p>of our fee structure</p></li>
                        </ul>
                        <div class="clearfix"></div>
                        <div class="footer-divider"></div>
                        <div class="clearfix">
                        <h5>
						<a style="color: #C9C6C6; font-size: 9px; text-decoration: none" href="http://kristinvit.com"><?php echo get_option('stacy_footer_text'); ?> </a>
						</h5>
                        </div>   
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="footer-right">
                        <div class="con-information-in">
                             <?php if ( ! dynamic_sidebar( 'Address' )) : ?>
                               
                     <?php endif; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo get_option('stacy_ga_code'); ?>
  <?php wp_footer(); ?> 
  </body>
  </html>
