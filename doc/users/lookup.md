# Users Lookup Request

Returns fully-hydrated user objects for up to 100 users per request, as specified by comma-separated values passed to
the user_id *and/or* screen_name parameters.

This method is especially useful when used in conjunction with collections of user IDs returned from
[`friends/ids`](../friends/ids.md) and [`followers/ids`](../followers/ids.md).

NB: [`users/show`](show.md) is used to retrieve a single user object.
NB: While the twitter REST API allows GET and POST request on this endpoint, only POST requests will be performed as
twitter encourage it.

``` php
use Widop\Twitter\Users\UsersLookupRequest;

$request = new UsersLookupRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/lookup).
