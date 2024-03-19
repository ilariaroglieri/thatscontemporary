<?php $subtitle = get_field('article_subtitle'); ?>
<div id="article-header" class="spacing-t-4 reveal-module">
  <!-- title -->
  <div class="d-flex flex-row t-column">
    <div class="d-five-twelfth t-whole reveal-child">
      <h1 class="s-big light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>
    </div>

    <!-- intro text -->
    <div class="d-two-twelfth t-hidden"></div>
    <div class="d-five-twelfth t-whole reveal-child">
      <div class="wysiwyg s-small light">
        <?php the_content() ?>
      </div>

      <div class="dot-link d-none">
        <a class="p-absolute overall" href="<?= the_permalink(); ?>"></a>
      </div>
    </div>
  </div>
</div>