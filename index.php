<?php get_header(); ?>

<hr>
	<div class="row">
		<div class="col-xs-12 text-center">
			<?php 
				$lastPost = new WP_query("type=post&posts_per_page=1&category_name=yoobee-blog");
			 ?>
			<?php if($lastPost->have_posts()): ?>
				<?php while($lastPost->have_posts()): $lastPost->the_post();?>
					<div><?php the_post_thumbnail('full', ['class' => 'img-responsive', 'title' => 'Feature image']); ?></div>
					<h3><?php the_title(); ?></h3>
					<div><?php the_content(); ?></div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php 
			$parms = array(
				'type' => 'post',
				'category_name' => 'yoobee-blog',
				'posts_per_page' => 2,
				'offset' => 1
			);
			$nextPosts = new WP_Query($parms);
		 ?>
		<?php if($nextPosts->have_posts()): ?>
			<?php while($nextPosts->have_posts()): $nextPosts->the_post();?>
			<div class="col-xs-12 col-sm-6">
				<div><?php the_post_thumbnail('full', ['class' => 'img-responsive', 'title' => 'Feature image']); ?></div>
				<h3><?php the_title(); ?></h3>
			</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>

	<br>
	<hr>
	<br>

	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<?php if(have_posts()): ?>
				<?php while(have_posts()): the_post();?>

					<?php get_template_part('content',get_post_format()); ?>

				<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>





<?php get_footer(); ?>
