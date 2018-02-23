<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    .checkFriends {
        background-image: -webkit-gradient(linear, 0 0, 299 11, color-stop(0.023, #ff9c79), to(#ff788a));
        background-image: -webkit-linear-gradient(357.89307870931185deg, #ff9c79 2.3%, #ff788a);
        background-image: -moz-linear-gradient(357.89307870931185deg, #ff9c79 2.3%, #ff788a);
        background-image: -o-linear-gradient(357.89307870931185deg, #ff9c79 2.3%, #ff788a);
        background-image: linear-gradient(92.10692129068815deg, #ff9c79 2.3%, #ff788a)
    }
    .addFriends {
        background-image: -webkit-gradient(linear, 0 0, 262 0, from(#e5ef51), to(#abdd49));
        background-image: -webkit-linear-gradient(360deg, #e5ef51, #abdd49);
        background-image: -moz-linear-gradient(360deg, #e5ef51, #abdd49);
        background-image: -o-linear-gradient(360deg, #e5ef51, #abdd49);
        background-image: linear-gradient(90deg, #e5ef51, #abdd49);
    }
    .fb-content,.token, .showDeletedFriendsList {
        display: none;
    }
    </style>
    </head>
    <body>
        <div class="token">{{ csrf_token() }}</div>
        <div class='col-xs-12 text-center'>
            <textarea class="friendsSource"></textarea><br>
            <button type="button" class="addFriendsSource" data-condition="add-database">Add Source</button>
            <button type="button" class="checkFriendsSource" data-condition="check">Check Source</button>
        </div>
        <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
            <button class="addFriends btn" type="button"><span>Add friends</span></button>
        </div>
        <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
            <button class="checkFriends btn" type="button"><span>Check Friends</span></button>
        </div>
        <div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
            <div class="showDeletedFriendsList">
                <p>Deleted friends list</p>
                <div class="deletedFriendName"></div>
            </div>
        </div>
        <div class="fb-content">
            @if($source != null)
                {!! $source->source !!}
            @endif
        </div>

    <script src="{{asset('js/facebook.js')}}"></script>
</html>
