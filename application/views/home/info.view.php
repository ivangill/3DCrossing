

<div class="row-fluid">

    <div class="span12 text-center">

    	<input class="input-medium" type="text" placeholder="" value="<?php echo $bin['shorturl']; ?>">

    	<code>
            <?php echo $bin['data']; ?>
        </code>


    </div>



        <span class="label label-info">Created <?php
													$now = time();
													echo timespan($bin['created_date'], $now);
												   ?>
</span>


</div>
