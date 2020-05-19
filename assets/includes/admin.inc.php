<?php

// theme admin panel


function am_register_settings() {
    //register our settings
    register_setting( 'am_options', 'am_home_title' );
    register_setting( 'am_options', 'am_home_slogan' );
    register_setting( 'am_options', 'am_home_button' );
    register_setting( 'am_options', 'am_home_button_link' );

    register_setting( 'am_options', 'am_guide_quick' );
    register_setting( 'am_options', 'am_guide_big' ); 

}
function am_options_page_html(){
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "wporg_options"
            settings_fields('am_options');
            // output setting sections and their fields
            // (sections are registered for "wporg", each field is registered to a specific section)
            do_settings_sections('aipim');


            $home_title = esc_attr( get_option('am_home_title') );
            $home_slogan = esc_attr( get_option('am_home_slogan') );
            $home_button = esc_attr( get_option('am_home_button') );
            $home_button_link = esc_attr( get_option('am_home_button_link') );

            $am_guide_quick = esc_attr( get_option('am_guide_quick') );
            $am_guide_big = esc_attr( get_option('am_guide_big') );


            if (empty($home_title)) $home_title = 'La comunidad confiable <br> para <span class="highlight-word">aprender a jugar online</span>';
            if (empty($home_slogan)) $home_slogan = 'Con rankings automáticos, información de expertos, <br>foco en el bienestar de los usuarios y control de los casinos.';
            if (empty($home_button)) $home_button = 'Comienza aquí';
            if (empty($home_button_link)) $home_button_link = '/nosotros/';

            if (empty($am_guide_quick)) $am_guide_quick = 'https://mailchi.mp/6e1a06396a83/betizen-guias';
            if (empty($am_guide_big)) $am_guide_big = 'https://mailchi.mp/6e1a06396a83/betizen-guias';
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e("Homepage title", "aipim");  ?></th>
                    <td><textarea name="am_home_title" style="width:100%;height:50px;"><?php echo $home_title; ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Homepage slogan", "aipim");  ?></th>
                    <td><textarea name="am_home_slogan" style="width:100%;height:50px;"><?php echo $home_slogan; ?></textarea></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Homepage button", "aipim");  ?></th>
                    <td><input name="am_home_button" style="width:100%;" value="<?php echo $home_button; ?>"></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Homepage button link", "aipim");  ?></th>
                    <td><input name="am_home_button_link" style="width:100%;" value="<?php echo $home_button_link; ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Quick guide link", "aipim");  ?></th>
                    <td><input name="am_guide_quick" style="width:100%;" value="<?php echo $am_guide_quick; ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e("Big guide link", "aipim");  ?></th>
                    <td><input name="am_guide_big" style="width:100%;" value="<?php echo $am_guide_big; ?>" /></td>
                </tr>
            </table>
            <?php
            // output save settings button
            submit_button(__("Save Settings", "aipim"));
            ?>
        </form>
    </div>
    <?php
}
function am_options_page(){
    add_menu_page(
        'Aipim',
        'Aipim',
        'manage_options',
        'aipim',
        'am_options_page_html',
        null,
        20
    );
    add_action( 'admin_init', 'am_register_settings' );
}


function aipim_custom_dashboard_widgets() {
  global $wp_meta_boxes;

  wp_add_dashboard_widget('custom_help_widget', __('Betizen stats', "aipim"), 'aipim_dashboard_help');
}

function aipim_dashboard_help() {
  // echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="https://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
  ?>
  <div class="main">
  	<ul class="assessments ScoreAssessments__ScoreAssessmentList-io0gsa-5 hvvXEp" style="padding-left:0;">
      <?php
      $args = array(
           'public'   => true,
           '_builtin' => false,
        );
        $post_types = get_post_types( $args, 'names', 'and' );
        $post_types[] = "post";
        // $post_types[] = "page";
        $total_posts = 0;
        foreach ( $post_types  as $post_type ) {
          $post_count_for_type = wp_count_posts( $post_type )->publish;
          ?>
          <li class="assessments__item ScoreAssessments__ScoreAssessmentItem-io0gsa-0 corxlU">
            <span  style="padding-left:0;" class="ScoreAssessments__ScoreAssessmentPart-io0gsa-1 assessments__item-text ScoreAssessments__ScoreAssessmentText-io0gsa-3 gsSaAO">
              <a href="edit.php?post_type=<?php echo $post_type; ?>">
                <?php _e("Posts", "aipim"); ?> <?php echo $post_type; ?>
              </a>
            </span>
            <span class="ScoreAssessments__ScoreAssessmentPart-io0gsa-1 assessments__item-score ScoreAssessments__ScoreAssessmentScore-io0gsa-4 EgbuL">
              <?php echo $post_count_for_type; ?>
            </span>
          </li>
          <?php
          $total_posts = $total_posts + $post_count_for_type;
        }
      ?>
      <li>&nbsp;</li>
      <li class="assessments__item ScoreAssessments__ScoreAssessmentItem-io0gsa-0 corxlU">
        <span  style="padding-left:0;" class="ScoreAssessments__ScoreAssessmentPart-io0gsa-1 assessments__item-text ScoreAssessments__ScoreAssessmentText-io0gsa-3 gsSaAO">
            <?php _e("Total posts published", "aipim"); ?>
        </span>
        <span class="ScoreAssessments__ScoreAssessmentPart-io0gsa-1 assessments__item-score ScoreAssessments__ScoreAssessmentScore-io0gsa-4 EgbuL">
          <b><?php echo $total_posts; ?></b>
        </span>
      </li>
  	</ul>

    </div>
  <?php
}



add_action('admin_menu', 'am_options_page');
// dashboard
add_action('wp_dashboard_setup', 'aipim_custom_dashboard_widgets');





?>
