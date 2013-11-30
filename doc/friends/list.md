# Friends List Request

Returns a cursored collection of user objects for every user the specified user is following.

``` php
use Widop\Twitter\Rest\Friends\FriendsListRequest;

$request = new FriendsListRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setCursor('123546789');
$cursor = $request->getCursor();

$request->setCount(200);
$count = $request->getCount();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$request->setIncludeUserEntities(true);
$includeUserEntities = $request->getIncludeUserEntities();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/friends/list).
