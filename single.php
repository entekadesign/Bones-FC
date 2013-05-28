<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="first clearfix" role="main">

						<div id="page-header" class="clearfix">

							<h1 class="blog-title"><span><?php _e("BLOG", "bonestheme"); ?></span></h1>

							<p class="blog-feed"><span data-icon="&#xe005;"></span><a href="<?php bloginfo('rss_url'); ?>" title="RSS 0.92">RSS Feed</a></p>

						</div>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
								<header class="article-header">
							
									<h2 class="single-title" itemprop="headline"><?php the_title(); ?></h2>

									<div class="divider"></div>
							
									<p class="meta"><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
						
								</header> <!-- end article header -->
					
								<section class="post-content clearfix" itemprop="articleBody">
									<?php
									global $custom_metabox2; $custom_metabox2->the_meta();
									$image_id = $custom_metabox2->get_the_value('image_id');
									$title = get_the_title($image_id);
									$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
									echo '<div><img src="';
									if (is_mobile())
									{
										$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-medium');
									} else
									{
										$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-large');
									}
									echo $thumb_attrs[0] . '" class="img_header" title="' . $title . '" alt="' . $alt . '" /></div>';
									?>
									<div class="txt_wrap"><?php the_content(); ?></div>
								</section> <!-- end article section -->
						
								<footer class="article-footer">

									<div class="divider"></div>
			
									<?php //the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
									<ul><span class="taxonomy_terms"><?php get_tax($post->ID, 'category'); ?></span></ul>
							
								</footer> <!-- end article footer -->
					
								<?php //comments_template(); // comments should go inside the article element ?>
					
							</article> <!-- end article -->
					
						<?php endwhile; ?>
					
						<?php else : ?>
					
							<article id="post-not-found" class="hentry clearfix">
					    		<header class="article-header">
					    			<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
					    		</header>
					    		<section class="post-content">
					    			<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
					    		</section>
					    		<footer class="article-footer">
					    		    <p><?php _e("This is the error message in the single.php template.", "bonestheme"); ?></p>
					    		</footer>
							</article>
					
						<?php endif; ?>
			
					</div> <!-- end #main -->
    
					<?php get_sidebar(); // sidebar 1 ?>

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

			<div id="footer-pad"></div> <!-- to position footer at bottom of page -->

</div> <!-- #page-wrapper end -->			

<?php get_footer(); ?>