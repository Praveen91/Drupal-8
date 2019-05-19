
  <div class="form-row">
    <div class="col">
      <?php print drupal_render($form['registered_email']); ?>
    </div>
    <div class="col">
      <?php print drupal_render($form['create_password']); ?>
    </div>
    <div class="col">
      <?php print drupal_render($form['confirm_password']); ?>
    </div>
    <div class="col">
      <?php print drupal_render($form['submit']); ?>
    </div>
  </div>


<?php print drupal_render_children($form); ?> 
