<?php get_header(); ?>

<section class="content" id="content-single-project">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div id="project-header" class="container spacing-b-4">
        <div class="subtitle t-center">
          <p class="s-medium uppercase serif italic"><?php _e("Progetti", 'thats-theme'); ?></p>
        </div>
      </div>

      <div class="container-fluid">
        <?php include('snippets/article-metadata.php'); ?>
      </div>

      <div id="project-contents" class="container-fluid">
        <div class="d-flex flex-row m-column">
          <?php
            $smalltxt = get_field('smaller_text');
          ?>

          <div class="d-five-twelfth t-half m-whole project-txts">
            <div id="project-txt" class="spacing-t-4">
              <?php $subtitle = get_field('article_subtitle'); ?>
              <h1 class="s-big light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>

              <div class="wysiwyg light s-medium spacing-p-b-4 spacing-b-4 border-bottom">
                <?php the_content(); ?>
              </div>
            </div>

            <?php if ($smalltxt): ?>
              <div class="wysiwyg light s-xsmall spacing-p-b-4 spacing-b-4 border-bottom">
                <?php the_field('smaller_text'); ?>
              </div>
            <?php endif; ?>

            <!-- bio credits -->
            <?php if( have_rows('bio_credits') ): ?>
              <?php while( have_rows('bio_credits') ) : the_row();
                $title = get_sub_field('module_title'); 
                $text = get_sub_field('module_text');
              ?>

              <div class="spacing-b-4">
                <p class="label short uppercase light s-xxsmall"><?= $title; ?></p>

                <div class="wywiwyg s-xxsmall spacing-t-1">
                  <?= $text; ?>
                </div>
              </div>

              <?php endwhile; ?>
            <?php endif; ?>
          </div>

          <div class="d-seven-twelfth t-half m-whole overflow sticky">
            <?php $images = get_field('images_gallery'); ?>

            <?php foreach( $images as $i => $img ): 
              list($width, $height) = getimagesize($img['url']);
              $orientation = ($width > $height) ? 'horizontal' : 'vertical';
              ?>
              <div class="img-container spacing-b-1 <?= $orientation; ?>" style="background-image: url(<?= $img['url']; ?>)">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php include('snippets/related.php'); ?>

<?php get_footer(); ?>