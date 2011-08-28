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
	    <div class="ad_block_article">
		    <script type="text/javascript"><!--
			google_ad_client = "ca-pub-2966198355915984";
			/* plufit article inside */
			google_ad_slot = "0680599322";
			google_ad_width = 468;
			google_ad_height = 60;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
	    </div>
        <div class="entry">
			<?php the_content(); ?>

        	<div class="share-icons article_share_ins">
		        <?php if(get_option('shaken_tweet_btn_user') && get_option('shaken_tweet_btn_desc')){
					$twitRec = get_option('shaken_tweet_btn_user').':'.get_option('shaken_tweet_btn_desc');
				}
				else {
					$twitRec = 'Кулинарные рецепты';
				} ?>
				<a href="javascript: void(0)" class="twitter-share iframe" onClick="twitPop('<?php the_permalink(); ?>', '<?php the_title(); ?> - ', '<?php echo $twitRec; ?>')">Twitter</a>
                <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" class="facebook-share" target="_blank">Facebook</a>
                <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="stumble-share" target="_blank">StumbleUpon</a>
                <a href="http://technorati.com/cosmos/search.html?url=<?php the_permalink(); ?>" class="tech-share" target="_blank">Technorati</a>
                <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="digg-share" target="_blank">Digg</a>
                <a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="delicious-share" target="_blank">Delicious</a>
                <a href="mailto:EMAIL?body=<?php the_permalink(); ?>" class="email-share" target="_blank">Email</a>
          	</div>

            <?php wp_link_pages(array('before' => '<p><strong>Страницы:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

            <?php edit_post_link('<p>Редактировать статью</p>'); ?>
        </div>

        <?php comments_template( '', true ); ?>

	</div><!-- #page -->
    <?php endwhile; endif; ?>
    
    <?php get_sidebar(); ?>
</div><!-- #wrap -->
<?php get_footer(); ?>