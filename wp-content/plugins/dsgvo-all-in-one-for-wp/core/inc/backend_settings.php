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
			<p><?php echo __("Sind Sie sicher das Sie das Plugin inklusive aller gespeicherten Einstellungen löschen wollen?", "dsgvo-all-in-one-for-wp"); ?></p>
			<p><?php echo __("Die Einstellungen können nicht wiederhergestellt werden!", "dsgvo-all-in-one-for-wp"); ?></p>
			<a href="" class="button button-primary"><?php echo __("Plugin inklusive aller Einstellungen löschen", "dsgvo-all-in-one-for-wp"); ?></a>
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
		
			if (isset($_POST["dsdvo_delete_account_page"]["page_id"])) { $dsdvo_delete_account_page = sanitize_text_field($_POST["dsdvo_delete_account_page"]["page_id"]);	} else { $dsdvo_delete_account_page = ""; }						
			if (isset($_POST["cookie_not_acceptet_url"])) { $cookie_not_acceptet_url = sanitize_text_field($_POST["cookie_not_acceptet_url"]);	} else { $cookie_not_acceptet_url = ""; }			
			
			if (isset($_POST["cookie_not_acceptet_text"])) { $cookie_not_acceptet_text = sanitize_text_field($_POST["cookie_not_acceptet_text"]);	} else { $cookie_not_acceptet_text = ""; }						
			if (isset($_POST["show_policy"])) { $show_policy = sanitize_text_field($_POST["show_policy"]);	} else { $show_policy = ""; }			
			if (isset($_POST["show_rejectbtn"])) { $show_rejectbtn = sanitize_text_field($_POST["show_rejectbtn"]);	} else { $show_rejectbtn = ""; }						
			if (isset($_POST["use_dnt"])) { $use_dnt = sanitize_text_field($_POST["use_dnt"]);	} else { $use_dnt = ""; }									
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
			if (isset($_POST["use_ga"])) { $use_ga = sanitize_text_field($_POST["use_ga"]);	} else { $use_ga = ""; }	
			if (isset($_POST["ga_type"])) { $ga_type = sanitize_text_field($_POST["ga_type"]);	} else { $ga_type = ""; }	
			if (isset($_POST["use_piwik"])) { $use_piwik = sanitize_text_field($_POST["use_piwik"]);	} else { $use_piwik = ""; }				
			if (isset($_POST["use_shareaholic"])) { $use_shareaholic = sanitize_text_field($_POST["use_shareaholic"]);	} else { $use_shareaholic = ""; }
			if (isset($_POST["use_gtagmanager"])) { $use_gtagmanager = sanitize_text_field($_POST["use_gtagmanager"]);	} else { $use_gtagmanager = ""; }	
			if (isset($_POST["use_vgwort"])) { $use_vgwort = sanitize_text_field($_POST["use_vgwort"]);	} else { $use_vgwort = ""; }		
			if (isset($_POST["remove_vgwort"])) { $remove_vgwort = sanitize_text_field($_POST["remove_vgwort"]);	} else { $remove_vgwort = ""; }			
			if (isset($_POST["remove_gtagmanager"])) { $remove_gtagmanager = sanitize_text_field($_POST["remove_gtagmanager"]);	} else { $remove_gtagmanager = ""; }						
			if (isset($_POST["use_twitter"])) { $use_twitter = sanitize_text_field($_POST["use_twitter"]);	} else { $use_twitter = ""; }						
			if (isset($_POST["btn_txt_reject"])) { $btn_txt_reject = sanitize_text_field($_POST["btn_txt_reject"]);	} else { $btn_txt_reject = ""; }			
			//if (isset($_POST["btn_txt_reject_text"])) { $btn_txt_reject_text = sanitize_text_field($_POST["btn_txt_reject_text"]);	} else { $btn_txt_reject_text = ""; }						
			//if (isset($_POST["btn_txt_reject_url"])) { $btn_txt_reject_url = sanitize_text_field($_POST["btn_txt_reject_url"]);	} else { $btn_txt_reject_url = ""; }						
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
				
			
			if ($showpolylangoptions == true or $language == "en") {
				
				if (isset($_POST["cookie_text_en"])) { $dsdvo_cookie_text_en = stripslashes($_POST["cookie_text_en"]);	} else { $dsdvo_cookie_text_en = ""; }			
				if (isset($_POST["cookie_text_scroll_en"])) { $dsdvo_cookie_text_scroll_en = htmlentities(stripslashes($_POST["cookie_text_scroll_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $dsdvo_cookie_text_scroll_en = ""; }			
				if (isset($_POST["dsgvo_policy_blog_text_en"])) { $dsgvo_policy_blog_text_en = stripslashes($_POST["dsgvo_policy_blog_text_en"]);	} else { $dsgvo_policy_blog_text_en = ""; }			
				if (isset($_POST["dsgvo_error_policy_blog_en"])) { $dsgvo_error_policy_blog_en = stripslashes($_POST["dsgvo_error_policy_blog_en"]);	} else { $dsgvo_error_policy_blog_en = ""; }			
				if (isset($_POST["btn_txt_accept_en"])) { $btn_txt_accept_en = htmlentities(stripslashes($_POST["btn_txt_accept_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_accept_en = ""; }			
				if (isset($_POST["btn_txt_customize_en"])) { $btn_txt_customize_en = htmlentities(stripslashes($_POST["btn_txt_customize_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_customize_en = ""; }			
				if (isset($_POST["btn_txt_reject_en"])) { $btn_txt_reject_en = htmlentities(stripslashes($_POST["btn_txt_reject_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_reject_en = ""; }			
				//if (isset($_POST["btn_txt_reject_text_en"])) { $btn_txt_reject_text_en = htmlentities(stripslashes($_POST["btn_txt_reject_text_en"]));	} else { $btn_txt_reject_text_en = ""; }			
				if (isset($_POST["btn_txt_not_accept_en"])) { $btn_txt_not_accept_en = htmlentities(stripslashes($_POST["btn_txt_not_accept_en"]), ENT_COMPAT, get_option('blog_charset'));	} else { $btn_txt_not_accept_en = ""; }			
				if (isset($_POST["policy_text_en"])) { $policy_text_en = htmlentities(stripslashes($_POST["policy_text_en"]));	} else { $policy_text_en = ""; }			
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
				
			}
			
			if ($showpolylangoptions == true or $language == "en") {
				
				if (isset($_POST["cookie_text_en"])) { update_option("dsdvo_cookie_text_en", htmlentities(stripslashes($_POST["cookie_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}			
				if (isset($_POST["cookie_text_scroll_en"])) { update_option("dsdvo_cookie_text_scroll_en", htmlentities(stripslashes($_POST["cookie_text_scroll_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["dsgvo_policy_blog_text_en"])) { update_option("dsgvo_policy_blog_text_en", htmlentities(stripslashes($_POST["dsgvo_policy_blog_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["dsgvo_error_policy_blog_en"])) { update_option("dsgvo_error_policy_blog_en", htmlentities(stripslashes($_POST["dsgvo_error_policy_blog_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_accept_en"])) { update_option("dsgvo_btn_txt_accept_en", htmlentities(stripslashes($_POST["btn_txt_accept_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_customize_en"])) { update_option("dsgvo_btn_txt_customize_en", htmlentities(stripslashes($_POST["btn_txt_customize_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["btn_txt_reject_en"])) { update_option("dsgvo_btn_txt_reject_en", htmlentities(stripslashes($_POST["btn_txt_reject_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				//if (isset($_POST["btn_txt_reject_text_en"])) { update_option("dsgvo_btn_txt_reject_text_en", htmlentities(stripslashes($_POST["btn_txt_reject_text_en"])));	}		
				if (isset($_POST["btn_txt_not_accept_en"])) { update_option("dsgvo_btn_txt_not_accept_en", htmlentities(stripslashes($_POST["btn_txt_not_accept_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["policy_text_en"])) { update_option("dsdvo_policy_text_en", htmlentities(stripslashes($_POST["policy_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["fbpixel_policy_en"])) { update_option("dsdvo_fbpixel_policy_en", htmlentities(stripslashes($_POST["fbpixel_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["facebook_policy_en"])) { update_option("dsdvo_facebook_policy_en", htmlentities(stripslashes($_POST["facebook_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["wordpress_policy_en"])) { update_option("dsdvo_wordpress_policy_en", htmlentities(stripslashes($_POST["wordpress_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["twitter_policy_en"])) { update_option("dsdvo_twitter_policy_en", htmlentities(stripslashes($_POST["twitter_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["ga_policy_en"])) { update_option("dsdvo_ga_policy_en", htmlentities(stripslashes($_POST["ga_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["piwik_policy_en"])) { update_option("dsdvo_piwik_policy_en", htmlentities(stripslashes($_POST["piwik_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
				if (isset($_POST["gtagmanager_policy_en"])) { update_option("dsdvo_gtagmanager_policy_en", htmlentities(stripslashes($_POST["gtagmanager_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["vgwort_policy_en"])) { update_option("dsdvo_vgwort_policy_en", htmlentities(stripslashes($_POST["vgwort_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}						
				if (isset($_POST["shareaholic_policy_en"])) { update_option("dsdvo_shareaholic_policy_en", htmlentities(stripslashes($_POST["shareaholic_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}										
				if (isset($_POST["linkedin_policy_en"])) { update_option("dsdvo_linkedin_policy_en", htmlentities(stripslashes($_POST["linkedin_policy_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}										
				if (isset($_POST["dsgvo_pdf_text_en"])) { update_option("dsgvo_pdf_text_en", htmlentities(stripslashes($_POST["dsgvo_pdf_text_en"]), ENT_COMPAT, get_option('blog_charset')), false);	}		

			}				

			//update - create options
			if (isset($_POST["cookie-time"])) { update_option("dsdvo_cookie_time", htmlentities(stripslashes($_POST["cookie-time"])), false);	}		
			if (isset($_POST["blog_agb"])) { update_option("dsdvo_blog_agb", htmlentities(stripslashes($_POST["blog_agb"]), ENT_COMPAT, get_option('blog_charset')), false);	} else { update_option("dsdvo_blog_agb", "", false); }		
			if (isset($_POST["dsdvo_policy_site"]["page_id"])) { update_option("dsdvo_policy_site", htmlentities(stripslashes($_POST["dsdvo_policy_site"]["page_id"])), false);	}		
			if (isset($_POST["dsdvo_legalform"]["option_id"])) { update_option("dsdvo_legalform", htmlentities(stripslashes($_POST["dsdvo_legalform"]["option_id"]), ENT_COMPAT, get_option('blog_charset')), false);	} else { update_option("dsdvo_legalform", "", false); }		
			if (isset($_POST["legalform_register"]["option_id"])) { update_option("dsdvo_legalform_register", htmlentities(stripslashes($_POST["legalform_register"]["option_id"])), false);	}		
			if (isset($_POST["legalform_inforule"]["option_id"])) { update_option("dsdvo_legalform_inforule", htmlentities(stripslashes($_POST["legalform_inforule"]["option_id"])), false);	}		
			if (isset($_POST["legalform_state"]["option_id"])) { update_option("dsdvo_legalform_state", htmlentities(stripslashes($_POST["legalform_state"]["option_id"])), false);	}		
			if (isset($_POST["legalform_needconsens"])) { update_option("dsdvo_legalform_needconsens", htmlentities(stripslashes($_POST["legalform_needconsens"])), false);	}		
			if (isset($_POST["legalform_needregister"])) { update_option("dsdvo_legalform_needregister", htmlentities(stripslashes($_POST["legalform_needregister"])), false);	}		
			if (isset($_POST["legalform_journalist"])) { update_option("dsdvo_legalform_journalist", htmlentities(stripslashes($_POST["legalform_journalist"])), false);	}		
			if (isset($_POST["legalform_personname_jornalist"])) { update_option("dsdvo_legalform_personname_jornalist", htmlentities(stripslashes($_POST["legalform_personname_jornalist"])), false);	}		
			if (isset($_POST["legalform_adress_jornalist"])) { update_option("dsdvo_legalform_adress_jornalist", htmlentities(stripslashes($_POST["legalform_adress_jornalist"])), false);	}		
			if (isset($_POST["legalform_zip_jornalist"])) { update_option("dsdvo_legalform_zip_jornalist", htmlentities(stripslashes($_POST["legalform_zip_jornalist"])), false);	}		
			if (isset($_POST["legalform_city_jornalist"])) { update_option("dsdvo_legalform_city_jornalist", htmlentities(stripslashes($_POST["legalform_city_jornalist"])), false);	}		
			if (isset($_POST["legalform_country_jornalist"])) { update_option("dsdvo_legalform_country_jornalist", htmlentities(stripslashes($_POST["legalform_country_jornalist"])), false);	}		
			if (isset($_POST["clause"])) { update_option("dsdvo_clause", htmlentities(stripslashes($_POST["clause"])), false);	}		
			if (isset($_POST["copyright"])) { update_option("dsdvo_copyright", htmlentities(stripslashes($_POST["copyright"])), false);	}		
			if (isset($_POST["owntextsimprint"])) { update_option("dsdvo_owntextsimprint", htmlentities(stripslashes($_POST["owntextsimprint"])), false);	}		
			if (isset($_POST["legalform_supervisoryauthority"])) { update_option("dsdvo_legalform_supervisoryauthority", htmlentities(stripslashes($_POST["legalform_supervisoryauthority"])), false);	}		
			if (isset($_POST["legalform_city"])) { update_option("dsdvo_legalform_city", htmlentities(stripslashes($_POST["legalform_city"])), false);	}		
			if (isset($_POST["legalform_registernumber"])) { update_option("dsdvo_legalform_registernumber", htmlentities(stripslashes($_POST["legalform_registernumber"])), false);	}		
			if (isset($_POST["legalform_chamber"])) { update_option("dsdvo_legalform_chamber", htmlentities(stripslashes($_POST["legalform_chamber"])), false);	}		
			if (isset($_POST["legalform_ustid"])) { update_option("dsdvo_legalform_ustid", htmlentities(stripslashes($_POST["legalform_ustid"])), false);	}		
			if (isset($_POST["legalform_wid"])) { update_option("dsdvo_legalform_wid", htmlentities(stripslashes($_POST["legalform_wid"])), false);	}		
			if (isset($_POST["cookie_text"])) { update_option("dsdvo_cookie_text", htmlentities(stripslashes($_POST["cookie_text"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["policy_text_1"])) { update_option("dsdvo_policy_text_1", htmlentities(stripslashes($_POST["policy_text_1"]), ENT_COMPAT, get_option('blog_charset')), false);	}		
			if (isset($_POST["dsdvo_delete_account_page"])) { update_option("dsdvo_delete_account_page", sanitize_text_field($_POST["dsdvo_delete_account_page"]["page_id"]), false);	}		
			if (isset($_POST["cookie_not_acceptet_url"])) { update_option("cookie_not_acceptet_url", htmlentities(stripslashes($_POST["cookie_not_acceptet_url"])), false);	}		
			if (isset($_POST["cookie_not_acceptet_text"])) { update_option("cookie_not_acceptet_text", htmlentities(stripslashes($_POST["cookie_not_acceptet_text"])), false);	}		
			if (isset($_POST["show_policy"])) { update_option("dsdvo_show_policy", htmlentities(stripslashes($_POST["show_policy"])), false);	} else { update_option("dsdvo_show_policy", "", false); }		
			if (isset($_POST["show_rejectbtn"])) { update_option("dsdvo_show_rejectbtn", htmlentities(stripslashes($_POST["show_rejectbtn"])), false);	}	else { update_option("dsdvo_show_rejectbtn", "off", false); }	
			if (isset($_POST["use_dnt"])) { update_option("dsdvo_use_dnt", htmlentities(stripslashes($_POST["use_dnt"])), false);	}	else { update_option("dsdvo_use_dnt", "off", false); }				
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
			if (isset($_POST["use_ga"])) { update_option("dsdvo_use_ga", htmlentities(stripslashes($_POST["use_ga"])), false);	} else { update_option("dsdvo_use_ga", "", false);} 
			if (isset($_POST["ga_type"])) { update_option("dsdvo_ga_type", htmlentities(stripslashes($_POST["ga_type"])), false);	} else { update_option("dsdvo_ga_type", "", false); }	
			if (isset($_POST["use_piwik"])) { update_option("dsdvo_use_piwik", htmlentities(stripslashes($_POST["use_piwik"])), false);	} else { update_option("dsdvo_use_piwik", "", false); }	
			if (isset($_POST["use_shareaholic"])) { update_option("dsdvo_use_shareaholic", htmlentities(stripslashes($_POST["use_shareaholic"])), false);	} else { update_option("dsdvo_use_shareaholic", "", false); }	
			if (isset($_POST["use_gtagmanager"])) { update_option("dsdvo_use_gtagmanager", htmlentities(stripslashes($_POST["use_gtagmanager"])), false);	} else { update_option("dsdvo_use_gtagmanager", "", false); }	
			if (isset($_POST["use_vgwort"])) { update_option("dsdvo_use_vgwort", htmlentities(stripslashes($_POST["use_vgwort"])), false);	} else { update_option("dsdvo_use_vgwort", "", false); }	
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
			if (isset($_POST["shareaholic_policy"])) { update_option("dsdvo_shareaholic_policy", htmlentities(stripslashes($_POST["shareaholic_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}					
			if (isset($_POST["linkedin_policy"])) { update_option("dsdvo_linkedin_policy", htmlentities(stripslashes($_POST["linkedin_policy"]), ENT_COMPAT, get_option('blog_charset')), false);	}					
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
			
			if ($show_rejectbtn == "on") {
				$show_rejectbtn = "checked='checked'";
			} else {
				$show_rejectbtn = "";
			}
			
			if ($use_dnt == "on") {
				$use_dnt = "checked='checked'";
			} else {
				$use_dnt = "";
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

			echo '<div class="notice notice-success" class="updated fade"><p>Einstellungen erfolgreich gespeichert<span class="dashicons dashicons-yes"></span></p></div>';
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
			$policy_text_1 = html_entity_decode(get_option("dsdvo_policy_text_1"), ENT_COMPAT, get_option('blog_charset'));
			$dsdvo_delete_account_page = get_option("dsdvo_delete_account_page");
			$update_date = get_option("dsdvo_policy_update_date");
			$cookie_not_acceptet_url = get_option("cookie_not_acceptet_url");
			$cookie_not_acceptet_text = get_option("cookie_not_acceptet_text");
			$show_policy = get_option("dsdvo_show_policy");
			$show_rejectbtn = get_option("dsdvo_show_rejectbtn");
			$use_dnt = get_option("dsdvo_use_dnt");
			if ($use_dnt == "") { $use_dnt = "on";}
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
			$use_ga = get_option("dsdvo_use_ga");
			$ga_type = get_option("dsdvo_ga_type");
			$use_piwik = get_option("dsdvo_use_piwik");
			$use_shareaholic = get_option("dsdvo_use_shareaholic");
			$use_gtagmanager = get_option("dsdvo_use_gtagmanager");
			$use_vgwort = get_option("dsdvo_use_vgwort");
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
			$shareaholic_policy_en = html_entity_decode(get_option("dsdvo_shareaholic_policy_en"), ENT_COMPAT, get_option('blog_charset'));
			$linkedin_policy_en = html_entity_decode(get_option("dsdvo_linkedin_policy_en"), ENT_COMPAT, get_option('blog_charset'));		
			$dsgvo_pdf_text_en = html_entity_decode(get_option("dsgvo_pdf_text_en"), ENT_COMPAT, get_option('blog_charset'));
		
			
			if (!$dsdvo_cookie_text_en) { $dsdvo_cookie_text_en = "We use technically necessary cookies on our website and external services.<br/>By default, all services are disabled. You can turn or off each service if you need them or not.<br />For more informations please read our privacy policy.";}			
			
			}
			
			
			if (!$notice_style) { $notice_style = "3"; }
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
			
			if ($show_rejectbtn == "on") {
				$show_rejectbtn = "checked='checked'";
			} else {
				$show_rejectbtn = "";
			}			

			if ($use_dnt == "on") {
				$use_dnt = "checked='checked'";
			} else {
				$use_dnt = "";
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

 
	<p style="display: none;font-size: 14px;"><?php echo __("Hier können Sie alles zu DSGVO All in one einstellen.", "dsgvo-all-in-one-for-wp"); ?></p>	<p style="font-size: 14px;"><?php echo __("<b>Wichtig:</b> Bitte nehmen Sie sich kurz Zeit und gehen Sie <u>alle</u> Felder durch.", "dsgvo-all-in-one-for-wp"); ?></p>
 	<p style="font-size: 14px;"><?php echo __("Es ist wichtig alles richtig einzustellen denn nur dann kann das Plugin gute Dienste verrichten.", "dsgvo-all-in-one-for-wp"); ?></p>
	<p style="font-size: 14px;"><?php echo __("<b>Info:</b> Die <a href='http://dsgvo-for-wp.com/#shop' target='blank'>PRO Version</a> bietet viele Vorteile unter anderem Premium Support und Updates.", "dsgvo-all-in-one-for-wp"); ?></p>	 
	<p style="font-size: 14px;"><?php echo __("<b>Hilfe benötigt?</b> Email an michaelleithold18@gmail.com oder über das <a href='https://wordpress.org/support/plugin/dsgvo-all-in-one-for-wp/' target='blank'>WordPress Forum</a>.", "dsgvo-all-in-one-for-wp"); ?></p>	 
	<p style="font-size: 14px;"><?php echo __("<b>Cache:</b> Nach jeden Änderungen immer den Cache löschen (Browser Cache sowie ggf. Plugin Cache).", "dsgvo-all-in-one-for-wp"); ?></p>
	<p style="font-size: 14px;"><?php echo __("<b style='color:orange;'>Wichtig:</b> Seit V3.1 wird die Cookie Notice auch wieder angezeigt ohne die Nutzung eines externen Dienstes.", "dsgvo-all-in-one-for-wp"); ?></p>	    

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
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-users"></span><?php echo __("Daten des Inhabers", "dsgvo-all-in-one-for-wp"); ?> <span style="font-size:13px">(<?php echo __("Adressdaten, Kontaktdaten", "dsgvo-all-in-one-for-wp"); ?>)
					<?php if (empty($dsgvoaioperson) or empty($dsgvoaiocity)) { ?>
					<span class="infonodata">[<b><?php echo __("Achtung!", "dsgvo-all-in-one-for-wp"); ?></b>&nbsp;<?php echo __("keine Daten gesetzt.", "dsgvo-all-in-one-for-wp"); ?>]</span>	
					<?php } ?>
				
	
					</span></a></h2>
					<span class="dsgvooptionsinner">	
					<div class="dsdvo_options">
					<p><b class="blabel"><?php echo __("Firmenname", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiocompanyname" type="text" name="dsgvoaiocompanyname" value="<?php echo $dsgvoaiocompanyname; ?>"/></p>
					<p><b class="blabel"><?php echo __("Verantwortliche Person", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaioperson" type="text" name="dsgvoaioperson" value="<?php echo $dsgvoaioperson; ?>"/></p>
					<p><b class="blabel"><?php echo __("Straße & Hausnummer", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiostreet" type="text" name="dsgvoaiostreet" value="<?php echo $dsgvoaiostreet; ?>"/></p>
					<p><b class="blabel"><?php echo __("Postleitzahl", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiozip" type="text" name="dsgvoaiozip" value="<?php echo $dsgvoaiozip; ?>"/></p>
					<p><b class="blabel"><?php echo __("Ort", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiocity" type="text" name="dsgvoaiocity" value="<?php echo $dsgvoaiocity; ?>"/></p>
					<p><b class="blabel"><?php echo __("Land", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiocountry" type="text" name="dsgvoaiocountry" value="<?php echo $dsgvoaiocountry; ?>"/></p>
					<p><b class="blabel"><?php echo __("Telefon", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiophone" type="text" name="dsgvoaiophone" value="<?php echo $dsgvoaiophone; ?>"/></p>
					<p><b class="blabel"><?php echo __("Fax", "dsgvo-all-in-one-for-wp-pro"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiofax" type="text" name="dsgvoaiofax" value="<?php echo $dsgvoaiofax; ?>"/></p>					
					<p><b class="blabel"><?php echo __("E-Mail", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiomail" type="text" name="dsgvoaiomail" value="<?php echo $dsgvoaiomail; ?>"/></p>
					<p><b class="blabel"><?php echo __("Ust-ID", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input dsgvoaiousdid" type="text" name="dsgvoaiousdid" value="<?php echo __("Wird unter Impressum definiert!", "dsgvo-all-in-one-for-wp"); ?>" readonly/></p>
					<p><span class="dashicons dashicons-info"></span>&nbsp;<?php echo __("Die hier definierten Daten werden für die Datenschutzbedingungen und für das Impressum verwendet.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Es ist sehr wichtig, dass Sie auch alle nötigen Daten unter dem Punkt Impressum definieren", "dsgvo-all-in-one-for-wp"); ?>.</p>
					</div>		
				
					</span>
					
					
					
					<br />						
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-networking"></span><?php echo __("Externe Services <span style='font-size:13px'>(Google Analytics, Facebook Pixel & Gefällt mir, Twitter Tweet Button, Linkedin Button)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					
					<p class="dsdvo_options">
						<span><a href="#" class="services_content" data-tab="analytic"><?php echo __("Besucherzählerdienste / Analytics / Counter", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span class="toggle-indicator" aria-hidden="true"></span></a></span>
					</p>					
					
					<span class="content_analytic dsgvoaio_hide">
					<p class="dsdvo_options">
					<b><?php echo __("Facebook Pixel", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_fbpixel" type="checkbox" name="use_fbpixel" <?php echo $use_fbpixel; ?>/><br />
					<label><?php echo __("Verwenden Sie Facebook Pixel?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="fbpixelwrap">					
					<b><?php echo __("Facebook Pixel ID", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
					<input class="dsdvo_input" type="text" name="fbpixelid" value="<?php echo $fbpixelid; ?>" /><br />
					<label>
					<?php echo __("Geben Sie hier Ihre Facebook Pixel ID ein falls verfügbar.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Falls Sie Facebook Pixel nicht nutzen und keine ID haben lassen Sie dieses Feld einfach leer.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Format: 244123839385278", "dsgvo-all-in-one-for-wp"); ?><br />
					</label>
					</span>
					</p>
					
					<br />
					
					<div class="dsdvo_options">
					<b><?php echo __("Google Analytics", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_ga" type="checkbox" name="use_ga" <?php echo $use_ga; ?>/><br />
					<label><?php echo __("Verwenden Sie Google Analytics?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="gawrap">
						<span class="dsgvoaio_ga_options">
							<input type="radio" class="dsgvoaio_ga_type" name="ga_type" data-value="manual" value="manual" <?php  if (get_option('dsdvo_ga_type', 'manual') == "manual") { echo "checked"; }  ?>/> 
							<label class="dsgvoaio_bold" for="checkbox-1"><?php echo __("Manuelle Einbindung (ohne Plugin)", "dsgvo-all-in-one-for-wp"); ?></label>
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
					<input class="dsdvo_input" type="text" name="gaid" placeholder="<?php echo __("GA ID eingeben...", "dsgvo-all-in-one-for-wp"); ?>" value="<?php echo $gaid; ?>" /><br />
					<label>
					<?php echo __("Geben Sie hier Ihre Google Analytics ID ein.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Format: UA-XXXXXXXXX-X", "dsgvo-all-in-one-for-wp"); ?><br />
					</label>
					<br />
					<b><?php echo __("Standard OptIn / OptOut", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<select  class="dsdvo_input"  name="ga_optinoutsetting">
						<?php
						$ga_optinoutarr = array('optin' => 'OptOut (benötigt Zustimmung)', 'optout' => 'OptIn *NICHT DSGVO KONFORM* (benötigt keine Zustimmung)');
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
						<?php echo __("Bestimmen Sie ob Google Analytics beim ersten Besuch der Seite ohne Zustimmung des Nutzers akzeptiert werden soll (OptOut).", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Dies ist ebenso DSGVO konform da der Parameter aip=1 gesetzt ist.", "dsgvo-all-in-one-for-wp"); ?>	
						</span>
						<?php //} else if ($ga_type == 'monsterinsights') { ?>
						<span class="dsgvoaio_ga_type_monsterinsights">
						<?php if ( is_plugin_active( 'google-analytics-for-wordpress/googleanalytics.php' ) or is_plugin_active( 'google-analytics-premium/googleanalytics-premium.php' ) ) { ?>
								<span style="color: #46b450"><?php echo __("Das Plugin MonsterInsights wurde gefunden", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-yes"></span></span><br/>
								<?php echo __("Sie können somit wenn Sie diese Option aktivieren MonsterInsights DSGVO konform nutzen (2 Klick Lösung).", "dsgvo-all-in-one-for-wp"); ?><br />
								<?php echo __("Alle Einstellungen werden von MonsterInsights übernommen. Es ist nichts weiter zu tun als diese Option zu aktivieren."); ?>								
						<?php } else { ?>
								<span style="color: red"><?php echo __("Das Plugin Google Analytics Dashboard Plugin for WordPress by MonsterInsights wurde nicht gefunden.", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-no-alt"></span></span><br />
								<?php echo __("Bitte stellen Sie sicher, dass das Plugin installiert und aktiviert ist bevor Sie diese Option aktivieren und die Einstellungen speichern!", "dsgvo-all-in-one-for-wp"); ?>		
						<?php }	?>
						</span>
						<span class="dsgvoaio_ga_type_analytify">
						<?php if ( is_plugin_active( 'wp-analytify/wp-analytify.php' ) ) { ?>
								<span style="color: #46b450"><?php echo __("Das Plugin Analytify wurde gefunden", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-yes"></span></span><br/>
								<?php echo __("Sie können somit wenn Sie diese Option aktivieren Analytify DSGVO konform nutzen (2 Klick Lösung).", "dsgvo-all-in-one-for-wp"); ?><br />
								<?php echo __("Alle Einstellungen werden von MonsterInsights übernommen. Es ist nichts weiter zu tun als diese Option zu aktivieren."); ?>									
						<?php } else { ?>
								<span style="color: red"><?php echo __("Das Plugin Google Analytics Dashboard Plugin for WordPress by Analytify wurde nicht gefunden.", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-no-alt"></span></span><br />
								<?php echo __("Bitte stellen Sie sicher, dass das Plugin installiert und aktiviert ist bevor Sie diese Option aktivieren und die Einstellungen speichern!", "dsgvo-all-in-one-for-wp"); ?>		
						<?php }	?>
						</span>						
						<?php //} ?>
					</span>
					</div>
					
					<br />	
					
					<p class="dsdvo_options">
					<b><?php echo __("Google Tag Manager", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_gtagmanager" type="checkbox" name="use_gtagmanager" <?php echo $use_gtagmanager; ?>/><br />
					<label><?php echo __("Verwenden Sie Google Tag Manager?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="gtagmanagerwrap">
					<b><?php echo __("Google Tag Manager ID", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
					<input class="dsdvo_input gtagmanagerid" type="text" name="gtagmanagerid" value="<?php echo $gtagmanagerid; ?>" /><br />
					<label>
					<?php echo __("Geben Sie hier Ihre Google Tag Manager ID ein.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Format: GTM-XXXXXXX", "dsgvo-all-in-one-for-wp"); ?><br />
					</label>
					<br />
					<b><?php echo __("Einbindung automatisch ersetzen [Beta]", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input remove_gtagmanager" type="checkbox" name="remove_gtagmanager" <?php echo $remove_gtagmanager; ?>/><br />
					<label><?php echo __("Sollen ALLE bestehenden Einbindungen von Google Tag Manager DSGVO konform ersetzt werden (2 Klick Lösung)?", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Es werden alle bestehenden Einbindungen der Domain googletagmanager.com automatisch ersetzt.", "dsgvo-all-in-one-for-wp"); ?>
					</label>
					<br />							
					<br />	
					</span>
					</p>
					
					<br />						
					

					<span class="dsdvo_options">
					<b><?php echo __("VG Wort Zählpixel", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
					<input  class="dsdvo_input use_vgwort" type="checkbox" name="use_vgwort" <?php echo $use_vgwort; ?>/><br />
					<label><?php echo __("Verwenden Sie den Zählpixel der VG Wort?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="vgwortwrap">
					<?php echo __("Wenn Sie Dienste der VG Wort nutzen aktivieren Sie diese Option sodass der entsprechende Datenschutztext in die Datenschutzbedingungen eingefügt wird", "dsgvo-all-in-one-for-wp"); ?>.<br />
					<b><?php echo __("Wichtig", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;<?php echo __("Sie müssen den Text der Datenschutzbedingungen anpassen! ([BITTE ÜBERPRÜFEN, ob dies bei Ihrem Verlag der Fall ist!])", "dsgvo-all-in-one-for-wp"); ?>
					<br />
					<br />
					<b><?php echo __('Shortcode für das einbinden von VG Wort:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input amazonshortcode" type="text" name="amazonshortcode" value='[dsgvo_vgwort id="XXXXXXXXXXXXXXXX"]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie VG Wort DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<b><?php echo __("Standard OptIn / OptOut", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<select  class="dsdvo_input"  name="vgwort_optinoutsetting">
						<?php
						$vgwort_optinoutarr = array('optin' => 'OptOut (benötigt Zustimmung)', 'optout' => 'OptIn (benötigt keine Zustimmung)');
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
						<?php echo __("Bestimmen Sie ob VG Wort beim ersten Besuch der Seite ohne Zustimmung des Nutzers akzeptiert werden soll (OptOut).", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Wir empfehlen nicht den Dienst ohne Zustimmung des Nutzers zuzulassen da dies unserer Ansicht nach nicht konform ist!", "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<b><?php echo __("Einbindung automatisch ersetzen", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input remove_vgwort" type="checkbox" name="remove_vgwort" <?php echo $remove_vgwort; ?>/><br />
					<label><?php echo __("Sollen ALLE bestehenden Einbindungen von VG Wort DSGVO konform ersetzt werden (2 Klick Lösung)?", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Es werden alle bestehenden Einbindungen der Domain vgwort.de automatisch ersetzt.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Das Plugin \"Worthy\" wird unterstützt.", "dsgvo-all-in-one-for-wp"); ?>
					</label>
					<br />							
					<br />					
					
					</span>	
					</span>	
					
					<br />	
					
					<p class="dsdvo_options">
						<b><?php echo __("Piwik/Matomo", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="use_piwik" <?php echo $use_piwik; ?>/><br />
						<label><?php echo __("Wenn Sie auf Ihrer Seite Piwik/Matomo verwenden wollen aktivieren Sie dies bitte hier und fügen Sie alle geforderten Details ein", "dsgvo-all-in-one-for-wp"); ?>.</label><br />
						<br />
					<span class="piwikwrap">
					
						<b><?php echo __("Host URL", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<input type="text"  class="dsdvo_input piwik_host" name="piwik_host" value="<?php echo $piwik_host; ?>" placeholder="http://foo.bar/"/><br />
						<label>
						<?php echo __("Geben Sie hier die Host URL von Matomo ein (setTrackerUrl)", "dsgvo-all-in-one-for-wp"); ?>.<br />
						<b><?php echo __("Format", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;//foo.bar/ &nbsp;
						(<?php echo __("der Trailing Slash / am Ende ist wichtig - ja wirklich ohne http/https/www und ohne matomo.php am Ende", "dsgvo-all-in-one-for-wp"); ?>!)
						</label><br />

						<br />
						<b><?php echo __("Tracker Endpunkt", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select name="piwik_phpfile">
							<option value="matomophp" <?php if ($piwik_phpfile == "matomophp") { echo "selected"; } ?>>matomo.php</option>
							<option value="piwikphp" <?php if ($piwik_phpfile == "piwikphp") { echo "selected"; } ?>>piwik.php</option>
						</select><br />
						<label>
						<?php echo __("Wählen Sie den Endpunkt hier aus.", "dsgvo-all-in-one-for-wp"); ?>.<br />
						</label>						
						<br />
						
						<b><?php echo __("Seiten ID", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<input type="number"  class="dsdvo_input piwik_siteid" name="piwik_siteid" value="<?php echo $piwik_siteid; ?>"/><br />
						<label>
						<?php echo __("Geben Sie hier die Seiten ID von Matomo ein (setSiteId)", "dsgvo-all-in-one-for-wp"); ?>.<br />
						</label>						
						
					</span>
					</p>				
					
					</span>
					
					<br />
					
					
					<p class="dsdvo_options">
						<span><a href="#" class="services_content" data-tab="social"><?php echo __("Soziale Netzwerke / Teilen / Sharing", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span class="toggle-indicator" aria-hidden="true"></span></a></span>
					</p>					
					
					<span class="content_social dsgvoaio_hide">		

					<br />
					
					
					<span class="dsdvo_options">
					
					<b><?php echo __("Shareaholic", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
					<input  class="dsdvo_input use_shareaholic" type="checkbox" name="use_shareaholic" <?php echo $use_shareaholic; ?>/><br />
					<label><?php echo __("Verwenden Sie Shareaholic?", "dsgvo-all-in-one-for-wp"); ?></label>
					
					<br /> 
					<br />					
					<span class="shareaholicwrap">
					<b><?php echo __("Seiten ID", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input shareaholicsiteid" type="text" name="shareaholicsiteid" value="<?php echo $shareaholicsiteid; ?>" /><br />
					<label><?php echo __("Geben Sie hier die Shareaholic Seiten ID ein (SiteId)", "dsgvo-all-in-one-for-wp"); ?>.
					</label>
					<br />
					<br />				
					<b><?php echo __('Shortcode für das manuelle einbinden von Shareaholic:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input shareaholicshortcode" type="text" name="shareaholicshortcode" value='[dsgvo_shareaholic]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie Shareaholic DSGVO konform manuell auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __('Dies ist kein muss - Shareaholic wird auch ohne diesen Shortcode angezeigt.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>			
					</span>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Facebook Kommentare", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_facebookcomments" type="checkbox" name="use_facebookcomments" <?php echo $use_facebookcomments; ?>/><br />
					<label><?php echo __("Verwenden Sie Facebook Kommentare?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="facebookcommentswrap">
					<b><?php echo __('Shortcode für das einbinden von Facebook Kommentare:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input amazonshortcode" type="text" name="amazonshortcode" value='[dsgvo_facebook_comments]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie Facebook Kommentare DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Facebook (Gefällt mir/Like Button)", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_facebooklike" type="checkbox" name="use_facebooklike" <?php echo $use_facebooklike; ?>/><br />
					<label><?php echo __("Verwenden Sie den Facebook Gefällt mir/Like Button?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="facebooklikewrap">
					<b><?php echo __('Shortcode für das einbinden des "Facebook Like/Gefällt mir Button":<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input facebooklikeshortcode" type="text" name="facebooklikeshortcode" value='[dsgvo_facebook_like]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie den "Facebook Like/Gefällt mir Button" DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Twitter (Tweet Button)", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_twitter" type="checkbox" name="use_twitter" <?php echo $use_twitter; ?>/><br />
					<label><?php echo __("Verwenden Sie Twitter?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="twitterwrap">
					<b><?php echo __("Benutzername", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input" type="text" name="twitterusername" class="twitterusername" value="<?php echo $twitterusername; ?>"/><br />
					<br />
					<b><?php echo __('Shortcode für das einbinden des "Tweet Button":<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input twittershortcode" type="text" name="twittershortcode" value='[dsgvo_twitter_button]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie den "Tweet Button" DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					
					
					
					<br />
					<p class="dsdvo_options" style="display: none;">
					<b><?php echo __("AddThis", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_addthis" type="checkbox" name="use_addthis" <?php echo $use_addthis; ?>/><br />
					<label><?php echo __("Verwenden Sie AddThis?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br /> 					<br />
					<span class="addthiswrap">
					<b><?php echo __("Deine PUB ID", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
					<input class="dsdvo_input" type="text" name="addthisid" class="addthisid" value="<?php echo $addthisid; ?>"/><br />
					<br />
					<b><?php echo __('Shortcode für das einbinden der "AddThis Button":<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input addthisshortcode" type="text" name="twittershortcode" value='[dsgvo_addthis]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie den "Tweet Button" DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					<br />
					<p class="dsdvo_options">
					<b><?php echo __("Linkedin", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_linkedin" type="checkbox" name="use_linkedin" <?php echo $use_linkedin; ?>/><br />
					<label><?php echo __("Verwenden Sie Linkedin?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="linkedinwrap">
					<b><?php echo __('Shortcode für das einbinden des "Linkedin Button":<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input addthisshortcode" type="text" name="twittershortcode" value='[dsgvo_linkedin]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie den "Linkedin Button" DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>
					</span>
					<br />
					
					<p class="dsdvo_options" style="display: none;">
					<b><?php echo __("Youtube", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input use_youtube" type="checkbox" name="use_youtube" <?php echo $use_youtube; ?>/><br />
					<label><?php echo __("Verwenden Sie Youtube?", "dsgvo-all-in-one-for-wp"); ?></label>
					<br />
					<br />
					<span class="youtubewrap">
					<b><?php echo __('Shortcode für das einbinden von Youtube Videos:<br />', "dsgvo-all-in-one-for-wp"); ?></b>
					<input class="dsdvo_input youtubeshortcode" type="text" name="youtubeshortcode" value='[dsgvo_youtube]' readonly/><br />
					<?php echo __('Mit dem Shortcode können Sie Youtube Videos DSGVO konform auf jeder gewünschten Seite einbinden.', "dsgvo-all-in-one-for-wp"); ?><br />
					</span>
					</p>						
					
					<p class="dsdvo_options">
					
					<b><?php echo __("Weitere externe Dienste DSGVO konform einbinden wie:", "dsgvo-all-in-one-for-wp"); ?></b><br />
					<br />
					<?php echo __("eTracker, Statcounter, Clicky, Google Adsense, Amazon Ads, Google Maps, Komoot, OpenStreetMap + LeafLetMap, Youtube & Youtube Playlist, Vimeo, Dailymotion, SoundCloud, HearThis, MixCloud, Disqus, Instagram Feed, Facebook Like/Share/Teilen – Kommentare, Facebook Pixel, Printerest, ShareThis, Shareaholic, AddThis, AddToAny, SlideShare, reCAPTCHA, OneSignal, Slimstats + iFrame / Cotent Blocker + 5 zusätzliche Dienste die per JS Code ausgeführt werden bequem über die Einstellungen DSGVO konform nutzen,", "dsgvo-all-in-one-for-wp"); ?><br />
					<br />
					<b><?php echo __("...in der Pro Version."); ?></b>
					</p>					
				
					</span>
					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-desktop"></span><?php echo __("Einstellungen Cookies/Cookie Notice <span style='font-size:13px'>(Cookie Notice, automatische Zustimmung, Design/Style, Buttons, Lebensdauer, Texte)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<div class="dsgvooptionsinner">					
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Notice/Meldung", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="show_policy" <?php echo $show_policy; ?>/><br />
						<label><?php echo __("Soll die Cookie Notice bzw. die Bedingungen angezeigt werden?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					
					<br />
			
					<span class="showonnoticeon">
			
					
					<p class="dsdvo_options" style="display: none !important;">
						<b><?php echo __("Automatische Zustimmung durch wechseln der Seite", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="auto_accept" <?php echo $auto_accept; ?>/><br />
						<label><?php echo __("Sollen die Cookie und externen Services automatisch zugelassen werden sobald der Benutzer auf der Seite navigiert?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					

					<p class="dsdvo_options">
						<b><?php echo __("Service Kontrolle", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp; 
						<input  class="dsdvo_input" type="checkbox" name="show_servicecontrol" <?php echo $show_servicecontrol; ?>/><br />
						<label><?php echo __("Soll die Service Kontrolle angezeigt werden?", "dsgvo-all-in-one-for-wp"); ?></label>
						<br />
						<span class="servicecontrolwrap">
						<br />
						<b><?php echo __("Position der Service Kontrolle", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<select name="position_service_control">
							<?php
							$posvalues = array('topleft' => __("Oben links", "dsgvo-all-in-one-for-wp"), 'topright' => __("Oben rechts", "dsgvo-all-in-one-for-wp"),'bottomleft' => __("Unten links", "dsgvo-all-in-one-for-wp"), 'bottomright' => __("Unten rechts", "dsgvo-all-in-one-for-wp"));
							foreach ($posvalues as $posvalue => $poskey) {
								?>
								<option value="<?php echo $posvalue; ?>" <?php if ($position_service_control == $posvalue) { echo "selected"; } ?>><?php echo $poskey; ?></option>
								<?php
							} 
							?>
						</select>
						<br />
						<label><?php echo __("In welcher Ecke soll die Service Kontrolle angezeigt werden?", "dsgvo-all-in-one-for-wp"); ?>?</label>						
						</span>
					</p>

					<br />
					
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Notice Style / Position", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select name="notice_style">
							<option value="1" <?php if ($notice_style == 1) { echo "selected";} ?>><?php echo __("#1 Sticky am unteren Bildschirmrand", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="2" <?php if ($notice_style == 2) { echo "selected";} ?>><?php echo __("#2 Overlay über gesamte Seite (*NEU*)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="3" <?php if ($notice_style == 3) { echo "selected";} ?>><?php echo __("#3 Overlay gesamte Seite + Datenschutzbedingungen *EMPFOHLEN* (*NEU*)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="4" <?php if ($notice_style == 4) { echo "selected";} ?> disabled><?php echo __("Block - linke Ecke unten (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="5" <?php if ($notice_style == 5) { echo "selected";} ?> disabled><?php echo __("Block - rechte Ecke unten (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="6" <?php if ($notice_style == 6) { echo "selected";} ?> disabled><?php echo __("Block - linke Ecke oben (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="7" <?php if ($notice_style == 7) { echo "selected";} ?> disabled><?php echo __("Block - rechte Ecke oben (Pro Version)", "dsgvo-all-in-one-for-wp"); ?></option>							
						</select><br />
						<label>
						<?php echo __("Wählen Sie das Design der Cookie Notice aus.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("<b style='color:orange;'>Sehr wichtig:</b> Wir empfehlen Ihnen Option #3 zu wählen! So hat der Benutzer <u>sofort</u> die Übersicht über die Datenschutzbedingungen.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Option #3 entspricht der aktuellen DSGVO.", "dsgvo-all-in-one-for-wp"); ?>
						</label>
					</p>

					<p class="dsdvo_options">
						<b><?php echo __("Animationsdauer", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<input type="number" class="dsdvo_input" value="<?php if (isset($animation_time) && $animation_time != "") { echo $animation_time; } else { echo "1000"; } ?>" name="animation_time"/><br />
						<label><?php echo __("Angabe in Millisekunden (1000 = 1 Sekunde)", "dsgvo-all-in-one-for-wp"); ?>.</label>
						<br />					
					</p>	
	
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Notice Design", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select name="notice_design">
							<option value="dark" <?php if ($notice_design == "dark") { echo "selected";} ?>><?php echo __("Dunkel - Grau", "dsgvo-all-in-one-for-wp"); ?></option>
							<option value="clear" <?php if ($notice_design == "clear") { echo "selected";} ?>><?php echo __("Hell - Grau", "dsgvo-all-in-one-for-wp"); ?></option>							
							
						</select><br />
						<label><?php echo __("Wählen Sie das Design der Cookie Notice aus.", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>

					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Button Text (Annehmen)", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<input class="dsdvo_input" type="text" name="btn_txt_accept" value="<?php if ($btn_txt_accept) {echo $btn_txt_accept;} else { echo "Akzeptieren";}?>" /><br />
						<?php } ?>
						<?php if ($showpolylangoptions == true or $language == "en") { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<input class="dsdvo_input" type="text" name="btn_txt_accept_en" value="<?php if ($btn_txt_accept_en) {echo $btn_txt_accept_en;} else { echo "Accept";}?>" /><br />
						<?php } ?>
						<label>
						<?php echo __("Text des Button um die Bedingungen zu akzeptieren", "dsgvo-all-in-one-for-wp"); ?>.<br />
				
						</label>
						
						<br />
						
						<b><?php echo __("Button Text (Personalisieren)", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<input class="dsdvo_input" type="text" name="btn_txt_customize" value="<?php if ($btn_txt_customize) {echo $btn_txt_customize;} else { echo "Personalisieren";}?>" /><br />
						<?php } ?>
						<?php if ($showpolylangoptions == true or $language == "en") { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<input class="dsdvo_input" type="text" name="btn_txt_customize_en" value="<?php if ($btn_txt_customize_en) {echo $btn_txt_customize_en;} else { echo "Customize";}?>" /><br />
						<?php } ?>						
						<label>
						<?php echo __("Text des Button um die Opt in Einstellungen zu personalisieren", "dsgvo-all-in-one-for-wp"); ?>.<br />
				
						</label>
						
						
					</p>	
					<br />					
					<span class="dsdvo_options">
					<b><?php echo __("Ablehnen Button anzeigen", "dsgvo-all-in-one-for-wp"); ?>?</b>&nbsp;
							<input  class="dsdvo_input" type="checkbox" name="show_rejectbtn" <?php echo $show_rejectbtn; ?>/><br />
							<label><?php echo __("Soll der Button zum ablehnen der Bedingungen angezeigt werden?", "dsgvo-all-in-one-for-wp"); ?></label>
							<br />
							<span class="rejectbtnwrap">
								<p><?php echo __("Info: Sollte kein externer Dienst aktiviert sein wird der ablehnen Button nicht angezeigt!", "dsgvo-all-in-one-for-wp"); ?></p>
								<br />
								<b><?php echo __("Button Text (Ablehnen)", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<input class="dsdvo_input" type="text" name="btn_txt_reject" value="<?php if ($btn_txt_reject) {echo $btn_txt_reject;} else { echo "Ablehnen";}?>" /><br />
								<?php } ?>
								<?php if ($showpolylangoptions == true or $language == "en") { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>
								<input class="dsdvo_input" type="text" name="btn_txt_reject_en" value="<?php if ($btn_txt_reject_en) {echo $btn_txt_reject_en;} else { echo "Reject";}?>" /><br />
								<?php } ?>								
								<label>
								<?php echo __("Text des Button um die Bedingungen abzulehen", "dsgvo-all-in-one-for-wp"); ?>.<br />
						
								</label>
								
								
								<br />		
						</span>					
					
					
					
					</span>
					<br />					
					
					<p class="dsdvo_options">
						<b><?php echo __("Cookie Lebensdauer", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<input class="dsdvo_input" type="text" name="cookie-time" value="<?php echo $cookie_time; ?>" /> <?php echo __("Tag(e)", "dsgvo-all-in-one-for-wp"); ?><br />
						<label>
						<?php echo __("Wie lange soll der Cookie der Cookie Zustimmung gespeichert werden? (<u>Angabe in Tagen!</u>)", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</p>
					
					<br />
					
					<p class="dsdvo_options">
					<b><?php echo __("DNT (Do Not Track)", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input  class="dsdvo_input" type="checkbox" name="use_dnt" <?php echo $use_dnt; ?>/><br />
							<label><?php echo __("Soll die Do Not Track Einstellung respektiert werden? Wir empfehlen Ihnen DNT zu respektieren denn nur das ist DSGVO konform!", "dsgvo-all-in-one-for-wp"); ?></label>
							<br />
					</p>
					
					<br />
					
					<span class="dsdvo_options">
						<b><?php echo __("Bedingungen/Cookies Zustimmungstext", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="cookietext" title="<?php echo __("Cookie Notice Text neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>						
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( $dsdvo_cookie_text, 'cookie_text', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => FALSE ) ); ?>								
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( $dsdvo_cookie_text_en, 'cookie_text_en', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => FALSE ) ); ?>								
						<?php } ?>
						
						<label>
						<?php echo __("Hier können Sie den Text ändern der bei der Cookie Zustimmung angezeigt wird.", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</span>
				
					<br/>
					
					 <p class="dsdvo_options" style="display: none;">
						<b><?php echo __("Link zur Seite wenn Bedingungen/Cookies abgelehnt werden", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<input class="dsdvo_input" type="text" name="cookie_not_acceptet_url" value="<?php echo $cookie_not_acceptet_url; ?>"  /><br />
						<label>
						<?php echo __("Falls der Benutzer den Bedingungen nicht zustimmt und auf \"ablehnen\" klickt auf welche Seite soll der Benutezr dann weitergeleitet werden? Empfehlung: https://www.wko.at/service/wirtschaftsrecht-gewerberecht/EU-Datenschutz-Grundverordnung:-Auswirkungen-auf-Websites.html", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</p>
					
					<br/>
					 <p class="dsdvo_options" style="display:none;">
						<b><?php echo __("Text der erscheinen soll wenn man die Bedingungen abgelehnt hat", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<input class="dsdvo_input" type="text" name="cookie_not_acceptet_text" value="<?php echo $cookie_not_acceptet_text; ?>"  /><br />
						<label>
						<?php echo __("Falls der Benutzer den Bedingungen nicht zustimmt und auf \"ablehnen\" klickt auf welche Seite soll der Benutezr dann weitergeleitet werden? Empfehlung: https://www.wko.at/service/wirtschaftsrecht-gewerberecht/EU-Datenschutz-Grundverordnung:-Auswirkungen-auf-Websites.html", "dsgvo-all-in-one-for-wp"); ?><br />
				
						</label>

					</br>					
					
					</span>
					
					<p class="dsdvo_options">
					
					<b><?php echo __("Bequem ALLE Farben sowie ALLE Texte ändern?", "dsgvo-all-in-one-for-wp"); ?></b><br />
					<br />
					<?php echo __("Überhaut kein Problem! In der Pro Version können Sie wirklich ALLES bequem über die Einstellungen ändern.,", "dsgvo-all-in-one-for-wp"); ?><br />
	
					</p>					
					</div>

					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-lock"></span><?php echo __("Einstellungen Datenschutz <span style='font-size:13px'>(Datenschutzbedingungen, Shortcode)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
						<b><?php echo __("Seite der Datenschutzbedingungen", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select class="dsdvo_input"  name="dsdvo_policy_site[page_id]">
								<?php
								if( $pages = get_pages() ){
									foreach( $pages as $page ){
										echo '<option value="' . $page->ID . '" ' . selected( $page->ID, get_option("dsdvo_policy_site")) . '>' . $page->post_title . '</option>';
									}
								}
								?>
							</select><br />
						<label><?php echo __("Wählen Sie hier die Seite auf der sich Ihre Datenschutzbedingungen befinden.", "dsgvo-all-in-one-for-wp"); ?></label>
		
					</p>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Shortcode Datenschutzbedingungen", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
						<input class="dsdvo_input" type="text" value="[dsgvo_policy]" readonly/><br />
						<label>
						<?php echo __("Mit diesem Shortcode können Sie die Datenschutzbedingungen auf einer Seite einbinden", "dsgvo-all-in-one-for-wp"); ?>.					
						<br />
						<b><?php echo __("Neu", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Nutzen Sie statt dem Shortcode den Gutenberg Block - zu finden im Editor.", "dsgvo-all-in-one-for-wp"); ?>					
						</label>
					</p>					
					<br />
					 <div class="dsdvo_options">
						<b><?php echo __("Allgemeine Datenschutzbedingungen", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="mainpolicy" title="<?php echo __("Datenschutzbestimmungen neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>						
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
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
							
							

							wp_editor( stripslashes($editor_content), $editor_id, array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE ) );
						?>
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<br />	
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
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
							
							wp_editor( stripslashes($editor_content_en), $editor_id_en, array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE ) );
						?>
						<?php } ?>	
						<br />
						<label>
						<?php echo __("Hier können Sie den Text der Datenschutzbedingungen ändern", "dsgvo-all-in-one-for-wp"); ?>.<br />
						</label>					
					</div>
					<br />
					
					
					<span class="policy_services dsdvo_options" style="display: block">						
							<b><?php echo __("Datenschutzbedingungen von WordPress & Plugins", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="wordpress" title="<?php echo __("Wordpress Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_wordpress_policy")) {
									$wordpress_policy_editor = get_option("dsdvo_wordpress_policy");
								} else {
									$wordpress_policy_editor = $wordpress_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($wordpress_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'wordpress_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_wordpress_policy_en")) {
									$wordpress_policy_editor_en = get_option("dsdvo_wordpress_policy_en");
								} else {
									$wordpress_policy_editor_en = $wordpress_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($wordpress_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'wordpress_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>	
							<?php echo __("Dieser Text wird automatisch am Ende der Datenschutzbedingungen eingefügt", "dsgvo-all-in-one-for-wp"); ?>.<br />							
							<?php echo __("<b>Wichtig:</b> Achten Sie darauf, dass am Ende dieses Textes der Tag [dsgvoaio_plugins] vorhanden ist! ", "dsgvo-all-in-one-for-wp"); ?>.<br />							

						<script>
						jQuery( document ).ready(function() {
						
						jQuery(".reset_policy_service").click(function(e) {
							e.preventDefault();
							if (confirm("<?php  echo __("Wollen Sie diese Aktion sicher ausführen?", "dsgvo-all-in-one-for-wp"); ?>")) {

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
									alert("<?php  echo __("Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support.", "dsgvo-all-in-one-for-wp"); ?>");
								}
							});
						}
						});		
						
						});						
						</script>					

					
					</span>
					
					<span class="policy_services dsdvo_options" style="display: block">
							<b><?php echo __("Datenschutzbedingungen der externen Dienste", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
							<br />
							<?php echo __("Nachfolgenden die Datenschutzbedingungen der externen Dienste", "dsgvo-all-in-one-for-wp"); ?>.<br />
							<?php echo __("<b>Info:</b> Es werden automatisch die Datenschutzbedingungen der Dienste geladen die unter Punkt #1 aktiviert sind.", "dsgvo-all-in-one-for-wp"); ?><br />
							<?php echo __("Auch dieser Text bzw. diese Texte werden automatisch zu den Datenschutzbedingungen hinzugefügt", "dsgvo-all-in-one-for-wp"); ?>.<br />							
							<br />
			
							<?php if (get_option('dsdvo_use_fbpixel') == "on") { ?> 
							<b><?php echo __("Facebook Pixel", "dsgvo-all-in-one-for-wp"); ?>:</b>						
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="fbpixel" title="<?php echo __("Facebook Pixel Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_fbpixel_policy")) {
									$fbpixel_policy_editor = get_option("dsdvo_fbpixel_policy");
								} else {
									$fbpixel_policy_editor = $fbpixel_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($fbpixel_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'fbpixel_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_fbpixel_policy_en")) {
									$fbpixel_policy_editor_en = get_option("dsdvo_fbpixel_policy_en");
								} else {
									$fbpixel_policy_editor_en = $fbpixel_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($fbpixel_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'fbpixel_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>						
							<?php } ?>	

							<?php if (get_option('dsdvo_use_facebooklike') == "on" or get_option('dsdvo_use_facebookcomments') == "on") { ?> 
							<b><?php echo __("Facebook Like/Kommentare", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="fb" title="<?php echo __("Facebook Like/Kommentare Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_facebook_policy")) {
									$facebook_policy_editor = html_entity_decode(stripslashes(get_option("dsdvo_facebook_policy")), ENT_COMPAT, get_option('blog_charset'));
								} else {
									$facebook_policy_editor = html_entity_decode(stripslashes($facebook_policy_sample), ENT_COMPAT, get_option('blog_charset'));
								}
								?>								
								<?php wp_editor($facebook_policy_editor, 'facebook_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_facebook_policy_en")) {
									$facebook_policy_editor_en = html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy_en")), ENT_COMPAT, get_option('blog_charset'));
								} else {
									$facebook_policy_editor_en = html_entity_decode(stripcslashes($facebook_policy_sample_en), ENT_COMPAT, get_option('blog_charset'));
								}
								?>								
								<?php wp_editor($facebook_policy_editor_en, 'facebook_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>						
							<?php } ?>								
							
							<?php if (get_option('dsdvo_use_twitter') == "on") { ?> 
							<b><?php echo __("Twitter", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="twitter" title="<?php echo __("Twitter Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_twitter_policy")) {
									$twitter_policy_editor = get_option("dsdvo_twitter_policy");
								} else {
									$twitter_policy_editor = $twitter_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($twitter_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'twitter_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_twitter_policy_en")) {
									$twitter_policy_editor_en = get_option("dsdvo_twitter_policy_en");
								} else {
									$twitter_policy_editor_en = $twitter_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($twitter_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'twitter_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>						
							<?php } ?>								
							
							
							<?php if (get_option('dsdvo_use_ga') == "on") { ?> 
							<b><?php echo __("Google Analytics", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="ga" title="<?php echo __("Google Analytics Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_ga_policy")) {
									$ga_policy_editor = get_option("dsdvo_ga_policy");
								} else {
									$ga_policy_editor = $ga_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($ga_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'ga_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>		
								<?php
								if (get_option("dsdvo_ga_policy_en")) {
									$ga_policy_editor_en = get_option("dsdvo_ga_policy_en");
								} else {
									$ga_policy_editor_en = $ga_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($ga_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'ga_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>		
							
							<?php } ?>	
							
							
							<?php if (get_option('dsdvo_use_gtagmanager') == "on") { ?> 	
							<b><?php echo __("Google Tag Manager", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="gtag" title="<?php echo __("Google Tag Manager Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>
							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_gtagmanager_policy")) {
									$gtagmanager_policy_editor = get_option("dsdvo_gtagmanager_policy");
								} else {
									$gtagmanager_policy_editor = $gtagmanager_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($gtagmanager_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'gtagmanager_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>		
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>		
								<?php
								if (get_option("dsdvo_gtagmanager_policy_en")) {
									$gtagmanager_policy_editor_en = get_option("dsdvo_gtagmanager_policy_en");
								} else {
									$gtagmanager_policy_editor_en = $gtagmanager_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($gtagmanager_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'gtagmanager_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>							
							<?php } ?>	

							<?php if (get_option('dsdvo_use_piwik') == "on") { ?> 							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<b><?php echo __("Matomo", "dsgvo-all-in-one-for-wp"); ?>:</b>
								<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="matomo" title="<?php echo __("Google Tag Manager Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>								
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_piwik_policy")) {
									$piwik_policy_editor = get_option("dsdvo_piwik_policy");
								} else {
									$piwik_policy_editor = $matomo_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($piwik_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'piwik_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_piwik_policy_en")) {
									$piwik_policy_editor_en = get_option("dsdvo_piwik_policy_en");
								} else {
									$piwik_policy_editor_en = $matomo_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($piwik_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'piwik_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>							
							<?php } ?>							


							<?php if (get_option('dsdvo_use_vgwort') == "on") { ?> 
							<b><?php echo __("VG Wort", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="vgwort" title="<?php echo __("VG Wort Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>							
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_vgwort_policy")) {
									$vgwort_policy_editor = get_option("dsdvo_vgwort_policy");
								} else {
									$vgwort_policy_editor = $vgwort_policy_sample;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'vgwort_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />
								
							<?php } ?>								
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
							<?php } ?>	
								<?php
								if (get_option("dsdvo_vgwort_policy_en")) {
									$vgwort_policy_editor_en = get_option("dsdvo_vgwort_policy_en");
								} else {
									$vgwort_policy_editor_en = $vgwort_policy_sample_en;
								}
								?>								
								<?php wp_editor(html_entity_decode(stripslashes($vgwort_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'vgwort_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>						
							<?php } ?>		


							<?php if (get_option('dsdvo_use_shareaholic') == "on") { ?> 
							<b><?php echo __("Shareaholic", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="shareaholic" title="<?php echo __("VG Wort Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>														
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>	
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_shareaholic_policy")) {
									$shareaholic_policy_editor = get_option("dsdvo_shareaholic_policy");
								} else {
									$shareaholic_policy_editor = $shareaholic_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_shareaholic_policy_en")) {
									$shareaholic_policy_editor_en = get_option("dsdvo_shareaholic_policy_en");
								} else {
									$shareaholic_policy_editor_en = $shareaholic_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($shareaholic_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'shareaholic_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />		
							<?php } ?>							
							<?php } ?>								
							
							<?php if (get_option('dsdvo_use_linkedin') == "on") { ?> 
							<b><?php echo __("LinkedIn", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<span class="dsgvoaio_lang_info scnd"><a href="#" class="reset_policy_service" data-service="linkedin" title="<?php echo __("VG Wort Datenschutztext neu laden", "dsgvo-all-in-one-for-wp"); ?>"><span class="dashicons dashicons-image-rotate"></span></a></span>																					
							<?php if ($language == "de" or $showpolylangoptions == true) { ?>		
								<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
								<?php } ?>								
								<?php
								if (get_option("dsdvo_linkedin_policy")) {
									$linkedin_policy_editor = get_option("dsdvo_linkedin_policy");
								} else {
									$linkedin_policy_editor = $linkedin_policy_sample;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_policy_editor), ENT_COMPAT, get_option('blog_charset')), 'linkedin_policy', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />	
							<?php } ?>
							<?php if ($language == "en" or $showpolylangoptions == true) { ?>
							<?php if ($showpolylangoptions == true) { ?>
								<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b><br />		
							<?php } ?>	
								<?php
								if (get_option("dsdvo_linkedin_policy_en")) {
									$linkedin_policy_editor_en = get_option("dsdvo_linkedin_policy_en");
								} else {
									$linkedin_policy_editor_en = $linkedin_policy_sample_en;
								}
								?>									
								<?php wp_editor(html_entity_decode(stripslashes($linkedin_policy_editor_en), ENT_COMPAT, get_option('blog_charset')), 'linkedin_policy_en', array ('textarea_rows' => 5, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE )); ?>
							<br />		
							<?php } ?>							
							<?php } ?>							
					</span>
					<br />
					</span>
					<br />
					<h2 style="" class="dsgvoheader"><a><span class="dashicons dashicons-text-page"></span><?php echo __("Impressum", "dsgvo-all-in-one-for-wp"); ?>&nbsp;<span style="font-size:13px">(<?php echo __('Shortcode / Impressum Daten', "dsgvo-all-in-one-for-wp"); ?>)</span><span class="toggle-indicator" aria-hidden="true"></span></a></h2>
					<span class="dsgvooptionsinner">	
					<div class="dsdvo_options dsgvoaio_imprint">
					<p>
						<b  class="blabel"><?php echo __("Rechtsform", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<select class="dsdvo_input dsdvo_legalform"  name="dsdvo_legalform[option_id]">
								<?php
								$legalform_options = array(	__("Bitte wählen...", "dsgvo-all-in-one-for-wp"),
															__("Aktiengesellschaft (AG)", "dsgvo-all-in-one-for-wp"),
															__("eingetragener Verein", "dsgvo-all-in-one-for-wp"),
															__("Eingetragener Kaufmann (e.K.)", "dsgvo-all-in-one-for-wp"),
															__("Einzelunternehmer", "dsgvo-all-in-one-for-wp"),
															__("Freiberufler", "dsgvo-all-in-one-for-wp"),
															__("GmbH & Co. KG", "dsgvo-all-in-one-for-wp"),
															__("gemeinnützige GmbH (gGmbH)", "dsgvo-all-in-one-for-wp"),
															__("Gesellschaft bürgerlichen Rechts (GbR)", "dsgvo-all-in-one-for-wp"),
															__("Gesellschaft mit beschränkter Haftung (GmbH)", "dsgvo-all-in-one-for-wp"),
															__("Kommanditgesellschaft (KG)", "dsgvo-all-in-one-for-wp"),
															__("Kommanditgesellschaft auf Aktien (KGaA)", "dsgvo-all-in-one-for-wp"),
															__("Offene Handelsgesellschaft (OHG)", "dsgvo-all-in-one-for-wp"),
															__("Partnergesellschaft", "dsgvo-all-in-one-for-wp"),
															__("Privatperson", "dsgvo-all-in-one-for-wp"),
															__("Sonstiges", "dsgvo-all-in-one-for-wp"),
															__("Stiftung", "dsgvo-all-in-one-for-wp"),
															__("Universität", "dsgvo-all-in-one-for-wp"),
															__("UG", "dsgvo-all-in-one-for-wp"),
															__("Ltd.", "dsgvo-all-in-one-for-wp"));
								if( $legalform_options ){
									foreach( $legalform_options as $legalform_option_key => $legalform_option ){
										echo '<option value="' . $legalform_option_key . '" ' . selected( $legalform_option_key, get_option("dsdvo_legalform")) . '>' . $legalform_option . '</option>';
									}
								}
								?>
						</select>
						<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __("Wählen Sie hier die für Sie passende Rechtsform aus.", "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>					
						</p>
					
						<span class="legal_form_first_step">
						<p>
							<b class="blabel"><?php echo __("Verantwortliche Person", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input dsgvoaioperson_2" type="text" name="dsgvoaiopersondsgvoaioperson_2" value="<?php echo html_entity_decode(stripslashes($dsgvoaioperson), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>
						</span>

				<div class="legal_form_nocompany">	
						<p>
							<b class="blabel"><?php echo __("Verantwortliche Person", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_personname" type="text" name="legalform_personname" value="<?php echo html_entity_decode(stripslashes($dsgvoaioperson), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>					
						<p>
							<b class="blabel"><?php echo __("E-Mail", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_email" type="text" name="legalform_email" value="<?php echo html_entity_decode(stripslashes($dsgvoaiomail), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>				
						<p>
							<b class="blabel"><?php echo __("Telefonnummer", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_phone" type="text" name="legalform_phone" value="<?php echo html_entity_decode(stripslashes($dsgvoaiophone), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>		
						<p>
							<b class="blabel"><?php echo __("Faxnummer", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_fax" type="text" name="legalform_fax" value="<?php echo html_entity_decode(stripslashes($dsgvoaiofax), ENT_COMPAT, get_option('blog_charset')); ?>" readonly/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>							
				</div>
						
						<span class="legal_form_needconsenscontainer">
						<p>
							<b class="blabel"><?php echo __("Behördliche Zulassung", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input type="radio" name="legalform_needconsens" value="yes" <?php if (isset($legalform_needconsens)) { if ($legalform_needconsens == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Ja", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="legalform_needconsens" value="no" <?php if (isset($legalform_needconsens)) { if ($legalform_needconsens == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("Nein", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Wird für die Ausübung Ihres Berufes eine behördliche Zulassung benötigt?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>
						</span>
						
						<span class="supervisoryauthoritycontainer">
						<p>
							<b class="blabel"><?php echo __("Aufsichtsbehörde", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_supervisoryauthority" type="text" name="legalform_supervisoryauthority" value="<?php echo html_entity_decode(stripslashes($legalform_supervisoryauthority), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Geben Sie hier den Namen der Aufsichtsbehörde ein sowie im besten Fall auch die Adresse.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>																
						</p>						
						</span>	
						
						<span class="registerentry">
						<p>
							<b class="blabel"><?php echo __("Registereintrag", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input type="radio" name="legalform_needregister" value="yes" <?php if (isset($legalform_needregister)) { if ($legalform_needregister == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Ja", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="legalform_needregister" value="no" <?php if (isset($legalform_needregister)) { if ($legalform_needregister == "no") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Nein", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Ist die Eintragung in ein Register für Ihr Unternehmen erforderlich?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>						
						</span>	
						
											
						
						<span class="needconsescontent">
						<p>
						<b class="blabel"><?php echo __("Register", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<select class="dsdvo_input dsdvo_legalform_register"  name="legalform_register[option_id]">
									<?php
									$legalform_register_options = array(	__("Bitte wählen...", "dsgvo-all-in-one-for-wp"),
																__("Handelsregister", "dsgvo-all-in-one-for-wp"),
																__("Vereinsregister", "dsgvo-all-in-one-for-wp"),
																__("Partnerschaftsregister", "dsgvo-all-in-one-for-wp"),
																__("Genossenschaftsregister", "dsgvo-all-in-one-for-wp"));
									if( $legalform_register_options ){
										foreach( $legalform_register_options as $legalform_register_option_key => $legalform_register_option ){
											echo '<option value="' . $legalform_register_option_key . '" ' . selected( $legalform_register_option_key, get_option("dsdvo_legalform_register")) . '>' . $legalform_register_option . '</option>';
										}
									}
									?>
							</select>						
						</p>
						<p>
							<b class="blabel"><?php echo __("Ort", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_city" type="text" name="legalform_city" value="<?php echo html_entity_decode(stripslashes($legalform_city), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>						
						<p>
							<b class="blabel"><?php echo __("Registernummer", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_registernumber" type="text" name="legalform_registernumber" value="<?php echo html_entity_decode(stripslashes($legalform_registernumber), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>
						</span>
						
						
						
					<span class="legal_form_opt2">
						<p>
						<b class="blabel"><?php echo __("Beruf mit Informationspflicht", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<select class="dsdvo_input dsdvo_legalform_inforule"  name="legalform_inforule[option_id]">
									<?php
									$legalform_register_options = array(	__("Bitte wählen...", "dsgvo-all-in-one-for-wp"),
																__("Nein", "dsgvo-all-in-one-for-wp"),
																__("Arzt", "dsgvo-all-in-one-for-wp"),
																__("Zahnarzt", "dsgvo-all-in-one-for-wp"),
																__("Architekt", "dsgvo-all-in-one-for-wp"),
																__("Steuerberater", "dsgvo-all-in-one-for-wp"),
																__("Rechtsanwalt", "dsgvo-all-in-one-for-wp"),
																__("Notar", "dsgvo-all-in-one-for-wp"),
																__("Wirtschaftsprüfer", "dsgvo-all-in-one-for-wp"));
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
							<b class="blabel"><?php echo __("Zuständige Kammer", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_chamber" type="text" name="legalform_chamber" value="<?php echo html_entity_decode(stripslashes($legalform_chamber), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Geben Sie hier den Namen der Kammer ein die für Ihr Unternehmen zuständig ist.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>																
						</p>	
						<p>
							<b class="blabel"><?php echo __("Staat", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<select class="dsdvo_input legalform_state"  name="legalform_state[option_id]">
									<?php
									$legalform_state_options = array(	__("Bitte wählen...", "dsgvo-all-in-one-for-wp"),
																__("Deutschland", "dsgvo-all-in-one-for-wp"),
																__("Österreich", "dsgvo-all-in-one-for-wp"),
																__("Schweiz", "dsgvo-all-in-one-for-wp"));
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
							<b class="blabel"><?php echo __("Ust-ID", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_ustid" type="text" name="legalform_ustid" value="<?php echo html_entity_decode(stripslashes($legalform_ustid), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>	
						<p>
							<b class="blabel"><?php echo __("Wirtschafts-ID", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_wid" type="text" name="legalform_wid" value="<?php echo html_entity_decode(stripslashes($legalform_wid), ENT_COMPAT, get_option('blog_charset')); ?>"/>
						</p>							
</span>	


					<span class="legal_form_jornal">	
					<p>
							<b class="blabel"><?php echo __("Redaktionelle oder journalistische Inhalte", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="legalform_journalist" value="yes" <?php if (isset($legalform_journalist)) { if ($legalform_journalist == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Ja", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="legalform_journalist" value="no" <?php if (isset($legalform_journalist)) { if ($legalform_journalist == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("Nein", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Veröffentlichen Sie redaktionelle oder journalistische Inhalte?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>	
					
					<span class="legal_form_jornal_container">	
						<p>
							<b class="blabel"><?php echo __("Verantwortliche Person", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_personname_jornalist" type="text" name="legalform_personname_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_personname_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>					
						<p>
							<b class="blabel"><?php echo __("Straße & Hausnummer", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_adress_jornalist" type="text" name="legalform_adress_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_adress_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>				
						<p>
							<b class="blabel"><?php echo __("Postleitzahl", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_zip_jornalist" type="text" name="legalform_zip_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_zip_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>		
						<p>
							<b class="blabel"><?php echo __("Ort", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_city_jornalist" type="text" name="legalform_city_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_city_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
						<p>
							<b class="blabel"><?php echo __("Land", "dsgvo-all-in-one-for-wp"); ?>:</b>
							<input  class="dsdvo_input legalform_country_jornalist" type="text" name="legalform_country_jornalist" value="<?php echo html_entity_decode(stripslashes($legalform_country_jornalist), ENT_COMPAT, get_option('blog_charset')); ?>"/>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Dieser Wert wird unter Daten des Inhabers definiert.', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>	
					
					
					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Haftungsausschluss", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="clause" value="yes" <?php if (isset($clause)) { if ($clause == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Ja", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="clause" value="no" <?php if (isset($clause)) { if ($clause == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("Nein", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Soll ein Haftungsausschluss für Inhalte und Links eingefügt werden?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>				

					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Urheberrecht", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="copyright" value="yes" <?php if (isset($copyright)) { if ($copyright == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Ja", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="copyright" value="no" <?php if (isset($copyright)) { if ($copyright == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("Nein", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Soll eine Passage für das Urheberrecht eingefügt werden?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>							
	
					<span class="">	
					<p>
							<b class="blabel"><?php echo __("Eigene Texte", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
							<input type="radio" name="owntextsimprint" value="yes" <?php if (isset($owntextsimprint)) { if ($owntextsimprint == "yes") { echo "checked='checked'"; }} ?>>&nbsp;<?php echo __("Ja", "dsgvo-all-in-one-for-wp"); ?>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="radio" name="owntextsimprint" value="no" <?php if (isset($owntextsimprint)) { if ($owntextsimprint == "no") { echo "checked='checked'"; }} ?>>&nbsp,<?php echo __("Nein", "dsgvo-all-in-one-for-wp"); ?>
							<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __('Wollen Sie zusätzlich eigene Texte wie zum Besipiel einen Bilderquellennachweis oder sonstige Texte hinzufügen?', "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						</p>	
					</span>	

					<span class="owntextsimprint_container">	
					
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<?php
							$editor_id_customimprint = "customimprinttext";
							$editor_content = "";
							
							$editor_content = html_entity_decode(get_option('dsdvo_customimprinttext'), ENT_COMPAT, get_option('blog_charset'));

							wp_editor(  stripslashes($editor_content), $editor_id_customimprint, array ('wpautop' => true, 'textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE ) );
						?>
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<br />	
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php
							$editor_id_customimprint_en = "customimprinttext_en";
							$editor_content_en = "";
							$editor_content_en =  html_entity_decode(get_option('dsdvo_customimprinttext_en'), ENT_COMPAT, get_option('blog_charset'));							
							
							
							wp_editor( stripslashes($editor_content_en), $editor_id_customimprint_en, array ('wpautop' => true, 'textarea_rows' => 60, 'media_buttons' => FALSE, 'teeny' => FALSE, 'tinymce' => TRUE, 'quicktags' => FALSE ) );
						?>
						<?php } ?>

					</span>
	
					<p>
						<b class="blabel"><?php echo __("Shortcode Impressum", "dsgvo-all-in-one-for-wp"); ?>:</b>
						<input class="dsdvo_input" type="text" value="[dsgvo_imprint]" readonly/>						
						<span  class="dsgvoaio_tooltip tooltip" title="<?php echo __("Mit diesem Shortcode können Sie das Impressum auf einer Seite einbinden", "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span>										
						<br />
						<br />
						<b><?php echo __("Neu", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Nutzen Sie statt dem Shortcode den Gutenberg Block - zu finden im Editor.", "dsgvo-all-in-one-for-wp"); ?>					
					</p>
				</div>
					</span>							
					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-comments"></span><?php echo __("Einstellungen Datenschutz <span style='font-size:13px'>(Blog Kommentare)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
						<b><?php echo __("Blog Datenschutzbedingungen akzeptieren", "dsgvo-all-in-one-for-wp"); ?>:</b> 
						<input  class="dsdvo_input" type="checkbox" name="blog_agb" <?php echo $blog_agb_selected; ?>/><br />
						<label><?php echo __("Sollen beim erstellen eines Blog Kommentares die Datenschutzbedingungen akzeptiert werden müssen?", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					<br />
					<div class="dsgvoaio_blog_policy_wrap">
					<span class="dsdvo_options">
						<b><?php echo __("Text neben der Checkbox zur Zustimmung der Datenschutzbedingungen", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<?php wp_editor( html_entity_decode($dsgvo_policy_blog_text), 'dsgvo_policy_blog_text', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => FALSE ) ); ?>						
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<?php wp_editor( html_entity_decode($dsgvo_policy_blog_text_en), 'dsgvo_policy_blog_text_en', array ('wpautop' => true, 'textarea_rows' => 30, 'media_buttons' => FALSE, 'teeny' => TRUE, 'tinymce' => TRUE, 'quicktags' => FALSE ) ); ?>								
						<?php } ?>
						
						<label><?php echo __("Text der neben der Checkbox bei dem Blog Kommentar Formular angezeigt werden soll. ", "dsgvo-all-in-one-for-wp"); ?></label>
					</span>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Text wenn die Datenschutzbedingungen nicht akzeptiert wurden", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>						
						<textarea class="dsdvo_input" rows="2" cols="10" name="dsgvo_error_policy_blog"><?php echo $dsgvo_error_policy_blog; ?></textarea><br />
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_error_policy_blog_en"><?php echo $dsgvo_error_policy_blog_en; ?></textarea><br />
						<?php } ?>						
						
						<label><?php echo __("Text der erscheinen soll wenn die Datenschutzbedingungen nicht akzeptiert wurden - kein HTML erlaubt!", "dsgvo-all-in-one-for-wp"); ?></label>
					</p>
					</div>
					<p class="dsdvo_options">
						<b><?php echo __("Löschen der vorhandenen IP Adressen", "dsgvo-all-in-one-for-wp"); ?>:</b><br />
						<a href="#" class='button button-primary dsgvo_delete_ip_adresses'><?php echo __("IP Adressen löschen", "dsgvo-all-in-one-for-wp"); ?></a><br />
						 <label>
						<?php echo __("Löschen Sie hier die bereits vorhandenen IP Adressen von bereits geposteten Kommentaren.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Per klick auf den Button IP Adressen löschen werden alle IP Adressen sofort gelöscht. ", "dsgvo-all-in-one-for-wp"); ?>
						</label>
					</p>	
					<p class="dsdvo_options">
						<b><?php echo __("IP Adressen automatisch entfernen", "dsgvo-all-in-one-for-wp"); ?>:</b>&nbsp;
						<input  class="dsdvo_input" type="checkbox" name="dsgvo_remove_ipaddr_auto" <?php echo $dsgvo_remove_ipaddr_auto; ?>/><br />
						 <label>
						<?php echo __("Wenn aktiviert werden die IP Adressen der Kommentare direkt beim absenden vor dem speichern anonymisiert.", "dsgvo-all-in-one-for-wp"); ?><br />
						</label>
					</p>
					</span>					
					
					<br />
					
					<span style="display: none">
					<h2 class="dsgvoheader"><a><?php echo __("#5 Impressum <span style='font-size:13px'>(Shortcode sowie Text)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
					<b><?php echo __("Verfügt diese Webseite über einen Online Shop", "dsgvo-all-in-one-for-wp"); ?>?</b>&nbsp;
					<input  class="dsdvo_input" type="checkbox" name="is_online_shop" <?php echo $is_online_shop; ?>/><br />
					
					<br />

					<b class="blabel"><?php echo __("Betreiber dieser Webseite", "dsgvo-all-in-one-for-wp"); ?>:</b>
					<input  class="dsdvo_input companyformat" type="text" name="companyformat" value="<?php echo $companyformat; ?>"/><br />
					<label><?php echo __("Geben Sie an wer dieser Webseite betreibt. Zum Beispiel: Privatperson, Freiberufler, Einzelunternehmer, GmbH, UG, AG etc.", "dsgvo-all-in-one-for-wp"); ?><br /></label>					
					</p>					
					</span>
					
					<br />
					</span>
					
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-trash"></span><?php echo __("Einstellungen Löschung des Benutzerkontos <span style='font-size:13px'>(Shortcode für die Löschung)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<?php if ( get_option( 'users_can_register' ) == 0 ) { ?>
					<p class="dsdvo_options">
						<b><?php echo __("INFO", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Die Benutzeranmeldung ist in den WordPress Einstellungen deaktiviert. Falls Sie keine Registration erlauben können Sie diesen Punkt ignorieren", "dsgvo-all-in-one-for-wp"); ?>.<br />					
					</p>
					<?php } ?>					
					<p class="dsdvo_options">
						<b><?php echo __("Löschung des Benutzerkontos", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Recht auf Vergesslichkeit", "dsgvo-all-in-one-for-wp"); ?>) <br />
						<input class="dsdvo_input"  type="text"  value="[dsgvo_user_remove_form]" readonly/><br />
						<label>
						<?php echo __("Der Shortcode für das Formular um das Benutzerkonto inklusive aller Daten zu löschen.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Fügen Sie den Shortcode auf der Seite ein auf welcher Sie das Formular anzeigen wollen.", "dsgvo-all-in-one-for-wp"); ?>
						<br />
						<b><?php echo __("Neu", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Nutzen Sie statt dem Shortcode den Gutenberg Block - zu finden im Editor.", "dsgvo-all-in-one-for-wp"); ?>										
						</label>
					</p>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("Seite der Löschung des Benutzerkontos", "dsgvo-all-in-one-for-wp"); ?>:</b>  <br />
						<select class="dsdvo_input"  name="dsdvo_delete_account_page[page_id]">
								<?php
								if( $pages = get_pages() ){
									foreach( $pages as $page ){
										echo '<option value="' . $page->ID . '" ' . selected( $page->ID, get_option("dsdvo_delete_account_page")) . '>' . $page->post_title . '</option>';
									}
								}
								?>
							</select><br />
						<label><?php echo __("Wählen Sie hier die Seite auf der sich der Shortcode [dsgvo_user_remove_form] befindet.", "dsgvo-all-in-one-for-wp"); ?></label>
		
					</p>
					<br />
					</span>

					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-visibility"></span><?php echo __("Einstellungen Datenauszug <span style='font-size:13px'>(Datenauszug Shortcode, PDF Ausgabe Zusatztext)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<?php if ( get_option( 'users_can_register' ) == 0 ) { ?>
					<p class="dsdvo_options">
						<b><?php echo __("INFO", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Die Benutzeranmeldung ist in den WordPress Einstellungen deaktiviert. Falls Sie keine Registration erlauben können Sie diesen Punkt ignorieren", "dsgvo-all-in-one-for-wp"); ?>.<br />					
					</p>
					<?php } ?>					
					<p class="dsdvo_options">
						<b><?php echo __("Datenauszug", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Recht auf Auskunft", "dsgvo-all-in-one-for-wp"); ?>) <br />
						<input class="dsdvo_input"  type="text"  value="[dsgvo_show_user_data]" readonly/><br />
						 <label>
						<?php echo __("Der Shortcode erstellt eine Ausgabe aller gespeicherten Daten zu einem Benutzer.", "dsgvo-all-in-one-for-wp"); ?><br />
						<?php echo __("Fügen Sie den Shortcode auf der Seite ein auf welcher Sie die Daten anzeigen wollen.", "dsgvo-all-in-one-for-wp"); ?>
						<br />
						<b><?php echo __("Neu", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
						<?php echo __("Nutzen Sie statt dem Shortcode den Gutenberg Block - zu finden im Editor.", "dsgvo-all-in-one-for-wp"); ?>
						</label>
					</p>
					<br />
					<p class="dsdvo_options">
						<b><?php echo __("PDF Ausgabe der Daten", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Infotext", "dsgvo-all-in-one-for-wp"); ?>) <br />
						<?php if ($language == "de" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Deutsch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>							
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_pdf_text"  ><?php echo $dsgvo_pdf_text; ?></textarea><br />
						<?php } ?>
						<?php if ($language == "en" or $showpolylangoptions == true) { ?>
						<?php if ($showpolylangoptions == true) { ?>
						<b class="dsgvoaio_lang_info"><?php echo __("Englisch", "dsgvo-all-in-one-for-wp"); ?>:</b> <br />
						<?php } ?>	
						<textarea class="dsdvo_input"  rows="5" cols="10" name="dsgvo_pdf_text_en"><?php echo $dsgvo_pdf_text_en; ?></textarea><br />
						<?php } ?>						
						
						<label>
						<?php echo __("Geben Sie hier den Text ein der im PDF unten erscheinen soll", "dsgvo-all-in-one-for-wp"); ?>.<br />
						<?php echo __("Wollen Sie keinen Text anzeigen lassen Sie dieses Feld leer", "dsgvo-all-in-one-for-wp"); ?>.
						</label>
					</p>
					<br />
					</span>

					<br />
					<h2 class="dsgvoheader"><a><span class="dashicons dashicons-admin-generic"></span><?php echo __("Einstellungen Opt in & Out <span style='font-size:13px'>(Shortcode für die Ausgabe des aktuellen Status der Dienste)</span>", "dsgvo-all-in-one-for-wp"); ?></a></h2>
					<span class="dsgvooptionsinner">
					<p class="dsdvo_options">
					<b><?php echo __("Opt in & Out Einstellungen", "dsgvo-all-in-one-for-wp"); ?>:</b> (<?php echo __("Wichtig", "dsgvo-all-in-one-for-wp"); ?>) <br />
					<input class="dsdvo_input"  type="text"  value="[dsgvo_service_control]" readonly/><br />
					<label>
					<?php echo __("Der Shortcode ermöglicht es dem Benutzer zu sehen welche Opt ins / externe Services er zugelassen hat und welche nicht.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Zudem kann der Benutzer die Rechte verändern welche externe Services zugelassen sind oder nicht.", "dsgvo-all-in-one-for-wp"); ?><br />
					<?php echo __("Fügen Sie den Shortcode auf der Seite ein auf welcher Sie die Daten anzeigen wollen.", "dsgvo-all-in-one-for-wp"); ?>
					<br />
					<b><?php echo __("Neu", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;</b>
					<?php echo __("Nutzen Sie statt dem Shortcode den Gutenberg Block - zu finden im Editor.", "dsgvo-all-in-one-for-wp"); ?>					
					</label>
					</p>
					<br />
					</span>

			</div>
			 <?php
				wp_nonce_field( 'dsgvo-settings');
				submit_button(__('Änderungen speichern', 'dsgvo-all-in-one-for-wp'), 'button button-primary dsgvoaiosubmit');
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
				<?php echo __("Notice aktiviert", "dsgvo-all-in-one-for-wp"); ?>:
				<?php if (get_option("dsdvo_show_policy") == "on") { ?>
					<span class="dashicons dashicons-yes"></span>
				<?php } else { ?>
					<span class="dashicons dashicons-no-alt"></span>
				<?php } ?>
			</li>
			<li>
				<?php echo __("Service Kontrolle anzeigen", "dsgvo-all-in-one-for-wp"); ?>:
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
						
						<?php echo __("Mehrsprachigkeit aktiv", "dsgvo-all-in-one-for-wp-pro"); ?>&nbsp;<span style="color:green"><?php echo $multiplugin; ?></span><br />
						
						
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
						<li><?php echo __("Datenschutzbestimmung", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_policy_status; ?></li>
					<?php } ?>
					<?php if (isset($dsgvo_imprint_status)) { ?>
						<li><?php echo __("Impressum", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_imprint_status; ?></li>
					<?php } ?>		
					<?php if ( get_option( 'users_can_register' ) == 1 ) { ?>
					<?php if (isset($dsgvo_user_remove_form_status)) { ?>
						<li><?php echo __("Benutzerdatenlöschung", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_user_remove_form_status; ?></li>
					<?php } ?>
					<?php if (isset($dsgvo_show_user_data_status)) { ?>
						<li><?php echo __("Benutzerdatenübersicht", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_show_user_data_status; ?></li>
					<?php } ?>	
					<?php } ?>
					<?php if (isset($dsgvo_opt_in_and_out_status)) { ?>
						<li><?php echo __("Opt in & Out Übersicht", "dsgvo-all-in-one-for-wp"); ?>:&nbsp;<?php echo $dsgvo_opt_in_and_out_status; ?></li>
					<?php } ?>
				</ul>
				<?php if ( get_option( 'users_can_register' ) == 1 ) { ?>
				<p <?php if ($shortcodecount > 5 or $shortcodecount == 5) { echo "style='display:none;'"; } ?>><u><?php echo __("Fügen Sie alle Shortcodes auf Seiten ein", "dsgvo-all-in-one-for-wp"); ?>!</u></p>
				<?php } else { ?>
				<p <?php if ($shortcodecount > 3 or $shortcodecount == 3) { echo "style='display:none;'"; } ?>><u><?php echo __("Fügen Sie alle Shortcodes auf Seiten ein", "dsgvo-all-in-one-for-wp"); ?>!</u></p>
				<?php } ?>
		</div>
		
<br />

	<div class="dsgvoaio_active_services">				
					
		<h2><?php echo __("Aktivierte Dienste", "dsgvo-all-in-one-for-wp"); ?></h2>
			
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
			<?php if (get_option("dsdvo_use_gatag") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Google Analytics (gtag.js)", "dsgvo-all-in-one-for-wp"); ?></li>
			<?php } ?>
			<?php if (get_option("dsdvo_use_facebookcomments") == "on") { ?>
				<li><span class="dashicons dashicons-plus"></span>&nbsp;<?php echo __("Facebook Kommentare", "dsgvo-all-in-one-for-wp"); ?></li>
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
			<li><?php echo __("Die Werte in Klammern sind die empfohlenen Werte. Sind diese Werte unterschritten  <u>kann</u> es zu Problemen beim speichern der Einstellungen kommen.", "dsgvo-all-in-one-for-wp"); ?></li>
		</ul>
		
<br />

	<h2><?php echo __("Viel mehr Optionen....", "dsgvo-all-in-one-for-wp"); ?></h2>
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
	
	
	<h2><?php echo __("Bewerte dieses Plugin....", "dsgvo-all-in-one-for-wp"); ?></h2>
	<?php $plugin_dir_path = dirname(__FILE__); ?>
	<a href="https://wordpress.org/support/plugin/dsgvo-all-in-one-for-wp/reviews/#new-post" target="_blank">
	<span class="starscontent">
		<span class="stars"><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span><span class="star">&#9733;</span></span>
		<p><?php echo __("Wenn Ihnen das Plugin gefällt würden wir uns über eine Bewertung sehr freuen.", "dsgvo-all-in-one-for-wp"); ?><br />
		<?php echo __("Geht schnell und so kannst du unsere Arbeit würdigen.", "dsgvo-all-in-one-for-wp"); ?><br /><br />
		<?php echo __("Bevor Sie eine schlechte Bewertung abgeben schildern Sie Ihre Probleme im Support Forum.", "dsgvo-all-in-one-for-wp"); ?>
		</p>
		<span class="rateplugin button button-primary"><?php echo __("Plugin bewerten", "dsgvo-all-in-one-for-wp"); ?></span>
	</span>
	</a>
</div>