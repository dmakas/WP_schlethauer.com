<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts
 */
?>
<?php
/*
 * `.fw-iconbox` supports 3 styles:
 * `fw-iconbox-1`, `fw-iconbox-2` and `fw-iconbox-3`
 */
$bg_ib_image = 'background-image:url(' . $atts['background_image']['data']['icon'] . ');';
?>
<div style="<?php echo esc_attr($bg_ib_image); ?>" class="fw-iconbox clearfix <?php echo esc_attr($atts['style']); echo ' '; echo esc_attr($atts['icon_class']); ?>">
	<div class="fw-iconbox-image">
		<i class="<?php echo esc_attr($atts['icon']); ?>"></i>
	</div>
	<div class="fw-iconbox-aside">
		<div class="fw-iconbox-title">
			<h3><?php echo $atts['title']; ?></h3>
		</div>
		<div class="fw-iconbox-text">
			<p><?php echo $atts['content']; ?></p>
		</div>
	</div>
</div>
