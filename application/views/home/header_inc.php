 <?php echo add_jscript('libs/jquery.js'); ?> 
 <?php echo add_jscript('libs/jquery.MetaData.js'); ?> 
 <?php echo add_jscript('libs/jquery.rating.js'); ?> 
 
 <?php echo add_jscript('nod.js'); ?>
 

  <?php if(isset($rating) && $rating == 1){ ?>
	<script type="text/javascript">
/*$(document).ready(function()
{
$(function() {
    $("div.star-rating > s").on("click", function(e) {
        var numStars = $(e.target).parentsUntil("div").length+1;
        if(numStars==1){ 
        $("div.star-rating > s").addClass("rated");
        $("div.star-rating > s > s").removeClass("rated");
        $("div.star-rating > s > s > s").removeClass("rated");
        $("div.star-rating > s > s > s > s").removeClass("rated");
        $("div.star-rating > s > s > s > s > s").removeClass("rated");
        } else if (numStars==2){
        	$("div.star-rating > s").addClass("rated");
        	$("div.star-rating > s > s").addClass("rated");
        	$("div.star-rating > s > s > s").removeClass("rated");
       		$("div.star-rating > s > s > s > s").removeClass("rated");
            $("div.star-rating > s > s > s > s > s").removeClass("rated");
        } else if (numStars==3){
        	$("div.star-rating > s").addClass("rated");
        	$("div.star-rating > s > s").addClass("rated");
        	$("div.star-rating > s > s > s").addClass("rated");
        	$("div.star-rating > s > s > s > s").removeClass("rated");
            $("div.star-rating > s > s > s > s > s").removeClass("rated");
        } else if (numStars==4){
        	$("div.star-rating > s").addClass("rated");
        	$("div.star-rating > s > s").addClass("rated");
        	$("div.star-rating > s > s > s").addClass("rated");
        	$("div.star-rating > s > s > s > s").addClass("rated");
        	 $("div.star-rating > s > s > s > s > s").removeClass("rated");
        } else if (numStars==5){
        	$("div.star-rating > s").addClass("rated");
        	$("div.star-rating > s > s").addClass("rated");
        	$("div.star-rating > s > s > s").addClass("rated");
        	$("div.star-rating > s > s > s > s").addClass("rated");
        	$("div.star-rating > s > s > s > s > s").addClass("rated");
        }
       
        var myData = 'ratings='+numStars;
         //alert(myData);
  		$.ajax({
	     type: 'POST',
	     url: "<?php echo base_url('shop/product_detail/'.$get_product_by_id['_id']); ?>", 
	     data: myData,
	     cache: false,
		 async:false,
	     success: function(ratings){
	    	}
	   });
   
   
    });
});



});*/
</script>
<script type="text/javascript">	
$(function() {
        $(".star").click(
        function() {
        	var myvalue=$("#myform input[type='radio']:checked").val();
        	var myData = 'ratings='+myvalue;
        // alert(myData);
  		$.ajax({
	     type: 'POST',
	     url: "<?php echo base_url('shop/product_detail/'.$get_product_by_id['_id']); ?>", 
	     data: myData,
	     cache: false,
		 async:false,
	     success: function(ratings){
	     	
	    	}
	   });
            
        });
    });
</script>
	
<?php }?>


 <?php if(isset($like_and_favourite) && $like_and_favourite == 1){ ?>

<script type="text/javascript">
$(document).ready(function()
{
$('.votebutton').on("click", function(){
  vote = $(this).attr("value");
  //article = $(this).attr("data-article");
 // alert(vote);
  likeProduct(vote);
})


function likeProduct(vote){ 
  var mydata = 'vote='+vote;
  $.ajax({
     type: 'POST',
     url: "<?php echo base_url('shop/product_detail/'.$get_product_by_id['_id']); ?>", 
     data: mydata,
     cache: false,
	 async:false,
     success: function(vote){
               
    	}
   });
}

});



$(document).ready(function()
{
$('.favouritebutton').on("click", function(){
  favourite = $(this).attr("value");
  //article = $(this).attr("data-article");
 // alert(favourite);
  favouriteProduct(favourite);
})


function favouriteProduct(favourite){ 
  var myData = 'favourite='+favourite;
  $.ajax({
     type: 'POST',
     url: "<?php echo base_url('shop/product_detail/'.$get_product_by_id['_id']); ?>", 
     data: myData,
     cache: false,
	 async:false,
     success: function(favourite){
    	}
   });
}

});
</script>

<?php }?>
<script type="text/javascript">	
			
$(document).ready(function() {        
		$('#success').fadeIn("slow").delay(4500).fadeOut("slow");
		$('#error').fadeIn("slow").delay(4500).fadeOut("slow");
});
</script>


        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->