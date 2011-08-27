<?php get_header(); ?>

<div class="wrap">
<?php if(have_posts()) : while(have_posts()) : the_post(); 
	  $vid = get_post_meta($post->ID, 'soy_vid', true);
	  $vid_wide = get_post_meta($post->ID, 'soy_vid_wide', true);
?>  
    <div id="page" class="post">
		<?php // ================================================
        //						Check for video
        // ======================================================
		if($vid_wide){ 
			echo '<div class="content"><div class="box-content">';
			echo $vid_wide; 
			echo '</div></div>';
        } else if($vid){ 
			echo '<div class="content"><div class="box-content">';
			echo $vid; 
			echo '</div></div>';
        } else { 
        // ======================================================
        //				Otherwise check for feat. img
        // ======================================================
        if ( has_post_thumbnail() ){ 
            echo '<div class="content"><div class="box-content">';
            the_post_thumbnail('col4');
            echo '</div></div>';
        } } ?>
        
        <h1 class="post-title"><?php the_title(); ?></h1>
        
        <div class="postmetadata">
        
            <strong>Category</strong>: <?php the_category(', '); ?>
            
            <?php if(has_tag()){ ?>
                <div class="tags"><strong>Tags</strong>: <?php the_tags( '', ', ', ''); ?> </div>
            <?php } ?>
                
            <div class="post-date"><strong>Posted on</strong>: <?php the_time('F jS, Y') ?>
			<?php if(!get_option('shaken_hide_author')){ ?> by 
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="View all posts by <?php echo get_the_author(); ?>" id="author-link">
				<?php echo get_the_author(); ?>
           </a><?php } ?></div>
        </div>
        
        <div class="entry">
			<?php the_content(); ?>
            
            <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            
            <?php edit_post_link('<p>Edit This Post</p>'); ?>
        </div>
        
        <?php comments_template( '', true ); ?>

	</div><!-- #page -->
    <?php endwhile; endif; ?>
    
    <?php get_sidebar(); ?>
</div><!-- #wrap -->
<?php get_footer(); ?>