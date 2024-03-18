/*
Template Name: Percorsi
Template Post Type: post
*/

<?php get_header(); ?>

<section class="content" id="content-single">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      
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
            <p class="s-xsmall light"><?php the_field('article_author'); ?></p>
          </div>

          <?php $mainTag = get_the_terms( $post->ID, 'main_tag' ); ?>
          <div class="article-tags t-center">
            <p class="s-xsmall uppercase tag label"><?= $mainTag[0]->name; ?> </p>
          </div>
        </div>

        <?php $subtitle = get_field('article_subtitle'); ?>
        <div id="article-header" class="spacing-t-4">
          <!-- title -->
          <div class="d-flex flex-row t-column">
            <div class="d-five-twelfth t-whole">
              <h1 class="s-big light uppercase"><?php the_title(); if ($subtitle): echo ' '.($subtitle); endif; ?></h1>
            </div>

            <!-- intro text -->
            <div class="d-two-twelfth t-hidden"></div>
            <div class="d-five-twelfth t-whole">
              <div class="wysiwyg s-small light">
                <?php the_content() ?>
              </div>
            </div>
          </div>
        </div>

        <!-- list of places -->
        <?php
          $featured_places = get_field('featured_places');
          if( $featured_places ): ?>
            <div id="article_feat_places" class="spacing-t-4">
              <p class="uppercase medium s-xsmall">Take note dei luoghi d’arte da non perdere</p>
              <?php foreach( $featured_places as $post ): setup_postdata($post); ?>
                <div class="d-flex flex-row t-column spacing-t-2 spacing-b-2">
                  <div class="d-seven-twelfth t-whole">
                    <div class="wysiwyg uppercase s-large">
                      <h2 class="place-title underline light d-inline-block f-left"><a data-id="place-<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                      <?php the_content(); ?>
                    </div>
                  </div>
                  <div class="d-five-twelfth t-whole">
                    <div data-id="place-<?php the_ID(); ?>" class="place-img-container">
                      <?php the_post_thumbnail(); ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
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