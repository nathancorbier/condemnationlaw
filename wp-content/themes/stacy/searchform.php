<form method="get" id="searchform" action="<?php bloginfo('home'); ?>">
    <div class="search-in">
        <h3><?php _e("Search","stacy") ?></h3>
        <div class="input-group">
            <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" class="form-control" placeholder="Name">
            <span class="input-group-btn search-input">
                <button class="btn btn-default go" type="submit"><?php _e("Go","stacy");?></button>
            </span>
        </div>
     </div>    
</form>