$(function () {
	var csrfToken = $('meta[name="csrf-token"]').attr('content');

	// Raw HTML of the friends page currently being worked with.
	var currentSource = window.savedFriendsSource || '';
	var parsedSource = null;

	// Parse lazily into an inert document: images are not fetched, scripts don't run,
	// and nothing is attached to the live page DOM.
	function getSourceDocument() {
		if (parsedSource === null) {
			parsedSource = new DOMParser().parseFromString(currentSource, 'text/html');
		}
		return parsedSource;
	}

	function setSource(html) {
		currentSource = html;
		parsedSource = null;
	}

	// Send JSON so large friend lists are not cut off by PHP's max_input_vars (default 1000).
	function postJson(url, payload) {
		return $.ajax({
			url: url,
			type: 'POST',
			contentType: 'application/json',
			dataType: 'json',
			headers: { 'X-CSRF-TOKEN': csrfToken },
			data: JSON.stringify(payload)
		}).fail(function () {
			alert('Error!');
			console.log('Sorry, there was a problem!');
		});
	}

	function getAllList(socialNetwork) {
		var $doc = $(getSourceDocument());
		var $friends;

		if (socialNetwork === 'facebook') {
			$friends = $doc.find(
				'.x9f619 .x1yztbdb .x6s0dn4 .x1iyjqo2 a .x193iq5w, ' +
				'.x9f619 .x1yztbdb .x6s0dn4 .x1iyjqo2 div.x1i10hfl .x193iq5w'
			);
		} else {
			$friends = $doc.find('.wo9IH a');
		}

		return $friends.map(function () {
			return $(this).text();
		}).get();
	}

	$('.addFriendsSource, .checkFriendsSource').on('click', function () {
		var source = $('.friendsSource').val();
		if (source === '') {
			return false;
		}
		setSource(source);

		if ($(this).data('condition') === 'add-database') {
			postJson('/createSource', { source: source }).done(function () {
				alert('Success');
			});
		}
	});

	$('.addFriends').on('click', function () {
		var socialNetwork = $(this).data('social');
		postJson('/createFriends/' + socialNetwork, {
			allFreindsList: getAllList(socialNetwork)
		}).done(function () {
			alert('Success');
		});
	});

	$('.checkFriends').on('click', function () {
		var socialNetwork = $(this).data('social');
		postJson('/checkFriends/' + socialNetwork, {
			allFreindsList: getAllList(socialNetwork)
		}).done(function (deletedFriends) {
			// Build once and replace (instead of appending per item and piling up on re-clicks);
			// .text() keeps names from being interpreted as HTML.
			var items = $.map(deletedFriends, function (name) {
				return $('<p>').text(name)[0];
			});
			$('.deletedFriendName').empty().append(items);
			$('.showDeletedFriendsList').show();
			alert('Success');
		});
	});
});
