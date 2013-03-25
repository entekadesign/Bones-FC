<?php

$custom_metabox = new WPAlchemy_MetaBox(array
(
	'id' => '_portfolio_item_meta',
	'title' => 'Portfolio Item Views',
	'types' => array('portfolio_item'),
	'template' => get_stylesheet_directory() . '/library/metaboxes/portfolio_item-meta.php',
	'hide_editor' => TRUE
));

/* eof */