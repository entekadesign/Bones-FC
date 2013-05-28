<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

<title><?php bloginfo('name'); ?> &#9642; Maintenance Mode</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/library/css/style.css" type="text/css" media="screen" />

</head>
<body class="error503">

	<header class="header" role="banner">
	
		<div id="inner-header" class="wrap clearfix">
			
			<h1 id="logo"><a href="<?php echo home_url(); ?>" rel="nofollow" title="FatCatch Design home page" class="image-replacement"><?php bloginfo('name'); ?></a></h1>
		
		</div> <!-- end #inner-header -->
	
	</header> <!-- end header -->

			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="first clearfix" role="main">

						<div id="page-header" class="clearfix">

							<div id="img-maintenance" class="page-header-image clearfix"></div>

							<div class="page-header-text clearfix">

								<h1><span><?php _e("ERROR 503", "bonestheme"); ?></span></h1>

								<article id="maintenance_mode" class="hentry clearfix">

									<section>

										<p><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><?php _e(" is undergoing scheduled maintenance. We expect to be ready for you in " . $this->g_opt['mamo_backtime_hours'] . " hours and " . $this->g_opt['mamo_backtime_mins'] . " minutes.", "bonestheme"); ?></p> 

									</section>
								
								</article> <!-- end article -->

							</div>

						</div>
			
					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

</body>
</html>
