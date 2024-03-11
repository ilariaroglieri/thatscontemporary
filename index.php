<?php get_header(); ?>

<section class="content" id="content-generic">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class('container'); ?>>
      <div class="title border-top border-bottom spacing-p-t-4 t-center">
        <h1 class="s-xhuge uppercase serif italic"><?php the_title(); ?></h1>
      </div>
      
    </div>  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>