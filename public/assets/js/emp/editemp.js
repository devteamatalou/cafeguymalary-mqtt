$(document).ready(() => {
	$('#editemp').submit((e) => {
		e.preventDefault();

		var dataForm = $('#editemp')[0];
		var formData = new FormData(dataForm);
		$.ajax({
			url: 'http://cafeguymalary.atalou.org/src/controllers/emp/editemp.ctrl.php',
			type: "POST",
			dataType: 'script',
			cache: false,
			contentType: false,
			processData: false,
			data: formData,

			success: function (data) {
				console.log(data)
				let reponse = JSON.parse(data)
				if (reponse.status === true) {
					$('#editemp')[0].reset();
					Toastify({
						text: reponse.message,
						duration: 1000,
						close: true,
						gravity: "top", // `top` or `bottom`
						position: "right", // `left`, `center` or `right`
						stopOnFocus: true, // Prevents dismissing of toast on hover
						style: {
							background: "linear-gradient(to right, #00b09b, #96c93d)",
						},
						callback: function()
						{
							window.location = "http://cafeguymalary.atalou.org/views/admin/";
						}
					}).showToast();

					
				} else {

					Toastify({
						text: reponse.message,
						duration: 3000,
						close: true,
						gravity: "top", // `top` or `bottom`
						position: "right", // `left`, `center` or `right`
						stopOnFocus: true, // Prevents dismissing of toast on hover
						style: {
							background: "linear-gradient(to right,  rgba(255,0,0,1), rgba(255,0,0,0.5))",
						}
					}).showToast();
				}
			}
		});
	});
});