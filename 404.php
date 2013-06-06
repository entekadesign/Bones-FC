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

										<p class="hyphenate"><?php _e("There is nobody home at the address you entered.", "bonestheme"); ?>

										<?php
										if (isset($_SERVER['HTTP_REFERER'])) {
											$website = get_bloginfo('url');
											$adminemail = get_option('admin_email');
											$subject = "Bad Link To " . $_SERVER['REQUEST_URI'];
											$headers = "From: " . get_bloginfo('name') . " <noreply@$website>"."\r\n"."X-Mailer: PHP/".phpversion()."\r\n"."X-Priority: 2 (Normal)";
											$msg = "A user tried to go to $website" . $_SERVER['REQUEST_URI'] . " and received a 404 (page not found) error. They came from " . $_SERVER['HTTP_REFERER'] . ".";
											
											mail($adminemail, $subject, $msg, $headers);
											
											echo '<br>'; _e("A message that it needs fixing has been sent to the administrator.", "bonestheme");
										}
										?>

										</p><p class="hyphenate"><?php _e("All roads lead to Rome, so think of this page as a rest stop.", "bonestheme"); ?></p>

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

		<div id="footer-pad"></div> <!-- to position footer at bottom of page -->

	</div> <!-- #page-wrapper end -->

<?php get_footer(); ?>
