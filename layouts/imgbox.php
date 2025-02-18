<?php
include(get_stylesheet_directory() . '/layouts/all_opt.php');
$text_logo = iro_opt('text_logo');
$print_social_zone = function () use ($all_opt, $social_display_icon): void {
    // 左箭头
    if (iro_opt('cover_random_graphs_switch', 'true')): ?>
        <li id="bg-pre"><img src="<?= $social_display_icon ?>pre.png" loading="lazy" alt="<?= __('Previous', 'sakurairo') ?>" /></li>
        <?php
    endif;
    // 微信
    if (iro_opt('wechat')): ?>
        <li class="wechat"><a href="#" title="WeChat"><img loading="lazy" src="<?= $social_display_icon ?>wechat.png" /></a>
            <div class="wechatInner">
                <img class="wechat-img" style="height: max-content;width: max-content;" loading="lazy" src="<?= iro_opt('wechat', '') ?>" alt="WeChat">
            </div>
        </li>
        <?php
    endif;
    // 大体(all_opt.php)
    foreach ($all_opt as $key => $value):
        if (!empty($value['link'])):
            // 显然 这里的逻辑可以看看all_opt的结构
            $img_url = $value['img'] ?? ($social_display_icon . ($value['icon'] ?? $key) . '.svg');
            $title = $value['title'] ?? $key;
            ?>
            <li><a href="<?= $value['link']; ?>" target="_blank" class="social-<?= $value['class'] ?? $key ?>" title="<?= $title ?>"><img alt="<?= $title ?>" loading="lazy" src="<?= $img_url ?>" /></a></li>
            <?php
        endif;
    endforeach;
    // 邮箱
    if (iro_opt('email_name') && iro_opt('email_domain')): ?>
        <li><a onclick="mail_me()" class="social-wangyiyun" title="E-mail"><img loading="lazy" alt="E-mail" src="<?= iro_opt('vision_resource_basepath') ?><?= iro_opt('social_display_icon') ?>/mail.png" /></a></li>
        <?php
    endif;
    // 右箭头
    if (iro_opt('cover_random_graphs_switch', 'true')): ?>
        <li id="bg-next"><img loading="lazy" src="<?= $social_display_icon ?>next.png" alt="<?= __('Next', 'sakurairo') ?>" /></li>
    <?php endif;
}
    ?>
<?php
/*未定义的伪类 */
/* <style>
.header-info::before {
    display: none !important;
    opacity: 0 !important;
}
</style> */
?>
<div id="banner_wave_1"></div>
<div id="banner_wave_2"></div>
<figure id="centerbg" class="centerbg">
    <?php if (iro_opt('infor_bar')) { ?>
        <div class="focusinfo">
            <div class="header-container">
                <div class="header-info">
                    <?php if (iro_opt('signature_typing', 'true')): ?>
                        <?php if (iro_opt('signature_typing_marks', 'true')): ?><i class="fa-solid fa-quote-left"></i>
                        <?php endif; ?>
                        <span class="element">
                            <?= iro_opt('signature_typing_placeholder', '疯狂造句中......') ?>
                        </span>
                        <?php if (iro_opt('signature_typing_marks', 'true')): ?><i class="fa-solid fa-quote-right"></i>
                        <?php endif; ?>
                        <span class="element"></span>
                        <script type="application/json" id="typed-js-initial">
                            <?= iro_opt('signature_typing_json', ''); ?>
                            </script>
                    <?php endif; ?>
                    <p>
                        <?php echo iro_opt('signature_text', 'Hi, Mashiro?'); ?>
                    </p>
                    <?php if (iro_opt('infor_bar_style') === 'v2'): ?>
                        <div class="top-social_v2">
                            <?php $print_social_zone(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (iro_opt('infor_bar_style') === 'v1'): ?>
                <div class="top-social">
                    <?php $print_social_zone(); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php } ?>
</figure>
<?php
echo bgvideo();
?>
<?php if (iro_opt('drop_down_arrow', 'true')): ?>
    <div class="headertop-down" onclick="headertop_down()"><span><svg t="1682342753354" class="homepage-downicon" viewBox="0 0 1843 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="21355" width="80px" height="80px"><path d="M1221.06136021 284.43250057a100.69380037 100.69380037 0 0 1 130.90169466 153.0543795l-352.4275638 302.08090944a100.69380037 100.69380037 0 0 1-130.90169467 0L516.20574044 437.48688007A100.69380037 100.69380037 0 0 1 647.10792676 284.43250057L934.08439763 530.52766665l286.97696258-246.09516608z" fill="<?php echo iro_opt('drop_down_arrow_color'); ?>" p-id="21356"></path></svg></span></div>
<?php endif; ?>