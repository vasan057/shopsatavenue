<?php $this->load->view('site/templates/commonheader'); ?>
<link rel="stylesheet" href="<?php echo base_url();?>css/product-detail.css" type="text/css" >

<script type="text/javascript" >
$(document).ready(function(e) {
});

</script>

<?php $this->load->view('site/templates/header2'); ?>

<?php 
	$this->load->model('user_model');
	$this->load->model('product_model');

	$c_url=current_url();  
	
	if($this->input->get('item') != ''){
	$s_key='item='.$this->input->get('item');;
	} else { $s_key ='';}
	
   if($this->input->get('order') != ''){
	   $order='&order='.$this->input->get('order');
	   $orderVal=$this->input->get('order');
   } else {
	   $order=''; $orderVal='';
   }
 ?>
	<div class="container">
	<section class="pricing" >
    
			<div class="row">
				<div class="pricing-wrapper">
				<?php 
                    if(!empty($product_list)) { 
                        $i=0;
                        foreach( $product_list as $proddetails ) {
                        $imgSplit = explode(",",$proddetails['image']); 
                        $shopDet = $this->product_model->get_business_name($proddetails['user_id']);
                        if( ! empty($imgSplit[0]) ) { 
                            $image = 'images/product/' . $proddetails['id'] . '/mb/thumb/' . stripslashes($imgSplit[0]); 
                        } else { 
                            $image = "images/noimage.jpg";  
                        }
                ?>
					<div class="col-md-3 col-sm-6" >
						<div class="pricing-table" >
							<div class="pricing-img">
                                <a href="products/<?php echo $proddetails['seourl'];?>" class="image" ><img src="<?php echo $image; ?>" alt="" /></a>
							</div>
							<h5 style="margin-top:10px;"><?php echo $proddetails['product_name']?></h5>
							<p style="margin-top:10px;"><?php echo ($proddetails['price'] != 0.00) ? '$' . number_format($currencyValue*$proddetails['price'],2) : '$' . number_format($currencyValue*$proddetails['base_price'],2) . '+';?></p>
							<button type="submit" class="button" style="margin-top:12px;" onclick="show_product('<?php echo $proddetails['seourl'];?>', this);">
                            <i class="fa fa-shopping-cart" style="padding-right:10px;"></i>Add to Cart
                            </button>

                            <a href="" class="inline-heart_home is-unloved">
                            <span class="inline-heart-hover">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </span>
                        </a>




						</div><!-- pricing-table -->
					</div>


				<?php $i++; if($i%4==0){ echo "<div style='clear:both'></div>"; } } //endforeach; ?>
                <?php } ?>
				</div><!-- pricing-wrapper -->
			</div>

               <div class="dish-btn" style="margin-bottom:20px;" >
                    <form name="form-load-products" action="" method="post" >
                       <input type="hidden" name="page_no" value="<?php echo ($page_no+1);?>"  >
                       <input type="hidden" name="total_pages" value="<?php echo $total_pages;?>" >
                       <button type="submit" name="btn-submit" value="submit" class="button" >Shop More Products</button>
                    </form>
               </div>
            

	</section>

<!-- popup prdduct modal -->
  <div class="modal" id="product_modal" role="dialog"  style="width:860px !important; margin:0 auto;overflow-y: scroll; overflow-x:hidden;   max-height:85%; margin-top: 72px; margin-bottom:50px;" >
      <div class="modal-content">
            <div id="close-product-detail-modal" class="close-modal" onclick="$('#product_modal').modal('hide');" >
            <i class="fa fa-window-close fa-2x" aria-hidden="true" style="color:#fff; float:right; padding-top:53px; width:60px;"></i>
            </div>
		  <div id="product-popup">
          </div>
      </div>
  </div>

	</div>
    <!-- container -->
            
	
<script>

$( document ).on( 'click', ".price_info span i",  function () {
		$('#price_details').slideToggle();
		if ( $('.price_info span i').hasClass('fa-angle-double-down') ) {
			$('.price_info span i').removeClass('fa-angle-double-down').addClass('fa-angle-double-up');
		} else {
			$('.price_info span i').removeClass('fa-angle-double-up').addClass('fa-angle-double-down');
		}
	} );   


//$( "#close-product-detail-modal" ).click(function() {
//$('#close-product-detail-modal').on('click', function() {
  //$('#product_modal').modal('hide');
//});

function show_product( product_url, obj ) {

	//$('#product_modal').modal('show');

	/*$('#spinner').show();*/
	$.ajax({
		url: 'products/ajax/' + product_url, 
		success: function(result){
			$("#product_modal .modal-content #product-popup").html( result );
			//$('#spinner').hide();
			alert( result );
			$('#product_modal').modal('show');
		}
	});
}

</script>

<script type="text/javascript">

function addFavoriteItem( obj ) {
	//alert( $(obj).closest('div').data('seller-id') );
	$( obj ).removeClass('is-unloved');
}
function ajax_add_cart_new() {

	$('.error-msg').remove();
	
	if( $('input[type=radio][name=var_color_1]').length > 0 && $('input[type=radio][name=var_color_1]:checked').length == 0 ) {
		$('#color_wrapper').append('<div class="error-msg">Select Color</div>');
		return false;
	}
	var data = $('select[name=quantity], #product_id, #seller_id, #price ').add('input[type=radio][name=var_color_1]:checked' );

		$.ajax({
			type: 'POST',
			url: baseURL+'site/cart/userAddToCart',
			data: $( data ).serialize() + "&mqty=" + $('#quantity_list').data('mqty') + "&shop_name=<?php echo $selectedSeller_details[0]['seller_businessname'];?>" ,
			success: function(response){
				var arr = response.split('|');
				if(arr[0] =='login'){
					window.location.href= baseURL+"login";	
				}else if(arr[0] == 'Error'){
					if($.isNumeric(arr[1])==true){
						$('#ADDCartErr').html('<font color="red">Maximum Purchase Quantity: '+mqty+'. Already in your cart: '+arr[1]+'.</font>');
					}else{
						$('#ADDCartErr').html('<font color="red">'+arr[1]+'.</font>');
					}					
						$('#ADDCartErr').show().delay('2000').fadeOut();
				}else{
					//alert(arr[1]);
					$('#CartCount').html(arr[1]);
					$('.CartCount1').html(arr[1]);
					$('#product_add_cart').trigger('click');
				}
		
			}
		});
		return false;
		
}

</script>


<?php $this->load->view('site/templates/footer');?>
