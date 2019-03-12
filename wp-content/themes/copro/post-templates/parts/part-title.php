<h1 class="entry-title"><?php 
if( is_sticky() && !is_singular() ) :
	echo '<span class="sticky-post-holder"><span class="inner-sticky-txt">' . __("Featured", 'ivan_domain') .'</span><i class="fa fa-bolt"></i></span>';
endif;
?><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>