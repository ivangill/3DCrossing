

<?php $this->load->view( 'admin/shared/header' ); ?>
<body class="fullscreen" style="padding-top:20px;">

        <div class="container-fluid">

            <div class="row-fluid">
                <div class="span4"></div>
                <div class="span4"><!-- Login Form -->
<form action="<?php echo base_url('administration/login/authenticate'); ?>" method="post" accept-charset="utf-8" class="well"><h2>Please login</h2>


<!-- Notification -->
<?php echo $this->session->flashdata('response'); ?>
<!-- /Notification -->

<input type="text" name="username" value="" required="required" id="username" class="input-block-level" placeholder="Email Username"><input type="password" required="required" name="password" value="" id="password" class="input-block-level" placeholder="Password">
    <button type="submit" class="btn btn-primary">Login</button>
<a href="<?php echo base_url('administration/login/forgot_password'); ?>">Forgot Password?</a>

</form><!-- /Login Form -->

</div>
                <div class="span4"></div>
            </div>

            <hr>

<?php $this->load->view( 'admin/shared/footer' ); ?>
    
 