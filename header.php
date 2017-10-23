<html>
<head>
	<title>Custom Wordpress Site</title>
	<?php wp_head(); ?>
</head>
<?php 
	if( is_front_page() ){
		$bodyClass = array('my-body', 'front-page');
	} else {
		$bodyClass = array('my-body');
	}

 ?>
<body <?php body_class($bodyClass); ?>>
	<?php if(is_front_page()): ?>
		<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="100%">
	<?php endif; ?>
	<?php wp_nav_menu(array('theme_location'=>'primary')); ?>
	<div class="container">








		<?php if(display_header_text()==true): ?>
			<h1 style="color:#<?php header_textcolor(); ?>"><?php bloginfo('name'); ?></h1>
			<h3><?php bloginfo('description'); ?></h3>
		<?php endif; ?>










		<?php wp_nav_menu(array('theme_location'=>'programmes')); ?>
