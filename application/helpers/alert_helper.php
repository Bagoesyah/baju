<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T13:37:29+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-03T15:07:42+07:00

//Alert helper for bootstrap

function alert_message($flashdata = 'message')
{
    $ci = &get_instance();
    if ($ci->session->flashdata($flashdata) != NULL) {
        $message = $ci->session->flashdata($flashdata);
        ?>
        <div class="alert <?php echo $message['class']; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $message['message']; ?>
        </div>
        <?php
    }
}

function alert_validation()
{
    echo validation_errors(
        "<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>",
        "</div>"
    );
}
