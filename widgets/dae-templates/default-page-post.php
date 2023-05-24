<div class="card-product-home">
	<div class="imageloc">
		<?php the_post_thumbnail('medium'); ?>
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
		<h2><?php echo get_the_title(); ?></h2>
		<div class="contentAreraaa">
			<?php echo get_the_excerpt(); ?>
		</div>
		<div class="flexDetails second">
			<div>
				<a href="<?php echo get_permalink(); ?>">read more</a>
			</div>
		</div>
	</div>
</div>
