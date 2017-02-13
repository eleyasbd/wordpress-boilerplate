<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
use Wordpressboilerplate\Setup as wpbpsetup;

$is_fullwidth_page = wpbpsetup\is_fullwidth_page(get_the_ID());

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      get_template_part('templates/header');
    ?>

    <?php
    if(!$is_fullwidth_page) {
    ?>
    <div class="wrap container">
      <div class="content row">
    <?php
        }
    ?>
        <main class="main">

          <?php include Wrapper\template_path(); ?>

        </main><!-- /.main -->

        <?php if (Setup\display_sidebar()) { ?>
          <aside class="sidebar">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php } ?>

    <?php
    if(!$is_fullwidth_page) {
    ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
    }
    ?>
    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
