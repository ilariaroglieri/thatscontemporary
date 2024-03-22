<?php if( have_rows('club_benefits') ): ?>
  <div id="benefits" class="p-relative spacing-t-8 reveal-module">
    <?php while( have_rows('club_benefits') ): the_row();
      $title = get_sub_field('benefit_title');
      $text = get_sub_field('benefit_text');
      $img = get_sub_field('benefit_image');
    ?>

    <div class="single-benefit d-flex flex-row m-column reveal-child">
      <div class="d-half t-whole">
        <div class="dot-before"><h2 class="benefit-title uppercase s-large light color-hover spacing-b-2"><?= $title; ?></h2></div>
      </div>
      <div class="benefit-content d-flex flex-row">
        <div class="d-half t-whole">
          <div class="wysiwyg serif s-small color3">
            <?= $text; ?>
          </div>
        </div>
        <div class="d-half t-whole">
          <div class="benefit-img-container">
            <img src="<?= $img['url']; ?>" />
          </div>
        </div>
      </div>
    </div>

    <?php endwhile; ?>
  </div>
<?php endif; ?>