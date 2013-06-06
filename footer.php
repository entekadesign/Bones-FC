			<footer role="contentinfo" id="page-footer">
			
				<div id="inner-footer" class="clearfix">
					
					<nav role="navigation">
						<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>

					<div id="attribution-links" class="clearfix"><ul class="clearfix"><li class="menu-item" id="fatcatch-credit">&copy; 2011-<?php echo date('y'); ?> <?php echo do_shortcode('[enkode]<a href="mailto:info@fatcatchdesign.com" title="Send us an e-mail">FatCatch Design</a>[/enkode]'); ?></li><li id="html5-logo-wrapper" class="menu-item"><a href="http://www.w3.org/html/logo/faq.html" title="Built with HTML5" data-icon="&#xe006;"><span>HTML5</span></a></li></ul></div>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>