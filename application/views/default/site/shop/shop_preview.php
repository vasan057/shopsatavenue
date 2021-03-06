<?php  
$this->load->view('site/templates/commonheader'); 
$this->load->view('site/templates/shop_header'); 
?>
<?php if(isset($active_theme) &&  $active_theme->num_rows() !=0) {?>
<link href="./theme/themecss_<?php echo $active_theme->row()->id; ?>Shop-page.css" rel="stylesheet">
<?php } ?>
<?php $shop_name=trim(stripslashes($selectSeller_details[0]['seller_businessname'])); $seourl=$selectSeller_details[0]['seourl'] ?>
		
<link rel="stylesheet" href="css/default/front/main.css">

<div class="clear"></div>
<div id="shop_page_seller">
<section class="container">

	<div class="main">
		
		<ul class="bread_crumbs">
        	<li><a href="<?php echo base_url(); ?>" class="a_links">Home</a></li>
            <span>&rsaquo;</span>
           <li><a href="shop/sell" class="a_links">Your shop</a></li>
        </ul>
		
       	<div  class="shop_view">
			<div class="shop-main-1">
                <div class="shop_view_right">

                    <!---  Shop Owner section Ends---->
					</div>
                	   <div class="shopview_info shop-detail" style="text-align:center; margin-bottom:0; background:#fff;">                
                    	<?php if($selectSeller_details[0]['seller_store_image']!=""){ ?>  
                         
							<div class="shp-sell-banner">
                            <a href="shop/sell">
                                <img src="images/store-banner/<?php echo $selectSeller_details[0]['seller_store_image']; ?>" width="1000px" height="315px">
                            </a>
							</div>
                        <?php } else { ?> 
							<div class="shp-sell-banner">
								<a href="appearance/<?php echo $seourl; ?>/banner"> 
								<div class="shopview_info shop-detail" style="text-align:center; height:100px; margin-bottom:0;">                       
								<p style="margin:35px 0 0px;"><?php if($this->lang->line('shop_addbanner') != '') { echo stripslashes($this->lang->line('shop_addbanner')); } else echo 'Add shop banner'; ?></p>
								</div>
								</a>
							</div>
                        <?php } ?>
							
						<div class="shop_view_left1">
                    
                    <!--- Shop Owner section Starts---->
						<?php 
                        if($selectUser_details[0]['thumbnail']!="" && $selectUser_details[0]['full_name']!="" && $selectUser_details[0]['city']!="")
                        { 
                        	echo '<div class="shopview_info profile-info-img">';
                        } 
                        else 
                        { 
                        	echo '<div class="shopview_info profile-info-img">'; 
                        } 
                        ?>
                    	<?php if($selectUser_details[0]['thumbnail']!=""){ $Pro_pic=$selectUser_details[0]['thumbnail']; }else { $Pro_pic='profile_pic.png';} ?>
						
                        <div style="float:left; width:100%; margin:0" >
                        	<a  style="cursor:default;float:left; width:100%; "><img src="images/users/thumb/<?php echo $Pro_pic; ?>"  /></a>
                            <?php if($selectUser_details[0]['thumbnail']==""){ ?>
                            <a href="shops/<?php echo $seourl; ?>/profile" style="float:left;  text-align: center; margin:8px 0 0 px; width:100%; line-height:normal; font-size:12px;">Add profile picture</a>
                            <?php } ?>
                        </div>
                        <a  style="cursor:default;float:left; text-align: center; font-size:12px; color:#666666; width:100%; font-weight:bold"><?php echo $selectUser_details[0]['full_name']; ?></a>
                        
                    </div>
							
					</div></div>		
							<div class="shop_view_text">
								<a style="cursor:default;font-size:14px; font-weight:bold; line-height:24px; float:left;  text-decoration:none;">
								<?php  echo stripslashes($selectSeller_details[0]['seller_businessname']); ?>
								</a>
								<div class="opented" style="font-size:11px; color:#fff;">Opened on <?php echo substr($selectSeller_details[0]['created'],0,10); ?></div>
							</div>
							<div class="shop-owner-text">
								<ul><li>
								<a href="appearance/<?php echo $seourl; ?>/banner" class="inline-edit-link" style="font-size:15px; font-weight:bold;">Edit</a> 
								</li></ul>
							</div>
							 <!--- Shop Policy section Starts---->
                    <?php if($selectSeller_details[0]['welcome_message']!="" && $selectSeller_details[0]['payment_policy']!="" && $selectSeller_details[0]['shipping_policy']!="" && $selectSeller_details[0]['refund_policy']!="" && $selectSeller_details[0]['additional_information']!="" && $selectSeller_details[0]['seller_information']!="" ){ ?>
                    
                    <div id="shop-info" class="shopview_info">
                    	<ul>
							<li>
								<a href="policies/<?php echo $seourl; ?>/shop-policy" style="float:left; margin:0 0 0 10px">Edit</a>
							</li>
                            <li class="policies">
                                <a href="policies/<?php echo $seourl; ?>/shop-policy"><?php if($this->lang->line('shopsec_policy') != '') { echo stripslashes($this->lang->line('shopsec_policy')); } else echo 'Policies'; ?></a>
                            </li>
                            <li class="seller_info">
                                    <a href="policies/<?php echo $seourl; ?>/Seller-Information">Seller Information</a>
                            </li>  
                        </ul>
                    </div>
                    
                    <?php } else { ?>
                    
                    <div id="shop-info" class="shopview_info">
                    	<ul>
                    	<li><a href="policies/<?php echo $seourl; ?>/shop-policy">Add shop policies</a></li>
						</ul>
                    </div>
                    <?php } ?>							
                    
                    <div class="list_wrap">
                    	<?php  if($this->uri->segment(2) == 'sell')
							{
								$this->load->view('site/shop/shop_listings');
							} else  if($this->uri->segment(2) == 'reviews')
							{
								$this->load->view('site/shop/shop_reviews');
							}else{
								$this->load->view('site/shop/shop_listings');
							}
						?>
                    </div>
                </div>
				 </div>
				
            </div>
         
       
        </section>
       </div>
<input type="hidden" name="sell_id" id="sell_id" value="<?php echo $selectSeller_details[0]['seller_id']?>">

	<a href="#shop_review_popup" class="contact-popup" id="review_popup_link"  data-toggle="modal"></a>
	
    <div id='shop_review_popup' class="modal fade in language-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div id='reportReview'>
					        
				</div>
			</div>
		</div>
	</div>

 <script src="js/jquery.colorbox.js"></script>
<script>
$(document).ready(function(){
  $('#giftcardstatus').css('display','none');
});  

$(document).ready(function(){

		$(".cboxClose1").click(function(){
			$("#cboxOverlay,#colorbox").hide();
			});
		//Example of preserving a JavaScript event for inline calls.
			$("#onLoad").click(function(){ 
				$('#onLoad').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});

});
</script>


<style>

#cboxLoadedContent{background:none;}
.shop-owner-text {width:8% ;} 
.shop-owner-text ul li a {width:100%; margin-right:30px;}
</style>


<?php 
//$this->load->view('site/shop/sms_verification');
$this->load->view('site/templates/footer');
?>