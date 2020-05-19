<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php
    echo the_content();
    ?>


<?php endwhile; else : ?>


<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>


<!-- REALLY stop The Loop. -->
<?php endif; ?>
