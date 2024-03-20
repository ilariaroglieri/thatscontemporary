<?php get_header(); ?>

<section class="content" id="content-club">
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

        <?php if( have_rows('club_benefits') ): ?>
          <div id="benefits" class="p-relative spacing-t-8 reveal-module">
            <?php while( have_rows('club_benefits') ): the_row();
              $title = get_sub_field('benefit_title');
              $text = get_sub_field('benefit_text');
              $img = get_sub_field('benefit_image');
            ?>

            <div class="single-benefit d-flex flex-row m-column reveal-child">
              <div class="d-half t-whole">
                <h2 class="dot-before benefit-title uppercase s-large light color-hover spacing-b-2"><?= $title; ?></h2>
              </div>
              <div class="benefit-content d-flex flex-row">
                <div class="d-half t-whole">
                  <div class="wysiwyg serif s-small color3">
                    <?= $text; ?>
                  </div>
                </div>
                <div class="d-half t-whole">
                  <div class="benefit-img-container">
                    <img src="<?= $img['url']; ?>" />
                  </div>
                </div>
              </div>
            </div>

            <?php endwhile; ?>
          </div>
        <?php endif; ?>

      </div>

    

    </div>  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>