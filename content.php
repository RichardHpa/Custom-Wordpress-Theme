<h3><?php the_title(); ?></h3>
<div><?php the_post_thumbnail('thumbnail'); ?></div>
<small>Posted on: <?php the_time('F j Y'); ?></small><br>
<a  class="btn btn-primary" href="<?php echo esc_url(get_permalink()); ?>">go to post</a>
<div><?php the_content(); ?></div>
<hr>