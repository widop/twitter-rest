# Followers Ids Request

Returns a cursored collection of user IDs for every user following the specified user.

``` php
use Widop\Twitter\Rest\Followers\FollowersIdsRequest;

$request = new FollowersIdsRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setCursor('123546789');
$cursor = $request->getCursor();

$request->setCount(200);
$count = $request->getCount();

$request->setStringifyIds(true);
$stringifyIds = $request->getStringifyIds();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/followers/ids).
