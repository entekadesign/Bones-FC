<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="first clearfix" role="main">

						<div id="page-header" class="clearfix">

							<div id="img-search" class="page-header-image clearfix"></div>

							<div class="page-header-text clearfix">

								<h1><span><?php _e("SEARCH", "bonestheme"); ?></span></h1>

								<p>&ldquo;<?php echo esc_attr(get_search_query()); ?>&rdquo;</p>

							</div>

						</div>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
								<header class="article-header">

									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

									<div class="divider"></div>

									<p class="meta"><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
						
								</header> <!-- end article header -->
					
								<section class="post-content clearfix">

									<?php
									global $custom_metabox2; $custom_metabox2->the_meta();
									$image_id = $custom_metabox2->get_the_value('image_id');
									$title = get_the_title($image_id);
									$alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
									echo '<div><img src="';
									if (is_mobile())
									{
										$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-tiny');
									} else
									{
										$thumb_attrs = wp_get_attachment_image_src( $image_id, 'fc-small');
									}
									echo $thumb_attrs[0] . '" class="img_header" title="' . $title . '" alt="' . $alt . '" /></div>';
									?>

									<div class="txt_wrap"><?php the_excerpt(); ?></div>
					
								</section> <!-- end article section -->
						
								<footer class="article-footer more_link_spacer clearfix">

									<div class="divider"></div>
							
								</footer> <!-- end article footer -->
					
							</article> <!-- end article -->
					
						<?php endwhile; ?>	
					
						<?php fc_page_navi(); // use the page navi function ?>		
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><div class="divider"><?php _e("Sorry, No Results.", "bonestheme"); ?></div></h1>
    					    	</header>
     					    	<section class="post-content">
    					    		<p><?php _e("Try your search again.", "bonestheme"); ?></p>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <!-- <p><?php _e("This is the error message in the search.php template.", "bonestheme"); ?></p> -->
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