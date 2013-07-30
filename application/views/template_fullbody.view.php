<?php $this->load->view( 'home/header.php' ); ?>

 



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item active">
         <?php echo img_tag('icons/slider.png'); ?>
         
        </div>
        <div class="item">
         <?php echo img_tag('icons/slider2.png'); ?>
        </div>
        <div class="item">
         <?php echo img_tag('icons/slider.png'); ?>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
    </div><!-- /.carousel -->

    <?php
  
 /*   $top_product= $this->mongo->db->selectCollection("product_ratings")->aggregate(array('$group' => array('_id'=>'$productid','count'=>array('$sum'=>1))),array('$sort'=>array('count'=>-1)));

    $count_product_rating=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$group' => array('_id'=>'$productid','count'=>array('$sum'=>1))),array('$sort'=>array('count'=>1)));
    
    //$count_products=$this->mongo->db->command(array("distinct" => "product_ratings", "key" => "productid"));
    $count_distinct_products=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$group' => array('_id'=>'$productid')),array('$group'=> array('_id'=> 1, 'count'=>array('$sum'=>1) )));
//var_dump($count_distinct_products);
$count=$count_distinct_products['result'][0]['count'];
//$i=0;
foreach ($count_product_rating as $rating){
	for ($i=0; $i<$count; $i++){
	//$i=0;
	//echo $rating[$i]['count'].'<br/>';
	echo $product_id= $rating[$i]['_id'];
	$sum_product_rating=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$match'=>array('productid'=>$product_id)),array('$group' => array('_id'=>'$productid', 'total' => array('$sum'=>'$rating'))));
//$sum_product_rating['result'][0]['total'];
var_dump($sum_product_rating);

$total_rating=$sum_product_rating['result'][0]['total'];
$number_of_ratings=$rating[$i]['count'];
echo $avg_rating=$total_rating/$number_of_ratings;echo "<br />";
if (isset($avg_rating) && $avg_rating >= 3) {
	echo "My rating is gt than 3"; echo "<br />";
}
	} 
//$i++;
}

$sum_product_rating=$this->mongo->db->selectCollection("product_ratings")->
aggregate(array('$group' => array('_id'=>'$productid', 'total' => array('$sum'=>'$rating'))));

    //var_dump($sum_product_rating);
    //var_dump($count_product_rating);
   // var_dump($top_product);
$productid=$top_product['result'][0]['_id'];


$get_product=$this->products->get_product_by_id($productid);*/
 //$this->load->library('mongo');
 //$this->mongo->aggregate();

/*echo "<pre>"; 
print_r($avg_rating);*/
?>
<script language="javascript">
	
	function showDiv(params) {
	
		$('#'+'div'+params).show('slow');
	//document.getElementById('div'+params).style.display = 'block';
	}
	function hideDiv(params) {
		$('#'+'div'+params).hide('slow');
		//document.getElementById('div'+params).style.display = 'none';
	}
	
</script>  
<ul class="thumbnails">
<?php
foreach ($avg_rating['result'] as $rating){
	
	$productid=$rating['_id'];
	$avg_rating=$rating['avgrate'];
	$get_product=$this->products->get_product_by_id($productid);
	
	$memberid=$get_product['member_id'];
	$get_member = $this->home_model->get_member( $memberid );
	
	if ($avg_rating >= 3) {
		echo '<li class="span3 my-img-style">';
		
		//$myimg= $_SERVER['DOCUMENT_ROOT'].'3DCrossing/assets/images/thumbnails/products/homepage/'.$get_product['product_img'];
	    // if (isset($get_product['product_img']) && file_exists($myimg)) {
	     if (isset($get_product['product_img'])) { ?>
	                   
	     <a id="<?php echo $get_product['_id'] ?>" onmouseover="showDiv(id)" onmouseout="hideDiv(id)" href="<?php echo base_url().'shop/product_detail/'.$get_product['_id'] ?>"><?php echo img_tag('thumbnails/products/homepage/'.$get_product['product_img'],'style="height:280px;width:280px"'); ?></a>
	     
	     
	 <?php    } else { ?>
	 	
	<a id="<?php echo $get_product['_id'] ?>" onmouseover="showDiv(id)" onmouseout="hideDiv(id)" href="<?php echo base_url().'shop/product_detail/'.$get_product['_id']; ?>"><?php echo img_tag('icons/no-image-found.jpg','style="height:280px;"');?></a>
<?php  } ?>
	    <div id="<?php echo 'div'.$get_product['_id'] ?>"  style="display:none;height:59px;width:269px;border:0px solid red;margin-top: -60px;float: left;position: absolute;background-image:url('assets/images/icons/mouseover.png');">
	     <span style="font-size: 23px;width: 258px;float: left;margin-left: 10px;margin-top: 10px;color: white;"><?php echo $get_product['product_name'] ?></span><br />
	     <span style="font-size: 13px;color: white;float: left;margin-left: 13px;margin-top: 3px;"><?php echo ucwords($get_member['first_name'].' '.$get_member['last_name']); ?>
	     </span>
	     <span style="float: right;margin-right: 5px;"><?php 
	     if ($avg_rating >0 && $avg_rating < 1.1) {
	     	 echo img_tag('stars-images/1.png');
	     } elseif ($avg_rating >1 && $avg_rating < 1.6){
	     	echo img_tag('stars-images/12.png');
	     } elseif ($avg_rating >1.5 && $avg_rating < 2.1){
	     	echo img_tag('stars-images/2.png');
	     }  elseif ($avg_rating >2 && $avg_rating < 2.6){
	     	echo img_tag('stars-images/8.png');
	     }  elseif ($avg_rating >2.5 && $avg_rating < 3.1){
	     	echo img_tag('stars-images/3.png');
	     }
	     	elseif ($avg_rating >3 && $avg_rating < 3.6){
	     	echo img_tag('stars-images/9.png');
	     }  elseif ($avg_rating >3.5 && $avg_rating < 4.1){
	     	echo img_tag('stars-images/4.png');
	     }  elseif ($avg_rating >4 && $avg_rating < 4.6){
	     	echo img_tag('stars-images/10.png');
	     } elseif ($avg_rating >4.5){
	     	echo img_tag('stars-images/5.png');
	     }
	     ?></span>
	     </div>	
		
	<?php	echo '</li>';
		
	}
	
	
} ?>
</ul>

 
   <!--  <ul class="thumbnails">
     <li class="span3 my-img-style">
     <?php //echo img_tag('icons/robo.png') ?></li>
	  <li class="span3 my-img-style"><?php //echo img_tag('icons/guitar.png') ?></li>
	  <li class="span3 my-img-style"><?php //echo img_tag('icons/klvn.png') ?></li>
	  <li class="span3 my-img-style"><?php //echo img_tag('icons/gear.png') ?></li>
	 <li class="span3 my-img-style"><?php //echo img_tag('icons/skull.png') ?></li>
	 <li class="span3 my-img-style"><?php //echo img_tag('icons/spike.png') ?></li>
	 <li class="span3 my-img-style"><?php //echo img_tag('icons/thingy.png') ?></li>
	 <li class="span3 my-img-style"><?php //echo img_tag('icons/face.png') ?></li>
     </ul>-->
   
      
	<?php $this->load->view( 'home/footer.php' ); ?>
 