<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
	<div class="wrap">
		<h2><?php screen_icon(); echo __('Einstellungen importieren/exportieren', 'dsgvo-all-in-one-for-wp'); ?></h2>

		<div class="metabox-holder">
			<div class="postbox">
				<h3><span><?php echo __( 'Einstellungen exportieren', 'dsgvo-all-in-one-for-wp' ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Hier können Sie die Einstellungen von DSGVO AIO exportieren. Dient zum einen als Backup und zum anderen falls Sie die selben Einstellungen auf einer anderen Installation nutzen möchten.', 'dsgvo-all-in-one-for-wp' ); ?></p>
					<form method="post">
						<p><input type="hidden" name="dsgvoaiofree_action" value="export_settings" /></p>
						<p>
							<?php wp_nonce_field( 'dsgvoaiofree_export_nonce', 'dsgvoaiofree_export_nonce' ); ?>
							<?php submit_button( __( 'Exportieren', 'dsgvo-all-in-one-for-wp' ), 'secondary', 'submit', false ); ?>
						</p>
					</form>
				</div>
			</div>

			<div class="postbox">
				<h3><span><?php echo __( 'Einstellungen importieren', 'dsgvo-all-in-one-for-wp' ); ?></span></h3>
				<div class="inside">
					<p><?php echo __( 'Importieren Sie die Plugin Einstellungen von einer .json Datei. Solch eine Datei können Sie via "Einstellungen exportieren" generieren.', 'dsgvo-all-in-one-for-wp' ); ?></p>
					<form method="post" enctype="multipart/form-data" class="dsgvoaio_settings_export_form">
						<p>
							<input type="file" name="import_file"/>
						</p>
						<p>
							<input type="hidden" name="dsgvoaiofree_action" value="import_settings" />
							<?php wp_nonce_field( 'dsgvoaiofree_import_nonce', 'dsgvoaiofree_import_nonce' ); ?>
							<?php submit_button( __( 'Importieren', 'dsgvo-all-in-one-for-wp' ), 'secondary', 'submit', false ,array( 'data-class' => 'dsgvoaio_export_settings_btn' )); ?>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery(document).on('submit','form.dsgvoaio_settings_export_form',function(){
			if (confirm('<?php echo __( 'Sind Sie sicher, dass Sie die Einstellungen importieren wollen? Dies hat zur Folge, dass alle bestehenden Einstellungen überschrieben werden!', 'dsgvo-all-in-one-for-wp' ); ?>')) {
				
			} else {
				event.preventDefault(); 
			}
		});
	});
	</script>