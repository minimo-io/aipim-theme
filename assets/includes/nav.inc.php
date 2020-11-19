<?php
$not_count = bp_notifications_get_unread_notification_count(get_current_user_id());
$blog_name = get_bloginfo("name");
$login_url = wp_login_url( aipim_current_page() );
if (is_404()) $login_url = site_url( 'wp-login.php', 'login' );
?>
<nav id="nav-header" class="navbar navbar-expand-lg bg-white navbar-light fixed-top">
    <div class="container">
      <a href="<?php echo get_bloginfo("url");  ?>" class="navbar-brand zoom">
        <img src="<?php echo get_template_directory_uri()."/assets/images/betizen-logo.png";  ?>" alt="<?php echo $blog_name; ?>" title="<?php echo $blog_name; ?>" />
      </a>

      <div class="d-flex ml-auto">
          <ul class="navbar-nav d-lg-none">
              <?php if ( is_user_logged_in() ) {  ?>
              <li class="nav-item mr-2">
                <a class="nav-notifications-box" href="<?php echo bp_core_get_userlink( get_current_user_id(), false, true );  ?>notifications/">
                  <i class="fa fa-bell"></i>
                  <?php
                  if ($not_count > 0) echo '<span class="nav-notifications">'.$not_count.'</span>';
                  ?>
                </a>
              </li>
            <?php }else{ ?>
              <li class="nav-item mr-2">
                <a class="button button-brand btn-sm button-join-small" href="<?php echo wp_registration_url(); ?>"><?php _e("Join", "aipim"); ?></a>
              </li>
            <?php } ?>
          </ul>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#globalNavbar" aria-controls="globalNavbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      </div>


      <div class="collapse navbar-collapse" id="globalNavbar">
            <form class="form-inline form-navbar my-2 my-lg-0 order-2" method="GET" action="<?php echo aipim_search_url();  ?>">
                <input class="form-control" name="s" type="text" placeholder="<?php _e("Search", "aipim");  ?>" value="<?php echo get_search_query();  ?>" />
            </form>
            <div id="term-id-activity-mobile" class="nav-item d-lg-none"><?php aipim_language_selector_html(true); ?></div>
            <ul class="navbar-nav navbar-main ml-auto order-1">
            <?php
            $categories = get_categories( array(
                'orderby' => 'name',
                'order'   => 'ASC',
                'hide_empty' => 0,
                'hierarchical' => 1,
                'parent' => 0
            ) );
            $a_categories = Array();

            foreach ($categories as $category){

                if ($category->parent == 0 && $category->term_id != 1){


                    if (get_field("oculto", $category) == 0){


                        $category_url = get_category_link( $category->term_id );
                        $term_children = get_term_children( $category->term_id, "category" );




                        if (!empty($term_children) && get_field("no_subcast_en_menu", $category) != 1 ){
                            $str_cat = '<li id="term-id-'.$category->term_id.'" class="nav-item nav-item-lg nav-item-spread dropdown d-none d-lg-block">';
                            $str_cat .= '<a class="nav-link dropdown-toggle" href="'.$category_url.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$category->name.'</a>';
                            $str_cat .= '<div class="dropdown-menu">';
                            $str_cat .= '<div class="navbar-collapse navbar-top-collapse">';
                            $str_cat .= '<ul id="menu-top-menu" class="nav navbar-nav">';

                            $subcategories = get_categories( array(
                                'orderby' => 'name',
                                'order'   => 'DESC',
                                'hide_empty' => 1,
                                'hierarchical' => 1,
                                'parent' => $category->term_id
                            ) );
                            foreach ($subcategories as $subcategory){
                                $subcategory_url = get_category_link( $subcategory->term_id );
                                $str_cat .= '<li id="term-id-'.$subcategory->term_id.'" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-601"><a title="" href="'.$subcategory_url.'">'.$subcategory->name.'</a></li>';
                            }
                            $str_cat .= "</ul></div></div></li>";
                            $a_categories[] = $str_cat;

                            // mobile one
                            $str_cat = '<li id="term-id-'.$category->term_id.'-mobile" class="nav-item nav-item-mobile Xnav-item-spread dropdown d-lg-none mb-3">';
                            $str_cat .= '<a class="btn btn-lg mt-1 mb-1 btn-knowledge btn-knowledge btn-round btn-md-block mt-sm-1 dropdown-toggle" href="'.$category_url.'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$category->name.'</a>';
                            $str_cat .= '<div class="dropdown-menu">';
                            $str_cat .= '<div class="navbar-collapse navbar-top-collapse">';
                            $str_cat .= '<ul id="menu-top-menu" class="nav navbar-nav">';

                            $subcategories = get_categories( array(
                                'orderby' => 'name',
                                'order'   => 'DESC',
                                'hide_empty' => 1,
                                'hierarchical' => 1,
                                'parent' => $category->term_id
                            ) );
                            foreach ($subcategories as $subcategory){
                                $subcategory_url = get_category_link( $subcategory->term_id );
                                $str_cat .= '<li id="term-id-'.$subcategory->term_id.'" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-601"><a title="" href="'.$subcategory_url.'">'.$subcategory->name.'</a></li>';
                            }
                            $str_cat .= "</ul></div></div></li>";


                            $a_categories[] = $str_cat;
                        }else{
                            $bonus_count = aipim_wpml_count_posts("bonus");
                            $bonus_count = $bonus_count["publish"][ICL_LANGUAGE_CODE];

                            $a_categories[] = '<li id="term-id-'.$category->term_id.'" class="nav-item nav-item-spread nav-item-lg d-none d-lg-block"><a class="nav-link" href="'.$category_url.'">'.$category->name.(get_field("show_count", $category) ? '<sup><span class="badge badge-bonus badge-pill badge-danger">'.$bonus_count.'</span></sup>' : "").'</a></li>';
                            // $a_categories[] = '<li id="term-id-'.$category->term_id.'-mobile" class="nav-item nav-item-mobile Xnav-item-spread d-lg-none"><a class="mt-3 button button-brand btn-outline btn-sm button-join-small btn-block" href="'.$category_url.'">'.$category->name.'</a></li>';
                            $a_categories[] = '<li id="term-id-'.$category->term_id.'-mobile" class="nav-item nav-item-mobile Xnav-item-spread d-lg-none"><a class="mt-1 btn btn-lg mb-1 btn-knowledge btn-knowledge-purple btn-round btn-md-block mt-sm-1" href="'.$category_url.'">'.$category->name.'</a></li>';
                        }
                    }



                }


            }
            foreach ($a_categories as $cat){
                echo $cat;
            }


            ?>

                <li id="term-id-activity" class="nav-item nav-item-spread nav-item-lg d-none d-lg-block dropdown" style="padding-right:30px;">
                  <?php aipim_language_selector_html(); ?>
                </li>

                <li class="d-lg-none nav-item nav-item-lg">

                </li>

                <?php if ( is_user_logged_in() ) {  ?>
                  <li class="d-lg-none nav-item"><a class="btn-mobile-normal mt-3 button button-brand btn-outline btn-sm button-join-small btn-block" href="<?php echo bp_core_get_userlink( get_current_user_id(), false, true ); ?>"><?php _e("Profile", "aipim");  ?></a></li>
                  <li class="d-lg-none"><a class="btn-mobile-normal mt-3 button button-brand btn-outline btn-sm button-join-small btn-block mb-3" href="<?php echo wp_logout_url( aipim_current_page() ); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;<?php _e("Exit", "aipim");  ?></a></li>
                <?php }else{
                  echo '<li class="d-lg-none nav-item"><a class="btn-mobile-normal mt-3 mb-3 button button-brand btn-outline btn-sm button-join-small btn-block" href="'.$login_url.'"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;'.__("Sign in", "aipim").'</a></li>';
                } ?>

            </ul>


            <?php if ( !is_user_logged_in() ) {  ?>
                <ul class="navbar-nav d-none d-lg-flex ml-2 order-3">
                  <li class="nav-item">
                    <a class="button button-brand btn-lg mb-5 mb-lg-2 btn-round mt-2" href="<?php echo wp_registration_url(); ?>"><?php _e("Sign up", "aipim");  ?></a>
                  </li>
                    <li class="nav-item margin-secondary-btn">
                      <a class="button btn-outline btn-lg mb-5 mb-lg-2 btn-round mt-2" href="<?php echo $login_url; ?>"><?php _e("Sign in", "aipim");  ?></a>
                    </li>
                </ul>
            <?php }  ?>
            <?php if ( is_user_logged_in() ) {  ?>
                <ul class="navbar-nav d-none d-lg-flex ml-2 order-3">
                    <li class="nav-item mr-3">
                      <a class="nav-notifications-box" href="<?php echo bp_core_get_userlink( get_current_user_id(), false, true );  ?>notifications/">
                        <i class="fa fa-bell"></i>
                        <?php
                        if ($not_count > 0) echo '<span class="nav-notifications">'.$not_count.'</span>';
                        ?>
                      </a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link nav-link--user dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <div class="nav-link--user__initials">
                                <?php echo build_screen_username($current_user->display_name);  ?>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarCustomerDropdownMenuLink">
                            <?php wp_nav_menu( array(
                                'theme_location' => 'buddypress-menu',
                                'container' => ''
                            ) ); ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo wp_logout_url( aipim_current_page() ); ?>"><?php _e("Exit", "aipim");  ?></a>
                        </div>
                    </li>

                </ul>
            <?php }  ?>

        </div>
    </div>
</nav>


<div class="cookiePolicy d-none">
  <div class="cookieDescription">
    We use cookies to improve your site experience, by continuing to use this website you accept such use as outlined in our <a class="cookiePrivacy" href="#">cookie policy</a>.
  </div>
  <div>
    <button class="MuiButtonBase-root MuiButton-root muiButtonBase MuiButton-contained cookieAction MuiButton-containedSecondary muiButtonContainedSecondary" tabindex="0" type="button"><span class="MuiButton-label">Accept</span><span class="MuiTouchRipple-root"></span></button>
  </div>
</div>
