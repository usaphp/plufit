<?php get_header(); ?>
<div class="wrap">    
    <div id="grid">
    
    <?php if ( have_posts() ) : ?>
    
	<?php
	/* Run the loop to output the posts.
	* If you want to overload this in a child theme then include a file
	* called loop-index.php and that will be used instead.
	*/
	get_template_part( 'loop', 'search' );
	?>
    
    <?php else : ?>
    	
        <div class="box">
        	<div class="box-content">
            	<h2>Sorry, nothing was found for your search</h2>
                <p>Maybe try searching for something different.</p>
                <?php get_search_form(); ?>
            </div>
        </div>
        
    <?php endif; ?>
	</div><!-- #grid -->
</div><!-- #wrap -->
<?php get_footer(); ?>