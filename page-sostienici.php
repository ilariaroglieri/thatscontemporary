<?php get_header(); ?>

<section class="content" id="content-generic">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="title border-top border-bottom spacing-p-t-4 t-center">
          <h1 class="s-xhuge uppercase serif italic"><?php the_title(); ?></h1>
        </div>

        <?php while ( have_rows('sostienici_layout') ) : the_row(); ?>
          <?php if( get_row_layout() == 'text_row' ):
            $text = get_sub_field('text');
          ?>
            <div class="flex-row d-flex spacing-t-4 spacing-b-4">
              <div class="d-two-twelfth t-hidden"></div>

              <div class="d-eight-twelfth t-whole">
                <div class="wysiwyg s-small">
                  <?= $text ;?>
                </div>
              </div>

              <div class="d-two-twelfth t-hidden"></div>
            </div>


          <?php elseif( get_row_layout() == 'image_row' ): 
            $images = get_sub_field('images'); ?>

            <div class="flex-row d-flex space-evenly spacing-t-4 spacing-b-4">

              <?php if( $images ): foreach( $images as $image ): ?>
                <div class="d-flex d-column">
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  <p class="spacing-t-1 uppercase s-xxsmall reg"><?php echo esc_html($image['caption']); ?></p>
                </div>
              <?php endforeach; endif; ?>

            </div>

          <?php endif; ?>
        <?php endwhile; ?>
      </div>

      <!-- donazioni -->
      <?php
        $singola = get_field('donazione_singola');
        $partnership = get_field('donazione_partnership');
      ?>

      <div class="donations container border-top spacing-b-4">
        <div class="flex-row d-flex spacing-p-t-2 spacing-p-b-2">
          <div class="d-five-twelfth t-whole">
            <h2 class="s-large uppercase"><?= $singola['donazione_singola_-_titolo_sezione']; ?></h2>
          </div>

          <div class="donation-tab d-seven-twelfth t-whole">
            <div class="donation-text visible d-flex">
              <div class="wysiwyg s-small">
                <?= $singola['testo_donazione_paypal']; ?>
              </div>

              <button>Dona qui</button>
            </div>

            <div class="donation-text">
              <div class="wysiwyg s-small">
                <?= $singola['testo_donazione_bonifico']; ?>
              </div>
            </div>
          </div>
        </div>

        <div class="border-top">
          <div class="flex-row d-flex">
            <div class="donation-button active d-half s-small t-center">
              <h3 class="uppercase"><?= $singola['titolo_donazione_paypal']; ?></h3>
            </div>
            <div class="donation-button d-half s-small t-center">
              <h3 class="uppercase"><?= $singola['titolo_donazione_bonifico']; ?></h3>
            </div>
          </div>
        </div>
      </div>

    </div>  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>