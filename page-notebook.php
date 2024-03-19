<?php get_header(); ?>

<section class="content" id="content-notebook">
  <div id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>

    <?php include('snippets/hero-title.php'); ?>

    <div class="flex-row d-flex spacing-t-2 spacing-b-2 t-center">
      <div class="d-three-twelfth t-hidden"></div>
      <div class="d-half t-whole">
        <div class="wysiwyg s-xsmall">
          <?php the_content(); ?>
        </div>
      </div>
      <div class="d-three-twelfth t-hidden"></div>
    </div>

    <?php $args = array(
      'posts_per_page' => 1,
      'offset' => 0,
      'orderby' => 'date',
      'order' => 'ASC',
      'post_type' => 'post',
      'post_status' => 'publish',
      'suppress_filters' => true 
    );

    $mostRecentPost = new WP_Query( $args ); 
    if ( $mostRecentPost->have_posts() ) : while ( $mostRecentPost->have_posts() ) : $mostRecentPost->the_post(); ?>

      <?php include('snippets/article-opening.php'); ?>
      <?php include('snippets/article-header.php'); ?>
      
    <?php endwhile; endif;
    wp_reset_postdata(); ?>


    <!-- FILTERS HERE -->

    <?php $args = array(
      'posts_per_page' => -1,
      'offset' => 0,
      'orderby' => 'date',
      'order' => 'ASC',
      'post_type' => 'post',
      'post_status' => 'publish',
      'suppress_filters' => true 
    );

    $bigLoop = new WP_Query( $args ); 
    if ( $bigLoop->have_posts() ) : ?>
      <div id="articles-container" class="spacing-t-4">
        <div class="d-flex flex-row wrap">
          <?php while ( $bigLoop->have_posts() ) : $bigLoop->the_post(); ?>
            <div id="post-<?php the_ID(); ?>" class="article-container d-one-third m-whole d-flex d-column spacing-b-2 reveal-module">
              <?php $thumb = get_the_post_thumbnail_url(); ?>
              <div class="dot-link">
                <a class="p-absolute overall" href="<?= the_permalink(); ?>"></a>
                <div class="article-img reveal-child" style="background-image: url('<?= $thumb; ?>');">
                </div>
                <h4 class="s-large uppercase light spacing-t-1 reveal-child"><?php the_title(); ?></h4>
              </div>
            </div>
        
          <?php endwhile; ?>
        </div>
      </div>
    <?php endif; wp_reset_postdata(); ?>

  </div>  

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>