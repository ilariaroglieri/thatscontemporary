 <!-- navi -->
  <?php
    $circular_prev = get_previous_post() ? get_previous_post() : get_posts("post_type=" . get_query_var( 'post_type' ) . "&numberposts=1&order=DESC")[0];
    $circular_next = get_next_post() ? get_next_post() : get_posts( "post_type=" . get_query_var( 'post_type' ) . "&numberposts=1&order=ASC")[0];
  ?>

  <div class="container">
    <div class="navi d-flex d-column spacing-t-8 spacing-b-4">
      <div class="full-width d-whole  d-flex flex-row end">
        <div class="dot-link previous d-three-twelfth t-half m-whole">
          <a class="s-large uppercase light underline" href="<?= get_permalink($circular_next->ID); ?>"><?= $circular_next->post_title; ?></a>
        </div>
      </div>
      <div class="full-width d-whole  d-flex flex-row start spacing-t-4">
        <div class="dot-link next d-three-twelfth t-half m-whole">
          <a class="s-large uppercase light underline" href="<?= get_permalink($circular_prev->ID); ?>"><?= $circular_prev->post_title; ?></a>
        </div>
      </div>
    </div>
  </div>