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

</div> <!-- /end container-fluid -->
<div class="clearfix"></div>
                    <hr>            
<footer>
<?php foreach ($footer_links as $link){ ?>
<p style="text-align:center;">
<div class="span2" style="text-align: center;"><a href="<?php echo base_url('home/content'); ?><?php echo "/".$link['url'];  ?>"><?php echo $link['page_title']; ?></a></div></p>
<?php } ?>
                <br /><p style="text-align:center;">Copyright (c) 2013, 3D Crossing. All rights reserved.</p> 
            </footer>
   </div>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
       
        <?php echo add_jscript('bootstrap.js'); ?>
        <?php echo add_jscript('script.js'); ?>
        <?php //echo add_jscript('jquery.raty.min.js'); ?>
        <?php //echo add_jscript('bootstrap-scrollspy.js'); ?>

    </body>
</html>
