 <!-- related -->


<?php $related = get_field('related_articles');
if( $related ): ?>
  <div id="related" class="container-fluid">
    <div class="container spacing-p-b-4">
      <div class="spacing-p-t-3 spacing-b-1"><p class="medium uppercase s-xsmall"><?php _e("Articoli correlati", 'thats-theme'); ?></p></div>

      <div class="d-flex flex-row wrap">
        <?php foreach( $related as $i => $post ): setup_postdata($post); 
          if (!($i > 2)): 
          ?>
          <div class="related-container d-one-third m-whole d-flex d-column spacing-b-2 reveal-module">
            <?php include('project-item.php'); ?>
          </div>
        <?php endif; endforeach; ?>
      </div>
    </div>
  </div>
<?php wp_reset_postdata(); endif; ?>
