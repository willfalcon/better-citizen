<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>
    <div class="container-fluid">

      <nav class="navbar navbar-expand-md bg-dark gc-nav-dark">
        <h1 class="gc-nav-logo"><?php the_custom_logo(); ?></h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

              <?php

                $primary = array(
                  'container_class' => 'collapse navbar-collapse justify-content-center',
                  'container_id' => 'navbarNav',
                  'theme_location'  => 'primary-menu',
                  'menu_class'  => 'navbar-nav'
                );

                $secondary = array(
                  'container_class' => 'collapse navbar-collapse justify-content-end',
                  'container_id' => 'navbarNav',
                  'theme_location'  => 'secondary-menu',
                  'menu_class'  => 'navbar-nav'
                );
                wp_nav_menu( $primary );
                wp_nav_menu( $secondary );

              ?>
      </nav>
