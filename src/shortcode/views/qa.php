<dl class"ga--container">
	<dt class="qa--question" itemscope itemtype="https://schema.org/Question" data-show-icon"<?php echo $attributes['show_icon']; ?>" data-hide-icon"<?php esc_attr_e( $attributes['hide_icon'] ); ?>">
		<span class="qa--icon <?php echo $attributes['show_icon']; ?>" aria-hidden="true"><span class="screen-reader-text">Click to reveal the answer</span></span><?php esc_html_e( $attributes['question'] ); ?></dt>
	<dd class="qa--answer" itemprop="suggestedAnswer" itemscope itemtype="https://schema.org/Answer" style="display:none"><?php echo $hidden_content; ?></dd>
</dl>

