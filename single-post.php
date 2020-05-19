<?php get_header();  ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
            <style>
            .figure {
              border-bottom: 1px solid #d1d1d1;
              padding-bottom:15px;
              margin-bottom:35px;
            }
            </style>
            <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>
            <main id="main" class="site-main main">
                <section class="section">
                    <div class="container">

                            <h1 id="blog-post-title" class="post-title hero-h1 bd-text-purple-bright display-4 mt-4">
                              <?php echo get_the_title();  ?>
                            </h1>
                            <p class="c-entry-summary p-dek">
                              <?php echo strip_tags(get_the_excerpt()); ?>
                            </p>
                            <p class="blog-post-meta">
                              <div class="c-byline">
                                  <?php _e("By", "aipim"); ?>
                                  <span class="c-byline__item">
                                      <?php echo bp_core_get_userlink( get_the_author_meta('ID')) ?>

                                  </span>
                                  <span class="c-byline__item">
                                    <time class="c-byline__item" data-ui="timestamp" datetime="<?php echo get_the_time("c");  ?>">
                                      <?php the_date();  ?>
                                    </time>
                                  </span>
                              </div>
                            </p>
                            <p class="c-share">
                              <a class="c-share-item c-share-facebook" target="_blank" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?text=<?php echo esc_html(get_the_title()); ?>&amp;u=<?php echo urlencode(get_the_permalink()); ?>" data-analytics-social="facebook"></a>
                              <a class="c-share-item c-share-twitter ml-1" target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet?text=<?php echo esc_html(get_the_title()); ?>&amp;url=<?php echo urlencode(get_the_permalink()); ?>" data-analytics-social="twitter"></a>
                            </p>
                            <span class="clearfix"></span>
                            <div class="row">
                                <div class="col-lg mb-md-0 mb-3">
                                    <div class="post-<?php the_ID(); ?>">

                                        <div class="post-content">
                                            <?php
                                            $thumbnail_id    = get_post_thumbnail_id(get_the_ID());
                                            if ($thumbnail_id){
                                                $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

                                                if ($thumbnail_image && isset($thumbnail_image[0])) {
                                                ?>
                                                  <style>.post-content{ margin-top:2%; }</style>
                                                  <figure class="figure">
                                                    <?php
                                                      echo '<img src="'.$thumbnail_image[0]->guid.'" class="figure-img img-fluid rounded" alt="post-image">';
                                                      echo '<figcaption class="figure-caption text-right">'.$thumbnail_image[0]->post_excerpt.'</figcaption>';
                                                    ?>
                                                  </figure>
                                                <?php
                                                }
                                              }
                                             ?>
                                            <?php

                                            the_content();

                                            if ( comments_open(get_the_ID()) || get_comments_number(get_the_ID()) ){
                                                comments_template();
                                            }

                                            ?>
                                        </div>


                                    </div>
                                </div>


                            </div>



                    </div>
                    </div>
                </section>
            </main>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer();  ?>

  </body>
</html>
