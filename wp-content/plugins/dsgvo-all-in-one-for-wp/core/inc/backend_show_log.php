<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class='wrap'>
        <h2><?php echo __("Opt-in / Opt-out Logbuch", "dsgvo-all-in-one-for-wp"); ?></h2>
		<p><?php echo __("Nachfolgend finden Sie eine Übersicht die auch als Beleg genutzt werden kann über die Zustimmungen bzw. Ablehnungen der Dienste.", "dsgvo-all-in-one-for-wp"); ?></p>
		
<?php
	$log_datas = get_option('dsgvoaio_log');
	if (isset($log_datas) && $log_datas != "") {
	?>
	<table id="dsgvoaio_log_table">
		<thead>
            <tr>
                <th><?php echo __("ID", "dsgvo-all-in-one-for-wp"); ?></th>
                <th><?php echo __("UID", "dsgvo-all-in-one-for-wp"); ?><span  class="dsgvoaio_tooltip tooltip" title="<?php echo __("Eindeutige ID um den Nutzer zu identifizieren.", "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span></th>
                <th><?php echo __("Dienst / Bezeichnung", "dsgvo-all-in-one-for-wp"); ?></th>
				<th><?php echo __("Status", "dsgvo-all-in-one-for-wp"); ?><span  class="dsgvoaio_tooltip tooltip" title="<?php echo __("Status ob der jeweilige Dienst zugelassen oder abgelehnt wurde (Opt-in / Opt-out).", "dsgvo-all-in-one-for-wp"); ?>" ><span class="dashicons dashicons-editor-help"></span></span></th>
                <th><?php echo __("IP Adresse", "dsgvo-all-in-one-for-wp"); ?></th>
                <th><?php echo __("Zeitpunkt", "dsgvo-all-in-one-for-wp"); ?></th>
            </tr>
        </thead>
        <tbody>	
	<?php
		
		foreach ($log_datas as $log_entry_key => $log_entry_value) {
			if ($log_entry_value['state'] == "true") {
				$stateval = __("Zugelassen", "dsgvo-all-in-one-for-wp");
			} else {
				$stateval = __("Abgelehnt", "dsgvo-all-in-one-for-wp");
			}
		?>
				<tr>
					<td><?php echo $log_entry_key; ?></td>
					<td><?php echo $log_entry_value['id']; ?></td>
					<?php if (isset($log_entry_value['allvalue']) && $log_entry_value['allvalue'] != "") {
					$allvalue = $log_entry_value['allvalue'];
					$allvalue = implode(',', $allvalue);					
					?>
					<td><?php echo $allvalue; ?></td>
					<td><?php echo $stateval; ?></td>					
					<?php } else { ?>
					<td><?php echo $log_entry_value['name']; ?></td>
					<td><?php echo $stateval; ?></td>
					<?php } ?>
					<td><?php echo $log_entry_value['ip']; ?></td>
					<td><?php echo $log_entry_value['timestep']; ?></td>
				</tr>
		<?php
		}
	?>
	</tbody>
	</table>	
	
	<div class="dsgvoaio_export_log_output" style="display: none;"></div>
	
	<div class="dsgvoaio_delete_log_form" style="display: none;">
	<form action="#">
	<a href="#" class="button button-primary dsgvoaio_delete_full_log"><?php echo __("Kompletten Log löschen", "dsgvo-all-in-one-for-wp"); ?></a>
	</form>
	<button type="button" class="notice-dismiss dsgvoaio_dismissdeleteform"><span class="screen-reader-text">Dismiss this notice.</span> </button>
	</div>	
	
	<div class="dsgvoaio_export_log_uid_form" style="display: none;">
	<form action="#">
	<input type="text" name="dsgvoaio_export_log_uid_val" class="dsgvoaio_export_log_uid_val" placeholder="UID eingeben..."/>
	<a href="#" class="button button-primary dsgvoaio_export_log_uid"><?php echo __("Log exportieren", "dsgvo-all-in-one-for-wp"); ?></a>
	<span class="button button-primary dsgvoaio_export_log_uid_loader" style="display: none;"><?php echo __("Wird generiert... Bitte warten...", "dsgvo-all-in-one-for-wp"); ?></span>
	
	</form>
	<button type="button" class="notice-dismiss dsgvoaio_dismissloguid"><span class="screen-reader-text">Dismiss this notice.</span> </button>
	</div>
	
	<a href="#" class="button button-primary dsgvoaio_export_log"><?php echo __("Logbuch als PDF Datei exportieren", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-media-default"></span></a>
	<span class="button button-primary dsgvoaio_export_log_loader" style="display: none;"><?php echo __("Wird generiert... Bitte warten...", "dsgvo-all-in-one-for-wp"); ?></span>
	
	<a href="#" class="button button-primary dsgvoaio_export_log_uid_show_form"><?php echo __("Log anhand einer UID exportieren", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-media-default"></span></a>
	
	<a href="#" class="button button-primary dsgvoaio_delete_log_show_form"><?php echo __("Log leeren/löschen", "dsgvo-all-in-one-for-wp"); ?><span class="dashicons dashicons-dismiss"></span></a>		
	<?php } else { ?>
	<p><b>Info:</b>&nbsp;<?php echo __("Es sind noch keine Einträge vorhanden...", "dsgvo-all-in-one-for-wp"); ?></p>
	<?php } ?>


<script>
jQuery(document).ready(function() {
	jQuery('#dsgvoaio_log_table').DataTable( {
		"responsive": true,
        "language": {
            "url": " <?php echo plugins_url('../../assets/js/German.json',__FILE__ ); ?>"
        }
    } );

	jQuery(".dsgvoaio_delete_log_show_form").click(function(event) {
		jQuery('.dsgvoaio_delete_log_form').show();
		event.preventDefault();
	});	

	jQuery(".dsgvoaio_export_log_uid_show_form").click(function(event) {
		jQuery('.dsgvoaio_export_log_uid_form').show();
		event.preventDefault();
	});
	
	jQuery(".dsgvoaio_delete_full_log").click(function(event) {
		if (confirm('<?php echo __("Sollen wirklich ALLE Einträge im Logbuch unwiderruflich gelöscht werden?", "dsgvo-all-in-one-for-wp"); ?>')) {
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					'nonce': '<?php echo wp_create_nonce( 'dsgvoaio-delete-log-full-nonce' )?>',
					'action': 'dsgvoaiofree_delete_log_full'
					}, success: function (result) {
						alert('<?php  echo __("Alle Einträge wurden erfolgreich gelöscht!", "dsgvo-all-in-one-for-wp"); ?>');
						location.reload();
					},
					error: function () {
						alert("<?php  echo __("Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support.", "dsgvo-all-in-one-for-wp"); ?>");
					}
			});
		}
		event.preventDefault();
	});	
	
	jQuery(".dsgvoaio_export_log_uid").click(function(event) {
		var uid = jQuery('.dsgvoaio_export_log_uid_val').val();
		
		if (uid) {
			jQuery('.dsgvoaio_export_log_uid_loader').show();
			jQuery('.dsgvoaio_export_log_uid').hide();
			jQuery('.dsgvoaio_log_notice').hide();
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					'nonce': '<?php echo wp_create_nonce( 'dsgvoaio-export-log-nonce' )?>',
					'uid': uid,
					'action': 'dsgvoaio_export_log'
					}, success: function (result) {
						jQuery('.dsgvoaio_export_log_output').html('<div class="updated notice is-dismissible dsgvoaio_log_notice">'+result+'<button type="button" class="notice-dismiss dsgvoaio_dismisslog"> <span class="screen-reader-text">Dismiss this notice.</span> </button></div>');
						jQuery('.dsgvoaio_export_log_output').show();
						jQuery('.dsgvoaio_export_log_uid_loader').hide();
						jQuery('.dsgvoaio_export_log_uid').show();
					},
					error: function () {
						alert("<?php  echo __("Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support.", "dsgvo-all-in-one-for-wp"); ?>");
						jQuery('.dsgvoaio_export_log').show();
						jQuery('.dsgvoaio_export_log_uid_loader').hide();
						jQuery('.dsgvoaio_export_log_uid').show();
					}
			});	
		
		} else {
			alert("<?php  echo __("Es ist ein Fehler aufgetreten. Bitte geben Sie eine UID ein.", "dsgvo-all-in-one-for-wp"); ?>");			
		}
		event.preventDefault();
	});	


	jQuery(".dsgvoaio_export_log").click(function(event) {
		if (confirm('<?php  echo __("Wollen Sie das Logbuch als PDF Datei exportieren?", "dsgvo-all-in-one-for-wp"); ?>')) {
			jQuery('.dsgvoaio_export_log_output').hide();
			jQuery('.dsgvoaio_export_log').hide();
			jQuery('.dsgvoaio_export_log_loader').show();
			jQuery.ajax({
				type: 'POST',
				url: '<?php echo admin_url('admin-ajax.php'); ?>',
				data: {
					'nonce': '<?php echo wp_create_nonce( 'dsgvoaio-export-log-nonce' )?>',
					'action': 'dsgvoaio_export_log'
					}, success: function (result) {
						jQuery('.dsgvoaio_export_log_output').html('<div class="updated notice is-dismissible dsgvoaio_log_notice">'+result+'<button type="button" class="notice-dismiss dsgvoaio_dismisslog"><span class="screen-reader-text">Dismiss this notice.</span> </button></div>');
						jQuery('.dsgvoaio_export_log_output').show();
						//alert(result);	
						jQuery('.dsgvoaio_export_log').show();
						jQuery('.dsgvoaio_export_log_loader').hide();
					},
					error: function () {
						//jQuery('.iframeitm'+id).show();
						alert("<?php  echo __("Es ist ein Fehler aufgetreten. Bitte wenden Sie sich an den Support.", "dsgvo-all-in-one-for-wp"); ?>");
						jQuery('.dsgvoaio_export_log').show();
						jQuery('.dsgvoaio_export_log_loader').hide();
					}
		});				
		}
		event.preventDefault();
	});	
	jQuery('.dsgvoaio_export_log_uid_form').on('click', '.dsgvoaio_dismissloguid', function() {
		jQuery('.dsgvoaio_export_log_uid_form').hide();
		event.preventDefault();
	});	
	jQuery('.dsgvoaio_delete_log_form').on('click', '.dsgvoaio_dismissdeleteform', function() {
		jQuery('.dsgvoaio_delete_log_form').hide();
		event.preventDefault();
	});		
	jQuery('.dsgvoaio_export_log_output').on('click', '.dsgvoaio_dismisslog', function() {
		jQuery('.dsgvoaio_export_log_output').hide();
		event.preventDefault();
	});
	
} );

</script>
</div>