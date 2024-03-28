<?php get_header(); ?>

<section class="content" id="content-servizi">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <?php include('snippets/hero-title.php'); ?>

        <div class="d-flex flex-row spacing-t-4 reveal-module">
          <div class="d-whole">
            <div class="wysiwyg s-large light">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <?php include('snippets/benefit-list.php'); ?>

        <div class="d-flex flex-row spacing-t-8">
          <div class="d-whole t-center">
            <h2 class="serif italic s-medium uppercase"><?php _e("I nostri servizi", 'thats-theme'); ?></h2>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <?php if( have_rows('services_row') ): ?>
          <div id="services-section" class="flex-row d-flex wrap spacing-t-4 reveal-module">
            <?php while( have_rows('services_row') ) : the_row(); 
              $block1 = get_sub_field('text_block_1');
              $block2 = get_sub_field('text_block_2');
              $img1 = get_sub_field('image_1');
              $img2 = get_sub_field('image_2');
              ?>
              <div class="services-box d-three-twelfth t-half m-whole d-flex d-column space-between reveal-child" style="background-color: <?= $block1['block_color']; ?>">
                <h2 class="uppercase s-large light"><?= $block1['service_title']; ?></h2>
                <div class="wysiwyg s-small"><?= $block1['service_text']; ?></div>
              </div>
              <div class="services-box image-box d-three-twelfth t-half m-whole reveal-child" style="background-image: url('<?= $img1['url']; ?>')">
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="container">
        <div id="help-section" class="spacing-t-8 spacing-p-t-2 border-top d-flex flex-row m-column">
          <?php $help = get_field('help_row'); ?>

          <div class="d-five-twelfth t-half m-whole">
            <div class="dot-before"><h3 class="s-large light uppercase"><?= $help['help_text']; ?></h3></div>
          </div>
          <div class="d-five-twelfth t-hidden"></div>

          <div class="d-two-twelfth"><a href="mailto:<?= $help['help_contact']; ?>" class="button" role="button"><?php _e("Contattaci", 'thats-theme'); ?></a></div>
        </div>
      </div>

    </div>  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>