# Friendships Update Request

Allows the authenticating user to unfollow the user specified in the ID parameter.

Returns the unfollowed user in the requested format when successful.
May throw exceptions in case of failure.

``` php
use Widop\Twitter\Rest\Friendships\FriendshipsUpdateRequest;

$request = new FriendshipsUpdateRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setDevice(true);
$device = $request->getDevice();

$request->setRetweets(true);
$retweets = $request->getRetweets();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/friendships/update).
