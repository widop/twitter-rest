# Lists List Request

Returns all lists the authenticating or specified user subscribes to, including their own. The user is specified using
the user_id or screen_name parameters. If no user is given, the authenticating user is used.

A maximum of 100 results will be returned by this call. Subscribed lists are returned first, followed by owned lists.
This means that if a user subscribes to 90 lists and owns 20 lists, this method returns 90 subscriptions and 10 owned
lists. The reverse method returns owned lists first, so with reverse=true, 20 owned lists and 80 subscriptions would be
returned. If your goal is to obtain every list a user owns or subscribes to, use GET [`lists/ownerships`](ownerships.md)
and/or GET [`lists/subscriptions`](subscriptions.md) instead.

``` php
use Widop\Twitter\Rest\Lists\ListsListRequest;

$request = new ListsListRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setReverse(true);
$reverse = $request->getReverse();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/list).
