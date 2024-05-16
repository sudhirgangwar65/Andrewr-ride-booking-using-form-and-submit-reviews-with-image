<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'twenty-twenty-one-custom-color-overrides','twenty-twenty-one-style','twenty-twenty-one-style','twenty-twenty-one-print-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

// ACF Options Logic 
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

}

function custom_submenu_class34($classes, $args, $depth) {
    // Add your custom class to the submenu <ul> element
    $classes[] = 'child_drop';
    return $classes;
}
add_filter('nav_menu_submenu_css_class', 'custom_submenu_class34', 10, 3);

function add_menu_parent_class( $items ) {
$parents = array();
foreach ( $items as $item ) {
    //Check if the item is a parent item
    if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
        $parents[] = $item->menu_item_parent;
    }
}

foreach ( $items as $item ) {
    if ( in_array( $item->ID, $parents ) ) {
        //Add "menu-parent-item" class to parents
        $item->classes[] = 'par_drop has-child';
    }
}

return $items;
}

//add_menu_parent_class to menu
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' ); 

function codeflies_our_tour_post(){

    $labels = array(
        'name' => __('Our Tour'),
        'singular_name' => __('Our Tour'),
        'menu_name'   =>  __('Our Tour'),
        'all_items' => __('All Tour'),
        'view_item' => __('View Tour'),
        'add_new_item' =>__('Add New Tour'),
        'add_new' =>   __('Add New Tour'),
        'edit_item' => __('Edit Tour'),
        'update_item' => __('Update Tour'),
        'search_items' =>  __('Search Tour'),
        'not_found' => __('Not Found'),
        'not_found_in_trash'  =>  __('Not found in Trash')

    );
    $args = array(
            'label' => __('Our Tour'),
            'description' => __('Best Our Tour'),
            'labels'   =>   $labels,
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'comments'),
            'public'  =>  true,
            'hierarchical' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar'  => true,
            'has_archive'  => true,
            'can_export'  => true,
            'exclude_from_search'  => false,
            'yarpp_support'  => true,
            'publicly_queryable' => true,
            'capability_type'  => 'page'

    );
    register_post_type('tour', $args);

 register_taxonomy('Tour Category',array('tour'), array(
    'hierarchical' => true,
    'labels' => array('name'=>'Tour Category', 'singular_name' => 'Tour Category', 'search_items'=> 'Search Tour Category', 'menu_name' => 'Tour Category', 'add_new_item' => 'Add New Tour Category','not_found' => 'No New Tour Category Found'),
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tour-category' )
  ));

}


add_action('init', 'codeflies_our_tour_post');

add_action('init', 'awt_custom_reviews');

function awt_custom_reviews(){
$labels = array(
    'name' => 'Reviews',
    'singular_name' => 'Reviews',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Review',
    'edit_item' => 'Edit Review',
    'new_item' => 'New Review',
    'all_items' => 'All Reviews',
    'view_item' => 'View Review',
    'search_items' => 'Search Reviews',
    'not_found' =>  'No Review found',
    'not_found_in_trash' => 'No Review found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Reviews'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'show_in_rest' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => true,
    'supports' => array( 'title','editor','thumbnail')
  ); 
register_post_type( 'com_reviews', $args );
}

function getproductlist(){
    $category = $_POST['categoryId'];
    //echo $category;
    $args = array(
        'post_type'      => 'product', // Adjust post type if needed
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ),
    );
    $query = new WP_Query($args);
    if ($query->have_posts()):
    $data="";
    while ($query->have_posts()):
    $query->the_post();
    $data .= '<option value="'.get_the_ID().'">'.get_the_title().'</option>';
    endwhile;
    wp_reset_query();else:
    $data .= '<option>Select Your Product</option>';
    endif;
    wp_send_json_success(['data'=>$data,'count'=>$query->found_posts], 200);
}

add_action("wp_ajax_getproductlist", "getproductlist");
add_action("wp_ajax_nopriv_getproductlist", "getproductlist");

function addtocartproduct(){
     if(!empty($_POST['productId'])){
        $cartProduct=[];
        if(!empty($_POST['customerName'])){ $cartProduct['customerName']=$_POST['customerName']; }
        if(!empty($_POST['customerPhone'])){ $cartProduct['customerPhone']=$_POST['customerPhone']; }
        if(!empty($_POST['bookdate'])){ $cartProduct['bookdate']=$_POST['bookdate']; }
        if(!empty($_POST['bookTime'])){ $cartProduct['bookTime']=$_POST['bookTime']; }
        if(!empty($_POST['bookLocation'])){ $cartProduct['bookLocation']=$_POST['bookLocation']; }
        if(!empty($_POST['bikeType'])){ $cartProduct['bikeType']=$_POST['bikeType']; }
        if(!empty($_POST['customerComment'])){ $cartProduct['customerComment']=$_POST['customerComment']; }

        $qty=!empty($_POST['bikeQuantity']) ? (int)$_POST['bikeQuantity'] : 1;
        WC()->cart->add_to_cart($_POST['productId'], $qty, 0, [],$cartProduct);
        $checkout_url = wc_get_checkout_url();
        echo wp_send_json_success(array('checkout_url' => $checkout_url));
    } else {
        // If product ID is not provided, return an error
        echo wp_send_json_error('Product ID not Found.');
    }
}
   

add_action("wp_ajax_addtocartproduct", "addtocartproduct");
add_action("wp_ajax_nopriv_addtocartproduct", "addtocartproduct");


// For Displaying additional data for testing purpose

add_action('woocommerce_checkout_create_order_line_item', 'save_custom_cart_item_data_as_order_meta', 10, 4);

function save_custom_cart_item_data_as_order_meta($item, $cart_item_key, $values, $order)
{

     //$item->add_meta_data('Collect Data', json_encode($item));
   // $item->add_meta_data('Collect Value Data', json_encode($values));
    // $item->add_meta_data('Collect order Data', json_encode($order));
    // $item->add_meta_data('Collect Data', $values);
if (!empty($values['bookdate'])) {
    $item->add_meta_data('Booking Date', $values['bookdate']);
}
if (!empty($values['bookTime'])) {
        $item->add_meta_data('Booking Time', $values['bookTime']);
    }
if (!empty($values['bookLocation'])) {
        $item->add_meta_data('Booking Location', $values['bookLocation']);
    }
if (!empty($values['bikeType'])) {
        $item->add_meta_data('Bike type', $values['bikeType']);
    }
if (!empty($values['quantity'])) {
    $item->add_meta_data('Number Of Bike', $values['quantity']);
}

}

// // Define a custom function to display custom cart values on the checkout page
// function display_custom_cart_values_on_checkout() {
//     // Get the cart object
//     $cart = WC()->cart;
//    // print_r($cart);






//     echo '<p class="booking_date">Booking Date: 10/12/2024</p>';
// }

// // Hook the custom function into the WooCommerce checkout page
// add_action('woocommerce_review_order_before_payment', 'display_custom_cart_values_on_checkout');



function ns_woocommerce_checkout_remove_item( $product_name, $cart_item, $cart_item_key ) {
if ( is_checkout() ) {
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

    $remove_link = apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">×</a>',
        esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
        __( 'Remove this item', 'woocommerce' ),
        esc_attr( $product_id ),
        esc_attr( $_product->get_sku() )
    ), $cart_item_key );

    return '<span>' . $remove_link . '</span> <span>' . $product_name . '</span>';
}

return $product_name;
}
add_filter( 'woocommerce_cart_item_name', 'ns_woocommerce_checkout_remove_item', 10, 3 );

add_shortcode('Booking_form_shortcode', 'booking_custom_shortcode');
function booking_custom_shortcode(){ 
    ob_start();
    ?>
<form id="productForm">
                            <div class="input">
                                <label for="Your Name">Your Name</label>
                                <input type="text" id="yourname" name="yourname" required />
                            </div>
                            <div class="input">
                                <label for="Phone Number">Phone Number</label>
                                <input type="number" id="phonenumber" name="phonenumber" required />
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input">
                                        <label for="Date">Date</label>
                                        <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input">
                                        <label for="Time">Time</label>
                                        <input type="time" id="time" name="time" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input">
                                        <label for="Location">Location</label>
                                        <select id="location" name="location">
                                            <option value="Sydney">Sydney</option>
                                            <option value="Gold Coast">Gold Coast</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input">
                                        <label for="Time Frame">Type Of Bike</label>
                                        <select id="productSelect" name="Bike type">
                                        <?php
                                        $categories = get_terms( 'product_cat' );
                                        if ( ! empty( $categories )){
                                            
                                            foreach ( $categories as $category ) {
                                                echo '<option value="'.$category->slug .'">'. $category->name .'</option>';
                                            }                                           
                                        }
                                        ?>  
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input">
                                        <label for="No.of single Bike">Time Frame</label>
                                        <select id="productlistItem" name="product">
                                            <?php
                                             $arg = array(
                                                    'post_type'      => 'product', 
                                                    'posts_per_page' => -1,
                                                    'order'          => 'ASC',
                                                    'tax_query'      => array(
                                                        array(
                                                            'taxonomy' => 'product_cat',
                                                            'field'    => 'slug',
                                                            'terms'    => 'single-bike',
                                                        ),
                                                    ),
                                                );
                                                $quer = new WP_Query($arg);
                                                if ($quer->have_posts()):
                                                while ($quer->have_posts()):
                                                    $quer->the_post();
                                                ?>
                                                <option value="<?= get_the_ID(); ?>"><?= get_the_title(); ?></option>
                                                <?php
                                                    endwhile;
                                                    wp_reset_query();
                                                    endif;
                                                ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input">
                                        <label for="No.of Tandem Bikes">No.of Bikes</label>
                                        <select name="quantity" id="bikequantity">
                                            <?php 
                                            $j = 7;
                                            for($i = 0; $i <= $j; $i++){
                                            ?>
                                            <option value="<?= $i; ?>"><?= $i; ?></option>  
                                            <?php } ?>                                   
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="input">
                                <label for="">Booking Comments</label>
                                <textarea rows="4" cols="50" id="w3review" required name="No. Of Adults / Children Under 15"  placeholder="No. Of Adults / Children Under 15"></textarea>
                            </div>
                            <div class="input checkbox">
                                <label for="ageplus"><input id="ageplus" type="checkbox" required /> I accept all <a href="<?php bloginfo('template_url'); ?>/assets/pdf/Waterbikes GC Waiver Form 1.docx" target="_blank"> terms &amp; conditions.</a></label>
                            </div>
                            <div class="submitbutton">
                                <button type="submit" id="submitButton">Pay Now</button>
                            </div>
                        </form>

<?php 
return ob_get_clean();
}

add_filter ('add_to_cart_redirect', 'redirect_to_checkout');

function redirect_to_checkout() {
    global $woocommerce;
    $checkout_url = $woocommerce->cart->get_checkout_url();
    return $checkout_url;
}
add_action( 'template_redirect', 'redirect_shop_page' );
function redirect_shop_page() {
    if ( is_shop() ) {
        wp_redirect( home_url("/booking") );
        exit();
    }
}
add_filter('manage_com_reviews_posts_columns', 'awt_add_post_reviews_custom_column', 2);
 
// Add the column
function awt_add_post_reviews_custom_column($awt_columns){
    
    $awt_columns['location'] = __('Designation');
    $awt_columns['awt_message'] = __('Description');
    $awt_columns['awt_author_image'] = __('Author Image');
    return $awt_columns;
}

add_action('manage_com_reviews_posts_custom_column', 'awt_show_post_thumbnail_column', 5, 2);

// Here we are grabbing featured-thumbnail size post thumbnail and displaying it
function awt_show_post_thumbnail_column($awt_columns, $post_id){
    global $post;
    switch($awt_columns){
        case 'location':    
            $data_id = get_field('location');
            echo $data_id;                      
            break;
        case 'awt_message':
            echo get_the_content($post_id);
        break;
        case 'awt_author_image':
        echo get_the_post_thumbnail( $post_id, array(80, 80) );
        break;
    }
}


// Reorder columns for the reviews admin screen
function awt_reorder_reviews_columns($columns) {
    // Define the new column order
    $new_columns = array(
        'cb' => $columns['cb'], // Keep checkbox column
        'title' => $columns['title'], // Keep title column
        'location' => $columns['location'], // Custom column for reviewer name
        'awt_message' => $columns['awt_message'], // Custom column for location
        'awt_author_image' =>$columns['awt_author_image'],
        'date' => $columns['date'], // Keep date column
    );

    return $new_columns;
}
add_filter('manage_edit-com_reviews_columns', 'awt_reorder_reviews_columns');

add_shortcode('awt_reviews_shortcode', 'awt_custom_reviews_shortcode');
function awt_custom_reviews_shortcode(){ 
    ob_start();
    ?>
<div class="reviews_mk_inn">
        <?php 
            $review = array(
                      'post_type'=> 'com_reviews',
                      'post_status' => 'publish',
                      'orderby'=> 'post_date',
                      'posts_per_page' => -1 
                        );
            $query = new WP_Query($review);
            if($query->have_posts()){
                while($query->have_posts()){
                    $query->the_post();
                    $review_Id = get_the_ID();
        ?>
        <div class="reviews_main_bk">
            <p class="pra_first"><?= get_the_content(); ?></p>
            <div class="revi_namese">
                <?php 
                $img = get_the_post_thumbnail($review_Id, [70,70]);
                if(!empty($img)){
                echo $img;
                    }
                ?>
                <div class="reviews_destis">
                    <h2><?= get_the_title(); ?></h2>
                    <p><?= get_field('location', $review_Id); ?></p>
                </div>
            </div>
        </div>
    <?php 
        } 
        } 
    wp_reset_query();
    ?>
        
    </div>

<?php 
return ob_get_clean();
}

add_action('init', 'submit_customer_ride_review');
function submit_customer_ride_review(){
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_review"])) {

        // Get form data
        $post_title = sanitize_text_field($_POST['your_name']);
        $post_content = sanitize_text_field($_POST['review_msg']);
        $author_des = $_POST['designation'];
        // Create post data
        $my_post = array(
                    'post_title'    => $post_title,
                    'post_content'  => $post_content,
                    'post_type'     => 'com_reviews',
                    'post_status'   => 'pending'
                );
           // Insert the post into the database
            $post_id = wp_insert_post( $my_post );
            //print_r($post_id);

            // Handle image upload
            $upload_dir = wp_upload_dir();
            $image_path = $upload_dir['path'] . '/' . basename($_FILES['myfile']['name']);
            move_uploaded_file($_FILES['myfile']['tmp_name'], $image_path);
            if($post_id && !empty($image_path)) {
            $attachment = array(
            'guid'           => $image_path,
            'post_mime_type' => mime_content_type($image_path),
            'post_title'     => basename($image_path),
        );
        $attach_id = wp_insert_attachment($attachment, $image_path, $post_id);
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata($attach_id, $image_path);
        wp_update_attachment_metadata($attach_id, $attach_data);
        set_post_thumbnail($post_id, $attach_id);// Add image URL as post meta
        add_post_meta($post_id, '_post_image_url', $upload_dir['url'] . '/' . basename($image_path));
        add_post_meta($post_id, 'location', $author_des);    

        //Send data on Email
        $to = 'info@andrewr189.sg-host.com, dev.team2080@gmail.com';
        $subject = "New Reviews";
        $message = "<table>
        <tr>
        <td><strong>You have a new review please gothrough the reviews and approve this.</strong></td>
        </tr>        
        <tr>
        <td>Name: ".$post_title."</td>
        </tr>
        <tr>
        <td>Designation: ".$author_des."</td>
        </tr>
        <tr>
        <td>Message: ".$post_content."</td>
        </tr>
        <tr>
        <td><strong>Website Url</strong> : ".get_site_url() ."</td>
        </tr>
        </table>";
         $header = "From:info@andrewr189.sg-host.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $retval = wp_mail ($to,$subject,$message,$header);
        }
    if ($retval) {
        echo '<script>alert("Thanks. your Review is posted successfully")</script>';
    } else {
        echo '<script>alert("Message could not be sent.")</script>';
        }
    }
}
