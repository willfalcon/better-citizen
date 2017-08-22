<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="row">
    <div class="col-12">
      <h2 class="text-center"><?php echo strip_tags( get_the_title() ); ?></h2>
    </div>
  </div>
  <?php the_content(); ?>

<?php endwhile; else : ?>

  <p><?php _e( 'Strange, no page was found.' ); ?></p>

<?php endif; ?>

<?php get_footer(); ?>
