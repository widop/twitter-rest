# Friendships Lookup Request

Returns the relationships of the authenticating user to the comma-separated list of up to 100 screen_names or user_ids provided.

``` php
use Widop\Twitter\Friendships\FriendshipsListRequest;

$request = new FriendshipsListRequest();

$request->setUserId('123546789,456789,7894564654');
$userIds = $request->getUserId();

$request->setScreenName('noradio,raffi,twitterapi');
$screenNames = $request->getScreenName();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/friendships/lookup).
