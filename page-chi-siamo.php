<?php get_header(); ?>

<section class="content" id="content-chi-siamo">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="title border-top border-bottom spacing-p-t-4 t-center">
          <h1 class="s-xhuge uppercase serif italic"><?php the_title(); ?></h1>
        </div>

        <div class="flex-row d-flex m-column spacing-t-4 spacing-b-4">
          <div class="d-half m-whole d-flex d-column">
            <div class="wysiwyg s-large">
              <?php the_content(); ?>
            </div>

            <?php 
            $images = get_field('stacked_gallery'); 
            
            if( $images ): ?>
              <div class="stacked_gallery spacing-t-4">
                <?php foreach( $images as $i => $image ): ?>
                  <?php 
                    list($width, $height) = getimagesize($image['url']);
                    $orientation = ($width > $height) ? 'horizontal' : 'vertical';
                  ?>
                  <div class="stacked_img <?= $orientation; ?> <?php if ($i == 0):?>active<?php endif; ?>" >
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="d-half m-whole two-columns">
            <div class="wysiwyg s-small">
              <?= the_field('introduction_text'); ?>
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