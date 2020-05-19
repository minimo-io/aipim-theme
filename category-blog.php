<?php
get_header();
?>
<body class="product-template-default single single-product postid-1745 woocommerce woocommerce-page dokan-theme-dokan">
    <main id="main" class="site-main main">
        <?php require_once(get_template_directory()."/assets/includes/nav.inc.php");  ?>


        <section class="hero hero--xs w-100 pt-0" style="margin-bottom: 3%;">
          <div class="container">
            <h1 class="display-2 text-bold" style="margin-top: 5%;">Blog<span class="text-purple">.</span></h1>
            <h4 class="text-gray-soft text-regular col-lg-8 col-md-10 mx-auto">
              <?php echo category_description( ); ?>
            </h4>
            <?php

            $args = array(
                 'hierarchical' => 1,
                 'show_option_none' => '',
                 'hide_empty' => 0,
                 'parent' => get_cat_ID('Blog'),
                 'taxonomy' => 'category'
              );
            $subcats = get_categories($args);

              foreach ($subcats as $sc) {
                $link = get_term_link( $sc->slug, $sc->taxonomy );
                echo '<a href="'.$link.'" class="btn btn-light btn-lg btn-sm mr-1 mt-1 text-uppercase sm-btn-block" role="button" aria-pressed="true">
                        <i class="fa fa-tag mr-1" aria-hidden="true"></i>'.$sc->name.'
                        <span class="badge badge-secondary">'.$sc->category_count.'</span>
                      </a>';
              }

            ?>
          </div>
        </section>

        <section class="section">


            <div class="container">
                <div class="row d-none d-lg-block">
                    <div class="col-lg-8 col-md-10 mx-auto text-right blog-list-view-selector">
                      <div class="btn-group" role="group" aria-label="<?php _e("Visualization type", "aipim"); ?>">
    									  <button type="button" class="btn btn-light btn-galleryview active" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e("Gallery view", "aipim"); ?>"><i class="fa fa-th" aria-hidden="true"></i></button>
    									  <button type="button" class="btn btn-light btn-listview" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e("List view", "aipim"); ?>"><i class="fa fa-th-list" aria-hidden="true"></i></button>
    									</div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto blog-cards card-deck blog-card-grid">
                        <?php


                        while (have_posts()) : the_post(); ?>
                          <?php
                          $post_image = get_the_post_thumbnail_url(get_the_ID(), 'am-1200');
                          $post_color = get_field("post_color");
                          if (!empty($post_color)){
                            $post_color = "background:linear-gradient(to bottom left,transparent 20%, ".$post_color." 100%);";
                          } else{
                            $post_color = "background-image:url(".$post_image.");backdrop-filter: blur(5px);";
                          }
                          ?>
                            <div class="card blog-card mt-4 p-2" style="<?php echo $post_color; ?>">
                              <div class="card-body">
                                <div class="post-preview">
                                    <a class="post-preview-link" href="<?php echo esc_url( get_permalink() ); ?>">
                                      <h2 class="catalog-blog-title post-title hero-h1 bd-text-purple-bright display-4">
                                        <?php the_title();  ?>
                                      </h2>
                                      <?php
                                      // if ($post_image) echo '<img src="'.$post_image.'" class="figure-img img-fluid rounded" alt="post-image">';
                                      ?>
                                      <h3 class="post-subtitle">
                                        <?php the_excerpt();  ?>
                                      </h3>
                                    </a>
                                    <p class="post-meta">
                                      <?php
                                      $categories = get_the_category();

                                      if ( ! empty( $categories ) ) {
                                        echo '<span class="badge badge-primary">'.esc_html( $categories[0]->name ).'</span>';
                                      }
                                      ?>
                                      <small>
                                        <a href="#"> <time datetime="<?php echo get_the_time("c");  ?>"><?php the_date();  ?></time>
                                      </small>
                                    </p>
                                </div>
                              </div>
                            </div>


                        <?php
                        endwhile;
                        ?>

                        <nav class="blog-pagination">
                            <?php previous_posts_link('&laquo;  '.__("Previous", "aipim") ); ?>
                            <?php next_posts_link( __("Next", "aipim").' &raquo;', '' ); ?>
                        </nav>

                    </div><!-- /.blog-main -->

                </div><!-- /.row -->

            </div>
        </section>

    </main>

</body>
<?php get_footer();  ?>
</html>
