<?php /*
Template Name: Archives
*/ 
get_header(); ?>

<div class="wrap" id="archives-page">    
    <div id="grid">

		<div id="sort">
        
        	<div class="box col2">
                <div class="box-content">
                    <h2>Recent Posts</h2>
                    <ul class="recent-posts">
                    
                    <?php 
					  $recentPostsQuery = new WP_Query('posts_per_page=5');
					  if ( $recentPostsQuery->have_posts() ) : while ( $recentPostsQuery->have_posts() ) : $recentPostsQuery->the_post(); ?>
                    <li class="cat-post-item">
                
                        <div class="post-thumb">
                        <?php
                            if (
                                function_exists('the_post_thumbnail') &&
                                current_theme_supports("post-thumbnails") &&
                                has_post_thumbnail()
                            ) :
                        ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('sidebar'); ?></a>
                        <?php endif; ?>
                        </div>
                        
                        
                        <div class="post-info">
                            <h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
                            <p>
                            	Posted on <?php the_time('F jS, Y') ?><br />
                            	Category: <?php the_category(', '); ?>
                                <?php if(has_tag()){ ?>
                                    <br />Tags: <?php the_tags( '', ', ', ''); ?>
                                <?php } ?>
                            </p>
                        </div>
                        
                        <div class="clearfix"></div>
                    </li>
                    <?php endwhile; endif; ?>
                    
                    </ul>
            	</div>
            </div><!-- #recent-posts -->
        	
            <div class="box col2">
            <div class="box-content">
            	<h2>Categories</h2>
                <ul>											  
                    <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                </ul>
            </div>
            </div>
            
            <div class="box col2">
            <div class="box-content">
            	<h2>Monthly Archives</h2>
                <ul>											  
                    <?php wp_get_archives('type=monthly&show_post_count=1') ?>
                </ul>
            </div>
            </div><!-- #Monthly Archives -->
            
            <div class="box col2">
            <div class="box-content">
            	<h2>Most Popular Posts</h2>
                <ul>
					<?php $popularPostsQuery = new WP_Query('orderby=comment_count&posts_per_page=10');
                    if ( $popularPostsQuery->have_posts() ) : while ( $popularPostsQuery->have_posts() ) : $popularPostsQuery->the_post(); ?>
                    
                        <li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; endif; ?>		
              </ul>
            </div>
            </div><!-- #Most Popular Posts -->
            
        </div>

	</div><!-- #grid -->
</div><!-- #wrap -->
<?php get_footer(); ?>