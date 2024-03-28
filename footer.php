	<div id="footer-title" class="border-top border-bottom spacing-p-t-4 t-center">
    <h2>
    	<a class="s-xhuge uppercase serif italic" href="<?php echo get_page_link(16); ?>">
				<?php echo get_the_title(16); ?>
			</a>
    </h2>
  </div>

	<div id="footer">
		<div class="container">
			<div class="flex-row d-flex t-wrap spacing-p-t-4">
				<div class="d-three-twelfth t-half m-whole">
					<a id="logo-footer" class=" spacing-b-3" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php include('assets/img/thats_logo_footer.svg'); ?>
					</a>

					<div class="wysiwyg s-xsmall">
						<?php the_field('indirizzo','options'); ?>
					</div>
				</div>
				<div class="d-two-twelfth t-half m-whole">
					<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
					<?php wp_nav_menu( array( 'theme_location' => 'social-menu' ) ); ?>
				</div>
				<div class="d-one-third t-whole">
					<p class="s-medium">Iscriviti alla Newsletter That’s</p>
				</div>

				<div class="d-one-twelfth t-hidden"></div>

				<div class="d-two-twelfth t-whole">
					<a class="dot-before s-medium spacing-b-2" href="<?php echo get_page_link(14); ?>">
						<?php echo get_the_title(14); ?>
					</a>
					<a class="dot-before s-medium spacing-b-2" href="<?php echo get_page_link(16); ?>">
						<?php echo get_the_title(16); ?>
					</a>
				</div>
			</div>
		</div>
	</div>
	 
	</div>

<?php wp_footer(); ?>

</body>
</html>