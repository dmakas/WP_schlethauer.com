<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php include("texts.php"); ?>
<div class="wrap">
<?php
	if (!isset($language)) $language = wf_get_language();

	if ( is_plugin_active( 'polylang/polylang.php' ) ) {
		$showpolylangoptions = true;
	} else {
		$showpolylangoptions = false;		
	}

	if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {
		$showpolylangoptions = true;
	} else {
		$showpolylangoptions = false;		
	}
	
	if ( is_plugin_active( 'sitepress-multilingual-cms-master-/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
		$showpolylangoptions = true;
	} else {
		$showpolylangoptions = false;		
	}	
	
	
	if (isset($_GET['act'])) {
		if ($_GET['act'] == "deleteall") {
		?>
		<div class="notice dsgvodeleteall is-dismissible notice-warning" data-notice="dsgvodeleteall">
			<p><?php echo __("Are you sure you want to delete the plugin including all saved settings?", "dsgvo-all-in-one-for-wp"); ?></p>
			<p><?php echo __("The settings cannot be restored!", "dsgvo-all-in-one-for-wp"); ?></p>
			<a href="" class="button button-primary"><?php echo __("Delete plugin including all settings", "dsgvo-all-in-one-for-wp"); ?></a>
		</div>
		<?php
		}
	}
	
	if(isset($_POST["submit"])){ 
	
		$privilegs = check_admin_referer( 'dsgvo-settings' );

		if ($privilegs == 1) {
			
			if (isset($_POST["cookie-time"])) { $cookie_time = sanitize_text_field($_POST["cookie-time"]);	} else { $cookie_time = ""; }			
			if (isset($_POST["blog_agb"])) { $blog_agb = stripcslashes($_POST["blog_agb"]);	} else { $blog_agb = ""; }			
			if (isset($_POST["cookie_text"])) { $dsdvo_cookie_text = stripcslashes($_POST["cookie_text"]);	} else { $dsdvo_cookie_text = ""; }				
			if (isset($_POST["policy_text_1"])) { $policy_text_1 = $_POST["policy_text_1"];	} else { $policy_text_1 = ""; }			
			if (isset($_POST["outgoing_text"])) { $dsdvo_outgoing_text = stripcslashes($_POST["outgoing_text"]);	} else { $dsgvo_outgoing_text = ""; }						
			if (isset($_POST["dsdvo_delete_account_page"]["page_id"])) { $dsdvo_delete_account_page = sanitize_text_field($_POST["dsdvo_delete_account_page"]["page_id"]);	} else { $dsdvo_delete_account_page = ""; }						
			if (isset($_POST["cookie_not_acceptet_url"])) { $cookie_not_acceptet_url = sanitize_text_field($_POST["cookie_not_acceptet_url"]);	} else { $cookie_not_acceptet_url = ""; }						
			if (isset($_POST["cookie_not_acceptet_text"])) { $cookie_not_acceptet_text = sanitize_text_field($_POST["cookie_not_acceptet_text"]);	} else { $cookie_not_acceptet_text = ""; }						
			if (isset($_POST["show_policy"])) { $show_policy = sanitize_text_field($_POST["show_policy"]);	} else { $show_policy = ""; }			
			if (isset($_POST["show_outgoing_notice"])) { $show_outgoing_notice = sanitize_text_field($_POST["show_outgoing_notice"]);	} else { $show_outgoing_notice = ""; }			
			if (isset($_POST["show_rejectbtn"])) { $show_rejectbtn = sanitize_text_field($_POST["show_rejectbtn"]);	} else { $show_rejectbtn = ""; }						
			if (isset($_POST["show_closebtn"])) { $show_closebtn = sanitize_text_field($_POST["show_closebtn"]);	} else { $show_closebtn = ""; }
			if (isset($_POST["close_popup_auto"])) { $close_popup_auto = sanitize_text_field($_POST["close_popup_auto"]);	} else { $close_popup_auto = ""; }
			if (isset($_POST["use_dnt"])) { $use_dnt = sanitize_text_field($_POST["use_dnt"]);	} else { $use_dnt = ""; }									
			if (isset($_POST["show_layertext"])) { $show_layertext = sanitize_text_field($_POST["show_layertext"]);	} else { $show_layertext = ""; }
			if (isset($_POST["dsdvo_policy_site"]["page_id"])) { $dsdvo_policy_site = sanitize_text_field($_POST["dsdvo_policy_site"]["page_id"]);	} else { $dsdvo_policy_site = ""; }		
			if (isset($_POST["dsdvo_legalform"]["option_id"])) { $dsdvo_legalform = sanitize_text_field($_POST["dsdvo_legalform"]["option_id"]);	} else { $dsdvo_legalform = ""; }						
			if (isset($_POST["legalform_register"]["option_id"])) { $legalform_register = sanitize_text_field($_POST["legalform_register"]["option_id"]);	} else { $legalform_register = ""; }						
			if (isset($_POST["legalform_inforule"]["option_id"])) { $legalform_inforule = sanitize_text_field($_POST["legalform_inforule"]["option_id"]);	} else { $legalform_inforule = ""; }						
			if (isset($_POST["legalform_state"]["option_id"])) { $legalform_state = sanitize_text_field($_POST["legalform_state"]["option_id"]);	} else { $legalform_state = ""; }						
			if (isset($_POST["legalform_needconsens"])) { $legalform_needconsens = sanitize_text_field($_POST["legalform_needconsens"]);	} else { $legalform_needconsens = ""; }						
			if (isset($_POST["legalform_needregister"])) { $legalform_needregister = sanitize_text_field($_POST["legalform_needregister"]);	} else { $legalform_needregister = ""; }						
			if (isset($_POST["legalform_journalist"])) { $legalform_journalist = sanitize_text_field($_POST["legalform_journalist"]);	} else { $legalform_journalist = ""; }						
			if (isset($_POST["legalform_personname_jornalist"])) { $legalform_personname_jornalist = sanitize_text_field($_POST["legalform_personname_jornalist"]);	} else { $legalform_personname_jornalist = ""; }						
			if (isset($_POST["legalform_adress_jornalist"])) { $legalform_adress_jornalist = sanitize_text_field($_POST["legalform_adress_jornalist"]);	} else { $legalform_adress_jornalist = ""; }						
			if (isset($_POST["legalform_zip_jornalist"])) { $legalform_zip_jornalist = sanitize_text_field($_POST["legalform_zip_jornalist"]);	} else { $legalform_zip_jornalist = ""; }						
			if (isset($_POST["legalform_city_jornalist"])) { $legalform_city_jornalist = sanitize_text_field($_POST["legalform_city_jornalist"]);	} else { $legalform_city_jornalist = ""; }						
			if (isset($_POST["legalform_country_jornalist"])) { $legalform_country_jornalist = sanitize_text_field($_POST["legalform_country_jornalist"]);	} else { $legalform_country_jornalist = ""; }						
			if (isset($_POST["clause"])) { $clause = sanitize_text_field($_POST["clause"]);	} else { $clause = ""; }						
			if (isset($_POST["copyright"])) { $copyright = sanitize_text_field($_POST["copyright"]);	} else { $copyright = ""; }						
			if (isset($_POST["owntextsimprint"])) { $owntextsimprint = sanitize_text_field($_POST["owntextsimprint"]);	} else { $owntextsimprint = ""; }						
			if (isset($_POST["spamemail"])) { $spamemail = sanitize_text_field($_POST["spamemail"]);	} else { $spamemail = ""; }						
			if (isset($_POST["legalform_supervisoryauthority"])) { $legalform_supervisoryauthority = sanitize_text_field($_POST["legalform_supervisoryauthority"]);	} else { $legalform_supervisoryauthority = ""; }						
			if (isset($_POST["legalform_city"])) { $legalform_city = sanitize_text_field($_POST["legalform_city"]);	} else { $legalform_city = ""; }						
			if (isset($_POST["legalform_registernumber"])) { $legalform_registernumber = sanitize_text_field($_POST["legalform_registernumber"]);	} else { $legalform_registernumber = ""; }						
			if (isset($_POST["legalform_chamber"])) { $legalform_chamber = sanitize_text_field($_POST["legalform_chamber"]);	} else { $legalform_chamber = ""; }						
			if (isset($_POST["legalform_ustid"])) { $legalform_ustid = sanitize_text_field($_POST["legalform_ustid"]);	} else { $legalform_ustid = ""; }						
			if (isset($_POST["legalform_wid"])) { $legalform_wid = sanitize_text_field($_POST["legalform_wid"]);	} else { $legalform_wid = ""; }		
			if (isset($_POST["fbpixelid"])) { $fbpixelid = sanitize_text_field($_POST["fbpixelid"]);	} else { $fbpixelid = ""; }						
			if (isset($_POST["gaid"])) { $gaid = sanitize_text_field($_POST["gaid"]);	} else { $gaid = ""; }
			if (isset($_POST["shareaholicsiteid"])) { $shareaholicsiteid = sanitize_text_field($_POST["shareaholicsiteid"]);	} else { $shareaholicsiteid = ""; }
			if (isset($_POST["shareaholicappid"])) { $shareaholicappid = sanitize_text_field($_POST["shareaholicappid"]);	} else { $shareaholicappid = ""; }
			if (isset($_POST["gtagmanagerid"])) { $gtagmanagerid = sanitize_text_field($_POST["gtagmanagerid"]);	} else { $gtagmanagerid = ""; }
			if (isset($_POST["ga_optinoutsetting"])) { $ga_optinoutsetting = sanitize_text_field($_POST["ga_optinoutsetting"]);	} else { $ga_optinoutsetting = ""; }
			if (isset($_POST["vgwort_optinoutsetting"])) { $vgwort_optinoutsetting = sanitize_text_field($_POST["vgwort_optinoutsetting"]);	} else { $vgwort_optinoutsetting = ""; }
			if (isset($_POST["koko_optinoutsetting"])) { $koko_optinoutsetting = sanitize_text_field($_POST["koko_optinoutsetting"]);	} else { $koko_optinoutsetting = ""; }		
			if (isset($_POST["twitterusername"])) { $twitterusername = sanitize_text_field($_POST["twitterusername"]);	} else { $twitterusername = ""; }						
			if (isset($_POST["addthisid"])) { $addthisid = sanitize_text_field($_POST["addthisid"]);	} else { $addthisid = ""; }						
			if (isset($_POST["dsgvo_error_policy_blog"])) { $dsgvo_error_policy_blog = sanitize_text_field($_POST["dsgvo_error_policy_blog"]);	} else { $dsgvo_error_policy_blog = ""; }						
			if (isset($_POST["dsgvo_policy_blog_text"])) { $dsgvo_policy_blog_text = stripslashes($_POST["dsgvo_policy_blog_text"]);	} else { $dsgvo_policy_blog_text = ""; }						
			if (isset($_POST["dsgvo_pdf_text"])) { $dsgvo_pdf_text = sanitize_text_field($_POST["dsgvo_pdf_text"]);	} else { $dsgvo_pdf_text = ""; }						
			if (isset($_POST["notice_style"])) { $notice_style = sanitize_text_field($_POST["notice_style"]);	} else { $notice_style = ""; }		
			if (isset($_POST["animation_time"])) { $animation_time = sanitize_text_field($_POST["animation_time"]);	} else { $animation_time = ""; }				
			if (isset($_POST["notice_design"])) { $notice_design = sanitize_text_field($_POST["notice_design"]);	} else { $notice_design = ""; }						
			if (isset($_POST["btn_txt_accept"])) { $btn_txt_accept = sanitize_text_field($_POST["btn_txt_accept"]);	} else { $btn_txt_accept = ""; }						
			if (isset($_POST["btn_txt_customize"])) { $btn_txt_customize = sanitize_text_field($_POST["btn_txt_customize"]);	} else { $btn_txt_customize = ""; }						
			if (isset($_POST["btn_txt_not_accept"])) { $btn_txt_not_accept = sanitize_text_field($_POST["btn_txt_not_accept"]);	} else { $btn_txt_not_accept = ""; }						
			if (isset($_POST["is_online_shop"])) { $is_online_shop = sanitize_text_field($_POST["is_online_shop"]);	} else { $is_online_shop = ""; }
			if (isset($_POST["use_facebookcomments"])) { $use_facebookcomments = sanitize_text_field($_POST["use_facebookcomments"]);	} else { $use_facebookcomments = ""; }						
			if (isset($_POST["use_facebooklike"])) { $use_facebooklike = sanitize_text_field($_POST["use_facebooklike"]);	} else { $use_facebooklike = ""; }						
			if (isset($_POST["use_addthis"])) { $use_addthis = sanitize_text_field($_POST["use_addthis"]);	} else { $use_addthis = ""; }						
			if (isset($_POST["use_youtube"])) { $use_youtube = sanitize_text_field($_POST["use_youtube"]);	} else { $use_youtube = ""; }						
			if (isset($_POST["use_linkedin"])) { $use_linkedin = sanitize_text_field($_POST["use_linkedin"]);	} else { $use_linkedin = ""; }						
			if (isset($_POST["use_fbpixel"])) { $use_fbpixel = sanitize_text_field($_POST["use_fbpixel"]);	} else { $use_fbpixel = ""; }						
			if (isset($_POST["ga_optinoutsetting"])) { $ga_optinoutsetting = sanitize_text_field($_POST["ga_optinoutsetting"]);	} else { $ga_optinoutsetting = ""; }
			if (isset($_POST["vgwort_optinoutsetting"])) { $vgwort_optinoutsetting = sanitize_text_field($_POST["vgwort_optinoutsetting"]);	} else { $vgwort_optinoutsetting = ""; }
			if (isset($_POST["koko_optinoutsetting"])) { $koko_optinoutsetting = sanitize_text_field($_POST["koko_optinoutsetting"]);	} else { $koko_optinoutsetting = ""; }
			if (isset($_POST["use_ga"])) { $use_ga = sanitize_text_field($_POST["use_ga"]);	} else { $use_ga = ""; }	
			if (isset($_POST["ga_type"])) { $ga_type = sanitize_text_field($_POST["ga_type"]);	} else { $ga_type = ""; }	
			if (isset($_POST["use_piwik"])) { $use_piwik = sanitize_text_field($_POST["use_piwik"]);	} else { $use_piwik = ""; }				
			if (isset($_POST["use_shareaholic"])) { $use_shareaholic = sanitize_text_field($_POST["use_shareaholic"]);	} else { $use_shareaholic = ""; }
			if (isset($_POST["use_gtagmanager"])) { $use_gtagmanager = sanitize_text_field($_POST["use_gtagmanager"]);	} else { $use_gtagmanager = ""; }	
			if (isset($_POST["use_vgwort"])) { $use_vgwort = sanitize_text_field($_POST["use_vgwort"]);	} else { $use_vgwort = ""; }		
			if (isset($_POST["use_koko"])) { $use_koko = sanitize_text_field($_POST["use_koko"]);	} else { $use_koko = ""; }
			if (isset($_POST["remove_vgwort"])) { $remove_vgwort = sanitize_text_field($_POST["remove_vgwort"]);	} else { $remove_vgwort = ""; }			
			if (isset($_POST["remove_gtagmanager"])) { $remove_gtagmanager = sanitize_text_field($_POST["remove_gtagmanager"]);	} else { $remove_gtagmanager = ""; }						
			if (isset($_POST["use_twitter"])) { $use_twitter = sanitize_text_field($_POST["use_twitter"]);	} else { $use_twitter = ""; }						
			if (isset($_POST["btn_txt_reject"])) { $btn_txt_reject = sanitize_text_field($_POST["btn_txt_reject"]);	} else { $btn_txt_reject = ""; }			
			if (isset($_POST["position_service_control"])) { $position_service_control = sanitize_text_field($_POST["position_service_control"]);	} else { $position_service_control = ""; }						
			if (isset($_POST["show_servicecontrol"])) { $show_servicecontrol = sanitize_text_field($_POST["show_servicecontrol"]);	} else { $show_servicecontrol = ""; }									
			if (isset($_POST["piwik_host"])) { $piwik_host = htmlentities(stripslashes($_POST["piwik_host"]));	} else { $piwik_host = ""; }						
			if (isset($_POST["piwik_siteid"])) { $piwik_siteid = htmlentities(stripslashes($_POST["piwik_siteid"]));	} else { $piwik_siteid = ""; }
			if (isset($_POST["piwik_phpfile"])) { $piwik_phpfile = htmlentities(stripslashes($_POST["piwik_phpfile"]));	} else { $piwik_phpfile = ""; }						
			if (isset($_POST["dsgvoaiocompanyname"])) { $dsgvoaiocompanyname = htmlentities(stripslashes($_POST["dsgvoaiocompanyname"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiocompanyname = ""; }						
			if (isset($_POST["dsgvoaioperson"])) { $dsgvoaioperson = htmlentities(stripslashes($_POST["dsgvoaioperson"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaioperson = ""; }						
			if (isset($_POST["dsgvoaiostreet"])) { $dsgvoaiostreet = htmlentities(stripslashes($_POST["dsgvoaiostreet"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiostreet = ""; }						
			if (isset($_POST["dsgvoaiozip"])) { $dsgvoaiozip = htmlentities(stripslashes($_POST["dsgvoaiozip"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiozip = ""; }						
			if (isset($_POST["dsgvoaiocity"])) { $dsgvoaiocity = htmlentities(stripslashes($_POST["dsgvoaiocity"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiocity = ""; }						
			if (isset($_POST["dsgvoaiocountry"])) { $dsgvoaiocountry = htmlentities(stripslashes($_POST["dsgvoaiocountry"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiocountry = ""; }						
			if (isset($_POST["dsgvoaiophone"])) { $dsgvoaiophone = htmlentities(stripslashes($_POST["dsgvoaiophone"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiophone = ""; }						
			if (isset($_POST["dsgvoaiofax"])) { $dsgvoaiofax = htmlentities(stripslashes($_POST["dsgvoaiofax"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiophone = ""; }						
			if (isset($_POST["dsgvoaiomail"])) { $dsgvoaiomail = htmlentities(stripslashes($_POST["dsgvoaiomail"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiomail = ""; }						
			if (isset($_POST["dsgvoaiousdid"])) { $dsgvoaiousdid = htmlentities(stripslashes($_POST["dsgvoaiousdid"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvoaiousdid = ""; }								
			if (isset($_POST["companyformat"])) { $companyformat = htmlentities(stripslashes($_POST["companyformat"]), ENT_COMPAT, get_option('blog_charset'));	} else { $companyformat = ""; }								
			if (isset($_POST["auto_accept"])) { $auto_accept = sanitize_text_field($_POST["auto_accept"]);	} else { $auto_accept = ""; }								
			
			//Policy texts
			if (isset($_POST["wordpress_policy"])) { $wordpress_policy = htmlentities(stripslashes($_POST["wordpress_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $wordpress_policy = ""; }									
			if (isset($_POST["fbpixel_policy"])) { $fbpixel_policy = htmlentities(stripslashes($_POST["fbpixel_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $fbpixel_policy = ""; }						
			if (isset($_POST["facebook_policy"])) { $facebook_policy = htmlentities(stripslashes($_POST["facebook_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $facebook_policy = ""; }						
			if (isset($_POST["twitter_policy"])) { $twitter_policy = htmlentities(stripslashes($_POST["twitter_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $twitter_policy = ""; }						
			if (isset($_POST["ga_policy"])) { $ga_policy = htmlentities(stripslashes($_POST["ga_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $ga_policy = ""; }						
			if (isset($_POST["piwik_policy"])) { $piwik_policy = htmlentities(stripslashes($_POST["piwik_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $piwik_policy = ""; }						
			if (isset($_POST["gtagmanager_policy"])) { $gtagmanager_policy = htmlentities(stripslashes($_POST["gtagmanager_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $gtagmanager_policy = ""; }						
			if (isset($_POST["vgwort_policy"])) { $vgwort_policy = htmlentities(stripslashes($_POST["vgwort_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $vgwort_policy = ""; }						
			if (isset($_POST["shareaholic_policy"])) { $shareaholic_policy = htmlentities(stripslashes($_POST["shareaholic_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $shareaholic_policy = ""; }						
			if (isset($_POST["linkedin_policy"])) { $linkedin_policy = htmlentities(stripslashes($_POST["linkedin_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $linkedin_policy = ""; }						
			if (isset($_POST["youtube_policy"])) { $youtube_policy = htmlentities(stripslashes($_POST["youtube_policy"]), ENT_COMPAT, get_option('blog_charset'));	} else { $youtube_policy = ""; }	
			
			if (isset($_POST["youtube_layer"])) {
				$youtube_layer = htmlentities(stripslashes($_POST["youtube_layer"]));
			} else {
				$youtube_layer = "";	
			}			
			if (isset($_POST["linkedin_layer"])) {
				$linkedin_layer = htmlentities(stripslashes($_POST["linkedin_layer"]));
			} else {
				$linkedin_layer = "";	
			}		
			if (isset($_POST["vgwort_layer"])) {
				$vgwort_layer = htmlentities(stripslashes($_POST["vgwort_layer"]));
			} else {
				$vgwort_layer = "";	
			}		
			if (isset($_POST["shareaholic_layer"])) {
				$shareaholic_layer = htmlentities(stripslashes($_POST["shareaholic_layer"]));
			} else {
				$shareaholic_layer = "";	
			}				
			
			if ($showpolylangoptions == true or $language == "it") {
				if (isset($_POST["outgoing_text_it"])) { $dsdvo_outgoing_text_it = stripslashes($_POST["outgoing_text_it"]);	} else { $dsdvo_outgoing_text_it = ""; }							
				if (isset($_POST["cookie_text_it"])) { $dsdvo_cookie_text_it = stripslashes($_POST["cookie_text_it"]);	} else { $dsdvo_cookie_text_it = ""; }			
				if (isset($_POST["cookie_text_scroll_it"])) { $dsdvo_cookie_text_scroll_it = htmlentities(stripslashes($_POST["cookie_text_scroll_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsdvo_cookie_text_scroll_it = ""; }			
				if (isset($_POST["dsgvo_policy_blog_text_it"])) { $dsgvo_policy_blog_text_it = stripslashes($_POST["dsgvo_policy_blog_text_it"]);	} else { $dsgvo_policy_blog_text_it = ""; }			
				if (isset($_POST["dsgvo_error_policy_blog_it"])) { $dsgvo_error_policy_blog_it = stripslashes($_POST["dsgvo_error_policy_blog_it"]);	} else { $dsgvo_error_policy_blog_it = ""; }			
				if (isset($_POST["btn_txt_accept_it"])) { $btn_txt_accept_it = htmlentities(stripslashes($_POST["btn_txt_accept_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_accept_it = ""; }			
				if (isset($_POST["btn_txt_customize_it"])) { $btn_txt_customize_it = htmlentities(stripslashes($_POST["btn_txt_customize_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_customize_it = ""; }			
				if (isset($_POST["btn_txt_reject_it"])) { $btn_txt_reject_it = htmlentities(stripslashes($_POST["btn_txt_reject_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_reject_it = ""; }			
				if (isset($_POST["btn_txt_not_accept_it"])) { $btn_txt_not_accept_it = htmlentities(stripslashes($_POST["btn_txt_not_accept_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_not_accept_it = ""; }			
				if (isset($_POST["policy_text_it"])) { $policy_text_it = htmlentities(stripslashes($_POST["policy_text_it"]));	} else { $policy_text_it = ""; }			
				if (isset($_POST["customimprinttext_it"])) { $customimprinttext_it = htmlentities(stripslashes($_POST["customimprinttext_it"]));	} else { $customimprinttext_it = ""; }				
				if (isset($_POST["fbpixel_policy_it"])) { $fbpixel_policy_it = htmlentities(stripslashes($_POST["fbpixel_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $fbpixel_policy_it = ""; }			
				if (isset($_POST["wordpress_policy_it"])) { $wordpress_policy_it = htmlentities(stripslashes($_POST["wordpress_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $wordpress_policy_it = ""; }			
				if (isset($_POST["facebook_policy_it"])) { $facebook_policy_it = htmlentities(stripslashes($_POST["facebook_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $facebook_policy_it = ""; }							
				if (isset($_POST["twitter_policy_it"])) { $twitter_policy_it = htmlentities(stripslashes($_POST["twitter_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $twitter_policy_it = ""; }			
				if (isset($_POST["ga_policy_it"])) { $ga_policy_it = htmlentities(stripslashes($_POST["ga_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $ga_policy_it = ""; }			
				if (isset($_POST["piwik_policy_it"])) { $piwik_policy_it = htmlentities(stripslashes($_POST["piwik_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $piwik_policy_it = ""; }			
				if (isset($_POST["gtagmanager_policy_it"])) { $gtagmanager_policy_it = htmlentities(stripslashes($_POST["gtagmanager_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $gtagmanager_policy_it = ""; }										
				if (isset($_POST["vgwort_policy_it"])) { $vgwort_policy_it = htmlentities(stripslashes($_POST["vgwort_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $vgwort_policy_it = ""; }							
				if (isset($_POST["shareaholic_policy_it"])) { $shareaholic_policy_it = htmlentities(stripslashes($_POST["shareaholic_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $shareaholic_policy_it = ""; }											
				if (isset($_POST["linkedin_policy_it"])) { $linkedin_policy_it = htmlentities(stripslashes($_POST["linkedin_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $linkedin_policy_it = ""; }											
				if (isset($_POST["dsgvo_pdf_text_it"])) { $dsgvo_pdf_text_it = htmlentities(stripslashes($_POST["dsgvo_pdf_text_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvo_pdf_text_it = ""; }			
				if (isset($_POST["youtube_policy_it"])) { $youtube_policy_it = htmlentities(stripslashes($_POST["youtube_policy_it"]), ENT_COMPAT, get_option('blog_charset'));	} else { $youtube_policy_it = ""; }
			
			
				if (isset($_POST["youtube_layer_it"])) {
					$youtube_layer_it = htmlentities(stripslashes($_POST["youtube_layer_it"]));
				} else {
					$youtube_layer_it = "";	
				}		

				if (isset($_POST["linkedin_layer_it"])) {
					$linkedin_layer_it = htmlentities(stripslashes($_POST["linkedin_layer_it"]));
				} else {
					$linkedin_layer_it = "";	
				}	

				if (isset($_POST["vgwort_layer_it"])) {
					$vgwort_layer_it = htmlentities(stripslashes($_POST["vgwort_layer_it"]));
				} else {
					$vgwort_layer_it = "";	
				}		

				if (isset($_POST["shareaholic_layer_it"])) {
					$shareaholic_layer_it = htmlentities(stripslashes($_POST["shareaholic_layer_it"]));
				} else {
					$shareaholic_layer_it = "";	
				}				
			}
			
			if ($showpolylangoptions == true or $language == "it") {
				if (isset($_POST["outgoing_text_it"])) { update_option("dsdvo_outgoing_text_it", htmlentities(stripslashes($_POST["outgoing_text_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}							
				if (isset($_POST["cookie_text_it"])) { update_option("dsdvo_cookie_text_it", htmlentities(stripslashes($_POST["cookie_text_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}			
				if (isset($_POST["cookie_text_scroll_it"])) { update_option("dsdvo_cookie_text_scroll_it", htmlentities(stripslashes($_POST["cookie_text_scroll_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["dsgvo_policy_blog_text_it"])) { update_option("dsgvo_policy_blog_text_it", htmlentities(stripslashes($_POST["dsgvo_policy_blog_text_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["dsgvo_error_policy_blog_it"])) { update_option("dsgvo_error_policy_blog_it", htmlentities(stripslashes($_POST["dsgvo_error_policy_blog_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_accept_it"])) { update_option("dsgvo_btn_txt_accept_it", htmlentities(stripslashes($_POST["btn_txt_accept_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_customize_it"])) { update_option("dsgvo_btn_txt_customize_it", htmlentities(stripslashes($_POST["btn_txt_customize_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_reject_it"])) { update_option("dsgvo_btn_txt_reject_it", htmlentities(stripslashes($_POST["btn_txt_reject_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_not_accept_it"])) { update_option("dsgvo_btn_txt_not_accept_it", htmlentities(stripslashes($_POST["btn_txt_not_accept_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["policy_text_it"])) { update_option("dsdvo_policy_text_it", htmlentities(stripslashes($_POST["policy_text_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["customimprinttext_it"])) { update_option("dsdvo_customimprinttext_it", htmlentities(stripslashes($_POST["customimprinttext_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}
				if (isset($_POST["fbpixel_policy_it"])) { update_option("dsdvo_fbpixel_policy_it", htmlentities(stripslashes($_POST["fbpixel_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["facebook_policy_it"])) { update_option("dsdvo_facebook_policy_it", htmlentities(stripslashes($_POST["facebook_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["wordpress_policy_it"])) { update_option("dsdvo_wordpress_policy_it", htmlentities(stripslashes($_POST["wordpress_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["twitter_policy_it"])) { update_option("dsdvo_twitter_policy_it", htmlentities(stripslashes($_POST["twitter_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["ga_policy_it"])) { update_option("dsdvo_ga_policy_it", htmlentities(stripslashes($_POST["ga_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["piwik_policy_it"])) { update_option("dsdvo_piwik_policy_it", htmlentities(stripslashes($_POST["piwik_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["gtagmanager_policy_it"])) { update_option("dsdvo_gtagmanager_policy_it", htmlentities(stripslashes($_POST["gtagmanager_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["vgwort_policy_it"])) { update_option("dsdvo_vgwort_policy_it", htmlentities(stripslashes($_POST["vgwort_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["koko_policy_it"])) { update_option("dsdvo_koko_policy_it", htmlentities(stripslashes($_POST["koko_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["shareaholic_policy_it"])) { update_option("dsdvo_shareaholic_policy_it", htmlentities(stripslashes($_POST["shareaholic_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}										
				if (isset($_POST["linkedin_policy_it"])) { update_option("dsdvo_linkedin_policy_it", htmlentities(stripslashes($_POST["linkedin_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}										
				if (isset($_POST["dsgvo_pdf_text_it"])) { update_option("dsgvo_pdf_text_it", htmlentities(stripslashes($_POST["dsgvo_pdf_text_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["youtube_policy_it"])) { update_option("dsdvo_youtube_policy_it", htmlentities(stripslashes($_POST["youtube_policy_it"]), ENT_COMPAT, get_option('blog_charset')), false);	}	
			
				if (isset($_POST["youtube_layer_it"])) {
					update_option("dsdvo_youtube_layer_it", htmlentities(stripslashes($_POST["youtube_layer_it"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}			
				if (isset($_POST["linkedin_layer_it"])) {
					update_option("dsdvo_linkedin_layer_it", htmlentities(stripslashes($_POST["linkedin_layer_it"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}		
				if (isset($_POST["vgwort_layer_it"])) {
					update_option("dsdvo_vgwort_layer_it", htmlentities(stripslashes($_POST["vgwort_layer_it"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}	
				if (isset($_POST["shareaholic_layer_it"])) {
					update_option("dsdvo_shareaholic_layer_it", htmlentities(stripslashes($_POST["shareaholic_layer_it"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}				
			}				
			
			if ($showpolylangoptions == true or $language == "en") {
				if (isset($_POST["outgoing_text_en"])) { $dsdvo_outgoing_text_en = stripslashes($_POST["outgoing_text_en"]);	} else { $dsdvo_outgoing_text_en = ""; }							
				if (isset($_POST["cookie_text_en"])) { $dsdvo_cookie_text_en = stripslashes($_POST["cookie_text_en"]);	} else { $dsdvo_cookie_text_en = ""; }			
				if (isset($_POST["cookie_text_scroll_en"])) { $dsdvo_cookie_text_scroll_en = htmlentities(stripslashes($_POST["cookie_text_scroll_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsdvo_cookie_text_scroll_en = ""; }			
				if (isset($_POST["dsgvo_policy_blog_text_en"])) { $dsgvo_policy_blog_text_en = stripslashes($_POST["dsgvo_policy_blog_text_en"]);	} else { $dsgvo_policy_blog_text_en = ""; }			
				if (isset($_POST["dsgvo_error_policy_blog_en"])) { $dsgvo_error_policy_blog_en = stripslashes($_POST["dsgvo_error_policy_blog_en"]);	} else { $dsgvo_error_policy_blog_en = ""; }			
				if (isset($_POST["btn_txt_accept_en"])) { $btn_txt_accept_en = htmlentities(stripslashes($_POST["btn_txt_accept_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_accept_en = ""; }			
				if (isset($_POST["btn_txt_customize_en"])) { $btn_txt_customize_en = htmlentities(stripslashes($_POST["btn_txt_customize_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_customize_en = ""; }			
				if (isset($_POST["btn_txt_reject_en"])) { $btn_txt_reject_en = htmlentities(stripslashes($_POST["btn_txt_reject_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_reject_en = ""; }			
				if (isset($_POST["btn_txt_not_accept_en"])) { $btn_txt_not_accept_en = htmlentities(stripslashes($_POST["btn_txt_not_accept_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_not_accept_en = ""; }			
				if (isset($_POST["policy_text_en"])) { $policy_text_en = htmlentities(stripslashes($_POST["policy_text_en"]));	} else { $policy_text_en = ""; }			
				if (isset($_POST["customimprinttext_en"])) { $customimprinttext_en = htmlentities(stripslashes($_POST["customimprinttext_en"]));	} else { $customimprinttext_en = ""; }
				if (isset($_POST["fbpixel_policy_en"])) { $fbpixel_policy_en = htmlentities(stripslashes($_POST["fbpixel_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $fbpixel_policy_en = ""; }			
				if (isset($_POST["wordpress_policy_en"])) { $wordpress_policy_en = htmlentities(stripslashes($_POST["wordpress_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $wordpress_policy_en = ""; }			
				if (isset($_POST["facebook_policy_en"])) { $facebook_policy_en = htmlentities(stripslashes($_POST["facebook_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $facebook_policy_en = ""; }							
				if (isset($_POST["twitter_policy_en"])) { $twitter_policy_en = htmlentities(stripslashes($_POST["twitter_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $twitter_policy_en = ""; }			
				if (isset($_POST["ga_policy_en"])) { $ga_policy_en = htmlentities(stripslashes($_POST["ga_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $ga_policy_en = ""; }			
				if (isset($_POST["piwik_policy_en"])) { $piwik_policy_en = htmlentities(stripslashes($_POST["piwik_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $piwik_policy_en = ""; }			
				if (isset($_POST["gtagmanager_policy_en"])) { $gtagmanager_policy_en = htmlentities(stripslashes($_POST["gtagmanager_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $gtagmanager_policy_en = ""; }										
				if (isset($_POST["vgwort_policy_en"])) { $vgwort_policy_en = htmlentities(stripslashes($_POST["vgwort_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $vgwort_policy_en = ""; }							
				if (isset($_POST["shareaholic_policy_en"])) { $shareaholic_policy_en = htmlentities(stripslashes($_POST["shareaholic_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $shareaholic_policy_en = ""; }											
				if (isset($_POST["linkedin_policy_en"])) { $linkedin_policy_en = htmlentities(stripslashes($_POST["linkedin_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $linkedin_policy_en = ""; }											
				if (isset($_POST["dsgvo_pdf_text_en"])) { $dsgvo_pdf_text_en = htmlentities(stripslashes($_POST["dsgvo_pdf_text_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsgvo_pdf_text_en = ""; }				
				if (isset($_POST["youtube_policy_en"])) { $youtube_policy_en = htmlentities(stripslashes($_POST["youtube_policy_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $youtube_policy_en = ""; }	
			
				if (isset($_POST["youtube_layer_en"])) {
					$youtube_layer_en = htmlentities(stripslashes($_POST["youtube_layer_en"]));
				} else {
					$youtube_layer_en = "";	
				}
				if (isset($_POST["linkedin_layer_en"])) {
					$linkedin_layer_en = htmlentities(stripslashes($_POST["linkedin_layer_en"]));
				} else {
					$linkedin_layer_en = "";	
				}		
				if (isset($_POST["vgwort_layer_en"])) {
					$vgwort_layer_en = htmlentities(stripslashes($_POST["vgwort_layer_en"]));
				} else {
					$vgwort_layer_en = "";	
				}	
				if (isset($_POST["shareaholic_layer_en"])) {
					$shareaholic_layer_en = htmlentities(stripslashes($_POST["shareaholic_layer_en"]));
				} else {
					$shareaholic_layer_en = "";	
				}				
			}
			
			if ($showpolylangoptions == true or $language == "en") {
				if (isset($_POST["outgoing_text_en"])) { update_option("dsdvo_outgoing_text_en", htmlentities(stripslashes($_POST["outgoing_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}							
				if (isset($_POST["cookie_text_en"])) { update_option("dsdvo_cookie_text_en", htmlentities(stripslashes($_POST["cookie_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}			
				if (isset($_POST["cookie_text_scroll_en"])) { update_option("dsdvo_cookie_text_scroll_en", htmlentities(stripslashes($_POST["cookie_text_scroll_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["dsgvo_policy_blog_text_en"])) { update_option("dsgvo_policy_blog_text_en", htmlentities(stripslashes($_POST["dsgvo_policy_blog_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["dsgvo_error_policy_blog_en"])) { update_option("dsgvo_error_policy_blog_en", htmlentities(stripslashes($_POST["dsgvo_error_policy_blog_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_accept_en"])) { update_option("dsgvo_btn_txt_accept_en", htmlentities(stripslashes($_POST["btn_txt_accept_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_customize_en"])) { update_option("dsgvo_btn_txt_customize_en", htmlentities(stripslashes($_POST["btn_txt_customize_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_reject_en"])) { update_option("dsgvo_btn_txt_reject_en", htmlentities(stripslashes($_POST["btn_txt_reject_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_not_accept_en"])) { update_option("dsgvo_btn_txt_not_accept_en", htmlentities(stripslashes($_POST["btn_txt_not_accept_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["policy_text_en"])) { update_option("dsdvo_policy_text_en", htmlentities(stripslashes($_POST["policy_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["customimprinttext_en"])) { update_option("dsdvo_customimprinttext_en", htmlentities(stripslashes($_POST["customimprinttext_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}
				if (isset($_POST["fbpixel_policy_en"])) { update_option("dsdvo_fbpixel_policy_en", htmlentities(stripslashes($_POST["fbpixel_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["facebook_policy_en"])) { update_option("dsdvo_facebook_policy_en", htmlentities(stripslashes($_POST["facebook_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["wordpress_policy_en"])) { update_option("dsdvo_wordpress_policy_en", htmlentities(stripslashes($_POST["wordpress_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["twitter_policy_en"])) { update_option("dsdvo_twitter_policy_en", htmlentities(stripslashes($_POST["twitter_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["ga_policy_en"])) { update_option("dsdvo_ga_policy_en", htmlentities(stripslashes($_POST["ga_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["piwik_policy_en"])) { update_option("dsdvo_piwik_policy_en", htmlentities(stripslashes($_POST["piwik_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["gtagmanager_policy_en"])) { update_option("dsdvo_gtagmanager_policy_en", htmlentities(stripslashes($_POST["gtagmanager_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["vgwort_policy_en"])) { update_option("dsdvo_vgwort_policy_en", htmlentities(stripslashes($_POST["vgwort_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["koko_policy_en"])) { update_option("dsdvo_koko_policy_en", htmlentities(stripslashes($_POST["koko_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["shareaholic_policy_en"])) { update_option("dsdvo_shareaholic_policy_en", htmlentities(stripslashes($_POST["shareaholic_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}										
				if (isset($_POST["linkedin_policy_en"])) { update_option("dsdvo_linkedin_policy_en", htmlentities(stripslashes($_POST["linkedin_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}										
				if (isset($_POST["youtube_policy_en"])) { update_option("dsdvo_youtube_policy_en", htmlentities(stripslashes($_POST["youtube_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}
				if (isset($_POST["dsgvo_pdf_text_en"])) { update_option("dsgvo_pdf_text_en", htmlentities(stripslashes($_POST["dsgvo_pdf_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			
				if (isset($_POST["youtube_layer_en"])) {
					update_option("dsdvo_youtube_layer_en", htmlentities(stripslashes($_POST["youtube_layer_en"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}		
				if (isset($_POST["linkedin_layer_en"])) {
					update_option("dsdvo_linkedin_layer_en", htmlentities(stripslashes($_POST["linkedin_layer_en"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}	
				if (isset($_POST["vgwort_layer_en"])) {
					update_option("dsdvo_vgwort_layer_en", htmlentities(stripslashes($_POST["vgwort_layer_en"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}	
				if (isset($_POST["shareaholic_layer_en"])) {
					update_option("dsdvo_shareaholic_layer_en", htmlentities(stripslashes($_POST["shareaholic_layer_en"]), ENT_COMPAT, get_option('blog_charset')), false);	
				}				
			
			}				

			//update - create options
			if (isset($_POST["cookie-time"])) { update_option("dsdvo_cookie_time", htmlentities(stripslashes($_POST["cookie-time"])), false);	}		
			if (isset($_POST["blog_agb"])) { update_option("dsdvo_blog_agb", htmlentities(stripslashes($_POST["blog_agb"]), ENT_COMPAT, get_option('blog_charset')), false);	} else { update_option("dsdvo_blog_agb", "", false); }		
			if (isset($_POST["dsdvo_policy_site"]["page_id"])) { update_option("dsdvo_policy_site", htmlentities(stripslashes($_POST["dsdvo_policy_site"]["page_id"])), false);	}		
			if (isset($_POST["dsdvo_legalform"]["option_id"])) { update_option("dsdvo_legalform", htmlentities(stripslashes($_POST["dsdvo_legalform"]["option_id"]), ENT_COMPAT, get_option('blog_charset')), false);	} else { update_option("dsdvo_legalform", "", false); }		
			if (isset($_POST["legalform_register"]["option_id"])) { update_option("dsdvo_legalform_register", htmlentities(stripslashes($_POST["legalform_register"]["option_id"])), false);	}		
			if (isset($_POST["legalform_inforule"]["option_id"])) { update_option("dsdvo_legalform_inforule", htmlentities(stripslashes($_POST["legalform_inforule"]["option_id"])), false);	}		
			if (isset($_POST["legalform_state"]["option_id"])) { update_option("dsdvo_legalform_state", htmlentities(stripslashes($_POST["legalform_state"]["option_id"])), false);	}		
			if (isset($_POST["legalform_needconsens"])) { update_option("dsdvo_legalform_needconsens", htmlentities(stripslashes($_POST["legalform_needconsens"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_needregister"])) { update_option("dsdvo_legalform_needregister", htmlentities(stripslashes($_POST["legalform_needregister"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_journalist"])) { update_option("dsdvo_legalform_journalist", htmlentities(stripslashes($_POST["legalform_journalist"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_personname_jornalist"])) { update_option("dsdvo_legalform_personname_jornalist", htmlentities(stripslashes($_POST["legalform_personname_jornalist"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_adress_jornalist"])) { update_option("dsdvo_legalform_adress_jornalist", htmlentities(stripslashes($_POST["legalform_adress_jornalist"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_zip_jornalist"])) { update_option("dsdvo_legalform_zip_jornalist", htmlentities(stripslashes($_POST["legalform_zip_jornalist"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_city_jornalist"])) { update_option("dsdvo_legalform_city_jornalist", htmlentities(stripslashes($_POST["legalform_city_jornalist"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_country_jornalist"])) { update_option("dsdvo_legalform_country_jornalist", htmlentities(stripslashes($_POST["legalform_country_jornalist"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["clause"])) { update_option("dsdvo_clause", htmlentities(stripslashes($_POST["clause"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["copyright"])) { update_option("dsdvo_copyright", htmlentities(stripslashes($_POST["copyright"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["owntextsimprint"])) { update_option("dsdvo_owntextsimprint", htmlentities(stripslashes($_POST["owntextsimprint"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["spamemail"])) { update_option("dsdvo_spamemail", htmlentities(stripslashes($_POST["spamemail"])), false);	}		
			if (isset($_POST["legalform_supervisoryauthority"])) { update_option("dsdvo_legalform_supervisoryauthority", htmlentities(stripslashes($_POST["legalform_supervisoryauthority"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_city"])) { update_option("dsdvo_legalform_city", htmlentities(stripslashes($_POST["legalform_city"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_registernumber"])) { update_option("dsdvo_legalform_registernumber", htmlentities(stripslashes($_POST["legalform_registernumber"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_chamber"])) { update_option("dsdvo_legalform_chamber", htmlentities(stripslashes($_POST["legalform_chamber"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["legalform_ustid"])) { update_option("dsdvo_legalform_ustid", htmlentities(stripslashes($_POST["legalform_ustid"])), false);	}		
			if (isset($_POST["legalform_wid"])) { update_option("dsdvo_legalform_wid", htmlentities(stripslashes($_POST["legalform_wid"])), false);	}		
			if (isset($_POST["cookie_text"])) { update_option("dsdvo_cookie_text", htmlentities(stripslashes($_POST["cookie_text"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["outgoing_text"])) { update_option("dsdvo_outgoing_text", htmlentities(stripslashes($_POST["outgoing_text"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["policy_text_1"])) { update_option("dsdvo_policy_text_1", htmlentities(stripslashes($_POST["policy_text_1"]), ENT_COMPAT, get_option('blog_charset')), false);	}
			if (isset($_POST["customimprinttext"])) { update_option("dsdvo_customimprinttext", htmlentities(stripslashes($_POST["customimprinttext"]), ENT_COMPAT, get_option('blog_charset')), false);	}
			if (isset($_POST["dsdvo_delete_account_page"])) { update_option("dsdvo_delete_account_page", sanitize_text_field($_POST["dsdvo_delete_account_page"]["page_id"]), false);	}		
			if (isset($_POST["cookie_not_acceptet_url"])) { update_option("cookie_not_acceptet_url", htmlentities(stripslashes($_POST["cookie_not_acceptet_url"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["cookie_not_acceptet_text"])) { update_option("cookie_not_acceptet_text", htmlentities(stripslashes($_POST["cookie_not_acceptet_text"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["show_policy"])) { update_option("dsdvo_show_policy", htmlentities(stripslashes($_POST["show_policy"])), false);	} else { update_option("dsdvo_show_policy", "", false); }		
			if (isset($_POST["show_outgoing_notice"])) { update_option("dsdvo_show_outgoing_notice", htmlentities(stripslashes($_POST["show_outgoing_notice"])), false);	} else { update_option("dsdvo_show_outgoing_notice", "", false); }		
			if (isset($_POST["show_rejectbtn"])) { update_option("dsdvo_show_rejectbtn", htmlentities(stripslashes($_POST["show_rejectbtn"])), false);	}	else { update_option("dsdvo_show_rejectbtn", "off", false); }	
			if (isset($_POST["show_closebtn"])) { update_option("dsdvo_show_closebtn", htmlentities(stripslashes($_POST["show_closebtn"])), false);	}	else { update_option("dsdvo_show_closebtn", "off", false); }
			if (isset($_POST["close_popup_auto"])) { update_option("dsdvo_close_popup_auto", htmlentities(stripslashes($_POST["close_popup_auto"])), false);	}	else { update_option("dsdvo_close_popup_auto", "off", false); }
			if (isset($_POST["use_dnt"])) { update_option("dsdvo_use_dnt", htmlentities(stripslashes($_POST["use_dnt"])), false);	}	else { update_option("dsdvo_use_dnt", "off", false); }				
			if (isset($_POST["show_layertext"])) { update_option("dsdvo_show_layertext", htmlentities(stripslashes($_POST["show_layertext"])), false);	}	else { update_option("dsdvo_show_layertext", "off", false); }
			if (isset($_POST["dsgvo_pdf_text_en"])) { update_option("dsgvo_pdf_text_en", htmlentities(stripslashes($_POST["dsgvo_pdf_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["auto_accept"])) { update_option("dsdvo_auto_accept", $_POST["auto_accept"] , false);	} else { update_option("dsdvo_auto_accept", "" , false); }			
			if (isset($_POST["fbpixelid"])) { update_option("dsdvo_fbpixelid", htmlentities(stripslashes($_POST["fbpixelid"])), false);	}		
			if (isset($_POST["gaid"])) { update_option("dsdvo_gaid", htmlentities(stripslashes($_POST["gaid"])), false);	}		
			if (isset($_POST["shareaholicsiteid"])) { update_option("dsdvo_shareaholicsiteid", htmlentities(stripslashes($_POST["shareaholicsiteid"])), false);	}		
			if (isset($_POST["shareaholicappid"])) { update_option("dsdvo_shareaholicappid", htmlentities(stripslashes($_POST["shareaholicappid"])), false);	}		
			if (isset($_POST["gtagmanagerid"])) { update_option("dsdvo_gtagmanagerid", htmlentities(stripslashes($_POST["gtagmanagerid"])), false);	}	
			if (isset($_POST["twitterusername"])) { update_option("dsdvo_twitterusername", htmlentities(stripslashes($_POST["twitterusername"])), false);	}		
			if (isset($_POST["addthisid"])) { update_option("dsdvo_addthisid", htmlentities(stripslashes($_POST["addthisid"])), false);	}		
			if (isset($_POST["dsgvo_error_policy_blog"])) { update_option("dsgvo_error_policy_blog", htmlentities(stripslashes($_POST["dsgvo_error_policy_blog"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvo_policy_blog_text"])) { update_option("dsgvo_policy_blog_text", htmlentities(stripslashes($_POST["dsgvo_policy_blog_text"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvo_pdf_text"])) { update_option("dsgvo_pdf_text", htmlentities(stripslashes($_POST["dsgvo_pdf_text"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["notice_style"])) { update_option("dsgvo_notice_style", htmlentities(stripslashes($_POST["notice_style"])), false);	}		
			if (isset($_POST["animation_time"])) { update_option("dsgvo_animation_time", htmlentities(stripslashes($_POST["animation_time"])), false);	}	
			if (isset($_POST["notice_design"])) { update_option("dsgvo_notice_design", htmlentities(stripslashes($_POST["notice_design"])), false);	}		
			if (isset($_POST["btn_txt_accept"])) { update_option("dsgvo_btn_txt_accept", htmlentities(stripslashes($_POST["btn_txt_accept"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["btn_txt_customize"])) { update_option("dsgvo_btn_txt_customize", htmlentities(stripslashes($_POST["btn_txt_customize"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["btn_txt_not_accept"])) { update_option("dsgvo_btn_txt_not_accept", htmlentities(stripslashes($_POST["btn_txt_not_accept"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["use_facebookcomments"])) { update_option("dsdvo_use_facebookcomments", htmlentities(stripslashes($_POST["use_facebookcomments"])), false);	} else { update_option("dsdvo_use_facebookcomments", "", false); }		
			if (isset($_POST["use_facebooklike"])) { update_option("dsdvo_use_facebooklike", htmlentities(stripslashes($_POST["use_facebooklike"])), false);	} else { update_option("dsdvo_use_facebooklike", "", false); }		
			if (isset($_POST["use_addthis"])) { update_option("dsdvo_use_addthis", htmlentities(stripslashes($_POST["use_addthis"])), false);	} else { update_option("dsdvo_use_addthis", "", false); }		
			if (isset($_POST["use_linkedin"])) { update_option("dsdvo_use_linkedin", htmlentities(stripslashes($_POST["use_linkedin"])), false);	} else { update_option("dsdvo_use_linkedin", "", false); }		
			if (isset($_POST["use_youtube"])) { update_option("dsdvo_use_youtube", htmlentities(stripslashes($_POST["use_youtube"])), false);	} else { update_option("dsdvo_use_youtube", "", false); }		
			if (isset($_POST["is_online_shop"])) { update_option("dsdvo_is_online_shop", htmlentities(stripslashes($_POST["is_online_shop"])), false);	} else { update_option("dsdvo_is_online_shop", "", false); }
			if (isset($_POST["use_fbpixel"])) { update_option("dsdvo_use_fbpixel", htmlentities(stripslashes($_POST["use_fbpixel"])), false);	} else { update_option("dsdvo_use_fbpixel", "", false); }
			if (isset($_POST["ga_optinoutsetting"])) { update_option("dsdvo_ga_optinoutsetting", htmlentities(stripslashes($_POST["ga_optinoutsetting"])), false);	} else { update_option("dsdvo_ga_optinoutsetting", "", false); }	
			if (isset($_POST["vgwort_optinoutsetting"])) { update_option("dsdvo_vgwort_optinoutsetting", htmlentities(stripslashes($_POST["vgwort_optinoutsetting"])));	} else { update_option("dsdvo_vgwort_optinoutsetting", "", false); }	
			if (isset($_POST["koko_optinoutsetting"])) { update_option("dsdvo_koko_optinoutsetting", htmlentities(stripslashes($_POST["koko_optinoutsetting"])));	} else { update_option("dsdvo_koko_optinoutsetting", "", false); }	
			if (isset($_POST["use_ga"])) { update_option("dsdvo_use_ga", htmlentities(stripslashes($_POST["use_ga"])), false);	} else { update_option("dsdvo_use_ga", "", false);} 
			if (isset($_POST["ga_type"])) { update_option("dsdvo_ga_type", htmlentities(stripslashes($_POST["ga_type"])), false);	} else { update_option("dsdvo_ga_type", "", false); }	
			if (isset($_POST["use_piwik"])) { update_option("dsdvo_use_piwik", htmlentities(stripslashes($_POST["use_piwik"])), false);	} else { update_option("dsdvo_use_piwik", "", false); }	
			if (isset($_POST["use_shareaholic"])) { update_option("dsdvo_use_shareaholic", htmlentities(stripslashes($_POST["use_shareaholic"])), false);	} else { update_option("dsdvo_use_shareaholic", "", false); }	
			if (isset($_POST["use_gtagmanager"])) { update_option("dsdvo_use_gtagmanager", htmlentities(stripslashes($_POST["use_gtagmanager"])), false);	} else { update_option("dsdvo_use_gtagmanager", "", false); }	
			if (isset($_POST["use_vgwort"])) { update_option("dsdvo_use_vgwort", htmlentities(stripslashes($_POST["use_vgwort"])), false);	} else { update_option("dsdvo_use_vgwort", "", false); }	
			if (isset($_POST["use_koko"])) { update_option("dsdvo_use_koko", htmlentities(stripslashes($_POST["use_koko"])), false);	} else { update_option("dsdvo_use_koko", "", false); }	
			if (isset($_POST["remove_vgwort"])) { update_option("dsdvo_remove_vgwort", htmlentities(stripslashes($_POST["remove_vgwort"])), false);	} else { update_option("dsdvo_remove_vgwort", "", false); }	
			if (isset($_POST["remove_gtagmanager"])) { update_option("dsdvo_remove_gtagmanager", htmlentities(stripslashes($_POST["remove_gtagmanager"])), false);	} else { update_option("dsdvo_remove_gtagmanager", "", false); }	
			if (isset($_POST["use_twitter"])) { update_option("dsdvo_use_twitter", htmlentities(stripslashes($_POST["use_twitter"])), false);	} else { update_option("dsdvo_use_twitter", "", false); }	
			if (isset($_POST["btn_txt_reject"])) { update_option("dsgvo_btn_txt_reject", htmlentities(stripslashes($_POST["btn_txt_reject"]), ENT_COMPAT, get_option('blog_charset')), false);	}				
			if (isset($_POST["btn_txt_not_accept"])) { update_option("dsgvo_btn_txt_not_accept", htmlentities(stripslashes($_POST["btn_txt_not_accept"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["fbpixel_policy"])) { update_option("dsdvo_fbpixel_policy", htmlentities(stripslashes($_POST["fbpixel_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["wordpress_policy"])) { update_option("dsdvo_wordpress_policy", htmlentities(stripslashes($_POST["wordpress_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}					
			if (isset($_POST["facebook_policy"])) { update_option("dsdvo_facebook_policy", htmlentities(stripslashes($_POST["facebook_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["twitter_policy"])) { update_option("dsdvo_twitter_policy", htmlentities(stripslashes($_POST["twitter_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["ga_policy"])) { update_option("dsdvo_ga_policy", htmlentities(stripslashes($_POST["ga_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["piwik_policy"])) { update_option("dsdvo_piwik_policy", htmlentities(stripslashes($_POST["piwik_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["gtagmanager_policy"])) { update_option("dsdvo_gtagmanager_policy", htmlentities(stripslashes($_POST["gtagmanager_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["vgwort_policy"])) { update_option("dsdvo_vgwort_policy", htmlentities(stripslashes($_POST["vgwort_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["koko_policy"])) { update_option("dsdvo_koko_policy", htmlentities(stripslashes($_POST["koko_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["shareaholic_policy"])) { update_option("dsdvo_shareaholic_policy", htmlentities(stripslashes($_POST["shareaholic_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}					
			if (isset($_POST["linkedin_policy"])) { update_option("dsdvo_linkedin_policy", htmlentities(stripslashes($_POST["linkedin_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}					
			if (isset($_POST["youtube_policy"])) { update_option("dsdvo_youtube_policy", htmlentities(stripslashes($_POST["youtube_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}	
			if (isset($_POST["youtube_layer"])) { update_option("dsdvo_youtube_layer", htmlentities(stripslashes($_POST["youtube_layer"]), ENT_COMPAT, get_option('blog_charset')), false);	}
			if (isset($_POST["vgwort_layer"])) { update_option("dsdvo_vgwort_layer", htmlentities(stripslashes($_POST["vgwort_layer"]), ENT_COMPAT, get_option('blog_charset')), false);	}
			if (isset($_POST["linkedin_layer"])) { update_option("dsdvo_linkedin_layer", htmlentities(stripslashes($_POST["linkedin_layer"]), ENT_COMPAT, get_option('blog_charset')), false);	}
			if (isset($_POST["shareaholic_layer"])) { update_option("dsdvo_shareaholic_layer", htmlentities(stripslashes($_POST["shareaholic_layer"]), ENT_COMPAT, get_option('blog_charset')), false);	}
			if (isset($_POST["position_service_control"])) { update_option("dsgvo_position_service_control", htmlentities(stripslashes($_POST["position_service_control"])), false);	}	
			if (isset($_POST["show_servicecontrol"])) { update_option("dsdvo_show_servicecontrol", stripslashes($_POST["show_servicecontrol"]), false);	} else { update_option("dsdvo_show_servicecontrol", "", false); }	
			if (isset($_POST["dsgvoaiocompanyname"])) { update_option("dsgvoaiocompanyname", htmlentities(stripslashes($_POST["dsgvoaiocompanyname"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaioperson"])) { update_option("dsgvoaioperson", htmlentities(stripslashes($_POST["dsgvoaioperson"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiostreet"])) { update_option("dsgvoaiostreet", htmlentities(stripslashes($_POST["dsgvoaiostreet"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiozip"])) { update_option("dsgvoaiozip", htmlentities(stripslashes($_POST["dsgvoaiozip"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiocity"])) { update_option("dsgvoaiocity", htmlentities(stripslashes($_POST["dsgvoaiocity"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiocountry"])) { update_option("dsgvoaiocountry", htmlentities(stripslashes($_POST["dsgvoaiocountry"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiophone"])) { update_option("dsgvoaiophone", htmlentities(stripslashes($_POST["dsgvoaiophone"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiofax"])) { update_option("dsgvoaiofax", htmlentities(stripslashes($_POST["dsgvoaiofax"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiomail"])) { update_option("dsgvoaiomail", htmlentities(stripslashes($_POST["dsgvoaiomail"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsgvoaiousdid"])) { update_option("dsgvoaiousdid", htmlentities(stripslashes($_POST["dsgvoaiousdid"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["companyformat"])) { update_option("dsgvoaiocompanyformat", htmlentities(stripslashes($_POST["companyformat"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["piwik_host"])) { update_option("dsgvo_piwik_host", htmlentities(stripslashes($_POST["piwik_host"]), ENT_COMPAT, get_option('blog_charset')), false);	}	
			if (isset($_POST["piwik_phpfile"])) { update_option("dsgvo_piwik_phpfile", htmlentities(stripslashes($_POST["piwik_phpfile"]), ENT_COMPAT, get_option('blog_charset')), false);	}				
			if (isset($_POST["piwik_siteid"])) { update_option("dsgvo_piwik_siteid", htmlentities(stripslashes($_POST["piwik_siteid"]), ENT_COMPAT, get_option('blog_charset')), false);	}		

			if ($show_servicecontrol == "on") {
				$show_servicecontrol = "checked='checked'";
			} else {
				$show_servicecontrol = "";
			}	
			
			if ($use_facebookcomments == "on") {
				$use_facebookcomments = "checked='checked'";
			} else {
				$use_facebookcomments = "";
			}
			
			if ($use_facebooklike == "on") {
				$use_facebooklike = "checked='checked'";
			} else {
				$use_facebooklike = "";
			}
			
			if ($use_addthis == "on") {
				$use_addthis = "checked='checked'";
			} else {
				$use_addthis = "";
			}
			
			if ($use_linkedin == "on") {
				$use_linkedin = "checked='checked'";
			} else {
				$use_linkedin = "";
			}
			
			if ($use_youtube == "on") {
				$use_youtube = "checked='checked'";
			} else {
				$use_youtube = "";
			}
			
			if ($use_fbpixel == "on") {
				$use_fbpixel = "checked='checked'";
			} else {
				$use_fbpixel = "";
			}	
			
			if ($is_online_shop == "on") {
				$is_online_shop = "checked='checked'";
			} else {
				$is_online_shop = "";
			}	
			
			if ($use_gtagmanager == "on") {
				$use_gtagmanager = "checked='checked'";
			} else {
				$use_gtagmanager = "";
			}			
			
			if ($use_ga == "on") {
				$use_ga = "checked='checked'";
			} else {
				$use_ga = "";
			}
			
			if ($use_piwik == "on") {
				$use_piwik = "checked='checked'";
			} else {
				$use_piwik = "";
			}			
			
			if ($use_shareaholic == "on") {
				$use_shareaholic = "checked='checked'";
			} else {
				$use_shareaholic = "";
			}			
			
			if ($use_vgwort == "on") {
				$use_vgwort = "checked='checked'";
			} else {
				$use_vgwort = "";
			}	
			
			if ($use_koko == "on") {
				$use_koko = "checked='checked'";
			} else {
				$use_koko = "";
			}				

			if ($remove_vgwort == "on") {
				$remove_vgwort = "checked='checked'";
			} else {
				$remove_vgwort = "";
			}			
			
			if ($remove_gtagmanager == "on") {
				$remove_gtagmanager = "checked='checked'";
			} else {
				$remove_gtagmanager = "";
			}				
			
			
			if ($use_twitter == "on") {
				$use_twitter = "checked='checked'";
			} else {
				$use_twitter = "";
			}
			
			if ($blog_agb == "on") {
				$blog_agb_selected = "checked='checked'";
			} else {
				$blog_agb_selected = "";
			}
			
			if ($show_policy == "on") {
				$show_policy = "checked='checked'";
			} else {
				$show_policy = "";
			}
			
			if ($show_outgoing_notice == "on") {
				$show_outgoing_notice = "checked='checked'";
			} else {
				$show_outgoing_notice = "";
			}			
			
			if ($show_rejectbtn == "on") {
				$show_rejectbtn = "checked='checked'";
			} else {
				$show_rejectbtn = "";
			}
			
			if ($show_closebtn == "on") {
				$show_closebtn = "checked='checked'";
			} else {
				$show_closebtn = "";
			}	

			if ($close_popup_auto == "on") {
				$close_popup_auto = "checked='checked'";
			} else {
				$close_popup_auto = "";
			}			
			
			if ($use_dnt == "on") {
				$use_dnt = "checked='checked'";
			} else {
				$use_dnt = "";
			}	

			if ($show_layertext == "on") {
				$show_layertext = "checked='checked'";
			} else {
				$show_layertext = "";
			}			
			
			if ($auto_accept == "on") {
				$auto_accept = "checked='checked'";
			} else {
				$auto_accept = "";
			}			
			
			if (isset($_POST["dsgvo_remove_ipaddr_auto"])) { $dsgvo_remove_ipaddr_auto = "on"; } else { $dsgvo_remove_ipaddr_auto = "off"; }
			
			update_option("dsgvo_remove_ipaddr_auto",  $dsgvo_remove_ipaddr_auto);
			
			
			if ($dsgvo_remove_ipaddr_auto == "on") {
				$dsgvo_remove_ipaddr_auto = "checked='checked'";
			} else {
				$dsgvo_remove_ipaddr_auto = "";
			}
			
			//save update date
			$now = new DateTime();
			$update_date = $now->format('d.m.Y');
			update_option("dsdvo_policy_update_date", $update_date );

			echo '<div class="notice notice-success" class="updated fade"><p>'.__('Settings saved successfully', 'dsgvo-all-in-one-for-wp').'<span class="dashicons dashicons-yes"></span></p></div>';
		}
		
	} else {
		
			$cookie_time = get_option("dsdvo_cookie_time");
			$blog_agb = get_option("dsdvo_blog_agb");
			$dsdvo_policy_site = get_option("dsdvo_policy_site");
			$dsdvo_legalform = get_option("dsdvo_legalform");
			if(!$dsdvo_legalform) {$dsdvo_legalform = ""; }	
			$legalform_register = get_option("dsdvo_legalform_register");
			if(!$legalform_register) {$legalform_register = ""; }				
			$legalform_inforule = get_option("dsdvo_legalform_inforule");
			if(!$legalform_inforule) {$legalform_inforule = ""; }		
			$legalform_state = get_option("dsdvo_legalform_state");
			if(!$legalform_state) {$legalform_state = ""; }				
			$legalform_needconsens = get_option("dsdvo_legalform_needconsens");
			if(!$legalform_needconsens) {$legalform_needconsens = ""; }	
			$legalform_needregister = get_option("dsdvo_legalform_needregister");
			if(!$legalform_needregister) {$legalform_needregister = ""; }	
			$legalform_journalist = get_option("dsdvo_legalform_journalist", "");
			$legalform_personname_jornalist = get_option("dsdvo_legalform_personname_jornalist", "");
			$legalform_adress_jornalist = get_option("dsdvo_legalform_adress_jornalist", "");
			$legalform_zip_jornalist = get_option("dsdvo_legalform_zip_jornalist", "");
			$legalform_city_jornalist = get_option("dsdvo_legalform_city_jornalist", "");
			$legalform_country_jornalist = get_option("dsdvo_legalform_country_jornalist", "");
			$clause = get_option("dsdvo_clause", "yes");
			$copyright = get_option("dsdvo_copyright", "yes");
			$owntextsimprint = get_option("dsdvo_owntextsimprint", "no");
			$spamemail = get_option("dsdvo_spamemail", "yes");
			$legalform_supervisoryauthority = get_option("dsdvo_legalform_supervisoryauthority");
			if(!$legalform_supervisoryauthority) {$legalform_supervisoryauthority = ""; }	
			$legalform_city = get_option("dsdvo_legalform_city");
			if(!$legalform_city) {$legalform_city = ""; }	
			$legalform_registernumber = get_option("dsdvo_legalform_registernumber");
			if(!$legalform_registernumber) {$legalform_registernumber = ""; }		
			$legalform_chamber = get_option("dsdvo_legalform_chamber");
			if(!$legalform_chamber) {$legalform_chamber = ""; }
			$legalform_ustid = get_option("dsdvo_legalform_ustid");
			if(!$legalform_ustid) {$legalform_ustid = ""; }
			$legalform_wid = get_option("dsdvo_legalform_wid");
			if(!$legalform_wid) {$legalform_wid = ""; }						
			$dsdvo_cookie_text = html_entity_decode(get_option("dsdvo_cookie_text"), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_outgoing_text = html_entity_decode(get_option("dsdvo_outgoing_text"), ENT_COMPAT, get_option('blog_charset'));
			$policy_text_1 = html_entity_decode(get_option("dsdvo_policy_text_1"), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_delete_account_page = get_option("dsdvo_delete_account_page");
			$update_date = get_option("dsdvo_policy_update_date");
			$cookie_not_acceptet_url = get_option("cookie_not_acceptet_url");
			$cookie_not_acceptet_text = get_option("cookie_not_acceptet_text");
			$show_policy = get_option("dsdvo_show_policy");
			$show_outgoing_notice = get_option("dsdvo_show_outgoing_notice");
			$show_rejectbtn = get_option("dsdvo_show_rejectbtn");
			$show_closebtn = get_option("dsdvo_show_closebtn");
			$close_popup_auto = get_option("dsdvo_close_popup_auto");
			$use_dnt = get_option("dsdvo_use_dnt");
			if ($use_dnt == "") { $use_dnt = "on";}
			$show_layertext = get_option("dsdvo_show_layertext", "off");
			$shareaholicsiteid = get_option("dsdvo_shareaholicsiteid");
			$shareaholicappid = get_option("dsdvo_shareaholicappid");
			$gaid = get_option("dsdvo_gaid");
			$gtagmanagerid = get_option("dsdvo_gtagmanagerid");
			$twitterusername = get_option("dsdvo_twitterusername");
			$addthisid = get_option("dsdvo_addthisid");
			$fbpixelid = get_option("dsdvo_fbpixelid");
			$dsgvo_remove_ipaddr_auto = get_option("dsgvo_remove_ipaddr_auto");
			$dsgvo_error_policy_blog = html_entity_decode(get_option("dsgvo_error_policy_blog"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvo_policy_blog_text = html_entity_decode(get_option("dsgvo_policy_blog_text"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvo_pdf_text = html_entity_decode(get_option("dsgvo_pdf_text"), ENT_COMPAT, get_option('blog_charset'));
			$notice_style = get_option("dsgvo_notice_style");
			$animation_time = get_option("dsgvo_animation_time");
			$notice_design = get_option("dsgvo_notice_design");
			$btn_txt_accept = html_entity_decode(get_option("dsgvo_btn_txt_accept"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_customize = html_entity_decode(get_option("dsgvo_btn_txt_customize"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_not_accept = html_entity_decode(get_option("dsgvo_btn_txt_not_accept"), ENT_COMPAT, get_option('blog_charset'));
			$use_facebookcomments = get_option("dsdvo_use_facebookcomments");
			$use_facebooklike = get_option("dsdvo_use_facebooklike");
			$use_addthis = get_option("dsdvo_use_addthis");
			$use_linkedin = get_option("dsdvo_use_linkedin");
			$use_youtube = get_option("dsdvo_use_youtube");
			$use_fbpixel = get_option("dsdvo_use_fbpixel");
			$is_online_shop = get_option("dsdvo_is_online_shop");
			$ga_optinoutsetting = get_option("dsdvo_ga_optinoutsetting");
			$vgwort_optinoutsetting = get_option("dsdvo_vgwort_optinoutsetting");
			$koko_optinoutsetting = get_option("dsdvo_koko_optinoutsetting");
			$use_ga = get_option("dsdvo_use_ga");
			$ga_type = get_option("dsdvo_ga_type");
			$use_piwik = get_option("dsdvo_use_piwik");
			$use_shareaholic = get_option("dsdvo_use_shareaholic");
			$use_gtagmanager = get_option("dsdvo_use_gtagmanager");
			$use_vgwort = get_option("dsdvo_use_vgwort");
			$use_koko = get_option("dsdvo_use_koko");
			$remove_vgwort = get_option("dsdvo_remove_vgwort");
			$remove_gtagmanager = get_option("dsdvo_remove_gtagmanager");
			$use_twitter = get_option("dsdvo_use_twitter");
			$btn_txt_reject = html_entity_decode(get_option("dsgvo_btn_txt_reject"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_not_accept = html_entity_decode(get_option("dsgvo_btn_txt_not_accept"), ENT_COMPAT, get_option('blog_charset'));			
			$auto_accept = get_option("dsdvo_auto_accept");			
			$facebook_policy = html_entity_decode(get_option("dsdvo_facebook_policy"), ENT_COMPAT, get_option('blog_charset'));
			$wordpress_policy = html_entity_decode(get_option("dsdvo_wordpress_policy"), ENT_COMPAT, get_option('blog_charset'));
			$twitter_policy = html_entity_decode(get_option("dsdvo_twitter_policy"), ENT_COMPAT, get_option('blog_charset'));
			$fbpixel_policy = html_entity_decode(get_option("dsdvo_fbpixel_policy"), ENT_COMPAT, get_option('blog_charset'));
			$ga_policy = html_entity_decode(get_option("dsdvo_ga_policy"), ENT_COMPAT, get_option('blog_charset'));
			$piwik_policy = html_entity_decode(get_option("dsdvo_piwik_policy"), ENT_COMPAT, get_option('blog_charset'));
			$gtagmanager_policy = html_entity_decode(get_option("dsdvo_gtagmanager_policy"), ENT_COMPAT, get_option('blog_charset'));
			$vgwort_policy = html_entity_decode(get_option("dsdvo_vgwort_policy"), ENT_COMPAT, get_option('blog_charset'));
			$koko_policy = html_entity_decode(get_option("dsdvo_koko_policy"), ENT_COMPAT, get_option('blog_charset'));
			$youtube_policy = html_entity_decode(get_option("dsdvo_youtube_policy"), ENT_COMPAT, get_option('blog_charset'));
			$youtube_layer = html_entity_decode(get_option("dsdvo_youtube_layer"), ENT_COMPAT, get_option('blog_charset'));
			$vgwort_layer = html_entity_decode(get_option("dsdvo_vgwort_layer"), ENT_COMPAT, get_option('blog_charset'));
			$linkedin_layer = html_entity_decode(get_option("dsdvo_linkedin_layer"), ENT_COMPAT, get_option('blog_charset'));
			$shareaholic_layer = html_entity_decode(get_option("dsdvo_shareaholic_layer"), ENT_COMPAT, get_option('blog_charset'));
			$shareaholic_policy = html_entity_decode(get_option("dsdvo_shareaholic_policy"), ENT_COMPAT, get_option('blog_charset'));
			$linkedin_policy = html_entity_decode(get_option("dsdvo_linkedin_policy"), ENT_COMPAT, get_option('blog_charset'));
			$show_servicecontrol = get_option("dsdvo_show_servicecontrol");
			$position_service_control = get_option("dsgvo_position_service_control");

			$companyformat = html_entity_decode(get_option("dsgvoaiocompanyformat"), ENT_COMPAT, get_option('blog_charset'));

			$dsgvoaiocompanyname = html_entity_decode(get_option("dsgvoaiocompanyname"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaioperson = html_entity_decode(get_option("dsgvoaioperson"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiostreet = html_entity_decode(get_option("dsgvoaiostreet"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiozip = html_entity_decode(get_option("dsgvoaiozip"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiocity = html_entity_decode(get_option("dsgvoaiocity"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiocountry = html_entity_decode(get_option("dsgvoaiocountry"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiophone = html_entity_decode(get_option("dsgvoaiophone"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiofax = html_entity_decode(get_option("dsgvoaiofax"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiomail = html_entity_decode(get_option("dsgvoaiomail"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvoaiousdid = html_entity_decode(get_option("dsgvoaiousdid"), ENT_COMPAT, get_option('blog_charset'));			
			$piwik_phpfile = html_entity_decode(get_option("dsgvo_piwik_phpfile"), ENT_COMPAT, get_option('blog_charset'));
			$piwik_host = html_entity_decode(get_option("dsgvo_piwik_host"), ENT_COMPAT, get_option('blog_charset'));
			$piwik_siteid = html_entity_decode(get_option("dsgvo_piwik_siteid"), ENT_COMPAT, get_option('blog_charset'));

			if ($showpolylangoptions == true or $language == "en") {
			$dsdvo_outgoing_text_en = html_entity_decode(get_option('dsdvo_outgoing_text_en'), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_cookie_text_en = html_entity_decode(get_option('dsdvo_cookie_text_en'), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_cookie_text_scroll_en = html_entity_decode(get_option("dsdvo_cookie_text_scroll_en"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvo_error_policy_blog_en = html_entity_decode(get_option("dsgvo_error_policy_blog_en"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvo_policy_blog_text_en = html_entity_decode(get_option("dsgvo_policy_blog_text_en"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_accept_en = html_entity_decode(get_option("dsgvo_btn_txt_accept_en"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_customize_en = html_entity_decode(get_option("dsgvo_btn_txt_customize_en"), ENT_COMPAT, get_option('blog_charset'));	
			$btn_txt_reject_en = html_entity_decode(get_option("dsgvo_btn_txt_reject_en"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_not_accept_en = html_entity_decode(get_option("dsgvo_btn_txt_not_accept_en"), ENT_COMPAT, get_option('blog_charset'));
			$policy_text_en = html_entity_decode(get_option("dsdvo_policy_text_en"), ENT_COMPAT, get_option('blog_charset'));	
			$wordpress_policy_en = html_entity_decode(get_option("dsdvo_wordpress_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$fbpixel_policy_en = html_entity_decode(get_option("dsdvo_fbpixel_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$facebook_policy_en = html_entity_decode(get_option("dsdvo_facebook_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$twitter_policy_en = html_entity_decode(get_option("dsdvo_twitter_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$ga_policy_en = html_entity_decode(get_option("dsdvo_ga_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$piwik_policy_en = html_entity_decode(get_option("dsdvo_piwik_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$gtagmanager_policy_en = html_entity_decode(get_option("dsdvo_gtagmanager_policy_en"), ENT_COMPAT, get_option('blog_charset'));		
			$vgwort_policy_en = html_entity_decode(get_option("dsdvo_vgwort_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$koko_policy_en = html_entity_decode(get_option("dsdvo_koko_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$youtube_policy_en = html_entity_decode(get_option("dsdvo_youtube_policy_en"), ENT_COMPAT, get_option('blog_charset'));	
			$shareaholic_policy_en = html_entity_decode(get_option("dsdvo_shareaholic_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$linkedin_policy_en = html_entity_decode(get_option("dsdvo_linkedin_policy_en"), ENT_COMPAT, get_option('blog_charset'));		
			$dsgvo_pdf_text_en = html_entity_decode(get_option("dsgvo_pdf_text_en"), ENT_COMPAT, get_option('blog_charset'));
			$youtube_layer_en = html_entity_decode(get_option("dsdvo_youtube_layer_en"), ENT_COMPAT, get_option('blog_charset'));	
			$vgwort_layer_en = html_entity_decode(get_option("dsdvo_vgwort_layer_en"), ENT_COMPAT, get_option('blog_charset'));	
			$linkedin_layer_en = html_entity_decode(get_option("dsdvo_linkedin_layer_en"), ENT_COMPAT, get_option('blog_charset'));	
			$shareaholic_layer_en = html_entity_decode(get_option("dsdvo_shareaholic_layer_en"), ENT_COMPAT, get_option('blog_charset'));	
			
			if (!$dsdvo_cookie_text_en) { $dsdvo_cookie_text_en = "We use technically necessary cookies on our website and external services.<br/>By default, all services are disabled. You can turn or off each service if you need them or not.<br />For more informations please read our privacy policy.";}			
			if (!$dsdvo_outgoing_text_en) { $dsdvo_outgoing_text_en = "<p><b>You are now leaving our Internet presence</b></p><p>As you have clicked on an external link you are now leaving our website.</p><p>If you agree to this, please click on the following button:</p>";}			
			
			}
			

			if ($showpolylangoptions == true or $language == "it") {
			$dsdvo_outgoing_text_it = html_entity_decode(get_option('dsdvo_outgoing_text_it'), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_cookie_text_it = html_entity_decode(get_option('dsdvo_cookie_text_it'), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_cookie_text_scroll_it = html_entity_decode(get_option("dsdvo_cookie_text_scroll_it"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvo_error_policy_blog_it = html_entity_decode(get_option("dsgvo_error_policy_blog_it"), ENT_COMPAT, get_option('blog_charset'));
			$dsgvo_policy_blog_text_it = html_entity_decode(get_option("dsgvo_policy_blog_text_it"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_accept_it = html_entity_decode(get_option("dsgvo_btn_txt_accept_it"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_customize_it = html_entity_decode(get_option("dsgvo_btn_txt_customize_it"), ENT_COMPAT, get_option('blog_charset'));	
			$btn_txt_reject_it = html_entity_decode(get_option("dsgvo_btn_txt_reject_it"), ENT_COMPAT, get_option('blog_charset'));
			$btn_txt_not_accept_it = html_entity_decode(get_option("dsgvo_btn_txt_not_accept_it"), ENT_COMPAT, get_option('blog_charset'));
			$policy_text_it = html_entity_decode(get_option("dsdvo_policy_text_it"), ENT_COMPAT, get_option('blog_charset'));	
			$wordpress_policy_it = html_entity_decode(get_option("dsdvo_wordpress_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$fbpixel_policy_it = html_entity_decode(get_option("dsdvo_fbpixel_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$facebook_policy_it = html_entity_decode(get_option("dsdvo_facebook_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$twitter_policy_it = html_entity_decode(get_option("dsdvo_twitter_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$ga_policy_it = html_entity_decode(get_option("dsdvo_ga_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$piwik_policy_it = html_entity_decode(get_option("dsdvo_piwik_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$gtagmanager_policy_it = html_entity_decode(get_option("dsdvo_gtagmanager_policy_it"), ENT_COMPAT, get_option('blog_charset'));		
			$vgwort_policy_it = html_entity_decode(get_option("dsdvo_vgwort_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$koko_policy_it = html_entity_decode(get_option("dsdvo_koko_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$youtube_policy_it = html_entity_decode(get_option("dsdvo_youtube_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$shareaholic_policy_it = html_entity_decode(get_option("dsdvo_shareaholic_policy_it"), ENT_COMPAT, get_option('blog_charset'));
			$linkedin_policy_it = html_entity_decode(get_option("dsdvo_linkedin_policy_it"), ENT_COMPAT, get_option('blog_charset'));		
			$dsgvo_pdf_text_it = html_entity_decode(get_option("dsgvo_pdf_text_it"), ENT_COMPAT, get_option('blog_charset'));
			$youtube_layer_it = html_entity_decode(get_option("dsdvo_youtube_layer_it"), ENT_COMPAT, get_option('blog_charset'));
			$vgwort_layer_it = html_entity_decode(get_option("dsdvo_vgwort_layer_it"), ENT_COMPAT, get_option('blog_charset'));	
			$linkedin_layer_it = html_entity_decode(get_option("dsdvo_linkedin_layer_it"), ENT_COMPAT, get_option('blog_charset'));	
			$shareaholic_layer_it = html_entity_decode(get_option("dsdvo_shareaholic_layer_it"), ENT_COMPAT, get_option('blog_charset'));
			
			if (!$dsdvo_cookie_text_it) { $dsdvo_cookie_text_it = "Utilizziamo i cookie tecnicamente necessari sul nostro sito web e sui servizi esterni.<br/>Per impostazione predefinita, tutti i servizi sono disabilitati. È possibile disattivare o disattivare ogni servizio se ne avete bisogno o meno.<br /> Per ulteriori informazioni si prega di leggere la nostra informativa sulla privacy.";}			
			if (!$dsdvo_outgoing_text_it) { $dsdvo_outgoing_text_it = "<p><b>Stai lasciando la nostra presenza su Internet</b></p>Quando hai cliccato su un link esterno stai lasciando il nostro sito web.</p><p><p>Se sei d'accordo, clicca sul seguente pulsante:</p>.";}			
			
			}

			
			if (!$notice_style) { $notice_style = "3"; }
			if (!$dsdvo_outgoing_text) { $dsdvo_outgoing_text = "<p><strong>Sie verlassen nun unsere Internetpräsenz</strong></p><p>Da Sie auf einen externen Link geklickt haben verlassen Sie nun unsere Internetpräsenz.</p><p>Sind Sie damit einverstanden so klicken Sie auf den nachfolgenden Button:</p>";}			
			if (!$dsdvo_cookie_text) { $dsdvo_cookie_text = "Wir verwenden technisch notwendige Cookies auf unserer Webseite sowie externe Dienste.<br />Standardmäßig sind alle externen Dienste deaktiviert. Sie können diese jedoch nach belieben aktivieren & deaktivieren.<br/>Für weitere Informationen lesen Sie unsere Datenschutzbestimmungen.";}
			if (!$cookie_not_acceptet_text) { $cookie_not_acceptet_text = "Sie haben die Bedingungen abgelehnt daher werden Sie nun auf eine Seite weitergeleitet die Ihnen alles erklärt.";}
			if (!$cookie_not_acceptet_url) { $cookie_not_acceptet_url = "https://www.wko.at/service/wirtschaftsrecht-gewerberecht/EU-Datenschutz-Grundverordnung:-Auswirkungen-auf-Websites.html";}
			if (!$cookie_time) { $cookie_time = "7"; }


			if ($auto_accept == "on") {
				$auto_accept = "checked='checked'";
			} else {
				$auto_accept = "";
			}				
			
			if (!$update_date) {
				$now = new DateTime();
				$update_date = $now->format('d.m.Y');
			}				
			
			if ($blog_agb == "on") {
				$blog_agb_selected = "checked='checked'";
			} else {
				$blog_agb_selected = "";
			}
			
			if ($show_policy == "on") {
				$show_policy = "checked='checked'";
			} else {
				$show_policy = "";
			}
			
			if ($show_outgoing_notice == "on") {
				$show_outgoing_notice = "checked='checked'";
			} else {
				$show_outgoing_notice = "";
			}			
			
			if ($show_rejectbtn == "on") {
				$show_rejectbtn = "checked='checked'";
			} else {
				$show_rejectbtn = "";
			}	

			if ($show_closebtn == "on") {
				$show_closebtn = "checked='checked'";
			} else {
				$show_closebtn = "";
			}		

			if ($close_popup_auto == "on") {
				$close_popup_auto = "checked='checked'";
			} else {
				$close_popup_auto = "";
			}					

			if ($use_dnt == "on") {
				$use_dnt = "checked='checked'";
			} else {
				$use_dnt = "";
			}	

			if ($show_layertext == "on") {
				$show_layertext = "checked='checked'";
			} else {
				$show_layertext = "";
			}			
			
			if ($use_facebookcomments == "on") {
				$use_facebookcomments = "checked='checked'";
				} else {
				$use_facebookcomments = "";
			}
			
			if ($use_facebooklike == "on") {
				$use_facebooklike = "checked='checked'";
				} else {
					$use_facebooklike = "";
			}
			if ($use_addthis == "on") {
				$use_addthis = "checked='checked'";
				} else {
					$use_addthis = "";
			}
			
			if ($use_linkedin == "on") {
				$use_linkedin = "checked='checked'";
				} else {
					$use_linkedin = "";
			}
			
			if ($use_youtube == "on") {
				$use_youtube = "checked='checked'";
			} else {
				$use_youtube = "";
			}
			
			if ($use_fbpixel == "on") {
				$use_fbpixel = "checked='checked'";
			} else {
				$use_fbpixel = "";
			}
			
			if ($is_online_shop == "on") {
				$is_online_shop = "checked='checked'";
			} else {
				$is_online_shop = "";
			}
			
			if ($show_servicecontrol == "on") {
				$show_servicecontrol = "checked='checked'";
			} else {
				$show_servicecontrol = "";
			}				
			
			if ($use_ga == "on") {
				$use_ga = "checked='checked'";
			} else {
				$use_ga = "";
			}
			
			if ($use_piwik == "on") {
				$use_piwik = "checked='checked'";
			} else {
				$use_piwik = "";
			}			
			
			if ($use_shareaholic == "on") {
				$use_shareaholic = "checked='checked'";
			} else {
				$use_shareaholic = "";
			}			
			
			if ($use_gtagmanager == "on") {
				$use_gtagmanager = "checked='checked'";
			} else {
				$use_gtagmanager = "";
			}			
			
			if ($use_vgwort == "on") {
				$use_vgwort = "checked='checked'";
				} else {
				$use_vgwort = "";
			}		
			
			if ($use_koko == "on") {
				$use_koko = "checked='checked'";
				} else {
				$use_koko = "";
			}				

			if ($remove_vgwort == "on") {
				$remove_vgwort = "checked='checked'";
			} else {
				$remove_vgwort = "";
			}	

			if ($remove_gtagmanager == "on") {
				$remove_gtagmanager = "checked='checked'";
			} else {
				$remove_gtagmanager = "";
			}				
				
			if ($use_twitter == "on") {
				$use_twitter = "checked='checked'";
			} else {
				$use_twitter = "";
			
			}										
			if ($dsgvo_remove_ipaddr_auto == "on") {
				$dsgvo_remove_ipaddr_auto = "checked='checked'";
			} else {
				$dsgvo_remove_ipaddr_auto = "";
			}
			
	} 
 ?>

	<img src="<?php echo plugins_url( '../assets/img/dsgvo_free_logo.png', dirname(__FILE__) ) ?>" class="dsgvoaio_backendlogo"/>
	<h1 class="dsgvoaio_main_h1">&nbsp;</h1>
	<div id="dsdvo_left">

 
	<p style="display: none;font-size: 14px;"><?php echo __("Here you can set up everything about DSGVO All in One.", "dsgvo-all-in-one-for-wp"); ?></p>	<p style="font-size: 14px;"><?php echo __("<b>Important:</b> Please take a short time and go through <u>all</u> fields.", "dsgvo-all-in-one-for-wp"); ?></p>
 	<p style="font-size: 14px;"><?php echo __("It is important to set everything correctly because only then the plugin can do good job.", "dsgvo-all-in-one-for-wp"); ?></p>
	<p style="font-size: 14px;"><?php echo __("<b>Info:</b> The <a href='http://dsgvo-for-wp.com/#shop' target='blank'>PRO Version</a> offers many advantages including premium support and updates.", "dsgvo-all-in-one-for-wp"); ?></p>	 
	<p style="font-size: 14px;"><?php echo __("<b>Need Help?</b> Email to michaelleithold18@gmail.com or via the <a href='https://wordpress.org/support/plugin/dsgvo-all-in-one-for-wp/' target='blank'>WordPress Forum</a>.", "dsgvo-all-in-one-for-wp"); ?></p>	 
	<p style="font-size: 14px;"><?php echo __("<b>Cache:</b> Always clear the cache after each change (browser cache and plugin cache if necessary).", "dsgvo-all-in-one-for-wp"); ?></p>

	<br />
		<form method="post" action="admin.php?page=dsgvoaio-free-settings-page">
	 
			<div id="dsgvoaio-message-container">
			
			<script type="text/javascript">
				jQuery(document).ready(function (){

			jQuery(".dsgvoaio_ga_type_monsterinsights").hide();
			jQuery(".dsgvoaio_ga_type_manual").hide();					
			jQuery(".dsgvoaio_ga_type_analytify").hide();	

			<?php  if (get_option('dsdvo_ga_type', 'manual') == "manual") {  ?>
			jQuery(".dsgvoaio_ga_type_manual").show();
			jQuery(".dsgvoaio_ga_type_monsterinsights").hide();
			jQuery(".dsgvoaio_ga_type_analytify").hide();	
			<?php } else if (get_option('dsdvo_ga_type', 'manual') == "monterinsights") { ?>
			jQuery(".dsgvoaio_ga_type_monsterinsights").show();
			jQuery(".dsgvoaio_ga_type_manual").hide();	
			jQuery(".dsgvoaio_ga_type_analytify").hide();	
			<?php } else if (get_option('dsdvo_ga_type', 'manual') == "analytify") { ?>
			jQuery(".dsgvoaio_ga_type_analytify").show();
			jQuery(".dsgvoaio_ga_type_manual").hide();	
			jQuery(".dsgvoaio_ga_type_monsterinsights").hide();			
			<?php } ?>
			<?php  if ($use_facebookcomments !== "checked='checked'") {  ?>
			jQuery(".facebookcommentswrap").hide();
			<?php } ?>
			<?php  if ($show_rejectbtn !== "checked='checked'") { ?>
			jQuery(".rejectbtnwrap").hide();
			<?php } ?>
			<?php  if ($notice_style !== "1" && $notice_style !== "2" ) { ?>
			jQuery("#dsgvoaio_closebtn_wrap").hide();
			<?php } ?>			
			<?php  if ($show_servicecontrol !== "checked='checked'") { ?>
			jQuery(".servicecontrolwrap").hide();
			<?php } ?>			
			<?php  if ($use_twitter !== "checked='checked'") {  ?>
			jQuery(".twitterwrap").hide();
			<?php } ?>
			<?php  if ($use_ga !== "checked='checked'") {  ?>
			jQuery(".gawrap").hide();
			<?php } ?>
			<?php  if ($use_piwik !== "checked='checked'") {  ?>
			jQuery(".piwikwrap").hide();
			<?php } ?>			
			<?php  if ($use_gtagmanager !== "checked='checked'") {  ?>
			jQuery(".gtagmanagerwrap").hide();
			<?php } ?>			
			<?php  if ($use_vgwort !== "checked='checked'") {  ?>
			jQuery(".vgwortwrap").hide();
			<?php } ?>	
			<?php  if ($use_koko !== "checked='checked'") {  ?>
			jQuery(".kokowrap").hide();
			<?php } ?>				
			<?php  if ($use_facebooklike !== "checked='checked'") {  ?>
			jQuery(".facebooklikewrap").hide();
			<?php } ?>
			<?php  if ($use_fbpixel !== "checked='checked'") {  ?>
			jQuery(".fbpixelwrap").hide();
			<?php } ?>
			<?php  if ($use_linkedin !== "checked='checked'") {  ?>
			jQuery(".linkedinwrap").hide();
			<?php } ?>
			<?php  if ($use_youtube !== "checked='checked'") {  ?>
			jQuery(".youtubewrap").hide();
			<?php } ?>
			<?php  if ($use_addthis !== "checked='checked'") {  ?>
			jQuery(".addthiswrap").hide();
			<?php } ?>
			<?php  if ($show_policy !== "checked='checked'") {  ?>
			jQuery(".showonnoticeon").hide();
			<?php } ?>
			<?php  if ($show_outgoing_notice !== "checked='checked'") {  ?>
			jQuery(".outgoingnoticewrap").hide();
			<?php } ?>			
			<?php  if ($use_gtagmanager !== "checked='checked'") {  ?>
			jQuery(".gtagmanagerwrap").hide();
			<?php } ?>	
			<?php  if ($use_shareaholic !== "checked='checked'") {  ?>
			jQuery(".shareaholicwrap").hide();
			<?php } ?>	
			<?php  if ($blog_agb_selected !== "checked='checked'") {  ?>
			jQuery(".dsgvoaio_blog_policy_wrap").hide();
			<?php } ?>				
			});
			

			</script>
			
				<div class="options" id="dsgvooptions">
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-users"></span><?php echo __("Data of the Owner", "dsgvo-all-in-one-for-wp"); ?> <span style="font-size:13px">(<?php echo __("Address data, Contact details", "dsgvo-all-in-one-for-wp"); ?>)
					<?php if (empty($dsgvoaioperson) or empty($dsgvoaiocity)) { ?>
					<span class="infonodata">[<b><?php echo __("Attention!", "dsgvo-all-in-one-for-wp"); ?></b>&nbsp;<?php echo __("no data set.", "dsgvo-all-in-one-for-wp"); ?>]</span>	
					<?php } ?>
				
	
					</span></a></h2>
					<span class="dsgvooptionsinner">	
					<div class="dsdvo_options">
					<p><b class="blabel"><?php echo __("Company name", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiocompanyname" type="text" name="dsgvoaiocompanyname" value="<?php echo $dsgvoaiocompanyname; ?>"/></p>
					<p><b class="blabel"><?php echo __("Responsible person", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaioperson" type="text" name="dsgvoaioperson" value="<?php echo $dsgvoaioperson; ?>"/></p>
					<p><b class="blabel"><?php echo __("Street & House number", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiostreet" type="text" name="dsgvoaiostreet" value="<?php echo $dsgvoaiostreet; ?>"/></p>
					<p><b class="blabel"><?php echo __("Zip code", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiozip" type="text" name="dsgvoaiozip" value="<?php echo $dsgvoaiozip; ?>"/></p>
					<p><b class="blabel"><?php echo __("City", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiocity" type="text" name="dsgvoaiocity" value="<?php echo $dsgvoaiocity; ?>"/></p>
					<p><b class="blabel"><?php echo __("Country", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiocountry" type="text" name="dsgvoaiocountry" value="<?php echo $dsgvoaiocountry; ?>"/></p>
					<p><b class="blabel"><?php echo __("Phone", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiophone" type="text" name="dsgvoaiophone" value="<?php echo $dsgvoaiophone; ?>"/></p>
					<p><b class="blabel"><?php echo __("Fax", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiofax" type="text" name="dsgvoaiofax" value="<?php echo $dsgvoaiofax; ?>"/></p>					
					<p><b class="blabel"><?php echo __("E-Mail", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiomail" type="text" name="dsgvoaiomail" value="<?php echo $dsgvoaiomail; ?>"/></p>
					<p><b class="blabel"><?php echo __("Vat-ID", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiousdid" type="text" name="dsgvoaiousdid" value="<?php echo __("Is defined under Imprint!", "dsgvo-all-in-one-for-wp"); ?>" readonly/></p>
					<p><span class="dashicons dashicons-info"></span>&nbsp;<?php echo __("The data defined here are used for the privacy policy and for the imprint.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("It is very important that you also define all necessary data under the point Imprint", "dsgvo-all-in-one-for-wp"); ?>.</p>
					</div>		
				
					</span>
					
					
					
					<br />						
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-networking"></span><?php echo __("External Services <span style='font-size:13px'>(Google Analytics, Facebook Pixel & Like, Twitter Tweet Button, Linkedin Button)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					
					<p class="dsdvo_options">
						<span><a href="#" class="services_content" data-tab="analytic"><?php echo __("Visitor counter services / Analytics / Counter", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span class="toggle-indicator" aria-hidden="true"></span></a></span>
					</p>					
					
					<span class="content_analytic dsgvoaio_hide">
					<p class="dsdvo_options">
					<b><?php echo __("Facebook Pixel", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_fbpixel" type="checkbox" name="use_fbpixel" <?php echo $use_fbpixel; ?>/><br />
					<label><?php echo __("Do you use Facebook Pixel?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="fbpixelwrap">					
					<b><?php echo __("Facebook Pixel ID", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
					<input class="dsdvo_input" type="text" name="fbpixelid" value="<?php echo $fbpixelid; ?>" /><br />
					<label>
					<?php echo __("Enter your Facebook Pixel ID here.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Format: 244123839385278", "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<?php echo __("<u>Important:</u> Be sure to deactivate the event setup on Facebook Pixel!", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("For more information see here: <a href='https://dsgvo-for-wp.com/dokumentation/' target='blank'>Plugin Documentation</a>", "dsgvo-all-in-one-for-wp"); ?><br />
					
					</label>
					</span>
					</p>
					
					<br />
					
					<div class="dsdvo_options">
					<b><?php echo __("Google Analytics", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_ga" type="checkbox" name="use_ga" <?php echo $use_ga; ?>/><br />
					<label><?php echo __("Do you use Google Analytics?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="gawrap">
						<span class="dsgvoaio_ga_options">
							<input type="radio" class="dsgvoaio_ga_type" name="ga_type" data-value="manual" value="manual" <?php  if (get_option('dsdvo_ga_type', 'manual') == "manual") { echo "checked"; }  ?>/> 
							<label class="dsgvoaio_bold" for="checkbox-1"><?php echo __("Manual integration (Without Plugin)", "dsgvo-all-in-one-for-wp"); ?></label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" class="dsgvoaio_ga_type" name="ga_type" data-value="monterinsights" value="monterinsights" <?php  if (get_option('dsdvo_ga_type', 'manual') == "monterinsights") { echo "checked"; }  ?>/>	
							<label class="dsgvoaio_bold" for="checkbox-1"><?php echo __("MonsterInsights (WordPress Plugin)", "dsgvo-all-in-one-for-wp"); ?></label>		
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" class="dsgvoaio_ga_type" name="ga_type" data-value="analytify" value="analytify" <?php  if (get_option('dsdvo_ga_type', 'manual') == "analytify") { echo "checked"; }  ?>/>	
							<label class="dsgvoaio_bold" for="checkbox-1"><?php echo __("Analytify (WordPress Plugin)", "dsgvo-all-in-one-for-wp"); ?></label>								
						</span>
					<?php
					$ga_type = get_option('dsdvo_ga_type', 'manual');
					//if ($ga_type == 'manual') {
					?>
					<span class="dsgvoaio_ga_type_manual">
					<b><?php echo __("Google Analytics ID", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
					<input class="dsdvo_input" type="text" name="gaid" placeholder="<?php echo __("Enter you GA ID here...", "dsgvo-all-in-one-for-wp"); ?>" value="<?php echo $gaid; ?>" /><br />
					<label>
					<?php echo __("Enter your Google Analytics ID here.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Format: UA-XXXXXXXXX-X", "dsgvo-all-in-one-for-wp"); ?><br />
					</label>
					<br />
					<b><?php echo __("Standard OptIn / OptOut", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<select  class="dsdvo_input"  name="ga_optinoutsetting">
						<?php
						$ga_optinoutarr = array('optin' => __('OptOut (need consent)', 'dsgvo-all-in-one-for-wp'), 'optout' => __('OptIn *NOT GDPR COMPLIANT* (does not require consent)', 'dsgvo-all-in-one-for-wp'));
						echo $ga_optinoutsetting;
						foreach ($ga_optinoutarr as $key => $ga_optinout) {
							
							//echo $key."#".$ga_optinout."###";
							if (!$ga_optinoutsetting) {
								$ga_optinoutsetting = "optin";
							}
							if ($key == $ga_optinoutsetting) {
								$s = "selected";
							} else {
								$s = "";
							}
							echo "<option value='".$key."' ".$s.">".$ga_optinout."</option>";
						}
						?>
						</select>	
						<br />
						<?php echo __("Determine whether Google Analytics should be accepted on the first visit to the site without the user's consent (OptOut).", "dsgvo-all-in-one-for-wp"); ?><br />
						</span>
						<span class="dsgvoaio_ga_type_monsterinsights">
						<?php if ( is_plugin_active( 'google-analytics-for-wordpress/googleanalytics.php' ) or is_plugin_active( 'google-analytics-premium/googleanalytics-premium.php' ) ) { ?>
								<span style="color: #46b450"><?php echo __("The plugin MonsterInsights was found", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-yes"></span></span><br/>
								<?php echo __("If you activate this option you can use MonsterInsights GDPR compliant (2 click solution).", "dsgvo-all-in-one-for-wp"); ?><br />
								<?php echo __("All settings are taken over by MonsterInsights. There is nothing more to do than to activate this option."); ?>								
						<?php } else { ?>
								<span style="color: red"><?php echo __("The Google Analytics Dashboard Plugin Plugin for WordPress by MonsterInsights was not found.", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-no-alt"></span></span><br />
								<?php echo __("Please make sure that the plugin is installed and activated before you activate this option and save the settings!", "dsgvo-all-in-one-for-wp"); ?>		
						<?php }	?>
						</span>
						<span class="dsgvoaio_ga_type_analytify">
						<?php if ( is_plugin_active( 'wp-analytify/wp-analytify.php' ) ) { ?>
								<span style="color: #46b450"><?php echo __("The plugin Analytify was found", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-yes"></span></span><br/>
								<?php echo __("If you activate this option you can use Analytify GDPR compliant (2 click solution).", "dsgvo-all-in-one-for-wp"); ?><br />
								<?php echo __("All settings are taken over by MonsterInsights. There is nothing more to do than to activate this option."); ?>									
						<?php } else { ?>
								<span style="color: red"><?php echo __("The Google Analytics Dashboard Plugin Plugin for WordPress by Analytify was not found.", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-no-alt"></span></span><br />
								<?php echo __("Please make sure that the plugin is installed and activated before you activate this option and save the settings!", "dsgvo-all-in-one-for-wp"); ?>		
						<?php }	?>
						</span>						
						<?php //} ?>
					</span>
					</div>
					
					<br />	
					
					<p class="dsdvo_options">
					<b><?php echo __("Google Tag Manager", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_gtagmanager" type="checkbox" name="use_gtagmanager" <?php echo $use_gtagmanager; ?>/><br />
					<label><?php echo __("Do you use Google Tag Manager?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="gtagmanagerwrap">
					<b><?php echo __("Google Tag Manager ID", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
					<input class="dsdvo_input gtagmanagerid" type="text" name="gtagmanagerid" value="<?php echo $gtagmanagerid; ?>" /><br />
					<label>
					<?php echo __("Enter your Google Tag Manager ID here.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Format: GTM-XXXXXXX", "dsgvo-all-in-one-for-wp"); ?><br />
					</label>
					<br />
					<b><?php echo __("Replace integration automatically [Beta]", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input remove_gtagmanager" type="checkbox" name="remove_gtagmanager" <?php echo $remove_gtagmanager; ?>/><br />
					<label><?php echo __("Should ALL existing Google Tag Manager integrations be replaced according to GDPR (2 click solution)?", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("All existing integrations of the domain googletagmanager.com are automatically replaced.", "dsgvo-all-in-one-for-wp"); ?>
					</label>
					<br />							
					<br />	
					</span>
					</p>
					
					<br />						
					

					<span class="dsdvo_options">
					<b><?php echo __("VG Wort Pixel", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
					<input  class="dsdvo_input use_vgwort" type="checkbox" name="use_vgwort" <?php echo $use_vgwort; ?>/><br />
					<label><?php echo __("Do yo use VG Wort?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="vgwortwrap">
					<?php echo __("If you use the services of VG Wort, activate this option so that the corresponding policy text is inserted in the privacy policy", "dsgvo-all-in-one-for-wp"); ?>.<br />
					<b><?php echo __("Important", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;<?php echo __("You have to adapt the text of the privacy policy! ([PLEASE CHECK if this is the case with your publisher!])", "dsgvo-all-in-one-for-wp"); ?>
					<br />
					<br />
					<b><?php echo __('Shortcode for embedding VG Wort:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input amazonshortcode" type="text" name="amazonshortcode" value='[dsgvo_vgwort id="XXXXXXXXXXXXXXXX"]' readonly/><br />
					<?php echo __('With the shortcode you can integrate VG Wort GDPR compliant on any desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<b><?php echo __("Standard OptIn / OptOut", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<select  class="dsdvo_input"  name="vgwort_optinoutsetting">
						<?php
						$vgwort_optinoutarr = array('optin' => __('OptOut (need consent)', 'dsgvo-all-in-one-for-wp'), 'optout' => __('OptIn (does not require consent)', 'dsgvo-all-in-one-for-wp'));
						foreach ($vgwort_optinoutarr as $key => $vgwort_optinout) {
							
					
							if (!$vgwort_optinoutsetting) {
								$vgwort_optinoutsetting = "optin";
							}
							if ($key == $vgwort_optinoutsetting) {
								$s = "selected";
							} else {
								$s = "";
							}
							echo "<option value='".$key."' ".$s.">".$vgwort_optinout."</option>";
						}
						?>
						</select>	
						<br />
						<?php echo __("Determine if VG Wort should be accepted on the first visit to the site without the user's consent (OptOut).", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("We do not recommend allowing the service without the user's consent as this is not compliant in our opinion!", "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<b><?php echo __("Replace integrations automatically", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input remove_vgwort" type="checkbox" name="remove_vgwort" <?php echo $remove_vgwort; ?>/><br />
					<label><?php echo __("Should ALL existing integrations of VG Wort GDPR compliant replaced (2 click solution)?", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("All existing integrations of the domain vgwort.de are automatically replaced.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("The plugin \"Worthy\" is supported.", "dsgvo-all-in-one-for-wp"); ?>
					</label>
					<br />							
					<br />					
					
					</span>	
					</span>	
					
					<br />	
					
					
					<span class="dsdvo_options">
					<b><?php echo __("Koko Analytics", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
					<input  class="dsdvo_input use_koko" type="checkbox" name="use_koko" <?php echo $use_koko; ?>/><br />
					<label><?php echo __("Do you use Koko Analytics?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="kokowrap">
					<?php echo __("If you use Koko Analytics activate this option so that the corresponding privacy text is inserted in the privacy policy", "dsgvo-all-in-one-for-wp"); ?>.<br />
					<br />
					<b><?php echo __("Standard OptIn / OptOut", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<select  class="dsdvo_input"  name="koko_optinoutsetting">
						<?php
						$koko_optinoutarr = array('optin' => __('OptOut (need consent)', 'dsgvo-all-in-one-for-wp'), 'optout' => __('OptIn (does not require consent)', 'dsgvo-all-in-one-for-wp'));
						foreach ($koko_optinoutarr as $key => $koko_optinout) {
							
					
							if (!$koko_optinoutsetting) {
								$koko_optinoutsetting = "optin";
							}
							if ($key == $koko_optinoutsetting) {
								$s = "selected";
							} else {
								$s = "";
							}
							echo "<option value='".$key."' ".$s.">".$koko_optinout."</option>";
						}
						?>
						</select>	
						<br />
						<?php echo __("Determine if Koko Analytics should be accepted on the first visit to the site without user consent (OptOut).", "dsgvo-all-in-one-for-wp"); ?><br />

					<br />							
					
					</span>	
					</span>	
					
					<br />					
					
					<p class="dsdvo_options">
						<b><?php echo __("Piwik/Matomo", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="use_piwik" <?php echo $use_piwik; ?>/><br />
						<label><?php echo __("If you want to use Piwik/Matomo on your site check this option and enter all required details", "dsgvo-all-in-one-for-wp"); ?>.</label><br />
						<br />
					<span class="piwikwrap">
					
						<b><?php echo __("Host URL", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<input type="text"  class="dsdvo_input piwik_host" name="piwik_host" value="<?php echo $piwik_host; ?>" placeholder="http://foo.bar/"/><br />
						<label>
						<?php echo __("Enter the host URL of Matomo here (setTrackerUrl)", "dsgvo-all-in-one-for-wp"); ?>.<br />
						<b><?php echo __("Format", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;//foo.bar/ &nbsp;
						(<?php echo __("the Trailing Slash / at the end is important - yes really without http/https/www and without matomo.php at the end", "dsgvo-all-in-one-for-wp"); ?>!)
						</label><br />

						<br />
						<b><?php echo __("Tracker Endpoint", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select name="piwik_phpfile">
							<option value="matomophp" <?php if ($piwik_phpfile == "matomophp") { echo "selected"; } ?>>matomo.php</option>
							<option value="piwikphp" <?php if ($piwik_phpfile == "piwikphp") { echo "selected"; } ?>>piwik.php</option>
						</select><br />
						<label>
						<?php echo __("Select a Endpoint.", "dsgvo-all-in-one-for-wp"); ?>.<br />
						</label>						
						<br />
						
						<b><?php echo __("Site ID", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<input type="number"  class="dsdvo_input piwik_siteid" name="piwik_siteid" value="<?php echo $piwik_siteid; ?>"/><br />
						<label>
						<?php echo __("Enter here the Site ID of Matomo (setSiteId)", "dsgvo-all-in-one-for-wp"); ?>.<br />
						</label>
						<br/>						
						<b><?php echo __("Important", "dsgvo-all-in-one-for-wp"); ?>:</b>					
						<?php echo __("If you use the plugin from Matomo for Wordpress please enter all necessary data here and set in the Matomo plugin settings the setting \"Add tracking code\" to the option \"Disabled\".", "dsgvo-all-in-one-for-wp"); ?>.<br />
						
					</span>
					</p>				
					
					</span>
					
					<br />
					
					
					<p class="dsdvo_options">
						<span><a href="#" class="services_content" data-tab="social"><?php echo __("Social Networks / Sharing", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span class="toggle-indicator" aria-hidden="true"></span></a></span>
					</p>					
					
					<span class="content_social dsgvoaio_hide">		
					
					
					<span class="dsdvo_options">
					
					<b><?php echo __("Shareaholic", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
					<input  class="dsdvo_input use_shareaholic" type="checkbox" name="use_shareaholic" <?php echo $use_shareaholic; ?>/><br />
					<label><?php echo __("Do you use Shareaholic?", "dsgvo-all-in-one-for-wp"); ?></label>
					
					<br /> 
					<br />					
					<span class="shareaholicwrap">
					<b><?php echo __("Site ID", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input shareaholicsiteid" type="text" name="shareaholicsiteid" value="<?php echo $shareaholicsiteid; ?>" /><br />
					<label><?php echo __("Enter the Shareaholic site ID here (SiteId)", "dsgvo-all-in-one-for-wp"); ?>.
					</label>
					<br />
					<br />				
					<b><?php echo __('Shortcode for manual integration of Shareaholic:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input shareaholicshortcode" type="text" name="shareaholicshortcode" value='[dsgvo_shareaholic]' readonly/><br />
					<?php echo __('With the shortcode you can integrate Shareaholic GDPR compliant manually on any desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __('This is not required - Shareaholic is also displayed without the shortcode.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>			
					</span>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Facebook Comments", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_facebookcomments" type="checkbox" name="use_facebookcomments" <?php echo $use_facebookcomments; ?>/><br />
					<label><?php echo __("Do you use Facebook Comments?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="facebookcommentswrap">
					<b><?php echo __('Shortcode for the integration of Facebook Comments:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input amazonshortcode" type="text" name="amazonshortcode" value='[dsgvo_facebook_comments]' readonly/><br />
					<?php echo __('With the shortcode you can integrate Facebook Comments GDPR compliant on any desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Facebook (Like Button)", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_facebooklike" type="checkbox" name="use_facebooklike" <?php echo $use_facebooklike; ?>/><br />
					<label><?php echo __("Do you use Facebook Like Button?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="facebooklikewrap">
					<b><?php echo __('Shortcode for embedding the Facebook Like Button:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input facebooklikeshortcode" type="text" name="facebooklikeshortcode" value='[dsgvo_facebook_like]' readonly/><br />
					<?php echo __('With the shortcode you can integrate the Facebook Like Btton GDPR compliant on every desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Twitter (Tweet Button)", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_twitter" type="checkbox" name="use_twitter" <?php echo $use_twitter; ?>/><br />
					<label><?php echo __("Do you use Twitter?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="twitterwrap">
					<b><?php echo __("Username", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input" type="text" name="twitterusername" class="twitterusername" value="<?php echo $twitterusername; ?>"/><br />
					<br />
					<b><?php echo __('Shortcode for embedding the Tweet Button', "dsgvo-all-in-one-for-wp"); ?></b><br />
					<input class="dsdvo_input twittershortcode" type="text" name="twittershortcode" value='[dsgvo_twitter_button]' readonly/><br />
					<?php echo __('With the shortcode you can integrate the Tweet Button GDPR compliant on every desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					
					
					
					<br />
					<p class="dsdvo_options" style="display: none;">
					<b><?php echo __("AddThis", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_addthis" type="checkbox" name="use_addthis" <?php echo $use_addthis; ?>/><br />
					<label><?php echo __("Do you use AddThis?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br /> 					<br />
					<span class="addthiswrap">
					<b><?php echo __("Your PUB ID", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input" type="text" name="addthisid" class="addthisid" value="<?php echo $addthisid; ?>"/><br />
					<br />
					<b><?php echo __('Shortcode for including the AddThis Button:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input addthisshortcode" type="text" name="twittershortcode" value='[dsgvo_addthis]' readonly/><br />
					<?php echo __('With the shortcode you can integrate the AddThis Button GDPR compliant on every desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Linkedin", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_linkedin" type="checkbox" name="use_linkedin" <?php echo $use_linkedin; ?>/><br />
					<label><?php echo __("Do you use Linkedin?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="linkedinwrap">
					<b><?php echo __('Shortcode for embedding the Linkedin Button:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input addthisshortcode" type="text" name="twittershortcode" value='[dsgvo_linkedin]' readonly/><br />
					<?php echo __('With the shortcode you can integrate the Linkedin Button GDPR compliant on every desired page.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					</span>
					
					<br />
					
					
					<p class="dsdvo_options">
						<span><a href="#" class="services_content" data-tab="video"><?php echo __("Video / Audio Services", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span class="toggle-indicator" aria-hidden="true"></span></a></span>
					</p>					
					
					<span class="content_video dsgvoaio_hide">		
					<p class="dsdvo_options">
					
					<b><?php echo __("Youtube", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
					<input  class="dsdvo_input use_youtube" type="checkbox" name="use_youtube" <?php echo $use_youtube; ?>/><br />
					<label><?php echo __("Do you use Youtube?", "dsgvo-all-in-one-for-wp"); ?></label>
					
					<br /> 
					<br />					
					<span class="youtubewrap">
					<b><?php echo __('Shortcode for embedding Youtube Videos', "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input youtubeshortcode" type="text" name="youtubeshortcode" value='[dsgvo_youtube videoID="Bey4XXJAqS8" thumbnail="true"]' readonly/><br />
					<?php echo __('With the shortcode you can integrate Youtube Videos GDPR/DSGVO compliant on any desired page', "dsgvo-all-in-one-for-wp"); ?>.<br />
					<?php echo __('Additional parameters: width="width" height="height" autoplay="0|1" rel="0|1" thumbnail="true|false|bildurl"<br />(With Thumbnail you can also define your own image. Simply enter the URL)', "dsgvo-all-in-one-for-wp"); ?><br />
					<br />	
					<b><?php echo __('Replace existing embeddings automatically GDPR/DSGVO compliant', "dsgvo-all-in-one-for-wp"); ?>:</b><br />					
					<?php echo __('The PRO Version offers the feature to automatically replace all existing youtube integrations', "dsgvo-all-in-one-for-wp"); ?>.<br />					
					</span>			
					</p>
					</span>
					
					<br />					
					
					<p class="dsdvo_options">
					
					<b><?php echo __("Integrate more external services GDPR compliant such as:", "dsgvo-all-in-one-for-wp"); ?></b><br />
					<br />
					<?php echo __("eTracker, Statcounter, Clicky, Google Adsense, Amazon Ads, Google Maps, Komoot, OpenStreetMap + LeafLetMap, Youtube & Youtube Playlist, Vimeo, Dailymotion, SoundCloud, HearThis, MixCloud, Disqus, Instagram Feed, Facebook Like/Share/Teilen – Kommentare, Facebook Pixel, Printerest, ShareThis, Shareaholic, AddThis, AddToAny, SlideShare, reCAPTCHA, OneSignal, Slimstats + iFrame / Cotent Blocker + 5 zusätzliche Dienste die per JS Code ausgeführt werden bequem über die Einstellungen DSGVO konform nutzen,", "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<b><?php echo __("...in the Pro Version.", "dsgvo-all-in-one-for-wp"); ?></b>
					</p>					
				
					</span>
					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-desktop"></span><?php echo __("Settings Cookie Notice <span style='font-size:13px'>(Cookie Notice, Design/Style, Buttons, Lifetime, Texts)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<div class="dsgvooptionsinner">					
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Notice/Message", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="show_policy" <?php echo $show_policy; ?>/><br />
						<label><?php echo __("Should the Cookie Notice be displayed?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					
					<br />
			
					<span class="showonnoticeon">
			
					
					<p class="dsdvo_options" style="display: none !important;">
						<b><?php echo __("Automatic approval by changing the page", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="auto_accept" <?php echo $auto_accept; ?>/><br />
						<label><?php echo __("Should the cookie and external services be automatically enabled when the user navigates on the site?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					

					<p class="dsdvo_options">
						<b><?php echo __("Service Control", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp; 
						<input  class="dsdvo_input" type="checkbox" name="show_servicecontrol" <?php echo $show_servicecontrol; ?>/><br />
						<label><?php echo __("Should the service control be displayed?", "dsgvo-all-in-one-for-wp"); ?></label>
						<br />
						<span class="servicecontrolwrap">
						<br />
						<b><?php echo __("Position Service Control", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<select name="position_service_control">
							<?php
							$posvalues = array('topleft' => __("Top left", "dsgvo-all-in-one-for-wp"), 'topright' => __("Top right", "dsgvo-all-in-one-for-wp"),'bottomleft' => __("Bottom left", "dsgvo-all-in-one-for-wp"), 'bottomright' => __("Bottom right", "dsgvo-all-in-one-for-wp"));
							foreach ($posvalues as $posvalue => $poskey) {
								?>
								<option value="<?php echo $posvalue; ?>" <?php if ($position_service_control == $posvalue) { echo "selected"; } ?>><?php echo $poskey; ?></option>
								<?php
							} 
							?>
						</select>
						<br />
						<label><?php echo __("In which corner the service control should be displayed?", "dsgvo-all-in-one-for-wp"); ?>?</label>						
						</span>
					</p>

					<br />
					
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Notice Style / Position", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select name="notice_style" id="dsgvoaio_select_style">
							<option value="1" <?php if ($notice_style == 1) { echo "selected";} ?>><?php echo __("#1 Sticky at the bottom of the screen", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="2" <?php if ($notice_style == 2) { echo "selected";} ?>><?php echo __("#2 Overlay over the entire page", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="3" <?php if ($notice_style == 3) { echo "selected";} ?>><?php echo __("#3 Overlay entire page + Privacy Policy *RECOMMENDED*", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="4" <?php if ($notice_style == 4) { echo "selected";} ?> disabled><?php echo __("Block - bottom left corner (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="5" <?php if ($notice_style == 5) { echo "selected";} ?> disabled><?php echo __("Block - bottom right corner (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="6" <?php if ($notice_style == 6) { echo "selected";} ?> disabled><?php echo __("Block - top left corner (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="7" <?php if ($notice_style == 7) { echo "selected";} ?> disabled><?php echo __("Block - top right corner (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>							
						</select><br />
						<label>
						<?php echo __("Select the design/position of the cookie notice.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("<b style='color:orange;'>Very important:</b> We recommend you to choose option #3! This way the user <u>immediately</u> has an overview of the privacy conditions.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Option #3 corresponds to the current GDPR.", "dsgvo-all-in-one-for-wp"); ?>
						</label>
					</p>

					<p class="dsdvo_options">
						<b><?php echo __("Animation Time", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<input type="number" class="dsdvo_input" value="<?php if (isset($animation_time) && $animation_time != "") { echo $animation_time; } else { echo "1000"; } ?>" name="animation_time"/><br />
						<label><?php echo __("Specification in milliseconds (1000 = 1 Second)", "dsgvo-all-in-one-for-wp"); ?>.</label>
						<br />					
					</p>	
	
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Notice Design", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select name="notice_design">
							<option value="dark" <?php if ($notice_design == "dark") { echo "selected";} ?>><?php echo __("Dark - Grey", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="clear" <?php if ($notice_design == "clear") { echo "selected";} ?>><?php echo __("Light - Grey", "dsgvo-all-in-one-for-wp"); ?></option>							
							
						</select><br />
						<label><?php echo __("Select the design of the cookie notice.", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>

					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Button Text (Accept)", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<input class="dsdvo_input" type="text" name="btn_txt_accept" value="<?php if ($btn_txt_accept) {echo $btn_txt_accept;} else { echo "Akzeptieren";}?>" /><br />
						<?php } ?>
						<?php if ($showpolylangoptions == true or $language == "en") { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<input class="dsdvo_input" type="text" name="btn_txt_accept_en" value="<?php if ($btn_txt_accept_en) {echo $btn_txt_accept_en;} else { echo "Accept";}?>" /><br />
						<?php } ?>
						<?php if ($showpolylangoptions == true or $language == "it") { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<input class="dsdvo_input" type="text" name="btn_txt_accept_it" value="<?php if ($btn_txt_accept_it) {echo $btn_txt_accept_it;} else { echo "Accetta";}?>" /><br />
						<?php } ?>						
						<label>
						<?php echo __("Text of the button to accept the conditions", "dsgvo-all-in-one-for-wp"); ?>.<br />
				
						</label>
						
						<br />
						
						<b><?php echo __("Button Text (Personalize)", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<input class="dsdvo_input" type="text" name="btn_txt_customize" value="<?php if ($btn_txt_customize) {echo $btn_txt_customize;} else { echo "Personalisieren";}?>" /><br />
						<?php } ?>
						<?php if ($showpolylangoptions == true or $language == "en") { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<input class="dsdvo_input" type="text" name="btn_txt_customize_en" value="<?php if ($btn_txt_customize_en) {echo $btn_txt_customize_en;} else { echo "Customize";}?>" /><br />
						<?php } ?>		
						<?php if ($showpolylangoptions == true or $language == "it") { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<input class="dsdvo_input" type="text" name="btn_txt_customize_it" value="<?php if ($btn_txt_customize_it) {echo $btn_txt_customize_it;} else { echo "Personalizza";}?>" /><br />
						<?php } ?>	
						
						<label>
						<?php echo __("Text of the button to personalize the opt in / opt out settings", "dsgvo-all-in-one-for-wp"); ?>.<br />
				
						</label>
						
						
					</p>	
					<br />					
					<span class="dsdvo_options">
					<b><?php echo __("Show Reject Button", "dsgvo-all-in-one-for-wp"); ?>?</b>&nbsp;
							<input  class="dsdvo_input" type="checkbox" name="show_rejectbtn" <?php echo $show_rejectbtn; ?>/><br />
							<label><?php echo __("Should the button to reject the conditions be displayed?", "dsgvo-all-in-one-for-wp"); ?></label>
							<br />
							<span class="rejectbtnwrap">
								<p><?php echo __("Info: If no external service is activated the reject button is not displayed!", "dsgvo-all-in-one-for-wp"); ?></p>
								<br />
								<b><?php echo __("Button Text (Reject)", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<input class="dsdvo_input" type="text" name="btn_txt_reject" value="<?php if ($btn_txt_reject) {echo $btn_txt_reject;} else { echo "Ablehnen";}?>" /><br />
								<?php } ?>
								<?php if ($showpolylangoptions == true or $language == "en") { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>
								<input class="dsdvo_input" type="text" name="btn_txt_reject_en" value="<?php if ($btn_txt_reject_en) {echo $btn_txt_reject_en;} else { echo "Reject";}?>" /><br />
								<?php } ?>	
								<?php if ($showpolylangoptions == true or $language == "it") { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>
								<input class="dsdvo_input" type="text" name="btn_txt_reject_it" value="<?php if ($btn_txt_reject_it) {echo $btn_txt_reject_it;} else { echo "Rifiuta";}?>" /><br />
								<?php } ?>									
								<label>
								<?php echo __("Text of the button to reject the conditions", "dsgvo-all-in-one-for-wp"); ?>.<br />
						
								</label>
								
								
								<br />		
						</span>					
					
					
					
					</span>
					<br />					
					<span class="dsdvo_options">
					<b><?php echo __("Close Popup automatically", "dsgvo-all-in-one-for-wp"); ?>?</b>&nbsp;
							<input  class="dsdvo_input" type="checkbox" name="close_popup_auto" <?php echo $close_popup_auto; ?>/><br />
							<label><?php echo __("Should the personalize popup be automatically closed when all services are allowed or denied?", "dsgvo-all-in-one-for-wp"); ?></label>					
					</span>					
					<br />					
					<span class="dsdvo_options" id="dsgvoaio_closebtn_wrap">
					<b><?php echo __("Show close button (X)", "dsgvo-all-in-one-for-wp"); ?>?</b>&nbsp;
							<input  class="dsdvo_input" type="checkbox" name="show_closebtn" <?php echo $show_closebtn; ?>/><br />
							<label><?php echo __("Should the button to close the cookie notice be displayed?", "dsgvo-all-in-one-for-wp"); ?></label>					
					</span>
					<br />						
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Lifetime", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<input class="dsdvo_input" type="text" name="cookie-time" value="<?php echo $cookie_time; ?>" /> <?php echo __("Day(s)", "dsgvo-all-in-one-for-wp"); ?><br />
						<label>
						<?php echo __("How long should the cookie of the cookie consent be stored? (<u>in days!</u>)", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</p>
					
					<br />
					
					<p class="dsdvo_options">
					<b><?php echo __("DNT (Do Not Track)", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input  class="dsdvo_input" type="checkbox" name="use_dnt" <?php echo $use_dnt; ?>/><br />
							<label><?php echo __("Should the Do Not Track setting be respected? We recommend you to respect DNT because only that is GDPR compliant!", "dsgvo-all-in-one-for-wp"); ?></label>
							<br />
					</p>
					
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("OptIn / OptOut Layer Texts", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp; 
						<input  class="dsdvo_input" type="checkbox" name="show_layertext" <?php echo $show_layertext; ?>/><br />
						<label><?php echo __("Should a short privacy policy text be displayed to the user", "dsgvo-all-in-one-for-wp"); ?>?</label>
					</p>	

					<br />
					
					<span class="dsdvo_options">
						<b><?php echo __("Conditions/Consent Text", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="cookietext" title="<?php echo __("Cookie Notice Text neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>						
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( $dsdvo_cookie_text, 'cookie_text', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( $dsdvo_cookie_text_en, 'cookie_text_en', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( $dsdvo_cookie_text_it, 'cookie_text_it', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>						
						<label>
						<?php echo __("Here you can change the text of the cookie notice.", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</span>
				
					<br/>
					
					 <p class="dsdvo_options" style="display: none;">
						<b><?php echo __("Link to page when conditions/cookies are rejected", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<input class="dsdvo_input" type="text" name="cookie_not_acceptet_url" value="<?php echo $cookie_not_acceptet_url; ?>"  /><br />
						<label>
						<?php echo __("If the user does not agree to the terms and conditions and clicks on \"reject\", which page should the user be redirected to? Recommendation: https://www.wko.at/service/wirtschaftsrecht-gewerberecht/EU-Datenschutz-Grundverordnung:-Auswirkungen-auf-Websites.html", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</p>
					
					<br/>
					 <p class="dsdvo_options" style="display:none;">
						<b><?php echo __("Text that should appear when you have rejected the conditions", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<input class="dsdvo_input" type="text" name="cookie_not_acceptet_text" value="<?php echo $cookie_not_acceptet_text; ?>"  /><br />
						<label>
						<?php echo __("If the user does not agree to the terms and conditions and clicks on \"reject\", which page should the user be redirected to? Recommendation: https://www.wko.at/service/wirtschaftsrecht-gewerberecht/EU-Datenschutz-Grundverordnung:-Auswirkungen-auf-Websites.html", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</br>					
					
					</span>
					
					<p class="dsdvo_options">
					
					<b><?php echo __("Comfortably change ALL colors as well as ALL texts?", "dsgvo-all-in-one-for-wp"); ?></b><br />
					<br />
					<?php echo __("No problem at all! In the Pro Version you can change really EVERYTHING comfortably via the settings.", "dsgvo-all-in-one-for-wp"); ?><br />
	
					</p>					
					</div>

					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-lock"></span><?php echo __("Privacy Settings <span style='font-size:13px'>(Privacy Policy, Shortcode)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
						<b><?php echo __("Privacy Policy Page", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select class="dsdvo_input"  name="dsdvo_policy_site[page_id]">
								<?php
								if( $pages = get_pages() ){
									foreach( $pages as $page ){
										echo '<option value="' . $page->ID . '" ' . selected( $page->ID, get_option("dsdvo_policy_site")) . '>' . $page->post_title . '</option>';
									}
								}
								?>
							</select><br />
						<label><?php echo __("Select the page where your privacy policy is located.", "dsgvo-all-in-one-for-wp"); ?></label>
		
					</p>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Shortcode Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
						<input class="dsdvo_input" type="text" value="[dsgvo_policy]" readonly/><br />
						<label>
						<?php echo __("With this shortcode you can embed the privacy policy on a page", "dsgvo-all-in-one-for-wp"); ?>.					
						<br />
						<b><?php echo __("New", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Use the Gutenberg Block instead of the shortcode - to be found in the editor.", "dsgvo-all-in-one-for-wp"); ?>					
						</label>
					</p>					
					<br />
					 <div class="dsdvo_options">
						<b><?php echo __("General Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="mainpolicy" title="<?php echo __("Reload Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>						
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<?php
							$editor_id = 'policy_text_1';
							$content = "";
							$editor_content = "";
							if (!$policy_text_1) {
								$editor_content =  html_entity_decode($policy_demo_text, ENT_COMPAT, get_option('blog_charset'));						
								
							} else {
								$editor_content = html_entity_decode(get_option('dsdvo_policy_text_1'), ENT_COMPAT, get_option('blog_charset'));							
							}
							
							

							wp_editor( stripslashes($editor_content), $editor_id, array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE ) );
						?>
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<br />	
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php
							$editor_id_en = 'policy_text_en';
							//get policy demo text from file
							$content = "";
							$editor_content_en = "";
							if (!$policy_text_en) {
								$editor_content_en =  html_entity_decode($policy_demo_text_en, ENT_COMPAT, get_option('blog_charset'));	
							} else {
								$editor_content_en = html_entity_decode(get_option('dsdvo_policy_text_en'), ENT_COMPAT, get_option('blog_charset'));							
							}
							
							wp_editor( stripslashes($editor_content_en), $editor_id_en, array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE ) );
						?>
						<?php } ?>
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<br />	
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php
							$editor_id_it = 'policy_text_it';
							//get policy demo text from file
							$content = "";
							$editor_content_it = "";
							if (!$policy_text_it) {
								$editor_content_it =  html_entity_decode($policy_demo_text_it, ENT_COMPAT, get_option('blog_charset'));	
							} else {
								$editor_content_it = html_entity_decode(get_option('dsdvo_policy_text_it'), ENT_COMPAT, get_option('blog_charset'));							
							}
							
							wp_editor( stripslashes($editor_content_it), $editor_id_it, array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE ) );
						?>
						<?php } ?>
							
						
						<br />
						<label>
						<?php echo __("Here you can change the text of the privacy policy", "dsgvo-all-in-one-for-wp"); ?>.<br />
						</label>					
					</div>
					<br />
					
					
					<span class="policy_services dsdvo_options" style="display: block">						
							<b><?php echo __("Privacy Policy of WordPress & Plugins", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="wordpress" title="<?php echo __("Reload WordPress Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_wordpress_policy")) {
									$wordpress_policy_editor = get_option("dsdvo_wordpress_policy");
								} else {
									$wordpress_policy_editor = $wordpress_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($wordpress_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'wordpress_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_wordpress_policy_en")) {
									$wordpress_policy_editor_en = get_option("dsdvo_wordpress_policy_en");
								} else {
									$wordpress_policy_editor_en = $wordpress_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($wordpress_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'wordpress_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>	
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_wordpress_policy_it")) {
									$wordpress_policy_editor_it = get_option("dsdvo_wordpress_policy_it");
								} else {
									$wordpress_policy_editor_it = $wordpress_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($wordpress_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'wordpress_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>							
							<?php echo __("This text is automatically inserted at the end of the privacy policy", "dsgvo-all-in-one-for-wp"); ?>.<br />							
							<?php echo __("<b>Important:</b> Make sure that the tag [dsgvoaio_plugins] is present at the end of this text! ", "dsgvo-all-in-one-for-wp"); ?>.<br />							

						<script>
						jQuery( document ).ready(function() {
						
						jQuery(".reset_policy_service").click(function(e) {
							e.preventDefault();
							if (confirm("<?php  echo __("You are sure that you want perform this action?", "dsgvo-all-in-one-for-wp"); ?>")) {

							jQuery.ajax({
								type: 'POST',
								url: '<?php echo admin_url('admin-ajax.php'); ?>',
								data: {
								    'service': jQuery(this).data("service"),
									'action': 'reset_policy_service'
								}, success: function (result) {

								   alert(result);
								   location.reload();
								},
								error: function () {
									alert("<?php  echo __("An error has occurred. Please contact the support.", "dsgvo-all-in-one-for-wp"); ?>");
								}
							});
						}
						});		
						jQuery(".reset_layertext_service").click(function(e) {
							e.preventDefault();
							if (confirm("<?php  echo __("You are sure that you want perform this action?", "dsgvo-all-in-one-for-wp"); ?>")) {

							jQuery.ajax({
								type: 'POST',
								url: '<?php echo admin_url('admin-ajax.php'); ?>',
								data: {
								    'service': jQuery(this).data("service"),
									'action': 'reset_layertext_service'
								}, success: function (result) {

								   alert(result);
								   location.reload();
								},
								error: function () {
									alert("<?php  echo __("An error has occurred. Please contact the support.", "dsgvo-all-in-one-for-wp"); ?>");
								}
							});
						}
						});						
						});						
						</script>					

					
					</span>
					
					<span class="policy_services dsdvo_options" style="display: block">
							<b><?php echo __("Privacy Policy of external Services", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
							<br />
							<?php echo __("Below are the data protection conditions of the external services", "dsgvo-all-in-one-for-wp"); ?>.<br />
							<?php echo __("<b>Info:</b> The data protection conditions of the services activated under point #1 are automatically loaded.", "dsgvo-all-in-one-for-wp"); ?><br />
							<?php echo __("This text or these texts are also automatically added to the Privacy Policy.", "dsgvo-all-in-one-for-wp"); ?>.<br />							
							<br />
			
							<?php if (get_option('dsdvo_use_fbpixel') == "on") { ?> 
							<b><?php echo __("Facebook Pixel", "dsgvo-all-in-one-for-wp"); ?>:</b>						
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="fbpixel" title="<?php echo __("Reload Facebook Pixel Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_fbpixel_policy")) {
									$fbpixel_policy_editor = get_option("dsdvo_fbpixel_policy");
								} else {
									$fbpixel_policy_editor = $fbpixel_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($fbpixel_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'fbpixel_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_fbpixel_policy_en")) {
									$fbpixel_policy_editor_en = get_option("dsdvo_fbpixel_policy_en");
								} else {
									$fbpixel_policy_editor_en = $fbpixel_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($fbpixel_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'fbpixel_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>	
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_fbpixel_policy_it")) {
									$fbpixel_policy_editor_it = get_option("dsdvo_fbpixel_policy_it");
								} else {
									$fbpixel_policy_editor_it = $fbpixel_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($fbpixel_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'fbpixel_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>							
							<?php } ?>	

							<?php if (get_option('dsdvo_use_facebooklike') == "on" or get_option('dsdvo_use_facebookcomments') == "on") { ?> 
							<b><?php echo __("Facebook Like/Comments", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="fb" title="<?php echo __("Reload Facebook Like/Comments Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_facebook_policy")) {
									$facebook_policy_editor = html_entity_decode(stripslashes(get_option("dsdvo_facebook_policy")), ENT_COMPAT, get_option('blog_charset'));
								} else {
									$facebook_policy_editor = html_entity_decode(stripslashes($facebook_policy_sample), ENT_COMPAT, get_option('blog_charset'));
								}
								?>								
								<?php wp_editor($facebook_policy_editor, 'facebook_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_facebook_policy_en")) {
									$facebook_policy_editor_en = html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy_en")), ENT_COMPAT, get_option('blog_charset'));
								} else {
									$facebook_policy_editor_en = html_entity_decode(stripcslashes($facebook_policy_sample_en), ENT_COMPAT, get_option('blog_charset'));
								}
								?>								
								<?php wp_editor($facebook_policy_editor_en, 'facebook_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>	
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_facebook_policy_it")) {
									$facebook_policy_editor_it = html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy_it")), ENT_COMPAT, get_option('blog_charset'));
								} else {
									$facebook_policy_editor_it = html_entity_decode(stripcslashes($facebook_policy_sample_it), ENT_COMPAT, get_option('blog_charset'));
								}
								?>								
								<?php wp_editor($facebook_policy_editor_it, 'facebook_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>								
							<?php } ?>								
							
							<?php if (get_option('dsdvo_use_twitter') == "on") { ?> 
							<b><?php echo __("Twitter", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="twitter" title="<?php echo __("Reload Twitter Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_twitter_policy")) {
									$twitter_policy_editor = get_option("dsdvo_twitter_policy");
								} else {
									$twitter_policy_editor = $twitter_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($twitter_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'twitter_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_twitter_policy_en")) {
									$twitter_policy_editor_en = get_option("dsdvo_twitter_policy_en");
								} else {
									$twitter_policy_editor_en = $twitter_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($twitter_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'twitter_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_twitter_policy_it")) {
									$twitter_policy_editor_it = get_option("dsdvo_twitter_policy_it");
								} else {
									$twitter_policy_editor_it = $twitter_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($twitter_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'twitter_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>								
							<?php } ?>								
							
							
							<?php if (get_option('dsdvo_use_ga') == "on") { ?> 
							<b><?php echo __("Google Analytics", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="ga" title="<?php echo __("Reload Google Analytics Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_ga_policy")) {
									$ga_policy_editor = get_option("dsdvo_ga_policy");
								} else {
									$ga_policy_editor = $ga_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($ga_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'ga_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>		
								<?php
								if (get_option("dsdvo_ga_policy_en")) {
									$ga_policy_editor_en = get_option("dsdvo_ga_policy_en");
								} else {
									$ga_policy_editor_en = $ga_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($ga_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'ga_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>		
								<?php
								if (get_option("dsdvo_ga_policy_it")) {
									$ga_policy_editor_it = get_option("dsdvo_ga_policy_it");
								} else {
									$ga_policy_editor_it = $ga_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($ga_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'ga_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>								
							<?php } ?>	
							
							
							<?php if (get_option('dsdvo_use_gtagmanager') == "on") { ?> 	
							<b><?php echo __("Google Tag Manager", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="gtag" title="<?php echo __("Reload Google Tag Manager Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_gtagmanager_policy")) {
									$gtagmanager_policy_editor = get_option("dsdvo_gtagmanager_policy");
								} else {
									$gtagmanager_policy_editor = $gtagmanager_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($gtagmanager_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'gtagmanager_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>		
								<?php
								if (get_option("dsdvo_gtagmanager_policy_en")) {
									$gtagmanager_policy_editor_en = get_option("dsdvo_gtagmanager_policy_en");
								} else {
									$gtagmanager_policy_editor_en = $gtagmanager_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($gtagmanager_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'gtagmanager_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>	
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>		
								<?php
								if (get_option("dsdvo_gtagmanager_policy_it")) {
									$gtagmanager_policy_editor_it = get_option("dsdvo_gtagmanager_policy_it");
								} else {
									$gtagmanager_policy_editor_it = $gtagmanager_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($gtagmanager_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'gtagmanager_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>								
							<?php } ?>	

							<?php if (get_option('dsdvo_use_piwik') == "on") { ?> 							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<b><?php echo __("Matomo", "dsgvo-all-in-one-for-wp"); ?>:</b>
								<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="matomo" title="<?php echo __("Reload Matomo Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>								
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_piwik_policy")) {
									$piwik_policy_editor = get_option("dsdvo_piwik_policy");
								} else {
									$piwik_policy_editor = $matomo_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($piwik_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'piwik_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_piwik_policy_en")) {
									$piwik_policy_editor_en = get_option("dsdvo_piwik_policy_en");
								} else {
									$piwik_policy_editor_en = $matomo_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($piwik_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'piwik_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>	
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_piwik_policy_it")) {
									$piwik_policy_editor_it = get_option("dsdvo_piwik_policy_it");
								} else {
									$piwik_policy_editor_it = $matomo_policy_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($piwik_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'piwik_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>							
							<?php } ?>							


							<?php if (get_option('dsdvo_use_vgwort') == "on") { ?> 
							<b><?php echo __("VG Wort", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="vgwort" title="<?php echo __("Reload VG Wort Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_vgwort_policy")) {
									$vgwort_policy_editor = get_option("dsdvo_vgwort_policy");
								} else {
									$vgwort_policy_editor = $vgwort_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'vgwort_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_vgwort_policy_en")) {
									$vgwort_policy_editor_en = get_option("dsdvo_vgwort_policy_en");
								} else {
									$vgwort_policy_editor_en = $vgwort_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'vgwort_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_vgwort_policy_it")) {
									$vgwort_policy_editor_it = get_option("dsdvo_vgwort_policy_it");
								} else {
									$vgwort_policy_editor_it = $vgwort_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'vgwort_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>							
							<?php } ?>	


							<?php if (get_option('dsdvo_use_koko') == "on") { ?> 
							<b><?php echo __("Koko Analytics", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="koko" title="<?php echo __("Reload Koko Analytics Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_koko_policy")) {
									$koko_policy_editor = get_option("dsdvo_koko_policy");
								} else {
									$koko_policy_editor = $koko_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($koko_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'koko_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_koko_policy_en")) {
									$koko_policy_editor_en = get_option("dsdvo_koko_policy_en");
								} else {
									$koko_policy_editor_en = $koko_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($koko_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'koko_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_koko_policy_it")) {
									$koko_policy_editor_it = get_option("dsdvo_koko_policy_it");
								} else {
									$koko_policy_editor_it = $koko_policy_sample_it;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($koko_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'koko_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>							
							<?php } ?>							


							<?php if (get_option('dsdvo_use_shareaholic') == "on") { ?> 
							<b><?php echo __("Shareaholic", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="shareaholic" title="<?php echo __("Reload Shareaholic Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>														
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>	
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_shareaholic_policy")) {
									$shareaholic_policy_editor = get_option("dsdvo_shareaholic_policy");
								} else {
									$shareaholic_policy_editor = $shareaholic_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_shareaholic_policy_en")) {
									$shareaholic_policy_editor_en = get_option("dsdvo_shareaholic_policy_en");
								} else {
									$shareaholic_policy_editor_en = $shareaholic_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_shareaholic_policy_it")) {
									$shareaholic_policy_editor_it = get_option("dsdvo_shareaholic_policy_it");
								} else {
									$shareaholic_policy_editor_it = $shareaholic_policy_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>							
							<?php } ?>								
							
							<?php if (get_option('dsdvo_use_linkedin') == "on") { ?> 
							<b><?php echo __("LinkedIn", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="linkedin" title="<?php echo __("Reload LinkedIn Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																					
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>		
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_linkedin_policy")) {
									$linkedin_policy_editor = get_option("dsdvo_linkedin_policy");
								} else {
									$linkedin_policy_editor = $linkedin_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'linkedin_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />	
							<?php } ?>
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_linkedin_policy_en")) {
									$linkedin_policy_editor_en = get_option("dsdvo_linkedin_policy_en");
								} else {
									$linkedin_policy_editor_en = $linkedin_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'linkedin_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>	
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_linkedin_policy_it")) {
									$linkedin_policy_editor_it = get_option("dsdvo_linkedin_policy_it");
								} else {
									$linkedin_policy_editor_it = $linkedin_policy_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'linkedin_policy_it', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>							
							<?php } ?>	


							<?php if (get_option('dsdvo_use_youtube') == "on") { ?> 
							<b><?php echo __("YouTube", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="youtube" title="<?php echo __("Reload Youtube Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																					
							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_youtube_policy")) {
									$youtube_policy_editor = get_option("dsdvo_youtube_policy");
								} else {
									$youtube_policy_editor = $youtube_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($youtube_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'youtube_policy', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
							<?php } ?>					
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_youtube_policy_en")) {
									$youtube_policy_editor_en = get_option("dsdvo_youtube_policy_en");
								} else {
									$youtube_policy_editor_en = $youtube_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($youtube_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'youtube_policy_en', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_youtube_policy_it")) {
									$youtube_policy_editor_it = get_option("dsdvo_youtube_policy_it");
								} else {
									$youtube_policy_editor_it = $youtube_policy_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($youtube_policy_editor_it), ENT_COMPAT, get_option('blog_charset')), 'youtube_policy_it', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>								
							<?php } ?>								
					</span>
					<br />
					</span>
					<br />
					<h2 style="" class="dsgvoheader"><a><span class="dashicons dashicons-text-page"></span><?php echo __("Imprint", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span style="font-size:13px">(<?php echo __('Shortcode / Imprint', "dsgvo-all-in-one-for-wp"); ?>)</span><span class="toggle-indicator" aria-hidden="true"></span></a></h2>
					<span class="dsgvooptionsinner">	
					<div class="dsdvo_options dsgvoaio_imprint">
					<p>
						<b  class="blabel"><?php echo __("Legal form", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<select class="dsdvo_input dsdvo_legalform"  name="dsdvo_legalform[option_id]">
								<?php
								$legalform_options = array(	__("Please select...", "dsgvo-all-in-one-for-wp"),
															__("Stock corporation (AG)", "dsgvo-all-in-one-for-wp"),
															__("Registered association", "dsgvo-all-in-one-for-wp"),
															__("Registered merchant (e.K.)", "dsgvo-all-in-one-for-wp"),
															__("Sole proprietor", "dsgvo-all-in-one-for-wp"),
															__("Freelancer", "dsgvo-all-in-one-for-wp"),
															__("GmbH & Co. KG", "dsgvo-all-in-one-for-wp"),
															__("non-profit GmbH (gGmbH)", "dsgvo-all-in-one-for-wp"),
															__("Civil law partnership (GbR)", "dsgvo-all-in-one-for-wp"),
															__("Limited liability company (GmbH)", "dsgvo-all-in-one-for-wp"),
															__("Limited partnership (KG)", "dsgvo-all-in-one-for-wp"),
															__("Limited partnership on shares (KGaA)", "dsgvo-all-in-one-for-wp"),
															__("General partnership (OHG)", "dsgvo-all-in-one-for-wp"),
															__("Partner company", "dsgvo-all-in-one-for-wp"),
															__("Private person", "dsgvo-all-in-one-for-wp"),
															__("Other", "dsgvo-all-in-one-for-wp"),
															__("Foundation", "dsgvo-all-in-one-for-wp"),
															__("University", "dsgvo-all-in-one-for-wp"),
															__("UG", "dsgvo-all-in-one-for-wp"),
															__("Ltd.", "dsgvo-all-in-one-for-wp"));
								if( $legalform_options ){
									foreach( $legalform_options as $legalform_option_key => $legalform_option ){
										echo '<option value="' . $legalform_option_key . '" ' . selected( $legalform_option_key, get_option("dsdvo_legalform")) . '>' . $legalform_option . '</option>';
									}
								}
								?>
						</select>
						<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __("Select the legal form that suits you.", "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>					
						</p>
					
						<span class="legal_form_first_step">
						<p>
							<b class="blabel"><?php echo __("Responsible person", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input dsgvoaioperson_2" type="text" name="dsgvoaiopersondsgvoaioperson_2" value="<?php echo html_entity_decode(stripslashes($dsgvoaioperson), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>
						</span>

				<div class="legal_form_nocompany">	
						<p>
							<b class="blabel"><?php echo __("Responsible person", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_personname" type="text" name="legalform_personname" value="<?php echo html_entity_decode(stripslashes($dsgvoaioperson), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>					
						<p>
							<b class="blabel"><?php echo __("E-Mail", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_email" type="text" name="legalform_email" value="<?php echo html_entity_decode(stripslashes($dsgvoaiomail), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>				
						<p>
							<b class="blabel"><?php echo __("Phone", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_phone" type="text" name="legalform_phone" value="<?php echo html_entity_decode(stripslashes($dsgvoaiophone), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>		
						<p>
							<b class="blabel"><?php echo __("Fax", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_fax" type="text" name="legalform_fax" value="<?php echo html_entity_decode(stripslashes($dsgvoaiofax), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>							
				</div>
						
						<span class="legal_form_needconsenscontainer">
						<p>
							<b class="blabel"><?php echo __("Regulatory approval", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input type="radio" name="legalform_needconsens" value="yes" <?php if (isset($legalform_needconsens)) { if ($legalform_needconsens == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="legalform_needconsens" value="no" <?php if (isset($legalform_needconsens)) { if ($legalform_needconsens == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Is an official approval required for the exercise of your profession?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>
						</span>
						
						<span class="supervisoryauthoritycontainer">
						<p>
							<b class="blabel"><?php echo __("Regulatory Authority", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_supervisoryauthority" type="text" name="legalform_supervisoryauthority" value="<?php echo html_entity_decode(stripslashes($legalform_supervisoryauthority), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Enter the name of the supervisory authority and in the best case also the address.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>																
						</p>						
						</span>	
						
						<span class="registerentry">
						<p>
							<b class="blabel"><?php echo __("Register entry", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input type="radio" name="legalform_needregister" value="yes" <?php if (isset($legalform_needregister)) { if ($legalform_needregister == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="legalform_needregister" value="no" <?php if (isset($legalform_needregister)) { if ($legalform_needregister == "no") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Is registration in a register required for your company?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>						
						</span>	
						
											
						
						<span class="needconsescontent">
						<p>
						<b class="blabel"><?php echo __("Register", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<select class="dsdvo_input dsdvo_legalform_register"  name="legalform_register[option_id]">
									<?php
									$legalform_register_options = array(	__("Please select...", "dsgvo-all-in-one-for-wp"),
																__("Commercial register", "dsgvo-all-in-one-for-wp"),
																__("Association register", "dsgvo-all-in-one-for-wp"),
																__("Partnership register", "dsgvo-all-in-one-for-wp"),
																__("Cooperatives register", "dsgvo-all-in-one-for-wp"));
									if( $legalform_register_options ){
										foreach( $legalform_register_options as $legalform_register_option_key => $legalform_register_option ){
											echo '<option value="' . $legalform_register_option_key . '" ' . selected( $legalform_register_option_key, get_option("dsdvo_legalform_register")) . '>' . $legalform_register_option . '</option>';
										}
									}
									?>
							</select>						
						</p>
						<p>
							<b class="blabel"><?php echo __("City", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_city" type="text" name="legalform_city" value="<?php echo html_entity_decode(stripslashes($legalform_city), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>						
						<p>
							<b class="blabel"><?php echo __("Register number", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_registernumber" type="text" name="legalform_registernumber" value="<?php echo html_entity_decode(stripslashes($legalform_registernumber), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>
						</span>
						
						
						
					<span class="legal_form_opt2">
						<p>
						<b class="blabel"><?php echo __("Profession with duty to inform", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<select class="dsdvo_input dsdvo_legalform_inforule"  name="legalform_inforule[option_id]">
									<?php
									$legalform_register_options = array(	__("Please select...", "dsgvo-all-in-one-for-wp"),
																__("No", "dsgvo-all-in-one-for-wp"),
																__("Doctor", "dsgvo-all-in-one-for-wp"),
																__("Dentist", "dsgvo-all-in-one-for-wp"),
																__("Architect", "dsgvo-all-in-one-for-wp"),
																__("Tax consultant", "dsgvo-all-in-one-for-wp"),
																__("Lawyer", "dsgvo-all-in-one-for-wp"),
																__("Notary", "dsgvo-all-in-one-for-wp"),
																__("Duditor", "dsgvo-all-in-one-for-wp"),
																__("Pharmacists", "dsgvo-all-in-one-for-wp"));
									if( $legalform_register_options ){
										foreach( $legalform_register_options as $legalform_register_option_key => $legalform_register_option ){
											echo '<option value="' . $legalform_register_option_key . '" ' . selected( $legalform_register_option_key, get_option("dsdvo_legalform_inforule")) . '>' . $legalform_register_option . '</option>';
										}
									}
									?>
							</select>						
						</p>
						
						
						
					</span>		


		<span class="legalform_inforulecontaineryes">
						<p>
							<b class="blabel"><?php echo __("Competent chamber", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_chamber" type="text" name="legalform_chamber" value="<?php echo html_entity_decode(stripslashes($legalform_chamber), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Geben Sie hier den Namen der Kammer ein die für Ihr Unternehmen zuständig ist.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>																
						</p>	
						<p>
							<b class="blabel"><?php echo __("State", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<select class="dsdvo_input legalform_state"  name="legalform_state[option_id]">
									<?php
									$legalform_state_options = array(	__("Please select...", "dsgvo-all-in-one-for-wp"),
																__("Germany", "dsgvo-all-in-one-for-wp"),
																__("Austria", "dsgvo-all-in-one-for-wp"),
																__("Switzerland", "dsgvo-all-in-one-for-wp"));
									if( $legalform_state_options ){
										foreach( $legalform_state_options as $legalform_state_option_key => $legalform_state_option ){
											echo '<option value="' . $legalform_state_option_key . '" ' . selected( $legalform_state_option_key, get_option("dsdvo_legalform_state")) . '>' . $legalform_state_option . '</option>';
										}
									}
									?>
							</select>							</p>	
						
					</span>	
						
					<span class="legalform_inforulecontainer">
						<p>
							<b class="blabel"><?php echo __("Vat-ID", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_ustid" type="text" name="legalform_ustid" value="<?php echo html_entity_decode(stripslashes($legalform_ustid), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>	
						<p>
							<b class="blabel"><?php echo __("Economic ID", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_wid" type="text" name="legalform_wid" value="<?php echo html_entity_decode(stripslashes($legalform_wid), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>							
					</span>	


					<span class="legal_form_jornal">	
					<p>
							<b class="blabel"><?php echo __("Editorial or journalistic content", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="legalform_journalist" value="yes" <?php if (isset($legalform_journalist)) { if ($legalform_journalist == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="legalform_journalist" value="no" <?php if (isset($legalform_journalist)) { if ($legalform_journalist == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Do you publish editorial or journalistic content?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>	
					
					<span class="legal_form_jornal_container">	
						<p>
							<b class="blabel"><?php echo __("Responsible person", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_personname_jornalist" type="text" name="legalform_personname_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_personname_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>					
						<p>
							<b class="blabel"><?php echo __("Street & house number", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_adress_jornalist" type="text" name="legalform_adress_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_adress_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>				
						<p>
							<b class="blabel"><?php echo __("Zip code", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_zip_jornalist" type="text" name="legalform_zip_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_zip_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>		
						<p>
							<b class="blabel"><?php echo __("City", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_city_jornalist" type="text" name="legalform_city_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_city_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
						<p>
							<b class="blabel"><?php echo __("Country", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_country_jornalist" type="text" name="legalform_country_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_country_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('This value is defined under owner data.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>	
					
					
					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Disclaimer", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="clause" value="yes" <?php if (isset($clause)) { if ($clause == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="clause" value="no" <?php if (isset($clause)) { if ($clause == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Should a disclaimer be inserted for contents and links?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>				

					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Copyright", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="copyright" value="yes" <?php if (isset($copyright)) { if ($copyright == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="copyright" value="no" <?php if (isset($copyright)) { if ($copyright == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Should a passage for the copyright be inserted?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>							
	
					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Own texts", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="owntextsimprint" value="yes" <?php if (isset($owntextsimprint)) { if ($owntextsimprint == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="owntextsimprint" value="no" <?php if (isset($owntextsimprint)) { if ($owntextsimprint == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Do you want to add your own texts such as an image source reference or other texts?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>	

					<span class="owntextsimprint_container">	
					
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<?php
							$editor_id_customimprint = "customimprinttext";
							$editor_content = "";
							
							$editor_content = html_entity_decode(get_option('dsdvo_customimprinttext'), ENT_COMPAT, get_option('blog_charset'));

							wp_editor(  stripslashes($editor_content), $editor_id_customimprint, array ('wpautop' => true, 'textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE ) );
						?>
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<br />	
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php
							$editor_id_customimprint_en = "customimprinttext_en";
							$editor_content_en = "";
							$editor_content_en =  html_entity_decode(get_option('dsdvo_customimprinttext_en'), ENT_COMPAT, get_option('blog_charset'));							
							
							
							wp_editor( stripslashes($editor_content_en), $editor_id_customimprint_en, array ('wpautop' => true, 'textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE ) );
						?>
						<?php } ?>
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<br />	
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php
							$editor_id_customimprint_it = "customimprinttext_it";
							$editor_content_it = "";
							$editor_content_it =  html_entity_decode(get_option('dsdvo_customimprinttext_it'), ENT_COMPAT, get_option('blog_charset'));							
							
							
							wp_editor( stripslashes($editor_content_it), $editor_id_customimprint_it, array ('wpautop' => true, 'textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE ) );
						?>
						<?php } ?>
					</span>
	
					<p>
						<b class="blabel"><?php echo __("Shortcode Imprint", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<input class="dsdvo_input" type="text" value="[dsgvo_imprint]" readonly/>						
						<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __("With this shortcode you can embed the imprint on a page", "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						<br />
						<br />
						<b><?php echo __("New", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Use the Gutenberg Block instead of the shortcode - to be found in the editor.", "dsgvo-all-in-one-for-wp"); ?>					
					</p>
					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Spam Protection (Email Adress)", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="spamemail" value="yes" <?php if (isset($spamemail)) { if ($spamemail == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Yes", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="spamemail" value="no" <?php if (isset($spamemail)) { if ($spamemail == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("No", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Should the email address be displayed as graphic instead of text?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>						
				</div>
					</span>							
					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-comments"></span><?php echo __("Privacy settings <span style='font-size:13px'>(Blog comments)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
						<b><?php echo __("Accept Blog Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>:</b> 
						<input  class="dsdvo_input" type="checkbox" name="blog_agb" <?php echo $blog_agb_selected; ?>/><br />
						<label><?php echo __("Should the privacy policy be accepted when creating a blog comment?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					<br />
					<div class="dsgvoaio_blog_policy_wrap">
					<span class="dsdvo_options">
						<b><?php echo __("Text next to the checkbox for acceptance of the privacy policy", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<?php wp_editor( html_entity_decode($dsgvo_policy_blog_text), 'dsgvo_policy_blog_text', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>						
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( html_entity_decode($dsgvo_policy_blog_text_en), 'dsgvo_policy_blog_text_en', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( html_entity_decode($dsgvo_policy_blog_text_it), 'dsgvo_policy_blog_text_it', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>						
						<label><?php echo __("Text to display next to the checkbox of the blog comment form.", "dsgvo-all-in-one-for-wp"); ?></label>
					</span>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Text if the conditions were not accepted", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<textarea class="dsdvo_input" rows="2" cols="10" name="dsgvo_error_policy_blog"><?php echo $dsgvo_error_policy_blog; ?></textarea><br />
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_error_policy_blog_en"><?php echo $dsgvo_error_policy_blog_en; ?></textarea><br />
						<?php } ?>						
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_error_policy_blog_it"><?php echo $dsgvo_error_policy_blog_it; ?></textarea><br />
						<?php } ?>							
						<label><?php echo __("Text to appear if the privacy policy has not been accepted - no HTML allowed!", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					</div>
					<p class="dsdvo_options">
						<b><?php echo __("Delete existing IP addresses", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
						<a href="#" class='button button-primary dsgvo_delete_ip_adresses'><?php echo __("Delete IP addresses", "dsgvo-all-in-one-for-wp"); ?></a><br />
						 <label>
						<?php echo __("Here you can delete the existing IP addresses of already posted comments.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("By clicking on the button Delete IP Addresses all IP addresses are deleted immediately.", "dsgvo-all-in-one-for-wp"); ?>
						</label>
					</p>	
					<p class="dsdvo_options">
						<b><?php echo __("Remove IP addresses automatically", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="dsgvo_remove_ipaddr_auto" <?php echo $dsgvo_remove_ipaddr_auto; ?>/><br />
						 <label>
						<?php echo __("If enabled, the IP addresses of the comments will be anonymized immediately upon sending before saving..", "dsgvo-all-in-one-for-wp"); ?><br />
						</label>
					</p>
					</span>	

					<br />

					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-lock"></span><?php echo __("Texts OptIn OptOut Layer", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span class="toggle-indicator" aria-hidden="true"></span></a></h2>
					<div class="dsgvooptionsinner layertextsdsgvoaio">
					<?php $count = 0; ?>
					<?php if (get_option('dsdvo_show_layertext') != "on") { ?>
						<span class="dsgvoaio_lang_info scnd"><span class="dashicons dashicons-info"></span><?php echo __("You have to activate the option Cookie Notice -> Show OptIn / OutOut Layer texts. Only then the following texts will be used.", "dsgvo-all-in-one-for-wp"); ?></span>																
					<?php } ?>	
					
							<?php if (get_option('dsdvo_use_youtube') == "on") { ?>
							<?php $count = $count+1; ?>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<span class="dsgvoaio_lang_info scnd"><b><?php echo __("Youtube", "dsgvo-all-in-one-for-wp"); ?>:</b><a href="#" class="load_layer_policy" data-service="youtube" title="<?php echo __("Edit Youtube Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-edit"></span></a><a href="#" class="reset_layertext_service" data-service="youtube" title="<?php echo __("Reload Youtube Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																
								<span class="dsgvoaio_inner_tab dsgvoaio_layer_text youtube">
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_youtube_layer")) {
									$youtube_layer_editor = get_option("dsdvo_youtube_layer");
								} else {
									$youtube_layer_editor = $youtube_layer_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($youtube_layer_editor), ENT_COMPAT, get_option('blog_charset')), 'youtube_layer', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
							<?php } ?>					
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_youtube_layer_en")) {
									$youtube_layer_editor_en = get_option("dsdvo_youtube_layer_en");
								} else {
									$youtube_layer_editor_en = $youtube_layer_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($youtube_layer_editor_en), ENT_COMPAT, get_option('blog_charset')), 'youtube_layer_en', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_youtube_layer_it")) {
									$youtube_layer_editor_it = get_option("dsdvo_youtube_layer_it");
								} else {
									$youtube_layer_editor_it = $youtube_layer_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($youtube_layer_editor_it), ENT_COMPAT, get_option('blog_charset')), 'youtube_layer_it', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>
							</span>							
							<?php } ?>	
							
							<?php if (get_option('dsdvo_use_linkedin') == "on") { ?>
							<?php $count = $count+1; ?>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<span class="dsgvoaio_lang_info scnd"><b><?php echo __("Linkedin", "dsgvo-all-in-one-for-wp"); ?>:</b><a href="#" class="load_layer_policy" data-service="linkedin" title="<?php echo __("Edit Linkedin Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-edit"></span></a><a href="#" class="reset_layertext_service" data-service="linkedin" title="<?php echo __("Reload Linkedin Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																
								<span class="dsgvoaio_inner_tab dsgvoaio_layer_text linkedin">
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_linkedin_layer")) {
									$linkedin_layer_editor = get_option("dsdvo_linkedin_layer");
								} else {
									$linkedin_layer_editor = $linkedin_layer_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_layer_editor), ENT_COMPAT, get_option('blog_charset')), 'linkedin_layer', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
							<?php } ?>					
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_linkedin_layer_en")) {
									$linkedin_layer_editor_en = get_option("dsdvo_linkedin_layer_en");
								} else {
									$linkedin_layer_editor_en = $linkedin_layer_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_layer_editor_en), ENT_COMPAT, get_option('blog_charset')), 'linkedin_layer_en', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_linkedin_layer_it")) {
									$linkedin_layer_editor_it = get_option("dsdvo_linkedin_layer_it");
								} else {
									$linkedin_layer_editor_it = $linkedin_layer_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_layer_editor_it), ENT_COMPAT, get_option('blog_charset')), 'linkedin_layer_it', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>
							</span>							
							<?php } ?>							


							<?php if (get_option('dsdvo_use_vgwort') == "on") { ?>
							<?php $count = $count+1; ?>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<span class="dsgvoaio_lang_info scnd"><b><?php echo __("VG Wort", "dsgvo-all-in-one-for-wp"); ?>:</b><a href="#" class="load_layer_policy" data-service="vgwort" title="<?php echo __("Edit VG Wort Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-edit"></span></a><a href="#" class="reset_layertext_service" data-service="vgwort" title="<?php echo __("Reload VG Wort Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																
								<span class="dsgvoaio_inner_tab dsgvoaio_layer_text vgwort">
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_vgwort_layer")) {
									$vgwort_layer_editor = get_option("dsdvo_vgwort_layer");
								} else {
									$vgwort_layer_editor = $vgwort_layer_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_layer_editor), ENT_COMPAT, get_option('blog_charset')), 'vgwort_layer', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
							<?php } ?>					
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_vgwort_layer_en")) {
									$vgwort_layer_editor_en = get_option("dsdvo_vgwort_layer_en");
								} else {
									$vgwort_layer_editor_en = $vgwort_layer_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_layer_editor_en), ENT_COMPAT, get_option('blog_charset')), 'vgwort_layer_en', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_vgwort_layer_it")) {
									$vgwort_layer_editor_it = get_option("dsdvo_vgwort_layer_it");
								} else {
									$vgwort_layer_editor_it = $vgwort_layer_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_layer_editor_it), ENT_COMPAT, get_option('blog_charset')), 'vgwort_layer_it', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>
							</span>							
							<?php } ?>	



							<?php if (get_option('dsdvo_use_shareaholic') == "on") { ?>
							<?php $count = $count+1; ?>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<span class="dsgvoaio_lang_info scnd"><b><?php echo __("Shareaholic", "dsgvo-all-in-one-for-wp"); ?>:</b><a href="#" class="load_layer_policy" data-service="shareaholic" title="<?php echo __("Edit Shareaholic Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-edit"></span></a><a href="#" class="reset_layertext_service" data-service="shareaholic" title="<?php echo __("Reload Shareaholic Layer Text", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																
								<span class="dsgvoaio_inner_tab dsgvoaio_layer_text shareaholic">
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_shareaholic_layer")) {
									$shareaholic_layer_editor = get_option("dsdvo_shareaholic_layer");
								} else {
									$shareaholic_layer_editor = $shareaholic_layer_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_layer_editor), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_layer', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />
							<?php } ?>					
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_shareaholic_layer_en")) {
									$shareaholic_layer_editor_en = get_option("dsdvo_shareaholic_layer_en");
								} else {
									$shareaholic_layer_editor_en = $shareaholic_layer_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_layer_editor_en), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_layer_en', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>		
							<?php if ($language == "it" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_shareaholic_layer_it")) {
									$shareaholic_layer_editor_it = get_option("dsdvo_shareaholic_layer_it");
								} else {
									$shareaholic_layer_editor_it = $shareaholic_layer_sample_it;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_layer_editor_it), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_layer_it', array ('textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => TRUE )); ?>
							<br />		
							<?php } ?>
							</span>							
							<?php } ?>							
					
					</div>		
					
					<br />
					
					<span style="display: none">
					<h2 class="dsgvoheader"><a><?php echo __("#5 Impressum <span style='font-size:13px'>(Shortcode and Text)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
					<b><?php echo __("Does this website have an online store", "dsgvo-all-in-one-for-wp"); ?>?</b>&nbsp;
					<input  class="dsdvo_input" type="checkbox" name="is_online_shop" <?php echo $is_online_shop; ?>/><br />
					
					<br />

					<b class="blabel"><?php echo __("Operator of this website", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input companyformat" type="text" name="companyformat" value="<?php echo $companyformat; ?>"/><br />
					<label><?php echo __("Operator of this website", "dsgvo-all-in-one-for-wp"); ?><br /></label>					
					</p>					
					</span>
					
					<br />
					</span>
					
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-trash"></span><?php echo __("Settings Delete Account <span style='font-size:13px'>(Shortcode for removal)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<?php if ( get_option( 'users_can_register' ) == 0 ) { ?>
					<p class="dsdvo_options">
						<b><?php echo __("INFO", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("The user login is disabled in the WordPress settings. If you do not allow registration you can ignore this point", "dsgvo-all-in-one-for-wp"); ?>.<br />					
					</p>
					<?php } ?>					
					<p class="dsdvo_options">
						<b><?php echo __("Deletion of the user account", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Right to be forgotten", "dsgvo-all-in-one-for-wp"); ?>) <br />
						<input class="dsdvo_input"  type="text"  value="[dsgvo_user_remove_form]" readonly/><br />
						<label>
						<?php echo __("The shortcode for the form to delete the user account including all data.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Paste the shortcode on the page where you want to display the form.", "dsgvo-all-in-one-for-wp"); ?>
						<br />
						<b><?php echo __("New", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Use the Gutenberg Block instead of the shortcode - to be found in the editor.", "dsgvo-all-in-one-for-wp"); ?>										
						</label>
					</p>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Account deletion page", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select class="dsdvo_input"  name="dsdvo_delete_account_page[page_id]">
								<?php
								if( $pages = get_pages() ){
									foreach( $pages as $page ){
										echo '<option value="' . $page->ID . '" ' . selected( $page->ID, get_option("dsdvo_delete_account_page")) . '>' . $page->post_title . '</option>';
									}
								}
								?>
							</select><br />
						<label><?php echo __("Select the page on which the shortcode [dsgvo_user_remove_form] is located.", "dsgvo-all-in-one-for-wp"); ?></label>
		
					</p>
					<br />
					</span>

					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-visibility"></span><?php echo __("Settings User Data Extract <span style='font-size:13px'>(Data Extract Shortcode, PDF Settings)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<?php if ( get_option( 'users_can_register' ) == 0 ) { ?>
					<p class="dsdvo_options">
						<b><?php echo __("INFO", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("The user login is disabled in the WordPress settings. If you do not allow registration you can ignore this point", "dsgvo-all-in-one-for-wp"); ?>.<br />					
					</p>
					<?php } ?>					
					<p class="dsdvo_options">
						<b><?php echo __("Data extract", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Right of information", "dsgvo-all-in-one-for-wp"); ?>) <br />
						<input class="dsdvo_input"  type="text"  value="[dsgvo_show_user_data]" readonly/><br />
						 <label>
						<?php echo __("The shortcode creates an output of all stored data about a user.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Der Shortcode erzeugt eine Ausgabe aller gespeicherten Daten über einen Benutzer.", "dsgvo-all-in-one-for-wp"); ?>
						<br />
						<b><?php echo __("New", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Use the Gutenberg Block instead of the shortcode - to be found in the editor.", "dsgvo-all-in-one-for-wp"); ?>
						</label>
					</p>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("PDF output of the data", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Information Text", "dsgvo-all-in-one-for-wp"); ?>) <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>							
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_pdf_text"  ><?php echo $dsgvo_pdf_text; ?></textarea><br />
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_pdf_text_en"><?php echo $dsgvo_pdf_text_en; ?></textarea><br />
						<?php } ?>						
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_pdf_text_it"><?php echo $dsgvo_pdf_text_it; ?></textarea><br />
						<?php } ?>						
						<label>
						<?php echo __("Enter here the text that you want to appear in the PDF below", "dsgvo-all-in-one-for-wp"); ?>.<br />
						<?php echo __("If you do not want to display any text, leave this field empty", "dsgvo-all-in-one-for-wp"); ?>.
						</label>
					</p>
					<br />
					</span>

					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-generic"></span><?php echo __("Settings Opt in & Out <span style='font-size:13px'>(Shortcode for the output of the current status of the services)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
					<b><?php echo __("Opt in & Out Settings", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Important", "dsgvo-all-in-one-for-wp"); ?>) <br />
					<input class="dsdvo_input"  type="text"  value="[dsgvo_service_control]" readonly/><br />
					<label>
					<?php echo __("The shortcode allows the user to see which opt in / external services he has allowed and which not.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("The user can also change the rights which external services are allowed or not.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Insert the shortcode on the page where you want to display the data.", "dsgvo-all-in-one-for-wp"); ?>
					<br />
					<b><?php echo __("New", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
					<?php echo __("Use the Gutenberg Block instead of the shortcode - to be found in the editor.", "dsgvo-all-in-one-for-wp"); ?>					
					</label>
					</p>
					<br />
					</span>
					
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-links"></span><?php echo __("Outgoing Links <span style='font-size:13px'>(Notice)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
						<b><?php echo __("Enable Notice", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="show_outgoing_notice" <?php echo $show_outgoing_notice; ?>/><br />
						<label><?php echo __("Should a notice appear when clicking on outgoing links?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					
					<br />
			
					<span class="outgoingnoticewrap">
					<span class="dsdvo_options">
						<b><?php echo __("Text of the notice for the outgoing links", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("German", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<?php wp_editor( html_entity_decode($dsdvo_outgoing_text), 'outgoing_text', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>						
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("English", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( html_entity_decode($dsdvo_outgoing_text_en), 'outgoing_text_en', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>
						<?php if ($language == "it" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Italian", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( html_entity_decode($dsdvo_outgoing_text_it), 'outgoing_text_it', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => TRUE ) ); ?>								
						<?php } ?>						
						<label><?php echo __("Text to be displayed to the user as information that he is now leaving the website.", "dsgvo-all-in-one-for-wp"); ?></label>
					</span>					
					</span>	
					<br />
					</span>					
					

			</div>
			 <?php
				wp_nonce_field( 'dsgvo-settings');
				submit_button(__('Save Settings', 'dsgvo-all-in-one-for-wp'), 'button button-primary dsgvoaiosubmit');
			?>
		</form>
	</div>
	</div>
</div><!-- .wrap -->

<div id="dsdvo_right">
	
	<div class="dsgvoaio_active_services">				

		<h2><?php echo __("Cookie Notice", "dsgvo-all-in-one-for-wp"); ?></h2>
		<ul>
			<li>
				<?php echo __("Cookie Notice enabled", "dsgvo-all-in-one-for-wp"); ?>:
				<?php if (get_option("dsdvo_show_policy") == "on") { ?>
					<span class="dashicons dashicons-yes"></span>
				<?php } else { ?>
					<span class="dashicons dashicons-no-alt"></span>
				<?php } ?>
			</li>
			<li>
				<?php echo __("Service Control enabled", "dsgvo-all-in-one-for-wp"); ?>:
				<?php if (get_option("dsdvo_show_servicecontrol") == "on") { ?>
					<span class="dashicons dashicons-yes"></span>
				<?php } else { ?>
					<span class="dashicons dashicons-no-alt"></span>
				<?php } ?>
			</li>
		
			<li>
				<?php		
					if ( is_plugin_active( 'polylang/polylang.php' ) ) {
						$multiactiv = true;
						$multiplugin = "Polylang";
					}

					if ( is_plugin_active( 'translatepress-multilingual/index.php' ) ) {
						$multiactiv = true;
						$multiplugin = "TranslatePress";
					}	
					
					if ( is_plugin_active( 'sitepress-multilingual-cms-master-/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {
						$multiactiv = true;
						$multiplugin = "WPML";
					}	
					
					
					if (isset($multiactiv) && $multiactiv == true) {
						?>
						
						<?php echo __("Multilingualism active", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span style="color:green"><?php echo $multiplugin; ?></span><br />
						
						
						<?php
					}
				?>	
			</li>
		</ul>
	</div>
	
<br />

	<?php
		global $wpdb;
		$shortcodecount = 0;
		/**Query Shortcode**/
		$resultblockoioo = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%wp:dsgvo-all-in-one-for-wp/opt-in-out%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );					
		$resultoioo = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%[dsgvo_service_control]%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );
		  if (isset($resultoioo) or isset($resultblockoioo)) {
			  if (count($resultoioo) > 0){
			   $dsgvo_opt_in_and_out_status = '<span class="dashicons dashicons-yes"></span>';
			    $shortcodecount++;
			  } else {
					$dsgvo_opt_in_and_out_status = '<span class="dashicons dashicons-no-alt"></span>';
					if (count($resultblockoioo) > 0){
						$dsgvo_opt_in_and_out_status = '<span class="dashicons dashicons-yes"></span>';
						$shortcodecount++;
					} else {
						$dsgvo_opt_in_and_out_status = '<span class="dashicons dashicons-no-alt"></span>';
					}				  
			  }

		  }		  

		if ( get_option( 'users_can_register' ) == 1 ) {
		$resultblockurf = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%wp:dsgvo-all-in-one-for-wp/remove-user-data%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );					
		$resulturf = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%[dsgvo_user_remove_form]%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );
		  if (isset($resulturf) or isset($resultblockurf)) {
			  if (count($resulturf) > 0){
				$dsgvo_user_remove_form_status = '<span class="dashicons dashicons-yes"></span>';
				$shortcodecount++;
			  } else {
					$dsgvo_user_remove_form_status = '<span class="dashicons dashicons-no-alt"></span>';
					if (count($resultblockurf) > 0){
						$dsgvo_user_remove_form_status = '<span class="dashicons dashicons-yes"></span>';
						$shortcodecount++;
					} else {
						$dsgvo_user_remove_form_status = '<span class="dashicons dashicons-no-alt"></span>';
					}					  
			  }
		  }

		$resultblocksud = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%wp:dsgvo-all-in-one-for-wp/show-user-data%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );							
		$resultsud = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%[dsgvo_show_user_data]%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );		 
		 if (isset($resultsud) or isset($resultblocksud)) {
			  if (count($resultsud) > 0){
					$dsgvo_show_user_data_status = '<span class="dashicons dashicons-yes"></span>';
					$shortcodecount++;
				} else {
					$dsgvo_show_user_data_status = '<span class="dashicons dashicons-no-alt"></span>';
					if (count($resultblocksud) > 0){
						$dsgvo_show_user_data_status = '<span class="dashicons dashicons-yes"></span>';
						$shortcodecount++;
					} else {
						$dsgvo_show_user_data_status = '<span class="dashicons dashicons-no-alt"></span>';
					}				  
			  }
		  }
		}
		
		$resultpolicy = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%[dsgvo_policy]%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );
		$resultblockpolicy = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%wp:dsgvo-all-in-one-for-wp/privacy-policy%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );		
		if (isset($resultpolicy) or isset($resultblockpolicy)) {
			if (count($resultpolicy) > 0){
				$dsgvo_policy_status = '<span class="dashicons dashicons-yes"></span>';
				$shortcodecount++;
			} else {
				$dsgvo_policy_status = '<span class="dashicons dashicons-no-alt"></span>';
				if (count($resultblockpolicy) > 0){
					$dsgvo_policy_status = '<span class="dashicons dashicons-yes"></span>';
					$shortcodecount++;
				} else {
					$dsgvo_policy_status = '<span class="dashicons dashicons-no-alt"></span>';
				}	
			}  
		}	
		
		$resultblockimprint = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%wp:dsgvo-all-in-one-for-wp/imprint%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );		
		$resultimprint = $wpdb->get_results( "SELECT * FROM $wpdb->posts WHERE post_content LIKE '%[dsgvo_imprint]%' AND post_type LIKE  '%page%' AND post_status LIKE  '%publish%'" );
		if (isset($resultimprint) or isset($resultblockimprint)) {	
			if (count($resultimprint) > 0){
				$dsgvo_imprint_status = '<span class="dashicons dashicons-yes"></span>';
				$shortcodecount++;
			} else {
				$dsgvo_imprint_status = '<span class="dashicons dashicons-no-alt"></span>';
				if (count($resultblockimprint) > 0){
					$dsgvo_imprint_status = '<span class="dashicons dashicons-yes"></span>';
					$shortcodecount++;
				} else {
					$dsgvo_imprint_status = '<span class="dashicons dashicons-no-alt"></span>';
				}			
			}
		}

	
	?>

		<div>
			<h2>Shortcode Check</h2>
				<ul>
					<?php if (isset($dsgvo_policy_status)) { ?>
						<li><?php echo __("Privacy Policy", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_policy_status; ?></li>
					<?php } ?>
					<?php if (isset($dsgvo_imprint_status)) { ?>
						<li><?php echo __("Imprint", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_imprint_status; ?></li>
					<?php } ?>		
					<?php if ( get_option( 'users_can_register' ) == 1 ) { ?>
					<?php if (isset($dsgvo_user_remove_form_status)) { ?>
						<li><?php echo __("User data deletion", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_user_remove_form_status; ?></li>
					<?php } ?>
					<?php if (isset($dsgvo_show_user_data_status)) { ?>
						<li><?php echo __("User data overview", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_show_user_data_status; ?></li>
					<?php } ?>	
					<?php } ?>
					<?php if (isset($dsgvo_opt_in_and_out_status)) { ?>
						<li><?php echo __("Opt in & Out overview", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_opt_in_and_out_status; ?></li>
					<?php } ?>
				</ul>
				<?php if ( get_option( 'users_can_register' ) == 1 ) { ?>
				<p <?php if ($shortcodecount > 5 or $shortcodecount == 5) { echo "style='display:none;'"; } ?>><u><?php echo __("Insert all shortcodes on pages", "dsgvo-all-in-one-for-wp"); ?>!</u></p>
				<?php } else { ?>
				<p <?php if ($shortcodecount > 3 or $shortcodecount == 3) { echo "style='display:none;'"; } ?>><u><?php echo __("Insert all shortcodes on pages", "dsgvo-all-in-one-for-wp"); ?>!</u></p>
				<?php } ?>
		</div>
		
<br />

	<div class="dsgvoaio_active_services">				
					
		<h2><?php echo __("Activated Services", "dsgvo-all-in-one-for-wp"); ?></h2>
			
			<ul>
			<?php if (get_option("dsdvo_use_fbpixel") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Facebook Pixel", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_ga") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Google Analytics", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_piwik") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Matomo (Piwik)", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_gtagmanager") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Google Tag Manager", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_vgwort") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("VG Wort", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_koko") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Koko Analytics", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>			
			<?php if (get_option("dsdvo_use_gatag") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Google Analytics (gtag.js)", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_facebookcomments") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Facebook Comments", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_facebooklike") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Facebook Like/Share", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_twitter") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Twitter", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_shareaholic") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Shareaholic", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_linkedin") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("LinkedIn", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			</ul>
		
		</div>
<br />

	<h2>Systemcheck</h2>
		<ul>
			<li><?php echo __("max_input_vars", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo ini_get("max_input_vars"); ?>&nbsp;(<?php echo __("4000", "dsgvo-all-in-one-for-wp"); ?>)</li>
			<li><?php echo __("max_execution_time", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo ini_get("max_execution_time"); ?>&nbsp;(<?php echo __("300", "dsgvo-all-in-one-for-wp"); ?>)</li>
			<li><?php echo __("max_input_time", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo ini_get("max_input_time"); ?>&nbsp;(<?php echo __("60", "dsgvo-all-in-one-for-wp"); ?>)</li>
			<li><?php echo __("The values in brackets are the recommended values. If these values are not reached <u>can</u> problems may occur when saving the settings.", "dsgvo-all-in-one-for-wp"); ?></li>
		</ul>
		
<br />

	<h2><?php echo __("Many more Options....", "dsgvo-all-in-one-for-wp"); ?></h2>
	<?php $plugin_dir_path = dirname(__FILE__); ?>
	<a href="https://dsgvo-for-wp.com?dsgvoaiofree" target="_blank">
	<?php
	if (!isset($language)) $language = wf_get_language();
	if ($language == "de") {
	?>
	<img src="<?php echo  plugins_url( '../assets/img/pro.png', dirname(__FILE__) ) ?>"/>
	<?php } else { ?>
	<img src="<?php echo  plugins_url( '../assets/img/pro_en.png', dirname(__FILE__) ) ?>"/>
	<?php } ?>
	</a>
	
	
	<h2><?php echo __("Rate this Plugin....", "dsgvo-all-in-one-for-wp"); ?></h2>
	<?php $plugin_dir_path = dirname(__FILE__); ?>
	<a href="https://wordpress.org/support/plugin/dsgvo-all-in-one-for-wp/reviews/#new-post" target="_blank">
	<span class="starscontent">
		<span class="stars"><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span></span>
		<p><?php echo __("If you like the plugin, we would be very pleased about an review.", "dsgvo-all-in-one-for-wp"); ?><br />
		<?php echo __("This does not take long and so you can appreciate our work.", "dsgvo-all-in-one-for-wp"); ?><br /><br />
		<?php echo __("Before you give a bad review, describe your problems in the Support Forum.", "dsgvo-all-in-one-for-wp"); ?>
		</p>
		<span class="rateplugin button button-primary"><?php echo __("Rate Plugin", "dsgvo-all-in-one-for-wp"); ?></span>
	</span>
	</a>
</div>