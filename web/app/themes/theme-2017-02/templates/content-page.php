<?php //the_content(); ?>
<?php //wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

<?php
echo (new \fewbricks\bricks\content_1('page_content'))->get_html();
