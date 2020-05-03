<?php

 /*



 * Plugin Name: DSGVO All in one for WP



 * Version: 3.2



 * Plugin URI: http://www.dsgvo-for-wp.com



 * Description: Cookie Notice - Halten Sie Ihre WordPress Website DSGVO konform. Alles über ein Plugin - einfache Handhabung. Macht viele externe Dienste DSGVO konform nutzbar.



 * Author: Michael Leithold



 * Author URI: http://www.dsgvo-for-wp.com



 * Requires at least: 4.0



 * Tested up to: 5.4



 * License: GPLv2 or later



 * Text Domain: dsgvo-all-in-one-for-wp

 

 * Domain Path: /languages



 *



*/



 

// If this file is called directly, abort.

if ( ! defined( 'WPINC' ) ) {

	die;

}





add_action( 'plugins_loaded', 'dsgvoaio_loaded_textdomain');



function dsgvoaio_loaded_textdomain(){



    $loadfiles = load_plugin_textdomain('dsgvo-all-in-one-for-wp', false, 

    dirname( plugin_basename( __FILE__ ) ) . '/languages/' );



}





//Backend part

class dsdvo_wp_backend {

 

    public static function init() {
		
		add_action( 'admin_notices', __CLASS__ . '::dsgvo_aio_update_msg' );		
		
		add_action( 'wp_ajax_dsgvoaio_dismiss_update_msg_32', __CLASS__ . '::dsgvoaio_dismiss_update_msg_32' );
		
		add_action( 'admin_menu', __CLASS__ . '::dsgvo_aio_admin_menu' );

		add_action('admin_enqueue_scripts', __CLASS__ . '::dsgvo_aio_load_admin_css');

		add_action('wp_ajax_dsgvo_delete_usr_ip', __CLASS__ . '::dsgvo_ajax_remove_usr_ip');

		add_action( 'wp_ajax_reset_policy_service', __CLASS__ .'::dsgvo_reset_policy_service_func' );

		add_action( 'wp_ajax_dsgvoaio_export_log', __CLASS__ .'::dsgvoaio_export_log' );

		add_action( 'wp_ajax_dsgvoaio_write_log', __CLASS__ .'::dsgvoaio_write_log' );
		
		add_action( 'wp_ajax_nopriv_dsgvoaio_write_log', __CLASS__ .'::dsgvoaio_write_log' );
				
		add_action( 'wp_ajax_dsgvoaio_get_service_policy', __CLASS__ .'::dsgvoaio_get_service_policy' );

		add_action( 'wp_ajax_nopriv_dsgvoaio_get_service_policy', __CLASS__ .'::dsgvoaio_get_service_policy' );		

		add_action('wp_ajax_dsgvoaio_dismiss_cache_msg', __CLASS__ . '::dsgvoaio_dismiss_cache_msg');

		add_action( 'wp_ajax_nopriv_dsgvoaio_dismiss_cache_msg', __CLASS__ . '::dsgvoaio_dismiss_cache_msg' );		

		add_action( 'admin_init', __CLASS__ .'::dsgvoaio_check_autoptimize' );

		add_action( 'admin_init', __CLASS__ . '::dsgvoaiofree_process_settings_export' );
		
		add_action( 'admin_init', __CLASS__ . '::dsgvoaiofree_process_settings_import' );		
		
		add_action( 'admin_notices', __CLASS__ . '::dsgvoaiofree_settings_import_success' );
		
		add_action( 'wp_ajax_dsgvoaiofree_dismissed_notice_handler_import', __CLASS__ . '::dsgvoaiofree_dismissed_notice_handler_import' );	

		add_action( 'wp_ajax_dsgvoaiofree_delete_log_full', __CLASS__ .'::dsgvoaiofree_delete_log_full' );	

		include( plugin_dir_path(__FILE__ )."/core/inc/blocks.php");		
	}

	
	public static function dsgvoaio_dismiss_update_msg_32() {

		update_option( 'dsgvoaio_update_msg_32', TRUE );

		delete_option( 'dsgvoaio-update-adminnotice32' );

	}

	public static function dsgvoaiofree_dismissed_notice_handler_import() {

		update_option( 'dismissed-dsgvo_msg_import', TRUE );

	}
	
		
	public static function dsgvoaiofree_process_settings_export() {


		if( empty( $_POST['dsgvoaiofree_action'] ) || 'export_settings' != $_POST['dsgvoaiofree_action'] )
			return;

		if( ! wp_verify_nonce( $_POST['dsgvoaiofree_export_nonce'], 'dsgvoaiofree_export_nonce' ) )
			return;

		if( ! current_user_can( 'manage_options' ) )
			return;
		
		/**load settings datas**/
		include(dirname(__FILE__).'/core/inc/exporter_fetch_datas.php');

		ignore_user_abort( true );

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=dsgvoaio-free-settings-export-' . date( 'm-d-Y' ) . '.json' );
		header( "Expires: 0" );

		echo json_encode( $settings );
		exit;
	}


	public static function dsgvoaiofree_process_settings_import() {
	
		if( empty( $_POST['dsgvoaiofree_action'] ) || 'import_settings' != $_POST['dsgvoaiofree_action'] )
			return;
		
		if( ! wp_verify_nonce( $_POST['dsgvoaiofree_import_nonce'], 'dsgvoaiofree_import_nonce' ) )
			return;

		if( ! current_user_can( 'manage_options' ) )
			return;

		$extension = end( explode( '.', $_FILES['import_file']['name'] ) );

		if( $extension != 'json' ) {
			wp_die( __( 'Bitte laden Sie eine .json Datei hoch' ) );
		}

		$import_file = $_FILES['import_file']['tmp_name'];

		if( empty( $import_file ) ) {
			wp_die( __( 'Bitte wählen Sie eine Datei aus' ) );
		}
		
		
		$settings = json_decode( file_get_contents( $import_file ), true );
	
		if (isset($settings)) {
			foreach($settings as $optionname => $optionvalue) {
				update_option($optionname, $optionvalue, false);
			}
			
		}
		
		update_option( 'dismissed-dsgvo_msg_import', FALSE );

		wp_safe_redirect( admin_url( 'admin.php?page=dsgvoaio-free-settings-page&parm=importsuccess' ) ); exit;

	}	

	public static function dsgvoaiofree_delete_log_full() {

		if (isset($_POST['nonce']) && check_ajax_referer( 'dsgvoaio-delete-log-full-nonce', 'nonce' ) == 1) {
			delete_option('dsgvoaio_log');
		}
		wp_die();
	}
	
	public static function dsgvoaiofree_settings_import_success() {
			
			if (isset($_GET['parm'])) {
				if ($_GET['parm'] == 'importsuccess') {
					if ( ! get_option('dismissed-dsgvo_msg_import', FALSE ) ) {
					echo '
					<script>
					  jQuery(function($) {
						$( document ).on( \'click\', \'.dsgvoimportsuccess .notice-dismiss\', function () {
							var type = $( this ).closest( \'.dsgvoimportsuccess\' ).data( \'notice\' );
							$.ajax( ajaxurl,
							  {
								type: \'POST\',
								data: {
								  action: \'dsgvoaiofree_dismissed_notice_handler_import\',
								  type: type,
								}
							  } );
						  } );
					  });		
					</script>  
					';						
					?>
					<div class="notice dsgvoimportsuccess is-dismissible notice-success" data-notice="dsgvo_msg_after_import">			
						<p><span class="dashicons dashicons-yes"></span><?php echo __( 'Die Einstellungen wurden erfolgreich importiert.', 'dsgvo-all-in-one-for-wp' ); ?></p>
					</div>
					<?php
					}
				}
			}
			
	}	


	public static function dsgvoaio_dismiss_cache_msg() {

		update_option( 'dsgvoaio_dismiss_chache_msg', true );

		exit();

	}		

	

	public static function dsgvoaio_check_autoptimize($array_in) {

		if ( is_plugin_active( 'autoptimize/autoptimize.php' ) ) {

			add_filter('autoptimize_filter_js_dontmove', __CLASS__ . '::add_dsgvoaio_autoptimize');

		}

	}

			

	public static function add_dsgvoaio_autoptimize($array_in) {

		$array_in[] = '/wp-content/plugins/dsgvo-all-in-one-for-wp/';

		return $array_in;

	}



	public static function dsgvoaio_get_service_policy() {

		$policytext = "";

		if (isset($_POST['key'])) {

			

			include( plugin_dir_path(__FILE__ )."/core/inc/texts.php");

			

			if (!isset($language)) $language = wf_get_language();

			

			$key = $_POST['key'];

			

			if ($key == "wordpressmain") {

				$plugins_policy = "";

				if ($language == "de") {

					$policytext = get_option('dsdvo_wordpress_policy');

					if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

						$plugins_policy .= $woocommerce_policy_text;

					}	

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {

						$plugins_policy .= $polylang_policy_text;

					}	

					if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {

						$plugins_policy .= $wpml_policy_text;

					}

					$plugins_policy .= $dsgvoaio_policy;

				} else {

					$policytext = get_option('dsdvo_wordpress_policy_en');

					if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

						$plugins_policy .= $woocommerce_policy_text_en;

					}			

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {

						$plugins_policy .= $polylang_policy_text_en;

					}

					if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {

						$plugins_policy .= $wpml_policy_text_en;

					}	

						$plugins_policy .= $dsgvoaio_policy_en;

				}

			

				$policytext = str_replace('[dsgvoaio_plugins]', $plugins_policy, $policytext);

			}

			

			if ($key == "analytics") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_ga_policy');

				} else {

					$policytext = get_option('dsdvo_ga_policy_en');

				}

			}

			if ($key == "facebookpixel") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_fbpixel_policy');

				} else {

					$policytext = get_option('dsdvo_fbpixel_policy_en');

				}

			}

			if ($key == "matomo") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_piwik_policy');

				} else {

					$policytext = get_option('dsdvo_piwik_policy_en');

				}

			}

			if ($key == "vgwort") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_vgwort_policy');

				} else {

					$policytext = get_option('dsdvo_vgwort_policy_en');

				}

			}

			if ($key == "googletagmanager") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_gtagmanager_policy');

				} else {

					$policytext = get_option('dsdvo_gtagmanager_policy_en');

				}

			}

			if ($key == "facebookcomment") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_facebook_policy');

				} else {

					$policytext = get_option('dsdvo_facebook_policy_en');

				}

			}			

			if ($key == "facebook") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_facebook_policy');

				} else {

					$policytext = get_option('dsdvo_facebook_policy_en');

				}

			}

			if ($key == "linkedin") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_linkedin_policy');

				} else {

					$policytext = get_option('dsdvo_linkedin_policy_en');

				}

			}

			if ($key == "shareaholic") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_shareaholic_policy');

				} else {

					$policytext = get_option('dsdvo_shareaholic_policy_en');

				}

			}			

			if ($key == "twitter") {

				if ($language == "de") {

					$policytext = get_option('dsdvo_twitter_policy');

				} else {

					$policytext = get_option('dsdvo_twitter_policy_en');

				}

			}			

			

			if ($policytext == "") {

				$policytext = __( '<p>Es tut Uns Leid. Es ist kein Inhalt verfügbar. Bitte versuchen Sie es später erneut.<br >Sollten Sie der Administrator dieser Webseite sein - speichern Sie die Plugin Einstellungen!</p>', 'dsgvo-all-in-one-for-wp' );

			}

			

			echo wpautop(html_entity_decode(stripslashes($policytext), ENT_COMPAT, get_option('blog_charset')));

		} else {

			echo __( 'Es wurde kein key übergeben. Falls dieser Fehler weiterhin auftreten sollte kontaktieren Sie bitte den Pluginentwickler.', 'dsgvo-all-in-one-for-wp' );

		}

		



		

		wp_die();

	}
	

	public static function dsgvoaio_write_log() {

		if (isset($_POST['key']) && isset($_POST['state']) && isset($_POST['id']) && isset($_POST['name'])) {



			$datetime = current_time('H:i:s - d.m.Y');

			$clientip = $_SERVER['REMOTE_ADDR'];

			$clientipsplit = explode(".", $clientip);

			$clientip = $clientipsplit[0].'.'.$clientipsplit[1].'.'.$clientipsplit[2].'.XXX';

			

			$currentdatas = get_option('dsgvoaio_log', array());

			end($currentdatas);

			$lastkey = key($currentdatas);



			if (isset($lastkey) && $lastkey != 0) {

				$lastkey = $lastkey+1;

			} else {

				$lastkey = 0;

			}

			

			$datas = array($lastkey => array('key' => $_POST['key'], 'name' => $_POST['name'], 'state' => $_POST['state'], 'id' => $_POST['id'], 'timestep' => $datetime, 'ip' => $clientip, 'allvalue' => $_POST['allvalue']));

			

			if (isset($currentdatas[0])) {

				$newdata = array_merge_recursive($currentdatas, $datas);

				update_option('dsgvoaio_log', $newdata, false);

			} else {

				update_option('dsgvoaio_log', $datas, false);

			}

		}

		return '';

		wp_die();

	}	

	

	public static function dsgvoaio_export_log() {



		if (isset($_POST['nonce']) && check_ajax_referer( 'dsgvoaio-export-log-nonce', 'nonce' ) == 1) {

			

			if (!isset($_POST['uid'])) {

			

				$log_datas = get_option('dsgvoaio_log');

			

			} else {

				

				$log_datas = get_option('dsgvoaio_log');

				$newdatas = array();

				if (isset($log_datas) && $log_datas != "") {

					foreach ($log_datas as $log_entry_key => $log_entry_value) {

						if ($log_entry_value['id'] == $_POST['uid']) {

							

						if (isset($log_entry_value['allvalue']) && $log_entry_value['allvalue'] != "") {

							

							$allvalue = $log_entry_value['allvalue'];

							$allvalue = implode(',', $allvalue);

							

						} else {

							

							$allvalue = $log_entry_value['name'];

							

						}							

							

							$newdatas[] = array('id' => $log_entry_value['id'], 'ip' => $log_entry_value['ip'], 'name' => $allvalue, 'timestep' => $log_entry_value['timestep']);

							

						}

					}

					

				if (!isset($newdatas[0])) {

						wp_die(__( 'Fehler: Es wurden keine Einträge zur angegebenen UID gefunden. Bitte prüfen Sie die UID.', 'dsgvo-all-in-one-for-wp' ));

					} else {

						$log_datas = $newdatas;

					}



				}

			

			}	





			

			if (isset($log_datas) && $log_datas != "") {

				

				//***Create Log PDF and Save file***//

				require('core/inc/pdf/fpdf2.php');

				$pdf = new PDF_MC_Table();

				$pdf->AliasNbPages();



				$pdf->AddPage();

				$pdf->SetWidths(Array(15,35,35,60,25,25));

				$pdf->SetLineHeight(5);

				$pdf->SetAligns(Array('','','','','',''));

				$pdf->SetFont('Arial','B',10);

				



				/***Create header***/

				$pdf->Row(Array(

					'ID',

					"UID",

					"IP Adresse",

					"Dienst(e)",

					"Aktion",

					"Zeitpunkt"

				 ));	

				 

				$pdf->SetFont('Arial','',10);

			

				foreach ($log_datas as $log_entry_key => $log_entry_value) {



					if (isset($log_entry_value['allvalue']) && $log_entry_value['allvalue'] != "") {

						

						$allvalue = $log_entry_value['allvalue'];

						$allvalue = implode(',', $allvalue);

						

					} else {

						

						$allvalue = $log_entry_value['name'];

						

					}

					

					if ($log_entry_value['state'] == "true") {

						$stateval = __( 'Zugelassen', 'dsgvo-all-in-one-for-wp' );

					} else {

						$stateval = __( 'Abgelehnt', 'dsgvo-all-in-one-for-wp' );

					}

					

					/**Add values to cell**/

					$pdf->Row(Array(

					  $log_entry_key,

					  $log_entry_value['id'],

					  $log_entry_value['ip'],

					  $allvalue,

					  $stateval,

					  $log_entry_value['timestep']

					));					



							

				}	

			

				/**Check if log dir exist  if not create it & create filename**/

				$maindir = WP_CONTENT_DIR."/dsgvo-all-in-one-wp-pro/";

				$logdir = WP_CONTENT_DIR."/dsgvo-all-in-one-wp-pro/logs/";

				$filename = "optin_outout_log_".rand(10000000000000000,90000000000000000).".pdf";

				if(!file_exists($maindir)) {

					mkdir( $maindir );

				}

				if(!file_exists($logdir)) {

					mkdir( $logdir );

				}

				

	

				

				/**Save pdf file**/

				$pdf->Output('F', $logdir.$filename);

				

				echo '<p>'.__( 'Die Log Datei wurden erfolgreich als PDF Datei exportiert.', 'dsgvo-all-in-one-for-wp' ).'<br /><a href="'.content_url().'/dsgvo-all-in-one-wp-pro/logs/'.$filename.'" target="_blank" class="button button-primary">'.__( 'Log herunterladen', 'dsgvo-all-in-one-for-wp' ).'</a></p>';

			}

			

			



		} else {

			echo __( 'Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support', 'dsgvo-all-in-one-for-wp' );

		}

		wp_die();

	}



	public static function dsgvo_reset_policy_service_func() {

		

		if (isset($_POST['service'])) {

			

		include( plugin_dir_path(__FILE__ )."/core/inc/texts.php");

		if ($_POST['service'] == "updatev31") {
			update_option('dsdvo_updatev31', '1' ,false);
		}

		if ($_POST['service'] == "ga" or $_POST['service'] == "allpolicys" or $_POST['service'] == "updatev31") {

			update_option("dsdvo_ga_policy", html_entity_decode(stripslashes($ga_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_ga_policy_en", html_entity_decode(stripslashes($ga_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}

		

		if ($_POST['service'] == "mainpolicy" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_policy_text_1", htmlentities(stripslashes($policy_demo_text), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_policy_text_en", htmlentities(stripslashes($policy_demo_text_en), ENT_COMPAT, get_option('blog_charset')), false);

		}		

		

		if ($_POST['service'] == "matomo" or $_POST['service'] == "allpolicys" or $_POST['service'] == "updatev31") {

			update_option("dsdvo_piwik_policy", html_entity_decode(stripslashes($matomo_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_piwik_policy_en", html_entity_decode(stripslashes($matomo_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}		

		

		if ($_POST['service'] == "fbpixel" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_fbpixel_policy", html_entity_decode(stripslashes($fbpixel_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_fbpixel_policy_en", html_entity_decode(stripslashes($fbpixel_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}	



		if ($_POST['service'] == "gtag" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_gtagmanager_policy", html_entity_decode(stripslashes($gtagmanager_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_gtagmanager_policy_en", html_entity_decode(stripslashes($gtagmanager_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}	



		if ($_POST['service'] == "vgwort" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_vgwort_policy", html_entity_decode(stripslashes($vgwort_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_vgwort_policy_en", html_entity_decode(stripslashes($vgwort_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}	

		

		if ($_POST['service'] == "wordpress" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_wordpress_policy", html_entity_decode(stripslashes($wordpress_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_wordpress_policy_en", html_entity_decode(stripslashes($wordpress_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}			



		if ($_POST['service'] == "shareaholic" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_shareaholic_policy", html_entity_decode(stripslashes($shareaholic_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_shareaholic_policy_en", html_entity_decode(stripslashes($shareaholic_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}	



		if ($_POST['service'] == "fb" or $_POST['service'] == "allpolicys") {

			update_option("dsdvo_facebook_policy", html_entity_decode(stripslashes($facebook_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_facebook_policy_en", html_entity_decode(stripslashes($facebook_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}	



		if ($_POST['service'] == "twitter" or $_POST['service'] == "allpolicys" or $_POST['service'] == "updatev31") {

			update_option("dsdvo_twitter_policy", html_entity_decode(stripslashes($twitter_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_twitter_policy_en", html_entity_decode(stripslashes($twitter_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}		



		if ($_POST['service'] == "linkedin" or $_POST['service'] == "allpolicys" or $_POST['service'] == "updatev31") {

			update_option("dsdvo_linkedin_policy", html_entity_decode(stripslashes($linkedin_policy_sample), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_linkedin_policy_en", html_entity_decode(stripslashes($linkedin_policy_sample_en), ENT_COMPAT, get_option('blog_charset')), false);

		}





		if ($_POST['service'] == "allpolicys") {

			update_option("dsdvo_policy_text_1", html_entity_decode(stripslashes($policy_demo_text), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_policy_text_en", html_entity_decode(stripslashes($policy_demo_text_en), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_allpolicyreloaded", "1", false);

		}

		

		

		if ($_POST['service'] == "cookietext") {

			update_option("dsdvo_cookie_text", html_entity_decode(stripslashes("Wir verwenden technisch notwendige Cookies auf unserer Webseite sowie externe Dienste.<br />Standardmäßig sind alle externen Dienste deaktiviert. Sie können diese jedoch nach belieben aktivieren & deaktivieren.<br/>Für weitere Informationen lesen Sie unsere Datenschutzbestimmungen."), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_cookie_text_en", html_entity_decode(stripslashes("We use technically necessary cookies on our website and external services.<br/>By default, all services are disabled. You can turn or off each service if you need them or not.<br />For more informations please read our privacy policy."), ENT_COMPAT, get_option('blog_charset')), false);

			update_option("dsdvo_cookietextreloaded", "1", false);

		}		

		

		echo __("Der jeweilige Datenschutztext wurde neu geladen. Die Seite wird nun neu geladen um die Änderungen wirksam zu machen.", "dsgvo-all-in-one-for-wp");

		

		}

		die();

	}


	public static function dsgvo_ajax_remove_usr_ip(){



		$reponse = array();

		global $wpdb;

		$db_prefix = $wpdb->base_prefix;

		if(!empty($_POST['param'])){

			//$response = array();

			if (is_admin()) {

				//echo "oki";

				$countupdaterows = $wpdb->query($wpdb->prepare("UPDATE ".$db_prefix."comments SET comment_author_IP = '%s'", ' '));

				//echo $countupdaterows;

				if($countupdaterows == 0) {

					 $response['response'] = "Der Query war erfolgreich aber es gibt keine IP Adressen zu löschen in der Datenbank da keine gespeichert sind." ;

				} else {

					$response['response'] = "Die IP Adressen die bei den Kommentaren gespeichert sind wurden erfolgreich gelöscht. \r\n Es wurden ".$countupdaterows." IP Adressen gelöscht." ;			

				}

				

			} else {

				

				$response['response'] = "Dir fehlen die noetigen Rechte um diese Aktion durchzufuehren!";

				

			}

			

		} else {

			

			 $response['response'] = "Es ist ein Fehler aufgetreten , es wurde kein Paramter uebergeben.";

			 

		}

	



		header( "Content-Type: application/json" );

		echo json_encode($response);

		exit();



	}	

	

	public static function dsgvo_aio_load_admin_css($hook)

    {

		wp_enqueue_style('dsgvo_admin_css', plugins_url('assets/css/admin.css',__FILE__ ));

		wp_enqueue_script('dsgvoaio_adminjs', plugins_url('assets/js/admin.js',__FILE__ ));	

		

		wp_enqueue_script('dsgvoaio_datatables_js', plugins_url('assets/js/datatables.min.js',__FILE__ ));

		wp_enqueue_style('dsgvoaio_datatables_css', plugins_url('assets/css/datatables.min.css',__FILE__ ));		

	}

	public static function dsgvo_aio_update_msg(){
		
		if ( ! get_option('dismissed-dsgvoaio_update_msg_32', FALSE ) ) {

			if( get_option( 'dsgvoaio-update-adminnotice32' ) == 1 ){

					echo '

					<script>

					  jQuery(function($) {

						$( document ).on( \'click\', \'.dsgvoaio_update_32 .notice-dismiss\', function () {

							var type = $( this ).closest( \'.dsgvoaio_update_32\' ).data( \'notice\' );

							$.ajax( ajaxurl,

							  {


								type: \'POST\',

								data: {

								  action: \'dsgvoaio_dismiss_update_msg_32\',

								  type: type,

								}

							  } );

						  } );

					  });		

					</script>  

					';

				 ?>
				 
		<div class="notice dsgvoaio_update_32 is-dismissible notice-success" data-notice="dsgvoaio_update_msg_32">

		<h2><?php echo __( 'Das Update von DSGVO AIO war erfolgreich', 'dsgvo-all-in-one-for-wp' ); ?></h2>

		<p><h4 style="color:orange;margin:0"><?php echo __( 'INFO', 'dsgvo-all-in-one-for-wp' ); ?></h4></p>
					
		<p><?php echo __( '<b>Wichtig:</b> Löschen Sie nach dem Update Ihren Browser Cache sowie falls Sie Cache Plugins benutzen auch hier den Cache' , 'dsgvo-all-in-one-for-wp'); ?>!</p>		
					
		<p><h4 style="margin:0;color:#46b450"><?php echo __( 'Changelog V3.2', 'dsgvo-all-in-one-for-wp' ); ?></h4></p>

		<h4 style="margin:0"><?php echo __( 'Neue Funktionen / Verbesserungen', 'dsgvo-all-in-one-for-wp' ); ?>:</h4>

		<ul>

			<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Gutenberg Blocks integriert - auffindbar unter Seite bearbeiten - Block hinzufügen - Suchbegriff = DSGVO', 'dsgvo-all-in-one-for-wp' ); ?></li>
			<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Impressum Generator integriert', 'dsgvo-all-in-one-for-wp' ); ?></li>
			<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Spamschutz - Email Adresse im Quellcode verschlüsselt', 'dsgvo-all-in-one-for-wp' ); ?></li>
			<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Cookie Notice Design/Layout 3 - Sprachumschalter (bei Mehrsprachigkeit) + schließen Funktion hinzugefügt', 'dsgvo-all-in-one-for-wp' ); ?></li>

		</ul>	
		<br />
		<h4 style="margin:0"><?php echo __( 'Bugfixes', 'dsgvo-all-in-one-for-wp' ); ?></h4>

		<ul>
			<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Facebook Kommentare - Bug behoben', 'dsgvo-all-in-one-for-wp' ); ?></li>	
		</ul>
		
		<br />					
		<p><a href="./admin.php?page=dsgvoaio-settings-page" class="button button-primary checkdsgvosettings"><span class="dashicons dashicons-admin-tools"></span><?php echo __( ' Einstellungen jetzt pr&uuml;fen/anpassen', 'dsgvo-all-in-one-for-wp' ); ?>&nbsp;<span class="dashicons dashicons-admin-tools"></span></a></p>
		<br />
		<p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>
		<p><b><?php echo __( 'Wenn Ihnen unser Plugin gef&auml;llt und Sie uns danken wollen für die stätige Weiterwentwicklung des Plugins freuen wir uns &uuml;ber eine Bewertung.' , 'dsgvo-all-in-one-for-wp'); ?></b></p>
		<p><?php echo __( 'Wir geben uns sehr viel Mühe bei der stätigen Weiterenwicklung des Plugins. Ebenso setzen wir neue Gesetze bzgl. DSGVO direkt nach bekanntwerden um.' , 'dsgvo-all-in-one-for-wp'); ?></p><br />
		<p><a href="https://wordpress.org/support/plugin/dsgvo-all-in-one-for-wp/reviews/#new-post" target="_blank" class="button button-primary"><?php echo __( 'Bewertung jetzt abgeben', 'dsgvo-all-in-one-for-wp' ); ?></a></p>
					
		<br />
		</div>		
		<?php }

		}
	
	}

	public static function dsgvo_aio_admin_menu(){

		

		add_menu_page( 'DSGVO All in one for WP', 'DSGVO AIO ', 'manage_options', 'dsgvoaio-free-settings-page', __CLASS__ . '::dsdvo_settings' );

		add_submenu_page('dsgvoaio-free-settings-page', 'Log', 'Opt-in/Opt-out Log', 'manage_options', 'dsgvoaiofree-show-log', __CLASS__ . '::dsgvoaiofree_backend_show_log');		
		
		add_submenu_page('dsgvoaio-free-settings-page', 'Einstellungen importieren/exportieren', 'Import / Export', 'manage_options', 'dsgvoaio-free-import-export', __CLASS__ . '::dsgvoaiofree_backend_import_export');			

	}


	public static function dsgvoaiofree_backend_import_export() {	
		include('core/inc/import_export.php');
	}		


	public static function dsgvoaiofree_backend_show_log() {	

		include('core/inc/backend_show_log.php');

	}	

 	

	public static function dsdvo_settings() {

		include('core/inc/backend_settings.php');

	}



}

dsdvo_wp_backend::init();

 





//Frontend part

class dsdvo_wp_frontend {

	

	 public static function init() {

		add_action( 'init', __CLASS__ . '::dsgvoaiofree_downoad_pdf' );	 
		 

		if (get_option("dsdvo_show_policy") == "on") {

			add_action( 'wp_footer', __CLASS__ . '::dsdvo_wp_mlfactory_cookies' );

		}

		

		if (get_option("dsdvo_show_policy") == "on") {

			add_action( 'wp_enqueue_scripts', __CLASS__ . '::dsdvo_wp_add_scripts');

			add_action( 'wp_enqueue_scripts', __CLASS__ . '::dsgvoaio_control_func' );

		}



		if (get_option("dsdvo_show_rejectbtn") == "on") {

			add_action('wp_head', __CLASS__ . '::style_rejectbtn', 100);			

		}			

		

	

		$blog_agb = get_option("dsdvo_blog_agb");

		if ($blog_agb == "on") {

			add_filter('comment_form_after_fields', __CLASS__ . '::dsdvo_my_comment_form_field_comment');

			add_filter('comment_form_logged_in_after', __CLASS__ . '::dsdvo_my_comment_form_field_comment');

			add_action('wp_footer',__CLASS__ . '::dsdvo_valdate_privacy_comment_javascript');

			if(!is_admin()) {

				add_filter( 'preprocess_comment', __CLASS__ . '::dsdvo_verify_comment_privacy' );

			}			

			add_action( 'comment_post', __CLASS__ . '::dsdvo_save_comment_privacy' );

		}	

		add_shortcode('dsgvo_service_control', array( 'dsdvo_wp_frontend', 'dsgvo_service_control_func' ));

		add_shortcode('dsgvo_twitter_button', array( 'dsdvo_wp_frontend', 'dsgvo_twitter_button_func' ));

		add_shortcode('dsgvo_linkedin', array( 'dsdvo_wp_frontend', 'dsgvo_linkedin_func' ));

		add_shortcode('dsgvo_addthis', array( 'dsdvo_wp_frontend', 'dsgvo_addthis_func' ));

		add_shortcode('dsgvo_facebook_like', array( 'dsdvo_wp_frontend', 'dsgvo_facebooklike_func' ));

		add_shortcode( 'dsgvo_facebook_comments', array( 'dsdvo_wp_frontend', 'dsgvo_facebookcommentar_func'));

		add_shortcode( 'dsgvo_vgwort', array( 'dsdvo_wp_frontend', 'dsgvo_vgwort_func'));

		add_shortcode( 'dsgvo_shareaholic', array( 'dsdvo_wp_frontend', 'dsgvo_shareaholic_func'));



		//Update Notice Ajax

		add_action( 'wp_ajax_dsgvoaio_dismissed_notice_handler', __CLASS__ . '::dsgvo_ajax_notice_handler' );

		add_action( 'upgrader_process_complete', __CLASS__ . '::dsgvoaio_upgrade_completed', 10, 2 );



		//Message after update plugin

		add_action( 'admin_notices', __CLASS__ . '::dsgvo_func_msg_after_update' );



		//Message after install plugin

		register_activation_hook( __FILE__, __CLASS__ . '::dsgvoaio_activation_hook' );

		

		if( get_option( 'dsgvoaio_dismiss_chache_msg' ) != true ) {

			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

			if ( is_plugin_active( 'autoptimize/autoptimize.php' ) or is_plugin_active( 'wp-rocket/wp-rocket.php' )) {

				

				add_action('admin_notices',   __CLASS__ . '::dsgvoaio_notice_cacheplugins');

			}

		}

		add_shortcode( 'dsgvo_imprint', array( 'dsdvo_wp_frontend', 'dsgvo_show_imprint' ) );
		
		add_shortcode( 'dsgvo_user_remove_form', array( 'dsdvo_wp_frontend', 'dsdvo_user_remove_form_func' ) );				

		add_shortcode( 'dsgvo_policy', array( 'dsdvo_wp_frontend', 'dsgvo_show_policy' ) );

		add_shortcode( 'dsgvo_show_user_data', array( 'dsdvo_wp_frontend', 'dsgvo_get_user_datas' ) );

		

		

		//comment save no ip adress

		if (get_option("dsgvo_remove_ipaddr_auto") == "on") {

			add_filter( 'pre_comment_user_ip', __CLASS__ . '::dsgvo_wpb_remove_commentsip' );

		}





		if (!function_exists('wf_get_language')) {



			function wf_get_language() {

				$language = null;

				//get language from polylang plugin https://wordpress.org/plugins/polylang/

				if(function_exists('pll_current_language'))

					$language = pll_current_language();

				//get language from wpml plugin https://wpml.org

				elseif(defined('ICL_LANGUAGE_CODE'))

					$language = ICL_LANGUAGE_CODE;

				else

					$language = substr(get_locale(),0,2);

					//if not de or en set en

					if ($language != "de") {

						$language = "en";

					}

					return $language;

			}



		}		

		

		

			

		//Popup BG Color

		if (get_option("dsgvo_notice_design")) {	

		add_action('wp_head', __CLASS__ . '::style_dsgvoaio', 100);

		}

		

		if (get_option("dsdvo_use_vgwort") == "on" && get_option("dsdvo_remove_vgwort") == "on" && !is_admin()) {

			add_action("wp_loaded", __CLASS__ . '::dsgvoaio_disable_vgwort_ob_start');

		}		

		

		if (get_option("dsdvo_use_gtagmanager") == "on" && get_option("dsdvo_remove_gtagmanager") == "on" && !is_admin()) {

			add_action("wp_loaded", __CLASS__ . '::dsgvoaio_disable_gtagmanager_ob_start');

		}				

		

		

		function dsgvo_show_policy_popup() {

			$notice_style = get_option("dsgvo_notice_style", "3");

			if ($notice_style == "3") {

			

			if (!isset($language)) $language = wf_get_language();

			

			if ($language == "de") {

				$policy_text_1 = get_option("dsdvo_policy_text_1");

			}

			

			if ($language == "en") {

				$policy_text_1 = get_option("dsdvo_policy_text_en");

			}

						

			$now = new DateTime();

			$update_date = $now->format('d.m.Y');

			$content = "";

			if ($policy_text_1) {

				$content .= str_replace("[dsgvo_save_date]", $update_date, "<div class='dsgvo_aio_policy'>".html_entity_decode(stripcslashes($policy_text_1), ENT_COMPAT, get_option('blog_charset'))."</div>");


				/***WP and Plugins Policy**/

				include( plugin_dir_path(__FILE__ )."/core/inc/texts.php");
				
				$plugins_policy = "";

				if ($language == "de") {

					$policytext = wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_wordpress_policy")), ENT_COMPAT, get_option('blog_charset')));

					if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($woocommerce_policy_text), ENT_COMPAT, get_option('blog_charset')));

					}	

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($polylang_policy_text), ENT_COMPAT, get_option('blog_charset')));

					}	

					if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($wpml_policy_text), ENT_COMPAT, get_option('blog_charset')));

					}

					$plugins_policy .= wpautop(html_entity_decode(stripslashes($dsgvoaio_policy), ENT_COMPAT, get_option('blog_charset')));

				} else {

					$policytext = wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_wordpress_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($woocommerce_policy_text_en), ENT_COMPAT, get_option('blog_charset')));

					}			

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($polylang_policy_text_en), ENT_COMPAT, get_option('blog_charset')));

					}

					if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($wpml_policy_text_en), ENT_COMPAT, get_option('blog_charset')));

					}	

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($dsgvoaio_policy_en), ENT_COMPAT, get_option('blog_charset')));

				}				
				
				if (isset($policytext) && !empty($policytext)) {
					$policytext = str_replace('[dsgvoaio_plugins]', $plugins_policy, $policytext);
					$content .= $policytext;
				}
				
						

				if (get_option('dsdvo_use_vgwort') == "on" && !empty(get_option("dsdvo_vgwort_policy")) or get_option('dsdvo_use_vgwort') == "on" && !empty(get_option("dsdvo_vgwort_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_vgwort_policy")), ENT_COMPAT, get_option('blog_charset'));



					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_vgwort_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					} 					

				}



				

				if (get_option('dsdvo_use_fbpixel') == "on" && !empty(get_option("dsdvo_fbpixel_policy")) or get_option('dsdvo_use_fbpixel') == "on" && !empty(get_option("dsdvo_fbpixel_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_fbpixel_policy")), ENT_COMPAT, get_option('blog_charset'));



					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_fbpixel_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					} 					

				}

				

				if (get_option('dsdvo_use_facebooklike') == "on" && !empty(get_option("dsdvo_facebook_policy")) or get_option('dsdvo_use_facebookcomments') == "on" && !empty(get_option("dsdvo_facebook_policy")) or get_option('dsdvo_use_facebooklike') == "on" && !empty(get_option("dsdvo_facebook_policy_en")) or get_option('dsdvo_use_facebookcomments') == "on" && !empty(get_option("dsdvo_facebook_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy")), ENT_COMPAT, get_option('blog_charset'));



					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					} 					

				}	

				

				if (get_option('dsdvo_use_twitter') == "on" && !empty(get_option("dsdvo_twitter_policy")) or get_option('dsdvo_use_twitter') == "on" && !empty(get_option("dsdvo_twitter_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_twitter_policy")), ENT_COMPAT, get_option('blog_charset'));



					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_twitter_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					} 					

				}		

				

				if (get_option('dsdvo_use_ga') == "on" && !empty(get_option("dsdvo_ga_policy")) or get_option('dsdvo_use_ga') == "on" && !empty(get_option("dsdvo_ga_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_ga_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_ga_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}



				if (get_option('dsdvo_use_disqus') == "on" && !empty(get_option("dsdvo_disqus_policy")) or get_option('dsdvo_use_disqus') == "on" && !empty(get_option("dsdvo_disqus_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_disqus_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_disqus_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}



				if (get_option('dsdvo_use_pinterest') == "on" && !empty(get_option("dsdvo_pinterest_policy")) or get_option('dsdvo_use_pinterest') == "on" && !empty(get_option("dsdvo_pinterest_policy_en")) or get_option('dsdvo_use_pinterestpin') == "on" && !empty(get_option("dsdvo_pinterest_policy")) or get_option('dsdvo_use_pinterestpin') == "on" && !empty(get_option("dsdvo_pinterest_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_pinterest_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_pinterest_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}	



				if (get_option('dsdvo_use_sharethis') == "on" && !empty(get_option("dsdvo_sharethis_policy")) or get_option('dsdvo_use_sharethis') == "on" && !empty(get_option("dsdvo_sharethis_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_sharethis_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_sharethis_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}	



				if (get_option('dsdvo_use_shareaholic') == "on" && !empty(get_option("dsdvo_shareaholic_policy")) or get_option('dsdvo_use_shareaholic') == "on" && !empty(get_option("dsdvo_shareaholic_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_shareaholic_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_shareaholic_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}	



				if (get_option('dsdvo_use_addthis') == "on" && !empty(get_option("dsdvo_addthis_policy")) or get_option('dsdvo_use_addthis') == "on" && !empty(get_option("dsdvo_addthis_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_addthis_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_addthis_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}	



				if (get_option('dsdvo_use_addtoanyshare') == "on" && !empty(get_option("dsdvo_addtoany_policy")) or get_option('dsdvo_use_addtoanyshare') == "on" && !empty(get_option("dsdvo_addtoany_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_addtoany_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_addtoany_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}	





				if (get_option('dsdvo_use_statcounter') == "on" && !empty(get_option("dsdvo_statcounter_policy")) or get_option('dsdvo_use_statcounter') == "on" && !empty(get_option("dsdvo_statcounter_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_statcounter_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_statcounter_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}	

				

				if (get_option('dsdvo_use_piwik') == "on" && !empty(get_option("dsdvo_piwik_policy")) or get_option('dsdvo_use_piwik') == "on" && !empty(get_option("dsdvo_piwik_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_piwik_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_piwik_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}		



				if (get_option('dsdvo_use_komoot') == "on" && !empty(get_option("dsdvo_komoot_policy")) or get_option('dsdvo_use_komoot') == "on" && !empty(get_option("dsdvo_komoot_policy_en"))) { 

					$content .= "<p>&nbsp;</p>";

					if ($language == "de") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_komoot_policy")), ENT_COMPAT, get_option('blog_charset'));

					} 

					if ($language == "en") {

					$content .= html_entity_decode(stripcslashes(get_option("dsdvo_komoot_policy_en")), ENT_COMPAT, get_option('blog_charset'));

					}				

				}		



				if (get_option('dsgvoaiocompanyname')) {

					$content = str_replace('[company]',get_option('dsgvoaiocompanyname'),$content);

				} else {

					$content = str_replace('[company]','',$content);

				}		



				if (get_option('dsgvoaioperson')) {

					$content = str_replace('[owner]',get_option('dsgvoaioperson'),$content);

				} else {

					$content = str_replace('[owner]','',$content);

				}



				if (get_option('dsgvoaiostreet')) {

					$content = str_replace('[adress]',get_option('dsgvoaiostreet'),$content);

				} else {

					$content = str_replace('[adress]','',$content);

				}



				if (get_option('dsgvoaiozip')) {

					$content = str_replace('[zip]',get_option('dsgvoaiozip'),$content);

				} else {

					$content = str_replace('[zip]','',$content);

				}



				if (get_option('dsgvoaiocity')) {

					$content = str_replace('[city]',get_option('dsgvoaiocity'),$content);

				} else {

					$content = str_replace('[city]','',$content);

				}



				if (get_option('dsgvoaiocountry')) {

					$content = str_replace('[country]',get_option('dsgvoaiocountry'),$content);

				} else {

					$content = str_replace('[country]','',$content);

				}



				if (get_option('dsgvoaiophone')) {

					$content = str_replace('[phone]',get_option('dsgvoaiophone'),$content);

				} else {

					$content = str_replace('[phone]','',$content);

				}
				
				if (get_option('dsgvoaiofax')) {

					$content = str_replace('[fax]',get_option('dsgvoaiofax'),$content);

				} else {

					$content = str_replace('[fax]','',$content);

				}				


				if (get_option('dsgvoaiomail')) {
			
					$mail = html_entity_decode(get_option('dsgvoaiomail'));
					$mailparts = explode('@', $mail);
					if (isset($mailparts[0])) { $mailpart1 = $mailparts[0];} else { $mailpart1 = ""; }
					if (isset($mailparts[1])) { $mailpart2 = $mailparts[1]; } else { $mailpart2 = ""; }
					
					$content = str_replace('[mail]', $mail, $content);

				} else {

					$content = str_replace('[mail]','',$content);

				}			



				if (get_option('dsdvo_legalform_ustid')) {

					$content = str_replace('[ust]',get_option('dsdvo_legalform_ustid'),$content);

				} else {

					$content = str_replace('[ust]','',$content);

				}				

				

			} else {

				$content = "<b>".__("Info", "dsgvo-all-in-one-for-wp").":</b> ".__("Bitte speichern Sie die Einstellungen im Backend unter \"DSGVO AIO\" um den Text der Datenschutzbedingungen hier auszugeben", "dsgvo-all-in-one-for-wp").".";

			}

			

			//$content = apply_filters('the_content', $content);

			//$content = strip_tags($content, '<h1><h2><h3><h4><h5><h6><a><u><i><ul><li>');

			return wpautop($content);    



			} else {

				return " ";

			}

		}		

	

		include_once(ABSPATH.'wp-admin/includes/plugin.php');
		/**if (get_option("dsdvo_remove_analytis") == "on" && !is_admin()) {
			add_action("wp_loaded", __CLASS__ . '::dsgvoaio_disable_analytics_ob_start');
		}**/
		if (get_option('dsdvo_ga_type', 'manual') == "monterinsights" && !is_admin() && get_option("dsdvo_use_ga", "off") == "on" && is_plugin_active( 'google-analytics-for-wordpress/googleanalytics.php' ) or get_option('dsdvo_ga_type', 'manual') == "monterinsights" && !is_admin() && get_option("dsdvo_use_ga", "off") == "on" && is_plugin_active( 'google-analytics-premium/googleanalytics-premium.php' )) {
				
			remove_filter( 'monsterinsights_frontend_output_analytics_src', 10 );
				
			add_filter( 'monsterinsights_frontend_output_analytics_src', __CLASS__ . '::dsgvoaiofree_remove_monsterinsights_ressource', 10, 4 );
				
			add_action("wp_loaded", __CLASS__ . '::dsgvoaio_replace_monsterinsight_js');
				
		}


		if (get_option('dsdvo_ga_type', 'manual') == "analytify" && !is_admin() && get_option("dsdvo_use_ga", "off") == "on" && is_plugin_active( 'wp-analytify/wp-analytify.php' )) {
		
			add_action('plugins_loaded', __CLASS__ . '::dsgvoaio_analitify');

		}	
		

	}
	
	
		public static function dsgvoaiofree_downoad_pdf() {
			
			if( empty( $_POST['dsgvoaiofree_action'] ) || 'download_userdatas' != $_POST['dsgvoaiofree_action'] )
				return;

			if( ! wp_verify_nonce( $_POST['dsgvoaiofree_download_userdata_nonce'], 'dsgvoaiofree_download_userdata_nonce' ) )
				return;

			if( ! is_user_logged_in() )
				return;
			
			ignore_user_abort( true );

			nocache_headers();
			
			include(dirname(__FILE__).'/core/inc/create_pdf.php');

			header('Content-Description: File Transfer');
			 
			header("Content-type: application/octet-stream");
			
			header( 'Content-Disposition: attachment; filename='.basename($output_file_dir) );
			
			header('Expires: 0');
			
			header('Cache-Control: must-revalidate');
			
			header('Pragma: public');
			
			header('Content-Length: ' . filesize($output_file_dir));
			
			readfile( $output_file_dir);
			
			wp_delete_file($output_file_dir);
			
			exit;
			
			wp_die();

		}		

		public static function dsgvoaio_analitify() {
			ob_start(__CLASS__ . '::dsgvoaio_replace_analitify');
		}

		public static function dsgvoaio_replace_analitify($html) {
			
				if ( class_exists( 'WP_Analytify' ) ) {
					
				$analytify = WP_Analytify::get_instance();
				
					if ( class_exists( 'WP_ANALYTIFY_FUNCTIONS' ) ) {
						
						$ua_code = WP_ANALYTIFY_FUNCTIONS::get_UA_code();
						
						preg_match_all('/\<script(.*?)?\>[^<>]*GoogleAnalyticsObject[^<>]*<\/script\>/i', $html, $match);
						
						if (isset($match[0])) {
							$limit = 0;
							foreach ($match[0] as $data) {
								if (strpos($data, 'GoogleAnalyticsObject') !== false && $limit++ < 1) {
								$_SESSION['dsgvoaio_analytify_js'] = "";
								$_SESSION['dsgvoaio_analytify_js'] = str_replace('<script type="text/javascript">', '', str_replace('</script>', '', str_replace('<script>', '', $data)));
								}
							}
							
							$html = preg_replace('#<script>[^<>]*GoogleAnalyticsObject[^<>]*<\/script>#i', '', $html);
							
						}
						
					}
			}
			return $html;
		}

		public static function dsgvoaiofree_remove_monsterinsights_ressource() {
			return plugins_url('/dsgvo-all-in-one-for-wp/assets/js/analyticsdummy.js');
		}

		public static function dsgvoaio_replace_monsterinsight_js(){
			ob_start(__CLASS__ . '::dsgvoaio_replace_monsterinsight_js_ob_end');
		}

		public static function dsgvoaio_replace_monsterinsight_js_ob_end($html){
			
			preg_match_all('/\<script(.*?)?\>(.|\s)*?\mi_version(.|\s)*?\<\/script\>/i', $html, $match);

			if (isset($match[0])) {
				
				foreach ($match[0] as $data) {
					
					$_SESSION['dsgvoaio_monsterinsight_js'] = str_replace(plugins_url('/dsgvo-all-in-one-for-wp/assets/js/analyticsdummy.js'), 'https://www.google-analytics.com/analytics.js', str_replace('</script>', '', str_replace('<script type="text/javascript" data-cfasync="false">', '', $data)));

				}
				
				$html = preg_replace('#<script type=\"text\/javascript\" data-cfasync=\"false\">[^<>]*mi_version([^&"]+)[^<>]*<\/script>#is', '', $html);
				
			}
			
			return $html;
		}
			
		public static function dsgvoaio_disable_analytics_ob_start(){
			ob_start(__CLASS__ . '::dsgvoaio_disable_analytics_ob_end');
		}

		public static function dsgvoaio_disable_analytics_ob_end($html){

			$html = preg_replace('/<script[^<>]*\/\/(.*?)(googletagmanager).com\/[^<>]*><\/script>/i', '', $html);
			$html = preg_replace('/<script[^<>]*\/\/(.*?)(google-analytics).com\/[^<>]*><\/script>/i', '', $html);
			return $html;
		}
	 

		public static function dsgvoaio_notice_cacheplugins() {

			if (is_plugin_active( 'autoptimize/autoptimize.php' )) {

				$pluginname = "Autoptimze";

			} else if (is_plugin_active( 'wp-rocket/wp-rocket.php' )) {

				$pluginname = "WP Rocket";

			}		

			

		?>

			<script>

			jQuery( document ).ready( function() {

					

				jQuery( document ).on( 'click', '.dsgvocachepluginmsg .notice-dismiss', function() {

					var data = {

							action: 'dsgvoaio_dismiss_cache_msg',

					};

					

					jQuery.post( '<?php echo admin_url( 'admin-ajax.php' ); ?>', data, function(d) {

						

					});

				})	

			});	

			</script>

			<div class="notice notice-warning is-dismissible dsgvocachepluginmsg">

				<h3><?php echo __('Achtung - Cache / Minify Plugin gefunden!', 'dsgvo-all-in-one-for-wp'); ?></h3>

				<p><?php echo __('Sie verwenden', 'dsgvo-all-in-one-for-wp'); ?>

				<strong><?php echo $pluginname; ?></strong>.

				<?php echo __('Dies kann zu Problemen führen. Sie müssen die Plugineinstellungen eventuell anpassen  damit alles funktioniert sollte die Cookie Notice nicht angezeigt werden wenn unter Punkt #2 aktiviert. Weitere Infos dazu finden Sie auf der <a href="https://wordpress.org/plugins/dsgvo-all-in-one-for-wp/" target="blank">Wordpress Plugin Seite</a> unter FAQ.', 'dsgvo-all-in-one-for-wp'); ?>

				</p>

			</div>

			

		<?php 	

		}



		public static function dsgvoaio_disable_gtagmanager_ob_start(){

			ob_start(__CLASS__ . '::dsgvoaio_disable_gtagmanager_ob_end');	

		}	 

		

		public static function dsgvoaio_disable_gtagmanager_ob_end($html){

			

			if (strpos($html, 'googletagmanager.com/gtm.js') !== false) {

				$html = preg_replace('#https://(.*)googletagmanager.com/gtm.js#i', get_bloginfo('url')."/", $html);

			}

			

			if (strpos($html, 'googletagmanager.com/ns.html') !== false) {

				$html = preg_replace('#https://(.*)googletagmanager.com/ns.html#i', get_bloginfo('url')."/", $html);

			}			

			

			return $html;

			

		}

	 

		public static function dsgvoaio_disable_vgwort_ob_start(){

			ob_start(__CLASS__ . '::dsgvoaio_disable_vgwort_ob_end');	

		}



		public static function dsgvoaio_disable_vgwort_ob_end($html){





			$debug = "";

			preg_match_all('/<img(.*?)src="(.*?)vgwort(.*?)"(.*)>/', $html, $vgwortmatch);



			if (isset($vgwortmatch[0])) {

				foreach ($vgwortmatch[0] as $vgwortimg) {

					$debug .= $vgwortimg;

					if (isset($vgwortimg)) {

						$vgwortimgraw = $vgwortimg;

						$vgwortimg = str_replace('/', '\/',$vgwortimg);

						$html = preg_replace('/'.$vgwortimg.'/i' , '<div class="dsgvoaio_vgwort" data-vgwortcode="'.htmlentities($vgwortimgraw).'"></div>', $html);	

					}

				}

			}

			return $html;

		}			

	 

			public static function style_dsgvoaio($content = "") {

				if (get_option("dsgvo_notice_design") == "clear") {

					$content = "<style type='text/css'>";

					$content .= "
					.tarteaucitronInfoBox { color: #424242 !important; }
					.dsgvoaio_pol_header { background: #eaeaea;}
					.dsgvo_hide_policy_popup .dashicons {color: #424242 !important;}					

					#tarteaucitron #tarteaucitronServices .tarteaucitronMainLine {

						background: #eaeaea !important;

						border: 3px solid #eaeaea !important;

						border-left: 9px solid #eaeaea !important;

						border-top: 5px solid #eaeaea !important;

						margin-bottom: 0;

						margin-top: 21px;

						position: relative;

					}

					#tarteaucitron #tarteaucitronServices .tarteaucitronTitle a, #tarteaucitron b, #tarteaucitron #tarteaucitronServices .tarteaucitronMainLine .tarteaucitronName b, #tarteaucitron #tarteaucitronServices .tarteaucitronTitle, #tarteaucitronAlertSmall #tarteaucitronCookiesListContainer #tarteaucitronClosePanelCookie, #tarteaucitron #tarteaucitronClosePanel, #tarteaucitron #tarteaucitronServices .tarteaucitronMainLine .tarteaucitronName a, #tarteaucitron #tarteaucitronServices .tarteaucitronTitle a {

						color: #424242 !important;

					}

	

					#tarteaucitronAlertSmall #tarteaucitronCookiesListContainer #tarteaucitronCookiesList .tarteaucitronTitle, #tarteaucitron #tarteaucitronServices .tarteaucitronTitle, #tarteaucitron #tarteaucitronInfo, #tarteaucitron #tarteaucitronServices .tarteaucitronDetails {

						background: #eaeaea !important;

					}

					

					#tarteaucitronAlertSmall #tarteaucitronCookiesListContainer #tarteaucitronClosePanelCookie, #tarteaucitron #tarteaucitronClosePanel {

						background: #eaeaea !important;

						

					}

					

					#tarteaucitron .tarteaucitronBorder {

						background: #fff;

						border: 2px solid #eaeaea !important;

					}		



					#tarteaucitronAlertBig, #tarteaucitronManager {

						background: #eaeaea !important;

						color: #424242 !important;

					}	



					#tarteaucitronAlertBig #tarteaucitronCloseAlert {

						background: #ffffff !important;

						color: #424242 !important;

					}						

					.tac_activate {

						background: #eaeaea !important;

						color: #424242 !important;

					}	

					.tac_activate .tac_float b {

						color: #424242 !important;

					}

					

					

				 ";

				 

				 if (get_option("dsgvo_notice_style") == "2") {

					$content .= ".dsdvo-cookie-notice.style2 #tarteaucitronAlertBig #tarinner {background: #eaeaea !important;}";

					$content .= ".dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert, .dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert h1, .dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert h2, .dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert h3, .dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert h4, .dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert a  { color: #828080 !important; }";

					$content .= ".dsdvo-cookie-notice.style2 #tarteaucitronDisclaimerAlert a {text-decoration: underline;}";

				 }

				 

				 if (get_option("dsgvo_notice_style") == "3") {

					$content .= ".dsdvo-cookie-notice.style3 #tarteaucitronAlertBig #tarinner {background: #eaeaea !important;}";

					$content .= ".dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert, .dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert h1, .dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert h2, .dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert h3, .dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert h4, .dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert a  { color: #828080 !important; }";

					$content .= ".dsdvo-cookie-notice.style3 #tarteaucitronDisclaimerAlert a {text-decoration: underline;}";

				 }				 

				 $content .= "</style>";

				 

				 echo $content;

				}



			}	 



		public static function  dsgvo_wpb_remove_commentsip( $comment_author_ip ) {

			return '127.0.0.1';

		}

	 

		public static function dsgvoaio_activation_hook() {

			set_transient( 'dsgvoaioinstall-admin-notice', true, 5 );

		}

		

		public static function dsgvo_shareaholic_func($atts) {
			

				return '<div class="shareaholic-canvas" data-app="share_buttons" data-app-id="'.get_option("dsdvo_shareaholicappid").'"></div>';
			
		}			

		

		

		public static function dsgvo_youtube_func(){

			return '<div class="youtube_player" videoID="q5U0I32YHE0" width="" height="" theme="light" rel="1" controls="1" showinfo="0" autoplay="0"></div>';

		}

			

		public static function dsgvo_linkedin_func(){

			return '<span class="tacLinkedin"></span><script type="IN/Share" data-counter="right"></script>';

		}

		

		public static function dsgvo_addthis_func(){

			return '<div class="addthis_sharing_toolbox"></div>';

		}

		

		public static function dsgvo_twitter_button_func(){

			$twitter_username = get_option('dsdvo_twitterusername');



			if (isset($atts['datacount'])) {

				$datacount = $atts['datacount'];

			} else {

				$datacount = "vertical";

			}	



			if (isset($atts['height'])) {

				$height = $atts['height'];

			} else {

				$height = "640px";

			}

				

			if (empty($twitter_username)) {

				$twitter_username = "";

			}

			return '<span class="tacTwitter"></span><a href="https://twitter.com/share" class="twitter-share-button" data-via="'.$twitter_username.'" data-count="'.$datacount.'" data-dnt="true"></a>';

		}

		

		public static function dsgvo_service_control_func(){

			return '<style>#tarteaucitronAlertSmall, #tarteaucitronManager { display: none !important;} #dsgvo_service_control #tarteaucitronServices {position: relative; float: left; width: 100%;}  #tarteaucitronBack, #tarteaucitronAlertBig { display: none !important;}</style><div id="dsgvo_service_control"></div>';

		}

		

		public static function dsgvo_facebooklike_func(){

			return '<div  class="fb-like" data-layout="box_count" data-action="like" data-share="true"></div>';

		}

		

		public static function dsgvo_facebookcommentar_func(){

			return '<div class="fb-comments" data-numposts="5" data-colorscheme="light" data-href="'.get_site_url().'"></div>';

		}		 

		

		public static function dsgvo_vgwort_func($atts){

			if (isset($atts['id'])) {

				$code = htmlentities('<img src="https://ssl-vg03.met.vgwort.de/na/'.$atts['id'].'" class="wp-worthy-pixel-img" data-no-lazy="1" height="1" width="1" alt="" />');

				return '<div class="dsgvoaio_vgwort" data-vgwortcode="'.$code.'"></div>';

			} else {

				return __("Keine ID im Shortcode definiert!", "dsgvo-all-in-one-for-wp");

			}				

		}				

	 

		//**Set Update Notice**//



		public static function dsgvo_func_msg_after_update() {



				if ( ! get_option('dismissed-dsgvo_msg_after_update_31', FALSE ) ) {

				$sure = __("Wollen Sie diese Aktion sicher ausführen?", "dsgvo-all-in-one-for-wp");

				$error = __("Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support.", "dsgvo-all-in-one-for-wp");

				if( get_transient( 'dsgvoaioupdate-admin-notice31' ) ){



					echo '

					<script>

					  jQuery(function($) {

						$( document ).on( \'click\', \'.dsgvoupdateinfo .notice-dismiss\', function () {

							var type = $( this ).closest( \'.dsgvoupdateinfo\' ).data( \'notice\' );

							$.ajax( ajaxurl,

							  {

								type: \'POST\',

								data: {

								  action: \'dsgvoaio_dismissed_notice_handler\',

								  type: type,

								}

							  } );

						  } );

					  });		

					jQuery(function($) {

						$( document ).on( \'click\', \'.dsgvoupdateinfo .reset_policy_service2\', function () {

						

							if (confirm("'.$sure.'")) {



							jQuery.ajax({

								type: \'POST\',

								url: \''.admin_url('admin-ajax.php').'\',

								data: {

								    \'service\': jQuery(this).data("service"),

									\'action\': \'reset_policy_service\'

								}, success: function (result) {



								   alert(result);

								   location.reload();

								},

								error: function () {

									alert("'.$error.'");

								}

							});

							}	

						  } );

					  });

					</script>  

					';

				 ?>

					<div class="notice dsgvoupdateinfo is-dismissible notice-success" data-notice="dsgvo_msg_after_update_29">

					<h2><?php echo __( 'Das Update von DSGVO All in One V3.1 war erfolgreich', 'dsgvo-all-in-one-for-wp' ); ?></h2>

					<p><h4 style="color:#46b450;margin:0"><?php echo __( 'INFO', 'dsgvo-all-in-one-for-wp' ); ?></h4></p>

					<p><?php echo __( 'Seit dem Update auf V3.1 ist es so, ,dass die Cookie Notice bzw. das Popup auch wieder angezeigt wird wenn kein externer Dienst gewählt ist.', 'dsgvo-all-in-one-for-wp' ); ?><br />

					<?php echo __( 'Wichtig: Löschen Sie Ihren Browser Cache sowie falls Sie Cache Plugins benutzen auch hier den Cache' , 'dsgvo-all-in-one-for-wp'); ?>!</p>

					<?php if (get_option('dsdvo_updatev31', '0') == '0') { ?>
					
					<br />		
					
					<p><h4 style="color:orange;margin:0"><?php echo __( 'WICHTIG', 'dsgvo-all-in-one-for-wp' ); ?></h4></p>

					<p><?php echo __( 'Die Datenschutztexte für Google Analytics, Matomo (Piwik), LinkedIn sowie Twitter wurden geändert' , 'dsgvo-all-in-one-for-wp'); ?>.</p>					

					<p><?php echo __( 'Es ist daher erforderlich diese Texte neu zu laden', 'dsgvo-all-in-one-for-wp' ); ?>.</p>					
					
					<p><button class="button button-primary reset_policy_service2" data-service="updatev31" ><?php echo __( 'Google Analytics, Matomo (Piwik), LinkedIn sowie Twitter Datenschutztexte jetzt neu laden', 'dsgvo-all-in-one-for-wp' ); ?></button></p>
					<?php } ?>
					<p><?php echo __( '<b>Ebenso sehr wichtig</b> - löschen Sie Ihren Browser Cache sowie falls Sie Cache Plugins benutzen auch hier den Cache' , 'dsgvo-all-in-one-for-wp'); ?>!</p>	
					
					
					<br />
					
					<p><h4 style="margin:0"><?php echo __( 'Changelog V3.1', 'dsgvo-all-in-one-for-wp' ); ?></h4></p>

					<p><b><?php echo __( 'Neue Funktionen', 'dsgvo-all-in-one-for-wp' ); ?>:</b></p>

					<ul>

						<li><span class="dashicons dashicons-yes"></span><?php echo __('Cookie Notice Animation hinzugefügt - Dauer frei wählbar', 'dsgvo-all-in-one-for-wp'); ?><li>			

						<li><span class="dashicons dashicons-yes"></span><?php echo __( 'MonsterInsights integriert (Google Analytics)', 'dsgvo-all-in-one-for-wp' ); ?></li>

						<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Analytify integriert (Google Analytics)', 'dsgvo-all-in-one-for-wp' ); ?></li>

						<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Import / Export Funktion integriert', 'dsgvo-all-in-one-for-wp' ); ?></li>		
						
						<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Log - löschen Funktion integriert', 'dsgvo-all-in-one-for-wp' ); ?></li>	
					</ul>					
					

					<p><h4 style="margin:0"><?php echo __( 'Bugfixes', 'dsgvo-all-in-one-for-wp' ); ?></h4></p>

					<ul>
						<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Cookie Notice - HTML Bug behoben beim speichern', 'dsgvo-all-in-one-for-wp' ); ?></li>	

						<li><span class="dashicons dashicons-yes"></span><?php echo __( 'Datenauszug via PDF - Funktion / PHP Code erneuert', 'dsgvo-all-in-one-for-wp' ); ?></li>						

					</ul>							

					<br />
					
					<p><b><?php echo __( '<b>Viele neue Funktionen in der neuen PRO Version verf&uumlgbar!</b>' , 'dsgvo-all-in-one-for-wp'); ?></b></p>

					<p><?php echo __( 'Wie z.B. OpenSreetMap (+LeafLetMap), Youtbe, Vimeo, SoundCloud, MixCloud, HearThis, Google Adsense + Maps, Instagram Feed, ReCaptcha v2 + v3, Custom IFrame / Content Blocker u.v.m.' , 'dsgvo-all-in-one-for-wp'); ?></p>

					<p><b><?php echo __( 'Wenn Ihnen unser Plugin gef&auml;llt und Sie uns danken wollen für die stätige Weiterwentwicklung des Plugins freuen wir uns &uuml;ber eine <a href="https://wordpress.org/support/plugin/dsgvo-all-in-one-for-wp/reviews/#new-post" target="blank">Bewertung</a>.' , 'dsgvo-all-in-one-for-wp'); ?></b></p>

					<p><?php echo __( 'Damit k&ouml;nnen auch Sie als Nutzer zum Erfolg beitragen und w&uuml;rdigen unsere Arbeit.' , 'dsgvo-all-in-one-for-wp'); ?></p>



					</div>

				<?php }

				}

		 

		}		

	 

	 

		public static function dsgvo_ajax_notice_handler() {

			update_option( 'dismissed-dsgvo_msg_after_update_31', TRUE );

			delete_transient( 'dsgvoaioupdate-admin-notice31' );

		}





		public static function dsgvoaio_upgrade_completed( $upgrader_object, $options ) {

		 $our_plugin = plugin_basename( __FILE__ );

		 if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {

		  foreach( $options['plugins'] as $plugin ) {

		   if( $plugin == $our_plugin ) {
			   
			$is_showed_31 = get_option( 'dismissed-dsgvo_msg_after_update_31', 'empty');
			
			if ($is_showed_31 == 'empty') {
				set_transient( 'dsgvoaioupdate-admin-notice31' );				
			}
			
			update_option( 'dsgvoaio-update-adminnotice32', 1 );

		   }

		  }

		 }

		}	 





		public static function dsdvo_my_comment_form_field_comment( $comment_field ) {

            $dsdvo_policy_site = get_option("dsdvo_policy_site");

	        echo '<div id="comment_datenschutz"><p class="pprivacy"><input type="checkbox" name="privacy" value="privacy-key" class="privacyBox" aria-req="true"><span class="required">*</span> '.html_entity_decode(get_option("dsgvo_policy_blog_text"), ENT_COMPAT, get_option('blog_charset')).' <p></div>';

}





		public static function dsdvo_valdate_privacy_comment_javascript(){

			if (is_single() && comments_open()){

				wp_enqueue_script('jquery');

				?>

				<script type="text/javascript">

				jQuery(document).ready(function($){

					$("#submit").click(function(e){

						if (!$('.privacyBox').prop('checked')){

							e.preventDefault();

							alert('<?php echo html_entity_decode(stripslashes(get_option("dsgvo_error_policy_blog")), ENT_COMPAT, get_option('blog_charset')); ?>');

							return false;

						}

					})

				});

				</script>

				<?php

			}

		}





		public static function dsdvo_verify_comment_privacy( $commentdata ) {

			if ( ! isset( $_POST['privacy'] ) )

				wp_die( __( 'Fehler: Sie m&uuml;ssen die Datenschutzbedingungen akzeptieren um ein Kommentar zu posten ....' ) );



			return $commentdata;

		}





		public static function dsdvo_save_comment_privacy( $comment_id ) {

			add_comment_meta( $comment_id, 'privacy', sanitize_text_field($_POST[ 'privacy' ]) );

		}		

		

		

		public static function dsgvoaio_control_func() {

			if (get_option("dsdvo_show_servicecontrol") == "on") {

				

				$dsgvoaio_control_style = "";

				

				if (get_option("dsgvo_position_service_control")) {

					$position_service_control = get_option("dsgvo_position_service_control");

				} else {

					$position_service_control = "topright";

				

				}

				

				

				if ($position_service_control == "bottomleft") {

					$dsgvoaio_control_style .= "

						.tarteaucitronAlertSmallTop {

							top: auto !important;

							bottom: 0 !important;

							left: 0 !important;

							right: auto !important;

						}			

					";

				}	

				

				if ($position_service_control == "bottomright") {

					$dsgvoaio_control_style .= "

						.tarteaucitronAlertSmallTop {

							top: auto !important;

							bottom: 0 !important;

							left: auto !important;

							right: 0 !important;

						}			

					";

				}			



				if ($position_service_control == "topleft") {

					$dsgvoaio_control_style .= "

						.tarteaucitronAlertSmallTop {

							top: 0;

							left: 0 !important;

							right: auto !important;

						}			

					";

				}

			



			wp_register_style( 'dsgvoaio_control', false );

			wp_enqueue_style( 'dsgvoaio_control' );

			wp_add_inline_style( 'dsgvoaio_control', $dsgvoaio_control_style );	

			}

		

		}	 

	 

		//add scripts

		public static function dsdvo_wp_add_scripts() {

			

			wp_enqueue_style('dashicons');			

			

			wp_register_style('dsgvoaio_frontend_css', plugins_url('assets/css/plugin.css',__FILE__ ));

			wp_enqueue_style('dsgvoaio_frontend_css');

			

			wp_enqueue_script('jquery');

			

			

			$cookietextscroll = "Durch das fortgesetzte bl&auml;ttern stimmen Sie der Nutzung von externen Diensten und Cookies zu.";

			

			wp_enqueue_script('dsdvo_tarteaucitron', plugins_url('assets/js/tarteaucitron/tarteaucitron.min.js',__FILE__ ));			

			$animation_time = get_option("dsgvo_animation_time", "1000");
				
			if (get_option("dsdvo_policy_site")) { $dsdvo_policy_site = get_option("dsdvo_policy_site"); } else { $dsdvo_policy_site = ""; }

			if (get_option("dsgvo_btn_txt_reject_url")) { $dsgvo_btn_txt_reject_url = get_option("dsgvo_btn_txt_reject_url"); } else { $dsgvo_btn_txt_reject_url = "www.google.de"; }

			if (get_option("dsdvo_show_rejectbtn")) { $dsdvo_show_rejectbtn = get_option("dsdvo_show_rejectbtn"); } else { $dsdvo_show_rejectbtn = "off"; }

			if (get_option("dsgvo_notice_design") == "clear") { $notice_design = "clear"; } else { $notice_design = "dark"; }	


			/**Reset auto accept v2.7 new dsgvo**/

			$auto_accept =  get_option("dsdvo_auto_accept");

			if ($auto_accept == "on") {

				update_option("dsdvo_auto_accept", "off");

			}

			if (!isset($language)) $language = wf_get_language();

			if ($language == "de") {

				

				$accepttext = "Alle erlauben";

				$denytext = "Alle ablehnen";

				$deactivatedtext = "ist deaktiviert.";

				$closetext = "Beenden";

				$cookietextusage = "Gespeicherte Cookies:";	

				$linkto = "Zur offiziellen Webseite";

				$cookietextusagebefore = "Folgende Cookies können gespeichert werden:";

				$usenocookies = "Dieser Dienst nutzt keine Cookies.";

				$nocookietext = "Dieser Dienst hat keine Cookies gespeichert.";

				$cookiedescriptiontext = "Wenn Sie diese Dienste nutzen, erlauben Sie deren 'Cookies' und Tracking-Funktionen, die zu ihrer ordnungsgemäßen Funktion notwendig sind.";

				$maincatname = "Allgemeine Cookies";

				$showpolicyname = "Datenschutzbedingungen / Cookies angezeigen";

				$yeslabel = "JA";

				$nolabel = "NEIN";				

				

				if (get_option("dsdvo_cookie_text")) { $cookietextnotice = html_entity_decode(stripslashes(wpautop(get_option("dsdvo_cookie_text"))), ENT_COMPAT, get_option('blog_charset')); } else { $cookietextnotice = "Wir verwenden technisch notwendige Cookies auf unserer Webseite sowie externe Dienste.<br />Standardmäßig sind alle externen Dienste deaktiviert. Sie können diese jedoch nach belieben aktivieren & deaktivieren.<br/>Für weitere Informationen lesen Sie unsere Datenschutzbestimmungen."; }				

				if (get_option("dsdvo_cookie_text_scroll")) { $onscrolltext = wpautop(html_entity_decode(stripslashes(get_option("dsdvo_cookie_text_scroll")), ENT_COMPAT, get_option('blog_charset'))); } else { $onscrolltext = "Durch das fortgesetzte blättern stimmen Sie der Benutzung von externen Diensten zu."; }				

				if (get_option("dsgvo_btn_txt_accept")) { $cookieaccepttext = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_accept")), ENT_COMPAT, get_option('blog_charset')); } else { $cookieaccepttext =  "Akzeptieren"; }

				if (get_option("dsgvo_btn_txt_customize")) { $btncustomizetxt = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_customize")), ENT_COMPAT, get_option('blog_charset')); } else { $btncustomizetxt =  "Personalisieren"; }

				if (get_option("dsgvo_btn_txt_reject")) { $dsgvo_btn_txt_reject = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_reject")), ENT_COMPAT, get_option('blog_charset')); } else { $dsgvo_btn_txt_reject = "Ablehnen"; }

				if (get_option("dsgvo_btn_txt_reject_text")) { $dsgvo_btn_txt_reject_text = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_reject_text")), ENT_COMPAT, get_option('blog_charset')); } else { $dsgvo_btn_txt_reject_text = "Sie haben die Bedingungen abgelehnt. Sie werden daher auf google.de weitergeleitet."; }			

				if (get_option("dsdvo_policy_text_1")) { $policytextnotice = html_entity_decode(stripslashes(wpautop(get_option("dsdvo_policy_text_1"))), ENT_COMPAT, get_option('blog_charset')); } else { $policytextnotice = ""; }			

			



			}



			if ($language == "en") {

				

				

				$accepttext = "Allow";

				$denytext = "Deny";	

				$deactivatedtext = "is inactive.";

				$closetext = "Close";

				$cookietextusage = "Used Cookies:";	

				$cookietextusagebefore = "This Cookies can be stored:";				

				$linkto = "To the official website";	

				$usenocookies = "This Servies use no Cookies.";

				$nocookietext = "This Service use currently no Cookies.";	

				$cookiedescriptiontext = "By using these services, you allow their 'cookies' and tracking features necessary for their proper functioning.";

				$maincatname = "General Cookies";

				$showpolicyname = "Show Privacy Policy / Cookie Details";

				$yeslabel = "YES";

				$nolabel = "NO";

				

				if (get_option("dsdvo_cookie_text_en")) { $cookietextnotice = html_entity_decode(stripslashes(wpautop(get_option("dsdvo_cookie_text_en"))), ENT_COMPAT, get_option('blog_charset')); } else { $cookietextnotice = "We use technically necessary cookies on our website and external services.<br/>By default, all services are disabled. You can turn or off each service if you need them or not.<br />For more informations please read our privacy policy."; }				

				if (get_option("dsdvo_cookie_text_scroll_en")) { $onscrolltext = html_entity_decode(stripslashes(wpautop(get_option("dsdvo_cookie_text_scroll_en"))), ENT_COMPAT, get_option('blog_charset')); } else { $onscrolltext = "By continuing to scroll, you consent to the use of external services."; }				

				if (get_option("dsgvo_btn_txt_accept_en")) { $cookieaccepttext = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_accept_en")), ENT_COMPAT, get_option('blog_charset')); } else { $cookieaccepttext =  "Accept"; }

				if (get_option("dsgvo_btn_txt_customize_en")) { $btncustomizetxt = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_customize_en")), ENT_COMPAT, get_option('blog_charset')); } else { $btncustomizetxt =  "Customize"; }

				if (get_option("dsgvo_btn_txt_reject_en")) { $dsgvo_btn_txt_reject = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_reject_en")), ENT_COMPAT, get_option('blog_charset')); } else { $dsgvo_btn_txt_reject = "Reject"; }

				if (get_option("dsgvo_btn_txt_reject_text_en")) { $dsgvo_btn_txt_reject_text = html_entity_decode(stripslashes(get_option("dsgvo_btn_txt_reject_text_en")), ENT_COMPAT, get_option('blog_charset')); } else { $dsgvo_btn_txt_reject_text = "You have rejected the conditions. You will be redirected to google.com."; }			

				if (get_option("dsdvo_policy_text_en")) { $policytextnotice = html_entity_decode(stripslashes(wpautop(get_option("dsdvo_policy_text_en"))), ENT_COMPAT, get_option('blog_charset')); } else { $policytextnotice = ""; }			

			

			}

			if ( is_plugin_active( 'polylang/polylang.php' )) {

				$polylangcookie = "pll_language";

			} else {

				$polylangcookie = "";

			}

			if ( is_plugin_active( 'woocommerce/woocommerce.php' )) {

				$woocommerce_cookies = array('woocommerce_cart_hash', 'woocommerce_items_in_cart', 'wp_woocommerce_session_{}', 'woocommerce_recently_viewed', 'store_notice[notice id]', 'tk_ai');

			} else {

				$woocommerce_cookies = " ";

			}

			$gaid = get_option("dsdvo_gaid");

			$fbpixelid = get_option("dsdvo_fbpixelid");	

			$cookie_time = get_option('dsdvo_cookie_time');

			if (!$cookie_time) { $cookie_time = 1;}

			$auto_accept =  get_option("dsdvo_auto_accept");

			if ($auto_accept == "on") { $highprivacy = "false";} else { $highprivacy = "true"; }

			if (!$auto_accept) { $highprivacy = "true"; }

			$cookie_not_acceptet = get_option('cookie_not_acceptet_text');

			$cookie_not_acceptet_url_1 = get_option('cookie_not_acceptet_url');

			$use_dnt = get_option("dsdvo_use_dnt");

			if ($use_dnt == "" or $use_dnt == "on") { $use_dnt = "true";} else { $use_dnt = "false"; }

			$use_dnt = "false";

			$display_noitce = "yes";
			
			if ( is_plugin_active( 'polylang/polylang.php' ) or is_plugin_active( 'translatepress-multilingual/index.php' )) {

				if ( is_plugin_active( 'polylang/polylang.php' )) {
				if ( !function_exists( 'pll_the_languages' ) ) { 
					require_once WP_PLUGIN_DIR .'/polylang/include/api.php'; 
				} 
				$switcher = pll_the_languages([
					'echo' => 0,
					'hide_if_empty' => 1,
					'dropdown' => 0,
					'show_names' => 0,
					'show_flags' => 1,
					'hide_current' => 0,
					]);		

				}
				
				if ( is_plugin_active( 'translatepress-multilingual/index.php' )) {
				 $switcher = "";
				}			

				$languageswitcher = '
				<ul class="dsgvo_lang_switcher">'.$switcher.'</ul>
				';
		
			} else {
				
				$languageswitcher = ' ';
				
			}			
			

			if( is_plugin_active( 'elementor/elementor.php' ) ) {

				if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {

					 $display_noitce = "no";

				} else {

					$display_noitce = "yes";

				}

			}

			$script = '
				tarteaucitron.init({

					"hashtag": "#tarteaucitron",

					"cookieName": "dsgvoaiowp_cookie", 

					"highPrivacy": '.$highprivacy.',

					"orientation": "center",

					"adblocker": false, 

					"showAlertSmall": true, 

					"cookieslist": true, 

					"removeCredit": true, 

					"expireCookie": '.$cookie_time.', 

					"handleBrowserDNTRequest": '.$use_dnt.', 

					//"cookieDomain": ".'.$_SERVER['SERVER_NAME'].'" 

					"removeCredit": true, 

					"moreInfoLink": false, 

					});
			';

			if ($language == "en") {

				$script .= "var tarteaucitronForceLanguage = 'en'";

			}

			if ($language == "de") {

				$script .= "var tarteaucitronForceLanguage = 'de'";				

			}			

			if ($display_noitce == "yes") {		

				wp_localize_script( 'dsdvo_tarteaucitron', 'parms', array('animation_time' => $animation_time, 'nolabel' => $nolabel, 'yeslabel' => $yeslabel, 'showpolicyname' => $showpolicyname,'maincatname' => $maincatname, 'language' => $language, 'woocommercecookies' => $woocommerce_cookies, 'polylangcookie' => $polylangcookie, 'usenocookies' => $usenocookies, 'nocookietext' => $nocookietext, 'cookietextusage' => $cookietextusage, 'cookietextusagebefore' => $cookietextusagebefore, 'adminajaxurl' => admin_url('admin-ajax.php'), 'vgwort_defaultoptinout' => get_option('dsdvo_vgwort_optinoutsetting'), 'ga_defaultoptinout' => get_option('dsdvo_ga_optinoutsetting'), 'notice_design' =>  $notice_design, 'expiretime' =>  get_option("dsdvo_cookie_time"), 'noticestyle' =>  'style'.get_option("dsgvo_notice_style", "3"), 'backgroundcolor' => '#333', 'textcolor' => '#ffffff', 'buttonbackground' => '#fff', 'buttontextcolor' => '#333', 'buttonlinkcolor' => get_option("dsgvo_cookienotice_linkcolor"), 'cookietext' => $cookietextnotice, 'cookieaccepttext' => $cookieaccepttext, 'btn_text_customize' => $btncustomizetxt, 'cookietextscroll' => $cookietextscroll, 'policyurl' => esc_url( get_permalink($dsdvo_policy_site) ), 'policyurltext' => 'Hier finden Sie unsere Datenschutzbestimmungen', 'ablehnentxt' => $dsgvo_btn_txt_reject, 'ablehnentext' => $dsgvo_btn_txt_reject_text, 'ablehnenurl' => $dsgvo_btn_txt_reject_url, 'showrejectbtn' => $dsdvo_show_rejectbtn, 'popupagbs' => dsgvo_show_policy_popup(), 'languageswitcher' => $languageswitcher));

				wp_enqueue_script('dsdvo_tarteaucitron');			

				wp_register_script( 'dsgvoaio_inline_js', '' );

				wp_enqueue_script( 'dsgvoaio_inline_js');

				wp_add_inline_script( 'dsgvoaio_inline_js', $script );

			}

		}	 

	 

		public static function style_rejectbtn() {

			echo "

			<style>

			@media screen and (min-width: 800px) {

				.dsdvo-cookie-notice.style1 #tarteaucitronDisclaimerAlert {

					float: left;

					width: 65% !important;

				}

			}
			@media screen and (max-width: 800px) {

				.dsdvo-cookie-notice.style1 #tarteaucitronDisclaimerAlert {

					float: left;

					width: 60% !important;

				}

			}
			</style>

			";

		}	 

	 

	 

		public static function dsdvo_wp_mlfactory_cookies() {

			

			$display_noitce = "yes";

				

			if( is_plugin_active( 'elementor/elementor.php' ) ) {

				if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {

					 $display_noitce = "no";

				} else {

					$display_noitce = "yes";

				}

			}

			

			if ($display_noitce == "yes") {

			$dsdvo_policy_site = get_option("dsdvo_policy_site");

			$notice_style = get_option("dsgvo_notice_style");

			if (!$notice_style) { $notice_style = "3"; }

			?>



			<?php if(get_option("dsdvo_show_servicecontrol") == "on") { ?>

			<style>

			#tarteaucitronManager {

				display: block;

			}

			</style>

			<?php }

			if(get_option("dsdvo_show_servicecontrol") != "on") {		?>

			<style>

			#tarteaucitronAlertSmall #tarteaucitronManager {

				display: none !important;

			}		

			</style>

			<?php } ?>			

			<script type="text/javascript">

				jQuery( document ).ready(function() {
					
				
				
				<?php if (get_option("dsdvo_use_shareaholic")) { ?>

					tarteaucitron.user.shareaholicSiteId = '<?php echo get_option("dsdvo_shareaholicsiteid"); ?>';

					(tarteaucitron.job = tarteaucitron.job || []).push('shareaholic');

				<?php } ?>					

				<?php if (get_option("dsdvo_use_twitter")) { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('twitter');

				<?php } ?>

				<?php if (get_option("dsdvo_use_vgwort")) { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('vgwort');

				<?php } ?>	

				<?php if (get_option("dsdvo_use_piwik") == "on") { ?>

						tarteaucitron.user.matomoId = '<?php echo html_entity_decode(get_option("dsgvo_piwik_siteid"), ENT_COMPAT, get_option('blog_charset')); ?>';

						tarteaucitron.user.matomoHost = '<?php echo html_entity_decode(get_option("dsgvo_piwik_host"), ENT_COMPAT, get_option('blog_charset')); ?>';
						
						tarteaucitron.user.matomoEndpoint = '<?php echo get_option("dsgvo_piwik_phpfile", "matomophp"); ?>';
						
						(tarteaucitron.job = tarteaucitron.job || []).push('matomo');

				<?php } ?>				

				<?php if ( get_option("dsdvo_use_ga") == "on") { ?>
					tarteaucitron.user.analytifycode = '<?php echo urlencode($_SESSION['dsgvoaio_analytify_js']); ?>';
					
					tarteaucitron.user.useanalytify = '<?php if (get_option('dsdvo_ga_type', 'manual') == "analytify") { echo "true"; } else { echo "false";} ?>';
					
					tarteaucitron.user.monsterinsightcode = '<?php echo urlencode($_SESSION['dsgvoaio_monsterinsight_js']); ?>';
					
					tarteaucitron.user.usemonsterinsight = '<?php if (get_option('dsdvo_ga_type', 'manual') == "monterinsights") { echo "true"; } else { echo "false";} ?>';
					
					tarteaucitron.user.analyticsAnonymizeIp = 'true';

					tarteaucitron.user.analyticsUa = '<?php echo get_option("dsdvo_gaid"); ?>';

					tarteaucitron.user.defaultoptinout = '<?php echo get_option("dsdvo_ga_optinoutsetting"); ?>';

					tarteaucitron.user.analyticsMore = function () { 

					/* add here your optionnal ga.push() */

					};

					(tarteaucitron.job = tarteaucitron.job || []).push('analytics');

				<?php } ?>

				<?php if (get_option("dsdvo_use_gtagmanager")) { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');

					tarteaucitron.user.googletagmanagerId = '<?php echo get_option("dsdvo_gtagmanagerid"); ?>';

				<?php } ?>				

				<?php if ( get_option("dsdvo_fbpixelid") && get_option("dsdvo_use_fbpixel") == "on") { ?>

					tarteaucitron.user.facebookpixelId = '<?php echo get_option("dsdvo_fbpixelid"); ?>'; 

					tarteaucitron.user.facebookpixelMore = function () { /* add here your optionnal facebook pixel function */ };

					(tarteaucitron.job = tarteaucitron.job || []).push('facebookpixel');

				<?php } ?>

				<?php if (get_option("dsdvo_use_facebookcomments") == "on") { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('facebookcomment');

				<?php } ?>

				<?php if (get_option("dsdvo_use_facebooklike") == "on") { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('facebook');

				<?php } ?>

				<?php if (get_option("dsdvo_use_twitter") == "on") { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('twitter');

				<?php } ?>

				<?php if (get_option("dsdvo_use_addthis") == "on") { ?>

					tarteaucitron.user.addthisPubId = '<?php echo get_option("dsdvo_addthisid"); ?>';

					(tarteaucitron.job = tarteaucitron.job || []).push('addthis');

				<?php } ?>

				<?php if (get_option("dsdvo_use_linkedin") == "on") { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('linkedin');

				<?php } ?>

				<?php if (get_option("dsdvo_use_youtube") == "on") { ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('youtube');

				<?php } ?>

					(tarteaucitron.job = tarteaucitron.job || []).push('wordpressmain');

				});

			</script>

			

			<?php	

			}

		}

		



		// shortcode user remove form

		public static function dsdvo_user_remove_form_func( $atts, $content = "" ) {

			if ( is_user_logged_in() ) {

			   return include("core/inc/user_remove_form.php");

			} else {

				$content .= __("Sie müssen eingeloggt sein um diese Aktion durchzuführen.", "dsgvo-all-in-one-for-wp"); 

			}			

			return $content;    

		}


		public static function dsgvo_show_imprint( $atts, $content = "" ) {
			include(dirname(__FILE__).'/core/inc/imprint.php');
			$content = $imprint_template;
			$content = str_replace('[dsgvoustid]', get_option("dsdvo_legalform_ustid", ""), $content);
			$content = str_replace('[dsgvowid]', get_option("dsdvo_legalform_wid", ""), $content);
			$content = str_replace('[dsgvosupervisoryauthority]', get_option("dsdvo_legalform_supervisoryauthority", ""), $content);
			$content = str_replace('[dsgvocity]', get_option("dsdvo_legalform_city", ""), $content);
			$content = str_replace('[dsgvoregisternr]', get_option("dsdvo_legalform_registernumber", ""), $content);
			$content = str_replace('[dsgvochamber]', get_option("dsdvo_legalform_chamber", ""), $content);
			$content = str_replace('[dsgvophone]', get_option("dsgvoaiophone", ""), $content);
			$content = str_replace('[dsgvofax]', get_option("dsgvoaiofax", ""), $content);
			
			$mail = get_option('dsgvoaiomail');
			$mailparts = explode('@', $mail);
			if (isset($mailparts[0])) { $mailpart1 = $mailparts[0];} else { $mailpart1 = ""; }
			if (isset($mailparts[1])) { $mailpart2 = $mailparts[1]; } else { $mailpart2 = ""; }

			$content = str_replace('[dsgvoemail]', '<script>var emailAddress = (\''.$mailpart1.'@\' + \''.$mailpart2.'\');document.write(\'<a href=\"mailto:\' + emailAddress + \'\">\' + emailAddress + \'</a>\');</script>', $content);
			$content = str_replace('[dsgvocompany]', get_option("dsgvoaiocompanyname", ""), $content);
			$content = str_replace('[dsgvoperson]', get_option("dsgvoaioperson", ""), $content);
			$content = str_replace('[dsgvostreet]', get_option("dsgvoaiostreet", ""), $content);
			$content = str_replace('[dsgvozip]', get_option("dsgvoaiozip", ""), $content);
			$content = str_replace('[dsgvocityowner]', get_option("dsgvoaiocity", ""), $content);
			
			$content = str_replace('[dsgvoperson_journalist]', get_option("dsdvo_legalform_personname_jornalist", ""), $content);
			$content = str_replace('[dsgvostreet_journalist]', get_option("dsdvo_legalform_adress_jornalist", ""), $content);
			$content = str_replace('[dsgvozip_journalist]', get_option("dsdvo_legalform_zip_jornalist", ""), $content);
			$content = str_replace('[dsgvocity_journalist]', get_option("dsdvo_legalform_city_jornalist", ""), $content);			
			$content = str_replace('[dsgvocountry_journalist]', get_option("dsdvo_legalform_country_jornalist", ""), $content);
			
			$content = str_replace('[dsgvocountryowner]', get_option("dsgvoaiocountry", ""), $content);
			$inforule_val = get_option("dsdvo_legalform_inforule", "")["option_id"];
			if ($inforule_val == "2") {
				$inforule = __("Arzt", "dsgvo-all-in-one-for-wp-pro");
			} else if ($inforule_val == "3") {
				$inforule = __("Zahnarzt", "dsgvo-all-in-one-for-wp-pro");
			} else if ($inforule_val == "4") {
				$inforule = __("Architekt", "dsgvo-all-in-one-for-wp-pro");
			} else if ($inforule_val == "5") {
				$inforule = __("Steuerberater", "dsgvo-all-in-one-for-wp-pro");
			} else if ($inforule_val == "6") {
				$inforule = __("Rechtsanwalt", "dsgvo-all-in-one-for-wp-pro");
			} else if ($inforule_val == "7") {
				$inforule = __("Notar", "dsgvo-all-in-one-for-wp-pro");
			} else if ($inforule_val == "8") {
				$inforule = __("Wirtschaftsprüfer", "dsgvo-all-in-one-for-wp-pro");
			}							
			$content = str_replace('[dsgvoinforule]', $inforule, $content);
			$state_val = get_option("dsdvo_legalform_state", "")["option_id"];
			if ($state_val == "1") {
				$state = __("Deutschland", "dsgvo-all-in-one-for-wp-pro");
			} else if ($state_val == "2") {
				$state = __("Österreich", "dsgvo-all-in-one-for-wp-pro");
			} else if ($state_val == "3") {
				$state = __("Schweiz", "dsgvo-all-in-one-for-wp-pro");
			}
			$content = str_replace('[dsgvocountry]', $state, $content);
			return $content;
		}


		//shortcode dsgvo policy

		public static function dsgvo_show_policy( $atts, $content = "" ) {
			
						

			if (!isset($language)) $language = wf_get_language();

			

			if ($language == "de") {

				$policy_text_1 = wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_policy_text_1")), ENT_COMPAT, get_option('blog_charset')));

			}

			

			if ($language == "en") {

				$policy_text_1 = wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_policy_text_en")), ENT_COMPAT, get_option('blog_charset')));

			}

									

			$now = new DateTime();

			$update_date = $now->format('d.m.Y');

			$content = "";

			if ($policy_text_1) {

				$content = str_replace("[dsgvo_save_date]", $update_date,$policy_text_1);

				$content = "<div class='dsgvoaio_policy_shortcode'>".$content;

				
				/***WP and Plugins Policy**/

				include( plugin_dir_path(__FILE__ )."/core/inc/texts.php");
				
				$plugins_policy = "";

				if ($language == "de") {

					$policytext = wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_wordpress_policy")), ENT_COMPAT, get_option('blog_charset')));

					if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($woocommerce_policy_text), ENT_COMPAT, get_option('blog_charset')));

					}	

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($polylang_policy_text), ENT_COMPAT, get_option('blog_charset')));

					}	

					if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($wpml_policy_text), ENT_COMPAT, get_option('blog_charset')));

					}

					$plugins_policy .= wpautop(html_entity_decode(stripslashes($dsgvoaio_policy), ENT_COMPAT, get_option('blog_charset')));

				} else {

					$policytext = wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_wordpress_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($woocommerce_policy_text_en), ENT_COMPAT, get_option('blog_charset')));

					}			

					if ( is_plugin_active( 'polylang/polylang.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($polylang_policy_text_en), ENT_COMPAT, get_option('blog_charset')));

					}

					if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) or is_plugin_active( 'sitepress-multilingual-cms-develop/sitepress.php' ) ) {

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($wpml_policy_text_en), ENT_COMPAT, get_option('blog_charset')));

					}	

						$plugins_policy .= wpautop(html_entity_decode(stripslashes($dsgvoaio_policy_en), ENT_COMPAT, get_option('blog_charset')));

				}				
				
				if (isset($policytext) && !empty($policytext)) {
					$policytext = str_replace('[dsgvoaio_plugins]', $plugins_policy, $policytext);
					$content .= $policytext;
				}
				
				/**Services Policy***/
				

				if (get_option('dsdvo_use_fbpixel') == "on" && !empty(get_option("dsdvo_fbpixel_policy")) or get_option('dsdvo_use_fbpixel') == "on" && !empty(get_option("dsdvo_fbpixel_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_fbpixel_policy")), ENT_COMPAT, get_option('blog_charset')));



					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_fbpixel_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					} 					

				}

				

				if (get_option('dsdvo_use_facebooklike') == "on" && !empty(get_option("dsdvo_facebook_policy")) or get_option('dsdvo_use_facebookcomments') == "on" && !empty(get_option("dsdvo_facebook_policy")) or get_option('dsdvo_use_facebooklike') == "on" && !empty(get_option("dsdvo_facebook_policy_en")) or get_option('dsdvo_use_facebookcomments') == "on" && !empty(get_option("dsdvo_facebook_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy")), ENT_COMPAT, get_option('blog_charset')));



					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_facebook_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					} 					

				}				

				if (get_option('dsdvo_use_twitter') == "on" && !empty(get_option("dsdvo_twitter_policy")) or get_option('dsdvo_use_twitter') == "on" && !empty(get_option("dsdvo_twitter_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_twitter_policy")), ENT_COMPAT, get_option('blog_charset')));



					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_twitter_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					} 					

				}				

				if (get_option('dsdvo_use_ga') == "on" && !empty(get_option("dsdvo_ga_policy")) or get_option('dsdvo_use_ga') == "on" && !empty(get_option("dsdvo_ga_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_ga_policy")), ENT_COMPAT, get_option('blog_charset')));

					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_ga_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					}				

				}

				if (get_option('dsdvo_use_gtagmanager') == "on" && !empty(get_option("dsdvo_gtagmanager_policy")) or get_option('dsdvo_use_gtagmanager') == "on" && !empty(get_option("dsdvo_gtagmanager_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_gtagmanager_policy")), ENT_COMPAT, get_option('blog_charset')));

					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_gtagmanager_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					}				

				}	

				

				if (get_option('dsdvo_use_piwik') == "on" && !empty(get_option("dsdvo_piwik_policy")) or get_option('dsdvo_use_piwik') == "on" && !empty(get_option("dsdvo_piwik_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_piwik_policy")), ENT_COMPAT, get_option('blog_charset')));

					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_piwik_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					}				

				}				

				

				if (get_option('dsdvo_use_linkedin') == "on" && !empty(get_option("dsdvo_linkedin_policy")) or get_option('dsdvo_use_linkedin') == "on" && !empty(get_option("dsdvo_linkedin_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_linkedin_policy")), ENT_COMPAT, get_option('blog_charset')));

					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_linkedin_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					}				

				}				

				if (get_option('dsdvo_use_vgwort') == "on" && !empty(get_option("dsdvo_vgwort_policy")) or get_option('dsdvo_use_vgwort') == "on" && !empty(get_option("dsdvo_vgwort_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_vgwort_policy")), ENT_COMPAT, get_option('blog_charset')));



					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_vgwort_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					} 					

				}

				if (get_option('dsdvo_use_shareaholic') == "on" && !empty(get_option("dsdvo_shareaholic_policy")) or get_option('dsdvo_use_shareaholic') == "on" && !empty(get_option("dsdvo_shareaholic_policy_en"))) { 

					$content .= "<p></p>";

					if ($language == "de") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_shareaholic_policy")), ENT_COMPAT, get_option('blog_charset')));

					} 

					if ($language == "en") {

					$content .= wpautop(html_entity_decode(stripcslashes(get_option("dsdvo_shareaholic_policy_en")), ENT_COMPAT, get_option('blog_charset')));

					}				

				}				



				if (get_option('dsgvoaiocompanyname')) {

					$content = str_replace('[company]',html_entity_decode(get_option('dsgvoaiocompanyname'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[company]','',$content);

				}		



				if (get_option('dsgvoaioperson')) {

					$content = str_replace('[owner]',html_entity_decode(get_option('dsgvoaioperson'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[owner]','',$content);

				}



				if (get_option('dsgvoaiostreet')) {

					$content = str_replace('[adress]',html_entity_decode(get_option('dsgvoaiostreet'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[adress]','',$content);

				}



				if (get_option('dsgvoaiozip')) {

					$content = str_replace('[zip]',html_entity_decode(get_option('dsgvoaiozip'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[zip]','',$content);

				}



				if (get_option('dsgvoaiocity')) {

					$content = str_replace('[city]',html_entity_decode(get_option('dsgvoaiocity'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[city]','',$content);

				}



				if (get_option('dsgvoaiocountry')) {

					$content = str_replace('[country]',html_entity_decode(get_option('dsgvoaiocountry'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[country]','',$content);

				}



				if (get_option('dsgvoaiophone')) {

					$content = str_replace('[phone]',html_entity_decode(get_option('dsgvoaiophone'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[phone]','',$content);

				}


				if (get_option('dsgvoaiomail')) {
			
					$mail = html_entity_decode(get_option('dsgvoaiomail'));
					$mailparts = explode('@', $mail);
					if (isset($mailparts[0])) { $mailpart1 = $mailparts[0];} else { $mailpart1 = ""; }
					if (isset($mailparts[1])) { $mailpart2 = $mailparts[1]; } else { $mailpart2 = ""; }
					
					$content = str_replace('[mail]', '<script>var emailAddress = (\''.$mailpart1.'@\' + \''.$mailpart2.'\');document.write(\'<a href=\"mailto:\' + emailAddress + \'\">\' + emailAddress + \'</a>\');</script>', $content);

				} else {

					$content = str_replace('[mail]','',$content);

				}			



				if (get_option('dsgvoaiousdid')) {

					$content = str_replace('[ust]',html_entity_decode(get_option('dsgvoaiousdid'), ENT_COMPAT, get_option('blog_charset')),$content);

				} else {

					$content = str_replace('[ust]','',$content);

				}	



				$content .= "</div>";

				

				

			} else {

				$content = "<b>INFO:</b> Bitte speichern Sie die Einstellungen im Backend unter \"DSGVO AIO\" um den Text der Datenschutzbedingungen hier auszugeben.";

			}

			return $content;    

		}

		

		public static function dsgvo_get_user_datas($atts, $out = "") {

			

			$users = get_users( array( 'fields' => array( 'ID' ) ) );

			$out = "";

			if ( is_user_logged_in() ) {

			$out .= "<div class='dsgvoaio_notice_info'><span class='dashicons dashicons-info'></span>".__("Hier sind alle Daten aufgelistet die in unserem System über Sie gespeichert sind.", "dsgvo-all-in-one-for-wp")."</div>"; 

			$out .= "<table>";

			foreach($users as $user_id){

		

				if ($user_id->ID == get_current_user_id()) {

					$out .= "<tr>";

					$out .= "<td>".__("Benutzername", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta ( $user_id->ID)['nickname'][0]."</td>";

					$out .= "</tr>";

					

					

					if (get_user_meta ( $user_id->ID)['first_name'][0]) {

					$out .= "<tr>";

					$out .= "<td>".__("Vorname", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta ( $user_id->ID)['first_name'][0]."</td>";

					$out .= "</tr>";

					}

					

					

					if (get_user_meta ( $user_id->ID)['last_name'][0]) {

					$out .= "<tr>";

					$out .= "<td>".__("Nachname", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta ( $user_id->ID)['last_name'][0]."</td>";

					$out .= "</tr>";

					}

					

					$user_id = get_current_user_id(); 

					$user_info = get_userdata($user_id);

					$mailadresje = $user_info->user_email;		

					

					if ($mailadresje) {

					$out .= "<tr>";

					$out .= "<td>".__("Email Adresse", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".$mailadresje."</td>";

					$out .= "</tr>";

					}

					

	

					if (get_user_meta( $user_info->ID, 'billing_address_1', true )) {

					$out .= "<tr>";

					$out .= "<td colspan='2'><b>".__("Rechnungsadresse", "dsgvo-all-in-one-for-wp")."</b></td>";

					$out .= "</tr>";

					}

					

					if ($user_info->first_name) {

					$out .= "<tr>";

					$out .= "<td>".__("Vorname", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".$user_info->first_name."</td>";

					$out .= "</tr>";

					}

					

					if ($user_info->last_name) {

					$out .= "<tr>";

					$out .= "<td>".__("Nachname", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".$user_info->last_name."</td>";

					$out .= "</tr>";

					}

					

					if (get_user_meta( $user_info->ID, 'billing_address_1', true )) {

					$out .= "<tr>";

					$out .= "<td>".__("Adresse", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta( $user_info->ID, 'billing_address_1', true )."</td>";

					$out .= "</tr>";

					}

					

					if (get_user_meta( $user_info->ID, 'billing_city', true )) {

					$out .= "<tr>";

					$out .= "<td>".__("Ort", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta( $user_info->ID, 'billing_city', true )."</td>";

					$out .= "</tr>";

					}

					

					

					if (get_user_meta( $user_info->ID, 'billing_postcode', true )) {

					$out .= "<tr>";

					$out .= "<td>".__("PLZ", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta( $user_info->ID, 'billing_postcode', true )."</td>";

					$out .= "</tr>";

					}



					

					

					if (get_user_meta( $user_info->ID, 'billing_country', true )) {

					$out .= "<tr>";

					$out .= "<td>".__("Land", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta( $user_info->ID, 'billing_country', true )."</td>";

					$out .= "</tr>";

					}

					

					

					if (get_user_meta( $user_info->ID, 'billing_email', true )) {

					$out .= "<tr>";

					$out .= "<td>".__("Email Adresse", "dsgvo-all-in-one-for-wp").":</td>";

					$out .= "<td>".get_user_meta( $user_info->ID, 'billing_email', true )."</td>";

					$out .= "</tr>";

					}					

										

					

					

					$user_meta = get_user_meta ( $user_id);

					

					if (isset($user_meta['community-events-location'])) {



					$useripdata = explode(":", $user_meta['community-events-location'][0]);



					$userip = str_replace('"',"", $useripdata);



					$userip = str_replace(';}',"", $userip);					



					



					if (isset($userip[6])) {

						

					$userip = preg_replace('/([0-9]+\\.[0-9]+\\.[0-9]+)\\.[0-9]+/', '\\1.xxx', $userip[6]);

	

					$out .= "<tr>";



					$out .= "<td><b>".__("IP Adresse", "dsgvo-all-in-one-for-wp")."</b></td>";



					$out .= "</tr>";



					$out .= "<tr>";



					$out .= "<td>".__("Gespeicherte IP Adresse", "dsgvo-all-in-one-for-wp").":</td>";



					$out .= "<td>".$userip."</td>";



					$out .= "</tr>";



					}

					

					}

					

					

				}

			}	

			$out .= "</table>";

			$out .= "<div>";
			$nonce = wp_create_nonce( 'dsgvoaiofree_download_userdata_nonce' );
			$out .= "<form method='post' action='".esc_url( admin_url('admin-post.php') )."' enctype='multipart/form-data' class='dsgvoaio_download_userdata'>";
			$out .= "<input type='hidden' name='dsgvoaiofree_action' value='download_userdatas' />";
			$out .= "<input type='hidden' id='dsgvoaiofree_download_userdata_nonce' name='dsgvoaiofree_download_userdata_nonce' value='".$nonce."'>";
			$out .= "<button type='submit' name='submit' id='submit' class='button dsgvobtn' data-class='dsgvoaio_export_settings_btn'><span class='dashicons dashicons-media-text'></span>".__("Als PDF herunterladen", "dsgvo-all-in-one-for-wp")."</button>";
			

			$out .= "&nbsp;&nbsp;&nbsp;&nbsp;";
			
			$out .= "<a href='".esc_url( get_permalink(get_option("dsdvo_delete_account_page")))."'><button type='button' class='button submit btn-primary dsgvobtn'><span class='dashicons dashicons-trash'></span>".__("Benutzerkonto sowie Daten löschen", "dsgvo-all-in-one-for-wp")."</button></a>";
			$out .= "</form>";
			$out .= "</div>";


			} else {

				if (!isset($language)) $language = wf_get_language();

				

				if ($language == "de") {

					$notlogged = get_option("dsgvo_notloggedintext");

				}

				if ($language == "en") {

					$notlogged = get_option("dsgvo_notloggedintext_en");

				}				

				if ($notlogged) {

					$out .= "<div class='dsgvoaio_notice_info'><span class='dashicons dashicons-info'></span>".html_entity_decode($notlogged)."</div>";

				} else {

					$out .= "<div class='dsgvoaio_notice_info'><span class='dashicons dashicons-info'></span><b>".__("Fehler", "dsgvo-all-in-one-for-wp").":</b>".__("Sie m&uuml;ssen sich einloggen um diese Aktion durchzuf&uuml;hren", "dsgvo-all-in-one-for-wp").".</div>";	

				}

			}

		return $out;

		}

}



dsdvo_wp_frontend::init();







