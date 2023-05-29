<?php $this->load->view('template/frontend/custom/_objects'); ?>
<?php $this->load->view('template/frontend/custom/_header'); ?>


<div id="content-custom">
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
	$(document).ready(function() {
		const base_url = "<?= base_url() ?>"

		function check_verify() {
			$.ajax({
				url: base_url + '/custom/check_verify',
				type: "POST",
				async: false,
				dataType: 'json',
				success: function(d) {
					console.log(d);
					if (d.status == 200) {
						console.log(that.src);
						window.location.href = base_url + 'custom';
					} else {
						$('#cr_verify').empty();
						$('.alert-flash').remove();
						$('#cr_verify').append('<div class="alert alert-danger"><p>Cannot proceed to Verify, you must complete the order.</p></div>');
					}
				}
			});
		}

		// verify data
		$('#goto_verify').click(function(e) {
			var that = $(this);
			check_verify();
		});

		const loadView = (path) => {
			$('#content-custom').load(base_url + `custom/${path}`);
			// $.get(base_url + `custom/${path}`, function(data) {
			// 	$("#content-custom").html(data);
			// })
		}
		// first load view
		loadView('fabric');

		$('.nav_menu').click(function(e) {
			e.preventDefault();
			// checking verify every page load
			check_verify();
			const menuName = $(this).attr('data-menu')
			// console.log(menuName)
			if (menuName) return loadView(menuName);
			// if (menuName) return console.log(menuName);
			if (!menuName) return console.error("page not found");

		});

	});
</script>