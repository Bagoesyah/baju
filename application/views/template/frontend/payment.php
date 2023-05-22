<?php
# @Author: Awan Tengah
# @Date:   2017-04-26T13:35:53+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-04-29T02:10:55+07:00
?>
<link rel="stylesheet" href="<?php echo base_url('assets/plugin/fancybox/jquery.fancybox.css'); ?>">
<script src="https://api.sandbox.midtrans.com/v2/assets/js/veritrans.js"></script>
<script src="<?php echo base_url('assets/plugin/fancybox/jquery.fancybox.pack.js'); ?>"></script>

<div class="container text-justify">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-md-4 col-sm-6">
                <h4><strong>Total amount to be paid</strong> <span id="total-amount" class="pull-right"><strong><?php echo isset($total_amount) ? $total_amount : format_currency(0); ?></strong></span></h4>
            </div>
            <div class="clearfix"></div>
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-pills" role="tablist">
                    <li class="active" style="width: 200px;">
                        <a href="#manual_transfer" aria-controls="manual_transfer" role="tab" data-toggle="tab" data-material="payment">
                            <img src="<?php echo base_url('assets/img/coin.png'); ?>" class="img-responsive col-centered">
                            <div class="text-center">Manual Transfer</div>
                        </a>
                    </li>
                    <li style="width: 200px;">
                        <a href="#credit_card" aria-controls="credit_card" role="tab" data-toggle="tab" data-material="payment">
                            <img src="<?php echo base_url('assets/img/credit-card.png'); ?>" class="img-responsive col-centered">
                            <div class="text-center">Credit Card</div>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="margin-top: 1em;">
                    <div role="tabpanel" class="tab-pane active" id="manual_transfer">...</div>
                    <div role="tabpanel" class="tab-pane" id="credit_card">
                        <div class="col-sm-12">
                            <div class="well">
                                <ul class="list-inline" style="margin: 0;">
                                    <li>Accept Card Type:</li>
                                    <li><img src="<?php echo base_url('assets/img/visa.png'); ?>"></li>
                                    <li><img src="<?php echo base_url('assets/img/mastercard.png'); ?>"></li>
                                    <li><img src="<?php echo base_url('assets/img/maestro.png'); ?>"></li>
                                </ul>
                            </div>
                        </div>
                        <?php echo form_open('payment/proceed/' . encrypt_text($order_number), array('id' => 'payment-form')); ?>
                        <div class="col-sm-12">
                            <div id="validation-message"></div>
                            <h4><strong>Credit Card Detail</strong></h4>
                            <div class="form-group">
                                <label for="card-number">Credit Card</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="ion-card"></i>
                                    </div>
                                    <input type="text" id="card-number" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="card-expiry-month">Expiration Month</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="ion-clock"></i>
                                    </div>
                                    <input type="text" id="card-expiry-month" class="form-control" placeholder="MM">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="card-expiry-year">Expiration Year</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="ion-clock"></i>
                                    </div>
                                    <input type="text" id="card-expiry-year" class="form-control" placeholder="YY">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="card-cvv">Security Code</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="ion-locked"></i>
                                    </div>
                                    <input type="password" id="card-cvv" class="form-control" placeholder="123">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="token_id" name="token_id">
                        <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
                            <button type="button" class="btn btn-primary btn-block submit-button">Proceed to Secure Payment <i class="ion-locked"></i></button>
                        </div>
                        <?php echo form_close(); ?>

                        <script>
                        $(function () {
                            // Sandbox URL
                            Veritrans.url = "https://api.sandbox.midtrans.com/v2/token";
                            // TODO: Change with your client key.
                            Veritrans.client_key = "<?php echo Veritrans_Config::$clientKey ?>";
                            var card = function () {
                                return {
                                    "card_number": $("#card-number").val(),
                                    "card_exp_month": $("#card-expiry-month").val(),
                                    "card_exp_year": $("#card-expiry-year").val(),
                                    "card_cvv": $("#card-cvv").val(),
                                    "secure": false,
                                    "gross_amount": $("#total-amount").val()
                                }
                            };

                            function callback(response) {
                                console.log(response);
                                if (response.redirect_url) {
                                    console.log("3D SECURE");
                                    // 3D Secure transaction, please open this popup
                                    openDialog(response.redirect_url);

                                }
                                else if (response.status_code == "200") {
                                    console.log("NOT 3-D SECURE");
                                    // Success 3-D Secure or success normal
                                    closeDialog();
                                    // Submit form
                                    $("#token_id").val(response.token_id);
                                    $("#payment-form").submit();
                                }
                                else {
                                    // Failed request token
                                    $("#validation-message").html('');
                                    if(response.status_code == '400') {
                                        $.each(response.validation_messages, function(key, value) {
                                            $("#validation-message").append(
                                                '<div class="alert alert-danger" role="alert">' +
                                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                                value +
                                                '</div>'
                                            );
                                        });
                                    }
                                    // console.log(response.status_code);
                                    // alert(response.status_message);
                                    $('button').removeAttr("disabled");
                                }
                            }

                            function openDialog(url) {
                                $.fancybox.open({
                                    href: url,
                                    type: "iframe",
                                    autoSize: false,
                                    width: 700,
                                    height: 500,
                                    closeBtn: false,
                                    modal: true
                                });
                            }

                            function closeDialog() {
                                $.fancybox.close();
                            }

                            $(".submit-button").click(function (event) {
                                console.log("SUBMIT");
                                event.preventDefault();
                                $(this).attr("disabled", "disabled");
                                Veritrans.token(card, callback);
                                return false;
                            });
                        });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
