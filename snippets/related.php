 <!-- related -->


<?php $related = get_field('related_articles');
if( $related ): ?>
  <div id="related" class="container-fluid">
    <div class="container spacing-p-b-4">
      <div class="spacing-p-t-3 spacing-b-1"><p class="medium uppercase s-xsmall"><?php _e("Articoli correlati", 'thats-theme'); ?></p></div>

      <div class="d-flex flex-row wrap">
        <?php foreach( $related as $post ): setup_postdata($post); ?>
          <div class="related-container d-one-third m-whole d-flex d-column spacing-b-2 reveal-module">
            <?php $thumb = get_the_post_thumbnail_url(); ?>
            <div class="dot-link">
              <a class="p-absolute overall" href="<?= the_permalink(); ?>"></a>
              <div class="article-img reveal-child" style="background-image: url('<?= $thumb; ?>');">
              </div>
              <h4 class="s-large uppercase light spacing-t-1 reveal-child"><?php the_title(); ?></h4>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
<?php wp_reset_postdata(); endif; ?>
