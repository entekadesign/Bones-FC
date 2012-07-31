<?php
/*
Template Name: Front Page Template
*/
?>

<?php get_header(); ?>
			
			<div id="content">

				<div id="taglinebar" class="clearfix" role="complementary">
					<div id="inner-taglinebar" class="clearfix"></div>
				</div>

				<div id="inner-content" class="wrap clearfix">				
			
				    <div id="main" class="clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					
						    <section class="post-content">
							    <?php the_content(); ?>
						    </section> <!-- end article section -->
					
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
        						    <p><?php __("This is the error message in the page-front.php template.", "bonestheme"); ?></p>
        						</footer>
        					</article>
					
					    <?php endif; ?>
			
				    </div> <!-- end #main -->
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->
			
<?php get_sidebar( 'blog-block' ); // blog & twitter block ?>

			<div id="footer-pad"></div> <!-- to position footer at bottom of page -->

</div> <!-- #page-wrapper end -->

<?php get_footer(); ?>