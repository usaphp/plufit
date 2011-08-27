<?php 
function new_excerpt_length($length) {
	return 18;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($post) {
	return ' &hellip; <a href="'. get_permalink($post->ID) . '">' . 'Read more' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
?>