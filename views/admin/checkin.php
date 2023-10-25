<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Restaurant Interface</title>
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<div class="resto-logo">
			<img src="assets/img/logo_resto.png" alt="Restaurant Logo">
		</div>
		<div class="restaurant-logo">
			<h1>Les Délices D'Edelande Restaurant</h1>
		</div>
		<div id="load-data"> </div>
	</header>

	<footer id="footer">
		<div class="container">
			<div class="copyright">
				&copy; Copyright <strong><span>AAN</span></strong>
			</div>
			<div class="credits">
				Designed by <strong><span>Atalou Micro System</span></strong></strong>
			</div>
		</div>
	</footer>
</body>

</html>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
	const url = 'ws://broker.emqx.io:8083/mqtt';

	// Create an MQTT client instance
	const options = {
		// Clean session
		clean: true,
		connectTimeout: 20000,
		// Authentication
		clientId: 'emqx_test',
		username: 'emqx_test',
		password: 'emqx_test',
	}

	const client = mqtt.connect(url, options);
	client.on('connect', function() {
		var topic = 'droid';
		console.log('Connected');
		// Subscribe to a topic
		client.subscribe(topic, function(err) {});
	});

	// Receive messages
	client.on('message', function(topic, message) {
		// message is Buffer
		var msg = message.toString();
		console.log(msg);

		// ------- <ADDED> --------
		$(document).ready(function() {
			var code = message.toString();
			$.ajax({
				url: "action.php",
				type: "post",
				data: {
					code: code
				},
				success: function(result) {

					let renderedHtml = result.html;
					var audioPath = result.audiopath;

					$("#load-data").html(renderedHtml);

					// ------------ checking the audio path and play it
					if (audioPath) {
						var audio = new Audio(audioPath);
						audio.play().then(function() {
							console.log('Audio is playing');
						}).catch(function(error) {
							console.error('Error playing audio: ' + error);
						});
					}

					setTimeout(homeDisplay, 20000);
				}
			});
		});
		// ------- </ADDED> --------
	});


	// load the default interface on page load
	$(document).ready(function() {
		homeDisplay();
	});

	// the function to put default interface design
	function homeDisplay() {
		$("#load-data").html("<div class='logout'><img src='assets/img/deconnecter.png'><p><a href='#'>Déconnexion</a></p></div>");
	}
</script>