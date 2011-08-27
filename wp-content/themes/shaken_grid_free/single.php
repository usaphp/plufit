<?php get_header(); ?>

<div class="wrap">    
    <div id="page">
    	<div class="wide-col">
        	<?php if(have_posts()) : while(have_posts()) : the_post() ?>
            	<h2><?php the_title(); ?></h2>
                <?php
				if ( has_post_thumbnail() ){ ?>
					<?php $thumbID = get_post_thumbnail_id($post->ID); ?>
					<a href="<?php echo wp_get_attachment_url($thumbID); ?>" rel="gallery" title="<?php the_title(); ?>" class="alignleft">        
						<?php the_post_thumbnail(); ?>
						<span class="view-large"></span>
					</a>
				<?php } ?>
                <?php the_content(); ?>
                <br class="clearfix" />
                <p><?php the_category(', '); ?>
                
            <?php endwhile; endif; ?>
        </div>
        
        <?php get_sidebar(); ?>
	</div><!-- #page -->
</div><!-- #wrap -->
<?php get_footer(); ?>