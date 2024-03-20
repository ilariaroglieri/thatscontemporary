<div id="post-<?php the_ID(); ?>" class="article-container d-one-third m-whole d-flex d-column spacing-b-2 reveal-module">
  <?php $thumb = get_the_post_thumbnail_url(); ?>
  <div class="dot-link">
    <a class="p-absolute overall" href="<?= the_permalink(); ?>"></a>
    <div class="article-img reveal-child" style="background-image: url('<?= $thumb; ?>');">
    </div>
    <h4 class="s-large uppercase light spacing-t-1 reveal-child"><?php the_title(); ?></h4>
  </div>
</div>