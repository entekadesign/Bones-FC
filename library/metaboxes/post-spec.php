<?php

$custom_metabox2 = new WPAlchemy_MetaBox(array
(
	'id' => '_post_meta',
	'title' => 'Post',
	'types' => array('post'),
	'template' => get_stylesheet_directory() . '/library/metaboxes/post-meta.php',
	// 'hide_editor' => TRUE
));

/* eof */