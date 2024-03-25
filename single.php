<?php get_header(); ?>

<section class="content" id="content-single-reading">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="subtitle t-center">
          <p class="s-medium uppercase serif italic"><?php _e("Notebook", 'thats-theme'); ?></p>
        </div>

        <?php include('snippets/article-opening.php'); ?>

        <div id="article-header" class="spacing-t-4">
          <!-- title -->
          <div class="d-flex flex-row t-column">
            <div class="d-two-thirds t-whole">
              <?php $subtitle = get_field('article_subtitle'); ?>
              <h1 class="s-big light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>
            </div>
          </div>

          <!-- intro text -->
          <div class="d-flex flex-row">
            <div class="d-one-twelfth t-hidden"></div>
            <div class="d-seven-twelfth t-whole spacing-t-8">
              <div class="wysiwyg s-medium light underline">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- modules -->
      <?php if( have_rows('article_modules') ): ?>
        <div id="article-content" class="modules">

          <?php while ( have_rows('article_modules') ) : the_row(); ?>

            <!-- text module -->
            <?php if( get_row_layout() == 'text' ):
              $text = get_sub_field('text');
              $title = get_sub_field('title');
            ?>
              <div class="reveal-module text-container container spacing-t-4">
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

              <div class="reveal-module text-container container spacing-t-4">
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
                <div class="reveal-module container spacing-t-4">
                  <div class="d-flex flex-row m-column-reverse">
                    <div class="d-two-twelfth m-whole">
                      <p class="label uppercase light s-xxsmall"><?php _e("In foto", 'thats-theme'); ?></p>

                      <?php if ($caption): ?>
                        <p class="light s-xxsmall reveal-child"><?= $caption; ?></p>
                      <?php endif; ?>
                    </div>

                    <div class="d-one-twelfth t-hidden"></div>

                    <div class="d-nine-twelfth t-ten-twelfth m-whole reveal-child">
                      <img src="<?= $img['url']; ?>" />
                    </div>
                  </div>
                </div>

              <?php elseif ($count == 2): ?>

                <div class="reveal-module two-img-container container spacing-t-4">
                  <div class="d-flex flex-row m-column-reverse">
                    <div class="d-two-twelfth m-whole">
                      <p class="label uppercase light s-xxsmall"><?php _e("In foto", 'thats-theme'); ?></p>

                      <?php foreach( $images as $i => $image ): ?>
                        <?php $caption = $image['caption']; ?>

                        <?php if ($caption): ?>
                          <p class="light s-xxsmall reveal-child"><?= $caption; ?></p>
                        <?php endif; ?>

                      <?php endforeach; ?>
                    </div>

                    <div class="d-one-twelfth t-hidden"></div>

                    <div class="d-eight-twelfth t-ten-twelfth m-whole">
                      <div class="d-flex flex-row">
                        <?php foreach( $images as $i => $image ): ?>
                          <div class="vertical reveal-child" style="background-image: url('<?= $image['url']; ?>');">
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                    
                    <div class="d-one-twelfth t-hidden"></div>
                  </div>
                </div>

              <?php else: ?>

                <!-- slider module -->
                <div class="reveal-module slider-container container-fluid p-relative spacing-t-4">
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

                <div class="reveal-module caption-container container spacing-t-4">
                  <div class="d-flex flex-row">
                    <div class="d-two-twelfth">
                      <p class="label uppercase light s-xxsmall"><?php _e("In foto", 'thats-theme'); ?></p>
                    </div>
                  </div>

                  <div class="d-flex flex-row m-column spacing-t-2">
                    <?php foreach( $images as $i => $image ): ?>
                      <?php $caption = $image['caption']; ?>

                      <?php if ($caption): ?>
                        <div class="d-two-twelfth reveal-child">
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
      <?php include('snippets/bio-credits.php'); ?>
      
      <?php include('snippets/navi.php'); ?>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php include('snippets/related.php'); ?>

<?php get_footer(); ?>