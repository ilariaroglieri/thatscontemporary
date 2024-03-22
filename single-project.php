<?php get_header(); ?>

<section class="content" id="content-single-project">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container spacing-b-4">
        <div class="subtitle t-center">
          <p class="s-medium uppercase serif italic"><?php _e("Progetti", 'thats-theme'); ?></p>
        </div>
      </div>

      <div class="container-fluid">
        <?php include('snippets/article-metadata.php'); ?>
      </div>
    </div>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php include('snippets/related.php'); ?>

<?php get_footer(); ?>