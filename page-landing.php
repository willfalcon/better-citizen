<?php /*
Template Name: Landing Page
*/ ?>

<?php get_header( 'landing' ); ?>

<?php
  $theme = get_field('first_row_theme');
  if ($theme == 'dark') {
    $headerClass = 'gc-landing-row-dark';
  } elseif ($theme == 'light') {
    $headerClass = 'gc-landing-row-light';
  }
   ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="gc-landing-row <?php echo $headerClass ?>">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center"><?php the_title() ?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
          <?php the_content(); ?>
      </div>
    </div>
  </div> <!--.gc-landing-row-->
</div> <!--.gc-first-bg-row-->


<?php endwhile; else : ?>

  <p><?php _e( 'Strange, no page was found.' ); ?></p>

<?php endif; ?>

<?php get_footer(); ?>
