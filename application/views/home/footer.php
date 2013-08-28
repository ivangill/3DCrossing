<!--<footer>
        <p class="pull-right"><a href="#">Back to top</a></p>

        <div class="row">
 		 <div class="span2"><a href="#">About</a></div>
 		 <div class="span2"><a href="#">Jobs</a></div>
  		 <div class="span2"><a href="#">Press</a></div>
  		 <div class="span2"><a href="#">terms</a></div>
	  	 <div class="span2"><a href="#">Contacts Us</a></div>
		</div>
      </footer>-->

 </div><!--/container-->
   <div class="footer">
        <div class="footer-top-border"></div>
        <div class="footer-top-border-bottom"></div>
        <div class="footer-first-text pull-left">Create,</div>
        <div class="footer-second-text pull-left">Share,</div>
         <div class="footer-third-text pull-left">Profit</div>
         
          <div class="pull-right navbar" style="width:710px;">
            <ul class="myfooter">
            <?php foreach ($footer_links as $link){ ?>
              <li><a href="<?php echo base_url('p'); ?><?php echo '/'.$link['url'];  ?>"><?php echo $link['page_title']; ?></a></li>
           <?php } ?>
             <div class="footer-copyright">&copy; 2013 3D Crossing</div>
            </ul>
           
          
          </div>
        
    </div> 
<!--<div class="clearfix"></div>
                    <hr>            
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=432731593491158";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->
<!--<footer>

<?php //foreach ($footer_links as $link){ ?>
<p style="text-align:center;">
<div class="span2" style="text-align: center;"><a href="<?php //echo base_url('content'); ?><?php //echo '/'.$link['url'];  ?>"><?php //echo $link['page_title']; ?></a></div></p>
<?php //} ?>
<div class="span4">
<div class="fb-like" data-href="http://3dcrossing.aws.af.cm/" data-send="true" data-width="450" data-show-faces="true"></div>
</div>
                <p style="text-align:center;">Copyright (c) 2013, 3D Crossing. All rights reserved.</p> 
            </footer>
   </div>-->
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
       
        <?php echo add_jscript('bootstrap.js'); ?>
        <?php echo add_jscript('script.js'); ?>
        
        <?php echo add_jscript('jquery.flipster.js'); ?>
         <?php echo add_style('style.css'); ?>
         <?php echo add_style('jquery.rating.css'); ?>
       
        <?php //echo add_jscript('script.js'); ?>
        <?php //echo add_jscript('jquery.raty.min.js'); ?>
        <?php //echo add_jscript('bootstrap-scrollspy.js'); ?>

    </body>
</html>
