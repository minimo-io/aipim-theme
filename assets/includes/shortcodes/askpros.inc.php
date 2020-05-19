<?php

function askpros_experts(){
	$ret = "";
	$users = get_users(array(
		'meta_key'     => 'es_experto',
    'meta_value'   => '0',
    'meta_compare' => '!='
	));

	foreach ($users as $user){
			$expert_in = get_user_meta($user->ID, "es_experto", true);
			$ret .= '<div class="expert"><img data-toggle="tooltip" data-placement="top" title="'.$user->display_name.'" src="'.esc_url( get_avatar_url( $user->ID ) ).'" /><span class="badge badge-primary">'.$expert_in.'</span></div>';
	}
	// return "<div class='experts-box' style='margin-top:10%;margin-bottom:10%;'><center>".$ret."</center></div>";
	return "";
}

function askpros_func( $atts ) {
	$atts = shortcode_atts( array(
		'requires-login' => 'true'
	), $atts, 'askpros' );
	$current_user = wp_get_current_user();

	$ret = "<style>h1.mb-3{ display:none; text-align:center; }</style>";
	// check form sent ===========================================================
	$sent_message = "";

	if (isset($_REQUEST["experts_email"]) && !empty($_REQUEST["experts_email"])
			&& isset($_REQUEST["expert_query"]) && !empty($_REQUEST["expert_query"])
			&& isset($_REQUEST["expert_area"]) && !empty($_REQUEST["expert_area"])
	){

		$url = 'https://www.google.com/recaptcha/api/siteverify';
		$data = array(
			'secret' => '6LeSdJ0UAAAAACJ2JWztng_RnR0vwx0Jezkc66a2',
			'response' => $_REQUEST["g-recaptcha-response"]
		);
		$options = array(
			'http' => array (
				'method' => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$verify = file_get_contents($url, false, $context);
		$captcha_success=json_decode($verify);
		if ($captcha_success->success==false) {
			$sent_message = '<div class="alert alert-danger text-center" role="alert" style="margin-top:5%;margin-bottom:5%;">'.__("There is an error in the captcha resolution. Please try again.", "aipim").'</div>';
		} else if ($captcha_success->success==true) {

			//user posted variables
				$message = "";
			  $message .= "#id: ". $current_user->ID."\r\n<br>";
			  $message .= "area: ". $_REQUEST["expert_area"]."\r\n<br>";
			  $message .= "email: ". $_REQUEST["experts_email"]."\r\n<br>";
			  $message .= "tel: ". $_REQUEST["experts_tel"]."\r\n<br>";
			  $message .= "query: ". $_REQUEST["expert_query"]."\r\n<br>";

			//php mailer variables
			  $to = get_option('admin_email');
			  $subject = __("New inquiry for expert", "aipim");
			  $headers = "From: mail@betizen.org\r\n" .
			    "Reply-To: mail@betizen.org\r\n";


			//Here put your Validation and send mail
			$sent = wp_mail($to, $subject, strip_tags($message), $headers);
			if ($sent == true){
				$sent_message = '<div class="alert alert-success text-center" role="alert" style="margin-top:5%;margin-bottom:5%;">
				'.__("Inquiry sent correctly. Our professionals will contact you shortly.", "aipim").'
				</div>';
				am_log("Consulta experto: ".str_replace(Array("\r", "\n"), "", $message));
			}else{
				$sent_message = '<div class="alert alert-danger text-center" role="alert" style="margin-top:5%;margin-bottom:5%;">'.__("An unexpected error occurred while trying to submit the inquiry.", "aipim").'</div>';
				am_log("Consulta experto: ".str_replace(Array("\r", "\n"), "", $message));
			}
		}

	}
	// ===========================================================================


		$ret .= '
		<div class="container">
			<div class="row">
				<div class="container container--xs">
					<div class="woocommerce">
						<div id="signup_div_wrapper">
							<h1 class="mb-1 text-center">'.__("Ask the pros", "aipim").'</h1>
						';
				if (is_user_logged_in()){
						$ret .= $sent_message;
						$options = "";
						$field = get_field_object('es_experto');
						foreach ($field["choices"] as $choice_k => $choice_val){
							if ("— No es experto —" != $choice_val){
								$options .= "<option value='".$choice_k."' ".($choice_k == @$_REQUEST["expert_area"] ? "selected" : "").">".$choice_val."</option>";
							}

						}
						$ret .= '
								<script src="https://www.google.com/recaptcha/api.js" async defer></script>
								<aside class="bp-feedback bp-messages info" style="margin-top:5%;">
									<span class="bp-icon" aria-hidden="true"></span>
									<p class="text-center">'.__("Simply select the area (Slots, Bingo, Casino, etc.), enter your contact information and send your question to our professionals. You will be answered personally and shortly.","aipim").'</p>
								</aside>
								<p>'.askpros_experts().'</p>
								<form action="./" name="expert_form" id="expert_form" class="standard-form signup-form clearfix" method="post">

								<div class="layout-wrap">
								<br>
								<div class="register-section default-profile" id="basic-details-section">
								<div class="form-group">
							    <label for="expert_area">'.__("I have a question about", "aipim").' <span class="required">*</span></label>
							    <select class="form-control" id="expert_area" name="expert_area" required>
							      '.$options.'
							    </select>
							  </div>
								<div class="form-group">
								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="experts_email">'.__("Email address", "aipim").' <span class="required">*</span></label><input class="form-control" type="email" name="experts_email" id="experts_email" value="'.$current_user->user_email.'" aria-required="true" required readonly>
								</p>
								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="experts_tel">'.__("Phone", "aipim").'</label><input class="form-control" type="tel" name="experts_tel" id="experts_tel" value="'.@$_REQUEST["experts_tel"].'" aria-required="true">
								</p>
								<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
									<label for="expert_query">Tu pregunta <span class="required">*</span></label>
									<textarea class="form-control" name="expert_query" id="expert_query" rows="3" style="height:10em;" required>'.@$_REQUEST["expert_query"].'</textarea>
								</p>
								</div>
								</div>
								</div>
								<div class="submit">
									<div class="g-recaptcha" data-sitekey="6LeSdJ0UAAAAAH1i95mTpgFtzZ05fERuLrihauM-"></div>
									<input class="btn btn-brand btn-block btn-lg mb-4 mt-3" type="submit" name="expert_submit" id="expert_submit" value="'.__("Send inquiry", "aipim").'">
								</div>

								</form>';
				}else{
						$ret .= '
								<aside class="bp-feedback bp-messages info">
									<span class="bp-icon" aria-hidden="true"></span>
									<p class="text-center">'.__("You need to login to be able to submit an inquiry to our professionals. If you don't have an account ", "aipim")."<a href='".wp_registration_url()."'>".__("signup now", "aipim")."</a>".__(", it's free!","aipim").'</p>
								</aside>
								<p></p>
						';
						$ret .= askpros_experts();
				}
		$ret .= '
							</div>
						</div>
					</div>
				</div>
		</div>';

	// return "requires-login = {$atts['requires-login']}";
	return $ret;
}
add_shortcode( 'askpros', 'askpros_func' );

 ?>
