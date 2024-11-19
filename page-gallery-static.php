<?php
/*
Template Name: Custom Image Gallery with Lazy Load
*/

get_header();

// 获取当前页面的内容
$post_content = get_the_content();

// 使用正则表达式匹配所有的图片块
preg_match_all('/wp:image {"id":(\d+),"sizeSlug":"medium","linkDestination":"media"}/', $post_content, $matches);
$image_ids = $matches[1]; // 提取所有匹配到的图片ID
$columns = [[], []]; // 两列
$column_heights = [0, 0]; // 两列的累计高度

foreach ($image_ids as $id) {
    $image_meta = wp_get_attachment_metadata($id); // 获取图片元数据
    $medium_height = $image_meta['sizes']['medium']['height']; // 假设中等大小图片的高度

    // 础列的累计高度决定将图片分配到哪一列
    $min_height_col = array_search(min($column_heights), $column_heights);
    $columns[$min_height_col][] = $id;
    $column_heights[$min_height_col] += $medium_height;
}
?>

<style>
.gallery-column {
    width: calc(50% - 8px); /* 计算两列之间的空间 */
}

.gallery-image {
    width: 100%;
    margin-bottom: 18px;
    display: block; /* 确保图片不会显示内联，以避免底部空间 */
    opacity: 0; /* 初始不显示图片，等待Intersection Observer触发 */
    transition: opacity 0.4s ease-in-out;
    border-radius: 14px;
}

.gallery-image:hover {
    opacity: 0.7 !important; /* 初始不显示图片，等待Intersection Observer触发 */
    transition: opacity 0.2s ease-in-out !important;
}
</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="gallery-container" style="display: flex; flex-wrap: wrap; gap: 14px; justify-content: space-between;">
            <?php foreach ($columns as $column => $ids) : ?>
                <div class="gallery-column" style="flex: 1">
                    <?php foreach ($ids as $id) : ?>
                        <?php 
                        $image_url = wp_get_attachment_url($id); // 获取原图URL
                        $medium_url = wp_get_attachment_image_src($id, 'medium')[0]; // 获取中等大小缩略图URL
                        ?>
                        <a href="<?php echo esc_url($image_url); ?>" target="_blank" style="display: block; margin-bottom: 8px;">
                            <img src="#" data-src="<?php echo esc_url($medium_url); ?>" class="gallery-image" loading="lazy" alt="" style="width: 100%; height: auto; display: block; opacity: 0; transition: opacity 0.5s ease-in-out;">
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<script>
document.addEventListener("DOMContentLoaded", () => {
    let observer;
    let images = document.querySelectorAll('.gallery-image');

    if ('IntersectionObserver' in window) {
        observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    let image = entry.target;
                    image.src = image.dataset.src;
                    image.style.opacity = 1;
                    obs.unobserve(image);
                }
            });
        }, {rootMargin: "50px 0px", threshold: 0.01});

        // 交错地将图片添加到观察者中
        const imagesEven = Array.from(images).filter((_, index) => index % 2 === 0);
        const imagesOdd = Array.from(images).filter((_, index) => index % 2 !== 0);
        const staggeredImages = imagesEven.concat(imagesOdd);
        
        staggeredImages.forEach(image => {
            observer.observe(image);
        });
    } else {
        // Fallback for browsers that don't support Intersection Observer
        images.forEach(image => {
            image.src = image.dataset.src;
            image.style.opacity = 1;
        });
    }
});

</script>

<?php get_footer(); ?>
