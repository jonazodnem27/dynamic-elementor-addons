<div class="card-product-home">
	<div class="imageloc">
		<?php echo get_the_post_thumbnail($value->ID, 'medium'); ?>
		<div class="absoluteDetailsNew">
			<div class="flexDetails no">
				<div>
					<i class="fa fa-user"></i> by Admin
				</div>
				<div>
					<i class="fa fa-calendar"></i> <?php echo get_post_time('F j', true); ?>
				</div>
			</div>
	</div>
</div>
	<div class="otherContent">
		<h2><?php echo get_the_title($value->ID); ?></h2>
		<div class="contentAreraaa">
			<?php echo get_the_excerpt($value->ID); ?>
		</div>
		<div class="flexDetails second">
			<div>
				<a href="<?php echo get_permalink($value->ID); ?>">read more</a>
			</div>
		</div>
	</div>
</div>
