<?php

/**
 * NEXT / PREVIOUS POSTS (精华版)
 */

if (iro_opt('article_nextpre') == '1') {
	?>
	<section class="post-squares nextprev">
		<?php
		$classify_display_id = iro_opt('classify_display');
		$previous_style = get_next_post(false, $classify_display_id) ? 'half' : 'full';
		$next_style = get_previous_post(false, $classify_display_id) ? 'half' : 'full';
		$prev_link_html = '<div class="background" style="background-image:url(' . get_prev_thumbnail_url() . ');background-position:center;"></div>' .
			'<span class="label">' .
			__("Previous Post", 'sakurairo') .
			'</span>' .
			'<div class="info">' .
			'<h3>%title</h3><hr>' .
			'</div>';
		$next_link_html = '<div class="background" style="background-image:url(' . get_next_thumbnail_url() . ');background-position:center;"></div>' .
			'<span class="label">' .
			__("Next Post", 'sakurairo') .
			'</span>' .
			'<div class="info">' .
			'<h3>%title</h3><hr>' .
			'</div>';
		?>
		<div class="post-nepre <?php echo $previous_style; ?> previous">
			<?php previous_post_link('%link', $prev_link_html, false, $classify_display_id) ?>
		</div>
		<div class="post-nepre <?php echo $next_style; ?> next">
			<?php next_post_link('%link', $next_link_html, false, $classify_display_id) ?>
		</div>
	</section>
<?php } ?>