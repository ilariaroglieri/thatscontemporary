<?php get_header(); ?>

<section class="content" id="content-archive-articles">
  <div id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>

    <?php include('snippets/hero-title.php'); ?>
    
  </div>  

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>