<?php 
/* 
Template Name: Unique Sidebar
*/
get_header(); ?>

<div class="wrap">    
    <div id="page">
        <div class="page-content post">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
			<?php 	
                if ( has_post_thumbnail() ){ 
                echo '<div class="page-feat-img">';
                the_post_thumbnail('col4');
                echo '</div>';
            } ?>
            
            <div class="page-entry">
            	<h1 class="page-title"><?php the_title(); ?></h1>
                
				<?php the_content(); ?>
                
                <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                <?php edit_post_link('Edit this post'); ?>
            </div><!-- #page-entry -->
                
            <?php endwhile; endif; ?>
        </div>
        
        <?php comments_template( '', true ); ?>
        
	</div><!-- #page -->
    
    <?php get_sidebar(); ?>
    
</div><!-- #wrap -->
<?php get_footer(); ?>