<?php

get_header();


if ( have_posts() ): ?>
	<?php while ( have_posts() ): the_post(); ?>
		
				<? echo	the_title(); ?>
				<br/>
				<? echo 'this is the top'; ?>
				
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>