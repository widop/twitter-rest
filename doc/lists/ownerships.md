# Lists Ownerships Request

Returns the lists owned by the specified Twitter user. Private lists will only be shown if the authenticated user is
also the owner of the lists.

A user id or screen name MUST be provided.

``` php
use Widop\Twitter\Rest\Lists\ListsOwnershipsRequest;

$request = new ListsOwnershipsRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setCount(500);
$count = $request->getCount();

$request->setCursor('123465789');
$includeEntities = $request->getCursor();

$lists = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/ownerships).
