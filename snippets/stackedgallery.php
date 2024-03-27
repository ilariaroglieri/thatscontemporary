<?php 
$images = get_field('stacked_gallery'); 

if( $images ): ?>
  <div class="stacked_gallery spacing-t-4 reveal-child">
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