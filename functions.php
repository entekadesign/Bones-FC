<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
library/custom-post-type.php
    - an example custom post type
    - example custom taxonomy (like categories)
    - example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
library/admin.php
    - removing some default WordPress dashboard widgets
    - an example custom dashboard widget
    - adding custom login css
    - changing text in footer of admin
*/
// require_once('library/admin.php'); // this comes turned off by default
/*
library/translation/translation.php
    - adding support for other languages
*/
// require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'fc-clients-thumb-wid', 296, 183, true );
add_image_size( 'fc-clients-thumb-mob-tab', 216, 133, true );
/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

// custom image sizes in media uploader
add_filter('image_size_names_choose', 'fc_image_sizes');

function fc_image_sizes($sizes)
{
    // remove unwanted sizes
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);

    // display custom sizes
    $myimgsizes = array(
    "fc-clients-thumb-wid" => __( "Clients thumb (wide)" ),
    "fc-clients-thumb-mob-tab" => __( "Clients thumb (mobile & tablet)" ),
    );

    $newimgsizes = array_merge($sizes, $myimgsizes);
    return $newimgsizes;
}

// edit display of attachment upload options: prevent upload of small images
add_filter('attachment_fields_to_edit', 'fc_image_attachment_fields_to_edit', 11, 2);
function fc_image_attachment_fields_to_edit($form_fields, $post)
{

    if ( substr($post->post_mime_type, 0, 5) == 'image' ) {

        $tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'type';

        if ( $tab == 'type' )
        {
            //var_dump($post);

            $attchID = $post->ID;
            $meta = wp_get_attachment_metadata($attchID);

            if ( $meta['width'] < 216 || $meta['height'] < 133 ) 
            {   
                echo '<div class="error" style="margin: 1em;">Image must be 216x133 or larger.</div>';
                wp_delete_attachment($attchID);
                exit(1);
            }
        }

        // $alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true);
        // if ( empty($alt) )
        //     $alt = '';

        // $form_fields['post_title']['required'] = true;

        // $form_fields['image_alt'] = array(
        //     'value' => $alt,
        //     'label' => __('Alternate Text'),
        //     'helps' => __('Alt text for the image, e.g. &#8220;The Mona Lisa&#8221;')
        // );

        // $form_fields['align'] = array(
        //     'label' => __('Alignment'),
        //     'input' => 'html',
        //     'html'  => image_align_input_fields($post, get_option('image_default_align')),
        // );

        $form_fields['image-size'] = image_size_input_fields( $post, get_option('image_default_size', 'full') );

    // } else {
    //     unset( $form_fields['image_alt'] );
    }
    return $form_fields;
}

// add data attribute containing mobile image url to html sent by media uploader
add_filter('image_send_to_editor', 'edit_image_html', 20, 8);
function edit_image_html( $html, $id, $caption, $title, $align, $url, $size, $alt = '' )
{
    $thumb_attrs = wp_get_attachment_image_src( $id, 'fc-clients-thumb-mob-tab');
    $html = str_replace('class=', 'data-fc_thumb_url="'.$thumb_attrs[0].'" class=', $html);
    return $html;

}


/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
        'id' => 'sidebar1',
        'name' => 'Sidebar 1',
        'description' => 'The first (primary) sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
        'id' => 'sidebar-blog-block',
        'name' => 'Blog Block',
        'description' => 'A content block (sidebar) for blog and twitter feeds.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'id' => 'sidebar-clients',
        'name' => 'Clients Page Sidebar',
        'description' => 'A sidebar for the Clients page.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    )); 

} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/
        
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?>>
        <article id="comment-<?php comment_ID(); ?>" class="clearfix">
            <header class="comment-author vcard">
                <?php /*
                    this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
                    echo get_avatar($comment,$size='32',$default='<path_to_url>' );
                */ ?>
                <!-- custom gravatar call -->
                <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>&s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
                <!-- end custom gravatar call -->
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
                <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
                <?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
            </header>
            <?php if ($comment->comment_approved == '0') : ?>
                <div class="alert info">
                    <p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
                </div>
            <?php endif; ?>
            <section class="comment_content clearfix">
                <?php comment_text() ?>
            </section>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </form>';
    return $form;
} // don't remove this bracket!

//  ========================
//  = Additional Functions =
//  ========================


// function set_newuser_cookie() {
//     if (!isset($_COOKIE['sitename_newvisitor'])) {
//         setcookie('sitename_newvisitor', 1, time()+1209600, COOKIEPATH, COOKIE_DOMAIN, false);
//     }
// }
// add_action( 'init', 'set_newuser_cookie');

// if (!isset($_COOKIE['sitename_newvisitor'])) {
//  echo 'Welcome, new user!';
// }

// function is_mobile_device() {
//  $useragent=$_SERVER['HTTP_USER_AGENT'];
//  // Detect Mobile Device
//  // http://detectmobilebrowsers.com
//  if (preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
//      return true;
//  } else {
//      return false;
//  }
// }

/*
 * Functions:   Optimize Contact Form 7
 *
 */

function deregister_cf7_js() {
    if ( !is_page('Contact') ) {
    //wp_deregister_script( 'contact-form-7' ); //deregister causes undefined index & another error
    wp_deregister_script( 'jquery-form' );
    wp_dequeue_script( 'contact-form-7' );
    }
}
 add_action( 'wp_print_scripts', 'deregister_cf7_js', 100 );

function deregister_ct7_styles() {
    wp_deregister_style( 'contact-form-7' );
}
add_action( 'wp_print_styles', 'deregister_ct7_styles', 100 );


/* Metaboxes - WPAlchemy */

include_once 'library/metaboxes/setup.php';

include_once 'library/metaboxes/portfolio_item-spec.php';

/*********************
PAGE NAVI
*********************/  


// Add title attribute to next and previous navi links
add_filter('next_posts_link_attributes', 'get_next_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'get_previous_posts_link_attributes');

if (!function_exists('get_next_posts_link_attributes')){
    function get_next_posts_link_attributes($attr){
        $attr = 'rel="next" title="Next"';
        return $attr;
    }
}
if (!function_exists('get_previous_posts_link_attributes')){
    function get_previous_posts_link_attributes($attr){
        $attr = 'rel="previous" title="Previous"';
        return $attr;
    }
}

// Numeric Page Navi (modified from Bones default page navi)
function fc_page_navi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    if ( $numposts <= $posts_per_page ) { return; }
    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 3;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }
    echo $before.'<nav class="page-navigation"><ul class="bones_page_navi '."";

    if (is_mobile())
    {
        echo 'page_navi_mobile clearfix">';
        if ( $paged > 1 )
        {
            echo '<li class="bpn-prev-link"><a href="' . previous_posts( false ) . '" rel="newer" title="Newer" data-icon="&#xe000;"><span>Newer</span></a>';
        } else
        {
            echo '<li class="bpn-prev-nolink" data-icon="&#xe000;"><span>Newer</span>';
        }
        echo '</li>';
        $nextpage = intval($paged) + 1;     
        if ( $nextpage <= $max_page )
        {
            echo '<li class="bpn-next-link" ><a href="' . next_posts( $max_page, false ) . '" rel="older" title="Older" data-icon="&#xe001;"><span>Older</span></a>';
        } else
        {
            echo '<li class="bpn-next-nolink" data-icon="&#xe001;"><span>Older</span>';
        }
        echo '</li>';
    } else
    {
        echo 'clearfix">';
        if ($start_page >= 2 && $pages_to_show < $max_page) {
            $first_page_text = "First";
            echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'" data-icon="&#xe002;"><span class="visuallyhidden">'.$first_page_text.'</span></a></li>';
        }
        for($i = $start_page; $i  <= $end_page; $i++) {
            if($i == $paged) {
                echo '<li class="bpn-prev-link">';
                previous_posts_link('<span data-icon="&#xe000;"><span class="visuallyhidden"><<</span></span>');
                echo '</li>';
                echo '<li class="bpn-current" data-icon="&#xe004;"><span>'.$i.'</span></li>';
                echo '<li class="bpn-next-link">';
                next_posts_link('<span data-icon="&#xe001;"><span class="visuallyhidden">>></span></span>');
                echo '</li>';
            } else {
                echo '<li><a href="'.get_pagenum_link($i).'" title="Page">'.$i.'</a></li>';
            }
        }
        if ($end_page < $max_page) {
            $last_page_text = "Last";
            echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'" data-icon="&#xe003;"><span class="visuallyhidden">'.$last_page_text.'</span></a></li>';
        }
    }
    echo '</ul></nav>'.$after."";
} /* end page navi */

// current-menu-item with custom post types and custom menus bug workaround
// http://www.rarescosma.com/2010/11/add-a-class-to-wp_nav_menu-items-with-urls-included-in-the-current-url/
add_filter( 'nav_menu_css_class', 'add_parent_url_menu_class', 10, 2 );

function add_parent_url_menu_class( $classes = array(), $item = false ) {
    // Get current URL
    $current_url = current_url();

    // Get homepage URL
    $homepage_url = trailingslashit( get_bloginfo( 'url' ) );

    // Exclude 404 and homepage
    if( is_404() or $item->url == $homepage_url ) return $classes;

    //echo parse_url ( $current_url, PHP_URL_PATH );

    if ( strstr( $current_url, $item->url) && ! in_array( 'current-menu-item', $classes ) ) {
        // Add the 'current-menu-item' class
        $classes[] = 'current-menu-item';
    }

    return $classes;
}

function current_url() {
    // Protocol
    $url = ( 'on' == isset( $_SERVER['HTTPS'] ) ) ? 'https://' : 'http://';

    $url .= $_SERVER['SERVER_NAME'];

    // Port
    $url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];

    $url .= $_SERVER['REQUEST_URI'];

    return trailingslashit( $url );
}

function get_topics( $the_id ) {
    $the_terms = wp_get_object_terms($the_id, 'topics');
    if(!empty($the_terms)){
      if(!is_wp_error( $the_terms )){
        foreach($the_terms as $term){
          echo '<li><a href="'.get_term_link($term->slug, 'topics').'" rel="tag" title="View all posts filed under '.$term->name.'">'.$term->name.'</a></li>'; 
        }
      }
    }
}
?>