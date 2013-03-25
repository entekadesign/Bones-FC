<?php
/*
Template Name: Clients Single Page Template
*/
?>
<?php get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap clearfix">

		<h1 class="archive-title">CLIENTS</h1>

		<div id="main" class="eightcol first clearfix" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

				<div class="article-container">

					<header class="article-header">

						<h2 class="single-title custom-post-type-title"><?php the_title(); ?></h2>

					</header> <!-- end article header -->

					<div class="views_window clearfix">

						<section id="views-<?php global $wp_query; echo $wp_query->current_post; ?>" class="post-content views clearfix">

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
										$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-clients-thumb-mob-tab');
									} else
									{
										$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-clients-thumb-wid');
									}
									echo $thumb_attrs[0] . '" class="img_thumb" title="' . $title . '" alt="' . $alt . '" /></a></div>';
						    							//echo 'CAPTION: '.$caption;
									?>

									<div class="acolumn cssfade"><?php $custom_metabox->the_value('description'); ?></div>

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
						<span><?php get_topics($post->ID); ?></span>
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

<?php else : ?>

	<article id="post-not-found" class="hentry clearfix">
		<header class="article-header">
			<h1><?php __("Oops, Post Not Found!", "bonestheme"); ?></h1>
		</header>
		<section class="post-content">
			<p><?php __("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
		</section>
		<footer class="article-footer">
			<p><?php __("This is the error message in the single-portfolio_item.php template.", "bonestheme"); ?></p>
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