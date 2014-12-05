
 <!------ Header Open ---------->
    <div class="col-xs-12 header-bg">
        <div class="container">
            <div class="row">
                <div class="header-up">
                    <div class="header-in-up">
                        <div class="col-sm-4">
                            <div class="logo">
                                <a href="index.html"><img src="<?php echo get_option('stacy_logo'); ?>" class="img-responsive no-block" alt="logo"></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="free">
                                <p>Representing property owners nationwide </p>
                                <h2>Free consultation </h2>
                                <h3>No fee unless we win*</h3>
                                <ul class="no">
                                    <li><a href="#"><?php echo get_option('stacy_callnow');?></a></li>
                                    <li><a href="#"><img src="<?php echo get_bloginfo('template_url');?>/img/mess.png" alt="mess"></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="header-in-shadow">
                        <img src="<?php echo get_bloginfo('template_url');?>/img/head-up-bg2.png" class="img-responsive no-block" alt="head-up-bg2">
                    </div>
                </div>
                <div class="header-down">
                    <div class="navbar navibar">
                      <div class="container">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar lines"></span>
                            <span class="icon-bar lines"></span>
                            <span class="icon-bar lines"></span>
                          </button>
                       </div>
                        <div class="collapse navbar-collapse">
                          <?php 
                            wp_nav_menu( array(
                                      'container'       => 'ul', 
                                      'menu_class'      => 'nav navbar-nav', 
                                      'menu_id'         => 'navi',
                                      'depth'           => 0,
                                      'theme_location' => 'header_menu'
                                  )); 
                            ?>  
                        </div><!--/.nav-collapse -->
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------ Header Close ---------->
    <div class="clearfix"></div>