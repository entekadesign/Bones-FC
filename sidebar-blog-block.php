				<div id="sidebar-blog-block" class="clearfix" role="complementary">
				
					<div id="inner-sidebar-blog-block">

						<div id="wrapper-sidebar-blog-block">						

						<?php if ( is_active_sidebar( 'sidebar-blog-block' ) ) : ?>

							<?php dynamic_sidebar( 'sidebar-blog-block' ); ?>

						<?php else : ?>

							<!-- This content shows up if there are no widgets defined in the backend. -->
							
							<div class="alert help">
								<p>Please activate some Widgets.</p>
							</div>

					<?php endif; ?>
					
						</div>

					</div>

				</div>