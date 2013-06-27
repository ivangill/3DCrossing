<html lang="en"> 
<head>
        <meta charset="utf-8">
        <title>3D Crossing</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Arfeen Arif -- arfeen@pwoxisolutions.com">

        <!-- Le styles -->
       <?php echo add_style('bootstrap.css'); ?>
       <?php echo add_style('style.css'); ?>
       <?php echo add_style('bootstrap-datetimepicker.min.css'); ?>
      

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <?php if(isset($enable_editor) && $enable_editor==1) {?>
	<?php echo add_jscript('tiny_mce/tiny_mce.js'); ?>
	
	
	<script type="text/javascript">
tinyMCE.init({
       // General options
       mode: "textareas",
       theme: "advanced",
       width: "780",
       height: "400",

       // Theme options
       theme_advanced_buttons1 : "fullscreen,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,code,forecolor,backcolor",
       theme_advanced_buttons2: "",
       theme_advanced_buttons3: "",
       theme_advanced_buttons4: "",
       theme_advanced_toolbar_location: "top",
       theme_advanced_toolbar_align: "left",
       theme_advanced_resizing: false,

   // Selector
       editor_selector: "ckeditor",

});
</script>
	<?php }?>
	
<script type="text/javascript">
  $(document).ready(function() {
    $('#start_date').datetimepicker({
            pickTime: false,
    });
  });
</script>
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    </head>