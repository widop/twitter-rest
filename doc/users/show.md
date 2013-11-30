# Users Show Request

Returns a variety of information about the user specified by the required user_id or screen_name parameter. The author's
most recent Tweet will be returned inline when possible.

NB: [`users/lookup`](lookup.md) is used to retrieve a bulk collection of user objects.

``` php
use Widop\Twitter\Users\UsersShowRequest;

$request = new UsersShowRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$user = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/show).
