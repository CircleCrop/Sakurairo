<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Sakurairo
 */

add_action('wp_head', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('entry-content');
}, 5);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo esc_url(iro_opt('favicon_link', '')); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <section class="error-404 not-found">
        <div class="error-img" style="height: 60%;">
            <div class="anim-icon" id="404" style="height: 100%;"></div>
        </div>
        <div class="err-button back" style="font-family: 'Noto Sans SC', serif;">
            <a id="golast" href=javascript:history.go(-1);><?php _e('return to previous page', 'sakurairo');/*返回上一页*/ ?></a>
            <a id="gohome" href="<?php bloginfo('url'); ?>"><?php _e('return to home page', 'sakurairo');/*返回主页*/ ?></a>
        </div>
        <div style="display:block; width:284px;margin: auto;">
            <p
                style="margin-bottom: 1em;margin-top: 1.5em;text-align: center;font-size: 15px">
                <?php _e('Don\'t worry, search in site?', 'sakurairo');/*别急，试试站内搜索？*/ ?></p>
            <form class="s-search" method="get" action="/" role="search">
                <input class="text-input" style="padding: 8px 20px" type="search"
                    name="s" placeholder="<?php _e('Search...', 'sakurairo') ?>" required>
            </form>
        </div>
    </section>
    <script src="<?php echo $shared_lib_basepath . '/js/anf.js'; ?>" type="text/javascript"></script>
    <?php wp_footer(); ?>
</body>

</html>