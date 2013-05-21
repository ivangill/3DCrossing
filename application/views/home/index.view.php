<!-- Login Form -->
<?php
if ($this->session->flashdata('success'))
{
    ?>
    <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><?php echo $this->session->flashdata('success'); ?></div>
<?php } ?>


<?php
// preparing form elements:
$data = array(
    'name' => 'data',
    'id' => 'data',
    'value' => '',
    'class' => 'input-block-level',
    'placeholder' => ''
);


$attributes_form = array('class' => 'well');
echo form_open(base_url() . 'bins/add', $attributes_form);
?>


<!-- Notification -->
<?php echo validation_errors('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button>', '</div>'); ?>
<!-- /Notification -->
<span class="label label-info">Plain text only at this stage.</span>

<?php
echo form_textarea($data);
?>
<div class="row-fluid">
    <div class="span12"><button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
<?php
echo form_close();
?>
<!-- /Login Form -->