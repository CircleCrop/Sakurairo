<?php

/**
 * Template Name: 说说模版
 */

get_header();
?>

<div id="primary" class="content-area">
    <main class="site-main" role="main">
        <?php
        $shuoshuo_per_page = iro_opt('shuoshuo_per_page'); //每页显示的说说数量
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'shuoshuo',
            'post_status' => 'publish',
            'posts_per_page' => $shuoshuo_per_page,
            'paged' => $paged
        );
        $shuoshuo_query = new WP_Query($args);
        if ($shuoshuo_per_page % 2 == 0) {
            $prev_index = $shuoshuo_per_page / 2;
        } else {
            $prev_index = ($shuoshuo_per_page + 1) / 2;
        }
        ?>
        <div class="entry-content">
            <?php the_content('', true); ?>
        </div>
        <div class="cbp_shuoshuo">
            <?php if ($shuoshuo_query->have_posts()): ?>
                <ul id="main" class="cbp_tmtimeline">
                    <?php $ad_index = 1;
                    while ($shuoshuo_query->have_posts()):
                        $shuoshuo_query->the_post(); ?>
                        <li id="shuoshuo_post">
                            <a href="<?php the_permalink(); ?>">
                                <span class="shuoshuo_author_img">
                                    <img src="<?php echo get_avatar_profile_url(get_the_author_meta('ID')); ?>"
                                        class="avatar avatar-48" width="48" height="48">
                                </span>
                                <div class="cbp_tmlabel">
                                    <object class="entry-content">
                                        <p></p>
                                        <?php the_content('', true); ?>
                                    </object>
                                    <p class="shuoshuo_meta">
                                        <i class="fa-regular fa-clock"></i>
                                        <?php the_time('Y/n/j G:i'); ?>
                                        <span class="comments-number"><i class="fa-regular fa-comments"></i>
                                            <?php comments_number('0', '1', '%'); ?>
                                        </span>
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php if ($ad_index == $prev_index): ?>
                            <li id="shuoshuo_post">
                                <span class="shuoshuo_author_img">
                                    <img src="https://vision-source.aiccrop.com/display_icon/gads.svg" class="avatar avatar-48"
                                        width="48" height="48" style="padding:3px">
                                </span>
                                <div class="cbp_tmlabel">
                                    <object class="entry-content-da">
                                        <ins class="adsbygoogle"
                                            style="display:block;background-color:var(--shuoshuo_background_color1,#ee9999)"
                                            data-ad-format="fluid" data-ad-layout-key="-c0+4y+4e+x-1w"
                                            data-ad-client="ca-pub-6013103294751614" data-ad-slot="1055170919"></ins>
                                    </object>
                                    <p class="shuoshuo_meta">
                                        <i class="fa-regular fa-clock"></i> 2023/06/12 20:22 <span class="comments-number"><i
                                                class="fa-regular fa-comments"></i> 8 </span>
                                    </p>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php $ad_index++;
                    endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            <?php else: ?>
                <h3 style="text-align: center;">
                    <?php _e('You have not posted a comment yet', 'sakurairo') ?>
                </h3>
                <p style="text-align: center;">
                    <?php _e('Go and post your first comment now', 'sakurairo') ?>
                </p>
            <?php endif; ?>
        </div>
    </main><!-- #main -->
    <?php if (iro_opt('pagenav_style') == 'ajax') { ?>
        <div id="pagination">
            <?php next_posts_link(__('Load More', 'sakurairo'), $shuoshuo_query->max_num_pages); ?>
        </div>
        <div id="add_post">
            <span id="add_post_time" style="visibility: hidden;"
                title="0"></span>
        </div>
    <?php } else { ?>
        <nav class="navigator">
            <?php previous_posts_link('<i class="fa-solid fa-angle-left"></i>') ?>
            <?php next_posts_link('<i class="fa-solid fa-angle-right"></i>', $shuoshuo_query->max_num_pages) ?>
        </nav>
    <?php } ?>
</div><!-- #primary -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6013103294751614"
    crossorigin="anonymous"></script>
<script>
    function executeAdsByGoogle() {
        (adsbygoogle = window.adsbygoogle || []).push({});
    }
    const insElements = document.getElementsByClassName('adsbygoogle');
    const initialInsCount = insElements.length;
    setInterval(() => {
        const currentInsCount = document.getElementsByClassName('adsbygoogle').length;
        if (currentInsCount !== initialInsCount) {
            executeAdsByGoogle();
        }
    }, 1600);
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const timelines = document.querySelectorAll('.cbp_tmtimeline');
        timelines.forEach(timeline => {
            timeline.addEventListener('mouseover', event => {
                if (event.target.matches('.cbp_tmtimeline li .shuoshuo_author_img img')) {
                    event.target.classList.add('zhuan');
                }
            });
            timeline.addEventListener('mouseout', event => {
                if (event.target.matches('.cbp_tmtimeline li .shuoshuo_author_img img')) {
                    event.target.classList.remove('zhuan');
                }
            });
        });
    });
</script>
<?php get_footer(); ?>