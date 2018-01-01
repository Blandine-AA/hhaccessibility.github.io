function keepSessionAlive() {
	function getToken() {
		var $token_element = $('[name="_token"]');
		if ( $token_element.length !== 0 ) {
			return $token_element[0].value;
		}
		if ( typeof csrf_token === 'string' ) {
			return csrf_token;
		}
	}
	
	var token = getToken();

	function sendUpdate() {
		if ( typeof token === 'string' ) {
			return $.ajax({
				'method': 'POST',
				'url': '/api/keep-session-alive',
				'data': {
					'_token': token
				}
			});
		}
		else {
			return $.Deferred().reject().promise();
		}
	}

	if ( token ) {
		sendUpdate().then(function (response) {
			window.setInterval(sendUpdate, (response.lifetime_in_minutes - 1) * 60 * 1000);
		});
	}
}

$(document).ready(keepSessionAlive);
