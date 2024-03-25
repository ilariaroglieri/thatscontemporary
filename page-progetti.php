<?php get_header(); ?>

<section class="content" id="content-progetti">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        
        <?php include('snippets/hero-title.php'); ?>

        <div id="intro-section" class="flex-row d-flex m-column spacing-t-4 spacing-b-12 reveal-module">
          <div class="d-whole d-flex d-column">
            <div class="wysiwyg s-small reveal-child t-center">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <?php $args = array(
          'post_type' => 'project',
          'posts_per_page' => -1,
          'orderby' => 'date', 
          'order' => 'DESC',
        );
        
        $allProjects = new WP_Query( $args ); 

        if($allProjects->have_posts()): ?>
          <div class="d-flex flex-row wrap">
            <?php while($allProjects->have_posts()) : $allProjects->the_post(); ?>
              <div class="project d-half m-whole d-flex d-column spacing-b-2 reveal-module">
                <?php include('snippets/project-item.php'); ?>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif;
        wp_reset_postdata(); ?>

      </div>
    </div>  

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>