<?php

/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Akina
 */

$mashiro_logo = iro_opt('mashiro_logo');
$vision_resource_basepath = iro_opt('vision_resource_basepath');
?>
<?php header('X-Frame-Options: SAMEORIGIN'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta name="theme-color">
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
	<?php
	$keywords = iro_opt('iro_meta_keywords');
	$description = iro_opt('iro_meta_description');?>
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<link rel="shortcut icon" href="<?php echo iro_opt('favicon_link', ''); ?>" />
	<meta http-equiv="x-dns-prefetch-control" content="on">
	<?php if (is_home()) {
		//预载资源
		//id 一致，pjax 自动替换
		global $core_lib_basepath; ?>
		<link id="entry-content-css" rel="prefetch" as="style"
			href="<?= $core_lib_basepath . '/css/theme/' . (iro_opt('entry_content_style') == 'sakurairo' ? 'sakura' : 'github') . '.css?ver=' . IRO_VERSION ?>" />
		<link rel="prefetch" as="script" href="<?= $core_lib_basepath . '/js/page.js?ver=' . IRO_VERSION ?>" />
		<?php } ?>
		<link rel="preload" href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.4.2/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<?php wp_head(); ?>
	<script type="text/javascript">if (!!window.ActiveXObject || "ActiveXObject" in window) {alert('本站不支持 IE 浏览器');}</script>
	<?php if (iro_opt('google_analytics_id', '')): ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo iro_opt('google_analytics_id', ''); ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments) }
		gtag('js', new Date());
		gtag('config', '<?php echo iro_opt('google_analytics_id', ''); ?>');
	</script>
	<?php endif; ?>
	<?php echo iro_opt("site_header_insert"); ?>
</head>
<body <?php body_class(); ?>>
	<?php if (iro_opt('preload_animation', 'true')): ?>
		<div id="preload">
			<li data-id="3" class="active">
				<div id="preloader_3"></div>
			</li>
		</div>
	<?php endif; ?>
	<div class="scrollbar" id="bar"></div>
	<header class="site-header no-select" role="banner">
		<div class="site-top">
			<div class="site-branding">
				<?php if (iro_opt('iro_logo') && !iro_opt('mashiro_logo_option', false)) { ?>
					<div class="site-title">
						<a href="<?php bloginfo('url'); ?>"><img src="<?php echo iro_opt('iro_logo'); ?>" alt="site-logo"></a>
					</div>
				<?php } else { ?>
					<span class="site-title">
						<span class="logolink moe-mashiro">
							<a href="<?php bloginfo('url'); ?>">
								<ruby>
									<span class="sakuraso">
										<?= $mashiro_logo['text_a'] ?? ""; ?>
									</span>
									<span class="no">
										<?= $mashiro_logo['text_b'] ?? ""; ?>
									</span>
									<span class="shironeko">
										<?= $mashiro_logo['text_c'] ?? ""; ?>
									</span>
									<rp></rp>
									<rt class="chinese-font">
										<?= $mashiro_logo['text_secondary'] ?? ""; ?>
									</rt>
									<rp></rp>
								</ruby>
							</a>
						</span>
					</span>
				<?php } ?>
				<!-- logo end -->
			</div><!-- .site-branding -->
			<?php if (iro_opt('nav_menu_search') == '1') { ?>
				<div class="searchbox js-toggle-search"><i class="fa-solid fa-magnifying-glass"></i></div>
			<?php } ?>
			<div class="lower">
				<?php if (iro_opt('nav_menu_display') == 'fold') { ?>
					<div id="show-nav" class="showNav">
						<div class="line line1"></div>
						<div class="line line2"></div>
						<div class="line line3"></div>
					</div>
				<?php } ?>
				<nav>
					<?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->
	<div class="openNav no-select">
		<div class="iconflat no-select" style="padding:35px;">
			<div class="icon"></div>
		</div>
	</div><!-- m-nav-bar -->
	<section id="main-container">
		<?php
		if (iro_opt('cover_switch')) {
			$filter = iro_opt('random_graphs_filter');
			?>
			<div class="headertop <?php echo $filter; ?>">
				<?php get_template_part('layouts/imgbox'); ?>
			</div>
		<?php } ?>
		<div id="page" class="site wrapper">
			<?php
			$use_as_thumb = get_post_meta(get_the_ID(), 'use_as_thumb', true); //'true','only',(default)
			if ($use_as_thumb != 'only') {
				$cover_type = get_post_meta(get_the_ID(), 'cover_type', true);
				if ($cover_type == 'hls') {
					the_video_headPattern(true);
				} elseif ($cover_type == 'normal') {
					the_video_headPattern(false);
				} else {
					the_headPattern();
				}
			} else {
				the_headPattern();
			} ?>
			<div id="content" class="site-content">