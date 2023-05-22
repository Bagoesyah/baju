<?php
# @Author: Awan Tengah
# @Date:   2017-04-29T15:13:51+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T15:24:41+07:00
?>

<div class="container text-justify">
    <div class="row">
        <div class="col-lg-12">
            <div class="well">
                <strong><?php echo isset($message) ? $message : ''; ?></strong><br><br>
                <a href="<?php echo site_url(); ?>" class="btn btn-default">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<script>
if (isMobile.Android()) {
    Android.vtstatus('<?php echo $status; ?>', '<?php echo $message; ?>');
}
</script>
