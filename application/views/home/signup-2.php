
<?php $this->load->view( 'home/header.php' ); ?>
<div class="container" style="margin-top:100px;">

Hi <?php echo $this->session->userdata('email'); ?>
      <form class="form-signin" method="POST" action="<?php echo base_url('home/signin'); ?>">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" required="required" name="email" class="input-block-level" placeholder="Email address">
        <input type="password" required="required" name="password" class="input-block-level" placeholder="Password">
        <button class="btn btn-large btn-primary" type="Sign up">Sign up</button>
      </form>

    </div> <!-- /container -->