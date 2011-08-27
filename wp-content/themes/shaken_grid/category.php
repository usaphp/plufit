<?php get_header(); ?>
<div class="wrap">    
    <div id="grid">
	<?php
	/* Run the loop to output the posts.
	* If you want to overload this in a child theme then include a file
	* called loop-category.php and that will be used instead.
	*/
	get_template_part( 'loop', 'category' );
	?>
	</div><!-- #grid -->
</div><!-- #wrap -->
<?php get_footer(); ?>