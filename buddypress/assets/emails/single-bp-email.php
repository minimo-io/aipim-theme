<?php
/**
 * BuddyPress email template.
 *
 * Magic numbers:
 *  1.618 = golden mean.
 *  1.35  = default body_text_size multipler. Gives default heading of 20px.
 *
 * @since 2.5.0
 * @version 3.1.0
 *
 * @package BuddyPress
 * @subpackage Core
 */

/*
Based on the Cerberus "Fluid" template by Ted Goas (http://tedgoas.github.io/Cerberus/).
License for the original template:


The MIT License (MIT)

Copyright (c) 2017 Ted Goas

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$settings = bp_email_get_appearance_settings();

?><!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>">
	<meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
	<meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
	<title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

	<!-- CSS Reset -->
	<style type="text/css">
		p{
			margin:10px 0;
			padding:0;
		}
		table{
			border-collapse:collapse;
		}
		h1,h2,h3,h4,h5,h6{
			display:block;
			margin:0;
			padding:0;
		}
		img,a img{
			border:0;
			height:auto;
			outline:none;
			text-decoration:none;
		}
		body,#bodyTable,#bodyCell{
			height:100%;
			margin:0;
			padding:0;
			width:100%;
		}
		.mcnPreviewText{
			display:none !important;
		}
		#outlook a{
			padding:0;
		}
		img{
			-ms-interpolation-mode:bicubic;
		}
		table{
			mso-table-lspace:0pt;
			mso-table-rspace:0pt;
		}
		.ReadMsgBody{
			width:100%;
		}
		.ExternalClass{
			width:100%;
		}
		p,a,li,td,blockquote{
			mso-line-height-rule:exactly;
		}
		a[href^=tel],a[href^=sms]{
			color:inherit;
			cursor:default;
			text-decoration:none;
		}
		p,a,li,td,body,table,blockquote{
			-ms-text-size-adjust:100%;
			-webkit-text-size-adjust:100%;
		}
		.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
			line-height:100%;
		}
		a[x-apple-data-detectors]{
			color:inherit !important;
			text-decoration:none !important;
			font-size:inherit !important;
			font-family:inherit !important;
			font-weight:inherit !important;
			line-height:inherit !important;
		}
		.templateContainer{
			max-width:600px !important;
		}
		a.mcnButton{
			display:block;
		}
		.mcnImage,.mcnRetinaImage{
			vertical-align:bottom;
		}
		.mcnTextContent{
			word-break:break-word;
		}
		.mcnTextContent img{
			height:auto !important;
		}
		.mcnDividerBlock{
			table-layout:fixed !important;
		}
		h1{
			color:#222222;
			font-family:Helvetica;
			font-size:32px;
			font-style:normal;
			font-weight:bold;
			line-height:150%;
			letter-spacing:normal;
			text-align:left;
		}
		h2{
			color:#222222;
			font-family:Helvetica;
			font-size:30px;
			font-style:normal;
			font-weight:bold;
			line-height:150%;
			letter-spacing:normal;
			text-align:left;
		}
		h3{
			color:#444444;
			font-family:Helvetica;
			font-size:22px;
			font-style:normal;
			font-weight:bold;
			line-height:150%;
			letter-spacing:normal;
			text-align:left;
		}
		h4{
			color:#999999;
			font-family:Georgia;
			font-size:20px;
			font-style:italic;
			font-weight:normal;
			line-height:125%;
			letter-spacing:normal;
			text-align:center;
		}
		#templateHeader{
			background-color:#ffffff;
			background-image:none;
			background-repeat:no-repeat;
			background-position:center;
			background-size:cover;
			border-top:0;
			border-bottom:0;
			padding-top:0px;
			padding-bottom:20px;
		}
		.headerContainer{
			background-color:#ffffff;
			background-image:none;
			background-repeat:no-repeat;
			background-position:center;
			background-size:cover;
			border-top:0;
			border-bottom:0;
			padding-top:18px;
			padding-bottom:0;
		}
		.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{
			color:#222222;
			font-family:Helvetica;
			font-size:16px;
			line-height:150%;
			text-align:left;
		}
		.headerContainer .mcnTextContent a,.headerContainer .mcnTextContent p a{
			color:#7952b3;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateBody{
			background-color:#ffffff;
			background-image:none;
			background-repeat:no-repeat;
			background-position:center;
			background-size:cover;
			border-top:0;
			border-bottom:0;
			padding-top:0;
			padding-bottom:18px;
		}
		.bodyContainer{
			background-color:#ffffff;
			background-image:none;
			background-repeat:no-repeat;
			background-position:center;
			background-size:cover;
			border-top:0;
			border-bottom:0;
			padding-top:0;
			padding-bottom:18px;
		}
		.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{
			color:#222222;
			font-family:Helvetica;
			font-size:16px;
			line-height:150%;
			text-align:left;
		}
		.bodyContainer .mcnTextContent a,.bodyContainer .mcnTextContent p a{
			color:#00ADD8;
			font-weight:normal;
			text-decoration:underline;
		}
		#templateFooter{
			background-color:#F7F7F7;
			background-image:none;
			background-repeat:no-repeat;
			background-position:center;
			background-size:cover;
			border-top:0;
			border-bottom:0;
			padding-top:0;
			padding-bottom:73px;
		}
		.footerContainer{
			background-color:transparent;
			background-image:none;
			background-repeat:no-repeat;
			background-position:center;
			background-size:cover;
			border-top:0;
			border-bottom:0;
			padding-top:0;
			padding-bottom:0;
		}
		.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{
			color:#333333;
			font-family:Helvetica;
			font-size:12px;
			line-height:150%;
			text-align:center;
		}
		.footerContainer .mcnTextContent a,.footerContainer .mcnTextContent p a{
			color:#333333;
			font-weight:normal;
			text-decoration:underline;
		}
		@media only screen and (max-width: 480px){
		body,table,td,p,a,li,blockquote{
			-webkit-text-size-adjust:none !important;
		}

		}	@media only screen and (max-width: 480px){
		body{
			width:100% !important;
			min-width:100% !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnRetinaImage{
			max-width:100% !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImage{
			width:100% !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{
			max-width:100% !important;
			width:100% !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnBoxedTextContentContainer{
			min-width:100% !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImageGroupContent{
			padding:9px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
			padding-top:9px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImageCardTopImageContent,.mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
			padding-top:18px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImageCardBottomImageContent{
			padding-bottom:9px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImageGroupBlockInner{
			padding-top:0 !important;
			padding-bottom:0 !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImageGroupBlockOuter{
			padding-top:9px !important;
			padding-bottom:9px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnTextContent,.mcnBoxedTextContentColumn{
			padding-right:18px !important;
			padding-left:18px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
			padding-right:18px !important;
			padding-bottom:0 !important;
			padding-left:18px !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcpreview-image-uploader{
			display:none !important;
			width:100% !important;
		}

		}	@media only screen and (max-width: 480px){
		h1{
			font-size:30px !important;
			line-height:125% !important;
		}

		}	@media only screen and (max-width: 480px){
		h2{
			font-size:26px !important;
			line-height:125% !important;
		}

		}	@media only screen and (max-width: 480px){
		h3{
			font-size:20px !important;
			line-height:150% !important;
		}

		}	@media only screen and (max-width: 480px){
		h4{
			font-size:18px !important;
			line-height:150% !important;
		}

		}	@media only screen and (max-width: 480px){
		.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
			font-size:14px !important;
			line-height:150% !important;
		}

		}	@media only screen and (max-width: 480px){
		.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{
			font-size:16px !important;
			line-height:150% !important;
		}

		}	@media only screen and (max-width: 480px){
		.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{
			font-size:16px !important;
			line-height:150% !important;
		}

		}	@media only screen and (max-width: 480px){
		.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{
			font-size:14px !important;
			line-height:150% !important;
		}

		}
	</style>

</head>
<body class="email_bg" width="100%" bgcolor="<?php echo esc_attr( $settings['email_bg'] ); ?>" style="margin: 0; mso-line-height-rule: exactly;">


	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                            <tbody><tr>
	                                <td align="center" valign="top" id="templateHeader" data-template-container="" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0px;padding-bottom: 20px;">
	                                    <!--[if (gte mso 9)|(IE)]>
	                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	                                    <tr>
	                                    <td align="center" valign="top" width="600" style="width:600px;">
	                                    <![endif]-->
	                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	                                        <tbody><tr>
	                                            <td valign="top" class="headerContainer" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 18px;padding-bottom: 0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnImageBlockOuter">
	            <tr>
	                <td valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnImageBlockInner">
	                    <table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                        <tbody><tr>
	                            <td class="mcnImageContent" valign="top" style="padding-right: 9px;padding-left: 9px;padding-top: 0;padding-bottom: 0;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">


	                                        <img align="center" alt="logo-de-betizen" src="https://www.betizen.org/wp-content/uploads/2019/04/betizen-logo.png" width="300" style="max-width: 300px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" class="mcnImage">


	                            </td>
	                        </tr>
	                    </tbody></table>
	                </td>
	            </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnTextBlockOuter">
	        <tr>
	            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	              	<!--[if mso]>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
					<tr>
					<![endif]-->

					<!--[if mso]>
					<td valign="top" width="600" style="width:600px;">
					<![endif]-->
	                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
	                    <tbody><tr>

	                        <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;font-family: Tahoma, Verdana, Segoe, sans-serif;font-size: 18px;font-style: normal;font-weight: normal;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #222222;line-height: 150%;">

	                            <span style="color:#3c3c3c"><strong><?php _e("The trusted community for learning to bet online", "aipim"); ?></strong></span>
	                        </td>
	                    </tr>
	                </tbody></table>
					<!--[if mso]>
					</td>
					<![endif]-->

					<!--[if mso]>
					</tr>
					</table>
					<![endif]-->
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
	    <tbody class="mcnDividerBlockOuter">
	        <tr>
	            <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px dashed #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                    <tbody><tr>
	                        <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                            <span></span>
	                        </td>
	                    </tr>
	                </tbody></table>
	<!--
	                <td class="mcnDividerBlockInner" style="padding: 18px;">
	                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
	-->
	            </td>
	        </tr>
	    </tbody>
	</table></td>
	                                        </tr>
	                                    </tbody></table>
	                                    <!--[if (gte mso 9)|(IE)]>
	                                    </td>
	                                    </tr>
	                                    </table>
	                                    <![endif]-->
	                                </td>
	                            </tr>
	                            <tr>
	                                <td align="center" valign="top" id="templateBody" data-template-container="" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 18px;">
	                                    <!--[if (gte mso 9)|(IE)]>
	                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	                                    <tr>
	                                    <td align="center" valign="top" width="600" style="width:600px;">
	                                    <![endif]-->
	                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	                                        <tbody><tr>
	                                            <td valign="top" class="bodyContainer" style="background:#ffffff none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 18px;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnTextBlockOuter">
	        <tr>
	            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	              	<!--[if mso]>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
					<tr>
					<![endif]-->

					<!--[if mso]>
					<td valign="top" width="600" style="width:600px;">
					<![endif]-->
	                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
	                    <tbody><tr>

	                        <td valign="top" class="mcnTextContent" style="padding: 0px 18px 9px;font-family: Tahoma, Verdana, Segoe, sans-serif;font-size: 18px;font-style: normal;font-weight: normal;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #222222;line-height: 150%;">

	                            <strong>¡<?php bp_email_the_salutation( $settings ); ?>!</strong>
	                        </td>
	                    </tr>
	                </tbody></table>
					<!--[if mso]>
					</td>
					<![endif]-->

					<!--[if mso]>
					</tr>
					</table>
					<![endif]-->
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnTextBlockOuter">
	        <tr>
	            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	              	<!--[if mso]>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
					<tr>
					<![endif]-->

					<!--[if mso]>
					<td valign="top" width="600" style="width:600px;">
					<![endif]-->
	                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
	                    <tbody><tr>

	                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #222222;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;">

	                            <p style="text-align: center;margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #222222;font-family: Helvetica;font-size: 16px;line-height: 150%;"><span style="color:#696969">
																<strong>
																	{{{content}}}
																</strong>
																&nbsp;
															</p>

	                        </td>
	                    </tr>
	                </tbody></table>
					<!--[if mso]>
					</td>
					<![endif]-->

					<!--[if mso]>
					</tr>
					</table>
					<![endif]-->
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnButtonBlockOuter">
	        <tr>
	            <td style="padding-top: 0;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center" class="mcnButtonBlockInner">
	                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 40px;background-color: #7952B3;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                    <tbody>
	                        <tr>
	                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial;font-size: 20px;padding: 20px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                                <a class="mcnButton " title="<?php _e("Activate now", "aipim"); ?>" href="{{{activate.url}}}" target="_self" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">Activar cuenta ahora</a>
	                            </td>
	                        </tr>
	                    </tbody>
	                </table>
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
	    <tbody class="mcnDividerBlockOuter">
	        <tr>
	            <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px dashed #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                    <tbody><tr>
	                        <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                            <span></span>
	                        </td>
	                    </tr>
	                </tbody></table>
	<!--
	                <td class="mcnDividerBlockInner" style="padding: 18px;">
	                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
	-->
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnTextBlockOuter">
	        <tr>
	            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	              	<!--[if mso]>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
					<tr>
					<![endif]-->

					<!--[if mso]>
					<td valign="top" width="600" style="width:600px;">
					<![endif]-->
	                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
	                    <tbody><tr>

	                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #222222;font-family: Helvetica;font-size: 16px;line-height: 150%;text-align: left;">

	                            <div style="text-align: center;">
																<span style="color:#A9A9A9">
																	<strong>Nuestros rankings y juegos se crean usando los votos de los usuarios. <br>
																	Vota tu sitio favorito; ayuda a que otros eviten ser estafados.</strong>
																	<br>
																	¡Betizen NO acepta dinero para mejorar la posición en nuestros listados!
																</span>
															</div>

	                        </td>
	                    </tr>
	                </tbody></table>
					<!--[if mso]>
					</td>
					<![endif]-->

					<!--[if mso]>
					</tr>
					</table>
					<![endif]-->
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnButtonBlockOuter">
	        <tr>
	            <td style="padding-top: 0;padding-right: 18px;padding-bottom: 18px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" valign="top" align="center" class="mcnButtonBlockInner">
	                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 45px;background-color: #D9B5F1;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                    <tbody>
	                        <tr>
	                            <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Arial;font-size: 13px;padding: 10px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                                <a class="mcnButton " title="Mirala nuestros listados seguros" href="https://www.betizen.org/" target="_blank" style="font-weight: normal;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;display: block;">Mira nuestros listados seguros</a>
	                            </td>
	                        </tr>
	                    </tbody>
	                </table>
	            </td>
	        </tr>
	    </tbody>
	</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;table-layout: fixed !important;">
	    <tbody class="mcnDividerBlockOuter">
	        <tr>
	            <td class="mcnDividerBlockInner" style="min-width: 100%;padding: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px dashed #EAEAEA;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                    <tbody><tr>
	                        <td style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	                            <span></span>
	                        </td>
	                    </tr>
	                </tbody></table>
	<!--
	                <td class="mcnDividerBlockInner" style="padding: 18px;">
	                <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />
	-->
	            </td>
	        </tr>
	    </tbody>
	</table></td>
	                                        </tr>
	                                    </tbody></table>
	                                    <!--[if (gte mso 9)|(IE)]>
	                                    </td>
	                                    </tr>
	                                    </table>
	                                    <![endif]-->
	                                </td>
	                            </tr>
	                            <tr>
	                                <td align="center" valign="top" id="templateFooter" data-template-container="" style="background:#F7F7F7 none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #F7F7F7;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 73px;">
	                                    <!--[if (gte mso 9)|(IE)]>
	                                    <table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	                                    <tr>
	                                    <td align="center" valign="top" width="600" style="width:600px;">
	                                    <![endif]-->
	                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	                                        <tbody><tr>
	                                            <td valign="top" class="footerContainer" style="background:transparent none no-repeat center/cover;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: transparent;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 0;padding-bottom: 0;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	    <tbody class="mcnTextBlockOuter">
	        <tr>
	            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	              	<!--[if mso]>
					<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
					<tr>
					<![endif]-->

					<!--[if mso]>
					<td valign="top" width="600" style="width:600px;">
					<![endif]-->
					<table role="presentation" cellspacing="0" cellpadding="0" border="0" align="<?php echo esc_attr( $settings['direction'] ); ?>" width="100%" style="max-width: 600px; border-radius: 5px;" bgcolor="<?php echo esc_attr( $settings['footer_bg'] ); ?>" class="footer_bg">
						<tr>
							<td style="padding: 20px; width: 100%; font-size: <?php echo esc_attr( $settings['footer_text_size'] . 'px' ); ?>; font-family: sans-serif; mso-height-rule: exactly; line-height: <?php echo esc_attr( floor( $settings['footer_text_size'] * 1.618 ) . 'px' ); ?>; text-align: <?php echo esc_attr( $settings['direction'] ); ?>; color: <?php echo esc_attr( $settings['footer_text_color'] ); ?>;" class="footer_text_color footer_text_size">
								<?php
								/**
								 * Fires before the display of the email template footer.
								 *
								 * @since 2.5.0
								 */
								do_action( 'bp_before_email_footer' );
								?>

								<span class="footer_text"><?php echo nl2br( stripslashes( $settings['footer_text'] ) ); ?></span>
								<br><br>
								<a href="{{{unsubscribe}}}" style="text-decoration: underline;"><?php echo esc_html_x( 'unsubscribe', 'email', 'buddypress' ); ?></a>

								<?php
								/**
								 * Fires after the display of the email template footer.
								 *
								 * @since 2.5.0
								 */
								do_action( 'bp_after_email_footer' );
								?>
							</td>
						</tr>
					</table>
					<!--[if mso]>
					</td>
					<![endif]-->

					<!--[if mso]>
					</tr>
					</table>
					<![endif]-->
	            </td>
	        </tr>
	    </tbody>
	</table></td>
	                                        </tr>
	                                    </tbody></table>
	                                    <!--[if (gte mso 9)|(IE)]>
	                                    </td>
	                                    </tr>
	                                    </table>
	                                    <![endif]-->
	                                </td>
	                            </tr>
	                        </tbody>
												</table>


<?php
if ( function_exists( 'is_customize_preview' ) && is_customize_preview() ) {
	wp_footer();
}
?>
</body>
</html>
