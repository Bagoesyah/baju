<script>
    // $('#goto_verify').click(function (e) {
    //     e.preventDefault();
    //     var that = $(this);
    //     $.ajax({
    //         url: base_url + '/custom/check_verify',
    //         data: {},
    //         type: 'post',
    //         dataType: 'json',
    //         success: function (d) {
    //             if (d.status == 200) {
    //                 console.log(that.src);
    //                 window.location.href = base_url + '/custom/verify';
    //             } else {
    //                 $('#cr_verify').empty();
    //                 $('.alert-flash').remove();
    //                 $('#cr_verify').append('<div class="alert alert-danger"><p>Cannot proceed to Verify, you must complete the order.</p></div>');
    //             }
    //         }
    //     });
    // });
    $(document).ready(function(){
        $.ajax({
            url: base_url + '/custom/check_verify',
            data: {},
            type: 'post',
            dataType: 'json',
            success: function (d) {
                if (d.status == 200) {
                    console.log(that.src);
                    window.location.href = base_url + `/custom/verify`;
                } else {
                    $('#cr_verify').empty();
                    $('.alert-flash').remove();
                    $('#cr_verify').append('<div class="alert alert-danger"><p>Cannot proceed to Verify, you must complete the order.</p></div>');
                }
            }
        });
    });
</script>