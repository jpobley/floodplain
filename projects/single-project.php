<?php while ( have_posts() ) : the_post(); ?>

    <?php projects_get_template_part( 'content', 'single-project' ); ?>

<?php endwhile; // end of the loop. ?>
