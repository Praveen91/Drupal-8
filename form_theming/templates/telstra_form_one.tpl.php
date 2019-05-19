
  <div class="form-row">
    <div class="col">
      <?php print drupal_render($form['login_email']); ?>
    </div>
    <div class="col">
      <?php print drupal_render($form['login_password']); ?>
    </div>
    <div class="col">
      <?php print drupal_render($form['login_submit']); ?>
    </div>
  </div>


<?php print drupal_render_children($form); //die('one'); ?> 
