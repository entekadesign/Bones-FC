				<div id="sidebar-clients" class="sidebar last clearfix" role="complementary">

					<!-- <div class="divider"></div> -->

					<?php if ( is_active_sidebar( 'sidebar-clients' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar-clients' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="alert help">
							<p>Please activate some Widgets.</p>
						</div>

					<?php endif; ?>

				</div>