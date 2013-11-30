# Friendships Destroy Request

Allows the authenticating user to unfollow the user specified in the ID parameter.

Returns the unfollowed user in the requested format when successful.
May throw exceptions in case of failure.

``` php
use Widop\Twitter\Rest\Friendships\FriendshipsDestroyRequest;

$request = new FriendshipsDestroyRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/friendships/create).
