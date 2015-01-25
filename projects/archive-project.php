<?php if ( have_posts() ) : ?>

        <div class="center-block">
            <?php floodplain_projects_categories_menu(); ?>
        </div>

        <?php while ( have_posts() ) : the_post(); ?>

            <?php projects_get_template_part( 'content', 'project' ); ?>

        <?php endwhile; // end of the loop. ?>

<?php else : ?>

    <?php projects_get_template( 'loop/no-projects-found.php' ); ?>

<?php endif; ?>
