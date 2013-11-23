# Friendships Create Request

Allows the authenticating users to follow the user specified in the ID parameter.

Returns the befriended user in the requested format when successful.
May throw exceptions in case of failure.

If you are already friends with the user a HTTP 403 may be returned, though for performance reasons you may get a
200 OK message even if the friendship already exists.

``` php
use Widop\Twitter\Friendships\FriendshipsCreateRequest;

$request = new FriendshipsCreateRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setFollow(true);
$follow = $request->getFollow();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/friendships/create).
