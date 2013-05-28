<?php
/*
Template Name: Clients Archive Template
*/
?>
<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<h1 class="archive-title"><span><?php _e("CLIENTS TOPIC:", "bonestheme"); ?></span></br><span class="subtitle"><?php single_cat_title(); ?></span></h1>

		<div id="main" class="eightcol first clearfix" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

				<div class="article-container">

					<header class="article-header">

						<h2>
							<?php if ( current_user_can( 'administrator' ) ) : ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						<?php else : ?>
						<?php the_title(); ?>
					<?php endif; ?>
				</h2>

			</header> <!-- end article header -->

			<div class="views_window clearfix">

				<section id="views-<?php global $wp_query; echo $wp_query->current_post; ?>" class="post-content views clearfix">

					<!-- <?php //the_content(); ?> -->

					<?php global $custom_metabox; $custom_metabox->the_meta(); $i=$li=0; ?>

					<ul>

						<?php while($custom_metabox->have_fields('views')) : ?>

						<li id="<?php $view_id = 'views-' . $wp_query->current_post . '-view-'; echo $view_id . $i; $i++; $ll=$custom_metabox->length; ?>">

							<?php
							$image_id = $custom_metabox->get_the_value('image_id');
							$title = get_the_title($image_id);
							$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
														//$attch_post = get_post($image_id); $caption = $attch_post->post_excerpt;
							$lnki = ($i == $ll) ? 0 : $i;
							echo '<div class="acolumn cssfade">'; if ($ll > 1) echo '<a href="#' . $view_id . $lnki . '" class="img_link" rel="nofollow">'; echo '<img src="';
							if (is_mobile())
							{
								$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-small');
							} else
							{
								$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-medium');
							}
							echo $thumb_attrs[0] . '" class="" title="' . $title . '" alt="' . $alt . '" /></a></div>';
														//echo 'CAPTION: '.$caption;
							?>

							<div class="acolumn textcol cssfade"><?php $custom_metabox->the_value('description'); ?></div>

						</li>

					<?php endwhile; ?>

				</ul>

			</section> <!-- end article section -->

		</div> <!-- end views section -->

		<div class="nav_dots_wrapper">

			<div class="nav_dots<?php $num = $i; if ($num == 1) echo ' nodots'; ?>">

				<?php

				for ($i=0; $i<$num; $i++)
				{
					if ($i < 13 && $num > 1) echo '<a href="#' . $view_id . $i . '" class="nav_dot dot-' . $i . '" title="Slide ' . ($i + 1) . '" rel="nofollow"></a>';
				}

				?>

			</div>

		</div> <!-- end nav_dots section -->

		<footer class="article-footer clearfix">

			<div class="divider"></div>

			<ul>
				<span class="taxonomy_terms"><?php get_tax($post->ID, 'topics'); ?></span>
			</ul>

</footer> <!-- end article footer -->

<?php if (!$custom_metabox->get_the_value('hidelink') && $custom_metabox->get_the_value('link')) : ?>
	<p class="link"><a href="<?php $custom_metabox->the_value('link'); ?>" title="<?php $custom_metabox->the_value('title'); ?>" alt="<?php $custom_metabox->the_value('alt'); ?>" class="button">Visit the Site</a></p>
<?php else : ?>
	<p class="link hidelink">(Site link not available)</p>
<?php endif; ?>

</div> <!-- end article-container-->

</article> <!-- end article -->

<?php endwhile; ?>

<?php fc_page_navi(); // use the page navi function ?>

<?php else : ?>

	<article id="post-not-found" class="hentry clearfix">
		<header class="article-header">
			<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
		</header>
		<section class="post-content">
			<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
		</section>
		<footer class="article-footer">
			<p><?php _e("This is the error message in the taxonomy-topics.php template.", "bonestheme"); ?></p>
		</footer>
	</article>

<?php endif; ?>

</div> <!-- end #main -->

<?php get_sidebar('clients'); ?>

</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<div id="footer-pad"></div> <!-- to position footer at bottom of page -->

</div> <!-- #page-wrapper end -->

<?php get_footer(); ?>