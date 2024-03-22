/*
Template Name: Media
Template Post Type: post
*/

<?php get_header(); ?>

<section class="content" id="content-single-media">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <!-- opening image -->
      <?php $thumb = get_the_post_thumbnail_url(); ?>
      <div class="background-container container-fluid p-fixed full-width full-height" style="background-image: url('<?= $thumb; ?>');"></div>

      <!-- content -->
      <div id="article-opening">
        <?php 
          $mainTag = get_the_terms( $post->ID, 'main_tag' ); 
          $cat = get_the_category($id); ?>
        <div class="article-tags t-center">
          <p class="s-xsmall uppercase tag label"><?= $cat[0]->name; ?>: <?= $mainTag[0]->name; ?></p>
        </div>

        <?php include('snippets/article-metadata.php'); ?>
      </div>

      <div id="article-contents" class="spacing-t-4" >

        <?php $subtitle = get_field('article_subtitle'); ?>
        <div id="article-header">
          <!-- title -->
          <div class="d-flex flex-row">
            <div class="d-whole">
              <h1 class="s-huge light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>
            </div>
          </div>

          <!-- intro text -->
          <div class="d-flex flex-row">
            <div class="d-whole spacing-t-8">
              <div class="wysiwyg s-regular light">
                <?php the_content(); ?>
              </div>
              <div class="wysiwyg s-small light underlined spacing-t-2">
                <?php 
                  $posttags = get_the_tags(); 
                  echo '#'. $mainTag[0]->name;
                  if ($posttags) {
                    foreach($posttags as $tag) {
                      echo ' #' . $tag->name; 
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </div>

        <?php if( have_rows('article_modules') ): ?>
          <div id="article-content" class="modules">

            <?php while ( have_rows('article_modules') ) : the_row(); ?>

              <!-- quote module -->
              <?php if( get_row_layout() == 'quote' ): ?>

                <div class="reveal-module text-container spacing-t-4">
                  <div class="d-flex flex-row">

                    <div class="d-whole">
                      <div class="wysiwyg s-big light">
                        <?php the_sub_field('quote_text') ?>
                      </div>
                    </div>

                  </div>
                </div>

              <!-- imgs module -->
              <?php elseif( get_row_layout() == 'images' ): 
                $images = get_sub_field('images'); 
                ?>

                <?php foreach( $images as $i => $img ): ?>
                  <div class="reveal-module  img-container spacing-t-4">
                    <div class="d-flex flex-row">
                      <div class="d-whole">
                        <img src="<?= $img['url']; ?>" />
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

              <?php elseif( get_row_layout() == 'bio_data' ): 
                $text = get_sub_field('bio_text'); ?>

                <div class="reveal-module info-container spacing-t-4">
                  <div class="d-flex flex-row m-column">
                    <div class="d-half m-whole reveal-child ">
                      <p class="label short uppercase light s-xxsmall">Bio dell'autore</p>

                      <div class="wywiwyg s-xxsmall spacing-t-1">
                        <?= $text; ?>
                      </div>
                    </div>

                    <?php if( have_rows('artwork_data') ): ?>
                      <div class="d-half m-whole reveal-child ">
                        <p class="label short uppercase light s-xxsmall">Scheda dell'opera</p>

                        <?php while( have_rows('artwork_data') ): the_row();
                          $label = get_sub_field('etichetta');
                          $adata = get_sub_field('art_data');
                        ?>
                          <div class="d-flex flex-row m-column spacing-t-1">
                            <div class="d-half m-whole">
                              <p class="s-xxsmall uppercase underline"><?= $label; ?></p>
                            </div>
                            <div class="d-half m-whole">
                              <p class="s-xxsmall"><?= $adata; ?></p>
                            </div>
                          </div>
                        <?php endwhile; ?>

                        <a href="mailto:amministrazione@thatscontemporary.com" class="button spacing-t-2" role="button"><?php _e("Inquiry", 'thats-theme'); ?></a>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
               
              <?php endif; ?>

            <?php endwhile; ?>
          </div>
        <?php endif; ?>

        <!-- navi -->
        <?php
          $circular_prev = get_previous_post() ? get_previous_post() : get_posts("post_type=" . get_query_var( 'post_type' ) . "&numberposts=1&order=DESC")[0];
          $circular_next = get_next_post() ? get_next_post() : get_posts( "post_type=" . get_query_var( 'post_type' ) . "&numberposts=1&order=ASC")[0];
        ?>
        <div class="navi d-flex d-column border-top spacing-t-4 spacing-p-t-3 spacing-b-4 reveal-module">
          <div class="full-width d-whole d-flex flex-row end reveal-child">
            <div class="dot-link previous d-half m-whole">
              <a class="s-large uppercase light" href="<?= get_permalink($circular_next->ID); ?>"><span class="underline"><?= $circular_next->post_title; ?></span></a>
            </div>
          </div>
          <div class="full-width d-whole d-flex flex-row start spacing-t-4 reveal-child">
            <div class="dot-link next d-half m-whole">
              <a class="s-large uppercase light" href="<?= get_permalink($circular_prev->ID); ?>"><span class="underline"><?= $circular_prev->post_title; ?></span></a>
            </div>
          </div>
        </div>
      </div>

    </article>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>


<?php get_footer(); ?>