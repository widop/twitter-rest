# Lists Memberships Request

Returns the lists the specified user has been added to. If user_id or screen_name are not provided the memberships for
the authenticating user are returned.

``` php
use Widop\Twitter\Rest\Lists\ListsMembershipsRequest;

$request = new ListsMembershipsRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setCursor('123465789');
$includeEntities = $request->getCursor();

$request->setFilterToOwnedLists(true);
$filterToOwnedLists = $request->getFilterToOwnedLists();

$members = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/memberships).
