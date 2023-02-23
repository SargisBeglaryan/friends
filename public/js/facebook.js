$(document).ready(function(){

	$('.addFriendsSource, .checkFriendsSource').on('click', function(){
		if($('.friendsSource').val() == ''){
			return false;
		}
		$('.fb-content').html($('.friendsSource').val());
		if($(this).data('condition') == 'add-database'){
			$.ajax({
				url: "/createSource",
				type: "POST",
				data: {
					_token:  $('.token').text().trim(),
					source:  $('.friendsSource').val()
						},
				success: function(data) {
					alert('Success');
				},
				error: function (xhr, status, error) {
					alert('Error!');
					console.log("Sorry, there was a problem!");
				}
			});
		}
	});

	$('.addFriends').on('click', function (){
		let socialNetwork = $(this).data('social');
		allFreindsArray = getAllList(socialNetwork);
		$.ajax({
			url: "/createFriends/"+socialNetwork,
			type: "POST",
			data: {
				_token:  $('.token').text().trim(),
				allFreindsList:  allFreindsArray
					},
			success: function(data) {
				alert('Success');
			},
			error: function (xhr, status, error) {
				alert('Error!');
				console.log("Sorry, there was a problem!");
			}
		});
	});

	$('.checkFriends').on('click', function (){
		debugger;
		let socialNetwork = $(this).data('social');
		allFreindsArray = getAllList(socialNetwork);
		$.ajax({
			url: "/checkFriends/"+ socialNetwork,
			type: "POST",
			data: {
				_token:  $('.token').text().trim(),
				allFreindsList:  allFreindsArray
					},
			success: function(data) {
				$('.showDeletedFriendsList').show();
				for(let i = 0; i < data.length; i++){
					$('.deletedFriendName').append('<p>'+data[i]+'</p>');
				}
				alert('Success');
			},
			error: function (xhr, status, error) {
				alert('Error!');
				console.log("Sorry, there was a problem!");
			}
		});
	});
});

function getAllList(socialNetwork){
	if(socialNetwork == 'facebook') {
		debugger;
		var activefriendsObject = $('.fb-content .x9f619 .x1yztbdb .x6s0dn4 .x1iyjqo2.x1pi30zi a .x193iq5w');
		var allFriendsObject = activefriendsObject.add($('.fb-content .x9f619 .x1yztbdb .x6s0dn4 .x1iyjqo2.x1pi30zi     div.x1i10hfl .x193iq5w'));
		// var allFriendsObject = activefriendsObject;
	} else {
		var allFriendsObject = $('.fb-content .wo9IH a');
	}
	var allFreindsArray = [];
	$(allFriendsObject).each(function(){
		allFreindsArray.push($(this).text());
	});
	return  allFreindsArray;
}


