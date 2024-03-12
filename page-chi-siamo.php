<?php get_header(); ?>

<section class="content" id="content-chi-siamo">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="container">
        <div class="title border-top border-bottom spacing-p-t-4 t-center">
          <h1 class="s-xhuge uppercase serif italic"><?php the_title(); ?></h1>
        </div>

        <div id="intro-section" class="flex-row d-flex m-column spacing-t-4 spacing-b-12">
          <div class="d-half m-whole d-flex d-column">
            <div class="wysiwyg s-large">
              <?php the_content(); ?>
            </div>

            <?php 
            $images = get_field('stacked_gallery'); 
            
            if( $images ): ?>
              <div class="stacked_gallery spacing-t-4">
                <?php foreach( $images as $i => $image ): ?>
                  <?php 
                    list($width, $height) = getimagesize($image['url']);
                    $orientation = ($width > $height) ? 'horizontal' : 'vertical';
                    $size = ['size1','size2','size3'];
                    $randSize = $size[array_rand($size)];
                  ?>
                  <div class="stacked_img <?= $randSize; ?> <?= $orientation; ?> <?php if ($i == 0):?>active<?php endif; ?>" style="background-image: url('<?= esc_url($image['url']); ?>');">
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="d-half m-whole two-columns">
            <div class="wysiwyg s-small">
              <?= the_field('introduction_text'); ?>
            </div>
          </div>
        </div>


        <?php if( have_rows('info_boxes') ): ?>
          <div id="info-section" class="flex-row d-flex wrap spacing-b-4">
            <?php while( have_rows('info_boxes') ) : the_row(); ?>
              <?php 
                $team = get_sub_field('is_team_box'); 
                $boxName = get_sub_field('box_title');
                $w = $team == 0 ? 'd-half' : 'd-whole';
                $w = $boxName == 'Partners' ? 's-small' : 's-regular'; 
              ?>

              <?php if ($team == 0): ?>
                <div data-id="<?= slugify($boxName); ?>" class="box d-half t-whole d-flex m-column">

                  <div class="info-title d-half m-whole">
                    <h2 class="s-regular uppercase reg"><?= the_sub_field('box_title'); ?></h2>
                  </div>

                  <div class="d-half m-whole">
                    <div class="wysiwyg <?= $w; ?> reg">
                      <?= the_sub_field('box_text'); ?>
                    </div>
                  </div>

                </div>
              <?php else: ?>
                <div data-id="<?= slugify($boxName); ?>" class="team box d-flex m-column">

                  <div class="d-half m-whole d-flex">
                    <div class="info-title d-half">
                      <h2 class="s-regular uppercase reg"><?= $boxName; ?></h2>
                    </div>

                    <div class="team-list d-half">
                      <?php if( have_rows('team_boxes') ): $j = 0; while( have_rows('team_boxes') ) : the_row(); 
                        $j++; 
                        $teamName = get_sub_field('team_name');
                        ?>
                        <h3 data-id="<?= slugify($teamName); ?>" class="team-name <?php if ($j == 1):?>active<?php endif; ?> s-regular uppercase reg"><?= $teamName; ?></h3>
                        <h4 class="team-subtitle s-regular reg spacing-b-2"><?= the_sub_field('team_subtitle'); ?></h4>
                      <?php endwhile; endif; ?>
                    </div>
                  </div>

                  <div class="d-half m-whole">
                    <?php if( have_rows('team_boxes') ): $k = 0; while( have_rows('team_boxes') ) : the_row(); $k++;
                      $img = get_sub_field('team_portrait');
                      $teamName = get_sub_field('team_name');
                      ?>

                      <div data-id="<?= slugify($teamName); ?>" class="team-profile <?php if ($k == 1):?>active<?php endif; ?> d-flex m-column">
                        <div class="team-img d-half m-whole" style="background-image: url('<?= esc_url($img['url']); ?>');"></div>
                        <div class="d-half m-whole">
                          <div class="wysiwyg s-xsmall reg">
                            <?= the_sub_field('team_bio'); ?>
                          </div>
                        </div>
                      </div>
                    <?php endwhile; endif; ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
         

      </div>
    </div>  

  <?php endwhile; else: ?>

    <h2>Woops...</h2>
    <p>Sorry, no posts found.</p>

  <?php endif; ?>

</section>

<?php get_footer(); ?>