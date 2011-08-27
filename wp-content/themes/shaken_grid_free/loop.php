<?php /* If there are no posts to display, such as an empty archive page  */ ?>
<?php if (have_posts()) : ?>

<?php /* Display navigation to next/previous pages when applicable  */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older') ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>') ); ?></div>
    </div><!-- #nav-below -->
<?php endif; ?>

	<div id="sort">
	<?php while (have_posts()) : the_post(); ?>
	<div class="box">
    	<?php
		if ( has_post_thumbnail() ){ ?>
			<?php $thumbID = get_post_thumbnail_id($post->ID); ?>
            <a href="<?php echo wp_get_attachment_url($thumbID); ?>" rel="gallery" title="<?php the_title(); ?>">        
                <?php the_post_thumbnail(); ?>
                <span class="view-large"></span>
            </a>
        <?php } ?>
        
        <h2><?php the_title(); ?></h2>
        <?php the_content('<p>Continue Reading &rarr;</p>'); ?>
        <?php edit_post_link('Edit this post'); ?>
    </div>
    <?php endwhile; ?>
    </div><!-- #sort -->

<?php /* Display navigation to next/previous pages when applicable  */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older') ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>') ); ?></div>
    </div><!-- #nav-below -->
<?php endif; ?>

<?php else : ?>
<div id="sort">
<div class="box">
	<h2>Sorry, no posts were found</h2>
    <?php get_search_form(); ?>
</div>
</div><!-- #sort -->
<?php endif; ?>
