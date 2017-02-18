<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Navbar</a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <?php
    wp_nav_menu( array(
      'theme_location'		=> 'navbar',
      'container'         => false,
      'menu_class'				=> 'nav nav-pills',
      'fallback_cb'				=> '__return_false',
      'items_wrap'				=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
      'depth'							=> 2,
      'walker'            => new \Project\B4stWalkerNavMenu(),
    ) );
    ?>
    <?php get_template_part('navbar-search'); ?>
  </div>
</nav>
