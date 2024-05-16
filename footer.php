<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!-- Start footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="companyinfo">
                    <div class="logo">
                        <a href="<?= get_site_url(); ?>">
                            <?php 
                            $logoimg = get_field('logo_image', 'option');
                            if(!empty($logoimg)){
                            ?>
                            <img src="<?= $logoimg; ?>" alt="Footer Logo" />
                        <?php } ?>
                        </a>
                    </div>
                    <div class="contactinfo">
                        <ul>
                            <?php 
                            $i = 1;
                            $contact = get_field('contact_information', 'option');
                            if(!empty($contact)){
                                foreach($contact as $contactItem){
                                    $i++;
                            ?>
                            <li>
                                <?php 
                                $Address = $contactItem['footer_address']; 
                                if($Address){
                                ?>
                                <a href="<?= esc_url($Address['url']); ?>"><img
                                        src="<?= $contactItem['conatct_icon']; ?>"
                                        alt="Icon-<?= $i; ?> " /><?= esc_html($Address['title']); ?></a>
                                <?php } ?>
                            </li>
                           
                        <?php } } ?>
                        </ul>
                    </div>
                    <div class="sociallink">
                        <ul>
                            <?php 
                            $sociallink = get_field('sociallink', 'option');
                            if($sociallink){
                                foreach($sociallink as $socialItem){
                            ?>
                            <li>
                                <a href="<?= $socialItem['social_url']; ?>" target="_blank"><img
                                        src="<?= $socialItem['social_icon']; ?> "
                                        alt="facebook" /></a>
                            </li>
                        <?php } } ?>                           
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footerlink">
                    <div class="title">
                        <h3><?= !(empty(get_field('title', 'option'))) ? get_field('title', 'option') : ''; ?></h3>
                    </div>
                    <div class="link">
                        <ul>
                            <div class="row">
                                <div class="col-6">
                                    <?php 
                                    $left_menu = get_field('left_menu', 'option');
                                    if(!empty($left_menu)){
                                        foreach($left_menu as $menuItem){
                                        $l_Item = $menuItem['menu_item'];
                                        if($l_Item){
                                    ?>
                                    <li>
                                        <a href="<?= esc_url($l_Item['url']); ?>"><?= esc_html($l_Item['title']); ?></a>
                                    </li>
                                    <?php } } } ?>
                                    
                                </div>
                                <div class="col-6">
                                    <?php 
                                    $right_menu = get_field('right_menu', 'option');
                                    if(!empty($right_menu)){
                                        foreach($right_menu as $rmenuItem){
                                        $R_Item = $rmenuItem['menu_item'];
                                        if($R_Item){
                                    ?>
                                    <li>
                                        <a href="<?= esc_url($R_Item['url']); ?>"><?= esc_html($R_Item['title']); ?></a>
                                    </li>
                                    <?php } } } ?>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footerlink">
                    <div class="title">
                        <h3><?= !(empty(get_field('Instatitle', 'option'))) ? get_field('Instatitle', 'option') : ''; ?></h3>
                    </div>
                    <div class="instagram">
                        <div class="row">
                            <?php 
                                $insta = get_field('instagram', 'option');
                                if($insta){
                                    foreach($insta as $instaItem){
                            ?>
                            <div class="col-xl-3 col-md-4 col-4">
                                <div class="single">
                                    <a href="<?= $instaItem['instagram_url']; ?>"><img src="<?= $instaItem['instagram_image']; ?>" alt="Instagram Image" />
                                    </a>
                                </div>
                            </div>
                            <?php } } ?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <p><?= !(empty(get_field('copyright_text', 'option'))) ? get_field('copyright_text', 'option') : ''; ?></p>
        </div>
    </div>
</footer>
<!-- End footer -->
<?php wp_footer(); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/plugin/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/script/script.js"></script>
<script>
    var swiper = new Swiper(".thrillSwiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".thrill-swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            460: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 40,
            }
        },
    });
</script>
<script>
    var swiper = new Swiper(".testimonialSwiper", {
        slidesPerView: 2,
        spaceBetween: 40,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".testimonial-swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            460: {
                slidesPerView: 2,
                spaceBetween: 40,
            }
        },
    });
</script>
<script>

jQuery('<i class="fa fa-angle-down"></i>').insertAfter('.has-child > a');
   jQuery('.has-child .fa').click(function(e) {
    e.preventDefault();
  jQuery(this).siblings('.child_drop').toggle();
  jQuery(this).toggleClass('icon-acive');  
})
</script>
<script>
    jQuery(document).ready(function($) {
      // Function to get URL parameter by name
      var pathName = window.location.pathname
      if(pathName == '/gold-coast/'){
        $('[name="location"]').val("Gold Coast");
      }
     // var pathName1 = window.location.hash;
     // if(pathName1 == '#60'){
     //    $('[name="TimeFrame"]').val("60 minutes");
     //  }
jQuery(".waterbike_contbk a").click(function(){
    const Saved = '60';
    localStorage.setItem('book_time', Saved);
  
});
    const GetbookTime = localStorage.getItem('book_time');
    if(GetbookTime == "60"){
        $('[name="TimeFrame"]').val("60 minutes");
        localStorage.removeItem('book_time');
    }

$("#productSelect").change(function(){
    let categoryId = $(this).val();
    //console.log(categoryId);
     if (categoryId) {
      $.ajax({
        url: '<?= admin_url('admin-ajax.php');?>', // Replace with actual URL to fetch products based on category
        method: 'POST',
        dataType: "json",
        data: {action: "getproductlist",categoryId: categoryId },
        success: function(response) {
          let products = response.data.data;
          //console.log(products);
         $('#productlistItem').html(products);

        }
       
      });
    }
})

$("#productForm").on("submit",function(e){
    e.preventDefault();
    let customerName = $("#yourname").val();
    let customerPhone = $("#phonenumber").val();
    let bookdate = $("#date").val();
    let bookTime = $("#time").val();
    let bookLocation = $("#location").val();
    let bikeType = $("#productSelect").val();
    let productId = $("#productlistItem").val();
    //console.log(productId);
    let bikeQuantity = $("#bikequantity").val();
    let customerComment = $("#w3review").val();

    let productdata ={action: "addtocartproduct",customerName:customerName,customerPhone:customerPhone,bookdate:bookdate,bookTime:bookTime,bookLocation:bookLocation,bikeType:bikeType,productId:productId,bikeQuantity:bikeQuantity,customerComment:customerComment};
        $.ajax({
        url: '<?= admin_url("admin-ajax.php");?>', // Replace with actual URL to fetch products based on 
        method: 'POST',
        dataType:'json',
        data: productdata,
        success: function(response){
            //console.log(response);
            var checkoutUrl = response.data.checkout_url;
            window.location.href = checkoutUrl; // Redirect to checkout page
            },
            error: function(xhr, status, error) {
                // Handle error
            console.error(error);            
        }
       
      });
    })

    });
  </script>
<div class="reviews_model_pop">
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form method="POST" id="mpost" enctype="multipart/form-data">
	          <div class="mb-3">
	            <label for="your-name" class="col-form-label">Your name</label>
	            <input type="text" class="form-control" name="your_name" id="your-name" required>
	          </div>
	          <div class="mb-3">
	            <label for="designation" class="col-form-label">Designation</label>
	            <input type="text" name="designation" class="form-control" id="designation" required>
	          </div>
	          <div class="mb-3">
	            <!-- <label for="file" class="col-form-label">Select a file:</label> -->
	            <input type="file" id="myfile" name="myfile" required>
	          </div>
	          <div class="mb-3">
	            <label for="message-text" class="col-form-label">Message:</label>
	            <textarea class="form-control" name="review_msg" id="message-text" required></textarea>
	          </div>	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary" name="submit_review">Send message</button>
	      </div>
          </form>
	    </div>
	  </div>
	</div>
</div>

</body>

</html>