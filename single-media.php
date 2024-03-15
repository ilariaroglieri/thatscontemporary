/*
Template Name: Media
Template Post Type: post
*/

<?php get_header(); ?>

<section class="content" id="content-single-media">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <!-- opening image -->
      <?php $thumb = get_the_post_thumbnail_url(); ?>
      <div class="background-container container-fluid p-fixed full-width full-height" style="background-image: url('<?= $thumb; ?>');"></div>

      <!-- content -->
      <div id="article-opening">
        <?php $mainTag = get_the_terms( $post->ID, 'main_tag' ); ?>
        <div class="article-tags t-center">
          <p class="s-xsmall uppercase tag label"><?= $mainTag[0]->name; ?> </p>
        </div>

        <div class="article-metadata d-flex">
          <p class="s-xsmall light"><?= get_the_date( 'd M Y' ); ?></p>
          <p class="s-xsmall light"><?php the_field('article_author'); ?></p>
        </div>
      </div>

      <div id="article-contents" class="spacing-t-4" >

        <?php $subtitle = get_field('article_subtitle'); ?>
        <div id="article-header">
          <!-- title -->
          <div class="d-flex flex-row">
            <div class="d-whole">
              <h1 class="s-huge light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>
            </div>
          </div>

          <!-- intro text -->
          <div class="d-flex flex-row">
            <div class="d-whole spacing-t-8">
              <div class="wysiwyg s-regular light">
                <?php the_content() ?>
              </div>
            </div>
          </div>
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