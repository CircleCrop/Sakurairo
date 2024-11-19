<?php
function customizer_css() { ?>
<style>
<?php 
/**
 * theme-skin
 *  */ 
if (iro_opt('theme_skin')) { ?>
:root{
    --theme-skin: <?=iro_opt('theme_skin'); ?>;
    --theme-skin-matching:<?=iro_opt('theme_skin_matching'); ?>;
    --homepage_widget_transparency:<?=iro_opt('homepage_widget_transparency'); ?>;
    --style_menu_selection_radius:<?=iro_opt('style_menu_selection_radius', ''); ?>px;
    --load_nextpage_svg:url("<?=iro_opt('load_nextpage_svg'); ?>");
    --style_menu_radius:<?=iro_opt('style_menu_radius', ''); ?>px;
    --friend-link-shadow: <?=iro_opt('friend_link_shadow_color'); ?>;
    --friend-link-title: <?=iro_opt('friend_link_title_matching_color'); ?>;
    --inline_code_background_color:<?=iro_opt('inline_code_background_color');?>;
    <?php //深色模式主题色 ?>
    --theme-skin-dark:  <?=iro_opt('theme_skin_dark'); ?>;
    --global-font-weight:<?=iro_opt('global_font_weight');?>;
    --theme-dm-background_transparency:<?=iro_opt('theme_darkmode_background_transparency')?>;
    --exhibition_area_matching_color:<?=iro_opt('exhibition_area_matching_color');?>;
    --inline_code_background_color_in_dark_mode:<?=iro_opt('inline_code_background_color_in_dark_mode');?>;
}
<?php if (iro_opt('theme_commemorate_mode')) {?>
    html{
        filter: grayscale(100%) !important;
    }
<?php } ?>
.the-feature.from_left_and_right .info,.the-feature.from_left_and_right .info h3{background: <?=iro_opt('exhibition_background_color'); ?> ;}
/*白猫样式Logo*/
<?php if (iro_opt('mashiro_logo_option', 'true')) {
     $mashiro_logo = iro_opt('mashiro_logo');
    ?>
    .logolink{
        font-family: '<?= $mashiro_logo['font_name']; ?>','Noto Sans SC';
    }
.logolink .sakuraso {
    background-color: rgba(255, 255, 255, .5);
    border-radius: 5px;
    color: <?=iro_opt('theme_skin'); ?>;
    height: auto;
    line-height: 25px;
    margin-right: 0;
    padding-bottom: 0px;
    padding-top: 1px;
    text-size-adjust: 100%;
    width: auto
}
.logolink a:hover .sakuraso {
    background-color: <?=iro_opt('theme_skin_matching'); ?>;
    color: #fff;
}
.logolink a:hover .shironeko,
.logolink a:hover .no,
.logolink a:hover rt {
    color: <?=iro_opt('theme_skin_matching'); ?>;
}
.logolink.moe-mashiro a {
    color: <?=iro_opt('theme_skin'); ?>;
    float: left;
    font-size: 25px;
    font-weight: 800;
    height: 50px;
    line-height: 40px;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 8px;
    text-decoration-line: none;
}
@media (max-width:860px) {
.logolink.moe-mashiro a {
    color: <?=iro_opt('theme_skin'); ?>;
    float: left;
    font-size: 25px;
    font-weight: 800;
    height: 56px;
    line-height: 56px;
    padding-left: 6px;
    padding-right: 15px;
    padding-top: 11px;
}
}
.logolink.moe-mashiro .sakuraso {
    font-size: 25px;
    padding-bottom: 4px;
    padding-left: 4px;
    padding-right: 4px;
    padding-top: 2px;
}
.logolink.moe-mashiro .no {
    font-size: 25px;
    padding-bottom: 4px;
    padding-top: 2px;
}
.logolink.moe-mashiro .no {
    font-size: 20px;
    display: inline-block;
    margin-left: 5px;
}
.logolink a:hover .no {
    -webkit-animation: spin 1.5s linear infinite;
    animation: spin 1.5s linear infinite;
}
.logolink ruby {
    ruby-position: under;
    -webkit-ruby-position: after;
}
.logolink ruby rt {
    font-size: 10px;
    letter-spacing:2px;
    transform: translateY(-6px);
    opacity: 0;
    transiton-property: opacity;
    transition-duration: 0.5s, 0.5s;
}
.logolink a:hover ruby rt {
    opacity: 1
}
<?php } ?>
/*非全局色彩管理*/
.post-date {
  background-color: <?=iro_opt('post_list_matching_color'); ?>26;
}
<?php $text_logo = iro_opt('text_logo'); ?>
.center-text{color: <?=$text_logo['color']; ?>;font-size: <?=$text_logo['size']; ?>px;}
.Ubuntu-font,.center-text{font-family: <?=$text_logo['font']; ?> ;}
.notice i,.notice{color: <?=iro_opt('bulletin_text_color'); ?>;}
.notice{border: 1px solid <?=iro_opt('bulletin_board_border_color'); ?>;}
<?php if(iro_opt('entry_content_style') == "sakurairo"){ ?>
.entry-content th{background-color: <?=iro_opt('theme_skin'); ?>}
<?php } ?>
<?php if(iro_opt('live_search')){ ?>
.search-form--modal .search-form__inner {
  bottom: unset !important;
  top: 10% !important;
}

<?php } ?>
<?php } // theme-skin ?>
<?php // Custom style
if ( iro_opt('site_custom_style') ) {
    echo iro_opt('site_custom_style');
  } 
  // Custom style end ?>
  <?php // liststyle
  if ( iro_opt('post_list_akina_type') == 'square') { ?>
.feature img{ border-radius: 0px !important; }
.feature i { border-radius: 0px !important; }
<?php } // liststyle ?>
<?php 
//$image_api = 'background-image: url("'.rest_url('sakura/v1/image/cover').'");';
$bg_style = iro_opt('cover_full_screen') ?'': 'background-position: center center;background-attachment: inherit;';
?>
#centerbg{<?php echo $bg_style; echo iro_opt('site_bg_as_cover',false)? 'background:#0000;':''; ?>}
/*预加载部分*/

<?php if (iro_opt('preload_animation', 'true')): ?>
#preload {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #ffffff;
    z-index: 99999;
}

#preload li.active {
    position: absolute;
    top: 49%;
    left: 49%;
    list-style: none;
}

html {
    overflow-y: hidden;
}

#preloader_3 {
    position:relative;
}
#preloader_3:before {
    background:<?=iro_opt('preload_animation_color2'); ?>;
    -webkit-animation: preloader_3_before 1.5s infinite ease-in-out;
    -moz-animation: preloader_3_before 1.5s infinite ease-in-out;
    -ms-animation: preloader_3_before 1.5s infinite ease-in-out;
    animation: preloader_3_before 1.5s infinite ease-in-out;
}
#preloader_3:after {
    background:<?=iro_opt('preload_animation_color1'); ?>;
    left:22px;
    -webkit-animation: preloader_3_after 1.5s infinite ease-in-out;
    -moz-animation: preloader_3_after 1.5s infinite ease-in-out;
    -ms-animation: preloader_3_after 1.5s infinite ease-in-out;
    animation: preloader_3_after 1.5s infinite ease-in-out;
}
#preloader_3:before,#preloader_3:after {
    width:20px;
    height:20px;
    border-radius:20px;
    background:<?=iro_opt('preload_animation_color1'); ?>;
    position:absolute;
    content:'';
}
@-webkit-keyframes preloader_3_before {
    0% {
        -webkit-transform: translateX(0px) rotate(0deg)
    }
    50% {
        -webkit-transform: translateX(50px) scale(1.2) rotate(260deg);
        background:<?=iro_opt('preload_animation_color1'); ?>;
        border-radius:0px;
    }
    100% {
        -webkit-transform: translateX(0px) rotate(0deg)
    }
}
@-webkit-keyframes preloader_3_after {
    0% {
        -webkit-transform: translateX(0px)
    }
    50% {
        -webkit-transform: translateX(-50px) scale(1.2) rotate(-260deg);
        background:<?=iro_opt('preload_animation_color2'); ?>;
        border-radius:0px;
    }
    100% {
        -webkit-transform: translateX(0px)
    }
}
@-moz-keyframes preloader_3_before {
    0% {
        -moz-transform: translateX(0px) rotate(0deg)
    }
    50% {
        -moz-transform: translateX(50px) scale(1.2) rotate(260deg);
        background:<?=iro_opt('preload_animation_color1'); ?>;
        border-radius:0px;
    }
    100% {
        -moz-transform: translateX(0px) rotate(0deg)
    }
}
@-moz-keyframes preloader_3_after {
    0% {
        -moz-transform: translateX(0px)
    }
    50% {
        -moz-transform: translateX(-50px) scale(1.2) rotate(-260deg);
        background:<?=iro_opt('preload_animation_color2'); ?>;
        border-radius:0px;
    }
    100% {
        -moz-transform: translateX(0px)
    }
}
@-ms-keyframes preloader_3_before {
    0% {
        -ms-transform: translateX(0px) rotate(0deg)
    }
    50% {
        -ms-transform: translateX(50px) scale(1.2) rotate(260deg);
        background:<?=iro_opt('preload_animation_color1'); ?>;
        border-radius:0px;
    }
    100% {
        -ms-transform: translateX(0px) rotate(0deg)
    }
}
@-ms-keyframes preloader_3_after {
    0% {
        -ms-transform: translateX(0px)
    }
    50% {
        -ms-transform: translateX(-50px) scale(1.2) rotate(-260deg);
        background:<?=iro_opt('preload_animation_color2'); ?>;
        border-radius:0px;
    }
    100% {
        -ms-transform: translateX(0px)
    }
}
@keyframes preloader_3_before {
    0% {
        transform: translateX(0px) rotate(0deg)
    }
    50% {
        transform: translateX(50px) scale(1.2) rotate(260deg);
        background:<?=iro_opt('preload_animation_color1'); ?>;
        border-radius:0px;
    }
    100% {
        transform: translateX(0px) rotate(0deg)
    }
}
@keyframes preloader_3_after {
    0% {
        transform: translateX(0px)
    }
    50% {
        transform: translateX(-50px) scale(1.2) rotate(-260deg);
        background:<?=iro_opt('preload_animation_color2'); ?>;
        border-radius:0px;
    }
    100% {
        transform: translateX(0px)
    }
}
<?php endif; ?>
/*可变项目*/

/*字体*/
.serif{
font-family:<?= iro_opt('global_default_font'); ?> !important ;
font-size: <?= iro_opt('global_font_size'); ?>px;
}
body{
font-family:<?= iro_opt('global_font_2'); ?> !important;
font-size: <?= iro_opt('global_font_size'); ?>px;
}
.site-top ul li a,.header-user-name,.header-user-menu a {
font-family:<?= iro_opt('nav_menu_font'); ?> !important;
}
.site-info,.site-info a{
font-family:<?= iro_opt('footer_text_font'); ?> !important;
}
.skin-menu p{
font-family:<?= iro_opt('style_menu_font'); ?> !important;
}
h1.main-title,h1.fes-title{
font-family:<?= iro_opt('area_title_font'); ?>;
}
.header-info p, .header-shuo p{
font-family:<?= iro_opt('signature_font'); ?> !important;
font-size: <?= iro_opt('signature_font_size'); ?>px;
}
.cbp_tmtimeline > li .cbp_tmlabel {
font-family:<?= iro_opt('shuoshuo_font'); ?> !important;
}
.post-list-thumb .post-title h3{
font-size: <?= iro_opt('post_title_font_size'); ?>px !important;
}
.post-meta, .post-meta a{
font-size: <?= iro_opt('post_date_font_size'); ?>px !important;
}
.pattern-center h1.cat-title,.pattern-center h1.entry-title {
font-size: <?= iro_opt('page_temp_title_font_size'); ?>px ;
}
.pattern-center-sakura h1.cat-title,.pattern-center-sakura h1.entry-title {
font-size: <?= iro_opt('page_temp_title_font_size'); ?>px !important;
}
.single-center .single-header h1.entry-title {
font-size: <?= iro_opt('article_title_font_size'); ?>px ;
}
/*背景类*/
.comment-respond textarea {
background-image: url(<?=iro_opt('comment_area_image'); ?>); 
background-size: contain;
background-repeat: no-repeat;
background-position: right;
}
.search-form.is-visible{
background-image: url(<?=iro_opt('search_area_background'); ?>);
}
.site-footer {
background-color: rgba(255, 255, 255,<?=iro_opt('reception_background_transparency'); ?>);
<?php if (iro_opt('reception_background_blur', 'false')): ?> backdrop-filter: saturate(180%) blur(10px); <?php endif; ?>
<?php if (iro_opt('reception_background_blur', 'false')): ?> -webkit-backdrop-filter: saturate(180%) blur(10px); <?php endif; ?>
}
.wrapper {
background-color: rgba(255, 255, 255,<?=iro_opt('reception_background_transparency'); ?>);
<?php if (iro_opt('reception_background_blur', 'false')): ?> backdrop-filter: saturate(180%) blur(10px); <?php endif; ?>
<?php if (iro_opt('reception_background_blur', 'false')): ?> -webkit-backdrop-filter: saturate(180%) blur(10px); <?php endif; ?>
}
/*首页圆角设置*/
.header-info{
border-radius: <?=iro_opt('signature_radius'); ?>px;
}
.focusinfo img{
border-radius: <?=iro_opt('social_area_radius'); ?>px;
}
/*标题横线动画*/
<?php if (iro_opt('article_title_line', 'true')): ?>
@media (min-width:860px) {
.single-center .single-header h1.entry-title::after {
    content: '';
    position: absolute;
    top: 40%;
    left: 10%;
    border-radius: 10px;
    display: inline-block;
    width: 20%;
    height: 10px;
    z-index: 1;
    background-color: var(--article-theme-highlight,var(--theme-skin-matching));
    animation: lineWidth 2s <?=iro_opt('page_title_animation_time'); ?>s forwards;
    opacity: 0;
}
}

@keyframes lineWidth {
    0% {
        width: 0;
        opacity: 0;
    }
    100% {
        width: 20%;
        opacity: 0.5;
    }
}
<?php endif; ?>
/*标题动画*/
<?php if (iro_opt('page_title_animation', 'true')): ?>
.entry-title,.single-center .entry-census,.entry-census,.p-time{
	-moz-animation: homepage-load-animation <?=iro_opt('page_title_animation_time'); ?>s;
    -webkit-animation:homepage-load-animation <?=iro_opt('page_title_animation_time'); ?>s;
	animation: homepage-load-animation <?=iro_opt('page_title_animation_time'); ?>s;
}

@-moz-keyframes fadeInUp {
	0% {
		-moz-transform: translateY(200%);
		transform: translateY(200%);
		opacity: 0
	}
	50% {
		-moz-transform: translateY(200%);
		transform: translateY(200%);
		opacity: 0
	}
	100% {
		-moz-transform: translateY(0%);
		transform: translateY(0%);
		opacity: 1
	}
}
@-webkit-keyframes fadeInUp {
	0% {
		-webkit-transform: translateY(200%);
		transform: translateY(200%);
		opacity: 0
	}
	50% {
		-webkit-transform: translateY(200%);
		transform: translateY(200%);
		opacity: 0
	}
	100% {
		-webkit-transform: translateY(0%);
		transform: translateY(0%);
		opacity: 1
	}
}
@keyframes fadeInUp {
	0% {
		-moz-transform: translateY(200%);
		-ms-transform: translateY(200%);
		-webkit-transform: translateY(200%);
		transform: translateY(200%);
		opacity: 0
	}
	50% {
		-moz-transform: translateY(200%);
		-ms-transform: translateY(200%);
		-webkit-transform: translateY(200%);
		transform: translateY(200%);
		opacity: 0
	}
	100% {
		-moz-transform: translateY(0%);
		-ms-transform: translateY(0%);
		-webkit-transform: translateY(0%);
		transform: translateY(0%);
		opacity: 1
	}
}
<?php endif; ?>
/*首页封面动画*/
<?php if (iro_opt('cover_animation', 'true')): ?>
h1.main-title, h1.fes-title,.the-feature.from_left_and_right .info,
.header-info p,.header-info,.header-shuo,.header-shuo p,
.focusinfo .header-tou img,.top-social img,.center-text{
	-moz-animation: fadeInDown  <?=iro_opt('cover_animation_time'); ?>s;
    -webkit-animation:fadeInDown  <?=iro_opt('cover_animation_time'); ?>s;
	animation: fadeInDown  <?=iro_opt('cover_animation_time'); ?>s;
}
@-moz-keyframes fadeInDown {
	0% {
		-moz-transform: translateY(-100%);
		transform: translateY(-100%);
		opacity: 0
	}
	50% {
		-moz-transform: translateY(-100%);
		transform: translateY(-100%);
		opacity: 0
	}
	100% {
		-moz-transform: translateY(0%);
		transform: translateY(0%);
		opacity: 1
	}
}
@-webkit-keyframes fadeInDown {
	0% {
		-webkit-transform: translateY(-100%);
		transform: translateY(-100%);
		opacity: 0
	}
	50% {
		-webkit-transform: translateY(-100%);
		transform: translateY(-100%);
		opacity: 0
	}
	100% {
		-webkit-transform: translateY(0%);
		transform: translateY(0%);
		opacity: 1
	}
}
@keyframes fadeInDown {
	0% {
		-moz-transform: translateY(-100%);
		-ms-transform: translateY(-100%);
		-webkit-transform: translateY(-100%);
		transform: translateY(-100%);
		opacity: 0
	}
	50% {
		-moz-transform: translateY(-100%);
		-ms-transform: translateY(-100%);
		-webkit-transform: translateY(-100%);
		transform: translateY(-100%);
		opacity: 0
	}
	100% {
		-moz-transform: translateY(0%);
		-ms-transform: translateY(0%);
		-webkit-transform: translateY(0%);
		transform: translateY(0%);
		opacity: 1
	}
}
<?php endif; ?>
/*导航菜单动画*/
<?php if (iro_opt('nav_menu_animation', 'true')): ?>
.site-top ul {
	-moz-animation: fadeInLeft  <?=iro_opt('nav_menu_animation_time'); ?>s;
    -webkit-animation:fadeInLeft  <?=iro_opt('nav_menu_animation_time'); ?>s;
	animation: fadeInLeft  <?=iro_opt('nav_menu_animation_time'); ?>s;
    max-width: 76vw;
}
@-moz-keyframes fadeInLeft {
	0% {
		-moz-transform: translateX(100%);
		transform: translateX(100%);
		opacity: 0
	}
	50% {
		-moz-transform: translateX(100%);
		transform: translateX(100%);
		opacity: 0
	}
	100% {
		-moz-transform: translateX(0%);
		transform: translateX(0%);
		opacity: 1
	}
}
@-webkit-keyframes fadeInLeft {
	0% {
		-webkit-transform: translateX(100%);
		transform: translateX(100%);
		opacity: 0
	}
	50% {
		-webkit-transform: translateX(100%);
		transform: translateX(100%);
		opacity: 0
	}
	100% {
		-webkit-transform: translateX(0%);
		transform: translateX(0%);
		opacity: 1
	}
}
@keyframes fadeInLeft {
	0% {
		-moz-transform: translateX(100%);
		-ms-transform: translateX(100%);
		-webkit-transform: translateX(100%);
		transform: translateX(100%);
		opacity: 0
	}
	50% {
		-moz-transform: translateX(100%);
		-ms-transform: translateX(100%);
		-webkit-transform: translateX(100%);
		transform: translateX(100%);
		opacity: 0
	}
	100% {
		-moz-transform: translateX(0%);
		-ms-transform: translateX(0%);
		-webkit-transform: translateX(0%);
		transform: translateX(0%);
		opacity: 1
	}
}
<?php endif; ?>
/*其他*/
.headertop{
    border-radius: 0 0 <?=iro_opt('cover_radius', ''); ?>px <?=iro_opt('cover_radius', ''); ?>px;
}
<?php if (!iro_opt('article_function', 'true')): ?>
.post-footer {
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('article_lincenses', 'true')): ?>
.post-lincenses {
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('author_profile_avatar', 'true')): ?>
.author-profile .info {
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('author_profile_name', 'true')): ?>
.author-profile .meta {
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('article_tag', 'true')): ?>
.post-tags {
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('article_modified_time', 'true')): ?>
.post-modified-time {
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('nav_menu_user_avatar', 'true')): ?>
.header-user-avatar{
display:none;
}
<?php endif; ?>
<?php if (!iro_opt('footer_sakura', 'true')): ?>
.sakura-icon{
    width:max-content;height:max-content;margin: auto;
}
.sakura-svg {
animation: slow-rotate 10s linear infinite;
} 
<?php endif; ?>
<?php if (!iro_opt('drop_down_arrow_mobile', 'true')): ?>
@media (max-width: 860px) {
.headertop-down {
        display: none
    }
}
<?php endif; ?>
<?php if (!iro_opt('chatgpt_article_summarize', 'true')): ?>
.ai-excerpt,
.ai-excerpt-tip {
    display: none;
}
<?php endif; ?>
<?php if (!iro_opt('social_area', 'true')): ?>
.top-social_v2,.top-social{
    display: none;
}
<?php endif; ?>
<?php if(iro_opt('friend_link_align') == 'right'){ ?>
span.sitename {
   margin-bottom: 0px;
   margin-top: 8px;
}
li.link-item {
    text-align: right;
}
.links ul li img{
	float:none;
}
<?php }else if(iro_opt('friend_link_align') == 'center'){ ?>
span.sitename {
   margin-bottom: 0px;
   margin-top: 8px;
}
li.link-item {
    text-align: center;
}
.links ul li img{
	float:none;
}
<?php } ?>
<?php if(iro_opt('post_list_image_align') == 'left'){ ?>
.post-list-thumb .post-content-wrap {
    float: left;
    padding-left: 22px;
    padding-right: 0;
    text-align: right;
    margin: 26px 10px 10px 0
}
.post-list-thumb .post-thumb {
    float: left
}
.post-list-thumb .post-thumb a {
    border-radius: 10px 0 0 10px
}
<?php }else if(iro_opt('post_list_image_align') == 'alternate'){ ?>
.post-list-thumb:nth-child(2n) .post-content-wrap {
    float: left;
    padding-left: 22px;
    padding-right: 0;
    text-align: right;
    margin: 26px 10px 10px 0
}
.post-list-thumb:nth-child(2n) .post-thumb {
    float: left
}
@media (min-width: 860px) {
    .post-list-thumb:nth-child(2n) .post-date {
        margin-right: 0;
        margin-left: auto;
    }
}
.post-list-thumb:nth-child(2n) .post-thumb a {
    border-radius: 10px 0 0 10px
}
<?php } ?>
<?php if(iro_opt('page_style') == 'sakurairo'){ ?>
.pattern-center::after {
    display:none;
}
.pattern-center-blank {
    display:none;
}
<?php }else if(iro_opt('page_style') == 'sakura'){ ?>
.pattern-center {
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
}
<?php } ?>
<?php if(iro_opt('nav_menu_style') == 'sakurairo'){ ?>
.yya {
    position: fixed;
    -webkit-transition: all 1s ease !important;
    transition: all 1s ease !important;
    border-radius: <?=iro_opt('nav_menu_radius', ''); ?>px !important;
}

}

@media (min-width:860px) {
.post-meta{
    right: 21.5%;
    max-width: 59.5%;
}

}

@media (max-width:860px) {
.post-meta{
    right: 10px;
    height: fit-content;
    width: fit-content;
    max-height: 32%;
    max-width: 32%;
    top: 10px;
    flex-direction: column;
    transition: all 0.6s ease-in-out;
    -webkit-transition: all 0.6s ease-in-out;
}
}
<?php }if(iro_opt('nav_menu_style') == 'sakura'){ ?>
.site-header {
    width: 100%;
    height: 75px;
    top: 0;
    left: 0;
    background: 0 0;
    -webkit-transition: all .4s ease;
    transition: all .4s ease;
    position: fixed;
    z-index: 999;
    border-radius: 0px;
}
.header-user-avatar {
  margin-top: 22px;
}
.post-title {
  background-color: transparent;
  border: none;
  backdrop-filter: none;
  -webkit-backdrop-filter: none;
  box-shadow: none;
}
body.dark .post-title {
  background-color: transparent;
  border: none;
  box-shadow: none;
}
.post-title:hover {
  background-color: transparent;
  border: none;
  backdrop-filter: none;
  -webkit-backdrop-filter: none;
  box-shadow: none;
}
body.dark .post-title:hover{
  background-color: transparent;
  border: none;
  box-shadow: none;
}
.post-list-thumb .post-title h3 {
  color: #EEE9E9;
}
}
<?php } ?>

<?php 
// Menu style settings
$nav_menu_style = iro_opt('nav_menu_style');
$has_user_avatar = iro_opt('nav_menu_user_avatar');
$has_logo = !empty(iro_opt('iro_logo')) || !empty($nav_text_logo['text']); 

// Space between menu items when avatar and logo are enabled
if($nav_menu_style == 'space-between' && ($has_user_avatar || $has_logo)){ ?> 
.site-header {
    justify-content: space-between; 
}
.header-user-menu {
    right: -5%;
}
<?php } else { ?>
.site-header {
    justify-content: center;
}
.header-user-menu {
    right: -105%;
}
<?php } ?>
<?php if (!iro_opt('nav_menu_secondary_arrow', 'true')): ?>
.header-user-menu::before {
    display: none;
}
.lower li ul::before {
    display: none;
}
<?php endif; ?>
<?php if (!iro_opt('shuoshuo_arrow', 'true')): ?>
.cbp_tmtimeline > li:nth-child(odd) .cbp_tmlabel:after {
    display: none;
}
.cbp_tmtimeline > li .cbp_tmlabel:after {
    display: none;
}
<?php endif; ?>
<?php if (iro_opt('exhibition_area_compat', 'true')): ?>
.the-feature.from_left_and_right {
    position: relative;
    border-radius: <?=iro_opt('exhibition_radius', ''); ?>px;
    height: 160px;
    width: 258px;
    margin: 6px 6px 0 6px;
}
.the-feature img {
    height: 160px;
    width: 258px;
}
<?php endif; ?>
<?php if(iro_opt('bulletin_board_text_align') == 'center'){ ?>
.notice {
    text-align: center;
}
<?php }if(iro_opt('bulletin_board_text_align') == 'right'){ ?>
.notice {
    text-align: right;
}
<?php } ?>
<?php if(iro_opt('area_title_text_align') == 'center'){ ?>
h1.fes-title,
h1.main-title {
  text-align: center;
}
<?php }else if(iro_opt('area_title_text_align') == 'right'){ ?>
h1.fes-title,
h1.main-title {
    text-align: right;
}
<?php } ?>
<?php if(iro_opt('bulletin_board_style') == 'picture'){ ?>
.notice {
    background-image:url(<?=iro_opt('bulletin_board_bg', ''); ?>);
    background-repeat: round;
    border: none;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, .3);
}
<?php }if(iro_opt('bulletin_board_style') == 'pure'){ ?>
.notice {
    background: #fbfbfb50;
}
<?php } ?>
<?php 
if(iro_opt('cover_half_screen_curve',true)){
   ?> 
   .headertop-bar::after {
    content: '';
    width: 150%;
    height: 4.375rem;
    background-color: rgba(255, 255, 255,<?=iro_opt('reception_background_transparency'); ?>);
<?php if (iro_opt('reception_background_blur', 'false')): ?> backdrop-filter: saturate(180%) blur(10px); <?php endif; ?>
<?php if (iro_opt('reception_background_blur', 'false')): ?> -webkit-backdrop-filter: saturate(180%) blur(10px); <?php endif; ?>
    left: -25%;
    bottom: -2.875rem;
    border-radius: 100%;
    position: absolute;
    z-index: 4;
}
   .headertop{
    border-radius:0 !important;
}
   .wrapper{
    border-top:0 !important;
}
   <?php
}
?>
body{
    background-size:<?=iro_opt(('reception_background_size'),'auto')
?>;
}
#video-add{
    background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/add.svg);
}
@media (max-width:860px) {
  .headertop.filter-dot::before {
    background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/grid.png);
  }
}
.headertop.filter-grid::before {
  background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/grid.png);
}
.headertop.filter-dot::before {
  background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/dot.gif);
}
.loadvideo,.video-play {
  background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/play.svg);
}
.video-pause {
  background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/pause.svg);
}
#loading-comments {
background-image: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>load_svg/ball.svg);
}
<?php if (iro_opt('wave_effects', 'true')): ?>
#banner_wave_1 {
    background: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/wave1.png) repeat-x;
}
#banner_wave_2 {
    background: url(<?=iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.7/')?>basic/wave2.png) repeat-x;
}
.headertop{
    border-radius:0 !important;
}
<?php endif; ?>
</style>
<?php }
add_action('wp_head', 'customizer_css');
