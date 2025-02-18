<?php
	/**
	 * COMMENTS TEMPLATE
	 */

	/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(__('Please do not load this page directly.', 'akina'));*/

	if(post_password_required()){
		return;
	}
?>

	<?php if(comments_open()): ?>

	<section id="comments" class="comments">
		<div class="commentwrap comments-hidden<?php echo iro_opt('comment_area')=='fold'?' comments-fold':'' ?>">
			<div class="notification"><i class="fa-regular fa-comment"></i><?php _e('view comments', 'sakurairo'); /*查看评论*/?> -
			<span class="noticom"><?php comments_number('NOTHING', '1'.__(" comment","sakurairo"), '%'.__(" comments","sakurairo")); ?> </span>
			</div>
		</div>
		<div class="comments-main">
		 <h3 id="comments-list-title">Comments <span class="noticom"><?php comments_number('NOTHING', '1'.__(" comment","sakurairo"), '%'.__(" comments","sakurairo")); ?> </span></h3> 
		<div id="loading-comments"><span></span></div>
			<?php if(have_comments()): ?>
				<ul class="commentwrap">
					<?php wp_list_comments(
						array(
							"type" => "comment",
							"callback" => "akina_comment_format",
							"reverse_top_level" => get_option('comment_order') == 'asc' ? null : true
						)
					);
					?>
				</ul>
          <nav id="comments-navi">
				<?php paginate_comments_links('prev_text=« Older&next_text=Newer »');?>
			</nav>

			 <?php else : ?>

				<?php if(comments_open()): ?>
					<div class="commentwrap">
						<div class="notification-hidden"><i class="fa-regular fa-comment"></i> <?php _e('no comment', 'sakurairo'); /*暂无评论*/?></div>
					
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php
				if(comments_open()){
					$robot_comments= null;
					if(iro_opt('not_robot')) $robot_comments = '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="no-robot"><span class="siren-no-robot-checkbox siren-checkbox-radioInput"></span>'.__('I\'m not a robot', 'sakurairo').'</label>';
					$private_ms = iro_opt('comment_private_message') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="is-private"><span class="siren-is-private-checkbox siren-checkbox-radioInput"></span>'.__('Comment in private', 'sakurairo').'</label>' : '';
					$mail_notify = iro_opt('mail_notify') ? '<label class="siren-checkbox-label"><input class="siren-checkbox-radio" type="checkbox" name="mail-notify"><span class="siren-mail-notify-checkbox siren-checkbox-radioInput"></span>'.__('Comment reply notify', 'sakurairo').'</label>' : '';
					$args = array(
						'id_form' => 'commentform',
						'id_submit' => 'submit',
						'title_reply' => '',
						'title_reply_to' => '<div class="graybar"><i class="fa-regular fa-comment"></i>' . __('Leave a Reply to', 'sakurairo') . ' %s' . '</div>',
						'cancel_reply_link' => __('Cancel Reply', 'sakurairo'),
						'label_submit' => __('提交~', 'sakurairo'),
						'comment_field' => '<p style="font-style:italic"><a href="https://segmentfault.com/markdown" target="_blank"><i class="fa-brands fa-markdown" style="color:var(--comment_area_matching);"></i></a> Markdown Supported while <i class="fa-solid fa-code"></i> Forbidden</p><div class="comment-textarea"><textarea placeholder="' . __("You are a surprise that I will only meet once in my life", "sakurairo") . ' ..." name="comment" class="commentbody" id="comment" rows="5" tabindex="4"></textarea><label class="input-label">' . __("You are a surprise that I will only meet once in my life", "sakurairo") . ' ...</label></div>
                        <div id="upload-img-show"></div>',
						'comment_notes_after' => '',
						'comment_notes_before' => '',
						'fields' => apply_filters( 'comment_form_default_fields', array(
							'avatar' => '<div class="cmt-info-container"><div class="comment-user-avatar"><img alt="comment_user_avatar" src="' . iro_opt('vision_resource_basepath', 'https://s.nmxc.ltd/sakurairo_vision/@2.6/') . 'basic/avatar.jpeg"><div class="socila-check qq-check"><i class="fa-brands fa-qq"></i></div><div class="socila-check gravatar-check"><i class="fa-solid fa-face-kiss-wink-heart"></i></div></div>',
							'author' =>
								'<div class="popup cmt-popup cmt-author" onclick="cmt_showPopup(this)"><span class="popuptext" id="thePopup" style="margin-left: -115px;width: 230px;">' . __("Auto pull nickname and avatar with a QQ num. entered", "sakurairo")/*输入 QQ 号将自动拉取昵称和头像*/ . '</span><input type="text" placeholder="' . __("Nickname or QQ number", "sakurairo") /*昵称或 QQ 号*/. ' ' . ( $req ?  '(' . __("Name* ", "sakurairo") . ')' : '') . '" name="author" id="author" value="' . esc_attr($comment_author) . '" size="22" autocomplete="off" tabindex="1" ' . ($req ? "aria-required='true'" : '' ). ' /></div>',
							'email' =>
								'<div class="popup cmt-popup" onclick="cmt_showPopup(this)"><span class="popuptext" id="thePopup" style="margin-left: -65px;width: 130px;">' . __("You will receive notification by email", "sakurairo")/*你将收到回复通知*/ . '</span><input type="text" placeholder="' . __("email", "sakurairo") . ' ' . ( $req ? '(' . __("Must* ", "sakurairo") . ')' : '') . '" name="email" id="email" value="' . esc_attr($comment_author_email) . '" size="22" tabindex="1" autocomplete="off" ' . ($req ? "aria-required='true'" : '' ). ' /></div>',
							'url' =>
								'<div class="popup cmt-popup" onclick="cmt_showPopup(this)"><span class="popuptext" id="thePopup" style="margin-left: -55px;width: 110px;">' . __("Advertisement is forbidden 😀", "sakurairo")/*禁止小广告😀*/ . '</span><input type="text" placeholder="' . __("Site", "sakurairo") . '" name="url" id="url" value="' . esc_attr($comment_author_url) . '" size="22" autocomplete="off" tabindex="1" /></div></div>' . $robot_comments . $private_ms . $mail_notify ,
                            'qq' =>
								'<input type="text" placeholder="QQ" name="new_field_qq" id="qq" value="' . esc_attr($comment_author_url) . '" style="display:none" autocomplete="off"/><!--此栏不可见-->'
							)
						)
					);
					comment_form($args);
				}
			?>
		</div>
	</section>
<?php endif; ?>
