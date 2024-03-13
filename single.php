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
        </div>


        <!-- modules -->
        <?php $subtitle = get_field('article_subtitle'); ?>
        <div id="article-header">

          <!-- title -->
          <div class="d-flex flex-row">
            <div class="d-two-thirds t-whole">
              <h1 class="s-big light uppercase"><?php the_title(); echo ' '.($subtitle); ?></h1>
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
            ?>
              <div class="text-container container spacing-t-4">
                <div class="d-flex flex-row">

                  <div class="d-two-thirds t-whole">
                    <div class="wysiwyg serif s-regular">
                      <?= $text; ?>
                    </div>
                  </div>
                </div>
              </div>

            <?php elseif( get_row_layout() == 'images' ): 
              $images = get_sub_field('images'); 
              $count = count($images);
              ?>

              <?php if ($count == 1):?>

              <?php elseif ($count == 2): ?>

              <?php else: ?>

                <!-- slider module -->
                <div class="slider-container container-fluid p-relative spacing-t-4">
                  <div class="swiper">
                    <div class="swiper-wrapper">
                      <?php foreach( $images as $i => $image ): ?>
                        <div class="swiper-slide">
                          <img src="<?= $image['url']; ?>" />
                        </div>
                      <?php endforeach; ?>

                    </div>
                  </div>
                </div>

              <?php endif; ?>
            <?php endif; ?>

          <?php endwhile; ?>
        </div>
      <?php endif; ?>

    </article>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<div class="navigation">
  <div class="navi previous"><?php previous_post_link( '%link','⟵', false ); ?></div>
  <div class="navi next"><?php next_post_link( '%link','⟶', false ); ?></div>
</div>

<?php get_footer(); ?>