<?php get_header(); ?>

<section class="content" id="content-single-reading">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="subtitle t-center">
          <p class="s-medium uppercase serif italic">Notebook</p>
        </div>

        <!-- opening image -->
        <?php $thumb = get_the_post_thumbnail_url(); ?>
        <div id="article-opening" class="spacing-t-4" >
          <div class="article-cover full-width" style="background-image: url('<?= $thumb; ?>');"></div>

          <div class="article-metadata d-flex">
            <p class="s-xsmall light"><?= get_the_date( 'd M Y' ); ?></p>
            <p class="s-xsmall light">Giulia Restifo</p>
          </div>
        </div>

    </article>

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<div class="navigation">
  <div class="navi previous"><?php previous_post_link( '%link','⟵', false ); ?></div>
  <div class="navi next"><?php next_post_link( '%link','⟶', false ); ?></div>
</div>

<?php get_footer(); ?>