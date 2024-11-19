<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sakurairo
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

$nav_text_logo = iro_opt('nav_text_logo');
$vision_resource_basepath = iro_opt('vision_resource_basepath');
header('X-Frame-Options: SAMEORIGIN');
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
		<?php
		// Logo Section - Only process if logo or text is configured
		if (iro_opt('iro_logo') || !empty($nav_text_logo['text'])): ?>
			<div class="site-branding">
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
		<?php endif;

		// Cache commonly used options
		$show_search = (bool)iro_opt('nav_menu_search');
		$show_user_avatar = (bool)iro_opt('nav_menu_user_avatar');
		$enable_random_graphs = (bool)iro_opt('cover_random_graphs_switch', 'true');
		?>

		<!-- Navigation and Search Section -->
		<div class="nav-search-wrapper">
			<nav>
				<?php
				/**
				 * Limit menu items based on total byte count
				 * @param array $items Menu items
				 * @param array $args Menu arguments
				 * @return array Filtered menu items
				 */
				function limit_menu_by_bytes($items, $args) {
					$byte_count = 0;
					$byte_limit = 70;
					
					foreach($items as $key => $item) {
						if($item->menu_item_parent != 0) continue;
						
						$title_bytes = strlen(strip_tags($item->title));
						if($byte_count + $title_bytes >= $byte_limit) {
							unset($items[$key]);
							if($byte_count + $title_bytes == $byte_limit) break;
						} else {
							$byte_count += $title_bytes;
						}
					}
					return $items;
				}
				
				add_filter('wp_nav_menu_objects', 'limit_menu_by_bytes', 10, 2);
				
				wp_nav_menu([
					'depth' => 2,
					'theme_location' => 'primary',
					'container' => false,
					'fallback_cb' => false
				]); ?>
			</nav>

			<?php if ($enable_random_graphs || $show_search): ?>
				<div class="nav-search-divider"></div>
			<?php endif; ?>

			<?php if ($show_search): ?>
				<div class="searchbox js-toggle-search">
					<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
					<span class="screen-reader-text"><?php esc_html_e('Search', 'sakurairo'); ?></span>
				</div>
			<?php endif; ?>

			<?php if ($enable_random_graphs): ?>
				<div class="bg-switch" id="bg-next" style="display:none">
					<i class="fa-solid fa-dice" aria-hidden="true"></i>
					<span class="screen-reader-text"><?php esc_html_e('Random Background', 'sakurairo'); ?></span>
				</div>
				<script>
					// 初始化状态存储
					if (!sessionStorage.getItem('bgNextState')) {
						sessionStorage.setItem('bgNextState', JSON.stringify({
							lastPageWasHome: window.location.pathname === '/' || 
										   window.location.pathname === '/index.php',
							isTransitioning: false
						}));
					}

					const showBgNext = () => {
						const bgNext = document.getElementById('bg-next');
						const navSearchWrapper = document.querySelector('.nav-search-wrapper');
						
						const isHomePage = window.location.pathname === '/' || 
										 window.location.pathname === '/index.php';
						const state = JSON.parse(sessionStorage.getItem('bgNextState'));

						if (state.isTransitioning) return;

						if (isHomePage) {
							if (!state.lastPageWasHome) {
								state.isTransitioning = true;
								sessionStorage.setItem('bgNextState', JSON.stringify(state));

								// 克隆节点来计算最终宽度
								const clone = bgNext.cloneNode(true);
								clone.style.cssText = 'display:block;opacity:0;position:fixed;pointer-events:none;';
								document.body.appendChild(clone);
								const bgNextWidth = clone.offsetWidth;
								document.body.removeChild(clone);

								// 重置过渡效果
								navSearchWrapper.style.transition = 'none';
								bgNext.style.transition = 'none';
								
								// 设置初始状态
								const initialWidth = navSearchWrapper.offsetWidth;
								navSearchWrapper.style.width = initialWidth + 'px';
								
								bgNext.style.display = 'block';
								bgNext.style.opacity = '0';
								bgNext.style.transform = 'translateX(-20px)';

								// 强制回流
								void navSearchWrapper.offsetWidth;
								void bgNext.offsetWidth;

								// 开始动画
								requestAnimationFrame(() => {
									bgNext.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
									navSearchWrapper.style.transition = 'all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
									
									bgNext.style.opacity = '1';
									bgNext.style.transform = 'translateX(0)';
									navSearchWrapper.style.width = (initialWidth + bgNextWidth) + 'px';

									setTimeout(() => {
										state.isTransitioning = false;
										sessionStorage.setItem('bgNextState', JSON.stringify(state));
									}, 600);
								});
							} else {
								bgNext.style.display = 'block';
								bgNext.style.opacity = '1';
								bgNext.style.transform = 'translateX(0)';
							}
						} else {
							if (state.lastPageWasHome) {
								state.isTransitioning = true;
								sessionStorage.setItem('bgNextState', JSON.stringify(state));

								// 重置过渡效果
								navSearchWrapper.style.transition = 'none';
								bgNext.style.transition = 'none';
								
								
								// ���取搜索框元素
								const searchbox = document.querySelector('.searchbox.js-toggle-search');
								if (searchbox) {
									searchbox.style.transition = 'none';
									searchbox.style.transform = 'translateX(0)';
								}
								
								// 设置初始状态
								bgNext.style.opacity = '1';
								bgNext.style.transform = 'translateX(0)';
								const initialWidth = navSearchWrapper.offsetWidth;
								
								// 强制回流
								void navSearchWrapper.offsetWidth;
								void bgNext.offsetWidth;
								if (searchbox) void searchbox.offsetWidth;
								
								// 开始动画
								requestAnimationFrame(() => {
									// 使用与进入动画相同的缓动函数
									const easing = 'cubic-bezier(0.34, 1.56, 0.64, 1)';
									bgNext.style.transition = 'all 0.6s ' + easing;
									navSearchWrapper.style.transition = 'all 0.6s ' + easing;
									
									const divider = document.querySelector('.nav-search-divider');
									
									if (searchbox) {
										searchbox.style.transition = 'transform 0.6s ' + easing;
										searchbox.style.transform = 'translateX(' + (bgNext.offsetWidth + 2) + 'px)';
									}
									if (divider) {
										divider.style.transition = 'transform 0.6s ' + easing;
										divider.style.transform = 'translateX(' + (bgNext.offsetWidth + 2) + 'px)';
									}
									
									bgNext.style.opacity = '0';
									bgNext.style.transform = 'translateX(20px)';
									navSearchWrapper.style.width = (initialWidth - bgNext.offsetWidth) + 'px';
									
									setTimeout(() => {
										bgNext.style.display = 'none';
										navSearchWrapper.style.width = 'auto';
										if (searchbox) {
											searchbox.style.transition = 'none';
											searchbox.style.transform = '';
										}
										if (divider) {
											divider.style.transition = 'none';
											divider.style.transform = '';
										}
										state.isTransitioning = false;
										sessionStorage.setItem('bgNextState', JSON.stringify(state));
									}, 600); // 调整为与动画时长相同的延迟
								});
							} else {
								bgNext.style.display = 'none';
								navSearchWrapper.style.width = 'auto';
							}
						}
						
						state.lastPageWasHome = isHomePage;
						sessionStorage.setItem('bgNextState', JSON.stringify(state));
					};

					// PJAX事件监听
					document.addEventListener('pjax:send', () => {
						const state = JSON.parse(sessionStorage.getItem('bgNextState'));
						state.lastPageWasHome = window.location.pathname === '/' || 
											 window.location.pathname === '/index.php';
						sessionStorage.setItem('bgNextState', JSON.stringify(state));
					}, false);

					document.addEventListener('pjax:complete', () => {
						setTimeout(showBgNext, 0);
					}, false);

					// 初始执行
					showBgNext();
				</script>
			<?php endif; ?>
		</div>

		<!-- User Menu Section -->
		<?php if ($show_user_avatar): ?>
			<div class="user-menu-wrapper">
				<?php header_user_menu(); ?>
			</div>
		<?php endif; ?>
	</header>
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