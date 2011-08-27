<?php /* Display filter options if on homepage and if they aren't disabled in the theme options  */ ?>
<?php if(is_home() && !get_option('shaken_hide_filters')) { ?>
<div id="filtering-nav">
        <a href="#" class="filter-btn"><span>Filter</span></a>
        <ul>
            <li><a href="#all" class="all">All</a></li>
        <?php
        $args=array(
          'orderby' => 'name'
          );
        $categories=get_categories($args);
          foreach($categories as $category) {  ?>
            <li><a href="#<?php echo $category->category_nicename; ?>" class="<?php echo $category->category_nicename; ?>"><?php echo $category->name; ?></a></li>
         <?php } ?>
         </ul>
         <div class="clearfix"></div>
</div>
<?php } ?>

<?php /* If this is the homepage and the "show all posts on blog" option is checked, then display all posts on one page without pagination  */ 
if(is_home() && get_option('shaken_show_all') && !is_search()) { query_posts('posts_per_page=-1'); } ?>

<?php if (have_posts()) : ?>

<?php /* Display navigation to next/previous pages when applicable  */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older') ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>') ); ?></div>
        <div class="clearfix"></div>
    </div><!-- #nav-below -->
<?php endif; ?>

	<!-- ====================================================================
    							Post Items
    ==================================================================== -->
	<div id="sort">
    	
        <?php if(is_active_sidebar('gallery-sidebar')) { ?>
        	<div class="all box col2">
            <div class="box-content">
        		<?php get_sidebar(); ?>
            </div>
            </div>
        <?php } ?>
        
        <?php /* Display ads set in theme options  */ ?>
        <?php if(is_home() && get_option('shaken_ads_home')) {} else { ?>
			<?php if(get_option('shaken_ad_one_img') || get_option('shaken_ads_custom')){ ?>
                
                <div class="all box <?php echo get_option('shaken_ads_size'); ?>">
                <div class="box-content">
                
                <?php if(get_option('shaken_ad_one_img')) { ?>
                    <a href="<?php echo get_option('shaken_ad_one_link'); ?>">
                        <img src="<?php echo get_option('shaken_ad_one_img'); ?>" alt="" class="loop-ad" />
                    </a>
                <?php } ?>
                    
               	<?php if(get_option('shaken_ad_two_img')) { ?>
                    <a href="<?php echo get_option('shaken_ad_two_link'); ?>">
                        <img src="<?php echo get_option('shaken_ad_two_img'); ?>" alt="" class="loop-ad" />
                    </a>
               	<?php } ?>
                
                <?php if(get_option('shaken_ad_three_img')) { ?>     
                    <a href="<?php echo get_option('shaken_ad_three_link'); ?>">
                        <img src="<?php echo get_option('shaken_ad_three_img'); ?>" alt="" class="loop-ad" />
                    </a>
               	<?php } ?>
                     
                    <?php if(get_option('shaken_ads_custom')){ ?>
                        <div class="custom-ads">
                            <?php echo get_option('shaken_ads_custom'); ?>
                        </div>
                    <?php } ?>
                </div><!-- #box-content -->
                </div><!-- #box -->
                
        <?php } } ?>
        
		<?php while (have_posts()) : the_post(); 
		
			// Is there a video?
			$vid = get_post_meta($post->ID, 'soy_vid', true);
			$hide_vid = get_post_meta($post->ID, 'soy_hide_vid', true);
			
			// Box Size (col1, col2, col3, col4)
			$box_size = get_post_meta($post->ID, 'soy_box_size', true);
			
			if($box_size == 'Medium (485px)'){
				$my_size = 'col3';
			} else if($box_size == 'Large (660px)'){
				$my_size = 'col4';
			} else if($box_size == 'Tiny (135px)'){
				$my_size = 'col1';
			}else{
				$my_size = 'col2';
			}
			
			// Should title be displayed?
			$show_title = get_post_meta($post->ID, 'soy_show_title', true);
			
			// Should post content be displayed?
			$show_desc = get_post_meta($post->ID, 'soy_show_desc', true);
		?>
        
        <div class="all box <?php
			foreach((get_the_category()) as $category) {
			echo $category->category_nicename . ' ';
			}
		?><?php echo $my_size; ?>">
			
            <div class="box-content">
            
				<?php // ================================================
                //						Check for video
                // ======================================================
				
                if($vid && !$hide_vid){ echo $vid; } else { 
				
                // ======================================================
                //				Otherwise check for feat. img
                // ======================================================
				
                if ( has_post_thumbnail() ){ $thumbID = get_post_thumbnail_id($post->ID); ?>
                
                	<div class="img-container">
                        <?php 
						if($my_size != 'col2'){ ?>
                        	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($my_size); ?></a>
                        <?php } else { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php } ?>
                        <div class="actions">
                        	
                           <?php 
						   //	Check if the video is set to be hidden - Display "Play" icon
						   if($vid && $hide_vid){ ?>
                           
						   		<a href="<?php the_permalink(); ?>" title="Play this video" class="view play">Play</a>
                                
						   <?php } 
						   //	Otherwise display the "Enlarge" icon
						   else { ?>
                           
                        	 <a href="<?php echo wp_get_attachment_url($thumbID); ?>" rel="gallery" title="<?php the_title(); ?>" class="view">Enlarge</a>
                             
                           <?php } ?>
                             
                             <a class="share">Share</a>   
                             
                             <?php 
							 // Check if comments are closed
							 if ( ! comments_open() ){ ?>
								 <a href="<?php the_permalink(); ?>" class="comment closed"><span>x</span>Closed</a>
							 <?php } 
							 // Otherwise display comment count
							 else { ?>
                             	<a href="<?php comments_link(); ?>" class="comment"><span><?php comments_number('0', '1', '%'); ?></span> Comment</a> 
                             <?php } ?>
                             
                              <?php // ================================================
						      //					Social Sharing Links
							  // ====================================================== ?>
                             <div class="share-container">
                             	<div class="share-icons">
                                	<?php if(get_option('shaken_tweet_btn_user') && get_option('shaken_tweet_btn_desc')){
										$twitRec = get_option('shaken_tweet_btn_user').':'.get_option('shaken_tweet_btn_desc');
									} 
									else {
                                		$twitRec = 'sawyerh:Best Designer Alive'; 
									} ?>
                                	<a href="javascript: void(0)" class="twitter-share iframe" onClick="twitPop('<?php the_permalink(); ?>', '<?php the_title(); ?> - ', '<?php echo $twitRec; ?>')">
                                    Twitter</a>
                                    
                                    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" class="facebook-share" target="_blank">
                                    Facebook</a>
                                    
                                    <a href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="stumble-share" target="_blank">
                                    StumbleUpon</a>
                                    
                                    <a href="http://technorati.com/cosmos/search.html?url=<?php the_permalink(); ?>" class="tech-share" target="_blank">
                                    Technorati</a>
                                    
                                    <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="digg-share" target="_blank">
                                    Digg</a>
                                    
                                    <a href="http://del.icio.us/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" class="delicious-share" target="_blank">
                                    Delicious</a>
                                    
                                    <a href="mailto:EMAIL?body=<?php the_permalink(); ?>" class="email-share" target="_blank">
                                    Email</a>
                                </div>
                             </div><!-- #share-container -->        
                        </div><!-- #actions --> 
                        <div class="clearfix"></div>
                   	</div><!-- #img-container -->
                <?php } } ?>
                
                <?php // ================================================
                //					Should title be displayed?
                // ======================================================
                
				if($show_title == 'No'){} else { ?>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                <?php } ?>
                
                <?php // ================================================
                //				Should post content be displayed?
                // ====================================================== 
				
				if (is_search() ) : // Only display excerpts for search.
                        if($show_desc == 'No'){} else {  
							the_excerpt(); 
						}
                else :
                        if($show_desc == 'No'){} else {  
                            if(has_excerpt()){ 
                                the_excerpt(); 
                            }
                            else{
                                the_content('Continue Reading &rarr;');
                            }
                        }
                endif; ?>
				
                <?php if(!is_category()&& !get_option('shaken_hide_category_link')){ ?><div class="post-category">Category: <?php the_category(', '); ?></div><?php } ?>
                
                <?php edit_post_link('Edit this post'); ?>
                
         	</div><!-- #box-content -->
        </div><!-- #box -->
        <?php endwhile; ?>
    </div><!-- #sort -->

<?php /* Display navigation to next/previous pages when applicable  */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
        <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older') ); ?></div>
        <div class="nav-next"><?php previous_posts_link( __( 'Newer <span class="meta-nav">&rarr;</span>') ); ?></div>
        <div class="clearfix"></div>
    </div><!-- #nav-below -->
<?php endif; ?>

<?php else : ?>
<?php /* If there are no posts */ ?>
<div id="sort">
    <div class="box">
        <h2>Sorry, no posts were found</h2>
        <?php get_search_form(); ?>
    </div>
</div><!-- #sort -->

<?php endif; ?>
