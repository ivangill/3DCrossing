<?php
header("Content-type: application/x-msdownload");
header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header("Content-Disposition: attachment; filename=reviewexport.xls");
header('Pragma: no-cache');
header("Content-Type: text/html; charset=UTF-8");
?>

<style>
    .table-bordered {
        border-width: 1px 1px 1px 1px;
        border-style: solid solid solid solid;
        border-color: #eee;
        width: 100%;
        margin-bottom: 20px;
    }
    .table-bordered th
    {
        text-align: left !important;
        font-weight: bold;
        border-bottom: 1px solid #eee;
    }
    .table-bordered td
    {
        text-align: left !important;
        font-weight: normal;
        border-bottom: 1px solid #eee;
    }
</style>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Activation Status</th>
            <th>Subscribtion Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($get_newsletter_subscribers) > 0) {
            foreach ($get_newsletter_subscribers as $subscriber) { ?>
                <tr id="row_1">
                    <td><?php echo ucfirst($subscriber['name']); ?></td>
                    <td><?php echo $subscriber['email']; ?></td>
                    <td><?php echo ucfirst($subscriber['subscriber_activated']); ?></td>
                    <td><?php echo date('F j, Y',$subscriber['subscribed_time']); ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="2">No subscriber.<td>
            </tr>
        <?php } ?>
    </tbody>
</table>

