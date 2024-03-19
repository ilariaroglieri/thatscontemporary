<?php $thumb = get_the_post_thumbnail_url(); ?>
<div id="article-opening" class="spacing-t-4">
  <div class="article-cover full-width" style="background-image: url('<?= $thumb; ?>');"></div>

  <div class="article-metadata d-flex">
    <p class="s-xsmall light"><?= get_the_date( 'd M Y' ); ?></p>
    <p class="s-xsmall light"><?php the_field('article_author'); ?></p>
  </div>

   <?php $mainTag = get_the_terms( $post->ID, 'main_tag' ); ?>
    <div class="article-tags t-center">
      <p class="s-xsmall uppercase tag label"><?= $mainTag[0]->name; ?> </p>
    </div>
</div>