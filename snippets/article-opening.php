<?php 
  $thumb = get_the_post_thumbnail_url(); 
  $id = get_the_ID();
?>
<div id="article-opening" class="spacing-t-4">
  <div class="article-cover full-width" style="background-image: url('<?= $thumb; ?>');"></div>

  <div class="article-metadata d-flex">
    <p class="s-xsmall light"><?= get_the_date( 'd M Y' ); ?></p>
    <p class="s-xsmall light"><?php the_field('article_author'); ?></p>
  </div>

   <?php 
    $mainTag = get_the_terms( $id, 'main_tag' ); 
    $cat = get_the_category($id); 
  ?>
    <div class="article-tags t-center">
      <p class="s-xsmall uppercase tag label"><?= $cat[0]->name; ?>: <?= $mainTag[0]->name; ?></p>
    </div>
</div>