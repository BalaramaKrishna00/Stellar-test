<?php get_header(); ?>
<main>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <?php the_excerpt(); ?>
    </article>
  <?php endwhile; else : ?>
    <p>No content found</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
