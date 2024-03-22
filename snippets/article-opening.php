<?php 
  $thumb = get_the_post_thumbnail_url(); 
  $id = get_the_ID();
?>
<div id="article-opening" class="spacing-t-4">
  <div class="article-cover full-width" style="background-image: url('<?= $thumb; ?>');"></div>

  <?php include('snippets/article-metadata.php'); ?>

   <?php 
    $mainTag = get_the_terms( $id, 'main_tag' ); 
    $cat = get_the_category($id); 
  ?>
    <div class="article-tags t-center">
      <p class="s-xsmall uppercase tag label"><?= $cat[0]->name; ?>: <?= $mainTag[0]->name; ?></p>
    </div>
</div>