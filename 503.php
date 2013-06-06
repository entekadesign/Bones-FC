<?php
$protocol = $_SERVER["SERVER_PROTOCOL"];
if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol ) $protocol = 'HTTP/1.0';
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
header( 'Retry-After: 600' ); // 10 minutes
?>

<!doctype html>
<!--[if lt IE 7]><html dir="ltr" lang="<?php bloginfo('language'); ?>" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html dir="ltr" lang="<?php bloginfo('language'); ?>" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html dir="ltr" lang="<?php bloginfo('language'); ?>" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" lang="<?php bloginfo('language'); ?>" class="no-js"><!--<![endif]-->
<head>

	<title><?php bloginfo('name'); ?> &#9642; Maintenance Mode</title>

	<meta name="description" content="503 Page" />
	<meta charset="<?php bloginfo('charset'); ?>" />

	<!-- Google Chrome Frame for IE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<!-- mobile meta (hooray!) -->
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
			
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/library/css/style.css" type="text/css" media="screen" />

</head>
<body class="error503">

	<div id="container">

		<div id="page-wrapper" class="clearfix">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<h1 id="logo"><a href="<?php bloginfo('url'); ?>" rel="nofollow" title="FatCatch Design home page" class="image-replacement"><?php bloginfo('name'); ?></a></h1>

				</div> <!-- end #inner-header -->

			</header> <!-- end header -->

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="first clearfix" role="main">

						<div id="page-header" class="clearfix">

							<div id="img-maintenance" class="page-header-image clearfix"></div>

							<div class="page-header-text clearfix">

								<h1><span><?php _e("503 ERROR", "bonestheme"); ?></span></h1>

								<article id="maintenance_mode" class="hentry clearfix">

									<section>

										<p class="hyphenate"><a href="<?php bloginfo('url'); ?>" rel="nofollow" title="FatCatch Design home page"><?php bloginfo('name'); ?></a><?php _e(" is undergoing scheduled maintenance.") ?></p><p class="hyphenate"><?php _e("We expect to be ready for you in " . $this->g_opt['mamo_backtime_hours'] . " hours and " . $this->g_opt['mamo_backtime_mins'] . " minutes.", "bonestheme"); ?></p> 

									</section>
									
								</article> <!-- end article -->

							</div>

						</div>

					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

			<div id="footer-pad"></div> <!-- to position footer at bottom of page -->

		</div> <!-- #page-wrapper end -->

		<footer role="contentinfo" id="page-footer">
		
			<div id="inner-footer" class="clearfix">

				<div id="attribution-links" class="clearfix"><ul class="clearfix"><li class="menu-item" id="fatcatch-credit">&copy; 2011-<?php echo date('y'); ?> <?php echo do_shortcode('[enkode]<a href="mailto:info@fatcatchdesign.com" title="Send us an e-mail">FatCatch Design</a>[/enkode]'); ?></li><li id="html5-logo-wrapper" class="menu-item"><a href="http://www.w3.org/html/logo/faq.html" title="Built with HTML5" data-icon="&#xe006;"><span>HTML5</span></a></li></ul></div>
			
			</div> <!-- end #inner-footer -->
			
		</footer> <!-- end footer -->
	
	</div> <!-- end #container -->

</body>
</html>
<?php die(); ?>