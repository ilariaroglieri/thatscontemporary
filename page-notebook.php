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

    <?php
    $hightlightArticle = get_field('highlight_article');
    if( $hightlightArticle ):

      $post = $hightlightArticle;
      setup_postdata($post); ?>

        <?php include('snippets/article-opening.php'); ?>
        <?php include('snippets/article-header.php'); ?>
    
    <?php endif; wp_reset_postdata(); ?>


    <!-- filter -->
    <div id="filters-container" class="spacing-t-4">
      <div class="highlight t-center">
        <p class="wysiwyg light uppercase s-xxsmall"><?php _e("Utilizza i filtri che abbiamo selezionato di seguito per trovare ciò che più ti interessa.", 'thats-theme'); ?></p>
      </div>

      <ul class="cat-filter flex-row d-flex m-column spacing-t-4 t-center">
        <?php $cats = get_categories(); ?>
        <?php foreach($cats as $cat) : ?>
          <li class="main-cat d-one-third m-whole">
            <a class="cat-item s-xxsmall uppercase" href="#!" data-type="category" data-id="<?= $cat->cat_ID; ?>">
              <?= $cat->name; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

       <ul class="tag-filter flex-row d-flex wrap t-center">
        <?php $tags = get_terms( 'main_tag' ); ?>
        <?php foreach($tags as $tag) : ?>
          <li class="main-tag d-one-third m-whole">
            <a class="tag-item s-xxsmall uppercase" href="#!" data-type="main_tag" data-id="<?= $tag->term_id; ?>">
              <?= $tag->name; ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- articles query -->
    <?php $args = array(
      'posts_per_page' => -1,
      'offset' => 0,
      'orderby' => 'date',
      'order' => 'ASC',
      'post_type' => 'post',
      'post_status' => 'publish',
      'suppress_filters' => true,
    );

    $bigLoop = new WP_Query( $args ); 
    if ( $bigLoop->have_posts() ) : ?>
      <div id="articles-container" class="spacing-t-4">
        <div class="d-flex flex-row wrap">
          <?php while ( $bigLoop->have_posts() ) : $bigLoop->the_post(); ?>
            
            <?php include('snippets/articles-query.php'); ?>
        
          <?php endwhile; ?>
        </div>
      </div>
    <?php endif; wp_reset_postdata(); ?>

  </div>  

</section>

<?php get_footer(); ?>