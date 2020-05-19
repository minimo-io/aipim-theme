<?php get_header(); ?>

        <section class="section">
            <div class="container">

                <nav aria-label="breadcrumb" itemprop="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo site_url();  ?>"><strong><?php _e("Home", "aipim");  ?></strong></a>></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php single_cat_title();  ?></li>
                    </ol>
                </nav>

                <div class="theme-cards-holder" style="border-bottom:0;">
                    <div class="theme-cards__heading">
                        <div>
                            <h5 class="theme-cards__title"><?php echo single_cat_title();  ?></h5>
                            <p class="text-gray-soft"><?php echo strip_tags(category_description(), "<br><a>") ?></p>
                        </div>
                        <!-- <a class="theme-cards__heading__button btn btn-outline-brand btn-sm" href="#">Ver todos</a>-->
                    </div>
                    <ul class="row">
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                            <?php $image = wp_get_attachment_image_src(get_field('imagen_del_juego'), 'full'); ?>

                            <li class="col-md-4">
                                <div class="theme-card">
                                    <div class="theme-card__body">
                                        <a class="d-block" href="<?php echo esc_url( get_permalink() ); ?>">
                                            <img width="400"
                                                 height="300"
                                                 src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-400'); ?>"
                                                 class="theme-card__img wp-post-image"
                                                 alt=""
                                                 srcset="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-400'); ?> 400w,
                                                         <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-300'); ?> 300w,
                                                         <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-768'); ?> 768w,
                                                         <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1024'); ?> 1024w,
                                                         <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-200'); ?> 200w,
                                                         <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-600'); ?> 600w,
                                                         <?php echo get_the_post_thumbnail_url(get_the_ID(), 'am-1200'); ?> 1200w"
                                                 sizes="(max-width: 400px) 100vw, 400px" />

                                        </a>

                                        <a class="theme-card__body__overlay btn btn-brand btn-sm" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e("Play for free", "aipim");  ?></a>
                                    </div>
                                    <div class="theme-card__footer">
                                        <div class="theme-card__footer__item"><a class="theme-card__title mr-1" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo get_the_title();  ?></a>
                                            <p class="theme-card__info">
                                                <ul class="prod_cats_list">
                                                    <li>
                                                        <?php
                                                        $a_provider = get_the_terms(get_the_ID(), "proveedores");

                                                        $provider = Array("name" => "", "url" => "");
                                                        if (isset($a_provider[0])){
                                                            $provider["name"] = $a_provider[0]->name;
                                                            $provider["url"] = get_term_link($a_provider[0]->term_id);
                                                        }
                                                        ?>
                                                        <a href="<?php echo $provider["url"]; ?>"><?php echo $provider["name"]; ?></a>
                                                    </li>
                                                </ul>
                                            </p>
                                        </div>
                                        <div class="theme-card__footer__item">
                                            <p class="theme-card__price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>#<?php echo get_field("ranking");  ?></span></p>
                                            <?php
                                            /*
                                            echo gdrts_posts_render_rating(Array(
                                                'id' => $game->ID,
                                                'method' => 'stars-rating'
                                            ), Array(
                                                'template' => 'aipim',
                                                'style_size' => 20
                                            ));
                                            */

                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        <?php endwhile; else : ?>


 	                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'aipim' ); ?></p>


 	                <!-- REALLY stop The Loop. -->
                        <?php endif; ?>

                    </ul>
                </div>


            </div>
        </section>
