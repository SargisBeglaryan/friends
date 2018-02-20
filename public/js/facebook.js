$(document).ready(function(){
	$('.addFriends').on('click', function (){
		var allFriendsObject = $('.fb-content .uiProfileBlockContent .fcb > a:first-child');
		var allFreindsArray = [];
		$(allFriendsObject).each(function(){
			allFreindsArray.push($(this).text());
		});
		debugger;
		$.ajax({
			url: "/createFriends",
			type: "POST",
			data: {
				_token:  $('.token').text().trim(),
				allFreindsList:  allFreindsArray
					},
			success: function(data) {
				ajaxCallResponse('Success');
			},
			error: function (xhr, status, error) {
				ajaxCallResponse('Error!');
				console.log("Sorry, there was a problem!");
			}
		});
	});
});
