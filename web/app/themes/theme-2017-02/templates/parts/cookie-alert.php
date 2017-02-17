<div id="cookie-alert" style="background: red">
  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <div class="wpboilerplate-cookie-alert__text-wrapper">
          <?php echo get_field('cookie_alert_text', 'options'); ?>
        </div>

        <noscript><p><?php echo get_field('cookie_alert_no_js_text', 'options'); ?></p></noscript>

      </div>

      <div class="col-sm-4 wpboilerplate-cookie-alert__button-wrapper">

        <a href="#" class="btn btn-primary wpboilerplate-cookie-alert__button" id="cookie-alert-hide-trigger"><?php echo get_field('cookie_alert_agree_button_text', 'options'); ?></a>

      </div>
    </div>
  </div>
</div>
