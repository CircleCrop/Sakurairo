<?php
$mashiro_logo = iro_opt( 'mashiro_logo' );
$vision_resource_basepath = iro_opt( 'vision_resource_basepath' );
?>
<?php header( 'X-Frame-Options: SAMEORIGIN' ); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta name="theme-color">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keywords; ?>" />
	<link rel="shortcut icon" href="<?php echo iro_opt( 'favicon_link', '' ); ?>" />
	<link rel="preload" href="/webstatic/fontawesome/css/all.min.css" as="style"
		onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preload" href="https://aiccrop.com/webstatic/self-hosted/optmize-fonts.css?ver=24.1.2" as="style"
		onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preload"
		href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans+SC:wght@100..900&display=swap"
		as="style" onload="this.onload=null;this.rel='stylesheet'">
	<link rel="preload" href="https://use.typekit.net/ytd1lqa.css" as="style"
		onload="this.onload=null;this.rel='stylesheet'">

	<meta http-equiv="x-dns-prefetch-control" content="on">

	<?php if ( is_home() ) {
		//预载资源
		//id 一致，pjax 自动替换
		global $core_lib_basepath; ?>
		<link id="entry-content-css" rel="prefetch" as="style"
			href="<?= $core_lib_basepath . '/css/theme/' . ( iro_opt( 'entry_content_style' ) == 'sakurairo' ? 'sakura' : 'github' ) . '.css?ver=' . IRO_VERSION ?>" />
		<link rel="prefetch" as="script" href="<?= $core_lib_basepath . '/js/page.js?ver=' . IRO_VERSION ?>" />
	<?php } ?>
	<?php wp_head(); ?>
	<script
		type="text/javascript">if (!!window.ActiveXObject || "ActiveXObject" in window) { alert('本站不支持 IE 浏览器'); }</script>
	<?php echo iro_opt( "site_header_insert" ); ?>
</head>

<body <?php body_class(); ?>>
	<?php if ( iro_opt( 'preload_animation', 'true' ) ) : ?>
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
				<?php if ( iro_opt( 'iro_logo' ) && ! iro_opt( 'mashiro_logo_option', false ) ) { ?>
					<div class="site-title">
						<a href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo iro_opt( 'iro_logo' ); ?>"
								alt="site-logo"></a>
					</div>
				<?php } else { ?>
					<span class="site-title">
						<span class="logolink moe-mashiro">
							<a href="<?php bloginfo( 'url' ); ?>">
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
			<?php if ( iro_opt( 'nav_menu_search' ) == '1' ) { ?>
				<div class="searchbox js-toggle-search"><i class="fa-solid fa-magnifying-glass"></i></div>
			<?php } ?>
			<div class="lower">
				<?php if ( iro_opt( 'nav_menu_display' ) == 'fold' ) { ?>
					<div id="show-nav" class="showNav">
						<div class="line line1"></div>
						<div class="line line2"></div>
						<div class="line line3"></div>
					</div>
				<?php } ?>
				<nav>
					<?php wp_nav_menu( array( 'depth' => 2, 'theme_location' => 'primary', 'container' => false ) ); ?>
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
		if ( iro_opt( 'cover_switch' ) ) {
			$filter = iro_opt( 'random_graphs_filter' );
			?>
			<div class="headertop <?php echo $filter; ?>">
				<?php get_template_part( 'layouts/imgbox' ); ?>
			</div>
		<?php } ?>
		<div id="page" class="site wrapper">
			<?php
			$use_as_thumb = get_post_meta( get_the_ID(), 'use_as_thumb', true ); //'true','only',(default)
			if ( $use_as_thumb != 'only' ) {
				$cover_type = get_post_meta( get_the_ID(), 'cover_type', true );
				if ( $cover_type == 'hls' ) {
					the_video_headPattern( true );
				} elseif ( $cover_type == 'normal' ) {
					the_video_headPattern( false );
				} else {
					the_headPattern();
				}
			} else {
				the_headPattern();
			} ?>
			<div id="content" class="site-content">