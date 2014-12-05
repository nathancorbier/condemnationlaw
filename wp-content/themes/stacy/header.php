<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title>
<?php //wp_title(''); ?>
<?php if ( is_tag() ) {
			echo 'Tag Archive for &quot;'.$tag.'&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() ) {
			bloginfo( 'name' ); 
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} else {
			echo wp_title( ' | ', false, right ); bloginfo( 'name' );
		} ?>
</title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />
<?php
		wp_head();
	?>
<?php $computer_custom_css = get_option('computer_custom_css'); ?>
<?php if($computer_custom_css){?>
<style type="text/css">
<?php echo get_option('computer_custom_css');
?>
</style>
<?php }?>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('.accordian_menu_head').click(function() {
$('.accordian_menu_head').removeClass('on');
$('.accordian_menu_content').slideUp('normal');
if($(this).next().is(':hidden') == true) {
$(this).addClass('on');
$(this).next().slideDown('normal');
}
});
$('.accordian_menu_head').mouseover(function() {
$(this).addClass('over');
}).mouseout(function() {
$(this).removeClass('over');
});
$('.accordian_menu_content').hide();
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1974273-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<div class="col-xs-12 black-bg">
  <div class="container">
    <div class="row">
      <?php wp_nav_menu( array(
	  'container'       => 'ul', 
	  'menu_class'      => 'sitemap', 
	  'menu_id'         => '',
	  'depth'           => 0,
	  'theme_location' => 'top_header_menu'
	   )); ?>
    </div>
  </div>
</div>
<div class="col-xs-12 header-bg">
  <div class="container">
    <div class="row">
      <div class="header-up">
        <div class="header-in-up clearfix">
          <div class="col-sm-4">
            <div class="logo"> <a href="<?php bloginfo("home"); ?>"><img src="<?php echo get_option('stacy_logo'); ?>" class="img-responsive no-block" alt="logo"></a> </div>
          </div>
          <div class="col-sm-8">
            <div class="free">
              <?php if ( ! dynamic_sidebar( 'Free Consultaton')) : ?>
              <?php endif; ?>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="header-in-shadow"> 
          
          <!--<img src="<?php echo get_bloginfo('template_url');?>/img/head-up-bg2.png" class="img-responsive no-block" alt="head-up-bg2" style="display: initial;" >--> 
          
        </div>
      </div>
      <div class="header-down">
        <div class="navbar navibar">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="icon-bar lines"></span> <span class="icon-bar lines"></span> <span class="icon-bar lines"></span> </button>
              <a class="navbar-brand home" href="#">Menu</a> </div>
            <div class="collapse navbar-collapse">
              <?php 
			   wp_nav_menu( array(
			   'container'       => 'ul', 
			   'menu_class'      => 'nav navbar-nav', 
			   'menu_id'         => 'navi',
			   'depth'           => 0,
			   'theme_location' => 'header_menu',
			   'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
			   'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
			    'walker'         => new wp_bootstrap_navwalker()
				 )); 
				 ?>
            </div>
            <!--/.nav-collapse --> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
