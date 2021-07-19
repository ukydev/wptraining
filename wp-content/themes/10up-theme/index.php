<?php
/**
 * The main template file
 *
 * @package TenUpTheme
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<ul>
				<li><strong>Author: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?></li>
				<li><strong>Published Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?></li>
				<li><strong>Price: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?></li>
			</ul>
		<?php endwhile; ?>
	<?php endif; ?>

<?php
get_footer();
