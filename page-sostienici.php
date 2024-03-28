<?php get_header(); ?>

<section class="content" id="content-sostienici">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        
        <?php include('snippets/hero-title.php'); ?>

        <?php while ( have_rows('sostienici_layout') ) : the_row(); ?>
          <?php if( get_row_layout() == 'text_row' ):
            $text = get_sub_field('text');
          ?>
            <div class="flex-row d-flex spacing-t-4 spacing-b-4 reveal-module">
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

            <div class="img-row flex-row d-flex wrap space-evenly spacing-t-4 spacing-b-4 reveal-module">

              <?php if( $images ): foreach( $images as $image ): ?>
                <div class="img-element d-flex d-column reveal-child">
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

      <div class="donations container border-top spacing-b-4 reveal-module">
        <div class="flex-row d-flex t-column spacing-p-t-2 spacing-p-b-2">
          <div class="d-five-twelfth t-whole reveal-child">
            <h2 class="donation-title s-large light uppercase d-flex center"><?= $singola['donazione_singola_-_titolo_sezione']; ?></h2>
          </div>

          <div class="donation-tab d-seven-twelfth t-whole reveal-child">
            <div class="donation-text baseline visible d-flex t-column" data-tab="paypal">
              <div class="d-two-thirds t-whole">
                <div class="wysiwyg s-small">
                  <?= $singola['testo_donazione_paypal']; ?>
                </div>
              </div>

              <div class="d-one-third t-whole">
                <a href="#" class="button" role="button">Dona qui</a>
              </div>
            </div>

            <div class="donation-text d-flex" data-tab="bonifico">
              <div class="d-whole">
                <div class="wysiwyg s-small">
                  <?= $singola['testo_donazione_bonifico']; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="border-top">
          <div class="d-flex">
            <div class="donation-button active d-half s-small t-center" data-tab="paypal">
              <h3 class="s-xsmall light uppercase"><?= $singola['titolo_donazione_paypal']; ?></h3>
            </div>
            <div class="donation-button d-half s-small t-center" data-tab="bonifico">
              <h3 class="s-xsmall light uppercase"><?= $singola['titolo_donazione_bonifico']; ?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="donations container border-top spacing-t-4 spacing-b-4 reveal-module">
        <div class="flex-row d-flex t-column spacing-p-t-2 spacing-p-b-2">
          <div class="d-five-twelfth t-whole reveal-child">
            <h2 class="donation-title s-large light uppercase d-flex center"><?= $partnership['titolo_donazione_partner']; ?></h2>
          </div>

          <div class="donation-tab d-seven-twelfth t-whole">
            <div class="donation-text baseline visible d-flex t-column">
              <div class="d-two-thirds t-whole reveal-child">
                <div class="wysiwyg s-small">
                  <?= $partnership['testo_donazione_partner']; ?>
                </div>
              </div>

              <div class="d-one-third t-whole">
                <a href="mailto:amministrazione@thatscontemporary.com" class="button" role="button"><?php _e("Contattaci qui", 'thats-theme'); ?></a>
              </div>
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