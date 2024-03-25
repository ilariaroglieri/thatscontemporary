<?php if( have_rows('bio_credits') ): ?>
  <div id="article-footer" class="container spacing-t-4">
    <div class="d-flex flex-row t-column">
      <?php while( have_rows('bio_credits') ) : the_row();
        $title = get_sub_field('module_title'); 
        $text = get_sub_field('module_text');
        $img = get_sub_field('module_image');
      ?>

      <div class="d-three-twelfth t-whole reveal-module">
        <p class="reveal-child label short uppercase light s-xxsmall"><?= $title; ?></p>

        <div class="reveal-child wywiwyg s-xxsmall spacing-t-1">
          <?= $text; ?>
        </div>

        <?php if ($img): ?>
          <img class="reveal-child spacing-t-2" src="<?= $img['url']; ?>" />
        <?php endif; ?>
      </div>

      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>