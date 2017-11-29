<?php 

function customThemeEnqueues(){
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all');
	wp_enqueue_style('customStyle', get_template_directory_uri() . '/css/customThemeStyle.css', array(), '1.0.0', 'all');
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri().'/js/bootstrap.min.js', array(), '3.3.7', true);
	wp_enqueue_script('customScript', get_template_directory_uri() . '/js/customThemeScript.js', array(), '1.0.0', true );
}

add_action('wp_enqueue_scripts', 'customThemeEnqueues');

function customThemeSetUp(){
	add_theme_support('menus');
	register_nav_menu('primary', 'This is the main navigation, positioned at the top of the page');
	register_nav_menu('seconday', 'This is the seconday navigation, located at the bottom of the page');
	register_nav_menu('programmes', 'A navigation bar which shows all our programmes here at yoobee');

}

add_action('init', 'customThemeSetUp');

add_theme_support('custom-background');

$customHeaderSetting = array(
		'default-image' => '',
		'width' => 1280,
		'height' => 500,
		'flex-height' => false,
		'flex-width' => true,
		'default-text-color' => '',
		'header-text' => true,
		'default-text-color' => '000',
		'uploads' => true,
		'video' => false
	);
add_theme_support('custom-header', $customHeaderSetting);
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside', 'image', 'video'));

function customTheme_sidebar_setup(){
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'class' => 'custom',
		'description' => 'This is our main sidebar on the right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>'
	));
}
add_action('widgets_init', 'customTheme_sidebar_setup');


//Customize colours
function customTheme_customize_colour($wp_customize){
	//Settings
	$wp_customize->add_setting('newtheme_text_colour', array(
		'default' => '#000000',
		'transport' => 'refresh'
	));

	$wp_customize->add_setting('newtheme_nav_colour', array(
		'default' => '#000000',
		'transport' => 'refresh'
	));

	$wp_customize->add_setting('newtheme_link_colour', array(
		'default' => '#000000',
		'transport' => 'refresh'
	));

	//Section
	$wp_customize->add_section('newtheme_text_colour_section', array(
		'title' => __('Standard Colours', 'New Custom Theme'),
		'priority' => 30
	));

	//Add the Control
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'newtheme_text_colour_control', array(
		'label' => __('Text Colour', 'New Custom Theme'),
		'section' => 'colors',
		'settings' => 'newtheme_text_colour',
	)));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'newtheme_nav_colour_control', array(
		'label' => __('Navigation Colour', 'New Custom Theme'),
		'section' => 'colors',
		'settings' => 'newtheme_nav_colour',
	)));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'newtheme_link_colour_control', array(
		'label' => __('Link Colour', 'New Custom Theme'),
		'section' => 'colors',
		'settings' => 'newtheme_link_colour',
	)));
}
add_action('customize_register', 'customTheme_customize_colour');



function newtheme_customize_css(){
?>

<style type="text/css">
	p,
	section,
	ul li{
		color: <?php echo get_theme_mod('newtheme_text_colour'); ?>;
	}

	.menu-main-nav-container, .menu-programmes-container{
		background-color: <?php echo get_theme_mod('newtheme_nav_colour'); ?>;
	}

	a:link,
	a:visited,
	#menu-main-nav li a, 
	#menu-programmes li a{
		color: <?php echo get_theme_mod('newtheme_link_colour'); ?>;
	}

</style>


<?php
}
add_action('wp_head', 'newtheme_customize_css');






function newTheme_footer_text($wp_customize){
	//Settings
	$wp_customize->add_setting('newTheme_footer_text', array(
		'default' => 'This is your footer Text',
		'transport' => 'refresh'
	));

	//Section
	$wp_customize->add_section('newTheme_footer_text_section', array(
		'title' => 'Footer'
	));

	//Control
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newTheme_footer_text_control', array(
		'label' => 'Footer Text',
		'section' => 'newTheme_footer_text_section',
		'settings' => 'newTheme_footer_text'
	)));
}
add_action('customize_register', 'newTheme_footer_text');

function programmes_init() {
    $labels = array(
        'name'               => _x( 'Programmes', 'post type general name' ),
        'singular_name'      => _x( 'Programme', 'post type singular name' ),
        'menu_name'          => _x( 'Programmes', 'admin menu' ),
        'name_admin_bar'     => _x( 'Programme', 'add new on admin bar' ),
        'add_new'            => _x( 'Add New Programme', 'programme' ),
        'add_new_item'       => __( 'Add New Programme' ),
        'new_item'           => __( 'New Programme' ),
        'edit_item'          => __( 'Edit Programme' ),
        'view_item'          => __( 'View Programme' ),
        'all_items'          => __( 'All Programmes' ),
        'search_items'       => __( 'Search Programmes' ),
        'parent_item_colon'  => __( 'Parent Programmes:' ),
        'not_found'          => __( 'No Programme found.' ),
        'not_found_in_trash' => __( 'No Programme found in Trash.' )
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'Programmes'),
        'query_var' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => array(
            'title',
            'editor',
            'thumbnail',),
        );
    register_post_type( 'programmes', $args );
}
add_action( 'init', 'programmes_init' );


/*
	==========================================
	creates custom fields
	==========================================
*/


$metaboxes = array(
    'programmes' => array(
        'title' => __('Programme Information'),
        'applicableto' => 'programmes',
        'location' => 'normal',
        'priority' => 'low',
        'fields' => array(
            'startDate' => array(
                'title' => __('Start Date: '),
                'type' => 'text'
            ),
            'endDate' => array(
            	'title' => __('End Date: '),
            	'type' => 'number'
            )
        )
    )
);

add_action( 'admin_init', 'add_post_format_metabox' );

function add_post_format_metabox() {
    global $metaboxes;

    if ( ! empty( $metaboxes ) ) {
        foreach ( $metaboxes as $id => $metabox ) {
            add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
        }
    }
}




function show_metaboxes( $post, $args ) {
    global $metaboxes;

    $custom = get_post_custom( $post->ID );
    $fields = $tabs = $metaboxes[$args['id']]['fields'];

    $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

    if ( sizeof( $fields ) ) {
        foreach ( $fields as $id => $field ) {
            switch ( $field['type'] ) {
                default:
                case "text":
                    $output .= '<label for="' . $id . '">' . $field['title'] . '</label><input class="customInput" id="' . $id . '" type="text" name="' . $id . '" value="' . $custom[$id][0] . '" style="width: 100%;" />';
                    break;
                case "number":
                    $output .= '<label for="' . $id . '">' . $field['title'] . '</label><input class="customInput" id="' . $id . '" type="number" name="' . $id . '" value="' . $custom[$id][0] . '" style="width: 100%;" />';
                break;
            }
        }
    }

    echo $output;
}
add_action( 'save_post', 'save_metaboxes' );


function save_metaboxes( $post_id ) {
    global $metaboxes;

    if ( ! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;
    } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $post_type = get_post_type();

    foreach ( $metaboxes as $id => $metabox ) {
        if ( $metabox['applicableto'] == $post_type ) {
            $fields = $metaboxes[$id]['fields'];

            foreach ( $fields as $id => $field ) {
                $old = get_post_meta( $post_id, $id, true );
                $new = $_POST[$id];

                if ( $new && $new != $old ) {
                    update_post_meta( $post_id, $id, $new );
                }
                elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
                    delete_post_meta( $post_id, $id, $old );
                }
            }
        }
    }
}



















