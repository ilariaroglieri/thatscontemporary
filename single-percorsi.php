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
          <p class="s-medium uppercase serif italic"><?php _e("Notebook", 'thats-theme'); ?></p>
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
            <p class="uppercase medium s-xsmall"><?php _e("Take note dei luoghi d’arte da non perdere", 'thats-theme'); ?></p>
            <?php foreach( $featured_places as $post ): setup_postdata($post); ?>
              <div class="d-flex flex-row t-column spacing-t-2 spacing-b-2">
                <div class="d-seven-twelfth t-whole">
                  <div class="wysiwyg uppercase s-large">
                    <h2 class="place-title light d-inline-block f-left"><a class="color-hover underline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php the_content(); ?>
                  </div>
                </div>
                <div class="d-five-twelfth t-whole">
                  <div class="place-img-container">
                    <?php the_post_thumbnail(); ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>

        <!-- percorsi info -->
        <div id="article_tour_info" class="spacing-t-4 border-top">
          <div class="d-flex flex-row m-column spacing-t-1">
            <div class="d-two-twelfth m-whole  border-right">
              <p class="light s-xsmall"><?php _e("Durata", 'thats-theme'); ?>: <?php the_field('duration'); ?></p>
            </div>
            <div class="d-five-twelfth m-whole border-right">
              <p class="light s-xsmall spacing-b-2"><?php _e("Guarda il percorso direttamente dal tuo smartphone.", 'thats-theme'); ?></p>
              <a class="light s-xsmall underline uppercase italic color-hover" href="<?php the_field('link_to_map'); ?>"><?php _e("Percorso", 'thats-theme'); ?></a>
            </div>
            <div class="d-five-twelfth m-whole">
              <p class="light s-xsmall spacing-b-2"><?php _e("Vuoi essere accompagnata/o da un art insider di That’s nel tuo tour d’arte?", 'thats-theme'); ?></p>
              <a class="light s-xsmall underline uppercase italic color-hover" href="mailto:info@thatscontemporary.com ?>"><?php _e("Contattaci", 'thats-theme'); ?></a>
            </div>
          </div>
        </div>

        <!-- dintorni -->
        <!-- list of places -->
        <?php
        $surrounding_places = get_field('surrounding_places');
        if( $surrounding_places ): ?>
          <div id="article_surrounding_places" class="spacing-t-4">
            <div class="d-flex flex-row">
              <div class="d-two-thirds m-whole">
                <div class="wysiwyg light s-big uppercase"><?php the_field('surroundings_text'); ?></div>
              </div>
            </div>

            <div class="d-flex flex-row wrap spacing-t-4">
              <?php foreach( $surrounding_places as $post ): setup_postdata($post); ?>
                <div class="surr-place-container d-half m-whole d-flex spacing-b-2">
                  <?php $thumb = get_the_post_thumbnail_url(); ?>
                  <div class="surr-place-img" style="background-image: url('<?= $thumb; ?>');">
                  </div>
                  <div class="surr-place-txt d-flex d-column space-between">
                    <div class="wysiwyg s-small">
                      <h3 class="surr-place-title light d-inline-block f-left uppercase underline"><?php the_title(); ?></h3>
                      <?php the_content(); ?>
                    </div>
                    <p class="uppercase s-xsmall reg"><?php the_field('address'); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>

              <div class="surr-place-container submit d-half m-whole d-flex spacing-b-2">
                <div class="surr-place-img"></div>
                <div class="wysiwyg s-small uppercase">
                  <?php $submittxt = get_field('percorsi_articles','options'); ?>
                  <?= $submittxt['submit_a_place']; ?>
                </div>
              </div>
            </div>
          </div>

        <?php wp_reset_postdata(); endif; ?>
      </div>

      <!-- navi -->
      <?php include('navi.php'); ?>

    </article>


  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php include('related.php'); ?>


<?php get_footer(); ?>