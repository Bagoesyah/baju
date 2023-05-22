<?php $this->load->view('template/frontend/custom/_objects'); ?>
<?php $this->load->view('template/frontend/custom/_header'); ?>


<div id="content-custom">
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
	$(document).ready(function() {
		const base_url = "<?= base_url() ?>"

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
			const menuName = $(this).attr('data-menu')
			// console.log(menuName)
			if (menuName) return loadView(menuName);
			// if (menuName) return console.log(menuName);
			if (!menuName) return console.error("page not found");
		});

	});
</script>