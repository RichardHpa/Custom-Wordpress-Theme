<?php 
	/*
		Template Name: Programmes Page
	*/
 ?>
<?php get_header(); ?>

<hr>
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div class="row">
			<?php if(have_posts()): ?>
				<?php while(have_posts()): the_post();?>
					<h3><?php the_title(); ?></h3>
					<div><?php the_post_thumbnail('thumbnail'); ?></div>
					<small>Posted on: <?php the_time('F j Y'); ?></small>
					<div><?php the_content(); ?></div>
					<hr>
				<?php endwhile; ?>
			<?php endif; ?>
			</div>
			<?php 
				$category = html_entity_decode(get_the_title());
				$category = strtolower($category);
				$category = preg_replace('/[^\p{L}\p{N}\s]/u', '', $category);
				$category = preg_replace('/\s+/', ' ',$category);
				$category = str_replace(' ', '-', $category);
				
				// $programmes = new WP_Query("type=post&category_name=$category");

				$parms = array(
					'post_type'=>'programmes',
					'posts_per_page' => 2
				);
				$programmes = new WP_Query($parms);

			 ?>
			<div class="row">
				<?php if($programmes->have_posts()): ?>
					<?php while($programmes->have_posts()): $programmes->the_post();?>
						<h3><?php the_title(); ?></h3>
						<div><?php the_content(); ?></div>
						<hr>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
