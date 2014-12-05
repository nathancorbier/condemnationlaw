<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */



include_once (TEMPLATEPATH . '/includes/widgets/custom-menu-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/custom-socials-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-resource-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-recentblog-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-testimonial-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-editor-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-testimonial.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-news-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-projects-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-case-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-articles-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-newsfeed-widget.php');

add_action("widgets_init", "load_my_widgets");

function load_my_widgets() {

    register_widget("MY_CustomMenu");
    register_widget("MY_CustomSocials");
    register_widget("MY_Resource");
    register_widget("MY_RecentBlog");
    register_widget("MY_MiddleBox");
    register_widget("MY_EditorWidget");
    register_widget("MY_Testimonial");
    register_widget("MY_News");
    register_widget("MY_Projects");
    register_widget("MY_ThreeBoxes");
    register_widget("MY_Articles");
    register_widget("MY_NewsFeed");
}
?>