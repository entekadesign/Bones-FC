<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="first clearfix" role="main">

						<div id="page-header" class="clearfix">

							<div id="img-error" class="page-header-image clearfix"></div>

							<div class="page-header-text clearfix">

								<h1><span><?php _e("404 ERROR", "bonestheme"); ?></span></h1>

								<article id="post-not-found" class="hentry clearfix">

									<section>

										<p><?php _e("The article you wanted was not found. All roads lead to Rome, so think of this page as a rest stop.", "bonestheme"); ?></p>

									</section>

									<section>
								
									    <?php get_search_form(); ?>
								
									</section> <!-- end search section -->
								
								</article> <!-- end article -->

							</div>

						</div>
			
					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
