<?php get_header(); ?>

<section class="content" id="content-single-reading">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="subtitle t-center">
          <p class="s-medium uppercase serif italic">Notebook</p>
        </div>

        <!-- opening image -->
        <?php $thumb = get_the_post_thumbnail_url(); ?>
        <div id="article-opening" class="spacing-t-4" >
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


        <!-- modules -->
        <?php $subtitle = get_field('article_subtitle'); ?>
        <div id="article-header" class="spacing-t-4">
          <!-- title -->
          <div class="d-flex flex-row">
            <div class="d-two-thirds t-whole">
              <h1 class="s-big light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>
            </div>
          </div>

          <!-- intro text -->
          <div class="d-flex flex-row">
            <div class="d-one-twelfth t-hidden"></div>
            <div class="d-seven-twelfth t-whole spacing-t-8">
              <div class="wysiwyg s-medium light underline">
                <?php the_content() ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php if( have_rows('article_modules') ): ?>
        <div id="article-content" class="modules">

          <?php while ( have_rows('article_modules') ) : the_row(); ?>

            <!-- text module -->
            <?php if( get_row_layout() == 'text' ):
              $text = get_sub_field('text');
              $title = get_sub_field('title');
            ?>
              <div class="text-container container spacing-t-4">
                <div class="d-flex flex-row">

                  <div class="d-two-thirds t-whole">
                    <?php if ($title): ?><h2 class="medium uppercase s-xsmall spacing-b-2"><?= $title; ?></h2><?php endif; ?>
                    <div class="wysiwyg serif s-regular">
                      <?= $text; ?>
                    </div>
                  </div>
                </div>
              </div>

            <?php elseif( get_row_layout() == 'quote' ): ?>

              <div class="text-container container spacing-t-4">
                <div class="d-flex flex-row">

                  <div class="d-one-twelfth t-hidden"></div>
                  <div class="d-seven-twelfth t-whole">
                    <div class="wysiwyg s-big uppercase light">
                      <?php the_sub_field('quote_text') ?>
                    </div>
                  </div>

                </div>
              </div>

            <?php elseif( get_row_layout() == 'images' ): 
              $images = get_sub_field('images'); 
              $count = count($images);
              ?>

              <?php if ($count == 1): ?>
                <?php 
                  $img = $images[0];
                  $caption = $img['caption']; 
                ?>
                <div class="container spacing-t-4">
                  <div class="d-flex flex-row m-column-reverse">
                    <div class="d-two-twelfth m-whole">
                      <p class="label uppercase light s-xxsmall"><?php _e("In foto", 'thats-theme'); ?></p>

                      <?php if ($caption): ?>
                        <p class="light s-xxsmall"><?= $caption; ?></p>
                      <?php endif; ?>
                    </div>

                    <div class="d-one-twelfth t-hidden"></div>

                    <div class="d-nine-twelfth t-ten-twelfth m-whole">
                      <img src="<?= $img['url']; ?>" />
                    </div>
                  </div>
                </div>

              <?php elseif ($count == 2): ?>

                <div class="two-img-container container spacing-t-4">
                  <div class="d-flex flex-row m-column-reverse">
                    <div class="d-two-twelfth m-whole">
                      <p class="label uppercase light s-xxsmall"><?php _e("In foto", 'thats-theme'); ?></p>

                      <?php foreach( $images as $i => $image ): ?>
                        <?php $caption = $image['caption']; ?>

                        <?php if ($caption): ?>
                          <p class="light s-xxsmall"><?= $caption; ?></p>
                        <?php endif; ?>

                      <?php endforeach; ?>
                    </div>

                    <div class="d-one-twelfth t-hidden"></div>

                    <div class="d-eight-twelfth t-ten-twelfth m-whole">
                      <div class="d-flex flex-row">
                        <?php foreach( $images as $i => $image ): ?>
                          <div class="vertical" style="background-image: url('<?= $image['url']; ?>');">
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                    
                    <div class="d-one-twelfth t-hidden"></div>
                  </div>
                </div>

              <?php else: ?>

                <!-- slider module -->
                <div class="slider-container container-fluid p-relative spacing-t-4">
                  <div class="swiper">
                    <div class="swiper-wrapper">
                      <?php foreach( $images as $i => $image ): ?>
                        <div class="swiper-slide">
                          <img src="<?= $image['url']; ?>" />
                          <p class="s-xxsmall"><?= ($i+1).'/'.$count; ?></p>
                        </div>
                      <?php endforeach; ?>

                    </div>
                  </div>
                </div>

                <div class="caption-container container spacing-t-4">
                  <div class="d-flex flex-row">
                    <div class="d-two-twelfth">
                      <p class="label uppercase light s-xxsmall"><?php _e("In foto", 'thats-theme'); ?></p>
                    </div>
                  </div>

                  <div class="d-flex flex-row m-column spacing-t-2">
                    <?php foreach( $images as $i => $image ): ?>
                      <?php $caption = $image['caption']; ?>

                      <?php if ($caption): ?>
                        <div class="d-two-twelfth">
                          <p class="light s-xxsmall"><?= ($i+1).'. '.$caption; ?></p>
                        </div>
                      <?php endif; ?>

                    <?php endforeach; ?>
                  </div>
                </div>

              <?php endif; ?>
            <?php endif; ?>

          <?php endwhile; ?>
        </div>
      <?php endif; ?>


      <!-- article footer -->
      <?php if( have_rows('bio_credits') ): ?>
        <div id="article-footer" class="container spacing-t-4">
          <div class="d-flex flex-row t-column">
            <?php while( have_rows('bio_credits') ) : the_row();
              $title = get_sub_field('module_title'); 
              $text = get_sub_field('module_text');
              $img = get_sub_field('module_image');
            ?>

            <div class="d-three-twelfth t-whole">
              <p class="label uppercase light s-xxsmall"><?= $title; ?></p>

              <div class="wywiwyg s-xxsmall spacing-t-1">
                <?= $text; ?>
              </div>

              <?php if ($img): ?>
                <img class="spacing-t-2" src="<?= $img['url']; ?>" />
              <?php endif; ?>
            </div>

            <?php endwhile; ?>
          </div>
        </div>
      <?php endif; ?>

      <!-- navi -->
      <?php include('navi.php'); ?>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>


<?php get_footer(); ?>