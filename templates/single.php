<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
	<div class="page-header">
		<?php if (function_exists('nav_breadcrumb')) echo '<div class="page-header-breadcrumb">' . nav_breadcrumb() . '</div>'; ?>
	  <h1>
	    <?php if (function_exists('roots_title')) { echo roots_title(); } else { the_title(); } ?>
	  </h1>
	</div>
    <div class="entry-content">
      <?php the_post_thumbnail('cubetech-portfolio-thumb', array('class' => 'cubetech-portfolio-thumb') ) ?> <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; ?>
