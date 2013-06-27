
 <?php echo add_jscript('libs/jquery.js'); ?> 
  <?php if(isset($rating) && $rating == 1){ ?>
	<script type="text/javascript">
$(document).ready(function()
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

<style>
            body {
      padding-bottom: 40px;
      color: #5a5a5a;
    }

#success, #error {
  border: 1px solid;
  padding:10px;
  width:70%;
}
#success {
  color: #4F8A10;
  position:absolute;
  background-color: #DFF2BF;
  margin-top:-50px;
  
}
#error {
  color: #D8000C;
  position:fixed;
  background-color: #FFBABA;
  margin-top:-50px;
  
}

    /* CUSTOMIZE THE NAVBAR
    -------------------------------------------------- */

    /* Special class on .container surrounding .navbar, used for positioning it into place. */
    .navbar-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      z-index: 10;
      margin-top: 20px;
      margin-bottom: -90px; /* Negative margin to pull up carousel. 90px is roughly margins and height of navbar. */
    }
    .navbar-wrapper .navbar {

    }

    /* Remove border and change up box shadow for more contrast */
    .navbar .navbar-inner {
      border: 0;
      -webkit-box-shadow: 0 2px 10px rgba(0,0,0,.25);
         -moz-box-shadow: 0 2px 10px rgba(0,0,0,.25);
              box-shadow: 0 2px 10px rgba(0,0,0,.25);
    }

    /* Downsize the brand/project name a bit */
    .navbar .brand {
      padding: 14px 20px 16px; /* Increase vertical padding to match navbar links */
      font-size: 16px;
      font-weight: bold;
      text-shadow: 0 -1px 0 rgba(0,0,0,.5);
    }

    /* Navbar links: increase padding for taller navbar */
    .navbar .nav > li > a {
      padding: 15px 20px;
    }

    /* Offset the responsive button for proper vertical alignment */
    .navbar .btn-navbar {
      margin-top: 10px;
    }



    /* CUSTOMIZE THE CAROUSEL
    -------------------------------------------------- */

    /* Carousel base class */
    .carousel {
      margin-bottom: 60px;
    }

    .carousel .container {
      position: relative;
      z-index: 9;
    }

    .carousel-control {
      height: 80px;
      margin-top: 0;
      font-size: 120px;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
      background-color: transparent;
      border: 0;
      z-index: 10;
    }

    .carousel .item {
      height: 500px;
    }
    .carousel img {
      position: absolute;
      top: 0;
      left: 0;
      min-width: 100%;
      height: 500px;
    }

    .carousel-caption {
      background-color: transparent;
      position: static;
      max-width: 550px;
      padding: 0 20px;
      margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead {
      margin: 0;
      line-height: 1.25;
      color: #fff;
      text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn {
      margin-top: 10px;
    }



    /* MARKETING CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .marketing .span4 {
      text-align: center;
    }
    .marketing h2 {
      font-weight: normal;
    }
    .marketing .span4 p {
      margin-left: 10px;
      margin-right: 10px;
    }


    /* Featurettes
    ------------------------- */

    .featurette-divider {
      margin: 80px 0; /* Space out the Bootstrap <hr> more */
    }
    .featurette {
      padding-top: 120px; /* Vertically center images part 1: add padding above and below text. */
      overflow: hidden; /* Vertically center images part 2: clear their floats. */
    }
    .featurette-image {
      margin-top: -120px; /* Vertically center images part 3: negative margin up the image the same amount of the padding to center it. */
    }

    /* Give some space on the sides of the floated elements so text doesn't run right into it. */
    .featurette-image.pull-left {
      margin-right: 40px;
    }
    .featurette-image.pull-right {
      margin-left: 40px;
    }

    /* Thin out the marketing headings */
    .featurette-heading {
      font-size: 50px;
      font-weight: 300;
      line-height: 1;
      letter-spacing: -1px;
    }



    /* RESPONSIVE CSS
    -------------------------------------------------- */

    @media (max-width: 979px) {

      .container.navbar-wrapper {
        margin-bottom: 0;
        width: auto;
      }
      .navbar-inner {
        border-radius: 0;
        margin: -20px 0;
      }

      .carousel .item {
        height: 500px;
      }
      .carousel img {
        width: auto;
        height: 500px;
      }

      .featurette {
        height: auto;
        padding: 0;
      }
      .featurette-image.pull-left,
      .featurette-image.pull-right {
        display: block;
        float: none;
        max-width: 40%;
        margin: 0 auto 20px;
      }
    }


    @media (max-width: 767px) {

      .navbar-inner {
        margin: -20px;
      }

      .carousel {
        margin-left: -20px;
        margin-right: -20px;
      }
      .carousel .container {

      }
      .carousel .item {
        height: 300px;
      }
      .carousel img {
        height: 300px;
      }
      .carousel-caption {
        width: 65%;
        padding: 0 70px;
        margin-top: 100px;
      }
      .carousel-caption h1 {
        font-size: 30px;
      }
      .carousel-caption .lead,
      .carousel-caption .btn {
        font-size: 18px;
      }

      .marketing .span4 + .span4 {
        margin-top: 40px;
      }

      .featurette-heading {
        font-size: 30px;
      }
      .featurette .lead {
        font-size: 18px;
        line-height: 1.5;
      }

    }
    </style>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->