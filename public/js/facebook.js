$(document).ready(function(){
	$('.addFriends').on('click', function (){
		allFreindsArray = getAllList();
		$.ajax({
			url: "/createFriends",
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
		allFreindsArray = getAllList();
		$.ajax({
			url: "/checkFriends",
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

function getAllList(){
	var allFriendsObject = $('.fb-content .uiProfileBlockContent .fcb > a:first-child');
	var allFreindsArray = [];
	$(allFriendsObject).each(function(){
		allFreindsArray.push($(this).text());
	});
	return  allFreindsArray;
}


