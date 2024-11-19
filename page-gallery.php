<?php
/*
Template Name: Image-Only Gallery Layout with Animation
*/

get_header(); ?>

<style>
/* Masonry grid style */
.grid {
  max-width: 820px; /* 页面最大宽度 */
  margin: 0 auto;
}

/* Masonry grid item style */
.grid-item {
  width: calc(50% - 0.2em); /* 减去间隙的一半确保有空间放置两列 */
  margin-bottom: 0.5em;
  transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
  will-change: transform, opacity;
  opacity: 0; /* 初始设置为不可见，将在滚动事件中通过JS来控制 */
}

.grid-item img {
  display: block;
  max-width: 100%;
  height: auto;
}

/* Only animate items that are in the viewport */
.grid-item.in-view {
  opacity: 1;
  transform: translateY(0);
  padding: 0 5px;
}
</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="grid">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php
                $content = apply_filters( 'the_content', get_the_content() );
                $dom = new DOMDocument();
                @$dom->loadHTML($content);
                $images = $dom->getElementsByTagName('img');
                foreach ($images as $image) {
                    $src = $image->getAttribute('src');
                    $parent = $image->parentNode;
                    $href = ($parent->nodeName === 'a') ? $parent->getAttribute('href') : $src;
                    echo "<div class='grid-item'>";
                    echo "<a href='{$href}'><img class=\"wp-image-galleryWaterfall\" src='{$src}' /></a>";
                    echo "</div>";
                }
                ?>
            <?php endwhile; ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->
<script src="https://cdn.bootcdn.net/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  var grid = document.querySelector('.grid');
  var msnry;
  // 确保图片加载完成后再初始化 Masonry
  imagesLoaded(grid, function() {
    // 初始化 Masonry
    msnry = new Masonry(grid, {
      itemSelector: '.grid-item',
      percentPosition: true,
      columnWidth: '.grid-item',
      transitionDuration: 0 // 禁用 Masonry 自身的过渡效果，因为我们使用了 CSS 过渡
    });
    // 布局完成后将所有元素设置为可见
    msnry.on('layoutComplete', function() {
      var gridItems = document.querySelectorAll('.grid-item');
      gridItems.forEach(function(item) {
        item.style.opacity = 1;
      });
    });

    msnry.layout();
  });
  // 监听滚动事件以触发动画效果
  window.addEventListener('scroll', function() {
    var gridItems = document.querySelectorAll('.grid-item:not(.in-view)');
    gridItems.forEach(function(item) {
      var rect = item.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom >= 0) {
        item.classList.add('in-view');
      }
    });
  });
});
</script>
<?php get_footer(); ?>
