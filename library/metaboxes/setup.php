<?php

include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';

// global styles for the meta boxes
if (is_admin()) add_action('admin_enqueue_scripts', 'metabox_style');

function metabox_style()
{
	wp_enqueue_style('wpalchemy-metabox', get_stylesheet_directory_uri() . '/library/metaboxes/meta.css');
}

// media access additions

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

// updates image when inserted with editor; also updates hidden fields

if (is_admin()) add_action('admin_footer', 'my_media_access_scripts');

function my_media_access_scripts()
{

	$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : NULL ;

	$file = basename(parse_url($uri, PHP_URL_PATH));

	if ($uri && in_array($file, array('post.php', 'post-new.php')))
	{	
		global $typenow;
		if ($typenow == 'portfolio_item')
		{
			?><script type="text/javascript">
			/* <![CDATA[ */
			jQuery(function($)
			{
				$('[class*=<?php global $wpalchemy_media_access; echo $wpalchemy_media_access->button_class_name; ?>]').live('click', function()
				{
					imgid = $(this).parent().parent().find('.img_thumbnail').attr('id');
					thumid = $(this).parent().parent().find('.img_mob_thumb').attr('id');
					image_id_id = $(this).parent().parent().find('.image_id').attr('id');
					thumb_url_id = $(this).parent().parent().find('.thumb_url').attr('id');
				});

				if (typeof send_to_editor === 'function')
				{

					var my_send_to_editor_default = send_to_editor;

					send_to_editor = function(html)
					{
						//console.log(html);
						//console.log(blah);

						var id_source = html.match(/wp-image-([0-9]+)/i);

						if ( id_source[1] )
						{
							var image_id = parseInt( id_source[1] );
							$('#' + image_id_id).val(image_id);
						}		

						var src = html.match(/src=['|"](.*?)['|"] alt=/i);
						src = (src && src[1]) ? src[1] : '' ;

						var href = html.match(/href=['|"](.*?)['|"]/i);
						href = (href && href[1]) ? href[1] : '' ;

						var url = src ? src : href;

						$('#' + imgid).attr('src', url);

						// var thumbas = href.replace(/\\/g, '/').replace( /.*\//, '');

						// var thumext = href.split('.').pop();

						// var thumfil = thumbas.replace('.' + thumext, '');

						// var thumurl = href.replace(thumbas, thumfil + '-216x133.' + thumext);

						// // var thumpth = thumurl.replace('http://' + window.location.host, '..');

						var thumurl_source = html.match(/data-fc_thumb_url=['|"](.*?)['|"]/i);
						if ( thumurl_source[1] )
						{
							var thumurl = thumurl_source[1];
							$('#' + thumid).attr('src', thumurl);
						}

						//console.log(thumurl);

						my_send_to_editor_default(html);
					}
				}
			});
			/* ]]> */
			</script><?php 
		}
	}
}



/* eof */