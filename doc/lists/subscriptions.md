# Lists Subscriptions Request

Obtain a collection of the lists the specified user is subscribed to, 20 lists per page by default. Does not include
the user's own lists.

If no user id or screen name are provided, the results of the authenticated user will be returned.

``` php
use Widop\Twitter\Rest\Lists\ListsSubscriptionsRequest;

$request = new ListsSubscriptionsRequest();

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

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/subscriptions).
