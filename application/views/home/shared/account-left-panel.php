<div class="span2">
<ul class="nav nav-tabs nav-stacked">
<li <?php if ($this->uri->segment(2)=="my_account") { ?> class="active" <?php } ?>><a href="<?php echo base_url('member/my_account'); ?>">My Account</a></li>
<li <?php if ($this->uri->segment(2)=="edit_account") { ?> class="active" <?php } ?>><a href="<?php echo base_url('member/edit_account'); ?>">Edit My Account</a></li>
<li <?php if ($this->uri->segment(2)=="change_password") { ?> class="active" <?php } ?>><a href="<?php echo base_url('member/change_password'); ?>">Change Password</button></a></li>
<li <?php if ($this->uri->segment(2)=="my_payment_account") { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/my_payment_account'); ?>">Payments(Credit Card)</button></a></li>
<li <?php if ($this->uri->segment(2)=="setup_transaction_account") { ?> class="active" <?php } ?>><a href="<?php echo base_url('home/setup_transaction_account'); ?>">Payments(Withdraw Account)</button></a></li>

</ul>
 </div>