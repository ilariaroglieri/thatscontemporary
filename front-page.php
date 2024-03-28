<?php get_header(); ?>


<section class="content" id="content-home">
  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>    
    <div class="container cta-container">
      <div class="d-flex flex-row home-row">
        <div class="d-two-twelfth t-hidden"></div>
        <div class="d-eight-twelfth t-whole d-flex d-column">
          <h1 class="s-medium uppercase serif italic t-center"><?= the_field('big_text'); ?></h1>

          <?php include('snippets/stackedgallery.php'); ?>

          <div class="s-xsmall wysiwyg t-center light spacing-t-4 spacing-b-4"><?= the_field('smaller_text'); ?></div>
        </div>
        <div class="d-two-twelfth t-hidden"></div>
      </div>

      <!-- cta -->
      <?php if( have_rows('home_cta') ): while ( have_rows('home_cta') ) : the_row();

        if( get_row_layout() == 'cta_to_site_section' ):
          $text = get_sub_field('text');
          $img = get_sub_field('section_image');
          $page = get_sub_field('site_section');
          if( $page ): 
            $post = $page;
            setup_postdata($post); ?>

            <div class="home-row d-flex d-column p-relative">
              <a class="p-absolute overall" href="<?= the_permalink(); ?>"></a>
              <div class="flex-row">
                <?php include('snippets/hero-title.php'); ?>
              </div>

              <div class="d-flex flex-row">
                <div class="d-two-twelfth t-hidden"></div>
                <div class="d-eight-twelfth t-whole">
                  <div class="s-xsmall wysiwyg t-center light spacing-t-2 spacing-b-2"><?= $text; ?></div>
                </div>
                <div class="d-two-twelfth t-hidden"></div>
              </div>

              <div class="d-flex flex-row grow">
                <div class="d-one-twelfth t-hidden"></div>
                <div class="img d-ten-twelfth t-whole spacing-b-2" style="background-image: url(<?= $img['url']; ?>)">
                </div>
                <div class="d-one-twelfth t-hidden"></div>
              </div>
            </div>

          <?php wp_reset_postdata(); endif; ?>

        <?php elseif( get_row_layout() == 'download' ): 
            $file = get_sub_field('file');
            // Do something...

        endif; ?>

      <?php endwhile; endif; ?>
    </div>
    
  </div>  

</section>


<?php get_footer(); ?>