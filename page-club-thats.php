<?php get_header(); ?>

<section class="content" id="content-club">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        
        <?php include('snippets/hero-title.php'); ?>

        <div class="d-flex flex-row spacing-t-4 reveal-module">
          <div class="d-whole">
            <div class="wysiwyg s-large light">
              <?php the_content(); ?>
            </div>
          </div>
        </div>

        <?php include('snippets/benefit-list.php'); ?>

      </div>

    

    </div>  
  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>