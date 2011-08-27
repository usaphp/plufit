<?php get_header(); ?>

<div class="wrap">    
    <div id="page">
    	<div class="wide-col">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
            
            	<h2><?php the_title(); ?></h2>
                <?php the_content(); ?>
                <?php edit_post_link('Edit this post'); ?>
            <?php endwhile; endif; ?>
        </div>
        
        <?php get_sidebar(); ?>
	</div><!-- #page -->
</div><!-- #wrap -->
<?php get_footer(); ?>