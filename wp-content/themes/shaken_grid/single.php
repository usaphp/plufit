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
        
            <strong>Категории</strong>: <?php the_category(', '); ?>
            
            <?php if(has_tag()){ ?>
                <div class="tags"><strong>Метки</strong>: <?php the_tags( '', ', ', ''); ?> </div>
            <?php } ?>
                
            <div class="post-date"><strong>Добавлен</strong>: <?php the_time('F jS, Y') ?></div>
        </div>
        <div class="entry">
			<?php the_content(); ?>

            <?php wp_link_pages(array('before' => '<p><strong>Страницы:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
            
            <?php edit_post_link('<p>Редактировать статью</p>'); ?>
        </div>

        <?php comments_template( '', true ); ?>

	</div><!-- #page -->
    <?php endwhile; endif; ?>
    
    <?php get_sidebar(); ?>
</div><!-- #wrap -->
<?php get_footer(); ?>